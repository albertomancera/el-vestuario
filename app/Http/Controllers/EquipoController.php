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
        // Generamos un código de invitación aleatorio de 8 letras/números
        $equipo = Equipo::create([
            'nombre' => $request->nombre,
            'escudo' => $request->escudo,
            'codigo_invitacion' => strtoupper(substr(uniqid(), -8)) 
        ]);

        // 3. Unimos al usuario que lo ha creado como CAPITÁN
        auth()->user()->equipos()->attach($equipo->id, ['rol' => 'capitan']);

        // 4. Lo devolvemos a la pantalla de sus equipos con un mensaje de éxito
        return redirect()->route('equipos.index');
    }
    public function show(Equipo $equipo) {
        // Traemos a todos los jugadores que pertenecen a este equipo
        $jugadores = $equipo->usuarios;
        
        // Enviamos el equipo y sus jugadores a la pantalla
        return view('equipos.show', compact('equipo', 'jugadores'));
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
}