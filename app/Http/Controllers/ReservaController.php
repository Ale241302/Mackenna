<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\RegistroVehiculo;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function index($userId)
    {
        try {
            // Traer las reservas para un usuario específico
            $reservas = Reserva::where('userid', $userId)
                ->with([
                    'vehiculo:id,placa',     // Solo traer el campo placa del vehículo
                    'usuario:id,name',       // Solo traer el campo name del usuario
                    'sucursal:id,nombre'     // Solo traer el campo nombre de la sucursal
                ])
                ->get();

            return response()->json([
                'success' => true,
                'reservas' => $reservas
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las reservas',
                'error' => $e->getMessage()
            ], 500);
        }
    }





    public function store(Request $request)
    {
        // Validación de los datos entrantes
        $validator = Validator::make($request->all(), [
            'vehiculoid' => 'required|exists:registro_vehiculo,id',  // Verifica que el ID del vehículo existe
            'fechar' => 'required|date|after_or_equal:today',  // Verifica que la fecha no sea pasada
            'sucursalid' => 'required|exists:sucursales,id',  // Verifica que la sucursal existe
            'userId' => 'required|exists:users,id',  // Verifica que el ID del usuario existe
        ]);

        // Si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 400);
        }

        // Iniciar la transacción para asegurar atomicidad
        try {
            \DB::beginTransaction();

            // Crear la reserva
            $reserva = Reserva::create([
                'vehiculoid' => $request->input('vehiculoid'),
                'userid' => $request->input('userId'),
                'fechar' => $request->input('fechar'),
                'sucursalid' => $request->input('sucursalid'),
            ]);

            // Buscar el vehículo y cambiar su estado a "Reservado"
            $vehiculo = RegistroVehiculo::find($request->input('vehiculoid'));
            if ($vehiculo) {
                $vehiculo->estado = 'Reservado';
                $vehiculo->save();
            }

            // Confirmar la transacción
            \DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Reserva creada exitosamente, vehículo reservado',
                'data' => $reserva
            ], 201);
        } catch (\Exception $e) {
            // Revertir la transacción si algo falla
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function show($id)
    {
        try {
            // Obtener el usuario autenticado
            $user = auth()->user();

            // Verificar si el usuario está disponible
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo autenticar al usuario'
                ], 401);
            }

            // Buscar la reserva por ID y por el usuario autenticado
            $reserva = Reserva::where('id', $id)
                ->where('userid', $user->id)  // Asegúrate de que la reserva pertenece al usuario autenticado
                ->with(['vehiculo', 'sucursal'])
                ->first();

            // Si no se encuentra la reserva
            if (!$reserva) {
                return response()->json([
                    'success' => false,
                    'message' => 'Reserva no encontrada'
                ], 404);
            }

            // Retornar la reserva encontrada
            return response()->json([
                'success' => true,
                'reserva' => $reserva
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            // Iniciar una transacción
            DB::beginTransaction();

            // Buscar la reserva por ID
            $reserva = Reserva::find($id);

            if (!$reserva) {
                return response()->json([
                    'success' => false,
                    'message' => 'Reserva no encontrada',
                ], 404);
            }

            // Buscar el vehículo asociado a la reserva y cambiar su estado a "LIBRE"
            $vehiculo = RegistroVehiculo::find($reserva->vehiculoid);

            if ($vehiculo) {
                $vehiculo->estado = 'LIBRE';
                $vehiculo->save();
            }

            // Eliminar la reserva
            $reserva->delete();

            // Confirmar la transacción
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Reserva eliminada y vehículo liberado correctamente',
            ], 200);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la reserva',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        // Validar los datos entrantes
        $validator = Validator::make($request->all(), [
            'vehiculoid' => 'required|exists:registro_vehiculo,id',  // Verifica que el ID del vehículo existe
            'fechar' => 'required|date|after_or_equal:today',  // Verifica que la fecha no sea pasada
            'sucursalid' => 'required|exists:sucursales,id',  // Verifica que la sucursal existe
            'userId' => 'required|exists:users,id',  // Verifica que el ID del usuario existe
        ]);

        // Si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            // Buscar la reserva por su ID
            $reserva = Reserva::findOrFail($id);

            // Actualizar los datos de la reserva
            $reserva->vehiculoid = $request->input('vehiculoid');
            $reserva->fechar = $request->input('fechar');
            $reserva->sucursalid = $request->input('sucursalid');
            $reserva->userid = $request->input('userId');  // El ID del usuario que hizo la reserva
            $reserva->save();

            // Actualizar el estado del vehículo a "Reservado"
            $vehiculo = RegistroVehiculo::find($request->input('vehiculoid'));
            if ($vehiculo) {
                $vehiculo->estado = 'Reservado';  // Cambiar estado a "Reservado"
                $vehiculo->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Reserva actualizada correctamente',
                'data' => $reserva
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
