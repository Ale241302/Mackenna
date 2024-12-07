<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PasswordResetController;

class RegisteredUserController extends Controller
{
    public function create()
    {
        $tipoDocumentos = \App\Models\TipoDocumento::all();
        return view('auth.register', compact('tipoDocumentos'));
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

    public function store(Request $request)
    {
        $tipoDocumento = $request->input('tipo_documento');
        // Validación de los campos
        Validator::extend('valid_rut', function ($attribute, $value, $parameters, $validator) {
            return $this->validateRut($value);
        });
        $messages = [
            'valid_rut' => 'El :attribute no es un RUT válido.', // Mensaje de error personalizado
        ];
        $rules = [
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'tipo_documento' => 'required|integer|exists:tipo_documento,id',
            'numero_documento' => 'required|digits:10',
            'numero_telefonico' => 'required|digits:10',
            'email' => 'required|string|email|max:255|unique:users',
        ];
        if ($tipoDocumento == 1) {
            $rules['numero_documento'] .= '|valid_rut';
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'apellido' => $request->apellido,
                'tipo_documento' => $request->tipo_documento,
                'numero_documento' => $request->numero_documento,
                'numero_telefonico' => $request->numero_telefonico,
                'email' => $request->email,
                'tipo_usuario' => '6',
                'estado' => $request->get('estado', 'Activo'),
            ]);

            // Enviar el correo para la creación de contraseña
            $passwordResetController = new PasswordResetController();
            $passwordResetController->sendResetLinkEmail($request);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al registrar el usuario: ' . $e->getMessage());
        }

        // Mostrar mensaje de éxito
        return redirect()->route('register')->with('success', 'Registro exitoso. Se ha enviado un correo para crear tu contraseña.');
    }
}
