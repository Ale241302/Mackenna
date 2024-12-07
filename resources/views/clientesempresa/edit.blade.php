<!doctype html>
<html lang="en">

<head>
    <title>Editar Cliente Empresa</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        #existingFilesContainer4 {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            justify-content: start;
        }

        .file-preview5 {
            flex: 1 0 21%;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Centra los elementos en el contenedor */
        }

        .preview5-img {
            max-width: 100px !important;
            /* Ajusta el tamaño máximo de la imagen */
            max-height: 100px !important;
            /* Ajusta la altura máxima de la imagen */
            display: block;
            margin: 5px;
        }

        .file-preview5 embed {
            width: 100px !important;
            /* Ajusta el tamaño del PDF */
            height: 100px !important;
            /* Ajusta la altura del PDF */
            display: block;
            margin: 5px;
        }

        .remove-button {
            margin-top: 5px;
            font-size: 12px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="modal fade" id="editclienteempresaModal" tabindex="-1"
            aria-labelledby="editclienteempresaModalLabel" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editclienteempresaModalLabel">Editar Cliente Empresa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="editEmpresaForm" action="" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab6-tab" data-toggle="tab" href="#tab6"
                                        role="tab" aria-controls="tab6" aria-selected="true">Datos
                                        Generales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab7-tab" data-toggle="tab" href="#tab7" role="tab"
                                        aria-controls="tab7" aria-selected="false">Datos
                                        Especificos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab8-tab" data-toggle="tab" href="#tab8" role="tab"
                                        aria-controls="tab8" aria-selected="false">Tarifas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab9-tab" data-toggle="tab" href="#tab9" role="tab"
                                        aria-controls="tab9" aria-selected="false">Incrementos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab10-tab" data-toggle="tab" href="#tab10" role="tab"
                                        aria-controls="tab10" aria-selected="false">Extras</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab6" role="tabpanel"
                                    aria-labelledby="tab6-tab">
                                    <br />
                                    <div class="row">
                                        <!-- Campos para Tab 1 -->
                                        <div class="col-md-6 mb-3">
                                            <label for="cuenta_contable">Cuenta Contable</label>
                                            <input type="text" id="edit_cuenta_contable" name="cuenta_contable"
                                                class="form-control" maxlength="25" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Nombre Comercial</label>
                                            <input type="text" id="edit_name" name="name" class="form-control"
                                                maxlength="25" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="razon_social">Razón Social</label>
                                            <input type="text" id="edit_razon_social" name="razon_social"
                                                class="form-control" maxlength="25" required>
                                        </div>
                                        @php
                                            $comerciales = \App\Models\SectorComercial::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">Sector Comercial</label>
                                            @if (isset($comerciales) && $comerciales->isNotEmpty())
                                                <select id="sector_economico2" name="sector_economico"
                                                    class="form-control" required>
                                                    <option value="">Seleccione un sector</option>
                                                    @foreach ($comerciales as $comercial)
                                                        <option value="{{ $comercial->id }}">
                                                            {{ $comercial->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay comercial disponibles.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" id="edit_direccion" name="direccion"
                                                class="form-control" maxlength="25" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="codigo_postal">Código Postal</label>
                                            <input type="number" id="edit_codigo_postal" name="codigo_postal"
                                                class="form-control" maxlength="10" required
                                                oninput="validateNumberInput2(this)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $pais = \App\Models\Pais::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="pais">País</label>
                                            @if (isset($pais) && $pais->isNotEmpty())
                                                <select id="pais2" name="pais" class="form-control" required>
                                                    <option value="">Seleccione un país</option>
                                                    @foreach ($pais as $pai)
                                                        <option value="{{ $pai->id }}">{{ $pai->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay países disponibles.</p>
                                            @endif
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="ciudad">Ciudad</label>
                                            <select id="ciudad2" name="municipio" class="form-control" required>
                                                <option value="">Seleccione una ciudad</option>
                                            </select>
                                        </div>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                $('#pais2').on('change', function() {
                                                    var paisId = $(this).val();

                                                    if (paisId) {
                                                        $.ajax({
                                                            url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                            type: 'GET',
                                                            data: {
                                                                pais_id: paisId
                                                            },
                                                            success: function(data) {
                                                                $('#ciudad2').empty(); // Limpiar el selector de ciudades
                                                                $('#ciudad2').append(
                                                                    '<option value="">Seleccione una ciudad</option>');

                                                                $.each(data, function(key, ciudad) {
                                                                    $('#ciudad2').append('<option value="' + ciudad.id +
                                                                        '">' + ciudad.nombre + '</option>');
                                                                });
                                                            }
                                                        });
                                                    } else {
                                                        $('#ciudad2').empty(); // Limpiar el selector si no se selecciona un país
                                                        $('#ciudad2').append('<option value="">Seleccione una ciudad</option>');
                                                    }
                                                });
                                            });
                                        </script>


                                    </div>


                                    <div class="row">
                                        @php
                                            $tipodocumentos = \App\Models\TipoDocumento::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">Tipo de Documento</label>
                                            @if (isset($tipodocumentos) && $tipodocumentos->isNotEmpty())
                                                <select id="tipo_documento2" name="tipo_documento"
                                                    class="form-control" required>
                                                    <option value="">Seleccione un tipo documento</option>
                                                    @foreach ($tipodocumentos as $tipodocumento)
                                                        <option value="{{ $tipodocumento->id }}">
                                                            {{ $tipodocumento->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay documentos disponibles.</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="numero_documento">Número de Documento</label>
                                            <input type="text" id="edit_numero_documento" name="numero_documento"
                                                class="form-control" maxlength="10" required
                                                oninput="validateNumberInputlet2(this)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $paisdocumentos = \App\Models\Pais::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">País del Documento</label>
                                            @if (isset($paisdocumentos) && $paisdocumentos->isNotEmpty())
                                                <select id="pais_documento2" name="pais_documento"
                                                    class="form-control" required>
                                                    <option value="">Seleccione un país</option>
                                                    @foreach ($paisdocumentos as $paisdocumento)
                                                        <option value="{{ $paisdocumento->id }}">
                                                            {{ $paisdocumento->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay pais disponibles.</p>
                                            @endif

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" id="edit_email" name="email"
                                                class="form-control" maxlength="255" required>
                                        </div>
                                    </div>
                                    <div class="row contact-group2">
                                        <div class="col-md-6 mb-3">
                                            <label for="persona_contacto">Persona de Contacto</label>
                                            <input type="text" name="persona_contacto[]" maxlength="25"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="numero_contacto">Número de Contacto</label>

                                            <div class="input-group">
                                                <input type="text" name="numero_contacto[]" class="form-control"
                                                    maxlength="15" oninput="validateNumberInputmas2(this)">
                                                <button type="button" class="btn btn-primary"
                                                    id="addContacButton2"onclick="addContact2()">+</button>
                                            </div>

                                        </div>
                                        <div class="row contact-group3"></div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', (event) => {
                                                document.querySelector('.btn-add').addEventListener('click', function() {
                                                    addContact2();
                                                });
                                            });

                                            function addContact2() {
                                                const contactGroup = document.querySelector('.contact-group2');

                                                const newContactItem = document.createElement('div');
                                                newContactItem.className = 'row contact-group2';
                                                newContactItem.innerHTML = `
                                                            <div class="col-md-6 mb-3">
                                                                <label for="persona_contacto">Persona de Contacto</label>
                                                                <input type="text" name="persona_contacto[]" maxlength="25" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="numero_contacto">Número de Contacto</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="numero_contacto[]" class="form-control" maxlength="10" required oninput="validateNumberInputmas2(this)">
                                                                    <button type="button" class="btn btn-danger btn-remove" onclick="removeContact(this)">X</button>
                                                                </div>
                                                            </div>
                                                        `;

                                                contactGroup.appendChild(newContactItem);
                                            }

                                            function removeContact2(button) {
                                                const contactGroup = document.querySelector('.contact-group2');
                                                contactGroup.removeChild(button.closest('.contact-group2'));
                                            }
                                        </script>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="web">Página Web</label>
                                            <input type="text" id="web2" name="web2" maxlength="55"
                                                class="form-control">
                                        </div>
                                        @php
                                            $sucursales = \App\Models\Sucursal::all();
                                        @endphp
                                        <div class="form-group">
                                            <label for="tipo_documento">Pertenece a la Sucursal</label>
                                            @if (isset($sucursales) && $sucursales->isNotEmpty())
                                                <select id="sucursal2" name="sucursal" class="form-control" required>
                                                    <option value="">Seleccione una sucursal</option>
                                                    @foreach ($sucursales as $sucursal)
                                                        <option value="{{ $sucursal->id }}">
                                                            {{ $sucursal->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay idiomas disponibles.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="vehiculo_propio">Vehículo Propio</label>
                                            <select id="edit_vehiculo_propio" name="vehiculo_propio"
                                                class="form-control">
                                                <option value="1">Sí</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        @php
                                            $idiomas = \App\Models\Idioma::all();
                                        @endphp
                                        <div class="form-group">
                                            <label for="tipo_documento">Idiomas</label>
                                            @if (isset($idiomas) && $idiomas->isNotEmpty())
                                                <select id="idioma2" name="idiomas" class="form-control" required>
                                                    <option value="">Seleccione un idioma</option>
                                                    @foreach ($idiomas as $idioma)
                                                        <option value="{{ $idioma->id }}">
                                                            {{ $idioma->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay idiomas disponibles.</p>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="tab7" role="tabpanel"
                                    aria-labelledby="tab7-tab">
                                    <br />
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="medio_pago">Medio de Pago</label>
                                            <select name="medio_pago" id="medio_pago2" class="form-control">
                                                <option value="">Seleccione un medio de pago</option>
                                                <option value="tarjeta_credito">Tarjeta de Crédito</option>
                                                <option value="tarjeta_debito">Tarjeta de Débito</option>
                                                <option value="transferencia_bancaria">Transferencia Bancaria
                                                </option>
                                                <option value="webpay">Webpay</option>
                                                <option value="khipu">Khipu</option>
                                                <option value="paypal">PayPal</option>
                                                <option value="mercadopago">Mercado Pago</option>
                                            </select>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="dias_credito">Días de Crédito</label>
                                            <input type="number" id="dias_credito2" name="dias_credito"
                                                class="form-control" maxlength="5"
                                                oninput="validateNumberInput2(this)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $canalventas = \App\Models\Canalventa::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="canal">Canal</label>
                                            @if (isset($canalventas) && $canalventas->isNotEmpty())
                                                <select id="edit_canal" name="canal" class="form-control">
                                                    <option value="">Seleccione un canal</option>
                                                    @foreach ($canalventas as $canalventa)
                                                        <option value="{{ $canalventa->id }}">
                                                            {{ $canalventa->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay canalventa disponibles.</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="vent_dia">Ventas del Día</label>
                                            <input type="number" id="edit_vent_dia" name="vent_dia"
                                                class="form-control" maxlength="5"
                                                oninput="validateNumberInput2(this)">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="observaciones2-tab"
                                                    data-bs-toggle="tab" data-bs-target="#observaciones2"
                                                    type="button" role="tab" aria-controls="observaciones"
                                                    aria-selected="true">Observaciones</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="acuerdos2-tab" data-bs-toggle="tab"
                                                    data-bs-target="#acuerdos2" type="button" role="tab"
                                                    aria-controls="acuerdos" aria-selected="false">Acuerdos</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="opcion2-tab" data-bs-toggle="tab"
                                                    data-bs-target="#opcion2" type="button" role="tab"
                                                    aria-controls="opcion" aria-selected="false">Opciones</button>
                                            </li>

                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="observaciones2"
                                                role="tabpanel" aria-labelledby="observaciones2-tab">

                                                <label for="observaciones"></label>
                                                <textarea id="edit_observaciones" name="observaciones" class="form-control"></textarea>

                                            </div>
                                            <div class="tab-pane fade" id="acuerdos2" role="tabpanel"
                                                aria-labelledby="acuerdos2-tab">

                                                <label for="acuerdos"></label>
                                                <textarea id="edit_acuerdos" name="acuerdos" class="form-control"></textarea>

                                            </div>
                                            <div class="tab-pane fade" id="opcion2" role="tabpanel"
                                                aria-labelledby="opcion2-tab">
                                                <br />
                                                <div id="checkbox-container2" class="form-check2">
                                                    <!-- Checkboxes will be added here by JavaScript -->
                                                </div>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', (event) => {
                                                        const options = [
                                                            'Es un arrendatario',
                                                            'Incluir Importes a facturar en contrato',
                                                            'Facturación Agrupada',
                                                            'Incluir Mailing',
                                                            'Forzar cobro de franquicia',
                                                            'Cuenta exenta de impuestos',
                                                            'Bloquear cuenta',
                                                            'Tranfer y uso personal',
                                                            'Empresa con conductores propios',
                                                            'Aplicar Stop Sales y Free Sales',
                                                            'Es un afiliado',
                                                            'Facturación a mes anticipado'
                                                        ];

                                                        // Recupera las opciones seleccionadas desde el atributo data-opciones del botón
                                                        document.querySelectorAll('[data-opciones]').forEach((button) => {
                                                            button.addEventListener('click', function() {
                                                                const opcionesSeleccionadas = JSON.parse(button.getAttribute('data-opciones'));
                                                                const checkboxContainer = document.getElementById('checkbox-container2');

                                                                // Limpiar el contenedor antes de agregar nuevas opciones
                                                                checkboxContainer.innerHTML = '';

                                                                options.forEach(option => {
                                                                    const div = document.createElement('div');
                                                                    div.className = 'form-check2';

                                                                    const input = document.createElement('input');
                                                                    input.className = 'form-check-input tarifa-checkbox';
                                                                    input.type = 'checkbox';
                                                                    input.name = 'opciones[]';
                                                                    input.value = option;

                                                                    // Marca el checkbox si la opción está en opcionesSeleccionadas
                                                                    if (opcionesSeleccionadas.includes(option)) {
                                                                        input.checked = true;
                                                                    }

                                                                    const label = document.createElement('label');
                                                                    label.className = 'form-check-label';
                                                                    label.textContent = option;

                                                                    div.appendChild(input);
                                                                    div.appendChild(label);
                                                                    checkboxContainer.appendChild(div);
                                                                });
                                                            });
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <br />
                                                <label for="archivo4" class="form-label">Archivo</label>
                                                <div class="input-group">
                                                    <input class="form-control" type="file" name="documentos2[]"
                                                        id="archivo4"
                                                        accept=".pdf, .docx, .jpg, .jpeg, .png, .webp, .gif" multiple>

                                                    <button type="button" class="btn btn-primary"
                                                        id="addFileButton4">+</button>
                                                </div>
                                                <div class="error-message text-danger" id="archivoError4"></div>
                                                <br />
                                                <div id="previewContainer4" style="display: none;">
                                                    <h5>Previsualización del Documento:</h5>
                                                    <embed id="preview4" type="application/pdf" width="100%"
                                                        height="600px" />
                                                    <img id="previewImg4" class="preview5-img"
                                                        alt="Vista previa de la imagen" />
                                                </div>
                                            </div>
                                            <div id="additionalFilesContainer4"></div>
                                            <div id="existingFilesContainer4">
                                                <!-- Aquí se cargarán los archivos existentes para previsualización -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab8" role="tabpanel"
                                    aria-labelledby="tab8-tab">
                                    <br />
                                    <div id="tarifas-container2" class="mb-12">
                                        <!-- Las tarifas filtradas se cargarán aquí -->
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tab10" role="tabpanel"
                                    aria-labelledby="tab10-tab">
                                    <br />
                                    <div class="mb-12">
                                        @php
                                            $extras = \App\Models\ExtraCliente::all();
                                        @endphp
                                        @if (isset($extras) && $extras->isNotEmpty())
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="select_all_extra">
                                                <label class="form-check-label" for="select_all_extra">
                                                    Seleccionar todos
                                                </label>
                                            </div>
                                            <br />
                                            <div class="row g-3">
                                                @foreach ($extras as $extra)
                                                    <div class="col-md-4">
                                                        <!-- Ajusta el tamaño de la columna según necesites -->
                                                        <div class="form-check">
                                                            <input class="form-check-input extra-checkbox"
                                                                type="checkbox" name="extras2[]"
                                                                value="{{ $extra->id }}"
                                                                id="extra_{{ $extra->id }}">
                                                            <label class="form-check-label"
                                                                for="extra_{{ $extra->id }}">
                                                                {{ $extra->nombre }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>No hay extras disponibles.</p>
                                        @endif
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('archivo4').addEventListener('change', function(event) {
                                        handleFilePreview4(event, 'archivoError4', 'previewContainer4', 'preview4', 'previewImg4');
                                    });

                                    document.getElementById('addFileButton4').addEventListener('click', function() {
                                        addFileField4();
                                    });

                                    function handleFilePreview4(event, errorId, containerId, previewId, imgId) {
                                        const file = event.target.files[0];
                                        const previewContainer = document.getElementById(containerId);
                                        const preview = document.getElementById(previewId);
                                        const previewImg = document.getElementById(imgId);
                                        const errorMessage = document.getElementById(errorId);

                                        if (file) {
                                            const reader = new FileReader();

                                            reader.onload = function(e) {
                                                if (file.type === 'application/pdf') {
                                                    preview.src = e.target.result;
                                                    preview.style.display = 'block';
                                                    previewImg.style.display = 'none';
                                                } else if (file.type.startsWith('image/')) {
                                                    previewImg.src = e.target.result;
                                                    previewImg.style.display = 'block';
                                                    preview.style.display = 'none';
                                                }
                                                previewContainer.style.display = 'block';
                                            };

                                            if (file.type === 'application/pdf' || file.type.startsWith('image/')) {
                                                reader.readAsDataURL(file);
                                            } else {
                                                previewContainer.style.display = 'none';
                                                errorMessage.textContent = 'Por favor, suba un archivo válido (PDF, DOCX, JPG, JPEG, PNG, WEBP, GIF).';
                                            }
                                        } else {
                                            previewContainer.style.display = 'none';
                                        }
                                    }

                                    function addFileField4() {
                                        const container = document.getElementById('additionalFilesContainer4');
                                        const index = container.children.length + 1;

                                        const row = document.createElement('div');
                                        row.className = 'row';

                                        const col = document.createElement('div');
                                        col.className = 'col-md-12';

                                        const label = document.createElement('label');
                                        label.className = 'form-label';
                                        label.htmlFor = 'archivo2_' + index;
                                        label.textContent = '';

                                        const inputGroup = document.createElement('div');
                                        inputGroup.className = 'input-group';

                                        const input = document.createElement('input');
                                        input.type = 'file';
                                        input.name = 'documentos2[]';
                                        input.id = 'archivo2_' + index;
                                        input.accept = '.pdf, .docx, .jpg, .jpeg, .png, .webp, .gif';
                                        input.className = 'form-control';
                                        input.addEventListener('change', function(event) {
                                            handleFilePreview2(event, 'archivoError4_' + index, 'previewContainer4_' + index, 'preview4_' +
                                                index, 'previewImg4_' + index);
                                        });

                                        const removeButton = document.createElement('button');
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

                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'error-message text-danger';
                                        errorMessage.id = 'archivoError4_' + index;
                                        col.appendChild(errorMessage);

                                        const previewContainer = document.createElement('div');
                                        previewContainer.id = 'previewContainer4_' + index;
                                        previewContainer.style.display = 'none';

                                        const previewTitle = document.createElement('h5');
                                        previewTitle.textContent = 'Previsualización del Documento:';
                                        previewContainer.appendChild(previewTitle);

                                        const embed = document.createElement('embed');
                                        embed.id = 'preview4_' + index;
                                        embed.type = 'application/pdf';
                                        embed.width = '100%';
                                        embed.height = '600px';
                                        previewContainer.appendChild(embed);

                                        const img = document.createElement('img');
                                        img.id = 'previewImg4_' + index;
                                        img.className = 'preview5-img';
                                        img.alt = 'Vista previa de la imagen';
                                        previewContainer.appendChild(img);

                                        col.appendChild(previewContainer);
                                        row.appendChild(col);
                                        container.appendChild(row);
                                    }
                                </script>
                                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectAllCheckbox = document.getElementById('select_all_tarifa');
                                        var tipovehiculosCheckboxes = document.querySelectorAll('.tarifa-checkbox');
                                        var selectAllCheckbox2 = document.getElementById('select_all_extra');
                                        var extraCheckboxes = document.querySelectorAll('.extra-checkbox');

                                        // Recupera las tarifas seleccionadas desde el atributo data-tarifas del botón
                                        var button = document.querySelector('[data-tarifas]');
                                        var tarifasSeleccionadas = JSON.parse(button.getAttribute('data-tarifas'));

                                        // Recupera los extras seleccionados desde el atributo data-extras del botón
                                        var extrasSeleccionadas = JSON.parse(button.getAttribute('data-extras'));

                                        // Marca los checkboxes según las tarifas seleccionadas
                                        tipovehiculosCheckboxes.forEach(function(checkbox) {
                                            if (tarifasSeleccionadas.includes(checkbox.value)) {
                                                checkbox.checked = true;
                                            }
                                        });

                                        // Marca los checkboxes según los extras seleccionados
                                        extraCheckboxes.forEach(function(checkbox) {
                                            if (extrasSeleccionadas.includes(checkbox.value)) {
                                                checkbox.checked = true;
                                            }
                                        });

                                        selectAllCheckbox.addEventListener('change', function() {
                                            tipovehiculosCheckboxes.forEach(function(checkbox) {
                                                checkbox.checked = selectAllCheckbox.checked;
                                            });
                                        });

                                        selectAllCheckbox2.addEventListener('change', function() {
                                            extraCheckboxes.forEach(function(checkbox) {
                                                checkbox.checked = selectAllCheckbox2.checked;
                                            });
                                        });
                                    });
                                </script>
                                <script>
                                    // Cambia entre las pestañas
                                    $('#myTab a').on('click', function(e) {
                                        e.preventDefault()
                                        $(this).tab('show')
                                    })
                                </script>


                                <div class="text-center pt-1 mb-5 pb-1">
                                    <button class="btn btn-primary btn-block" type="submit">Actualizar</button>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        let deletedContacts = [];
        let deletedFiles = [];

        function validateNumberInput2(input) {
            // Reemplaza cualquier caracter que no sea número
            input.value = input.value.replace(/[^0-9]/g, '');

            // Limita a 10 caracteres como máximo
            if (input.value.length > 10) {
                input.value = input.value.slice(0, 10);
            }
        }

        function validateNumberInputmas2(input) {
            // Reemplaza cualquier caracter que no sea número o el signo +
            input.value = input.value.replace(/[^0-9+]/g, '');

            // Limita a 10 caracteres como máximo
            if (input.value.length > 15) {
                input.value = input.value.slice(0, 15);
            }
        }


        function validateNumberInputlet2(input) {
            // Reemplaza cualquier caracter que no sea letra, número o guion
            input.value = input.value.replace(/[^a-zA-Z0-9-]/g, '');

            // Permite solo una letra, eliminando letras adicionales
            const letterMatch = input.value.match(/[a-zA-Z]/g);
            if (letterMatch && letterMatch.length > 1) {
                input.value = input.value.replace(/[a-zA-Z]/g, (match, offset) => (offset === input.value.indexOf(match) ?
                    match : ''));
            }

            // Permite solo un guion, eliminando guiones adicionales
            const firstDashIndex = input.value.indexOf('-');
            if (firstDashIndex !== -1) {
                input.value = input.value.substring(0, firstDashIndex + 1) + input.value.slice(firstDashIndex + 1).replace(
                    /-/g, '');
            }

            // Limita a 15 caracteres como máximo
            if (input.value.length > 15) {
                input.value = input.value.slice(0, 15);
            }
        }

        function removeContact3(button) {
            const contactItem = button.closest('.row.contact-group-item');
            if (contactItem) {
                // Obtener los valores de los campos que se van a eliminar
                const persona = contactItem.querySelector('input[name="persona_contacto[]"]').value;
                const numero = contactItem.querySelector('input[name="numero_contacto[]"]').value;

                // Agregar los contactos eliminados a la lista
                if (persona || numero) {
                    deletedContacts.push({
                        persona: persona,
                        numero: numero
                    });
                }

                // Eliminar el campo del DOM
                contactItem.remove();

                // Actualizar el campo oculto con los contactos eliminados
                document.getElementById('deletedContacts').value = JSON.stringify(deletedContacts);
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            var editclienteempresaModal = document.getElementById('editclienteempresaModal');

            // Crear el campo oculto para contactos eliminados
            const form = document.getElementById('editEmpresaForm');
            const deletedContactsInput = document.createElement('input');
            const deletedFilesInput = document.createElement('input');
            deletedContactsInput.type = 'hidden';
            deletedContactsInput.name = 'deleted_contacts';
            deletedContactsInput.id = 'deletedContacts';
            deletedContactsInput.value = JSON.stringify(deletedContacts);
            deletedFilesInput.type = 'hidden';
            deletedFilesInput.name = 'deleted_files';
            deletedFilesInput.id = 'deletedFiles';
            deletedFilesInput.value = JSON.stringify(deletedFiles);
            form.appendChild(deletedFilesInput);
            form.appendChild(deletedContactsInput);

            // Función para eliminar contactos y actualizar el campo oculto
            function removeContact3(button) {
                const contactItem = button.closest('.row.contact-group-item');
                if (contactItem) {
                    // Obtener los valores de los campos que se van a eliminar
                    const persona = contactItem.querySelector('input[name="persona_contacto[]"]').value;
                    const numero = contactItem.querySelector('input[name="numero_contacto[]"]').value;

                    // Agregar los contactos eliminados a la lista
                    if (persona || numero) {
                        deletedContacts.push({
                            persona: persona,
                            numero: numero
                        });
                    }

                    // Eliminar el campo del DOM
                    contactItem.remove();

                    // Actualizar el campo oculto con los contactos eliminados
                    document.getElementById('deletedContacts').value = JSON.stringify(deletedContacts);
                }
            }

            function deleteFile(file, id) {
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


            // Asegúrate de que el modal exista
            if (editclienteempresaModal) {
                editclienteempresaModal.addEventListener('show.bs.modal', function(event) {
                    var form = document.getElementById('editEmpresaForm');

                    // Restablece los campos de entrada
                    form.reset();

                    // Limpiar las selecciones del select
                    document.querySelectorAll('select').forEach(function(select) {
                        select.selectedIndex = 0; // Restablece al primer valor
                    });

                    // Limpia los contenedores de archivos existentes y otros elementos dinámicos
                    document.getElementById('existingFilesContainer4').innerHTML = '';
                    document.querySelector('.contact-group3').innerHTML = '';

                    // Resetea arrays de elementos eliminados
                    deletedContacts = [];
                    deletedFiles = [];

                    // Actualiza los campos ocultos de contactos y archivos eliminados
                    document.getElementById('deletedContacts').value = JSON.stringify(deletedContacts);
                    document.getElementById('deletedFiles').value = JSON.stringify(deletedFiles);

                    // Desmarca todos los checkboxes
                    document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                    var button = event.relatedTarget; // Botón que activó el modal
                    var id = button.getAttribute('data-id'); // Extrae el id del atributo data-id
                    var name = button.getAttribute('data-name'); // Extrae el name del atributo data-name
                    var cuenta_contable = button.getAttribute(
                        'data-cuenta_contable');
                    var razon_social = button.getAttribute(
                        'data-razon_social');
                    var email = button.getAttribute(
                        'data-email');
                    var sector_economico = button.getAttribute(
                        'data-sector_economico');
                    var direccion = button.getAttribute(
                        'data-direccion');
                    var codigo_postal = button.getAttribute(
                        'data-codigo_postal');
                    var municipio = button.getAttribute(
                        'data-municipio');
                    var pais = button.getAttribute(
                        'data-pais');
                    var tipo_documento = button.getAttribute(
                        'data-tipo_documento');
                    var numero_documento = button.getAttribute(
                        'data-numero_documento');
                    var pais_documento = button.getAttribute(
                        'data-pais_documento');
                    var persona_contacto = JSON.parse(button.getAttribute(
                        'data-persona_contacto')); // Parsear como JSON
                    var numero_contacto = JSON.parse(button.getAttribute(
                        'data-numero_contacto')); // Parsear como JSON
                    var web = button.getAttribute(
                        'data-web');
                    var sucursal = button.getAttribute(
                        'data-sucursal');
                    var idiomas = button.getAttribute(
                        'data-idiomas');
                    var observaciones = button.getAttribute(
                        'data-observaciones');
                    var medio_pago = button.getAttribute(
                        'data-medio_pago');
                    var dias_credito = button.getAttribute(
                        'data-dias_credito');
                    var canal = button.getAttribute(
                        'data-canal');
                    var vent_dia = button.getAttribute(
                        'data-vent_dia');
                    var vehiculo_propio = button.getAttribute(
                        'data-vehiculo_propio');
                    var acuerdos = button.getAttribute(
                        'data-acuerdos');
                    var opciones = button.getAttribute(
                        'data-opciones');
                    var documentos2 = button.getAttribute(
                        'data-documentos2');
                    var estado_cliente = button.getAttribute(
                        'data-estado_cliente');
                    var tarifasSeleccionadas = JSON.parse(button.getAttribute('data-tarifas') || '[]');
                    var extrasSeleccionadas = JSON.parse(button.getAttribute('data-extras') || '[]');

                    // Identificadores únicos para checkboxes de tarifas y extras
                    var tipovehiculosCheckboxes = document.querySelectorAll('.tarifa-checkbox');
                    var extraCheckboxes = document.querySelectorAll('.extra-checkbox');



                    extraCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = false; // Desmarcar todos inicialmente
                        if (extrasSeleccionadas.includes(checkbox.value)) {
                            checkbox.checked = true; // Marcar solo los seleccionados
                        }
                    });

                    // Manejar los eventos de selección de todos (select all)

                    var selectAllExtraCheckbox = document.getElementById('select_all_extra');


                    selectAllExtraCheckbox.addEventListener('change', function() {
                        extraCheckboxes.forEach(function(checkbox) {
                            checkbox.checked = selectAllExtraCheckbox.checked;
                        });
                    });
                    // Actualiza la acción del formulario con el ID del cliente
                    var form = document.getElementById('editEmpresaForm');
                    if (form) {
                        form.action = `/clientesempresa/${id}`;
                        var selectTipoDocumento = document.getElementById('tipo_documento2');
                        if (selectTipoDocumento) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectTipoDocumento.options.length; i++) {
                                console.log('Value:', selectTipoDocumento.options[i].value, 'Text:',
                                    selectTipoDocumento.options[i].text);
                            }
                            selectTipoDocumento.value = tipo_documento.toString()
                                .trim();
                            if (selectTipoDocumento.value !== tipo_documento.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el tipo de documento. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "tipo_documento" no se encontró en el DOM.');
                        }
                        var selectPaisDocumento = document.getElementById('pais_documento2');
                        if (selectPaisDocumento) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectPaisDocumento.options.length; i++) {
                                console.log('Value:', selectPaisDocumento.options[i].value, 'Text:',
                                    selectPaisDocumento.options[i].text);
                            }
                            selectPaisDocumento.value = pais_documento.toString()
                                .trim();
                            if (selectPaisDocumento.value !== pais_documento.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el tipo de documento. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "tipo_documento" no se encontró en el DOM.');
                        }
                        var selectSector = document.getElementById('sector_economico2');
                        if (selectSector) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectSector.options.length; i++) {
                                console.log('Value:', selectSector.options[i].value, 'Text:',
                                    selectSector.options[i].text);
                            }
                            selectSector.value = sector_economico.toString()
                                .trim();
                            if (selectSector.value !== sector_economico.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el tipo de documento. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "tipo_documento" no se encontró en el DOM.');
                        }
                        var selectSucursal = document.getElementById('sucursal2');
                        if (selectSucursal) {
                            // Seleccionar la sucursal en el modal al cargar
                            selectSucursal.value = sucursal;
                            if (selectSucursal.value !== sucursal) {
                                console.error(
                                    'No se pudo seleccionar la sucursal. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }

                            // Función para cargar tarifas basadas en la sucursal seleccionada
                            function cargarTarifas(sucursalId) {
                                if (sucursalId) {
                                    fetch(`/tarifas2?sucursal=${sucursalId}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            let tarifasHtml = '';

                                            if (data.tarifas && data.tarifas.length > 0) {
                                                tarifasHtml += `<div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="select_all_tarifa">
                                                        <label class="form-check-label" for="select_all_tarifa">Seleccionar todos</label>
                                                    </div><br/>
                                                    <div class="row g-3">`;

                                                data.tarifas.forEach(tarifa => {
                                                    const isChecked = tarifasSeleccionadas
                                                        .includes(tarifa.id.toString()) ?
                                                        'checked' : '';
                                                    tarifasHtml += `<div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input tarifa-checkbox" type="checkbox" name="tarifas2[]" value="${tarifa.id}" id="tarifa_${tarifa.id}" ${isChecked}>
                                                                <label class="form-check-label" for="tarifa_${tarifa.id}">${tarifa.nombre}</label>
                                                            </div>
                                                        </div>`;
                                                });

                                                tarifasHtml += '</div>';
                                            } else {
                                                tarifasHtml = '<p>No hay tarifas disponibles.</p>';
                                            }

                                            document.getElementById('tarifas-container2').innerHTML =
                                                tarifasHtml;

                                            // Manejar el checkbox de "Seleccionar todos"
                                            var selectAllTarifaCheckbox = document.getElementById(
                                                'select_all_tarifa');
                                            if (selectAllTarifaCheckbox) {
                                                selectAllTarifaCheckbox.addEventListener('change',
                                                    function() {
                                                        var tarifaCheckboxes = document
                                                            .querySelectorAll('.tarifa-checkbox');
                                                        tarifaCheckboxes.forEach(function(
                                                            checkbox) {
                                                            checkbox.checked =
                                                                selectAllTarifaCheckbox
                                                                .checked;
                                                        });
                                                    });
                                            }
                                        })
                                        .catch(error => console.error('Error fetching tarifas:', error));
                                } else {
                                    document.getElementById('tarifas-container2').innerHTML =
                                        '<p>No hay tarifas disponibles.</p>';
                                }
                            }

                            // Cargar tarifas inicialmente al mostrar el modal
                            cargarTarifas(sucursal);

                            // Agregar evento change al select para actualizar tarifas al cambiar la sucursal
                            selectSucursal.addEventListener('change', function() {
                                var selectedSucursalId = selectSucursal.value;
                                cargarTarifas(selectedSucursalId);
                            });
                        } else {
                            console.error(
                                'El elemento select con id "sucursal2" no se encontró en el DOM.');
                        }

                        var selectVehiculoPropio = document.getElementById('edit_vehiculo_propio');

                        // Asegúrate de que el elemento <select> existe
                        if (selectVehiculoPropio) {
                            // Establece el valor en el select
                            selectVehiculoPropio.value = vehiculo_propio;

                            // Verifica si el valor se asignó correctamente
                            if (selectVehiculoPropio.value !== vehiculo_propio) {
                                console.error(
                                    'No se pudo seleccionar el valor de vehículo propio. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "edit_vehiculo_propio" no se encontró en el DOM.'
                            );
                        }
                        var selectIdioma = document.getElementById('idioma2');
                        if (selectIdioma) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectIdioma.options.length; i++) {
                                console.log('Value:', selectIdioma.options[i].value, 'Text:',
                                    selectIdioma.options[i].text);
                            }
                            selectIdioma.value = idiomas.toString()
                                .trim();
                            if (selectIdioma.value !== idiomas.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el tipo de documento. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "tipo_documento" no se encontró en el DOM.');
                        }
                        var selectPago = document.getElementById('medio_pago2');

                        // Asegúrate de que el elemento <select> existe
                        if (selectPago) {
                            // Establece el valor en el select
                            selectPago.value = medio_pago;

                            // Verifica si el valor se asignó correctamente
                            if (selectPago.value !== medio_pago) {
                                console.error(
                                    'No se pudo seleccionar el medio de pago. Asegúrate de que el valor coincide con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "medio_pago2" no se encontró en el DOM.');
                        }
                        var selectPais = document.getElementById('pais2');
                        var selectCiudad = document.getElementById('ciudad2');

                        if (selectPais && selectCiudad) {
                            // Establece el país seleccionado
                            selectPais.value = pais.toString().trim();

                            // Verifica si el país se seleccionó correctamente
                            if (selectPais.value !== pais.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el país. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            } else {
                                // Cargar ciudades correspondientes al país seleccionado
                                $.ajax({
                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                    type: 'GET',
                                    data: {
                                        pais_id: pais
                                    },
                                    success: function(data) {
                                        selectCiudad.innerHTML =
                                            ''; // Limpiar el selector de ciudades
                                        selectCiudad.appendChild(new Option(
                                            'Seleccione una ciudad', ''
                                        )); // Agregar opción predeterminada

                                        // Llenar el select con las ciudades correspondientes
                                        $.each(data, function(key, ciudad) {
                                            var option = new Option(ciudad.nombre,
                                                ciudad.id);
                                            selectCiudad.appendChild(option);
                                        });

                                        // Establecer la ciudad seleccionada
                                        selectCiudad.value = municipio.toString().trim();

                                        // Verifica si la ciudad se seleccionó correctamente
                                        if (selectCiudad.value !== municipio.toString()
                                            .trim()) {
                                            console.error(
                                                'No se pudo seleccionar la ciudad. Asegúrate de que el valor coincida con una de las opciones del select.'
                                            );
                                        }
                                    }
                                });
                            }
                        } else {
                            console.error(
                                'El elemento select para el país o la ciudad no se encontró en el DOM.');
                        }
                        var contactGroup = document.querySelector('.contact-group3');

                        // Limpiar los campos de contacto existentes
                        contactGroup.innerHTML = '';

                        // Iterar sobre los arrays y crear los campos de entrada
                        for (var i = 0; i < persona_contacto.length; i++) {
                            addContactField2(persona_contacto[i], numero_contacto[i]);
                        }
                        document.getElementById('edit_name').value =
                            name;
                        document.getElementById('edit_cuenta_contable').value =
                            cuenta_contable;
                        document.getElementById('edit_razon_social').value =
                            razon_social;

                        document.getElementById('edit_direccion').value =
                            direccion;
                        document.getElementById('edit_email').value =
                            email;
                        document.getElementById('edit_numero_documento').value =
                            numero_documento;
                        document.getElementById('edit_codigo_postal').value =
                            codigo_postal;
                        var inputDiasCredito = document.getElementById('dias_credito2');
                        if (inputDiasCredito) {
                            inputDiasCredito.value = dias_credito;
                            if (inputDiasCredito.value !== dias_credito) {
                                console.error(
                                    'No se pudo asignar el valor de días de crédito. Asegúrate de que el valor es válido y el campo de entrada existe.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento de entrada con id "dias_credito2" no se encontró en el DOM.'
                            );
                        }

                        document.getElementById('web2').value =
                            web;
                        document.getElementById('edit_canal').value =
                            canal;
                        document.getElementById('edit_vent_dia').value =
                            vent_dia;
                        document.getElementById('edit_observaciones').value =
                            observaciones;
                        document.getElementById('edit_acuerdos').value =
                            acuerdos;
                        // Verifica que el contenedor de archivos existentes existe
                        var existingFilesContainer = document.getElementById('existingFilesContainer4');
                        if (existingFilesContainer) {
                            // Limpia el contenedor de archivos existentes
                            existingFilesContainer.innerHTML = '';

                            if (documentos2) {
                                try {
                                    var filesArray = JSON.parse(
                                        documentos2); // Convierte el string JSON a un array

                                    filesArray.forEach(function(filePath) {
                                        var fileName = filePath.replace('public/graficos/', '');
                                        var fileUrl =
                                            `/storage/graficos/${fileName}`;

                                        // Crea elementos de previsualización
                                        var previewElement = document.createElement('div');
                                        previewElement.className = 'file-preview5 mb-3';

                                        if (fileName.endsWith('.pdf')) {
                                            // Crea un contenedor para el ícono y el enlace
                                            var linkElement = document.createElement('a');
                                            linkElement.href = fileUrl;
                                            linkElement.target =
                                                '_blank'; // Abre el archivo en una nueva pestaña

                                            // Crea el elemento de imagen
                                            var imgElement = document.createElement('img');
                                            imgElement.src =
                                                '/storage/graficos/docx-icon.png'; // Ruta del ícono
                                            imgElement.alt = 'Documento PDF'; // Texto alternativo
                                            imgElement.className =
                                                'file-icon'; // Clase CSS para estilizar el ícono
                                            imgElement.style.width =
                                                '50px'; // Ancho del ícono (ajusta según necesidad)
                                            imgElement.style.height =
                                                '50px'; // Altura del ícono (ajusta según necesidad)
                                            imgElement.style.cursor =
                                                'pointer'; // Cambia el cursor a puntero para indicar que es clicable

                                            // Añade el ícono al enlace
                                            linkElement.appendChild(imgElement);

                                            // Añade el enlace con el ícono al contenedor de previsualización
                                            previewElement.appendChild(linkElement);
                                        } else if (fileName.match(/\.(jpg|jpeg|png|webp|gif)$/i)) {
                                            var img = document.createElement('img');
                                            img.src = fileUrl;
                                            img.className = 'preview5-img';
                                            img.alt = 'Vista previa de la imagen';
                                            previewElement.appendChild(img);
                                        }

                                        // Añade el botón de eliminación después del archivo
                                        var removeButton = document.createElement('button');
                                        removeButton.innerText = 'X';
                                        removeButton.className =
                                            'btn btn-danger btn-sm remove-button';
                                        removeButton.style.display = 'block';
                                        removeButton.style.marginTop = '10px';
                                        removeButton.style.marginLeft = '-10px';
                                        removeButton.onclick = function(event) {
                                            event.preventDefault();

                                            // Eliminar el archivo del contenedor
                                            existingFilesContainer.removeChild(previewElement);

                                            // Añadir el archivo eliminado al array de archivos eliminados
                                            deletedFiles.push(fileName);

                                            // Actualizar el campo oculto con los archivos eliminados
                                            document.getElementById('deletedFiles').value = JSON
                                                .stringify(deletedFiles);
                                        };

                                        // Agrega el botón de eliminación al elemento de previsualización
                                        previewElement.appendChild(removeButton);

                                        existingFilesContainer.appendChild(previewElement);
                                    });
                                } catch (e) {
                                    console.error('Error procesando archivos existentes:', e);
                                }
                            }
                        } else {
                            console.error('El contenedor de archivos existentes no se encontró en el DOM.');
                        }



                        document.getElementById('edit_opciones').value =
                            opciones;

                        document.getElementById('edit_estado_cliente').value =
                            estado_cliente;


                    } else {
                        console.error('Formulario no encontrado: editEmpresaForm');
                    }
                });
            } else {
                console.error('Modal no encontrado: editclienteempresaModal');
            }


            function addContactField2(persona = '', numero = '') {
                const contactGroup = document.querySelector('.contact-group3');

                // Solo agrega nuevos contactos si hay al menos un campo con datos
                if (persona.trim() !== '' || numero.trim() !== '') {
                    const newContactItem = document.createElement('div');
                    newContactItem.className =
                        'row contact-group-item'; // Cambiar nombre de clase para el nuevo ítem
                    newContactItem.innerHTML = `
            <div class="col-md-6 mb-3">
                <label for="persona_contacto">Persona de Contacto</label>
                <input type="text" name="persona_contacto[]" class="form-control" value="${persona}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="numero_contacto">Número de Contacto</label>
                <div class="input-group">
                    <input type="text" name="numero_contacto[]" class="form-control" value="${numero}" readonly oninput="validateNumberInputmas3(this)">
                    <button type="button" class="btn btn-danger btn-remove" onclick="removeContact3(this)">X</button>
                </div>
            </div>
        `;

                    contactGroup.appendChild(newContactItem);
                }
            }

            function validateNumberInputmas3(input) {
                // Reemplaza cualquier caracter que no sea número o el signo +
                input.value = input.value.replace(/[^0-9+]/g, '');

                // Limita a 10 caracteres como máximo
                if (input.value.length > 15) {
                    input.value = input.value.slice(0, 15);
                }
            }



        });
    </script>
</body>

</html>
