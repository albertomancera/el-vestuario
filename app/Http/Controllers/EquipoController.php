<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        // Cogemos los equipos a los que pertenece el usuario logueado
        $equipos = auth()->user()->equipos; 
        
        // Se los enviamos a la vista (pantalla)
        return view('equipos.index', compact('equipos'));
    }

    public function create() {
        return view('equipos.create');
    }
    public function store(Request $request) {
        // 1. Validamos que el nombre no esté vacío
        $request->validate([
            'nombre' => 'required|string|max:255',
            'escudo' => 'nullable|string'
        ]);

        // 2. Creamos el equipo en la base de datos
        $equipo = Equipo::create([
            'nombre' => $request->nombre,
            'escudo' => $request->escudo,
            'codigo_invitacion' => strtoupper(substr(uniqid(), -8)) 
                                //Crea un numero unico, recorta solo los ultimos 8 caracteres y los pone en mayuscula
        ]);

        // 3. Unimos al usuario que lo ha creado como CAPITÁN
        auth()->user()->equipos()->attach($equipo->id, ['rol' => 'capitan']);

        // 4. Lo devolvemos a la pantalla de sus equipos con un mensaje de éxito
        return redirect()->route('equipos.index');
    }
    public function show(Equipo $equipo)
    {
        $jugadores = $equipo->usuarios;
        
        // Comprobamos si el usuario actual tiene el rol de 'capitan' en este equipo
        $esCapitan = $equipo->usuarios()->where('user_id', auth()->id())->first()->pivot->rol === 'capitan';

        return view('equipos.show', compact('equipo', 'jugadores', 'esCapitan'));
    }
    
    public function edit(Equipo $equipo) {}
    public function update(Request $request, Equipo $equipo) {}
    public function destroy(Equipo $equipo) {}

    // Muestra la pantalla para meter el código
    public function join()
    {
        return view('equipos.join');
    }

    // Comprueba el código y une al jugador
    public function joinStore(Request $request)
    {
        // 1. Validamos que ha escrito algo
        $request->validate(['codigo' => 'required|string']);

        // 2. Buscamos el equipo con ese código
        $equipo = Equipo::where('codigo_invitacion', $request->codigo)->first();

        // 3. Si no existe, devolvemos un error
        if (!$equipo) {
            return back()->withErrors(['codigo' => 'El código de invitación no es válido.']);
        }

        // 4. Si el usuario ya está dentro de ese equipo, le avisamos
        if ($equipo->usuarios()->where('user_id', auth()->id())->exists()) {
            return back()->withErrors(['codigo' => 'Ya perteneces a este equipo.']);
        }

        // 5. Lo metemos en el equipo con el rol de JUGADOR normal
        $equipo->usuarios()->attach(auth()->id(), ['rol' => 'jugador']);

        // 6. Lo llevamos directamente al vestuario del equipo
        return redirect()->route('equipos.show', $equipo->id);
    }

    // Mostrar el panel de estadísticas del equipo
    public function estadisticas(Equipo $equipo)
    {
        // 1. Contamos totales básicos
        $totalPartidos = $equipo->partidos()->count();
        $totalJugadores = $equipo->usuarios()->count();

        // 2. Calculamos el coste total de todas las pistas alquiladas
        $gastoTotal = $equipo->partidos()->sum('coste_pista');

        // 3. Ranking de jugadores (quién se ha apuntado a más partidos de este equipo)
        $ranking = $equipo->usuarios()->withCount(['partidos' => function($query) use ($equipo) {
            $query->where('equipo_id', $equipo->id);
        }])->orderByDesc('partidos_count')->get();

        return view('equipos.estadisticas', compact('equipo', 'totalPartidos', 'totalJugadores', 'gastoTotal', 'ranking'));
    }

    // Mostrar el historial de resultados del equipo
    public function resultados(Equipo $equipo)
    {
        // Traemos solo los partidos ya finalizados y ordenados por fecha
        $partidos = $equipo->partidos()
                           ->where('cronica_cerrada', true)
                           ->orderBy('fecha', 'desc')
                           ->get();

        return view('equipos.resultados', compact('equipo', 'partidos'));
    }
}