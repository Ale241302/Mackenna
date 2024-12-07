<!doctype html>
<html lang="en">

<head>
    <title>Editar Vehículo</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Carga de JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        #previewList2 {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            /* Espacio reducido entre las imágenes */
            justify-content: start;
            /* Alinea las imágenes al principio del contenedor */
        }

        .file-preview {
            flex: 1 0 21%;
            /* Ajusta el tamaño del contenedor del archivo */
            box-sizing: border-box;
        }

        .preview-img {
            max-width: 200px;
            max-height: 300px;
            display: block;
            margin: 0;
            /* Elimina márgenes para evitar separación extra */
        }

        .delete-btn {
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 5px;
        }

        select {
            color: #000;
            /* Color negro para el texto del select por defecto */
            background-color: #fff;
            /* Fondo blanco para el select */
        }

        /* Estilo para la opción por defecto cuando está seleccionada */
        select option[value=""]:checked {
            color: #d3d3d3;
            /* Color gris claro para la opción por defecto cuando está seleccionada */
        }

        /* Estilo para la opción seleccionada que no es la opción por defecto */
        select option:not([value=""]) {
            color: #000;
            /* Color negro para otras opciones cuando están seleccionadas */
        }

        .default-option {
            color: #ccc;
            /* gris */
        }

        .select-option-selected .default-option {
            color: #000;
            /* negro */
        }

        /* CSS para estilizar los placeholders */
        input::placeholder {
            color: #d3d3d3;
            /* Color gris para el placeholder */
        }

        /* CSS para estilizar los inputs cuando están vacíos */
        input.empty::placeholder {
            color: #d3d3d3;
            /* Color gris para el placeholder */
        }

        /* CSS para estilizar los inputs cuando no están vacíos */
        input:not(.empty) {
            color: #000;
            /* Color negro para el texto del input */
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="modal fade" id="editRegistroModal" tabindex="-1" aria-labelledby="editRegistroModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRegistroModalLabel">Editar Vehículo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (isset($registro) && $registro)
                            <form id="editRegistroForm"
                                action="{{ route('registrovehiculo.update', 'ID_DEL_REGISTRO') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="RegistroId" />
                                <div class="container mt-3">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="datos-tab" data-bs-toggle="tab"
                                                data-bs-target="#datos2" type="button" role="tab"
                                                aria-controls="notas" aria-selected="true">Datos del vehiculo</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                                data-bs-target="#sucursal2" type="button" role="tab"
                                                aria-controls="sucursal" aria-selected="false">Información
                                                Sucursal</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="seguro-tab" data-bs-toggle="tab"
                                                data-bs-target="#seguro2" type="button" role="tab"
                                                aria-controls="seguro" aria-selected="false">Información
                                                Seguro</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="datos2" role="tabpanel">
                                            <br />
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Patente</label>
                                                    <input type="text" name="placa" id="placa2"
                                                        class="form-control" />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                                @php
                                                    $modelos = \App\Models\ModeloVehiculo::all();

                                                @endphp
                                                <div class="col-md-6 mb-3">
                                                    <label for="marca">Modelo</label>
                                                    @if (isset($modelos) && $modelos->isNotEmpty())
                                                        <select id="modelo2" name="modelo" class="form-control"
                                                            required>
                                                            <option value="">Seleccione un modelo</option>
                                                            @foreach ($modelos as $modelo)
                                                                <option value="{{ $modelo->id }}"
                                                                    data-capacidad_combustible2="{{ encode_if_array($modelo->capacidad_combustible) }}"
                                                                    data-tipo_combustible2="{{ encode_if_array($modelo->tipo_combustible) }}"
                                                                    data-tipo_caja2="{{ encode_if_array($modelo->tipo_caja) }}"
                                                                    data-equipamiento_vehiculo2="{{ encode_if_array($modelo->equipamiento_vehiculo) }}"
                                                                    data-accesorio_vehiculo2="{{ encode_if_array($modelo->accesorio_vehiculo) }}"
                                                                    data-grupo2="{{ encode_if_array($modelo->grupo) }}"
                                                                    data-marca2="{{ encode_if_array($modelo->marca) }}"
                                                                    data-tipo_vehiculo2="{{ encode_if_array($modelo->tipo_vehiculo) }}"{{ $registro->modelo == $modelo->id ? 'selected' : '' }}>
                                                                    {{ $modelo->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <p>No hay modelos disponibles.</p>
                                                    @endif
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="chasis" class="form-label">Chasis</label>
                                                    <input type="text" name="chasis" id="chasis2"
                                                        class="form-control" placeholder="Ingresar Codigo Chasis"
                                                        required maxlength="20" />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="color" class="form-label">Color</label>
                                                    <select name="color" id="color2" class="form-control"
                                                        required>
                                                        <option value="">Seleccione un color</option>
                                                        <option value="blanco"
                                                            {{ $registro->color == 'blanco' ? 'selected' : '' }}>Blanco
                                                        </option>
                                                        <option value="rojo"
                                                            {{ $registro->color == 'rojo' ? 'selected' : '' }}>Rojo
                                                        </option>
                                                        <option value="negro"
                                                            {{ $registro->color == 'negro' ? 'selected' : '' }}>Negro
                                                        </option>
                                                        <option value="gris"
                                                            {{ $registro->color == 'gris' ? 'selected' : '' }}>Gris
                                                        </option>
                                                        <option value="verde"
                                                            {{ $registro->color == 'verde' ? 'selected' : '' }}>Verde
                                                        </option>
                                                        <option value="amarillo"
                                                            {{ $registro->color == 'amarillo' ? 'selected' : '' }}>
                                                            Amarillo
                                                        </option>
                                                        <option value="azul"
                                                            {{ $registro->color == 'azul' ? 'selected' : '' }}>Azul
                                                        </option>
                                                        <option value="cafe"
                                                            {{ $registro->color == 'cafe' ? 'selected' : '' }}>Café
                                                        </option>
                                                        ¿
                                                    </select>
                                                    <div class="error-message text-danger" id="colorError"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="kilometraje" class="form-label">Kilometraje</label>
                                                    <input type="number" name="kilometros" id="kilometros2"
                                                        class="form-control" placeholder="Ingresar Kms" required
                                                        maxlength="10" oninput="formatNumber(this)" />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                    <script>
                                                        function formatNumber(input) {
                                                            let value = input.value;
                                                            value = value.replace(/[\.,]/g, '');
                                                            value = Math.abs(value);
                                                            input.value = value;
                                                        }
                                                    </script>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="fecha_patente" class="form-label">Fecha
                                                        Patente</label>
                                                    <input type="date" name="fecha" id="fecha2"
                                                        class="form-control" required />
                                                    <div class="error-message text-danger" id="fechaPatenteError">
                                                    </div>
                                                </div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var today = new Date().toISOString().split('T')[0];
                                                        document.getElementById('fecha2').setAttribute('max', today);
                                                    });
                                                </script>

                                            </div>
                                            <div class="row">
                                                @php
                                                    $tipos = \App\Models\TipoVehiculo::all();
                                                @endphp
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia">Grupo de Vehículo</label>
                                                    @if (isset($tipos) && $tipos->isNotEmpty())
                                                        <select id="grupo2" name="grupo" class="form-control"
                                                            disabled>
                                                            <option value="">Seleccione un grupo de vehículo
                                                            </option>
                                                            @foreach ($tipos as $tipo)
                                                                <option value="{{ $tipo->id }}">
                                                                    {{ $tipo->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" id="grupo_hidden2" name="grupo">
                                                    @else
                                                        <p>No hay tipo vehiculo disponibles.</p>
                                                    @endif
                                                </div>
                                                @php
                                                    $cajas = \App\Models\TipoCaja::all();
                                                @endphp
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia">Tipo de Transmisión</label>
                                                    @if (isset($cajas) && $cajas->isNotEmpty())
                                                        <select id="tipo_caja2" name="tipo_caja" class="form-control"
                                                            disabled>
                                                            <option value="">Seleccione un tipo de caja</option>
                                                            @foreach ($cajas as $caja)
                                                                <option value="{{ $caja->id }}">
                                                                    {{ $caja->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" id="tipo_caja_hidden2"
                                                            name="tipo_caja">
                                                    @else
                                                        <p>No hay tipo caja disponibles.</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                @php
                                                    $combustibles = \App\Models\TipoCombustible::all();
                                                @endphp
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia">Tipo Combustible</label>
                                                    @if (isset($combustibles) && $combustibles->isNotEmpty())
                                                        <select id="tipo_combustible2" name="tipo_combustible"
                                                            class="form-control" disabled>
                                                            <option value="">Seleccione un tipo de combustible
                                                            </option>
                                                            @foreach ($combustibles as $combustible)
                                                                <option value="{{ $combustible->id }}">
                                                                    {{ $combustible->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" id="tipo_combustible_hidden2"
                                                            name="tipo_combustible">
                                                    @else
                                                        <p>No hay combustibles disponibles.</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Capacidad</label>
                                                    <input type="number" name="capacidad_combustible"
                                                        id="capacidad_combustible2" class="form-control"
                                                        placeholder="Ingresar Capacidad" required readonly
                                                        oninput="formatNumber(this)" />
                                                    <div class="error-message text-danger" id="nameError"></div>

                                                </div>

                                            </div>

                                            <div class="row">
                                                @php
                                                    $marcas = \App\Models\MarcaVehiculo::all();
                                                @endphp
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia">Marca</label>
                                                    @if (isset($marcas) && $marcas->isNotEmpty())
                                                        <select id="marca2" name="marca" class="form-control"
                                                            disabled>
                                                            <option value="">Seleccione una marca
                                                            </option>
                                                            @foreach ($marcas as $marca)
                                                                <option value="{{ $marca->id }}">
                                                                    {{ $marca->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" id="marca_hidden2" name="marca">
                                                    @else
                                                        <p>No hay marca disponibles.</p>
                                                    @endif
                                                </div>
                                                @php
                                                    $grupovehiculos = \App\Models\GrupoVehiculo::all();
                                                @endphp
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia">Tipo de Vehículo</label>
                                                    @if (isset($grupovehiculos) && $grupovehiculos->isNotEmpty())
                                                        <select id="tipo_vehiculo2" name="tipo_vehiculo"
                                                            class="form-control" disabled>
                                                            <option value="">Seleccione un tipo de vehículo
                                                            </option>
                                                            @foreach ($grupovehiculos as $grupovehiculo)
                                                                <option value="{{ $grupovehiculo->id }}">
                                                                    {{ $grupovehiculo->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" id="tipo_vehiculo_hidden2"
                                                            name="tipo_vehiculo">
                                                    @else
                                                        <p>No hay tipo de vehiculo disponibles.</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="notas-tab"
                                                                data-bs-toggle="tab" data-bs-target="#notas2"
                                                                type="button" role="tab" aria-controls="notas"
                                                                aria-selected="true">Notas</button>
                                                        </li>

                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="equipamientos-tab"
                                                                data-bs-toggle="tab" data-bs-target="#equipamientos2"
                                                                type="button" role="tab"
                                                                aria-controls="equipamientos"
                                                                aria-selected="false">Equipamientos</button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="notas2"
                                                            role="tabpanel" aria-labelledby="notas-tab">
                                                            <div class="col-md-12 mt-3">
                                                                <label for="nota" class="form-label"></label>
                                                                <label for="notas" class="form-label"></label>
                                                                <textarea name="notas" id="notas3" class="form-control" placeholder="Ingresar información" maxlength="255"
                                                                    rows="2"></textarea>
                                                                <div class="error-message text-danger" id="notaError">
                                                                </div>

                                                            </div>
                                                        </div>


                                                        <div class="tab-pane fade" id="equipamientos2"
                                                            role="tabpanel" aria-labelledby="equipamientos-tab">
                                                            <div class="col-md-12 mt-3">
                                                                <label for="equipamientos" class="form-label"></label>
                                                                @php
                                                                    $equipamientos = \App\Models\EquipamientoVehiculo::all();
                                                                @endphp
                                                                @if (isset($equipamientos) && $equipamientos->isNotEmpty())

                                                                    <br />
                                                                    <div class="row g-3">
                                                                        @foreach ($equipamientos as $equipamiento)
                                                                            <div class="col-md-6">
                                                                                <div class="form-check">
                                                                                    <input
                                                                                        class="form-check-input equipamiento-checkbox"
                                                                                        type="checkbox"
                                                                                        name="equipamiento_vehiculo2[]"
                                                                                        value="{{ $equipamiento->id }}"
                                                                                        id="equipamiento_{{ $equipamiento->id }}">
                                                                                    <label class="form-check-label"
                                                                                        for="equipamiento_{{ $equipamiento->id }}">
                                                                                        {{ $equipamiento->nombre }}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <p>No hay equipamientos disponibles.</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="sucursal2" role="tabpanel"
                                            aria-labelledby="sucursal-tab">
                                            <br />
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia">Uso</label>
                                                    <select id="uso2" name="uso" class="form-control">
                                                        <option value="">Seleccione un uso</option>
                                                        <option value="Alquiler">Alquiler
                                                        </option>
                                                        <option value="Venta">Venta
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia">Propietario</label>
                                                    <select id="propietario2" name="propietario"
                                                        class="form-control">
                                                        <option value="">Seleccione un propietario</option>
                                                        <option value="propipo">
                                                            Vehículo Propio</option>
                                                        <option value="cliente">
                                                            Vehículo Cliente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia">Depósito</label>
                                                    <select id="deposito2" name="deposito" class="form-control">
                                                        <option value="">Seleccione un depósito</option>
                                                        <option value="si">Si</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                                @php
                                                    $sucursal2 = \App\Models\Sucursal::all();
                                                @endphp
                                                <div class="col-md-6 mb-3">
                                                    <label for="sucursal2">Sucursal</label>
                                                    @if (isset($sucursal2) && $sucursal2->isNotEmpty())
                                                        <select id="sucursal3" name="sucursal" class="form-control">
                                                            <option value="">Seleccione una sucursal</option>
                                                            @foreach ($sucursal2 as $sucursalItem)
                                                                <option value="{{ $sucursalItem->id }}">
                                                                    {{ $sucursalItem->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <p>No hay sucursales disponibles.</p>
                                                    @endif
                                                </div>




                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <label for="nota" class="form-label">Aviso</label>
                                                <textarea name="aviso" id="aviso2" class="form-control" placeholder="Ingresar información" maxlength="255"
                                                    rows="4"></textarea>
                                                <div class="error-message text-danger" id="notaError">
                                                </div>
                                                <div id="charCount3">0/255</div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var avisoTextarea = document.getElementById('aviso');
                                                    var charCount3 = document.getElementById('charCount3');
                                                    var notaTextarea = document.getElementById('notas');
                                                    var charCount2 = document.getElementById('charCount2');

                                                    if (avisoTextarea) {
                                                        avisoTextarea.addEventListener('input', function() {
                                                            var currentLength = avisoTextarea.value.length;
                                                            charCount3.textContent = currentLength + '/255';

                                                            if (currentLength > 255) {
                                                                avisoTextarea.value = avisoTextarea.value.substring(0, 255);
                                                                charCount3.textContent = '255/255';
                                                            }
                                                        });
                                                    }

                                                    if (notaTextarea) {
                                                        notaTextarea.addEventListener('input', function() {
                                                            var currentLength = notaTextarea.value.length;
                                                            charCount2.textContent = currentLength + '/255';

                                                            if (currentLength > 255) {
                                                                notaTextarea.value = notaTextarea.value.substring(0, 255);
                                                                charCount2.textContent = '255/255';
                                                            }
                                                        });
                                                    }
                                                });
                                            </script>

                                        </div>
                                        <div class="tab-pane fade" id="seguro2" role="tabpanel"
                                            aria-labelledby="seguro-tab">
                                            <br />

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Compañía</label>
                                                    <input type="text" name="compania_seguro"
                                                        id="compania_seguro2" class="form-control"
                                                        placeholder="Ingresar Nombre" maxlength="20" />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Riesgo</label>
                                                    <input type="text" name="riesgo_seguro" id="riesgo_seguro2"
                                                        class="form-control" placeholder="Ingresar Riesgo"
                                                        maxlength="20" />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Políza</label>
                                                    <input type="text" name="poliza_seguro" id="poliza_seguro2"
                                                        class="form-control" placeholder="Ingresar Políza"
                                                        maxlength="20" />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Asegurado</label>
                                                    <input type="text" name="aseguradora_seguro"
                                                        id="aseguradora_seguro2" class="form-control"
                                                        placeholder="Ingresar Asegurado" maxlength="20" />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Asistencia</label>
                                                    <input type="text" name="asistencia_seguro"
                                                        id="asistencia_seguro2" class="form-control"
                                                        placeholder="Ingresar Asistencia" maxlength="20" />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Número Telefonico</label>
                                                    <input type="number" name="telefono_seguro"
                                                        id="telefono_seguro2" class="form-control"
                                                        placeholder="Ingresar Número Telefonico" maxlength="10" />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Campo para archivo PDF o DOCX -->
                                                <div class="col-md-12 mb-3">
                                                    <label for="archivo" class="form-label">Archivo</label>
                                                    <div class="input-group">
                                                        <input class="form-control" type="file"
                                                            name="documentos[]" id="archivo"
                                                            accept=".pdf, .docx, .jpg, .jpeg, .png, .webp, .gif"
                                                            multiple>
                                                        <button type="button" class="btn btn-primary"
                                                            id="addFileButton">+</button>
                                                    </div>
                                                    <div class="error-message text-danger" id="archivoError"></div>
                                                    <br />
                                                    <div id="previewContainer5" style="display: none;">
                                                        <h5>Previsualización del Documento:</h5>
                                                        <embed id="preview" type="application/pdf" width="100%"
                                                            height="600px" />
                                                        <img id="previewImg" class="preview-img"
                                                            alt="Vista previa de la imagen" />

                                                    </div>
                                                    <div id="previewContainer" style="display: none;">

                                                        <div id="previewList2"></div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div id="additionalFilesContainer"></div>



                                            <script>
                                                document.getElementById('archivo').addEventListener('change', function(event) {
                                                    handleFilePreview(event, 'archivoError', 'previewContainer5', 'preview', 'previewImg');
                                                });

                                                document.getElementById('addFileButton').addEventListener('click', function() {
                                                    addFileField();
                                                });

                                                function handleFilePreview(event, errorId, containerId, previewId, imgId) {
                                                    var file = event.target.files[0];
                                                    var previewContainer = document.getElementById(containerId);
                                                    var preview = document.getElementById(previewId);
                                                    var previewImg = document.getElementById(imgId);
                                                    var errorMessage = document.getElementById(errorId);

                                                    if (file) {
                                                        if (file.type === 'application/pdf' || file.type === 'application/msword' || file.type ===
                                                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                                                            var reader = new FileReader();

                                                            reader.onload = function(e) {
                                                                preview.src = e.target.result;
                                                                previewContainer.style.display = 'block';
                                                                preview.style.display = 'block';
                                                                previewImg.style.display = 'none';
                                                            };

                                                            reader.readAsDataURL(file);
                                                        } else if (file.type.startsWith('image/')) {
                                                            var reader = new FileReader();

                                                            reader.onload = function(e) {
                                                                previewImg.src = e.target.result;
                                                                previewContainer.style.display = 'block';
                                                                previewImg.style.display = 'block';
                                                                preview.style.display = 'none';
                                                            };

                                                            reader.readAsDataURL(file);
                                                        } else {
                                                            previewContainer.style.display = 'none';
                                                            errorMessage.textContent = 'Por favor, suba un archivo válido (PDF, DOCX, JPG, JPEG, PNG, WEBP, GIF).';
                                                        }
                                                    } else {
                                                        previewContainer.style.display = 'none';
                                                    }
                                                }

                                                function addFileField() {
                                                    var container = document.getElementById('additionalFilesContainer');
                                                    var index = container.children.length + 1;

                                                    var row = document.createElement('div');
                                                    row.className = 'row';

                                                    var col = document.createElement('div');
                                                    col.className = 'col-md-12 mb-3';

                                                    var label = document.createElement('label');
                                                    label.className = 'form-label';
                                                    label.htmlFor = 'archivo' + index;
                                                    label.textContent = 'Archivo';

                                                    var inputGroup = document.createElement('div');
                                                    inputGroup.className = 'input-group';

                                                    var input = document.createElement('input');
                                                    input.type = 'file';
                                                    input.name = 'documentos[]';
                                                    input.id = 'archivo' + index;
                                                    input.accept = '.pdf, .docx, .jpg, .jpeg, .png, .webp, .gif';
                                                    input.className = 'form-control';
                                                    input.addEventListener('change', function(event) {
                                                        handleFilePreview(event, 'archivoError' + index, 'previewContainer' + index, 'preview' + index,
                                                            'previewImg' + index);
                                                    });

                                                    var removeButton = document.createElement('button');
                                                    removeButton.type = 'button';
                                                    removeButton.className = 'btn btn-danger';
                                                    removeButton.textContent = 'X';
                                                    removeButton.addEventListener('click', function() {
                                                        container.removeChild(row);
                                                    });

                                                    inputGroup.appendChild(input);
                                                    inputGroup.appendChild(removeButton);

                                                    col.appendChild(label);
                                                    col.appendChild(inputGroup);
                                                    col.appendChild(document.createElement('br'));

                                                    var errorMessage = document.createElement('div');
                                                    errorMessage.className = 'error-message text-danger';
                                                    errorMessage.id = 'archivoError' + index;
                                                    col.appendChild(errorMessage);

                                                    var previewContainer = document.createElement('div');
                                                    previewContainer.id = 'previewContainer' + index;
                                                    previewContainer.style.display = 'none';

                                                    var previewTitle = document.createElement('h5');
                                                    previewTitle.textContent = 'Previsualización del Documento:';
                                                    previewContainer.appendChild(previewTitle);

                                                    var embed = document.createElement('embed');
                                                    embed.id = 'preview' + index;
                                                    embed.type = 'application/pdf';
                                                    embed.width = '100%';
                                                    embed.height = '600px';
                                                    previewContainer.appendChild(embed);

                                                    var img = document.createElement('img');
                                                    img.id = 'previewImg' + index;
                                                    img.className = 'preview-img';
                                                    img.alt = 'Vista previa de la imagen';
                                                    previewContainer.appendChild(img);

                                                    col.appendChild(previewContainer);
                                                    row.appendChild(col);
                                                    container.appendChild(row);
                                                }
                                            </script>



                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg mb-3"
                                                type="submit">Guardar</button>
                                        </div>

                            </form>
                        @else
                            <p>No se encontró el modelo solicitado.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function deleteFile3(file, id) {
                fetch(`/delete-file/${file}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            file: file,
                            id: id
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Actualiza la vista previa de los archivos después de la eliminación
                            updateFilePreviews(id);
                        } else {
                            console.error('Error al eliminar el archivo:', data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            function updateFilePreviews(id) {
                fetch(`/registrovehiculo/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        const documentosString = data.documentos;
                        console.log('Documentos JSON:', documentosString); // Verifica que el JSON sea correcto

                        let documentos;
                        try {
                            documentos = JSON.parse(documentosString);
                            console.log('Documentos Parsed:',
                                documentos); // Verifica que el JSON se parse correctamente
                        } catch (error) {
                            console.error('Error al parsear JSON:', error);
                            documentos = []; // Si hay un error, usamos un array vacío
                        }

                        const previewList = document.getElementById('previewList2');
                        previewList.innerHTML = ''; // Limpiar el contenedor de vistas previas

                        if (documentos && documentos.length > 0) {
                            documentos.forEach((file) => {
                                const baseUrl = 'http://192.168.10.24:8045/storage/graficos/';
                                const filePath = `${baseUrl}${file}`;
                                console.log('File Path:',
                                    filePath); // Verifica que la ruta del archivo sea correcta
                                const fileExtension = file.split('.').pop().toLowerCase();

                                const fileDiv = document.createElement('div');
                                fileDiv.className = 'file-preview';

                                if (['jpg', 'jpeg', 'png', 'webp', 'gif'].includes(fileExtension)) {
                                    const img = document.createElement('img');
                                    img.src = filePath;
                                    img.className = 'preview-img';
                                    img.alt = 'Vista previa de la imagen';
                                    img.style.maxWidth =
                                        '100px'; // Ajustar el tamaño según sea necesario
                                    img.onload = () => console.log('Imagen cargada:',
                                        filePath); // Confirma que la imagen se carga
                                    img.onerror = () => console.error('Error al cargar la imagen:',
                                        filePath); // Muestra errores
                                    fileDiv.appendChild(img);
                                } else if (fileExtension === 'pdf') {
                                    const embed = document.createElement('embed');
                                    embed.src = filePath;
                                    embed.type = 'application/pdf';
                                    embed.width = '100%';
                                    embed.height = '100px'; // Ajustar el tamaño según sea necesario
                                    embed.onload = () => console.log('PDF cargado:',
                                        filePath); // Confirma que el PDF se carga
                                    embed.onerror = () => console.error('Error al cargar el PDF:',
                                        filePath); // Muestra errores
                                    fileDiv.appendChild(embed);
                                } else if (fileExtension === 'docx') {
                                    const docIcon = document.createElement('img');
                                    docIcon.src =
                                        '/storage/graficos/docx-icon.png'; // Ruta del icono DOCX
                                    docIcon.alt = 'Icono DOCX';
                                    docIcon.style.maxWidth =
                                        '100px'; // Ajustar el tamaño según sea necesario
                                    fileDiv.appendChild(docIcon);

                                    const link = document.createElement('a');
                                    link.href = filePath;
                                    link.textContent = 'Descargar Documento';
                                    link.target = '_blank'; // Abre el enlace en una nueva pestaña
                                    fileDiv.appendChild(link);
                                } else {
                                    const fileLink = document.createElement('a');
                                    fileLink.href = filePath;
                                    fileLink.textContent = 'Descargar Archivo';
                                    fileLink.target = '_blank'; // Abre el enlace en una nueva pestaña
                                    fileDiv.appendChild(fileLink);
                                }

                                const deleteBtn = document.createElement('button');
                                deleteBtn.className = 'delete-btn';
                                deleteBtn.textContent = 'X';
                                deleteBtn.addEventListener('click', function() {
                                    event.preventDefault();
                                    deleteFile3(file, id);
                                });
                                fileDiv.appendChild(deleteBtn);
                                previewList.appendChild(fileDiv);
                            });
                            document.getElementById('previewContainer').style.display = 'block';
                        } else {
                            document.getElementById('previewContainer').style.display = 'none';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            var editModal = new bootstrap.Modal(document.getElementById('editRegistroModal'));

            // Evento para abrir el modal de edición con los datos correctos
            document.querySelectorAll('[data-bs-target="#editRegistroModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const registroId = this.getAttribute('data-id');

                    // Fetch para obtener los datos del registro desde el servidor
                    fetch(`/registrovehiculo/${registroId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            console.log('Datos recibidos del servidor:', data);
                            let equipamientosSeleccionados = data.equipamiento_vehiculo || [];
                            if (typeof equipamientosSeleccionados === 'string') {
                                try {
                                    equipamientosSeleccionados = JSON.parse(
                                        equipamientosSeleccionados);
                                } catch (error) {
                                    console.error('Error al parsear equipamientos:', error);
                                    equipamientosSeleccionados = [];
                                }
                            }
                            document.getElementById('RegistroId').value = data.id;
                            document.getElementById('placa2').value = data.placa;
                            document.getElementById('chasis2').value = data.chasis;
                            document.getElementById('kilometros2').value = data.kilometros;
                            document.getElementById('fecha2').value = data.fecha;
                            document.getElementById('color2').value = data.color;
                            document.getElementById('modelo2').value = data.modelo;
                            document.getElementById('uso2').value = data.uso;
                            document.getElementById('propietario2').value = data.propietario;
                            document.getElementById('deposito2').value = data.deposito;

                            const sucursalSelect = document.getElementById('sucursal3');
                            sucursalSelect.value = data.sucursal_actual;
                            sucursalSelect.dispatchEvent(new Event('change'));

                            document.getElementById('compania_seguro2').value = data
                                .compania_seguro;
                            document.getElementById('riesgo_seguro2').value = data
                                .riesgo_seguro;
                            document.getElementById('poliza_seguro2').value = data
                                .poliza_seguro;
                            document.getElementById('aseguradora_seguro2').value = data
                                .aseguradora_seguro;
                            document.getElementById('asistencia_seguro2').value = data
                                .asistencia_seguro;
                            document.getElementById('telefono_seguro2').value = data
                                .telefono_seguro;
                            document.getElementById('aviso2').value = data.aviso;
                            document.getElementById('notas3').value = data.notas;
                            // Desmarca todos los checkboxes
                            $('input[name="equipamiento_vehiculo2[]"]').prop('checked', false);

                            // Marca los checkboxes que coincidan con los IDs seleccionados
                            equipamientosSeleccionados.forEach(function(id) {
                                $('input[name="equipamiento_vehiculo2[]"][value="' +
                                    id + '"]').prop('checked', true);
                            });


                            updateFilePreviews(data.id);

                            // Actualiza la acción del formulario con el ID correcto
                            document.getElementById('editRegistroForm').setAttribute('action',
                                `/registrovehiculo/${registroId}`);

                            // Muestra el modal de edición
                            editModal.show();
                        })
                        .catch(error => console.error('Error:', error));
                });
            });


            document.getElementById('editRegistroModal').addEventListener('shown.bs.modal', function() {
                // Ejecuta el código para el campo 'modelo2' cuando se abre el modal
                var modelo2 = $('#modelo2');
                var selectedOption = modelo2.find('option:selected');
                var grupo2 = selectedOption.data('grupo2');
                var tipoCaja2 = selectedOption.data('tipo_caja2');
                var tipoCombustible2 = selectedOption.data('tipo_combustible2');
                var tipoVehiculo2 = selectedOption.data('tipo_vehiculo2');
                var capacidadCombustible2 = selectedOption.data('capacidad_combustible2');
                var marca2 = selectedOption.data('marca2');
                $('#capacidad_combustible2').val(capacidadCombustible2);

                // Actualizar los inputs ocultos
                $('#grupo_hidden2').val(grupo2);
                $('#tipo_caja_hidden2').val(tipoCaja2);
                $('#tipo_combustible_hidden2').val(tipoCombustible2);
                $('#tipo_vehiculo_hidden2').val(tipoVehiculo2);
                $('#marca_hidden2').val(marca2);

                // También puedes actualizar los selectores deshabilitados para que reflejen los valores seleccionados
                $('#grupo2').val(grupo2);
                $('#tipo_caja2').val(tipoCaja2);
                $('#tipo_combustible2').val(tipoCombustible2);
                $('#tipo_vehiculo2').val(tipoVehiculo2);
                $('#marca2').val(marca2);


            });

            $('#modelo2').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var grupo2 = selectedOption.data('grupo2');
                var tipoCaja2 = selectedOption.data('tipo_caja2');
                var tipoCombustible2 = selectedOption.data('tipo_combustible2');
                var tipoVehiculo2 = selectedOption.data('tipo_vehiculo2');
                var capacidadCombustible2 = selectedOption.data('capacidad_combustible2');
                var marca2 = selectedOption.data('marca2');
                $('#capacidad_combustible2').val(capacidadCombustible2);

                // Actualizar los inputs ocultos
                $('#grupo_hidden2').val(grupo2);
                $('#tipo_caja_hidden2').val(tipoCaja2);
                $('#tipo_combustible_hidden2').val(tipoCombustible2);
                $('#tipo_vehiculo_hidden2').val(tipoVehiculo2);
                $('#marca_hidden2').val(marca2);

                // También puedes actualizar los selectores deshabilitados para que reflejen los valores seleccionados
                $('#grupo2').val(grupo2);
                $('#tipo_caja2').val(tipoCaja2);
                $('#tipo_combustible2').val(tipoCombustible2);
                $('#tipo_vehiculo2').val(tipoVehiculo2);
                $('#marca2').val(marca2);


            });

            // Asegúrate de que los valores se establezcan correctamente al cargar el modal
            $('#editRegistroModal').on('shown.bs.modal', function() {
                var modelo2 = $('#modelo2');
                var selectedOption = modelo2.find('option:selected');
                var grupo2 = selectedOption.data('grupo2');
                var tipoCaja2 = selectedOption.data('tipo_caja2');
                var tipoCombustible2 = selectedOption.data('tipo_combustible2');
                var tipoVehiculo2 = selectedOption.data('tipo_vehiculo2');
                var capacidadCombustible2 = selectedOption.data('capacidad_combustible2');
                var marca2 = selectedOption.data('marca2');
                $('#capacidad_combustible2').val(capacidadCombustible2);

                // Actualizar los inputs ocultos
                $('#grupo_hidden2').val(grupo2);
                $('#tipo_caja_hidden2').val(tipoCaja2);
                $('#tipo_combustible_hidden2').val(tipoCombustible2);
                $('#tipo_vehiculo_hidden2').val(tipoVehiculo2);
                $('#marca_hidden2').val(marca2);

                // También puedes actualizar los selectores deshabilitados para que reflejen los valores seleccionados
                $('#grupo2').val(grupo2);
                $('#tipo_caja2').val(tipoCaja2);
                $('#tipo_combustible2').val(tipoCombustible2);
                $('#tipo_vehiculo2').val(tipoVehiculo2);
                $('#marca2').val(marca2);



            });



        });
    </script>

</body>

</html>
