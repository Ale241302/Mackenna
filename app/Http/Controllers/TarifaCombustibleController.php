<?php

namespace App\Http\Controllers;

use App\Models\TarifaCliente;
use App\Models\UserGroup;
use App\Models\TipoVehiculo;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class TarifaCombustibleController extends Controller
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
        $tarifasQuery = TarifaCliente::query();

        if (!empty($search)) {
            $tarifasQuery->where('nombre', 'like', '%' . $search . '%')
                ->orWhere('sucursal', function ($query) use ($search) {
                    $query->where('nombre', 'like', '%' . $search . '%');
                });
        }

        $tarifas = $tarifasQuery->get();

        // Recupera todos los tipos de vehículos
        $tipovehiculos = TipoVehiculo::all()->keyBy('id');
        $sucursal = Sucursal::all()->keyBy('id');
        // Asegúrate de tener un modelo Permiso o ajustar esta línea según tu implementación
        $permisos = []; // Cambia esto según cómo obtienes los permisos

        return view('tarifacombustible.index', compact('tarifas', 'search', 'permisos', 'permisosUsuario', 'sucursal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarifacombustible.create');
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
            'sucursal' => 'required|integer|exists:sucursales,id',
            'proveedor' => 'required|integer|exists:proveedores,id',

        ]);

        $coste = $request->input('coste', []);
        $pvp = $request->input('pvp', []);
        $iva = $request->input('iva', []);

        $cantidad_comprada = $request->input('cantidad_comprada', []);


        foreach ($coste as $key => $costes) {
            $coste[$key] = str_replace(',', '.', $costes);
        }
        foreach ($pvp as $key => $pvps) {
            $pvp[$key] = str_replace(',', '.', $pvps);
        }

        foreach ($iva as $key => $ivas) {
            $iva[$key] = str_replace(',', '.', $ivas);
        }


        foreach ($cantidad_comprada as $key => $cantidad_compradas) {
            $cantidad_comprada[$key] = str_replace(',', '.', $cantidad_compradas);
        }

        // Crea el registro de tarifa
        TarifaCliente::create([
            'nombre' => $request->input('nombre'),
            'proveedor' => $request->input('proveedor'),
            'sucursal' => $request->input('sucursal'),
            'combustible' => json_encode($request->input('combustible')),
            'coste' => json_encode($coste), // Convierte el array en una cadena JSON
            'pvp' => json_encode($pvp), // Convierte el array en una cadena JSON
            'iva' => json_encode($iva),
            'cantidad_existente' => json_encode($cantidad_comprada),
            'cantidad_comprada' => json_encode($cantidad_comprada),

        ]);

        return redirect()->route('tarifacombustible.index')
            ->with('success', 'Tarifa creada exitosamente.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function show(TarifaCliente $tarifa)
    {
        return view('tarifacombustible.show', compact('tarifa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function edit(TarifaCliente $tarifa)
    {
        return view('tarifacombustible.edit', compact('tarifa'));
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
            'sucursal' => 'required|integer|exists:sucursales,id',
        ]);

        // Obtener los datos del formulario
        $coste = $request->input('coste', []);
        $pvp = $request->input('pvp', []);
        $iva = $request->input('iva', []);
        $cantidad_existente = $request->input('cantidad_existente', []);
        $cantidad_comprada = $request->input('cantidad_comprada', []);
        $capacidad = $request->input('capacidad', []);
        $capacidad2 = $request->input('capacidad', []);

        // Convertir los valores en formato numérico
        foreach ($coste as $key => $costes) {
            $coste[$key] = str_replace(',', '.', $costes);
        }
        foreach ($pvp as $key => $pvps) {
            $pvp[$key] = str_replace(',', '.', $pvps);
        }
        foreach ($iva as $key => $ivas) {
            $iva[$key] = str_replace(',', '.', $ivas);
        }
        foreach ($cantidad_comprada as $key => $cantidad_compradas) {
            $cantidad_comprada[$key] = str_replace(',', '.', $cantidad_compradas) ?: '0';
        }
        foreach ($cantidad_existente as $key => $cantidad_existentes) {
            $cantidad_existente[$key] = str_replace(',', '.', $cantidad_existentes);
        }
        foreach ($capacidad as $key => $capacidads) {
            $capacidad[$key] = str_replace(',', '.', $capacidads);
        }
        foreach ($capacidad2 as $key => $capacidads2) {
            $capacidad2[$key] = str_replace(',', '.', $capacidads2);
        }

        // Realizar la suma de cantidad existente y cantidad comprada solo si cantidad_comprada tiene valor
        $cantidad_existente2 = [];
        foreach ($cantidad_existente as $key => $cantidad_existentes) {
            // Reemplazar puntos y convertir a float
            $cantidad_existente_float = (float) str_replace('.', '', $cantidad_existentes);

            // Inicializar con cantidad existente actual
            $cantidad_existente2[$key] = number_format($cantidad_existente_float, 3, '.', ',');

            // Sumar solo si cantidad_comprada tiene un valor numérico
            if (isset($cantidad_comprada[$key]) && is_numeric($cantidad_comprada[$key]) && $cantidad_comprada[$key] > 0) {
                $cantidad_existente2[$key] = number_format(floatval($cantidad_existente2[$key]) + floatval($cantidad_comprada[$key]), 3, '.', ',');
            } else {
                // If $cantidad_comprada is empty, keep the original value of $cantidad_existente
                $cantidad_existente2[$key] = $cantidad_existente[$key];
            }
            // Verificar si cantidad_existente supera la capacidad
            if ($cantidad_existente2[$key] > $capacidad[$key]) {
                // Enviar la variable de sesión para abrir el modal y regresar con errores
                return back()
                    ->withInput($request->all())
                    ->withErrors(['msg' => 'La cantidad existente no puede ser mayor que la capacidad.'])
                    ->with('tarifacombustible.edit', true) // Añadir esto para abrir el modal
                    ->with('tarifa_id', $id); // Añadir el ID de la tarifa a la sesión
            }
        }

        // Obtener el registro de tarifa a actualizar
        $tarifa = TarifaCliente::findOrFail($id);

        // Actualización del registro de tarifa
        $tarifa->update([
            'nombre' => $request->input('nombre'),
            'proveedor' => $request->input('proveedor'),
            'sucursal' => $request->input('sucursal'),
            'combustible' => json_encode($request->input('combustible')),
            'coste' => json_encode($coste),
            'pvp' => json_encode($pvp),
            'iva' => json_encode($iva),
            'cantidad_existente' => json_encode($cantidad_existente2),
            'cantidad_comprada' => json_encode($cantidad_comprada),
            'capacidad' => json_encode($capacidad2),
        ]);

        return redirect()->route('tarifacombustible.index')
            ->with('success', 'Tarifa actualizada exitosamente.');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $tarifa = TarifaCliente::findOrFail($id);
        $tarifa->delete();

        return redirect()->route('tarifacombustible.index')
            ->with('success', 'Sucursal eliminada con éxito.');
    }
}
