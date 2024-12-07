@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Clientes Particulares</h1>

        <!-- Habilita el botón de crear solo si el usuario tiene el permiso correspondiente -->
        @if (in_array(61, $permisosUsuario))
            <div class="d-flex justify-content-end mb-3">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createClientParticularModal">+
                    Crear
                    Cliente</a>
            </div>
        @endif
        <form id="search-form" action="{{ route('clientesparticular.index') }}" method="GET" class="mb-3">
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
                        <th>Numero Documento</th>
                        <th>Numero Carnet</th>
                        <th>Email</th>
                        <th>Numero Telefonico</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientesparticular as $cliente)
                        <tr>
                            @if (in_array(60, $permisosUsuario))
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->name }}</td>
                                <td>{{ $cliente->numero_documento }}</td>
                                <td>{{ $cliente->numero_carnet }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->numero_contacto }}</td>
                            @endif
                            <td>
                                <div class="d-flex align-items-center">
                                    @if (in_array(60, $permisosUsuario))
                                        <a href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #808080; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#verparticularModal"
                                            data-id="{{ $cliente->id }}" data-name="{{ $cliente->name }}"
                                            data-cuenta_contable="{{ $cliente->cuenta_contable }}"
                                            data-estado="{{ $cliente->estado }}"
                                            data-tipo_documento="{{ $cliente->tipo_documento }}"
                                            data-numero_documento="{{ $cliente->numero_documento }}"
                                            data-municipio="{{ $cliente->municipio }}" data-paisn="{{ $cliente->paisn }}"
                                            data-fachadoc="{{ $cliente->fachadoc }}"
                                            data-fachacadoc="{{ $cliente->fachacadoc }}"
                                            data-numero_carnet="{{ $cliente->numero_carnet }}"
                                            data-ciudad_carnet="{{ $cliente->ciudad_carnet }}"
                                            data-pais_carnet="{{ $cliente->pais_carnet }}"
                                            data-fachacarnet="{{ $cliente->fachacarnet }}"
                                            data-fachacacarnet="{{ $cliente->fachacacarnet }}"
                                            data-tipo_carnet="{{ $cliente->tipo_carnet }}"
                                            data-ciudad_nacido="{{ $cliente->ciudad_nacido }}"
                                            data-pais_nacido="{{ $cliente->pais_nacido }}"
                                            data-fachanacido="{{ $cliente->fachanacido }}"
                                            data-incidencias="{{ $cliente->incidencias }}"
                                            data-numero_contacto="{{ $cliente->numero_contacto }}"
                                            data-email="{{ $cliente->email }}" data-canal="{{ $cliente->canal }}"
                                            data-pais="{{ $cliente->pais }}"
                                            data-documentos2="{{ $cliente->documentos2 }}"
                                            data-direccionh="{{ $cliente->direccionh }}"
                                            data-codigo_postalh="{{ $cliente->codigo_postalh }}"
                                            data-ciudadh="{{ $cliente->ciudadh }}"
                                            data-pais_nacidoh="{{ $cliente->pais_nacidoh }}"
                                            data-direccionl="{{ $cliente->direccionl }}"
                                            data-codigo_postallocal="{{ $cliente->codigo_postallocal }}"
                                            data-ciudadl="{{ $cliente->ciudadl }}"
                                            data-pais_nacidol="{{ $cliente->pais_nacidol }}"
                                            data-clienteempresa="{{ $cliente->clienteempresa }}"
                                            data-incluir_mailing="{{ $cliente->incluir_mailing }}"
                                            data-medio_pago="{{ $cliente->medio_pago }}"
                                            data-observaciones="{{ $cliente->observaciones }}"
                                            data-idiomas="{{ $cliente->idiomas }}" data-avisos="{{ $cliente->avisos }}"
                                            data-canales_restringidos="{{ $cliente->canales_restringidos }}"
                                            data-consentimiento="{{ $cliente->consentimiento }}"
                                            data-consentimiento_fecha="{{ $cliente->consentimiento_fecha }}"
                                            data-fechas="{{ $cliente->fechas }}" data-apellido="{{ $cliente->apellido }}"
                                            data-genero="{{ $cliente->genero }}"> <i class="fas fa-eye"></i>

                                        </a>
                                    @endif
                                    @if (in_array(62, $permisosUsuario))
                                        <a href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #1814F3; font-size: 20px; "
                                            data-bs-toggle="modal" data-bs-target="#editclienteparticularModal"
                                            data-id="{{ $cliente->id }}" data-name="{{ $cliente->name }}"
                                            data-cuenta_contable="{{ $cliente->cuenta_contable }}"
                                            data-estado="{{ $cliente->estado }}"
                                            data-tipo_documento="{{ $cliente->tipo_documento }}"
                                            data-numero_documento="{{ $cliente->numero_documento }}"
                                            data-municipio="{{ $cliente->municipio }}" data-paisn="{{ $cliente->paisn }}"
                                            data-fachadoc="{{ $cliente->fachadoc }}"
                                            data-fachacadoc="{{ $cliente->fachacadoc }}"
                                            data-numero_carnet="{{ $cliente->numero_carnet }}"
                                            data-ciudad_carnet="{{ $cliente->ciudad_carnet }}"
                                            data-pais_carnet="{{ $cliente->pais_carnet }}"
                                            data-fachacarnet="{{ $cliente->fachacarnet }}"
                                            data-fachacacarnet="{{ $cliente->fachacacarnet }}"
                                            data-tipo_carnet="{{ $cliente->tipo_carnet }}"
                                            data-ciudad_nacido="{{ $cliente->ciudad_nacido }}"
                                            data-pais_nacido="{{ $cliente->pais_nacido }}"
                                            data-fachanacido="{{ $cliente->fachanacido }}"
                                            data-incidencias="{{ $cliente->incidencias }}"
                                            data-numero_contacto="{{ $cliente->numero_contacto }}"
                                            data-email="{{ $cliente->email }}" data-canal="{{ $cliente->canal }}"
                                            data-pais="{{ $cliente->pais }}"
                                            data-documentos2="{{ $cliente->documentos2 }}"
                                            data-direccionh="{{ $cliente->direccionh }}"
                                            data-codigo_postalh="{{ $cliente->codigo_postalh }}"
                                            data-ciudadh="{{ $cliente->ciudadh }}"
                                            data-pais_nacidoh="{{ $cliente->pais_nacidoh }}"
                                            data-direccionl="{{ $cliente->direccionl }}"
                                            data-codigo_postallocal="{{ $cliente->codigo_postallocal }}"
                                            data-ciudadl="{{ $cliente->ciudadl }}"
                                            data-pais_nacidol="{{ $cliente->pais_nacidol }}"
                                            data-clienteempresa="{{ $cliente->clienteempresa }}"
                                            data-incluir_mailing="{{ $cliente->incluir_mailing }}"
                                            data-medio_pago="{{ $cliente->medio_pago }}"
                                            data-observaciones="{{ $cliente->observaciones }}"
                                            data-idiomas="{{ $cliente->idiomas }}" data-avisos="{{ $cliente->avisos }}"
                                            data-canales_restringidos="{{ $cliente->canales_restringidos }}"
                                            data-consentimiento="{{ $cliente->consentimiento }}"
                                            data-consentimiento_fecha="{{ $cliente->consentimiento_fecha }}"
                                            data-fechas="{{ $cliente->fechas }}"
                                            data-apellido="{{ $cliente->apellido }}"
                                            data-genero="{{ $cliente->genero }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                    @if (in_array(63, $permisosUsuario))
                                        <button type="button" class="btn btn-danger me-2"
                                            style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                            data-action="{{ route('clientesparticular.destroy', $cliente->id) }}">
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

    @include('clientesparticular.create')
    @include('clientesparticular.edit')
    @include('clientesparticular.ver')

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
                    url: '{{ route('clientesparticular.index') }}',
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
