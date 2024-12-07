<?php

namespace App\Http\Controllers;

use App\Models\AccesorioVehiculo;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class AccesorioVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
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

        $accesorio = AccesorioVehiculo::query();

        if (!empty($search)) {
            $accesorio->where('nombre', 'like', '%' . $search . '%');
        }

        $accesorios = $accesorio->get();

        return view('accesoriovehiculo.index', [
            'accesorios' => $accesorios,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accesoriovehiculo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos
        $request->validate([
            'nombre' => 'required|string|max:30',
            'precio' => 'required|numeric|min:0', // Asegúrate de validar que precio sea un número
        ]);

        // Reemplazar los puntos por comas en el campo precio
        $data = $request->all();
        $data['precio'] = str_replace(',', '.', $request->precio);

        // Crear el registro con los datos ajustados
        AccesorioVehiculo::create($data);

        return redirect()->route('accesoriovehiculo.index')
            ->with('success', 'Accesorio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AccesorioVehiculo $accesorioVehiculo)
    {
        return view('accesoriovehiculo.show', compact('accesorioVehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccesorioVehiculo $accesorioVehiculo)
    {
        return view('accesoriovehiculo.edit', compact('accesorioVehiculo'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        // Buscar el accesorio por ID
        $accesorio = AccesorioVehiculo::find($id);

        if ($accesorio) {
            // Validar los campos
            $request->validate([
                'nombre' => 'required|string|max:30',
                'precio' => 'required|string|max:20', // Aceptamos el precio como cadena temporalmente
            ]);

            // Asignar valores del request a los atributos del modelo
            $accesorio->nombre = $request->input('nombre');

            // Convertir el formato de 'precio' a un formato numérico válido
            $precio_formateado = str_replace(',', '.', $request->input('precio')); // Eliminar las comas de miles
            $accesorio->precio = $precio_formateado;

            // Guardar los cambios en la base de datos
            $accesorio->save();

            return redirect()->route('accesoriovehiculo.index')
                ->with('success', 'Accesorio actualizado correctamente');
        } else {
            return redirect()->route('accesoriovehiculo.index')
                ->with('error', 'No se encontró el accesorio');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $accesorio = AccesorioVehiculo::find($id); // Buscar el grupo por ID

        if (!$accesorio) {
            return redirect()->route('accesoriovehiculo.index')->with('error', 'Marca no encontrado.');
        }

        $accesorio->delete();
        return redirect()->route('accesoriovehiculo.index')->with('success', 'Marca eliminado exitosamente.');
    }
}
