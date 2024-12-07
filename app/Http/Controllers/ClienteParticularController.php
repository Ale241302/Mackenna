<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ClienteEmpresa;
use App\Models\UserGroup;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Ciudad;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PasswordResetController;

class ClienteParticularController extends Controller
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
        $clientesEmpresasQuery = Cliente::query();

        if (!empty($search)) {

            $clientesEmpresasQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        $clientesparticular = $clientesEmpresasQuery->get();

        return view('clientesparticular.index', [
            'clientesparticular' => $clientesparticular,
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
        return view('clientesparticular.create');
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
            'tipo_cliente' => 'nullable|string',
            'apellido' => 'nullable|string|max:255',
            'cuenta_contable' => 'nullable|string|max:100',
            'direccionh' => 'nullable|string|max:255',
            'direccionl' => 'nullable|string|max:255',
            'codigo_postalh' => 'nullable|integer|digits_between:1,11', // Cambiado a 'digits_between'
            'codigo_postallocal' => 'nullable|integer|digits_between:1,11', // Cambiado a 'digits_between'
            'municipio' => 'nullable|exists:ciudades,id',
            'ciudad_carnet' => 'nullable|exists:ciudades,id',
            'ciudad_nacido' => 'nullable|exists:ciudades,id',
            'ciudadh' => 'nullable|exists:ciudades,id',
            'ciudadl' => 'nullable|exists:ciudades,id',
            'pais' => 'nullable|exists:paises,id',
            'paisn' => 'nullable|exists:paises,id',
            'pais_carnet' => 'nullable|exists:paises,id',
            'pais_nacido' => 'nullable|exists:paises,id',
            'pais_nacidoh' => 'nullable|exists:paises,id',
            'pais_nacidol' => 'nullable|exists:paises,id',
            'tipo_documento' => 'nullable|exists:tipo_documento,id',
            'clienteempresa' => 'nullable|exists:clientes_empresa,id',
            'incluir_mailing' => 'nullable|integer|digits_between:1,11',
            'tipo_carnet' => 'nullable|exists:tipo_carnet,id',
            'numero_documento' => 'nullable|string',
            'pais_documento' => 'nullable|exists:paises,id',
            'fachadoc' => 'nullable|date', // Cambiado a 'date'
            'consentimiento_fecha' => 'nullable|date', // Cambiado a 'date'
            'fachacadoc' => 'nullable|date', // Cambiado a 'date'
            'fachacarnet' => 'nullable|date', // Cambiado a 'date'
            'fachacacarnet' => 'nullable|date', // Cambiado a 'date'
            'fachanacido' => 'nullable|date', // Cambiado a 'date'
            'numero_contacto' => 'nullable||string|max:50',
            'email' => 'nullable|email|max:255',
            'numero_carnet' => 'nullable|string',
            'idiomas' => 'nullable|exists:idiomas,id',
            'observaciones' => 'nullable|string',
            'medio_pago' => 'nullable|string|in:tarjeta_credito,tarjeta_debito,transferencia_bancaria,webpay,khipu,paypal,mercadopago',
            'genero' => 'nullable|string|in:Masculino,Femenino,Otro',
            'avisos' => 'nullable|string',
            'canales_restringidos' => 'nullable|array',
            'canales_restringidos.*' => 'string',
            'consentimiento' => 'nullable|array',
            'consentimiento.*' => 'string',

            'documentos2.*' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png,webp,gif|max:2048',
            'estado' => 'nullable|string',
        ];
        if ($tipoDocumento == 1) {
            $rules['numero_documento'] .= '|valid_rut';
            $rules['numero_carnet'] .= '|valid_rut';
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('clientesparticular.create', true);
        }

        // Procesamiento de datos y guardado del cliente
        $data = $request->except(['documentos2', 'canales_restringidos', 'consentimiento', 'fechas']);

        // Convertir y agregar todos los datos necesarios de los tab-panels a $data
        $data['canales_restringidos'] = $request->has('canales_restringidos') ? json_encode($request->input('canales_restringidos')) : null;
        $data['consentimiento'] = $request->has('consentimiento') ? json_encode($request->input('consentimiento')) : null;
        $data['fechas'] = $request->has('fechas') ? json_encode($request->input('fechas')) : null;

        // Guardar cliente en la base de datos
        $cliente = Cliente::create($data);
        if (!$cliente) {
            dd("Error al guardar el cliente", $data);
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->numero_documento = $request->input('numero_documento');
        $user->tipo_documento = $request->input('tipo_documento');
        $user->tipo_usuario = $request->input('tipo_cliente'); // Campo hidden de tipo_cliente
        $user->numero_telefonico = $request->input('numero_contacto');
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


        return redirect()->route('clientesparticular.index')->with('success', 'Cliente creado con éxito.');
    }


    /**
     * Store a newly created particular client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientesparticular.show', compact('cliente'));
    }

    public function getUserData($id)
    {
        $cliente = Cliente::with('tipoDocumento', 'pais', 'municipio', 'sectorcomercial', 'paisdocumento', 'sucursal', 'idiomas')->find($id);

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
        $clientesparticular = Cliente::findOrFail($id);
        return view('clientesparticular.edit', compact('clientesparticular'));
    }
    public function update(Request $request, $id)
    {
        $clientesparticular = Cliente::findOrFail($id);
        $tipoDocumento = $request->input('tipo_documento');
        // Validación de los campos
        Validator::extend('valid_rut', function ($attribute, $value, $parameters, $validator) {
            return $this->validateRut($value);
        });
        $messages = [
            'valid_rut' => 'El :attribute no es un RUT válido.', // Mensaje de error personalizado
        ];

        // Validación de los datos recibidos
        $rules = [
            'name' => 'required|string|max:255',
            'tipo_cliente' => 'nullable|string',
            'apellido' => 'nullable|string|max:255',
            'cuenta_contable' => 'nullable|string|max:100',
            'direccionh' => 'nullable|string|max:255',
            'direccionl' => 'nullable|string|max:255',
            'codigo_postalh' => 'nullable|integer|digits_between:1,11', // Cambiado a 'digits_between'
            'codigo_postallocal' => 'nullable|integer|digits_between:1,11', // Cambiado a 'digits_between'
            'municipio' => 'nullable|exists:ciudades,id',
            'ciudad_carnet' => 'nullable|exists:ciudades,id',
            'ciudad_nacido' => 'nullable|exists:ciudades,id',
            'ciudadh' => 'nullable|exists:ciudades,id',
            'ciudadl' => 'nullable|exists:ciudades,id',
            'pais' => 'nullable|exists:paises,id',
            'paisn' => 'nullable|exists:paises,id',
            'pais_carnet' => 'nullable|exists:paises,id',
            'pais_nacido' => 'nullable|exists:paises,id',
            'pais_nacidoh' => 'nullable|exists:paises,id',
            'pais_nacidol' => 'nullable|exists:paises,id',
            'tipo_documento' => 'nullable|exists:tipo_documento,id',
            'clienteempresa' => 'nullable|exists:clientes_empresa,id',
            'incluir_mailing' => 'nullable|integer|digits_between:1,11',
            'tipo_carnet' => 'nullable|exists:tipo_carnet,id',
            'numero_documento' => 'nullable|string',
            'pais_documento' => 'nullable|exists:paises,id',
            'fachadoc' => 'nullable|date', // Cambiado a 'date'
            'consentimiento_fecha' => 'nullable|date', // Cambiado a 'date'
            'fachacadoc' => 'nullable|date', // Cambiado a 'date'
            'fachacarnet' => 'nullable|date', // Cambiado a 'date'
            'fachacacarnet' => 'nullable|date', // Cambiado a 'date'
            'fachanacido' => 'nullable|date', // Cambiado a 'date'
            'numero_contacto' => 'nullable||string|max:50',
            'email' => 'nullable|email|max:255',
            'numero_carnet' => 'nullable|string',
            'idiomas' => 'nullable|exists:idiomas,id',
            'observaciones' => 'nullable|string',
            'medio_pago' => 'nullable|string|in:tarjeta_credito,tarjeta_debito,transferencia_bancaria,webpay,khipu,paypal,mercadopago',
            'genero' => 'nullable|string|in:Masculino,Femenino,Otro',
            'avisos' => 'nullable|string',
            'canales_restringidos' => 'nullable|array',
            'canales_restringidos.*' => 'string',
            'consentimiento' => 'nullable|array',
            'consentimiento.*' => 'string',
            'fechas' => 'nullable|array',
            'fechas.*' => 'string',
            'documentos2.*' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png,webp,gif|max:2048',
            'estado' => 'nullable|string',
        ];
        if ($tipoDocumento == 1) {
            $rules['numero_documento'] .= '|valid_rut';
            $rules['numero_carnet'] .= '|valid_rut';
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('clientesparticular.edit', true);
        }
        $deletedFiles = json_decode($request->input('deleted_files', '[]'), true);

        // Recuperar los nombres de archivos antiguos
        $existingFiles = json_decode($clientesparticular->documentos2, true) ?? [];

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



        // Actualizar el registro de cliente con los nuevos datos
        $clientesparticular->update([
            'cuenta_contable' => $request->input('cuenta_contable'),
            'name' => $request->input('name'),
            'apellido' => $request->input('apellido'),
            'pais' => $request->input('pais'),
            'pais_carnet' => $request->input('pais_carnet'),
            'pais_nacido' => $request->input('pais_nacido'),
            'pais_nacidoh' => $request->input('pais_nacidoh'),
            'pais_nacidol' => $request->input('pais_nacidol'),
            'direccionh' => $request->input('direccionh'),
            'direccionl' => $request->input('direccionl'),
            'codigo_postalh' => $request->input('codigo_postalh'),
            'codigo_postallocal' => $request->input('codigo_postallocal'),
            'municipio' => $request->input('municipio'),
            'ciudad_carnet' => $request->input('ciudad_carnet'),
            'ciudad_nacido' => $request->input('ciudad_nacido'),
            'ciudadh' => $request->input('ciudadh'),
            'ciudadl' => $request->input('ciudadl'),
            'tipo_documento' => $request->input('tipo_documento'),
            'tipo_carnet' => $request->input('tipo_carnet'),
            'numero_documento' => $request->input('numero_documento'),
            'numero_contacto' => $request->input('numero_contacto'),
            'numero_carnet' => $request->input('numero_carnet'),
            'pais_documento' => $request->input('pais_documento'),
            'email' => $request->input('email'),
            'canales_restringidos' => json_encode($request->input('canales_restringidos', [])),
            'consentimiento' => json_encode($request->input('consentimiento', [])),
            'fechas' => json_encode($request->input('fechas', [])),
            'idiomas' => $request->input('idiomas'),
            'incluir_mailing' => $request->input('incluir_mailing'),
            'estado' => $request->input('estado'),
            'clienteempresa' => $request->input('clienteempresa'),
            'observaciones' => $request->input('observaciones'),
            'avisos' => $request->input('avisos'),
            'fachadoc' => $request->input('fachadoc'),
            'consentimiento_fecha' => $request->input('consentimiento_fecha'),
            'fachacarnet' => $request->input('fachacarnet'),
            'fachacadoc' => $request->input('fachacadoc'),
            'fachacacarnet' => $request->input('fachacacarnet'),
            'fachanacido' => $request->input('fachanacido'),
            'medio_pago' => $request->input('medio_pago'),
            'genero' => $request->input('genero'),
            'documentos2' => json_encode($allFileNames),
        ]);

        return redirect()->route('clientesparticular.index')
            ->with('success', 'Registro de cliente empresa actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id); // Buscar el cliente por ID

        if (!$cliente) {
            return redirect()->route('clientesparticular.index')->with('error', 'Modelo no encontrado.');
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

        return redirect()->route('clientesparticular.index')->with('success', 'Modelo de vehículo eliminado exitosamente.');
    }
    public function getCiudadesByPais2(Request $request)
    {
        $pais_id = $request->pais_id;
        $ciudades = Ciudad::where('pais_id', $pais_id)->get();

        return response()->json($ciudades);
    }
}
