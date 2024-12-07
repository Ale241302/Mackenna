<?php

namespace App\Http\Controllers;

use App\Models\MarcaVehiculo;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class MarcaVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $marcasQuery = MarcaVehiculo::query();

        if (!empty($search)) {
            $marcasQuery->where('nombre', 'like', '%' . $search . '%');
        }

        $marcas = $marcasQuery->get();

        return view('marcavehiculo.index', [
            'marcas' => $marcas,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marca_vehiculo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:30',
        ]);

        MarcaVehiculo::create($request->all());

        return redirect()->route('marcavehiculo.index')->with('success', 'Marca de vehículo creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(MarcaVehiculo $marcaVehiculo)
    {
        return view('marcavehiculo.show', compact('marcaVehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(MarcaVehiculo $marcaVehiculo)
    {
        return view('marcavehiculo.edit', compact('marcaVehiculo'));
    }

    public function update(Request $request, $id)
    {
        $marca = Marcavehiculo::find($id);
        if ($marca) {
            $marca->nombre = $request->input('nombre');
            $marca->save();
            return redirect()->route('marcavehiculo.index')->with('success', 'Marca de vehículo actualizada correctamente');
        } else {
            return redirect()->route('marcavehiculo.index')->with('error', 'No se encontró la marca de vehículo');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $marcaVehiculo = MarcaVehiculo::find($id); // Buscar el grupo por ID

        if (!$marcaVehiculo) {
            return redirect()->route('marcavehiculo.index')->with('error', 'Marca no encontrado.');
        }

        $marcaVehiculo->delete();
        return redirect()->route('marcavehiculo.index')->with('success', 'Marca eliminado exitosamente.');
    }
}
