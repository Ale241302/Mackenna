<?php

namespace App\Http\Controllers;

use App\Models\RegistroVehiculo;
use Illuminate\Http\Request;
use App\Models\UserGroup;
use App\Models\MarcaVehiculo;
use App\Models\GrupoVehiculo;
use App\Models\QrCodes;
use App\Models\TipoVehiculo;
use App\Models\TipoCombustible;
use App\Models\TipoCaja;
use App\Models\Sucursal;
use App\Models\ModeloVehiculo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;



class RegistroVehiculoController extends Controller
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
        $registro = RegistroVehiculo::query();

        if (!empty($search)) {
            $registro->where('placa', 'like', '%' . $search . '%');
        }

        $registros = $registro->get();
        $modelos = ModeloVehiculo::all()->keyBy('id');
        $grupos = GrupoVehiculo::all()->keyBy('id');
        $marcas = MarcaVehiculo::all()->keyBy('id');
        return view('registrovehiculo.index', [
            'registros' => $registros,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario,
            'modelos' => $modelos,
            'grupos' => $grupos,
            'marcas' => $marcas,

            // Pasa los permisos a la vista
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mostrar el formulario para crear un nuevo registro de vehículo
        return view('registrovehiculo.create');
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
        $validator = Validator::make($request->all(), [
            'placa' => 'required|string|max:255|unique:registro_vehiculo,placa',
            'chasis' => 'required|string|max:255|unique:registro_vehiculo,chasis',
            'kilometros' => 'required|integer',
            'fecha' => 'nullable|date',
            'color' => 'nullable|string|max:255',
            'modelo' => 'required|string|max:255',
            'tipo_combustible' => 'nullable|string|max:255',
            'capacidad_combustible' => 'nullable|string|max:255',
            'tipo_caja' => 'nullable|string|max:255',
            'tipo_vehiculo' => 'nullable|string|max:255',
            'grupo' => 'nullable|string|max:255',
            'marca' => 'nullable|string|max:255',
            'notas' => 'nullable|string|max:500',
            'equipamiento_vehiculo' => 'nullable|array',
            'uso' => 'nullable|string|max:255',
            'propietario' => 'nullable|string|max:255',
            'sucursal' => 'nullable|string|max:255',
            'deposito' => 'nullable|string|max:255',
            'compania_seguro' => 'nullable|string|max:255',
            'riesgo_seguro' => 'nullable|string|max:255',
            'poliza_seguro' => 'nullable|string|max:255',
            'aseguradora_seguro' => 'nullable|string|max:255',
            'asistencia_seguro' => 'nullable|string|max:255',
            'telefono_seguro' => 'nullable|string|max:255',
            'aviso' => 'nullable|string|max:500',
            'documentos2.*' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png,webp,gif|max:20480',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('createRegistroModal', true);
        }

        // Variables para almacenar las rutas de archivos
        $filePaths = [];

        // Manejo de archivos subidos
        if ($request->hasFile('documentos2')) {
            // Recuperar los archivos subidos
            $files = $request->file('documentos2');

            // Procesar y almacenar los archivos nuevos
            foreach ($files as $file) {
                // Asegúrate de que el archivo sea un archivo válido
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('public/graficos', $fileName);
                    $filePaths[] = $filePath; // Guardar la ruta del archivo
                }
            }

            // Convertir las rutas de los archivos a JSON
            $documentos2 = json_encode($filePaths);
        } else {
            $documentos2 = json_encode([]);
        }

        // Crear el registro
        RegistroVehiculo::create([
            'placa' => $request->input('placa'),
            'chasis' => $request->input('chasis'),
            'kilometros' => $request->input('kilometros'),
            'fecha' => $request->input('fecha'),
            'color' => $request->input('color'),
            'modelo' => $request->input('modelo'),
            'tipo_combustible' => $request->input('tipo_combustible'),
            'capacidad_combustible' => $request->input('capacidad_combustible'),
            'tipo_caja' => $request->input('tipo_caja'),
            'tipo_vehiculo' => $request->input('tipo_vehiculo'),
            'grupo' => $request->input('grupo'),
            'marca' => $request->input('marca'),
            'uso' => $request->input('uso'),
            'notas' => $request->input('notas'),
            'propietario' => $request->input('propietario'),
            'sucursal' => $request->input('sucursal'),
            'sucursal_actual' => $request->input('sucursal'),
            'deposito' => $request->input('deposito'),
            'compania_seguro' => $request->input('compania_seguro'),
            'riesgo_seguro' => $request->input('riesgo_seguro'),
            'poliza_seguro' => $request->input('poliza_seguro'),
            'aseguradora_seguro' => $request->input('aseguradora_seguro'),
            'asistencia_seguro' => $request->input('asistencia_seguro'),
            'telefono_seguro' => $request->input('telefono_seguro'),
            'aviso' => $request->input('aviso'),
            'equipamiento_vehiculo' => $request->input('equipamiento_vehiculo') ?? [],
            'documentos' => $documentos2,
            'estado' => $request->get('estado', 'LIBRE'),
        ]);

        return redirect()->route('registrovehiculo.index')
            ->with('success', 'Modelo creado exitosamente.');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegistroVehiculo  $registroVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registro = RegistroVehiculo::findOrFail($id);

        return view('ver', compact('registro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegistroVehiculo  $registroVehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registro = RegistroVehiculo::find($id);

        if ($registro) {
            // Decodificar el JSON almacenado en la base de datos para enviarlo al cliente
            $registro->equipamiento_vehiculo = $registro->equipamiento_vehiculo;

            return response()->json($registro);
        } else {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegistroVehiculo  $registroVehiculo
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $registroVehiculo = RegistroVehiculo::findOrFail($id);

        // Validación de los datos recibidos
        $request->validate([
            'placa' => 'nullable|string|max:255|unique:registro_vehiculo,placa,' . $id,
            'chasis' => 'nullable|string|max:255|unique:registro_vehiculo,chasis,' . $id,
            'kilometros' => 'nullable|integer',
            'fecha' => 'nullable|date',
            'color' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'tipo_combustible' => 'nullable|string|max:255',
            'capacidad_combustible' => 'nullable|string|max:255',
            'tipo_caja' => 'nullable|string|max:255',
            'tipo_vehiculo' => 'nullable|string|max:255',
            'grupo' => 'nullable|string|max:255',
            'marca' => 'nullable|string|max:255',
            'notas' => 'nullable|string|max:500',
            'equipamiento_vehiculo' => 'nullable|array',
            'uso' => 'nullable|string|max:255',
            'propietario' => 'nullable|string|max:255',
            'sucursal' => 'nullable|string|max:255',
            'deposito' => 'nullable|string|max:255',
            'compania_seguro' => 'nullable|string|max:255',
            'riesgo_seguro' => 'nullable|string|max:255',
            'poliza_seguro' => 'nullable|string|max:255',
            'aseguradora_seguro' => 'nullable|string|max:255',
            'asistencia_seguro' => 'nullable|string|max:255',
            'telefono_seguro' => 'nullable|string|max:255',
            'aviso' => 'nullable|string|max:500',
            'documentos.*' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png,webp,gif|max:20480',
        ]);

        // Recuperar los nombres de archivos antiguos
        $oldFileNames = json_decode($registroVehiculo->documentos, true) ?? [];

        // Variables para almacenar los nombres de archivos nuevos
        $newFileNames = [];

        // Manejo de archivos subidos
        if ($request->hasFile('documentos')) {
            // Recuperar los archivos subidos
            $files = $request->file('documentos');

            // Procesar y almacenar los archivos nuevos
            foreach ($files as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/graficos', $fileName);
                $newFileNames[] = $fileName;
            }
        }

        // Fusionar los nombres de archivos antiguos y nuevos
        $allFileNames = array_merge($oldFileNames, $newFileNames);

        // Actualización del registro de modelo
        $registroVehiculo->update([
            'placa' => $request->input('placa'),
            'chasis' => $request->input('chasis'),
            'kilometros' => $request->input('kilometros'),
            'fecha' => $request->input('fecha'),
            'color' => $request->input('color'),
            'modelo' => $request->input('modelo'),
            'tipo_vehiculo' => $request->input('tipo_vehiculo'),
            'capacidad_combustible' => $request->input('capacidad_combustible'),
            'tipo_caja' => $request->input('tipo_caja'),
            'tipo_combustible' => $request->input('tipo_combustible'),
            'grupo' => $request->input('grupo'),
            'marca' => $request->input('marca'),
            'uso' => $request->input('uso'),
            'notas' => $request->input('notas'),
            'propietario' => $request->input('propietario'),
            'sucursal' => $request->input('sucursal'),
            'sucursal_actual' => $request->input('sucursal'),
            'deposito' => $request->input('deposito'),
            'compania_seguro' => $request->input('compania_seguro'),
            'riesgo_seguro' => $request->input('riesgo_seguro'),
            'poliza_seguro' => $request->input('poliza_seguro'),
            'aseguradora_seguro' => $request->input('aseguradora_seguro'),
            'asistencia_seguro' => $request->input('asistencia_seguro'),
            'telefono_seguro' => $request->input('telefono_seguro'),
            'aviso' => $request->input('aviso'),
            'equipamiento_vehiculo' => $request->input('equipamiento_vehiculo2') ?? [],
            'documentos' => json_encode($allFileNames), // Guardar el JSON de nombres de archivos
        ]);
        // Recuperar los nombres relacionados en lugar de los IDs
        $ModeloVehiculo = ModeloVehiculo::find($request->input('modelo'));
        $TipoVehiculo = TipoVehiculo::find($request->input('tipo_vehiculo'));
        $CombustibleVehiculo = TipoCombustible::find($request->input('tipo_combustible'));
        $CajaVehiculo = TipoCaja::find($request->input('tipo_caja'));
        $GrupoVehiculo = GrupoVehiculo::find($request->input('grupo'));
        $MarcaVehiculo = MarcaVehiculo::find($request->input('marca'));
        $SucursalVehiculo = Sucursal::find($request->input('sucursal'));

        // Preparar datos de vehiculo
        $vehiculoData = [
            'placa' => $request->input('placa'),
            'modelo' => $ModeloVehiculo ? $ModeloVehiculo->nombre : $request->input('modelo'),
            'capacidad_combustible' => $request->input('capacidad_combustible'),
            'tipo_vehiculo' => $TipoVehiculo ? $TipoVehiculo->nombre : $request->input('tipo_vehiculo'),
            'tipo_caja' => $CajaVehiculo ? $CajaVehiculo->nombre : $request->input('tipo_caja'),
            'tipo_combustible' => $CombustibleVehiculo ? $CombustibleVehiculo->nombre : $request->input('tipo_combustible'),
            'chasis' => $request->input('chasis'),
            'color' => $request->input('color'),
            'grupo' => $GrupoVehiculo ? $GrupoVehiculo->nombre : $request->input('grupo'),
            'marca' => $MarcaVehiculo ? $MarcaVehiculo->nombre : $request->input('marca'),
            'sucursal' => $SucursalVehiculo ? $SucursalVehiculo->nombre : $request->input('sucursal'),
        ];

        // Buscar si existe un registro con la misma placa en el modelo QrCodes
        $qrCode = QrCodes::where('placa', $request->input('placa'))->first();

        // Si existe, actualizar los campos correspondientes
        if ($qrCode) {
            $qrCode->update($vehiculoData);
        }

        return redirect()->route('registrovehiculo.index')
            ->with('success', 'Registro de vehículo actualizado exitosamente.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegistroVehiculo  $registroVehiculo
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $registroVehiculo = RegistroVehiculo::findOrFail($id); // Buscar el grupo por ID

        if (!$registroVehiculo) {
            return redirect()->route('registrovehiculo.index')->with('error', 'registro vehiculo no encontrado.');
        }
        if ($registroVehiculo->documentos) {
            $filePath = storage_path('app/public/graficos/' . $registroVehiculo->documentos);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }


        $registroVehiculo->delete();
        return redirect()->route('registrovehiculo.index')->with('success', 'registro vehiculo de vehículo eliminado exitosamente.');
    }
    public function deleteFile(Request $request)
    {
        $file = $request->input('file');
        $id = $request->input('id');

        $registroVehiculo = RegistroVehiculo::findOrFail($id);
        $documentos = json_decode($registroVehiculo->documentos, true);

        if (($key = array_search($file, $documentos)) !== false) {
            // Elimina el archivo del sistema de archivos
            Storage::delete("public/graficos/{$file}");

            // Elimina el archivo de la lista de documentos
            unset($documentos[$key]);
            $registroVehiculo->documentos = json_encode(array_values($documentos));
            $registroVehiculo->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Archivo no encontrado.']);
    }
    public function vehiculosLibres()
    {
        try {
            // Consultar los vehículos en estado "LIBRE" y sus relaciones con modelo y marca
            $vehiculosLibres = RegistroVehiculo::with(['modeloVehiculo.marcaVehiculo'])
                ->where('estado', 'LIBRE')
                ->get()
                ->map(function ($vehiculo) {
                    return [
                        'id' => $vehiculo->id,
                        'placa' => $vehiculo->placa,
                        'modelo' => $vehiculo->modeloVehiculo ? $vehiculo->modeloVehiculo->nombre : 'Sin modelo',
                        'marca' => $vehiculo->modeloVehiculo && $vehiculo->modeloVehiculo->marcaVehiculo
                            ? $vehiculo->modeloVehiculo->marcaVehiculo->nombre
                            : 'Sin marca',
                        'color' => $vehiculo->color,
                    ];
                });

            // Retorna los vehículos en formato JSON
            return response()->json([
                'success' => true,
                'vehiculos' => $vehiculosLibres,
            ], 200);
        } catch (\Exception $e) {
            // En caso de error, retorna un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los vehículos libres',
            ], 500);
        }
    }
}
