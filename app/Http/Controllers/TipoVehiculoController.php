<?php

namespace App\Http\Controllers;

use App\Models\TipoVehiculo;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class TipoVehiculoController extends Controller
{
    // Muestra la lista de tipos de vehículo
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Obtén el usuario autenticado y su grupo de usuarios
        $user = auth()->user();
        $userGroup = UserGroup::find($user->tipo_usuario);

        // Si no hay grupo de usuarios asignado, redirige o muestra un mensaje de error
        if (!$userGroup) {
            return redirect()->route('dashboard')->with('error', 'No se ha asignado un grupo de usuario.');
        }

        // Decodifica los permisos del grupo de usuarios
        $permisosUsuario = !empty($userGroup->permisos) ? json_decode($userGroup->permisos, true) : [];

        // Consulta los tipos de vehículo con el filtro de búsqueda
        $tiposQuery = TipoVehiculo::query();

        if (!empty($search)) {
            $tiposQuery->where('nombre', 'like', '%' . $search . '%');
        }

        $tipos = $tiposQuery->get();

        return view('tipovehiculo.index', [
            'tipos' => $tipos,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }


    // Muestra el formulario para crear un nuevo tipo de vehículo
    public function create()
    {
        return view('tipovehiculo.create');
    }

    // Almacena un nuevo tipo de vehículo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30',
        ]);

        TipoVehiculo::create($request->all());
        return redirect()->route('tipovehiculo.index')->with('success', 'Tipo de vehículo creado con éxito.');
    }

    // Muestra el tipo de vehículo específico
    public function show(TipoVehiculo $tipovehiculo)
    {
        return view('tipovehiculo.show', compact('tipovehiculo'));
    }

    // Muestra el formulario para editar el tipo de vehículo
    public function edit(TipoVehiculo $tipovehiculo)
    {
        return view('tipovehiculo.edit', compact('tipovehiculo'));
    }

    // Actualiza el tipo de vehículo
    public function update(Request $request, TipoVehiculo $tipovehiculo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $tipovehiculo->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tipovehiculo.index')->with('success', 'Tipo de vehículo actualizado con éxito.');
    }


    // Elimina el tipo de vehículo

    public function destroy($id)
    {
        $tipovehiculo = TipoVehiculo::find($id); // Buscar el grupo por ID

        if (!$tipovehiculo) {
            return redirect()->route('tipovehiculo.index')->with('error', 'Grupo no encontrado.');
        }

        $tipovehiculo->delete();
        return redirect()->route('tipovehiculo.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
