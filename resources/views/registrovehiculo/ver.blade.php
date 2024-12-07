<!doctype html>
<html lang="en">

<head>
    <title>Vehículo</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Carga de JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        #previewList3 {
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

        #notas4 {
            resize: none;
            /* Evita que el usuario cambie el tamaño del área de texto */
            overflow-y: auto;
            /* Agrega una barra de desplazamiento vertical si es necesario */
            box-sizing: border-box;
            /* Asegura que el padding y el borde se incluyan en el tamaño total */
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
        <div class="modal fade" id="verRegistroModal" tabindex="-1" aria-labelledby="verRegistroModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verRegistroModalLabel">Vehículo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (isset($registro) && $registro)
                            <form id="editRegistroForm" action="{{ route('registrovehiculo.update', $registro->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="RegistroId" />
                                <div class="container mt-3">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="datos-tab" data-bs-toggle="tab"
                                                data-bs-target="#datos3" type="button" role="tab"
                                                aria-controls="notas" aria-selected="true">Datos del vehiculo</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="sucursal-tab" data-bs-toggle="tab"
                                                data-bs-target="#sucursal4" type="button" role="tab"
                                                aria-controls="sucursal" aria-selected="false">Información
                                                Sucursal</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="seguro-tab" data-bs-toggle="tab"
                                                data-bs-target="#seguro3" type="button" role="tab"
                                                aria-controls="seguro" aria-selected="false">Información
                                                Seguro</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="datos3" role="tabpanel">
                                            <br />
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Patente</label>
                                                    <input type="text" name="placa" id="placa4"
                                                        class="form-control" readonly />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                                @php
                                                    $modelos = \App\Models\ModeloVehiculo::all();

                                                @endphp
                                                <div class="col-md-6 mb-3">
                                                    <label for="marca">Modelo</label>
                                                    @if (isset($modelos) && $modelos->isNotEmpty())
                                                        <select id="modelo4" name="modelo" class="form-control"
                                                            required disabled>
                                                            <option value="">Seleccione un modelo</option>
                                                            @foreach ($modelos as $modelo)
                                                                <option value="{{ $modelo->id }}"
                                                                    data-capacidad_combustible4="{{ encode_if_array($modelo->capacidad_combustible) }}"
                                                                    data-tipo_combustible4="{{ encode_if_array($modelo->tipo_combustible) }}"
                                                                    data-tipo_caja4="{{ encode_if_array($modelo->tipo_caja) }}"
                                                                    data-equipamiento_vehiculo4="{{ encode_if_array($modelo->equipamiento_vehiculo) }}"
                                                                    data-accesorio_vehiculo4="{{ encode_if_array($modelo->accesorio_vehiculo) }}"
                                                                    data-grupo4="{{ encode_if_array($modelo->grupo) }}"
                                                                    data-marca4="{{ encode_if_array($modelo->marca) }}"
                                                                    data-tipo_vehiculo4="{{ encode_if_array($modelo->tipo_vehiculo) }}"{{ $registro->modelo == $modelo->id ? 'selected' : '' }}>
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
                                                    <input type="text" name="chasis" id="chasis4"
                                                        class="form-control" placeholder="Ingresar Codigo Chasis"
                                                        required maxlength="20" readonly />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="color" class="form-label">Color</label>
                                                    <select name="color" id="color4" class="form-control"
                                                        required disabled>
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
                                                    <input type="number" name="kilometros" id="kilometros4"
                                                        class="form-control" placeholder="Ingresar Kms" required
                                                        maxlength="10" oninput="formatNumber(this)" readonly />
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
                                                    <input type="date" name="fecha" id="fecha4"
                                                        class="form-control" required disabled />
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
                                                        <select id="grupo4" name="grupo_disabled"
                                                            class="form-control" disabled>
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
                                                        <select id="tipo_caja4" name="tipo_caja_disabled"
                                                            class="form-control" disabled>
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
                                                        <select id="tipo_combustible4"
                                                            name="tipo_combustible_disabled" class="form-control"
                                                            disabled>
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
                                                        id="capacidad_combustible4" class="form-control"
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
                                                        <select id="marca4" name="marca_disabled"
                                                            class="form-control" disabled>
                                                            <option value="">Seleccione una marca
                                                            </option>
                                                            @foreach ($marcas as $marca)
                                                                <option value="{{ $marca->id }}">
                                                                    {{ $marca->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" id="marca_hidden4" name="marca">
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
                                                        <select id="tipo_vehiculo4" name="tipo_vehiculo"
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
                                                                data-bs-toggle="tab" data-bs-target="#notas5"
                                                                type="button" role="tab" aria-controls="notas"
                                                                aria-selected="true">Notas</button>
                                                        </li>

                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="equipamientos-tab"
                                                                data-bs-toggle="tab" data-bs-target="#equipamientos3"
                                                                type="button" role="tab"
                                                                aria-controls="equipamientos"
                                                                aria-selected="false">Equipamientos</button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="notas5"
                                                            role="tabpanel" aria-labelledby="notas-tab">
                                                            <div class="col-md-12 mt-3">
                                                                <label for="nota" class="form-label"></label>
                                                                <label for="notas" class="form-label"></label>
                                                                <textarea name="notas" id="notas4" class="form-control" placeholder="Ingresar información" maxlength="255"
                                                                    rows="2" readonly></textarea>
                                                                <div class="error-message text-danger" id="notaError">
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade" id="equipamientos3"
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
                                                                                        name="equipamiento_vehiculo4[]"
                                                                                        value="{{ $equipamiento->id }}"
                                                                                        id="equipamiento_{{ $equipamiento->id }}"
                                                                                        disabled>
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

                                        <div class="tab-pane fade" id="sucursal4" role="tabpanel"
                                            aria-labelledby="sucursal-tab">
                                            <br />
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia">Uso</label>
                                                    <select id="uso4" name="uso" class="form-control"
                                                        required disabled>
                                                        <option value="">Seleccione un uso</option>
                                                        <option value="Alquiler">Alquiler
                                                        </option>
                                                        <option value="Venta">Venta
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia">Propietario</label>
                                                    <select id="propietario4" name="propietario" class="form-control"
                                                        required disabled>
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
                                                    <select id="deposito4" name="deposito" class="form-control"
                                                        required disabled>
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
                                                        <select id="sucursal5" name="sucursal" class="form-control"
                                                            required disabled>
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
                                                <textarea name="aviso" id="aviso4" class="form-control" placeholder="Ingresar información" maxlength="255"
                                                    rows="4" readonly></textarea>
                                                <div class="error-message text-danger" id="notaError">
                                                </div>

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
                                        <div class="tab-pane fade" id="seguro3" role="tabpanel"
                                            aria-labelledby="seguro-tab">
                                            <br />

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Compañía</label>
                                                    <input type="text" name="compania_seguro"
                                                        id="compania_seguro5" class="form-control"
                                                        placeholder="Ingresar Nombre" maxlength="20" readonly />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Riesgo</label>
                                                    <input type="text" name="riesgo_seguro" id="riesgo_seguro5"
                                                        class="form-control" placeholder="Ingresar Riesgo"
                                                        maxlength="20" readonly />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Políza</label>
                                                    <input type="text" name="poliza_seguro" id="poliza_seguro5"
                                                        class="form-control" placeholder="Ingresar Políza"
                                                        maxlength="20" readonly />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Asegurado</label>
                                                    <input type="text" name="aseguradora_seguro"
                                                        id="aseguradora_seguro5" class="form-control"
                                                        placeholder="Ingresar Asegurado" maxlength="20" readonly />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Asistencia</label>
                                                    <input type="text" name="asistencia_seguro"
                                                        id="asistencia_seguro5" class="form-control"
                                                        placeholder="Ingresar Asistencia" maxlength="20" readonly />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name" class="form-label">Número Telefonico</label>
                                                    <input type="number" name="telefono_seguro"
                                                        id="telefono_seguro5" class="form-control"
                                                        placeholder="Ingresar Número Telefonico" maxlength="10"
                                                        readonly />
                                                    <div class="error-message text-danger" id="nameError"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Campo para archivo PDF o DOCX -->

                                                <div id="previewContainer6" style="display: none;">

                                                    <div id="previewList3"></div>
                                                </div>


                                            </div>
                                        </div>
                                        <div id="additionalFilesContainer"></div>





                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">

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

            var verModal = new bootstrap.Modal(document.getElementById('verRegistroModal'));

            document.querySelectorAll('[data-bs-toggle="modal-ver"]').forEach(button => {
                button.addEventListener('click', function() {
                    const registroId = this.getAttribute('data-id');
                    fetch(`/registrovehiculo/${registroId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('RegistroId').value = data.id;
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
                            document.getElementById('placa4').value = data.placa;
                            document.getElementById('chasis4').value = data.chasis;
                            document.getElementById('kilometros4').value = data.kilometros;
                            document.getElementById('fecha4').value = data.fecha;
                            document.getElementById('color4').value = data.color;
                            document.getElementById('modelo4').value = data.modelo;

                            document.getElementById('uso4').value = data.uso;
                            document.getElementById('propietario4').value = data.propietario;

                            document.getElementById('deposito4').value = data.deposito;
                            const sucursalSelect = document.getElementById('sucursal5');
                            sucursalSelect.value = data.sucursal_actual;

                            // Si necesitas asegurarte de que la opción se seleccione correctamente
                            sucursalSelect.dispatchEvent(new Event('change'));

                            document.getElementById('compania_seguro5').value = data
                                .compania_seguro;
                            document.getElementById('riesgo_seguro5').value = data
                                .riesgo_seguro;
                            document.getElementById('poliza_seguro5').value = data
                                .poliza_seguro;
                            document.getElementById('aseguradora_seguro5').value = data
                                .aseguradora_seguro;
                            document.getElementById('asistencia_seguro5').value = data
                                .asistencia_seguro;
                            document.getElementById('telefono_seguro5').value = data
                                .telefono_seguro;
                            document.getElementById('aviso4').value = data.aviso;

                            document.getElementById('notas4').value = data.notas;
                            // Desmarca todos los checkboxes
                            $('input[name="equipamiento_vehiculo4[]"]').prop('checked', false);

                            // Marca los checkboxes que coincidan con los IDs seleccionados
                            equipamientosSeleccionados.forEach(function(id) {
                                $('input[name="equipamiento_vehiculo4[]"][value="' +
                                    id + '"]').prop('checked', true);
                            });

                            const documentosString = data.documentos;
                            console.log('Documentos JSON:',
                                documentosString); // Verifica que el JSON sea correcto

                            let documentos;
                            try {
                                documentos = JSON.parse(documentosString);
                                console.log('Documentos Parsed:',
                                    documentos); // Verifica que el JSON se parse correctamente
                            } catch (error) {
                                console.error('Error al parsear JSON:', error);
                                documentos = []; // Si hay un error, usamos un array vacío
                            }

                            const previewList = document.getElementById('previewList3');
                            previewList.innerHTML =
                                ''; // Limpiar el contenedor de vistas previas

                            if (documentos && documentos.length > 0) {
                                documentos.forEach(file => {
                                    const baseUrl =
                                        'http://192.168.10.24:8045/storage/graficos/';
                                    const filePath = `${baseUrl}${file}`;
                                    console.log('File Path:',
                                        filePath
                                    ); // Verifica que la ruta del archivo sea correcta
                                    const fileExtension = file.split('.').pop()
                                        .toLowerCase();

                                    const fileDiv = document.createElement('div');
                                    fileDiv.className = 'file-preview';

                                    if (['jpg', 'jpeg', 'png', 'webp', 'gif'].includes(
                                            fileExtension)) {
                                        // Para imágenes
                                        const img = document.createElement('img');
                                        img.src = filePath;
                                        img.crossOrigin =
                                            'anonymous'; // Intenta quitar esta línea si no es necesaria
                                        img.className = 'preview-img';
                                        img.alt = 'Vista previa de la imagen';
                                        img.style.maxWidth =
                                            '100px'; // Ajustar el tamaño según sea necesario
                                        img.onload = () => console.log(
                                            'Imagen cargada:', filePath
                                        ); // Confirma que la imagen se carga
                                        img.onerror = () => console.error(
                                            'Error al cargar la imagen:', filePath
                                        ); // Muestra errores
                                        fileDiv.appendChild(img);
                                    } else if (fileExtension === 'pdf') {
                                        // Para PDFs
                                        const embed = document.createElement('embed');
                                        embed.src = filePath;
                                        embed.type = 'application/pdf';
                                        embed.width = '100%';
                                        embed.height =
                                            '100px'; // Ajustar el tamaño según sea necesario
                                        embed.onload = () => console.log('PDF cargado:',
                                            filePath); // Confirma que el PDF se carga
                                        embed.onerror = () => console.error(
                                            'Error al cargar el PDF:', filePath
                                        ); // Muestra errores
                                        fileDiv.appendChild(embed);
                                    } else if (fileExtension === 'docx') {
                                        // Para DOCX
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
                                        link.target =
                                            '_blank'; // Abre el enlace en una nueva pestaña
                                        fileDiv.appendChild(link);
                                    } else {
                                        // Para otros tipos de archivos
                                        const fileLink = document.createElement('a');
                                        fileLink.href = filePath;
                                        fileLink.textContent = 'Descargar Archivo';
                                        fileLink.target =
                                            '_blank'; // Abre el enlace en una nueva pestaña
                                        fileDiv.appendChild(fileLink);
                                    }

                                    previewList.appendChild(fileDiv);
                                });
                                document.getElementById('previewContainer6').style.display =
                                    'block';
                            } else {
                                document.getElementById('previewContainer6').style.display =
                                    'none';
                            }




                            verModal.show();
                        })
                        .catch(error => console.error('Error:', error));
                });
            });


            document.getElementById('verRegistroModal').addEventListener('shown.bs.modal', function() {
                // Ejecuta el código para el campo 'modelo2' cuando se abre el modal
                var modelo2 = $('#modelo2');
                var selectedOption = modelo2.find('option:selected');
                var grupo2 = selectedOption.data('grupo2');
                var tipoCaja2 = selectedOption.data('tipo_caja2');
                var tipoCombustible2 = selectedOption.data('tipo_combustible2');
                var tipoVehiculo2 = selectedOption.data('tipo_vehiculo2');
                var capacidadCombustible2 = selectedOption.data('capacidad_combustible2');
                var marca2 = selectedOption.data('marca2');
                $('#capacidad_combustible4').val(capacidadCombustible2);


                // Actualizar los inputs ocultos
                $('#grupo_hidden4').val(grupo2);
                $('#tipo_caja_hidden4').val(tipoCaja2);
                $('#tipo_combustible_hidden4').val(tipoCombustible2);
                $('#tipo_vehiculo_hidden4').val(tipoVehiculo2);
                $('#marca_hidden4').val(marca2);

                // También puedes actualizar los selectores deshabilitados para que reflejen los valores seleccionados
                $('#grupo4').val(grupo2);
                $('#tipo_caja4').val(tipoCaja2);
                $('#tipo_combustible4').val(tipoCombustible2);
                $('#tipo_vehiculo4').val(tipoVehiculo2);
                $('#marca4').val(marca2);


            });

            $('#modelo4').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var grupo4 = selectedOption.data('grupo4');
                var tipoCaja4 = selectedOption.data('tipo_caja4');
                var tipoCombustible4 = selectedOption.data('tipo_combustible4');
                var tipoVehiculo4 = selectedOption.data('tipo_vehiculo4');
                var capacidadCombustible4 = selectedOption.data('capacidad_combustible4');
                var marca4 = selectedOption.data('marca4');
                $('#capacidad_combustible2').val(capacidadCombustible4);

                // Actualizar los inputs ocultos
                $('#grupo_hidden2').val(grupo4);
                $('#tipo_caja_hidden2').val(tipoCaja4);
                $('#tipo_combustible_hidden2').val(tipoCombustible4);
                $('#tipo_vehiculo_hidden2').val(tipoVehiculo4);
                $('#marca_hidden4').val(marca4);


                // También puedes actualizar los selectores deshabilitados para que reflejen los valores seleccionados
                $('#grupo2').val(grupo4);
                $('#tipo_caja2').val(tipoCaja4);
                $('#tipo_combustible2').val(tipoCombustible4);
                $('#tipo_vehiculo2').val(tipoVehiculo4);
                $('#marca4').val(marca4);


            });

            // Asegúrate de que los valores se establezcan correctamente al cargar el modal
            $('#verRegistroModal').on('shown.bs.modal', function() {
                var modelo4 = $('#modelo4');
                var selectedOption = modelo4.find('option:selected');
                var grupo4 = selectedOption.data('grupo4');
                var tipoCaja4 = selectedOption.data('tipo_caja4');
                var tipoCombustible4 = selectedOption.data('tipo_combustible4');
                var tipoVehiculo4 = selectedOption.data('tipo_vehiculo4');
                var capacidadCombustible4 = selectedOption.data('capacidad_combustible4');
                var marca4 = selectedOption.data('marca4');
                $('#capacidad_combustible4').val(capacidadCombustible4);

                // Actualizar los inputs ocultos
                $('#grupo_hidden4').val(grupo4);
                $('#tipo_caja_hidden4').val(tipoCaja4);
                $('#tipo_combustible_hidden4').val(tipoCombustible4);
                $('#tipo_vehiculo_hidden4').val(tipoVehiculo4);
                $('#marca_hidden4').val(marca4);

                // También puedes actualizar los selectores deshabilitados para que reflejen los valores seleccionados
                $('#grupo4').val(grupo4);
                $('#tipo_caja4').val(tipoCaja4);
                $('#tipo_combustible4').val(tipoCombustible4);
                $('#tipo_vehiculo4').val(tipoVehiculo4);
                $('#marca4').val(marca4);


            });

        });
    </script>

</body>

</html>
