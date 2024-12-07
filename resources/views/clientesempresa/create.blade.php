<!doctype html>
<html lang="en">

<head>
    <title>Crear Cliente</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-group {
            flex: 0 0 48%;
            margin-bottom: 15px;
        }

        .form-group.full-width {
            flex: 0 0 100%;
        }

        .hidden {
            display: none;
        }

        .arrow {
            cursor: pointer;
        }

        .arrow i {
            transition: transform 0.3s;
        }

        .arrow.down i {
            transform: rotate(180deg);
        }

        .permissions-list {
            padding-left: 20px;
        }

        .form-check {
            display: block;
            margin-bottom: 1rem;
            /* Ajusta el margen según sea necesario */
        }

        .preview-img {
            max-width: 100%;
            max-height: 300px;
            display: none;
        }

        .container {
            margin: 20px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .btn-add,
        .btn-remove {
            margin-left: 10px;
        }

        .btn-add,
        .btn-remove {
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="createClientEmpresaModal" tabindex="-1"
            aria-labelledby="createClientEmpresaModalLabel" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createClientEmpresaModalLabel">Crear Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('clientesempresa.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="tipo_cliente" name="tipo_cliente" value="4">
                            <input type="hidden" id="estado_cliente" name="estado_cliente" value="1">
                            <!-- Mostrar errores generales -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1"
                                        role="tab" aria-controls="tab1" aria-selected="true">Datos Generales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab"
                                        aria-controls="tab2" aria-selected="false">Datos
                                        Especificos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab"
                                        aria-controls="tab3" aria-selected="false">Tarifas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab"
                                        aria-controls="tab4" aria-selected="false">Incrementos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab5-tab" data-toggle="tab" href="#tab5" role="tab"
                                        aria-controls="tab5" aria-selected="false">Extras</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                    aria-labelledby="tab1-tab">
                                    <br />
                                    <div class="row">
                                        <!-- Campos para Tab 1 -->
                                        <div class="col-md-6 mb-3">
                                            <label for="cuenta_contable">Cuenta Contable</label>
                                            <input type="text" name="cuenta_contable"
                                                value="{{ old('cuenta_contable') }}" class="form-control" maxlength="20"
                                                required>
                                            @if ($errors->has('cuenta_contable'))
                                                <span class="text-danger">{{ $errors->first('cuenta_contable') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Nombre Comercial</label>
                                            <input type="text" name="name" maxlength="20"
                                                value="{{ old('name') }}" class="form-control" required>
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="razon_social">Razón Social</label>
                                            <input type="text" name="razon_social" maxlength="20"
                                                value="{{ old('razon_social') }}" class="form-control" required>
                                            @if ($errors->has('razon_social'))
                                                <span class="text-danger">{{ $errors->first('razon_social') }}</span>
                                            @endif
                                        </div>
                                        @php
                                            $comerciales = \App\Models\SectorComercial::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">Sector Comercial</label>
                                            @if (isset($comerciales) && $comerciales->isNotEmpty())
                                                <select id="sector_economico" name="sector_economico"
                                                    class="form-control" required>
                                                    <option value="">Seleccione un sector</option>
                                                    @foreach ($comerciales as $comercial)
                                                        <option value="{{ $comercial->id }}"
                                                            {{ old('sector_economico') == $comercial->id ? 'selected' : '' }}>
                                                            {{ $comercial->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay comercial disponibles.</p>
                                            @endif
                                            @if ($errors->has('sector_economico'))
                                                <span
                                                    class="text-danger">{{ $errors->first('sector_economico') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" name="direccion" class="form-control"
                                                maxlength="25" value="{{ old('direccion') }}">
                                            @if ($errors->has('direccion'))
                                                <span class="text-danger">{{ $errors->first('direccion') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="codigo_postal">Código Postal</label>
                                            <input type="number" name="codigo_postal"
                                                value="{{ old('codigo_postal') }}" class="form-control"
                                                maxlength="10" oninput="validateNumberInput(this)">
                                            @if ($errors->has('codigo_postal'))
                                                <span class="text-danger">{{ $errors->first('codigo_postal') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $pais = \App\Models\Pais::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="pais">País</label>
                                            @if (isset($pais) && $pais->isNotEmpty())
                                                <select id="pais" name="pais" class="form-control" required>
                                                    <option value="">Seleccione un país</option>
                                                    @foreach ($pais as $pai)
                                                        <option value="{{ $pai->id }}"
                                                            {{ old('pais') == $pai->id ? 'selected' : '' }}>
                                                            {{ $pai->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay países disponibles.</p>
                                            @endif
                                            @if ($errors->has('pais'))
                                                <span class="text-danger">{{ $errors->first('pais') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="ciudad">Ciudad</label>
                                            <select id="ciudad" name="municipio" class="form-control" required>
                                                <option value="">Seleccione una ciudad</option>
                                            </select>
                                            @if ($errors->has('municipio'))
                                                <span class="text-danger">{{ $errors->first('municipio') }}</span>
                                            @endif
                                        </div>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                // Cargar las ciudades automáticamente si hay un valor 'old' para el país
                                                var oldPais = "{{ old('pais') }}";
                                                var oldMunicipio = "{{ old('municipio') }}";

                                                if (oldPais) {
                                                    $('#pais').val(oldPais).trigger('change');
                                                }

                                                $('#pais').on('change', function() {
                                                    var paisId = $(this).val();

                                                    if (paisId) {
                                                        $.ajax({
                                                            url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                            type: 'GET',
                                                            data: {
                                                                pais_id: paisId
                                                            },
                                                            success: function(data) {
                                                                $('#ciudad').empty(); // Limpiar el selector de ciudades
                                                                $('#ciudad').append(
                                                                    '<option value="">Seleccione una ciudad</option>');

                                                                $.each(data, function(key, ciudad) {
                                                                    var selected = (oldMunicipio == ciudad.id) ?
                                                                        'selected' :
                                                                        ''; // Verificar si es la ciudad seleccionada previamente
                                                                    $('#ciudad').append('<option value="' + ciudad.id +
                                                                        '" ' + selected + '>' + ciudad.nombre +
                                                                        '</option>');
                                                                });
                                                            }
                                                        });
                                                    } else {
                                                        $('#ciudad').empty(); // Limpiar el selector si no se selecciona un país
                                                        $('#ciudad').append('<option value="">Seleccione una ciudad</option>');
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
                                                <select id="tipo_documento" name="tipo_documento"
                                                    class="form-control">
                                                    <option value="">Seleccione un tipo documento</option>
                                                    @foreach ($tipodocumentos as $tipodocumento)
                                                        <option value="{{ $tipodocumento->id }}"
                                                            {{ old('tipo_documento') == $tipodocumento->id ? 'selected' : '' }}>
                                                            {{ $tipodocumento->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay documentos disponibles.</p>
                                            @endif
                                            @if ($errors->has('tipo_documento'))
                                                <span
                                                    class="text-danger">{{ $errors->first('tipo_documento') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="numero_documento">Número de Documento</label>
                                            <input type="text" name="numero_documento"
                                                value="{{ old('numero_documento') }}" class="form-control"
                                                maxlength="15" oninput="validateNumberInputlet(this)">
                                            @if ($errors->has('numero_documento'))
                                                <span
                                                    class="text-danger">{{ $errors->first('numero_documento') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $paisdocumentos = \App\Models\Pais::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="pais_documento">País del Documento</label>
                                            @if (isset($paisdocumentos) && $paisdocumentos->isNotEmpty())
                                                <select id="pais_documento" name="pais_documento"
                                                    class="form-control" required>
                                                    <option value="">Seleccione un país</option>
                                                    @foreach ($paisdocumentos as $paisdocumento)
                                                        <option value="{{ $paisdocumento->id }}"
                                                            {{ old('pais_documento') == $paisdocumento->id ? 'selected' : '' }}>
                                                            {{ $paisdocumento->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay países disponibles.</p>
                                            @endif
                                            @if ($errors->has('pais_documento'))
                                                <span
                                                    class="text-danger">{{ $errors->first('pais_documento') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control" required>
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row contact-group5">
                                        <div class="col-md-6 mb-3">
                                            <label for="persona_contacto">Persona de Contacto</label>

                                            @php
                                                $persona_contacto_old = old('persona_contacto', []);
                                                $numero_contacto_old = old('numero_contacto', []);
                                            @endphp

                                            <!-- Mostrar campos con datos previos (old) si existen -->
                                            @if (count($persona_contacto_old) > 0)
                                                @foreach ($persona_contacto_old as $index => $persona)
                                                    <input type="text" name="persona_contacto[]"
                                                        value="{{ $persona }}" class="form-control mb-2"
                                                        maxlength="15" required>
                                                @endforeach
                                            @else
                                                <!-- Campo de entrada en blanco adicional por defecto -->
                                                <input type="text" name="persona_contacto[]" value=""
                                                    class="form-control mb-2" maxlength="15">
                                            @endif
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="numero_contacto">Número de Contacto</label>

                                            @if (count($numero_contacto_old) > 0)
                                                @foreach ($numero_contacto_old as $index => $numero)
                                                    <div class="input-group mb-2">
                                                        <input type="text" name="numero_contacto[]"
                                                            value="{{ $numero }}" class="form-control"
                                                            maxlength="10" required
                                                            oninput="validateNumberInputmas(this)">
                                                        @if ($index == 0)
                                                            <button type="button" class="btn btn-primary btn-add"
                                                                onclick="addContact()">+</button>
                                                        @else
                                                            <button type="button" class="btn btn-danger btn-remove"
                                                                onclick="removeContact(this)">X</button>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @else
                                                <!-- Campo de entrada en blanco adicional por defecto -->
                                                <div class="input-group mb-2">
                                                    <input type="text" name="numero_contacto[]" value=""
                                                        class="form-control" maxlength="15"
                                                        oninput="validateNumberInputmas(this)">
                                                    <button type="button" class="btn btn-primary btn-add"
                                                        onclick="addContact()">+</button>
                                                </div>
                                            @endif
                                        </div>

                                        <script>
                                            function addContact() {
                                                const contactGroup = document.querySelector('.contact-group5');

                                                const newContactItem = document.createElement('div');
                                                newContactItem.className = 'row';
                                                newContactItem.innerHTML = `
                                                    <div class="col-md-6 mb-3">
                                                        <label for="persona_contacto">Persona de Contacto</label>
                                                        <input type="text" name="persona_contacto[]" class="form-control mb-2" maxlength="15" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="numero_contacto">Número de Contacto</label>
                                                        <div class="input-group mb-2">
                                                            <input type="text" name="numero_contacto[]" class="form-control" maxlength="10" required oninput="validateNumberInputmas(this)">
                                                            <button type="button" class="btn btn-danger btn-remove" onclick="removeContact(this)">X</button>
                                                        </div>
                                                    </div>
                                                `;

                                                // Agregar el nuevo conjunto de campos al final del contenedor contact-group
                                                contactGroup.parentElement.appendChild(newContactItem);
                                            }

                                            function removeContact(button) {
                                                button.closest('.row').remove();
                                            }
                                        </script>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="web">Página Web</label>
                                            <input type="text" name="web" value="{{ old('web') }}"
                                                class="form-control" maxlength="255">
                                            @if ($errors->has('web'))
                                                <span class="text-danger">{{ $errors->first('web') }}</span>
                                            @endif
                                        </div>
                                        @php
                                            $sucursales = \App\Models\Sucursal::all();
                                        @endphp
                                        <div class="form-group">
                                            <label for="sucursal">Pertenece a la Sucursal</label>
                                            @if (isset($sucursales) && $sucursales->isNotEmpty())
                                                <select id="sucursal" name="sucursal" class="form-control" required>
                                                    <option value="">Seleccione una sucursal</option>
                                                    @foreach ($sucursales as $sucursal)
                                                        <option value="{{ $sucursal->id }}"
                                                            {{ old('sucursal') == $sucursal->id ? 'selected' : '' }}>
                                                            {{ $sucursal->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay sucursales disponibles.</p>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="vehiculo_propio">Vehículo Propio</label>
                                            <select name="vehiculo_propio" class="form-control">
                                                <option value="1"
                                                    {{ old('vehiculo_propio') == '1' ? 'selected' : '' }}>Sí</option>
                                                <option value="0"
                                                    {{ old('vehiculo_propio') == '0' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>

                                        @php
                                            $idiomas = \App\Models\Idioma::all();
                                        @endphp
                                        <div class="form-group">
                                            <label for="idiomas">Idiomas</label>
                                            @if (isset($idiomas) && $idiomas->isNotEmpty())
                                                <select id="idiomas" name="idiomas" class="form-control" required>
                                                    <option value="">Seleccione un idioma</option>
                                                    @foreach ($idiomas as $idioma)
                                                        <option value="{{ $idioma->id }}"
                                                            {{ old('idiomas') == $idioma->id ? 'selected' : '' }}>
                                                            {{ $idioma->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay idiomas disponibles.</p>
                                            @endif
                                        </div>

                                    </div>


                                </div>
                                <div class="tab-pane fade" id="tab2" role="tabpanel"
                                    aria-labelledby="tab2-tab">
                                    <br />
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="medio_pago">Medio de Pago</label>
                                            <select name="medio_pago" id="medio_pago" class="form-control">
                                                <option value="">Seleccione un medio de pago</option>
                                                <option value="tarjeta_credito"
                                                    {{ old('medio_pago') == 'tarjeta_credito' ? 'selected' : '' }}>
                                                    Tarjeta de Crédito</option>
                                                <option value="tarjeta_debito"
                                                    {{ old('medio_pago') == 'tarjeta_debito' ? 'selected' : '' }}>
                                                    Tarjeta de Débito</option>
                                                <option value="transferencia_bancaria"
                                                    {{ old('medio_pago') == 'transferencia_bancaria' ? 'selected' : '' }}>
                                                    Transferencia Bancaria</option>
                                                <option value="webpay"
                                                    {{ old('medio_pago') == 'webpay' ? 'selected' : '' }}>Webpay
                                                </option>
                                                <option value="khipu"
                                                    {{ old('medio_pago') == 'khipu' ? 'selected' : '' }}>Khipu</option>
                                                <option value="paypal"
                                                    {{ old('medio_pago') == 'paypal' ? 'selected' : '' }}>PayPal
                                                </option>
                                                <option value="mercadopago"
                                                    {{ old('medio_pago') == 'mercadopago' ? 'selected' : '' }}>Mercado
                                                    Pago</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="dias_credito">Días de Crédito</label>
                                            <input type="number" name="dias_credito"
                                                value="{{ old('dias_credito') }}" class="form-control"
                                                maxlength="5" oninput="validateNumberInput(this)">
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $canalventas = \App\Models\Canalventa::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="canal">Canal</label>

                                            @if (isset($canalventas) && $canalventas->isNotEmpty())
                                                <select id="canal" name="canal" class="form-control">
                                                    <option value="">Seleccione un canal</option>
                                                    @foreach ($canalventas as $canalventa)
                                                        <option value="{{ $canalventa->id }}"
                                                            {{ old('canal') == $canalventa->id ? 'selected' : '' }}>
                                                            {{ $canalventa->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay canal disponibles.</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="vent_dia">Ventas del Día</label>
                                            <input type="number" name="vent_dia" value="{{ old('vent_dia') }}"
                                                class="form-control" maxlength="5"
                                                oninput="validateNumberInput(this)">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="observaciones-tab"
                                                    data-bs-toggle="tab" data-bs-target="#observaciones"
                                                    type="button" role="tab" aria-controls="observaciones"
                                                    aria-selected="true">Observaciones</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="acuerdos-tab" data-bs-toggle="tab"
                                                    data-bs-target="#acuerdos" type="button" role="tab"
                                                    aria-controls="acuerdos" aria-selected="false">Acuerdos</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="opcion-tab" data-bs-toggle="tab"
                                                    data-bs-target="#opcion" type="button" role="tab"
                                                    aria-controls="opcion" aria-selected="false">Opciones</button>
                                            </li>

                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="observaciones" role="tabpanel"
                                                aria-labelledby="observaciones-tab">


                                                <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>


                                            </div>
                                            <div class="tab-pane fade" id="acuerdos" role="tabpanel"
                                                aria-labelledby="acuerdos-tab">


                                                <textarea name="acuerdos" class="form-control">{{ old('acuerdos') }}</textarea>

                                            </div>
                                            <div class="tab-pane fade" id="opcion" role="tabpanel"
                                                aria-labelledby="opcion-tab">
                                                <br />
                                                <div id="checkbox-container" class="form-check">
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

                                                        // Obtenemos las opciones seleccionadas previamente de la función old()
                                                        const preCheckedOptions = @json(old('opciones', []));
                                                        const preCheckedOptions3 = [
                                                            'Es un arrendatario',
                                                            'Incluir Importes a facturar en contrato',
                                                            'Facturación a mes anticipado'
                                                        ];

                                                        const checkboxContainer = document.getElementById('checkbox-container');

                                                        options.forEach(option => {
                                                            const div = document.createElement('div');
                                                            div.className = 'form-check';

                                                            const input = document.createElement('input');
                                                            input.className = 'form-check-input tarifa-checkbox';
                                                            input.type = 'checkbox';
                                                            input.name = 'opciones[]';
                                                            input.value = option;

                                                            // Seleccionar opciones previamente seleccionadas usando old()
                                                            if (preCheckedOptions.includes(option)) {
                                                                input.checked = true;
                                                            }
                                                            if (preCheckedOptions3.includes(option)) {
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
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <br />
                                            <label for="archivo2" class="form-label">Archivo</label>
                                            <div class="input-group">
                                                <input class="form-control" type="file" name="documentos2[]"
                                                    id="archivo2"
                                                    accept=".pdf, .docx, .jpg, .jpeg, .png, .webp, .gif" multiple>

                                                <button type="button" class="btn btn-primary"
                                                    id="addFileButton2">+</button>
                                            </div>
                                            <div class="error-message text-danger" id="archivoError2"></div>
                                            <br />
                                            <div id="previewContainer2" style="display: none;">
                                                <h5>Previsualización del Documento:</h5>
                                                <embed id="preview2" type="application/pdf" width="100%"
                                                    height="600px" />
                                                <img id="previewImg2" class="preview-img"
                                                    alt="Vista previa de la imagen" />
                                            </div>
                                        </div>
                                        <div id="additionalFilesContainer2"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3" role="tabpanel"
                                    aria-labelledby="tab3-tab">
                                    <br />
                                    <div id="tarifas-container" class="mb-12">
                                        <!-- Las tarifas filtradas se cargarán aquí -->
                                    </div>
                                    <script>
                                        document.getElementById('sucursal').addEventListener('change', function() {
                                            const sucursalId = this.value;

                                            if (sucursalId) {
                                                fetch(`/tarifas2?sucursal=${sucursalId}`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        let tarifasHtml = '';

                                                        if (data.tarifas.length > 0) {
                                                            tarifasHtml += `<div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" id="select_all_tarifa">
                                                                                <label class="form-check-label" for="select_all_tarifa">
                                                                                    Seleccionar todos
                                                                                </label>
                                                                            </div><br/>
                                                                            <div class="row g-3">`;

                                                            data.tarifas.forEach(tarifa => {
                                                                tarifasHtml += `<div class="col-md-4">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input tarifa-checkbox" type="checkbox" name="tarifas[]" value="${tarifa.id}" id="tarifa_${tarifa.id}">
                                                                                        <label class="form-check-label" for="tarifa_${tarifa.id}">${tarifa.nombre}</label>
                                                                                    </div>
                                                                                </div>`;
                                                            });

                                                            tarifasHtml += '</div>';
                                                        } else {
                                                            tarifasHtml = '<p>No hay tarifas disponibles.</p>';
                                                        }

                                                        document.getElementById('tarifas-container').innerHTML = tarifasHtml;
                                                    })
                                                    .catch(error => console.error('Error fetching tarifas:', error));
                                            } else {
                                                document.getElementById('tarifas-container').innerHTML = '<p>No hay tarifas disponibles.</p>';
                                            }
                                        });
                                    </script>
                                </div>
                                <div class="tab-pane fade" id="tab5" role="tabpanel"
                                    aria-labelledby="tab5-tab">
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
                                                                type="checkbox" name="extras[]"
                                                                value="{{ $extra->id }}"
                                                                id="extra_{{ $extra->id }}"
                                                                {{ in_array($extra->id, old('extras', [])) ? 'checked' : '' }}>
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
                                    document.getElementById('archivo2').addEventListener('change', function(event) {
                                        handleFilePreview2(event, 'archivoError2', 'previewContainer2', 'preview2', 'previewImg2');
                                    });

                                    document.getElementById('addFileButton2').addEventListener('click', function() {
                                        addFileField2();
                                    });

                                    function handleFilePreview2(event, errorId, containerId, previewId, imgId) {
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

                                    function addFileField2() {
                                        const container = document.getElementById('additionalFilesContainer2');
                                        const index = container.children.length + 1;

                                        const row = document.createElement('div');
                                        row.className = 'row';

                                        const col = document.createElement('div');
                                        col.className = 'col-md-12';

                                        const label = document.createElement('label');
                                        label.className = 'form-label';
                                        label.htmlFor = 'archivo2_' + index;
                                        label.textContent = 'Archivo';

                                        const inputGroup = document.createElement('div');
                                        inputGroup.className = 'input-group';

                                        const input = document.createElement('input');
                                        input.type = 'file';
                                        input.name = 'documentos2[]';
                                        input.id = 'archivo2_' + index;
                                        input.accept = '.pdf, .docx, .jpg, .jpeg, .png, .webp, .gif';
                                        input.className = 'form-control';
                                        input.addEventListener('change', function(event) {
                                            handleFilePreview2(event, 'archivoError2_' + index, 'previewContainer2_' + index, 'preview2_' +
                                                index, 'previewImg2_' + index);
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
                                        errorMessage.id = 'archivoError2_' + index;
                                        col.appendChild(errorMessage);

                                        const previewContainer = document.createElement('div');
                                        previewContainer.id = 'previewContainer2_' + index;
                                        previewContainer.style.display = 'none';

                                        const previewTitle = document.createElement('h5');
                                        previewTitle.textContent = 'Previsualización del Documento:';
                                        previewContainer.appendChild(previewTitle);

                                        const embed = document.createElement('embed');
                                        embed.id = 'preview2_' + index;
                                        embed.type = 'application/pdf';
                                        embed.width = '100%';
                                        embed.height = '600px';
                                        previewContainer.appendChild(embed);

                                        const img = document.createElement('img');
                                        img.id = 'previewImg2_' + index;
                                        img.className = 'preview-img';
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
                                    <button class="btn btn-primary btn-block fa-lg mb-3"
                                        type="submit">Guardar</button>
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
        function validateNumberInput(input) {
            // Reemplaza cualquier caracter que no sea número
            input.value = input.value.replace(/[^0-9]/g, '');

            // Limita a 10 caracteres como máximo
            if (input.value.length > 10) {
                input.value = input.value.slice(0, 10);
            }
        }

        function validateNumberInputmas(input) {
            // Reemplaza cualquier caracter que no sea número o el signo +
            input.value = input.value.replace(/[^0-9+]/g, '');

            // Limita a 10 caracteres como máximo
            if (input.value.length > 15) {
                input.value = input.value.slice(0, 15);
            }
        }


        function validateNumberInputlet(input) {
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
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                var modal = new bootstrap.Modal(document.getElementById('createClientEmpresaModal'), {});
                modal.show();
            @endif
        });
    </script>

</body>

</html>
