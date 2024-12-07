@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex-grow-1 text-center mb-0">Llavero Vehículos</h1>
        <br />

        @if (in_array(46, $permisosUsuario))
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLlaveModal">+Crear
                    llave</a>
            </div>
        @endif
        <br />

        <form id="search-form" action="{{ route('llavevehiculo.index') }}" method="GET" class="mb-3">
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
                        <th>Patente</th>
                        <th>Llave</th>
                        <th>QR</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($codes as $code)
                        <tr>
                            @if (in_array(45, $permisosUsuario))
                                <td>{{ $code->id }}</td>
                                <td>{{ $code->placa }}</td>
                                <td>{{ $code->llave }}</td>
                                <td>
                                    @if ($code->codigo_qr)
                                        <img src="{{ asset('storage/' . $code->codigo_qr) }}" alt="{{ $code->llave }}"
                                            style="max-width: 100px; height: auto;">
                                    @else
                                        <span>No disponible</span>
                                    @endif
                                </td>
                            @endif
                            <td class="action-buttons">

                                @if (in_array(47, $permisosUsuario))
                                    <button type="button" class="btn btn-danger me-2"
                                        style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                        data-action="{{ route('llavevehiculo.destroy', $code->id) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('llavevehiculo.create')



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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#search-input').on('input', function() {
                var search = $(this).val();
                $.ajax({
                    url: '{{ route('llavevehiculo.index') }}',
                    method: 'GET',
                    data: {
                        search: search
                    },
                    success: function(response) {
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

            $('#editLlavevehiculoModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que abrió el modal
                var id = button.data('id'); // Extraer info de los atributos data-*

                var modal = $(this);
                $.ajax({
                    url: '/llavevehiculo/' + id + '/edit',
                    method: 'GET',
                    success: function(data) {
                        modal.find('#placaId').val(data.id);
                        modal.find('#placa').val(data.id);
                    }
                });
            });
        });
    </script>
@endsection
