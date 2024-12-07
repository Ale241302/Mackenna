@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex-grow-1 text-center mb-0">Modelos Vehículos</h1>
        <br />

        <!-- Habilita el botón de crear solo si el usuario tiene el permiso correspondiente -->
        @if (in_array(38, $permisosUsuario))
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModeloModal">+Crear
                    Modelo</a>
            </div>
        @endif
        <br />

        <form id="search-form" action="{{ route('modelovehiculo.index') }}" method="GET" class="mb-3">
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
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Tipo Vehiculo</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($modelos as $modelo)
                        <tr>
                            @if (in_array(37, $permisosUsuario))
                                <td>{{ $modelo->id }}</td>
                                <td>{{ $modelo->nombre }}</td>
                                <td>{{ $modelo->marca }}</td>
                                <td>{{ $tipo_vehiculo[$modelo->grupo]->nombre ?? 'No disponible' }}</td>
                            @endif




                            <td>
                                <div class="d-flex align-items-center">
                                    <!-- Habilita el botón de editar solo si el usuario tiene el permiso correspondiente -->
                                    @if (in_array(37, $permisosUsuario))
                                        <a href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #808080; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#verModeloModal"
                                            data-id="{{ $modelo->id }}" data-name="{{ $modelo->nombre }}"
                                            data-marca="{{ $modelo->marca }}"
                                            data-tipo_combustible="{{ $modelo->tipo_combustible }}"
                                            data-capacidad_combustible="{{ $modelo->capacidad_combustible }}"
                                            data-tipo_caja="{{ $modelo->tipo_caja }}"
                                            data-equipamiento_vehiculo="{{ json_encode($modelo->equipamiento_vehiculo) }}"
                                            data-tipo_itv="{{ $modelo->tipo_itv }}"
                                            data-grafico_vehiculo_id="{{ $modelo->grafico_vehiculo_id }}"
                                            data-tipo_vehiculo="{{ $modelo->tipo_vehiculo }}"
                                            data-grupo="{{ $modelo->grupo }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    @if (in_array(39, $permisosUsuario))
                                        <a href="#" class="btn btn-warning me-2"
                                            style="border-color: white; background-color: white; color: #1814F3; font-size: 20px; "
                                            data-bs-toggle="modal" data-bs-target="#editModeloModal"
                                            data-id="{{ $modelo->id }}" data-name="{{ $modelo->nombre }}"
                                            data-marca="{{ $modelo->marca }}"
                                            data-tipo_combustible="{{ $modelo->tipo_combustible }}"
                                            data-capacidad_combustible="{{ $modelo->capacidad_combustible }}"
                                            data-tipo_caja="{{ $modelo->tipo_caja }}"
                                            data-equipamiento_vehiculo="{{ json_encode($modelo->equipamiento_vehiculo) }}"
                                            data-tipo_itv="{{ $modelo->tipo_itv }}"
                                            data-grafico_vehiculo_id="{{ $modelo->grafico_vehiculo_id }}"
                                            data-tipo_vehiculo="{{ $modelo->tipo_vehiculo }}"
                                            data-grupo="{{ $modelo->grupo }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                    @if (in_array(40, $permisosUsuario))
                                        <button type="button" class="btn btn-danger me-2"
                                            style="border-color: white; background-color: white; color: red; font-size: 20px;"
                                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                            data-action="{{ route('modelovehiculo.destroy', $modelo->id) }}">
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

    @include('modelovehiculo.create')
    @include('modelovehiculo.edit')
    @include('modelovehiculo.ver')

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
                    url: '{{ route('modelovehiculo.index') }}',
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

            var createModeloModal = document.getElementById('createModeloModal');
            createModeloModal.addEventListener('hidden.bs.modal', function() {
                window.location.reload();
            });
            var editModeloModal = document.getElementById('editModeloModal');
            if (editModeloModal) {
                editModeloModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;

                    // Obtener los valores de los atributos data- del botón
                    var modeloId = button.getAttribute('data-id');
                    var nombre = button.getAttribute('data-name');
                    var marca = button.getAttribute('data-marca');
                    var tipoCombustible = button.getAttribute('data-tipo_combustible');
                    var capacidadCombustible = button.getAttribute('data-capacidad_combustible');
                    var tipoCaja = button.getAttribute('data-tipo_caja');
                    var equipamientoVehiculo = button.getAttribute('data-equipamiento_vehiculo');
                    var tipoItv = button.getAttribute('data-tipo_itv');
                    var graficoVehiculoId = button.getAttribute('data-grafico_vehiculo_id');
                    var tipoVehiculo = button.getAttribute('data-tipo_vehiculo');
                    var grupo = button.getAttribute('data-grupo');

                    var form = document.getElementById('editModeloForm');
                    form.action = `/modelovehiculo/${modeloId}`; // Actualiza la acción del formulario

                    // Actualiza los campos del formulario
                    form.querySelector('input[name="id"]').value = modeloId;
                    form.querySelector('input[name="nombre"]').value = nombre;
                    form.querySelector('select[name="marca"]').value = marca;
                    form.querySelector('select[name="tipo_combustible"]').value = tipoCombustible;
                    form.querySelector('input[name="capacidad_combustible"]').value = capacidadCombustible;
                    form.querySelector('select[name="tipo_caja"]').value = tipoCaja;
                    form.querySelector('select[name="tipo_itv"]').value = tipoItv;
                    form.querySelector('select[name="tipo_vehiculo"]').value = tipoVehiculo;
                    form.querySelector('select[name="grupo"]').value = grupo;

                    // Actualizar los checkboxes para equipamientos y accesorios
                    updateCheckboxes('equipamiento_vehiculo[]', equipamientoVehiculo);

                    // Actualizar la imagen del gráfico
                    var graficoSelect = form.querySelector('select[name="grafico_vehiculo_id"]');
                    var graficoImagen = document.getElementById('edit_grafico_imagen');
                    var errorMessage = document.getElementById('error-message');

                    graficoSelect.value = graficoVehiculoId;
                    var selectedOption = graficoSelect.options[graficoSelect.selectedIndex];
                    var rutaArchivo = selectedOption.getAttribute('data-ruta');

                    if (rutaArchivo) {
                        graficoImagen.src = rutaArchivo;
                        graficoImagen.style.display = 'block';
                        errorMessage.style.display = 'none';
                    } else {
                        graficoImagen.src = '';
                        graficoImagen.style.display = 'none';
                        errorMessage.style.display = 'block';
                    }

                    function updateCheckboxes(name, values) {
                        if (!values) return;
                        values = JSON.parse(values);
                        form.querySelectorAll(`input[name="${name}"]`).forEach(checkbox => {
                            checkbox.checked = values.includes(checkbox.value);
                        });
                    }
                });
            }

            var verModeloModal = document.getElementById('verModeloModal');
            if (verModeloModal) {
                verModeloModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;

                    // Obtener los valores de los atributos data- del botón
                    var modeloId = button.getAttribute('data-id');
                    var nombre = button.getAttribute('data-name');
                    var marca = button.getAttribute('data-marca');
                    var tipoCombustible = button.getAttribute('data-tipo_combustible');
                    var capacidadCombustible = button.getAttribute('data-capacidad_combustible');
                    var tipoCaja = button.getAttribute('data-tipo_caja');
                    var equipamientoVehiculo = button.getAttribute('data-equipamiento_vehiculo');
                    var tipoItv = button.getAttribute('data-tipo_itv');
                    var graficoVehiculoId = button.getAttribute('data-grafico_vehiculo_id');
                    var tipoVehiculo = button.getAttribute('data-tipo_vehiculo');
                    var grupo = button.getAttribute('data-grupo');

                    var form = document.getElementById('verModeloForm');
                    form.action = `/modelovehiculo/${modeloId}`; // Actualiza la acción del formulario

                    // Actualiza los campos del formulario
                    form.querySelector('input[name="id"]').value = modeloId;
                    form.querySelector('input[name="nombre"]').value = nombre;
                    form.querySelector('select[name="marca"]').value = marca;
                    form.querySelector('select[name="tipo_combustible"]').value = tipoCombustible;
                    form.querySelector('input[name="capacidad_combustible"]').value = capacidadCombustible;
                    form.querySelector('select[name="tipo_caja"]').value = tipoCaja;
                    form.querySelector('select[name="tipo_itv"]').value = tipoItv;
                    form.querySelector('select[name="tipo_vehiculo"]').value = tipoVehiculo;
                    form.querySelector('select[name="grupo"]').value = grupo;

                    // Actualizar los checkboxes para equipamientos y accesorios
                    updateCheckboxes('equipamiento_vehiculo[]', equipamientoVehiculo);

                    // Actualizar la imagen del gráfico
                    var graficoSelect = form.querySelector('select[name="grafico_vehiculo_id"]');
                    var graficoImagen = document.getElementById('edit_grafico_imagen2');
                    var errorMessage = document.getElementById('error-message');

                    graficoSelect.value = graficoVehiculoId;
                    var selectedOption = graficoSelect.options[graficoSelect.selectedIndex];
                    var rutaArchivo = selectedOption.getAttribute('data-ruta');

                    if (rutaArchivo) {
                        graficoImagen.src = rutaArchivo;
                        graficoImagen.style.display = 'block';
                        errorMessage.style.display = 'none';
                    } else {
                        graficoImagen.src = '';
                        graficoImagen.style.display = 'none';
                        errorMessage.style.display = 'block';
                    }

                    function updateCheckboxes(name, values) {
                        if (!values) return;
                        values = JSON.parse(values);
                        form.querySelectorAll(`input[name="${name}"]`).forEach(checkbox => {
                            checkbox.checked = values.includes(checkbox.value);
                        });
                    }
                });
            }
        });
    </script>
@endsection
