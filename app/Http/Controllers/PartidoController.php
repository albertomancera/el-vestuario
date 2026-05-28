<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PartidoController extends Controller
{
    // Mostrar la pantalla para crear un partido
    public function create(Equipo $equipo)
    {
        // Seguridad: Si no es capitán, le damos un error 403 (Prohibido)
        $esCapitan = $equipo->usuarios()->where('user_id', auth()->id())->first()->pivot->rol === 'capitan';
        if (!$esCapitan) {
            abort(403, 'Solo el capitán del equipo puede convocar partidos.');
        }

        return view('partidos.create', compact('equipo'));
    }

    // Guardar el partido en la base de datos
    public function store(Request $request, Equipo $equipo)
    {
        // 1. Validamos los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'lugar' => 'required|string|max:255',
            'coste_pista' => 'required|numeric|min:0',
        ]);

        // 2. Creamos el partido asociado a este equipo
        $equipo->partidos()->create([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'lugar' => $request->lugar,
            'coste_pista' => $request->coste_pista,
            'cancelado' => false,
        ]);

        // 3. Volvemos al panel del vestuario
        return redirect()->route('equipos.show', $equipo->id);
    }

   // Mostrar la ficha de un partido concreto y consultar la API del clima
    public function show(Equipo $equipo, Partido $partido)
    {
        if ($partido->equipo_id !== $equipo->id) {
            abort(404);
        }

        // --- INTEGRACIÓN API OPENWEATHER ---
        $apiKey = env('OPENWEATHER_API_KEY');
        $ciudad = 'Madrid'; 
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$ciudad}&appid={$apiKey}&units=metric&lang=es";

        $clima = null;
        try {
            // Hacemos la petición. El withoutVerifying() evita problemas de SSL en tu PC local.
            $respuesta = Http::timeout(3)->withoutVerifying()->get($url);
            
            if ($respuesta->successful()) {
                $clima = $respuesta->json();
            }
        } catch (\Exception $e) {
            // Si la API falla o sigue inactiva, cargamos la página normal sin el clima
        }
        // ------------------------------------

        return view('partidos.show', compact('equipo', 'partido', 'clima'));
    }

    // Función para que un jugador se apunte o se borre del partido
    public function apuntarse(Equipo $equipo, Partido $partido)
    {
        // El método 'toggle' hace la magia: si el usuario no está apuntado, lo apunta. Si ya estaba, lo borra.
        $partido->usuarios()->toggle(auth()->user()->id);

        // Recargamos la página enviando el mensaje de éxito para que salte la animación
        return back()->with('success', 'Tu estado en el partido ha cambiado correctamente.');
    }

    // Guardar un comentario en el muro del partido
    public function comentar(Request $request, Equipo $equipo, Partido $partido)
    {
        // Validamos que no envíen un mensaje vacío
        $request->validate([
            'mensaje' => 'required|string|max:1000'
        ]);

        // Creamos el comentario asociado al partido y al usuario actual
        $partido->comentarios()->create([
            'user_id' => auth()->id(),
            'mensaje' => $request->mensaje
        ]);

        return back()->with('success', 'Comentario publicado en el muro.');
    }

    // Guardar el resultado final del partido y los goles de los jugadores
    public function guardarResultado(Request $request, Equipo $equipo, Partido $partido)
    {
        // 1. Validamos los goles globales
        $request->validate([
            'goles_equipo' => 'required|integer|min:0',
            'goles_rival' => 'required|integer|min:0',
        ]);

        // 2. Guardamos el resultado general y cerramos el acta
        $partido->update([
            'goles_equipo' => $request->goles_equipo,
            'goles_rival' => $request->goles_rival,
            'cronica_cerrada' => true,
        ]);

        // 3. Si se han enviado goles individuales, los añadimos en la tabla intermedia (pivote)
        if ($request->has('goles_jugadores')) {
            foreach ($request->goles_jugadores as $jugadorId => $goles) {
                if ($goles > 0) {
                    // Actualizamos la columna 'goles' de ese jugador en este partido concreto
                    $partido->usuarios()->updateExistingPivot($jugadorId, [
                        'goles' => $goles
                    ]);
                }
            }
        }

        return back()->with('success', '¡Marcador y acta del partido publicados con éxito!');
    }
}