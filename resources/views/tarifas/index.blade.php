@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex-grow-1 text-center mb-0">Tarifas</h1>
        <br />

        <!-- Habilita el botón de crear solo si el usuario tiene el permiso correspondiente -->
        @if (in_array(13, $permisosUsuario))
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTarifaModal">+Crear
                    Tarifa</a>
            </div>
        @endif
        <br />

        <form id="search-form" action="{{ route('tarifas.index') }}" method="GET" class="mb-3">
            <br />
            <div class="input-group">
                <input type="text" id="search-input" name="search" class="form-control"
                    placeholder="Buscar por nombre..." value="{{ $search }}">
            </div>
        </form>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Sucursal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tarifas as $tarifa)
                        <tr>
                            @if (in_array(14, $permisosUsuario))
                                <td>{{ $tarifa->id }}</td>
                                <td>{{ $tarifa->codigo }}</td>
                                <td>{{ $tarifa->nombre }}</td>
                                <td>{{ $sucursal[$tarifa->sucursal]->nombre ?? 'No disponible' }}</td>
                            @endif

                            <td>
                                <div class="d-flex align-items-center">
                                    @if (in_array(15, $permisosUsuario))
                                        <!-- Habilita el botón de editar solo si el usuario tiene el permiso correspondiente -->
                                        <a href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #1814F3; font-size: 20px; "
                                            data-bs-toggle="modal" data-bs-target="#editTarifaModal"
                                            data-id="{{ $tarifa->id }}" data-name="{{ $tarifa->nombre }}"
                                            data-sucursal="{{ $tarifa->sucursal }}" data-codigo="{{ $tarifa->codigo }}"
                                            data-precios_kms_fijo="{{ $tarifa->precios_kms_fijo }}"
                                            data-precios_kms_hora="{{ $tarifa->precios_kms_hora }}"
                                            data-precios_kms_dia="{{ $tarifa->precios_kms_dia }}"
                                            data-precios_kms="{{ $tarifa->precios_kms }}"
                                            data-incrementos_kms_fijo="{{ $tarifa->incrementos_kms_fijo }}"
                                            data-incrementos_kms_hora="{{ $tarifa->incrementos_kms_hora }}"
                                            data-incrementos_kms_dia="{{ $tarifa->incrementos_kms_dia }}"
                                            data-incrementos_kms="{{ $tarifa->incrementos_kms }}"
                                            data-precios="{{ $tarifa->precio }}"
                                            data-incrementos="{{ $tarifa->incremento }}"
                                            data-precio_hora="{{ $tarifa->precio_hora }}"
                                            data-incremento_hora="{{ $tarifa->incremento_hora }}"
                                            data-precio_kms="{{ $tarifa->precio_kms }}"
                                            data-incremento_kms2="{{ $tarifa->incremento_kms2 }}"
                                            data-precio_dia="{{ $tarifa->precio_dia }}"
                                            data-incremento_dia="{{ $tarifa->incremento_dia }}"
                                            data-recargo_fijo="{{ $tarifa->recargo_fijo }}"
                                            data-recargo_bimensual="{{ $tarifa->recargo_bimensual }}"
                                            data-precio_bimensual="{{ $tarifa->precio_bimensual }}"
                                            data-incremento_bimensual="{{ $tarifa->incremento_bimensual }}"
                                            data-precios_kms_bimensual="{{ $tarifa->precios_kms_bimensual }}"
                                            data-incrementos_kms_bimensual="{{ $tarifa->incrementos_kms_bimensual }}"
                                            data-recargo_mensual="{{ $tarifa->recargo_mensual }}"
                                            data-precio_mensual="{{ $tarifa->precio_mensual }}"
                                            data-incremento_mensual="{{ $tarifa->incremento_mensual }}"
                                            data-precios_kms_mensual="{{ $tarifa->precios_kms_mensual }}"
                                            data-incrementos_kms_mensual="{{ $tarifa->incrementos_kms_mensual }}"
                                            data-recargo_semanal="{{ $tarifa->recargo_semanal }}"
                                            data-precio_semanal="{{ $tarifa->precio_semanal }}"
                                            data-incremento_semanal="{{ $tarifa->incremento_semanal }}"
                                            data-precios_kms_semanal="{{ $tarifa->precios_kms_semanal }}"
                                            data-incrementos_kms_semanal="{{ $tarifa->incrementos_kms_semanal }}"
                                            data-recargo_dia="{{ $tarifa->recargo_dia }}"
                                            data-recargo_kms="{{ $tarifa->recargo_kms }}"
                                            data-recargo_hora="{{ $tarifa->recargo_hora }}">
                                            <i class="fas
                                        fa-edit"></i>
                                        </a>
                                    @endif
                                    @if (in_array(16, $permisosUsuario))
                                        <!-- Habilita el botón de eliminar solo si el usuario tiene el permiso correspondiente -->
                                        <button type="button" class="btn btn-danger me-2"
                                            style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                            data-action="{{ route('tarifas.destroy', $tarifa->id) }}">
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

    @include('tarifas.create')
    @include('tarifas.edit')

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
                    url: '{{ route('tarifas.index') }}',
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
                var button = event.relatedTarget; // Botón que abrió el modal
                var actionUrl = button.getAttribute('data-action'); // URL de la acción de eliminación

                var form = document.getElementById('deleteForm');
                form.action = actionUrl; // Actualiza la acción del formulario
            });

            var createTarifaModal = document.getElementById('createTarifaModal');
            createTarifaModal.addEventListener('hidden.bs.modal', function() {
                window.location.reload();
            });
        });
    </script>
@endsection
