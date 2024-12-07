<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGroup;
use App\Models\TipoVehiculo;
use App\Models\RegistroVehiculo;
use App\Models\MarcaVehiculo;
use App\Models\ModeloVehiculo;
use App\Models\TipoCaja;
use App\Models\TipoCombustible;
use App\Models\Sucursal;
use App\Models\QrCodes;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class QrCodeController extends Controller
{
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
        $code = QrCodes::query();

        if (!empty($search)) {
            $code->where('placa', 'like', '%' . $search . '%');
        }

        $codes = $code->get();
        $tipo_vehiculo = TipoVehiculo::all()->keyBy('id');

        return view('llavevehiculo.index', [
            'codes' => $codes,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario,
            'tipo_vehiculo' => $tipo_vehiculo, // Pasa los permisos a la vista
        ]);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'placa' => 'required|string|max:255|unique:llave_vehiculo,placa',
            'capacidad_combustible' => 'nullable|string',
            'chasis' => 'nullable|string',
            'color' => 'nullable|string',
            'tipo_combustible' => 'nullable|string',
            'tipo_caja' => 'nullable|string',
            'modelo' => 'nullable|string|max:255',
            'grupo' => 'nullable|string',
            'marca' => 'nullable|string',
            'tipo_vehiculo' => 'nullable|string',
            'sucursal' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('createLlaveModal', true);
        }

        // Buscar los datos relacionados, estos datos no deben sobrescribir los que vienen del request si no es necesario.
        $registroVehiculo = RegistroVehiculo::find($request->placa);
        $ModeloVehiculo = ModeloVehiculo::find($request->modelo);
        $TipoVehiculo = ModeloVehiculo::find($request->tipo_vehiculo);
        $CombustibleVehiculo = TipoCombustible::find($request->tipo_combustible);
        $CajaVehiculo = TipoCaja::find($request->tipo_caja);
        $GrupoVehiculo = TipoVehiculo::find($request->grupo);
        $SucursalVehiculo = Sucursal::find($request->sucursal);
        $MarcaVehiculo = MarcaVehiculo::find($request->marca);

        // Si no se encuentra el registro de vehículo
        if (!$registroVehiculo) {
            return redirect()->back()->with('error', 'Registro de vehículo no encontrado.');
        }

        // Crear un nuevo registro de vehículo
        $vehiculoData = $request->only([
            'capacidad_combustible',
            'tipo_combustible',
            'tipo_caja',
            'modelo',
            'chasis', // Mantener el valor original del formulario
            'color',  // Mantener el valor original del formulario
            'grupo',
            'marca',
            'tipo_vehiculo',
            'sucursal'
        ]);

        // Si necesitas sobrescribir ciertos datos específicos con los modelos relacionados, hazlo aquí, pero NO sobreescribas color y chasis si no es necesario.
        $vehiculoData['placa'] = $registroVehiculo->placa;
        $vehiculoData['modelo'] = $ModeloVehiculo->nombre; // Si prefieres el nombre del modelo relacionado.
        $vehiculoData['capacidad_combustible'] = $registroVehiculo->capacidad_combustible; // Si prefieres la capacidad original
        $vehiculoData['tipo_vehiculo'] = $ModeloVehiculo->tipo_vehiculo;
        $vehiculoData['tipo_caja'] = $CajaVehiculo->nombre;
        $vehiculoData['tipo_combustible'] = $CombustibleVehiculo->nombre;
        $vehiculoData['grupo'] = $GrupoVehiculo->nombre;
        $vehiculoData['marca'] = $MarcaVehiculo->nombre;
        $vehiculoData['sucursal'] = $SucursalVehiculo->nombre;

        try {
            // Guardar el vehículo en la base de datos
            $vehiculo = QrCodes::create($vehiculoData);

            // Generar el código QR con los datos del vehículo incluyendo la llave
            $qrCodeData = [
                'llave' => $vehiculo->llave,  // Agregar el campo llave aquí
                'placa' => $vehiculoData['placa'],
                'modelo' => $vehiculoData['modelo'],
                'capacidad_combustible' => $vehiculoData['capacidad_combustible'],
                'tipo_vehiculo' => $vehiculoData['tipo_vehiculo'],
                'tipo_caja' => $vehiculoData['tipo_caja'],
                'tipo_combustible' => $vehiculoData['tipo_combustible'],
                'chasis' => $vehiculoData['chasis'],
                'color' => $vehiculoData['color'],
                'grupo' => $vehiculoData['grupo'],
                'marca' => $vehiculoData['marca'],
                'sucursal' => $vehiculoData['sucursal'],
            ];

            // Generar la URL a la vista de la etiqueta del vehículo
            $urlEtiqueta = route('llavevehiculo.showEtiqueta', ['id' => $vehiculo->id]);

            // Generar el código QR con la URL de la etiqueta
            $qrCode = new QrCode($urlEtiqueta);
            $writer = new PngWriter();

            // Generar el código QR y obtener la imagen en formato PNG
            $result = $writer->write($qrCode);
            $qrCodeImage = $result->getString();

            // Guardar el código QR en el servidor
            $qrCodePath = 'graficos/' . $vehiculo->id . '.png';
            \Storage::disk('public')->put($qrCodePath, $qrCodeImage);

            // Actualizar el registro con la ruta del código QR
            $vehiculo->update(['codigo_qr' => $qrCodePath]);

            // Redirigir al índice de vehículos o a cualquier otra página
            return redirect()->route('llavevehiculo.index')->with('success', 'Vehículo creado y código QR generado.');
        } catch (QueryException $e) {
            // Capturar la excepción de duplicidad
            if ($e->getCode() === '23000') {
                return redirect()->route('llavevehiculo.index')
                    ->with('error', 'Ya existe un registro con esta placa.');
            }

            // Para otros errores, puedes redirigir o manejar como desees
            return redirect()->route('llavevehiculo.index')
                ->with('error', 'Error al crear el registro. Por favor, inténtalo de nuevo.');
        }
    }

    public function showEtiqueta($id)
    {
        // Obtener el registro del vehículo
        $vehiculo = QrCodes::find($id);

        if (!$vehiculo) {
            return redirect()->route('llavevehiculo.index')->with('error', 'Vehículo no encontrado.');
        }

        // Pasar los datos del vehículo a la vista
        return view('llavevehiculo.etiqueta_vehiculo', [
            'placa' => $vehiculo->placa,
            'chasis' => $vehiculo->chasis,
            'grupo' => $vehiculo->grupo,
            'modelo' => $vehiculo->modelo,
            'sucursal' => $vehiculo->sucursal,
            'color' => $vehiculo->color,
            'tipo_combustible' => $vehiculo->tipo_combustible
        ]);
    }

    public function edit($id) {}
    public function destroy($id)
    {
        $code = QrCodes::find($id);

        if (!$code) {
            return redirect()->route('llavevehiculo.index')->with('error', 'Marca no encontrada.');
        }

        // Elimina el archivo asociado si existe
        if ($code->codigo_qr) {
            $filePath = storage_path('app/public/' . $code->codigo_qr);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Elimina el registro en la base de datos
        $code->delete();

        return redirect()->route('llavevehiculo.index')->with('success', 'Marca eliminada exitosamente.');
    }
}
