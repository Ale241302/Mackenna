@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Clientes Empresas</h1>

        <!-- Habilita el botón de crear solo si el usuario tiene el permiso correspondiente -->
        @if (in_array(61, $permisosUsuario))
            <div class="d-flex justify-content-end mb-3">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createClientEmpresaModal">+
                    Crear
                    Cliente</a>
            </div>
        @endif
        <form id="search-form" action="{{ route('clientesempresa.index') }}" method="GET" class="mb-3">
            <br />
            <div class="input-group">
                <input type="text" id="search-input" name="search" class="form-control"
                    placeholder="Buscar por nombre..." value="{{ $search }}">
            </div>
        </form>
        <div class="table-responsive">
            <table class="table ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Razon Social</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientesEmpresas as $cliente)
                        <tr>
                            @if (in_array(60, $permisosUsuario))
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->name }}</td>
                                <td>{{ $cliente->razon_social }}</td>
                                <td>{{ $cliente->email }}</td>
                            @endif
                            <td>
                                <div class="d-flex align-items-center">
                                    @if (in_array(60, $permisosUsuario))
                                        <a href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #808080; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#verEmpresaModal"
                                            data-id="{{ $cliente->id }}" data-name="{{ $cliente->name }}"
                                            data-cuenta_contable="{{ $cliente->cuenta_contable }}"
                                            data-razon_social="{{ $cliente->razon_social }}"
                                            data-sector_economico="{{ $cliente->sector_economico }}"
                                            data-direccion="{{ $cliente->direccion }}"
                                            data-codigo_postal="{{ $cliente->codigo_postal }}"
                                            data-municipio="{{ $cliente->municipio }}" data-pais="{{ $cliente->pais }}"
                                            data-persona_contacto="{{ $cliente->persona_contacto }}"
                                            data-tipo_documento="{{ $cliente->tipo_documento }}"
                                            data-numero_documento="{{ $cliente->numero_documento }}"
                                            data-pais_documento="{{ $cliente->pais_documento }}"
                                            data-numero_contacto="{{ $cliente->numero_contacto }}"
                                            data-email="{{ $cliente->email }}" data-web="{{ $cliente->web }}"
                                            data-sucursal="{{ $cliente->sucursal }}"
                                            data-idiomas="{{ $cliente->idiomas }}"
                                            data-observaciones="{{ $cliente->observaciones }}"
                                            data-medio_pago="{{ $cliente->medio_pago }}"
                                            data-dias_credito="{{ $cliente->dias_credito }}"
                                            data-canal="{{ $cliente->canal }}" data-vent_dia="{{ $cliente->vent_dia }}"
                                            data-vehiculo_propio="{{ $cliente->vehiculo_propio }}"
                                            data-acuerdos="{{ $cliente->acuerdos }}"
                                            data-opciones="{{ $cliente->opciones }}"
                                            data-tarifas="{{ $cliente->tarifas }}"
                                            data-documentos2="{{ $cliente->documentos2 }}"
                                            data-estado_cliente="{{ $cliente->estado_cliente }}"
                                            data-extras="{{ $cliente->extras }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    @if (in_array(62, $permisosUsuario))
                                        <a href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #1814F3; font-size: 20px; "
                                            data-bs-toggle="modal" data-bs-target="#editclienteempresaModal"
                                            data-id="{{ $cliente->id }}" data-name="{{ $cliente->name }}"
                                            data-cuenta_contable="{{ $cliente->cuenta_contable }}"
                                            data-razon_social="{{ $cliente->razon_social }}"
                                            data-sector_economico="{{ $cliente->sector_economico }}"
                                            data-direccion="{{ $cliente->direccion }}"
                                            data-codigo_postal="{{ $cliente->codigo_postal }}"
                                            data-municipio="{{ $cliente->municipio }}" data-pais="{{ $cliente->pais }}"
                                            data-persona_contacto="{{ $cliente->persona_contacto }}"
                                            data-tipo_documento="{{ $cliente->tipo_documento }}"
                                            data-numero_documento="{{ $cliente->numero_documento }}"
                                            data-pais_documento="{{ $cliente->pais_documento }}"
                                            data-numero_contacto="{{ $cliente->numero_contacto }}"
                                            data-email="{{ $cliente->email }}" data-web="{{ $cliente->web }}"
                                            data-sucursal="{{ $cliente->sucursal }}"
                                            data-idiomas="{{ $cliente->idiomas }}"
                                            data-observaciones="{{ $cliente->observaciones }}"
                                            data-medio_pago="{{ $cliente->medio_pago }}"
                                            data-dias_credito="{{ $cliente->dias_credito }}"
                                            data-canal="{{ $cliente->canal }}" data-vent_dia="{{ $cliente->vent_dia }}"
                                            data-vehiculo_propio="{{ $cliente->vehiculo_propio }}"
                                            data-acuerdos="{{ $cliente->acuerdos }}"
                                            data-opciones="{{ $cliente->opciones }}"
                                            data-tarifas="{{ $cliente->tarifas }}"
                                            data-documentos2="{{ $cliente->documentos2 }}"
                                            data-estado_cliente="{{ $cliente->estado_cliente }}"
                                            data-extras="{{ $cliente->extras }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                    @if (in_array(63, $permisosUsuario))
                                        <button type="button" class="btn btn-danger me-2"
                                            style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                            data-action="{{ route('clientesempresa.destroy', $cliente->id) }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

    @include('clientesempresa.create')
    @include('clientesempresa.edit')
    @include('clientesempresa.ver')

    <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" action="" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#search-input').on('input', function() {
                var search = $(this).val();
                $.ajax({
                    url: '{{ route('clientesempresa.index') }}',
                    method: 'GET',
                    data: {
                        search: search
                    },
                    success: function(response) {
                        // Actualiza el contenido de la tabla con los nuevos resultados
                        $('tbody').html($(response).find('tbody').html());
                    }
                });
            });
            var confirmDeleteModal = document.getElementById('confirmDeleteModal');
            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var actionUrl = button.getAttribute('data-action');
                var form = document.getElementById('deleteForm');
                form.action = actionUrl;
            });

            var createClientModal = document.getElementById('createClientModal');
            if (createClientModal) {
                createClientModal.addEventListener('hidden.bs.modal', function() {
                    window.location.reload();
                });
            }


        });
    </script>
@endsection
