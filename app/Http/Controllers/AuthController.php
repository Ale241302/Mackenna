<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TipoDocumento;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar las credenciales entrantes
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Intentar obtener el usuario por el email
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // Si las credenciales no coinciden, devolver error 401
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        // Crear token para el usuario autenticado
        $token = $user->createToken('authToken')->plainTextToken;

        // Responder con éxito y devolver el token
        return response()->json([
            'message' => 'Login exitoso',
            'token' => $token,
            'user' => $user
        ]);
    }
    // Método para obtener el perfil del usuario
    public function getUserProfile($id)
    {
        try {
            $user = User::with('tipoDocumento')->find($id); // Cargar la relación con el tipo de documento

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el perfil',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // Método para actualizar el perfil del usuario
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        }

        // Definir las reglas de validación
        $rules = [
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'numero_documento' => 'nullable|string',
            'numero_telefonico' => 'required|string|max:20',
            'tipo_documento_id' => 'required|exists:tipo_documento,id',
            'email' => 'required|email|max:255',
        ];

        // Validar el RUT si el tipo de documento es 1 (RUT)
        if ($request->tipo_documento_id == 1) {
            if (!$this->validateRut($request->numero_documento)) {
                return response()->json([
                    'success' => false,
                    'message' => 'El RUT es inválido'
                ], 400);
            }
        }

        // Validar la solicitud
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $user->name = $request->name;
            $user->apellido = $request->apellido;
            $user->numero_documento = $request->numero_documento;
            $user->numero_telefonico = $request->numero_telefonico;
            $user->tipo_documento = $request->tipo_documento_id;
            $user->email = $request->email;

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Perfil actualizado correctamente',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el perfil',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function validateRut($numero_documento)
    {
        // Elimina caracteres no permitidos
        $numero_documento = preg_replace('/[^0-9kK]/', '', $numero_documento);

        if (strlen($numero_documento) < 2) {
            return false;
        }

        $dv = strtolower(substr($numero_documento, -1)); // Dígito verificador
        $numero = substr($numero_documento, 0, -1); // Número sin el dígito verificador
        $suma = 0;
        $factor = 2;

        for ($i = strlen($numero) - 1; $i >= 0; $i--) {
            $suma += $factor * $numero[$i];
            $factor = $factor == 7 ? 2 : $factor + 1;
        }

        $resto = $suma % 11;
        $dvCalculado = 11 - $resto;

        if ($dvCalculado == 10) {
            $dvCalculado = 'k';
        } elseif ($dvCalculado == 11) {
            $dvCalculado = '0';
        }

        return $dv == $dvCalculado;
    }


    // Registro de la validación personalizada
    public function boot()
    {
        Validator::extend('valid_rut', function ($attribute, $value, $parameters, $validator) {
            return $this->validateRut($value); // Usar el método validateRut
        });
    }
    public function getUserDocumento()
    {
        $tipoDocumentos = TipoDocumento::all(); // Obtén todos los tipos de documento
        return response()->json(['tipo_documentos' => $tipoDocumentos], 200);
    }
}
