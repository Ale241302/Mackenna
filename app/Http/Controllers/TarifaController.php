<?php

namespace App\Http\Controllers;

use App\Models\Tarifa;
use App\Models\UserGroup;
use App\Models\TipoVehiculo;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class TarifaController extends Controller
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
        $tarifasQuery = Tarifa::query();

        if (!empty($search)) {
            $tarifasQuery->where('nombre', 'like', '%' . $search . '%')
                ->orWhere('codigo', 'like', '%' . $search . '%')
                ->orWhereHas('sucursal', function ($query) use ($search) {
                    $query->where('nombre', 'like', '%' . $search . '%');
                });
        }

        $tarifas = $tarifasQuery->get();

        // Recupera todos los tipos de vehículos
        $tipovehiculos = TipoVehiculo::all()->keyBy('id');
        $sucursal = Sucursal::all()->keyBy('id');

        // Asegúrate de tener un modelo Permiso o ajustar esta línea según tu implementación
        $permisos = []; // Cambia esto según cómo obtienes los permisos

        return view('tarifas.index', compact('tarifas', 'search', 'permisos', 'permisosUsuario', 'tipovehiculos', 'sucursal'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarifas.create');
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
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255',
            'tipo_vehiculo' => 'array',
            'tipo_vehiculo.*' => 'exists:tipo_vehiculos,id',
            'sucursal' => 'required|integer|exists:sucursales,id',

        ]);



        // Convertir los valores de precios e incrementos de coma a punto
        $precios = $request->input('precios', []);
        $incrementos = $request->input('incrementos', []);
        $precio_hora = $request->input('precio_hora', []);
        $incremento_hora = $request->input('incremento_hora', []);
        $precio_kms = $request->input('precio_kms', []);
        $incremento_kms = $request->input('incremento_kms', []);
        $precio_dia = $request->input('precio_dia', []);
        $incremento_dia = $request->input('incremento_dia', []);
        $precio_bimensual = $request->input('precio_bimensual', []);
        $incremento_bimensual = $request->input('incremento_bimensual', []);
        $precio_mensual = $request->input('precio_mensual', []);
        $incremento_mensual = $request->input('incremento_mensual', []);
        $precio_semanal = $request->input('precio_semanal', []);
        $incremento_semanal = $request->input('incremento_semanal', []);

        //Rango KMS
        $precios_kms_fijo = $request->input('precios_kms_fijo');
        $incrementos_kms_fijo = $request->input('incrementos_kms_fijo');
        $precios_kms_hora = $request->input('precios_kms_hora');
        $incrementos_kms_hora = $request->input('incrementos_kms_hora');
        $precios_kms_dia = $request->input('precios_kms_dia');
        $incrementos_kms_dia = $request->input('incrementos_kms_dia');
        $precios_kmss = $request->input('precios_kms');
        $incrementos_kmss = $request->input('incrementos_kms');
        $precios_kms_bimensual = $request->input('precios_kms_bimensual');
        $incrementos_kms_bimensual = $request->input('incrementos_kms_bimensual');
        $precios_kms_mensual = $request->input('precios_kms_mensual');
        $incrementos_kms_mensual = $request->input('incrementos_kms_mensual');
        $precios_kms_semanal = $request->input('precios_kms_semanal');
        $incrementos_kms_semanal = $request->input('incrementos_kms');

        //Recargos
        $recargo_fijo = $request->input('recargo_fijo');
        $recargo_bimensual = $request->input('recargo_bimensual');
        $recargo_mensual = $request->input('recargo_mensual');
        $recargo_semanal = $request->input('recargo_semanal');
        $recargo_dia = $request->input('recargo_dia');
        $recargo_kms = $request->input('recargo_kms');
        $recargo_hora = $request->input('recargo_hora');


        foreach ($precios as $key => $precio) {
            $precios[$key] = str_replace(',', '.', $precio);
        }

        foreach ($incrementos as $key => $incremento) {
            $incrementos[$key] = str_replace(',', '.', $incremento);
        }
        foreach ($precio_hora as $key => $precio_horas) {
            $precio_hora[$key] = str_replace(',', '.', $precio_horas);
        }

        foreach ($incremento_hora as $key => $incremento_horas) {
            $incremento_hora[$key] = str_replace(',', '.', $incremento_horas);
        }
        foreach ($precio_kms as $key => $precios_kms) {
            $precio_kms[$key] = str_replace(',', '.', $precios_kms);
        }

        foreach ($incremento_kms as $key => $incrementos_kms) {
            $incremento_kms[$key] = str_replace(',', '.', $incrementos_kms);
        }
        foreach ($precio_dia as $key => $precio_dias) {
            $precio_dia[$key] = str_replace(',', '.', $precio_dias);
        }

        foreach ($incremento_dia as $key => $incremento_dias) {
            $incremento_dia[$key] = str_replace(',', '.', $incremento_dias);
        }
        foreach ($precio_bimensual as $key => $precios_bimensual) {
            $precio_bimensual[$key] = str_replace(',', '.', $precios_bimensual);
        }

        foreach ($incremento_bimensual as $key => $incrementos_bimensual) {
            $incremento_bimensual[$key] = str_replace(',', '.', $incrementos_bimensual);
        }

        foreach ($precio_mensual as $key => $precios_mensual) {
            $precio_mensual[$key] = str_replace(',', '.', $precios_mensual);
        }

        foreach ($incremento_mensual as $key => $incrementos_mensual) {
            $incremento_mensual[$key] = str_replace(',', '.', $incrementos_mensual);
        }

        foreach ($precio_semanal as $key => $precios_semanal) {
            $precio_semanal[$key] = str_replace(',', '.', $precios_semanal);
        }

        foreach ($incremento_semanal as $key => $incrementos_semanal) {
            $incremento_semanal[$key] = str_replace(',', '.', $incrementos_semanal);
        }



        // Crea el registro de tarifa
        Tarifa::create([
            'nombre' => $request->input('nombre'),
            'sucursal' => $request->input('sucursal'),
            'codigo' => $request->input('codigo'),
            'tipo_vehiculo' => json_encode($request->input('tipo_vehiculo')), // Convierte el array en una cadena JSON
            'precio' => json_encode($precios), // Convierte el array en una cadena JSON
            'incremento' => json_encode($incrementos), // Convierte el array en una cadena JSON
            'incremento_hora' => json_encode($incremento_hora),
            'incremento_dia' => json_encode($incremento_dia),
            'incremento_bimensual' => json_encode($incremento_bimensual),
            'incremento_mensual' => json_encode($incremento_mensual),
            'incremento_semanal' => json_encode($incremento_semanal),
            'incremento_kms2' => json_encode($incremento_kms),
            'precio_kms' => json_encode($precio_kms),
            'precio_hora' => json_encode($precio_hora),
            'precio_dia' => json_encode($precio_dia),
            'precio_bimensual' => json_encode($precio_bimensual),
            'precio_mensual' => json_encode($precio_mensual),
            'precio_semanal' => json_encode($precio_semanal),
            'precios_kms_fijo' => $precios_kms_fijo,
            'precios_kms_hora' => $precios_kms_hora,
            'precios_kms_dia' => $precios_kms_dia,
            'precios_kms' => $precios_kmss,
            'incrementos_kms_fijo' => $incrementos_kms_fijo,
            'incrementos_kms_hora' => $incrementos_kms_hora,
            'incrementos_kms_dia' => $incrementos_kms_dia,
            'incrementos_kms' => $incrementos_kmss,
            'precios_kms_bimensual' => $precios_kms_bimensual,
            'precios_kms_mensual' => $precios_kms_mensual,
            'precios_kms_semanal' => $precios_kms_semanal,
            'incrementos_kms_bimensual' => $incrementos_kms_bimensual,
            'incrementos_kms_mensual' => $incrementos_kms_mensual,
            'incrementos_kms_semanal' => $incrementos_kms_semanal,
            'recargo_fijo' => $recargo_fijo,
            'recargo_bimensual' => $recargo_bimensual,
            'recargo_mensual' => $recargo_mensual,
            'recargo_semanal' => $recargo_semanal,
            'recargo_dia' => $recargo_dia,
            'recargo_kms' => $recargo_kms,
            'recargo_hora' => $recargo_hora,
        ]);


        return redirect()->route('tarifas.index')
            ->with('success', 'Tarifa creada exitosamente.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarifa $tarifa)
    {
        return view('tarifas.show', compact('tarifa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    // Ejemplo de controlador
    public function edit($id)
    {
        $tarifa = Tarifa::findOrFail($id);
        $tipovehiculos = TipoVehiculo::all(); // Asegúrate de obtener todos los vehículos o los que necesites

        return view('tarifas.edit', compact('tarifa', 'tipovehiculos'));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarifa $tarifa)
    {
        // Validación de los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:255',
            'tipo_vehiculo' => 'array',
            'tipo_vehiculo.*' => 'exists:tipo_vehiculos,id',
            'sucursal' => 'required|integer|exists:sucursales,id',
        ]);

        // Obtener los valores de precios e incrementos desde el request
        $precios = $request->input('precios', []);
        $incrementos = $request->input('incrementos', []);
        $precio_hora = $request->input('precio_hora', []);
        $incremento_hora = $request->input('incremento_hora', []);
        $precio_kms = $request->input('precio_kms', []);
        $incremento_kms2 = $request->input('incremento_kms2', []);
        $precio_dia = $request->input('precio_dia', []);
        $incremento_dia = $request->input('incremento_dia', []);
        $precio_bimensual = $request->input('precio_bimensual', []);
        $incremento_bimensual = $request->input('incremento_bimensual', []);
        $precio_mensual = $request->input('precio_mensual', []);
        $incremento_mensual = $request->input('incremento_mensual', []);
        $precio_semanal = $request->input('precio_semanal', []);
        $incremento_semanal = $request->input('incremento_semanal', []);
        //KMS
        $precios_kms_fijo = $request->input('precios_kms_fijo');
        $incrementos_kms_fijo = $request->input('incrementos_kms_fijo');
        $precios_kms_hora = $request->input('precios_kms_hora');
        $incrementos_kms_hora = $request->input('incrementos_kms_hora');
        $precios_kms_dia = $request->input('precios_kms_dia');
        $incrementos_kms_dia = $request->input('incrementos_kms_dia');
        $precios_kmss = $request->input('precios_kms');
        $incrementos_kmss = $request->input('incrementos_kms');
        $precios_kms_bimensual = $request->input('precios_kms_bimensual');
        $incrementos_kms_bimensual = $request->input('incrementos_kms_bimensual');
        $precios_kms_mensual = $request->input('precios_kms_mensual');
        $incrementos_kms_mensual = $request->input('incrementos_kms_mensual');
        $precios_kms_semanal = $request->input('precios_kms_semanal');
        $incrementos_kms_semanal = $request->input('incrementos_kms');
        //Recargos
        $recargo_fijo = $request->input('recargo_fijo');
        $recargo_bimensual = $request->input('recargo_bimensual');
        $recargo_mensual = $request->input('recargo_mensual');
        $recargo_semanal = $request->input('recargo_semanal');
        $recargo_dia = $request->input('recargo_dia');
        $recargo_kms = $request->input('recargo_kms');
        $recargo_hora = $request->input('recargo_hora');


        // Convertir los valores de precios e incrementos de coma a punto
        foreach ($precios as $key => $precio) {
            $precios[$key] = str_replace(',', '.', $precio);
        }

        foreach ($incrementos as $key => $incremento) {
            $incrementos[$key] = str_replace(',', '.', $incremento);
        }
        foreach ($precio_hora as $key => $precio_horas) {
            $precio_hora[$key] = str_replace(',', '.', $precio_horas);
        }

        foreach ($incremento_hora as $key => $incremento_horas) {
            $incremento_hora[$key] = str_replace(',', '.', $incremento_horas);
        }
        foreach ($precio_kms as $key => $precios_kms) {
            $precio_kms[$key] = str_replace(',', '.', $precios_kms);
        }

        foreach ($incremento_kms2 as $key => $incrementos_kms2) {
            $incremento_kms2[$key] = str_replace(',', '.', $incrementos_kms2);
        }
        foreach ($precio_dia as $key => $precio_dias) {
            $precio_dia[$key] = str_replace(',', '.', $precio_dias);
        }

        foreach ($incremento_dia as $key => $incremento_dias) {
            $incremento_dia[$key] = str_replace(',', '.', $incremento_dias);
        }
        foreach ($precio_bimensual as $key => $precios_bimensual) {
            $precio_bimensual[$key] = str_replace(',', '.', $precios_bimensual);
        }

        foreach ($incremento_bimensual as $key => $incrementos_bimensual) {
            $incremento_bimensual[$key] = str_replace(',', '.', $incrementos_bimensual);
        }

        foreach ($precio_mensual as $key => $precios_mensual) {
            $precio_mensual[$key] = str_replace(',', '.', $precios_mensual);
        }

        foreach ($incremento_mensual as $key => $incrementos_mensual) {
            $incremento_mensual[$key] = str_replace(',', '.', $incrementos_mensual);
        }

        foreach ($precio_semanal as $key => $precios_semanal) {
            $precio_semanal[$key] = str_replace(',', '.', $precios_semanal);
        }

        foreach ($incremento_semanal as $key => $incrementos_semanal) {
            $incremento_semanal[$key] = str_replace(',', '.', $incrementos_semanal);
        }

        // Actualización del registro de tarifa
        $tarifa->update([
            'nombre' => $request->input('nombre'),
            'sucursal' => $request->input('sucursal'),
            'codigo' => $request->input('codigo'),
            'tipo_vehiculo' => json_encode($request->input('tipo_vehiculo')), // Convierte el array en una cadena JSON
            'precio' => json_encode($precios), // Convierte el array en una cadena JSON
            'incremento' => json_encode($incrementos), // Convierte el array en una cadena JSON
            'incremento_hora' => json_encode($incremento_hora),
            'incremento_dia' => json_encode($incremento_dia),
            'incremento_bimensual' => json_encode($incremento_bimensual),
            'incremento_mensual' => json_encode($incremento_mensual),
            'incremento_semanal' => json_encode($incremento_semanal),
            'incremento_kms2' => json_encode($incremento_kms2),
            'precio_kms' => json_encode($precio_kms),
            'precio_hora' => json_encode($precio_hora),
            'precio_dia' => json_encode($precio_dia),
            'precio_bimensual' => json_encode($precio_bimensual),
            'precio_mensual' => json_encode($precio_mensual),
            'precio_semanal' => json_encode($precio_semanal),
            'precios_kms_fijo' => $precios_kms_fijo,
            'precios_kms_hora' => $precios_kms_hora,
            'precios_kms_dia' => $precios_kms_dia,
            'precios_kms' => $precios_kmss,
            'incrementos_kms_fijo' => $incrementos_kms_fijo,
            'incrementos_kms_hora' => $incrementos_kms_hora,
            'incrementos_kms_dia' => $incrementos_kms_dia,
            'incrementos_kms' => $incrementos_kmss,
            'precios_kms_bimensual' => $precios_kms_bimensual,
            'precios_kms_mensual' => $precios_kms_mensual,
            'precios_kms_semanal' => $precios_kms_semanal,
            'incrementos_kms_bimensual' => $incrementos_kms_bimensual,
            'incrementos_kms_mensual' => $incrementos_kms_mensual,
            'incrementos_kms_semanal' => $incrementos_kms_semanal,
            'recargo_fijo' => $recargo_fijo,
            'recargo_bimensual' => $recargo_bimensual,
            'recargo_mensual' => $recargo_mensual,
            'recargo_semanal' => $recargo_semanal,
            'recargo_dia' => $recargo_dia,
            'recargo_kms' => $recargo_kms,
            'recargo_hora' => $recargo_hora,
        ]);

        return redirect()->route('tarifas.index')
            ->with('success', 'Tarifa actualizada exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarifa $tarifa)
    {
        $tarifa->delete();

        return redirect()->route('tarifas.index')
            ->with('success', 'Tarifa eliminada exitosamente.');
    }
    public function getTarifasBySucursal(Request $request)
    {
        $sucursalId = $request->input('sucursal');

        // Obtener tarifas donde la sucursal es igual a $sucursalId o igual a 13
        $tarifas = Tarifa::where('sucursal', $sucursalId)
            ->orWhere('sucursal', 13)
            ->get();

        return response()->json(['tarifas' => $tarifas]);
    }
}
