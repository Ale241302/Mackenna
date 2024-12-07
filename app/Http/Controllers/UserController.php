<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
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

        // Consulta los usuarios con el filtro de búsqueda
        $usersQuery = User::with('tipoDocumento', 'userGroup'); // Incluye relaciones

        if (!empty($search)) {
            $usersQuery->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        $users = $usersQuery->get();

        return view('users.index', [
            'users' => $users,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
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
        // Obtener el tipo de documento del request
        $tipoDocumento = $request->input('tipo_documento');

        // Definir un validador condicional para el RUT
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
            'tipo_usuario' => 'required|integer|exists:user_groups,id',
            'numero_documento' => 'required',
            'numero_telefonico' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
        ];
        if ($tipoDocumento == 1) {
            $rules['numero_documento'] .= '|valid_rut';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('createUserModal', true);
        }

        $user = new User([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'numero_telefonico' => $request->numero_telefonico,
            'email' => $request->email,
            'tipo_usuario' => $request->tipo_usuario,
            'estado' => $request->get('estado', 'Activo'),
        ]);

        if ($user->save()) {
            $passwordResetController = new PasswordResetController();
            $passwordResetRequest = new Request(['email' => $user->email]);
            $passwordResetController->sendResetLinkEmail($passwordResetRequest);
            return redirect('/users')->with('success', 'User has been added');
        } else {
            return redirect()->back()->with('error', 'Failed to create user');
        }
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function getUserData($id)
    {
        $user = User::with('tipoDocumento', 'userGroup')->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'apellido' => $user->apellido,
            'tipo_documento' => $user->tipoDocumento ? $user->tipoDocumento->nombre : 'No definido',
            'numero_documento' => $user->numero_documento,
            'numero_telefonico' => $user->numero_telefonico,
            'email' => $user->email,
            'tipo_usuario' => $user->userGroup ? $user->userGroup->nombre : 'No definido',
            'estado' => $user->estado,
        ]);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $tipoDocumento = $request->input('tipo_documento');
        // Definir un validador condicional para el RUT
        Validator::extend('valid_rut', function ($attribute, $value, $parameters, $validator) {
            return $this->validateRut($value);
        });

        $messages = [
            'valid_rut' => 'El :attribute no es un RUT válido.', // Mensaje de error personalizado
        ];

        // Validación de los datos recibidos
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',

            ],
            'password' => 'nullable|string|min:8|confirmed',
            'apellido' => 'required|string|max:255',
            'tipo_documento' => 'required|integer|exists:tipo_documento,id',
            'tipo_usuario' => 'required|integer|exists:user_groups,id',
            'numero_documento' => 'required',
            'numero_telefonico' => 'required',
        ];
        if ($tipoDocumento == 1) {
            $rules['numero_documento'] .= '|valid_rut';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('editUserId', $id);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->apellido = $request->input('apellido');
        $user->tipo_documento = $request->input('tipo_documento');
        $user->numero_documento = $request->input('numero_documento');
        $user->numero_telefonico = $request->input('numero_telefonico');
        $user->tipo_usuario = $request->input('tipo_usuario');
        $user->estado = $request->input('estado');

        $user->save();

        return redirect('/users')->with('success', 'User has been updated');
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'User has been deleted');
    }
}
