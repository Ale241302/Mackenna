<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ClienteEmpresa;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Validator;
use App\Models\Ciudad;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Http\Controllers\PasswordResetController;

class ClienteEmpresaController extends Controller
{
    /**
     * Display a listing of approved clients.
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

        // Consulta los clientes particulares y empresas con el filtro de búsqueda
        $clientesEmpresasQuery = ClienteEmpresa::query();

        if (!empty($search)) {

            $clientesEmpresasQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        $clientesEmpresas = $clientesEmpresasQuery->get();

        return view('clientesempresa.index', [
            'clientesEmpresas' => $clientesEmpresas,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }

    /**
     * Show the form for creating a new client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientesempresa.create');
    }

    /**
     * Store a newly created client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        // Definir las reglas de validación
        $rules = [
            'name' => 'required|string|max:255',
            'tipo_cliente' => 'nullable|string',
            'cuenta_contable' => 'nullable|string|max:100',
            'razon_social' => 'nullable|string|max:255',
            'sector_economico' => 'nullable|exists:sector_comercial,id',
            'direccion' => 'nullable|string|max:255',
            'codigo_postal' => 'nullable|string|max:10',
            'municipio' => 'nullable|exists:ciudades,id',
            'pais' => 'nullable|exists:paises,id',
            'provincia' => 'nullable|string|max:255',
            'tipo_documento' => 'nullable|exists:tipo_documento,id',
            'numero_documento' => 'nullable|string',
            'pais_documento' => 'nullable|exists:paises,id',
            'persona_contacto' => 'nullable|array|min:1',
            'persona_contacto.*' => 'nullable|string|max:255',
            'numero_contacto' => 'nullable|array|min:1',
            'numero_contacto.*' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'web' => 'nullable|url|max:255',
            'sucursal' => 'nullable|exists:sucursales,id',
            'idiomas' => 'nullable|exists:idiomas,id',
            'observaciones' => 'nullable|string',
            'medio_pago' => 'nullable|string|in:tarjeta_credito,tarjeta_debito,transferencia_bancaria,webpay,khipu,paypal,mercadopago',
            'dias_credito' => 'nullable|integer|min:0',
            'canal' => 'nullable|string|max:255',
            'vent_dia' => 'nullable|string|max:255',
            'vehiculo_propio' => 'nullable|boolean',
            'acuerdos' => 'nullable|string',
            'opciones' => 'nullable|array',
            'opciones.*' => 'string',
            'tarifas' => 'nullable|array',
            'tarifas.*' => 'exists:tarifas,id',
            'extras' => 'nullable|array',
            'extras.*' => 'exists:extra_cliente,id',
            'documentos2.*' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png,webp,gif|max:2048',
            'estado_cliente' => 'nullable|string|max:50',
        ];

        // Agregar validación de RUT solo si tipo_documento es igual a 1
        if ($tipoDocumento == 1) {
            $rules['numero_documento'] .= '|valid_rut';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('clientesempresa.create', true);
        }

        // Procesamiento de datos y guardado del cliente
        $data = $request->except(['persona_contacto', 'numero_contacto', 'documentos2', 'tarifas', 'opciones', 'extras']);

        // Convertir los contactos a formato JSON para guardarlos
        $data['persona_contacto'] = json_encode($request->input('persona_contacto'));
        $data['numero_contacto'] = json_encode($request->input('numero_contacto'));

        // Convertir y agregar todos los datos necesarios de los tab-panels a $data
        $data['tarifas'] = $request->has('tarifas') ? json_encode($request->input('tarifas')) : null;
        $data['extras'] = $request->has('extras') ? json_encode($request->input('extras')) : null;
        $data['opciones'] = $request->has('opciones') ? json_encode($request->input('opciones')) : null;

        // Guardar cliente en la base de datos
        $cliente = ClienteEmpresa::create($data);
        if (!$cliente) {
            dd("Error al guardar el cliente", $data);
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->numero_documento = $request->input('numero_documento');
        $user->tipo_documento = $request->input('tipo_documento');
        $user->tipo_usuario = $request->input('tipo_cliente'); // Campo hidden de tipo_cliente
        $user->save();
        // Enviar el correo para la creación de contraseña
        $passwordResetController = new PasswordResetController();
        $passwordResetController->sendResetLinkEmail($request);

        // Manejo de archivos subidos
        if ($request->hasFile('documentos2')) {
            try {
                $files = $request->file('documentos2');
                $uploadedFiles = []; // Array para almacenar los nombres de archivos subidos

                foreach ($files as $file) {
                    // Generar un nombre único para el archivo
                    $fileName = time() . '_' . $file->getClientOriginalName();

                    // Almacenar el archivo en la carpeta "public/graficos"
                    $file->storeAs('public/graficos', $fileName);

                    // Agregar el nombre del archivo al array
                    $uploadedFiles[] = $fileName;
                }

                // Guardar los nombres de archivos en formato JSON en la base de datos
                $cliente->documentos2 = json_encode($uploadedFiles);
                $cliente->save();
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Error al subir los archivos: ' . $e->getMessage());
            }
        }

        return redirect()->route('clientesempresa.index')->with('success', 'Cliente creado con éxito.');
    }



    /**
     * Store a newly created particular client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function show($id)
    {
        $cliente = ClienteEmpresa::findOrFail($id);
        return view('clientesempresa.show', compact('cliente'));
    }

    public function getUserData($id)
    {
        $cliente = ClienteEmpresa::with('tipoDocumento', 'pais', 'municipio', 'sectorcomercial', 'paisdocumento', 'sucursal', 'idiomas')->find($id);

        if (!$cliente) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'id' => $cliente->id,
            'name' => $cliente->name,
            'tipo_documento' => $cliente->tipoDocumento ? $cliente->tipoDocumento->nombre : 'No definido',
            'numero_documento' => $cliente->numero_documento,
            'email' => $cliente->email,
            'cuenta_contable' => $cliente->cuenta_contable,
            'razon_social' => $cliente->razon_social,
            'sector_economico' => $cliente->sectorcomercial ? $cliente->sectorcomercial->nombre : 'No definido',
            'direccion' => $cliente->direccion,
            'codigo_postal' => $cliente->codigo_postal,
            'municipio' => $cliente->municipio ? $cliente->municipio->nombre : 'No definido',
            'pais' => $cliente->pais ? $cliente->pais->nombre : 'No definido',
            'provincia' => $cliente->provincia,
            'pais_documento' => $cliente->paisdocumento ? $cliente->paisdocumento->nombre : 'No definido',
            'persona_contacto' =>  $cliente->persona_contacto,
            'numero_contacto' => $cliente->numero_contacto,
            'email' => $cliente->email,
            'web' => $cliente->web,
            'sucursal' =>  $cliente->sucursal ? $cliente->sucursal->nombre : 'No definido',
            'idiomas' => $cliente->idiomas ? $cliente->idiomas->nombre : 'No definido',
            'observaciones' => $cliente->observaciones,
            'medio_pago' => $cliente->medio_pago,
            'dias_credito' => $cliente->dias_credito,
            'canal' => $cliente->canal,
            'vent_dia' => $cliente->vent_dia,
            'vehiculo_propio' => $cliente->vehiculo_propio,
            'acuerdos' => $cliente->acuerdos,
            'opciones' => $cliente->opciones,
            'tarifas' =>  $cliente->tarifas,
            'extras' =>  $cliente->extras,
            'documentos2.*' => $cliente->extras,
            'estado_cliente' => $cliente->estado_cliente,
        ]);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $clientesempresa = ClienteEmpresa::findOrFail($id);
        return view('clientesempresa.edit', compact('clientesempresa'));
    }
    public function update(Request $request, $id)
    {
        $clientesempresa = ClienteEmpresa::findOrFail($id);
        // Obtener el tipo de documento del request
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
            'cuenta_contable' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'sector_economico' => 'nullable|exists:sector_comercial,id',
            'direccion' => 'nullable|string|max:255',
            'codigo_postal' => 'nullable|numeric',
            'pais' => 'nullable|exists:paises,id',
            'municipio' => 'nullable|exists:ciudades,id',
            'tipo_documento' => 'nullable|exists:tipo_documento,id',
            'numero_documento' => 'nullable|string',
            'pais_documento' => 'nullable|exists:paises,id',
            'persona_contacto.*' => 'nullable|string|max:255',
            'numero_contacto.*' => 'nullable|string',
            'web' => 'nullable|url|max:255',
            'sucursal' => 'nullable|exists:sucursales,id',
            'idiomas' => 'nullable|exists:idiomas,id',
            'observaciones' => 'nullable|string',
            'acuerdos' => 'nullable|string',
            'vehiculo_propio' => 'nullable|boolean',
            'medio_pago' => 'nullable|string|in:tarjeta_credito,tarjeta_debito,transferencia_bancaria,webpay,khipu,paypal,mercadopago',
            'dias_credito' => 'nullable|numeric',
            'canal' => 'nullable|numeric',
            'vent_dia' => 'nullable|numeric',
            'tarifas' => 'nullable|array',
            'tarifas.*' => 'exists:tarifas,id',
            'extras' => 'nullable|array',
            'extras.*' => 'exists:extra_cliente,id',
            'documentos2.*' => 'file|mimes:pdf,docx,jpg,jpeg,png,webp,gif|max:2048',
            'opciones' => 'nullable|array',
            'opciones.*' => 'string'
        ];
        if ($tipoDocumento == 1) {
            $rules['numero_documento'] .= '|valid_rut';
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('clientesparticular.edit', true);
        }
        $deletedFiles = json_decode($request->input('deleted_files', '[]'), true);

        // Recuperar los nombres de archivos antiguos
        $existingFiles = json_decode($clientesempresa->documentos2, true) ?? [];

        // Eliminar los archivos que han sido marcados para eliminación
        foreach ($deletedFiles as $fileToDelete) {
            if (($key = array_search($fileToDelete, $existingFiles)) !== false) {
                unset($existingFiles[$key]);
                // Elimina el archivo físicamente del almacenamiento si es necesario
                Storage::delete('public/graficos/' . $fileToDelete);
            }
        }

        // Reindexar el array de archivos después de eliminar elementos
        $existingFiles = array_values($existingFiles);

        // Manejo de archivos subidos
        $newFileNames = [];
        if ($request->hasFile('documentos2')) {
            $files = $request->file('documentos2');
            foreach ($files as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/graficos', $fileName);
                $newFileNames[] = $fileName;
            }
        }

        // Fusionar los nombres de archivos antiguos y nuevos
        $allFileNames = array_merge($existingFiles, $newFileNames);


        // Obtener los contactos existentes
        $existingPersonasContacto = json_decode($clientesempresa->persona_contacto, true) ?? [];
        $existingNumerosContacto = json_decode($clientesempresa->numero_contacto, true) ?? [];

        $newPersonasContacto = $request->input('persona_contacto', []);
        $newNumerosContacto = $request->input('numero_contacto', []);

        // Eliminar los contactos que se han marcado para eliminación
        $deletedContacts = json_decode($request->input('deleted_contacts', '[]'), true);

        foreach ($deletedContacts as $deleted) {
            $index = array_search($deleted['persona'], $existingPersonasContacto);
            if ($index !== false && $existingNumerosContacto[$index] == $deleted['numero']) {
                unset($existingPersonasContacto[$index]);
                unset($existingNumerosContacto[$index]);
            }
        }

        // Reindexar los arrays después de eliminar elementos
        $existingPersonasContacto = array_values($existingPersonasContacto);
        $existingNumerosContacto = array_values($existingNumerosContacto);

        // Crear arrays combinados manteniendo los valores existentes y evitando duplicados
        $combinedPersonasContacto = $existingPersonasContacto;
        $combinedNumerosContacto = $existingNumerosContacto;

        foreach ($newPersonasContacto as $index => $persona) {
            if (!empty(trim($persona)) || !empty(trim($newNumerosContacto[$index]))) {
                if (!in_array($persona, $existingPersonasContacto) || !in_array($newNumerosContacto[$index], $existingNumerosContacto)) {
                    $combinedPersonasContacto[] = $persona;
                    $combinedNumerosContacto[] = $newNumerosContacto[$index] ?? null;
                }
            }
        }

        // Actualizar el registro de cliente con los nuevos datos
        $clientesempresa->update([
            'cuenta_contable' => $request->input('cuenta_contable'),
            'name' => $request->input('name'),
            'razon_social' => $request->input('razon_social'),
            'sector_economico' => $request->input('sector_economico'),
            'direccion' => $request->input('direccion'),
            'codigo_postal' => $request->input('codigo_postal'),
            'pais' => $request->input('pais'),
            'municipio' => $request->input('municipio'),
            'tipo_documento' => $request->input('tipo_documento'),
            'numero_documento' => $request->input('numero_documento'),
            'pais_documento' => $request->input('pais_documento'),
            'email' => $request->input('email'),
            'persona_contacto' => json_encode($combinedPersonasContacto),
            'numero_contacto' => json_encode($combinedNumerosContacto),
            'opciones' => json_encode($request->input('opciones', [])),
            'web' => $request->input('web2'),
            'sucursal' => $request->input('sucursal'),
            'idiomas' => $request->input('idiomas'),
            'observaciones' => $request->input('observaciones'),
            'acuerdos' => $request->input('acuerdos'),
            'vehiculo_propio' => $request->input('vehiculo_propio'),
            'medio_pago' => $request->input('medio_pago'),
            'dias_credito' => $request->input('dias_credito'),
            'canal' => $request->input('canal'),
            'vent_dia' => $request->input('vent_dia'),
            'tarifas' => json_encode($request->input('tarifas2', [])),
            'extras' => json_encode($request->input('extras2', [])),
            'documentos2' => json_encode($allFileNames),
        ]);

        return redirect()->route('clientesempresa.index')
            ->with('success', 'Registro de cliente empresa actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $cliente = ClienteEmpresa::find($id); // Buscar el cliente por ID

        if (!$cliente) {
            return redirect()->route('clientesempresa.index')->with('error', 'Modelo no encontrado.');
        }
        $existingUser = User::where('numero_documento', $cliente->numero_documento)->first();
        if ($existingUser) {
            $existingUser->delete();
        }

        // Verificar si existe un archivo asociado y eliminarlo
        if ($cliente->documentos2) {
            // Decodificar JSON a un array
            $filesArray = json_decode($cliente->documentos2, true);

            if (is_array($filesArray)) {
                foreach ($filesArray as $fileName) {
                    $filePath = storage_path('app/public/graficos/' . $fileName); // Ajusta la ruta según tu estructura
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
        }

        // Eliminar el registro en la base de datos
        $cliente->delete();

        return redirect()->route('clientesempresa.index')->with('success', 'Modelo de vehículo eliminado exitosamente.');
    }


    public function getCiudadesByPais(Request $request)
    {
        $pais_id = $request->pais_id;
        $ciudades = Ciudad::where('pais_id', $pais_id)->get();

        return response()->json($ciudades);
    }
}
