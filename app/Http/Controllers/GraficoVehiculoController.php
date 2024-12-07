<?php

namespace App\Http\Controllers;

use App\Models\GraficoVehiculo;
use Illuminate\Http\Request;
use App\Models\UserGroup;

class GraficoVehiculoController extends Controller
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

        $grafico = GraficoVehiculo::query();

        if (!empty($search)) {
            $grafico->where('nombre', 'like', '%' . $search . '%');
        }

        $graficos = $grafico->get();

        return view('graficovehiculo.index', [
            'graficos' => $graficos,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('graficovehiculo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar el formulario
        $request->validate([
            'nombre' => 'required|string|max:30',
            'ruta_archivo' => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:2048', // Validación del archivo
        ]);

        // Procesar el archivo subido
        if ($request->hasFile('ruta_archivo')) {
            $file = $request->file('ruta_archivo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/graficos', $fileName); // Guardar en el directorio 'storage/app/public/graficos'
        }

        // Crear el nuevo registro en la base de datos
        GraficoVehiculo::create([
            'nombre' => $request->input('nombre'),
            'ruta_archivo' => $fileName, // Guardar solo el nombre del archivo
        ]);

        return redirect()->route('graficovehiculo.index')
            ->with('success', 'Gráfico creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(GraficoVehiculo $graficoVehiculo)
    {
        return view('graficovehiculo.show', compact('graficoVehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GraficoVehiculo $graficoVehiculo)
    {
        return view('graficovehiculo.edit', compact('graficoVehiculo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Encuentra el gráfico de vehículo por ID
        $grafico = GraficoVehiculo::find($id);

        if ($grafico) {
            // Actualiza el nombre del gráfico
            $grafico->nombre = $request->input('nombre');

            // Verifica si se ha enviado un nuevo archivo
            if ($request->hasFile('ruta_archivo')) {
                // Valida el archivo (opcional)
                $request->validate([
                    'ruta_archivo' => 'mimes:jpg,jpeg,png,gif,webp|max:2048', // Ejemplo: solo imágenes y tamaño máximo de 2MB
                ]);

                // Borra el archivo antiguo si existe
                if ($grafico->ruta_archivo) {
                    $oldFilePath = storage_path('app/public/graficos/' . $grafico->ruta_archivo);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Almacena el nuevo archivo y actualiza el campo ruta_archivo
                $file = $request->file('ruta_archivo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/graficos', $fileName);
                $grafico->ruta_archivo = $fileName;
            }

            // Guarda los cambios
            $grafico->save();

            return redirect()->route('graficovehiculo.index')->with('success', 'Marca de vehículo actualizada correctamente');
        } else {
            return redirect()->route('graficovehiculo.index')->with('error', 'No se encontró la marca de vehículo');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grafico = GraficoVehiculo::find($id);

        if (!$grafico) {
            return redirect()->route('graficovehiculo.index')->with('error', 'Marca no encontrada.');
        }

        // Elimina el archivo asociado si existe
        if ($grafico->ruta_archivo) {
            $filePath = storage_path('app/public/graficos/' . $grafico->ruta_archivo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Elimina el registro en la base de datos
        $grafico->delete();

        return redirect()->route('graficovehiculo.index')->with('success', 'Marca eliminada exitosamente.');
    }
}
