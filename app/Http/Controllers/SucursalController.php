<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\UserGroup;
use App\Models\Ciudad;


class SucursalController extends Controller
{
    // Mostrar la lista de sucursales

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
        $sucursal = Sucursal::query()->where('id', '!=', 13);;
        $Ciudad = Ciudad::all()->keyBy('id');

        if (!empty($search)) {
            $sucursal->where('nombre', 'like', '%' . $search . '%');
        }

        $sucursales = $sucursal->get();

        return view('sucursales.index', [
            'sucursales' => $sucursales,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario,
            'ciudad' => $Ciudad, // Pasa los permisos a la vista
        ]);
    }

    // Mostrar el formulario para crear una nueva sucursal
    public function create()
    {
        return view('sucursales.create');
    }

    // Almacenar una nueva sucursal en la base de datos
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'nombre' => 'required|string|max:30',
            'ciudad' => 'required|exists:ciudades,id',
            'direccion' => 'required|string|max:255',
            'tipo_sucursal' => 'required|string|max:255',
        ]);

        // Obtener el ID de la ciudad seleccionada
        $ciudadId = $request->input('ciudad');

        // Buscar el nombre de la ciudad usando el ID
        $ciudad = Ciudad::find($ciudadId);

        // Verificar si se encontró la ciudad
        if ($ciudad) {
            // Crear un array de datos para crear la sucursal
            $sucursalData = $request->except('ciudad'); // Excluir el ID de ciudad
            $sucursalData['ciudad'] = $ciudad->nombre; // Incluir el nombre de la ciudad

            // Crear una nueva instancia del modelo Sucursal y guardar los datos
            Sucursal::create($sucursalData);

            return redirect()->route('surcursales.index')
                ->with('success', 'Sucursal creada con éxito.');
        }

        // En caso de que no se encuentre la ciudad, redirigir con un error
        return redirect()->back()->withErrors(['ciudad' => 'Ciudad no encontrada.']);
    }

    // Mostrar el formulario para editar una sucursal existente
    public function edit($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('sucursales.edit', compact('sucursal'));
    }

    // Actualizar una sucursal existente en la base de datos
    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255',
            // Verifica que el ID exista en la tabla 'ciudades'
            'direccion' => 'required|string|max:255',
            'tipo_sucursal' => 'required|in:Taller,Bodega,Sucursal,Estacionamiento', // Verifica que el tipo esté en las opciones permitidas
        ]);

        // Obtener el ID de la ciudad seleccionada
        $ciudadId = $request->input('ciudad');

        // Buscar el nombre de la ciudad usando el ID
        $ciudad = Ciudad::find($ciudadId);

        // Verificar si se encontró la ciudad
        if ($ciudad) {
            // Crear un array de datos para actualizar la sucursal
            $sucursalData = $request->except('ciudad'); // Excluir el ID de ciudad
            $sucursalData['ciudad'] = $ciudad->nombre; // Incluir el nombre de la ciudad

            // Encontrar la sucursal existente y actualizar los datos
            $sucursal = Sucursal::findOrFail($id);
            $sucursal->update($sucursalData);

            return redirect()->route('surcursales.index')
                ->with('success', 'Sucursal actualizada con éxito.');
        }

        // En caso de que no se encuentre la ciudad, redirigir con un error
        return redirect()->back()->withErrors(['ciudad' => 'Ciudad no encontrada.']);
    }

    // Eliminar una sucursal de la base de datos
    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->delete();

        return redirect()->route('surcursales.index')
            ->with('success', 'Sucursal eliminada con éxito.');
    }
    public function getAllSucursales()
    {
        try {
            // Obtener todas las sucursales
            $sucursales = Sucursal::all();

            // Retornar la lista de sucursales en formato JSON
            return response()->json([
                'success' => true,
                'sucursales' => $sucursales
            ], 200);
        } catch (\Exception $e) {
            // En caso de error, retornar un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las sucursales'
            ], 500);
        }
    }
}
