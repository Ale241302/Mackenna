<?php

namespace App\Http\Controllers;

use App\Models\ModeloVehiculo;
use Illuminate\Http\Request;
use App\Models\UserGroup;
use App\Models\TipoVehiculo;
use Illuminate\Support\Facades\Validator;

class ModeloVehiculoController extends Controller
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
        $modelo = ModeloVehiculo::query();

        if (!empty($search)) {
            $modelo->where('nombre', 'like', '%' . $search . '%');
        }

        $modelos = $modelo->get();
        $tipo_vehiculo = TipoVehiculo::all()->keyBy('id');

        return view('modelovehiculo.index', [
            'modelos' => $modelos,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario,
            'tipo_vehiculo' => $tipo_vehiculo, // Pasa los permisos a la vista
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modelovehiculo.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'tipo_combustible' => 'nullable|string|max:255',
            'capacidad_combustible' => 'required|numeric',
            'tipo_caja' => 'nullable|string|max:255',
            'equipamiento_vehiculo' => 'nullable|array',
            'tipo_itv' => 'nullable|string|max:255',
            'grafico_vehiculo_id' => 'nullable|string|max:255',
            'tipo_vehiculo' => 'nullable|string|max:255',
            'marca' => 'nullable|string|max:255',
            'grupo' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('createModeloModal', true);
        }

        // Debugging


        // Crea el registro de tarifa
        ModeloVehiculo::create([
            'nombre' => $request->input('nombre'),
            'tipo_vehiculo' => $request->input('tipo_vehiculo'),
            'tipo_combustible' => $request->input('tipo_combustible'),
            'capacidad_combustible' => $request->input('capacidad_combustible'),
            'tipo_caja' => $request->input('tipo_caja'),
            'equipamiento_vehiculo' => $request->input('equipamiento_vehiculo') ?? [],
            'tipo_itv' => $request->input('tipo_itv'),
            'grafico_vehiculo_id' => $request->input('grafico_vehiculo_id'),
            'marca' => $request->input('marca'),
            'grupo' => $request->input('grupo'),
        ]);

        return redirect()->route('modelovehiculo.index')
            ->with('success', 'Modelo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $modelo = ModeloVehiculo::findOrFail($id);

        return view('ver', compact('modelo'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $modelo = ModeloVehiculo::find($id); // Use find instead of findOrFail

        if (!$modelo) {
            // Redirige a una página de error o muestra un mensaje si el modelo no se encuentra
            return redirect()->route('modelovehiculo.index')->with('error', 'Modelo no encontrado.');
        }

        return view('modelovehiculo.edit', compact('modelo'));
    }



    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $modelo = ModeloVehiculo::findOrFail($id);

        // Validación de los datos recibidos
        $request->validate([
            'nombre' => 'string|max:255',
            'tipo_combustible' => 'integer|exists:tipo_combustible,id',
            'capacidad_combustible' => 'numeric',
            'tipo_caja' => 'integer|exists:tipo_caja,id',
            'equipamiento_vehiculo' => 'array',
            'tipo_itv' => 'integer|exists:tipo_itv,id',
            'grafico_vehiculo_id' => 'integer|exists:grafico_vehiculo,id',
            'grupo' => 'integer|exists:tipo_vehiculos,id',
            'marca' => 'integer|exists:marca_vehiculo,id',
            'tipo_vehiculo' => 'nullable|string|max:255',
        ]);

        // Actualización del registro de modelo
        $modelo->update([
            'nombre' => $request->input('nombre'),
            'grupo' => $request->input('grupo') ?? [],  // Deja que Laravel maneje la conversión a JSON
            'tipo_combustible' => $request->input('tipo_combustible'),
            'capacidad_combustible' => $request->input('capacidad_combustible'),
            'tipo_caja' => $request->input('tipo_caja'),
            'equipamiento_vehiculo' => $request->input('equipamiento_vehiculo') ?? [],
            'tipo_itv' => $request->input('tipo_itv'),
            'grafico_vehiculo_id' => $request->input('grafico_vehiculo_id'),
            'marca' => $request->input('marca'),
            'tipo_vehiculo' => $request->input('tipo_vehiculo'),
        ]);

        return redirect()->route('modelovehiculo.index')
            ->with('success', 'Modelo actualizado exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $modelo = ModeloVehiculo::find($id); // Buscar el grupo por ID

        if (!$modelo) {
            return redirect()->route('modelovehiculo.index')->with('error', 'Modelo no encontrado.');
        }

        $modelo->delete();
        return redirect()->route('modelovehiculo.index')->with('success', 'Modelo de vehículo eliminado exitosamente.');
    }
}
