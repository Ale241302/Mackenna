<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ClienteEmpresa;
use App\Models\UserGroup; // Asegúrate de importar el modelo UserGroup

class ValidatorClienteController extends Controller
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

        // Consulta los clientes particulares y empresas con el filtro de búsqueda
        $clientesParticularesQuery = Cliente::where('estado_cliente', 'aprobado');
        $clientesEmpresasQuery = ClienteEmpresa::where('estado_cliente', 'aprobado');

        if (!empty($search)) {
            $clientesParticularesQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });

            $clientesEmpresasQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $clientesParticulares = $clientesParticularesQuery->get();
        $clientesEmpresas = $clientesEmpresasQuery->get();

        return view('clientes.index-validator', [
            'clientesParticulares' => $clientesParticulares,
            'clientesEmpresas' => $clientesEmpresas,
            'search' => $search,
            'permisosUsuario' => $permisosUsuario, // Pasa los permisos a la vista
        ]);
    }
}
