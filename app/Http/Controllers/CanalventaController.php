<?php

namespace App\Http\Controllers;

use App\Models\Canalventa;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class CanalventaController extends Controller
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
        $tiposQuery = Canalventa::query();

        if (!empty($search)) {
            $tiposQuery->where('nombre', 'like', '%' . $search . '%');
        }

        $tipocarnet = $tiposQuery->get();

        return view('canalventa.index', [
            'tipocarnet' => $tipocarnet,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }


    // Muestra el formulario para crear un nuevo tipo de vehículo
    public function create()
    {
        return view('canalventa.create');
    }

    // Almacena un nuevo tipo de vehículo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30',
        ]);

        Canalventa::create($request->all());
        return redirect()->route('canalventa.index')->with('success', 'Tipo de vehículo creado con éxito.');
    }

    // Muestra el tipo de vehículo específico
    public function show(Canalventa $tipocarnet)
    {
        return view('canalventa.show', compact('tipocarnet'));
    }

    // Muestra el formulario para editar el tipo de vehículo
    public function edit(Canalventa $tipocarnet)
    {
        return view('canalventa.edit', compact('tipocarnet'));
    }

    // Actualiza el tipo de vehículo
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        $tipocarnet = Canalventa::findOrFail($id);
        $tipocarnet->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('canalventa.index')->with('success', 'Tipo de vehículo actualizado con éxito.');
    }


    // Elimina el tipo de vehículo

    public function destroy($id)
    {
        $tipocarnet = Canalventa::findOrFail($id);

        if (!$tipocarnet) {
            return redirect()->route('canalventa.index')->with('error', 'Grupo no encontrado.');
        }

        $tipocarnet->delete();
        return redirect()->route('canalventa.index')->with('success', 'Grupo eliminado exitosamente.');
    }
}
