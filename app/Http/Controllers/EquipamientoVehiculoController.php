<?php

namespace App\Http\Controllers;

use App\Models\EquipamientoVehiculo;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class EquipamientoVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        // Consulta las marcas de vehículos con el filtro de búsqueda

        $equipamiento = EquipamientoVehiculo::query();

        if (!empty($search)) {
            $equipamiento->where('nombre', 'like', '%' . $search . '%');
        }

        $equipamientos = $equipamiento->get();

        return view('equipamientovehiculo.index', [
            'equipamientos' => $equipamientos,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipamientovehiculo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30',
        ]);

        EquipamientoVehiculo::create($request->all());

        return redirect()->route('equipamientovehiculo.index')
            ->with('success', 'Equipamiento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipamientoVehiculo $equipamientoVehiculo)
    {
        return view('equipamientovehiculo.show', compact('equipamientoVehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EquipamientoVehiculo $equipamientoVehiculo)
    {
        return view('equipamientovehiculo.edit', compact('equipamientoVehiculo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $equipamiento = EquipamientoVehiculo::find($id);
        if ($equipamiento) {
            $equipamiento->nombre = $request->input('nombre');
            $equipamiento->save();
            return redirect()->route('equipamientovehiculo.index')->with('success', 'Marca de vehículo actualizada correctamente');
        } else {
            return redirect()->route('equipamientovehiculo.index')->with('error', 'No se encontró la marca de vehículo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $equipamiento = EquipamientoVehiculo::find($id); // Buscar el grupo por ID

        if (!$equipamiento) {
            return redirect()->route('equipamientovehiculo.index')->with('error', 'Marca no encontrado.');
        }

        $equipamiento->delete();
        return redirect()->route('equipamientovehiculo.index')->with('success', 'Marca eliminado exitosamente.');
    }
}
