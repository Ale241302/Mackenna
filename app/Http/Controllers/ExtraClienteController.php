<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExtraCliente;
use App\Models\UserGroup;
use App\Models\TipoVehiculo;


class ExtraClienteController extends Controller
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

        // Consulta las tarifas con el filtro de búsqueda
        $extraQuery = ExtraCliente::query();

        if (!empty($search)) {
            $extraQuery->where('nombre', 'like', '%' . $search . '%');
        }

        $extras = $extraQuery->get();

        // Recupera todos los tipos de vehículos
        $tipovehiculos = TipoVehiculo::all()->keyBy('id');
        // Asegúrate de tener un modelo Permiso o ajustar esta línea según tu implementación
        $permisos = []; // Cambia esto según cómo obtienes los permisos

        return view('extracliente.index', compact('extras', 'search', 'permisos', 'permisosUsuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('extracliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:30',
            'porcentaje' => 'required|numeric|between:0,999.99',

        ]);

        $porcentaje = str_replace(',', '.', $request->input('porcentaje'));

        // Crea el registro de tarifa
        ExtraCliente::create([
            'nombre' => $request->input('nombre'),
            'porcentaje' => $porcentaje,

        ]);

        return redirect()->route('extracliente.index')
            ->with('success', 'Extra creada exitosamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraCliente $tarifa)
    {
        return view('extra.show', compact('extra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtraCliente $tarifa)
    {
        return view('extracliente.edit', compact('extra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'porcentaje' => 'required|numeric|between:0,999.99',

        ]);

        $porcentaje = str_replace(',', '.', $request->input('porcentaje'));
        $extra = ExtraCliente::findOrFail($id);
        // Actualización del registro de tarifa
        $extra->update([
            'nombre' => $request->input('nombre'),
            'porcentaje' => $porcentaje,

        ]);

        return redirect()->route('extracliente.index')
            ->with('success', 'Extra actualizada exitosamente.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $extra = ExtraCliente::findOrFail($id);
        $extra->delete();

        return redirect()->route('extracliente.index')
            ->with('success', 'Sucursal eliminada con éxito.');
    }
}
