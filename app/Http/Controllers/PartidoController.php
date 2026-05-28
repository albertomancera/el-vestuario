<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;
use Illuminate\Http\Request;

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

    // Mostrar la ficha de un partido concreto
    public function show(Equipo $equipo, Partido $partido)
    {
        // Verificamos por seguridad que este partido pertenece a este equipo
        if ($partido->equipo_id !== $equipo->id) {
            abort(404);
        }

        return view('partidos.show', compact('equipo', 'partido'));
    }

    // Función para que un jugador se apunte o se borre del partido
    public function apuntarse(Equipo $equipo, Partido $partido)
    {
        // El método 'toggle' hace la magia: si el usuario no está apuntado, lo apunta. Si ya estaba, lo borra.
        $partido->usuarios()->toggle(auth()->user()->id);

        return back(); // Recargamos la página donde estábamos
    }
}