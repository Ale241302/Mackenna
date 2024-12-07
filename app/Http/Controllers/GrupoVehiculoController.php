<?php

namespace App\Http\Controllers;

use App\Models\GrupoVehiculo;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class GrupoVehiculoController extends Controller
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
        $tiposQuery = GrupoVehiculo::query();

        if (!empty($search)) {
            $tiposQuery->where('nombre', 'like', '%' . $search . '%');
        }

        $grupovehiculos = $tiposQuery->get();

        return view('grupovehiculo.index', [
            'grupovehiculos' => $grupovehiculos,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }


    // Muestra el formulario para crear un nuevo tipo de vehículo
    public function create()
    {
        return view('grupovehiculo.create');
    }

    // Almacena un nuevo tipo de vehículo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30',
        ]);

        GrupoVehiculo::create($request->all());
        return redirect()->route('grupovehiculo.index')->with('success', 'Tipo de vehículo creado con éxito.');
    }

    // Muestra el tipo de vehículo específico
    public function show(GrupoVehiculo $grupovehiculos)
    {
        return view('grupovehiculo.show', compact('grupovehiculos'));
    }

    // Muestra el formulario para editar el tipo de vehículo
    public function edit(GrupoVehiculo $grupovehiculos)
    {
        return view('grupovehiculo.edit', compact('grupovehiculos'));
    }

    // Actualiza el tipo de vehículo
    public function update(Request $request, GrupoVehiculo $grupovehiculo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $grupovehiculo->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('grupovehiculo.index')->with('success', 'Tipo de vehículo actualizado con éxito.');
    }


    // Elimina el tipo de vehículo

    public function destroy($id)
    {
        $grupovehiculo = GrupoVehiculo::find($id); // Buscar el grupo por ID

        if (!$grupovehiculo) {
            return redirect()->route('grupovehiculo.index')->with('error', 'Grupo no encontrado.');
        }

        $grupovehiculo->delete();
        return redirect()->route('grupovehiculo.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
