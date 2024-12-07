<!doctype html>
<html lang="en">

<head>
    <title>Editar Proveedor</title>
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
        <div class="modal fade" id="editproveedorModal" tabindex="-1" aria-labelledby="editproveedorModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editproveedorModalLabel">Editar Proveedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="editproveedorForm" action="" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <input type="hidden" id="tipo_cliente" name="tipo_cliente" value="6">
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
                                    <a class="nav-link active" id="tab5-tab" data-toggle="tab" href="#tab5"
                                        role="tab" aria-controls="tab5" aria-selected="true">Datos Generales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab6-tab" data-toggle="tab" href="#tab6" role="tab"
                                        aria-controls="tab6" aria-selected="false">RGPD</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab7-tab" data-toggle="tab" href="#tab7" role="tab"
                                        aria-controls="tab7" aria-selected="false">Archivos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab8-tab" data-toggle="tab" href="#tab8" role="tab"
                                        aria-controls="tab8" aria-selected="false">Ojear</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab5" role="tabpanel"
                                    aria-labelledby="tab5-tab">
                                    <br />
                                    <div class="row">
                                        <!-- Campos para Tab 1 -->
                                        <div class="col-md-6 mb-3">
                                            <label for="cuenta_contable">Cuenta Contable</label>
                                            <input type="number" id="edit_cuenta_contable" name="cuenta_contable"
                                                value="{{ old('cuenta_contable') }}" class="form-control" maxlength="20"
                                                required>
                                            @if ($errors->has('cuenta_contable'))
                                                <span class="text-danger">{{ $errors->first('cuenta_contable') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Nombres</label>
                                            <input type="text" id="edit_name" name="name" maxlength="30"
                                                value="{{ old('name') }}" class="form-control" required>
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="apellido">Apellidos</label>
                                            <input type="text" id="edit_apellido" name="apellido"
                                                value="{{ old('apellido') }}" class="form-control" maxlength="30">
                                            @if ($errors->has('apellido'))
                                                <span class="text-danger">{{ $errors->first('apellido') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="genero">Género</label>
                                            <select id="edit_genero" name="genero" class="form-control" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="Masculino"
                                                    {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino
                                                </option>
                                                <option value="Femenino"
                                                    {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino
                                                </option>
                                                <option value="Otro" {{ old('genero') == 'Otro' ? 'selected' : '' }}>
                                                    Otro</option>
                                            </select>
                                            @if ($errors->has('genero'))
                                                <span class="text-danger">{{ $errors->first('genero') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $paisn = \App\Models\Pais::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="pais">Nacionalidad</label>
                                            @if (isset($paisn) && $paisn->isNotEmpty())
                                                <select id="paisn2" name="paisn" value="{{ old('paisn') }}"
                                                    class="form-control" required>
                                                    <option value="">Seleccione un país</option>
                                                    @foreach ($paisn as $paisn)
                                                        <option
                                                            value="{{ $paisn->id }}"{{ old('paisn') == $paisn->id ? 'selected' : '' }}>
                                                            {{ $paisn->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay países disponibles.</p>
                                            @endif
                                            @if ($errors->has('paisn'))
                                                <span class="text-danger">{{ $errors->first('paisn') }}</span>
                                            @endif
                                        </div>
                                        @php
                                            $idiomas = \App\Models\Idioma::all();
                                        @endphp
                                        <div class="form-group">
                                            <label for="tipo_documento">Idiomas</label>
                                            @if (isset($idiomas) && $idiomas->isNotEmpty())
                                                <select id="idioma2" name="idiomas"
                                                    value="{{ old('idiomas') }}"class="form-control">
                                                    <option value="">Seleccione un idioma</option>
                                                    @foreach ($idiomas as $idioma)
                                                        <option
                                                            value="{{ $idioma->id }}"{{ old('idiomas') == $idioma->id ? 'selected' : '' }}>
                                                            {{ $idioma->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay idiomas disponibles.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        @php
                                            $tipodocumentos = \App\Models\TipoDocumento::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">Tipo de Documento</label>
                                            @if (isset($tipodocumentos) && $tipodocumentos->isNotEmpty())
                                                <select id="tipo_documento2" name="tipo_documento"
                                                    value="{{ old('tipo_documento') }}" class="form-control">
                                                    <option value="">Seleccione un tipo documento</option>
                                                    @foreach ($tipodocumentos as $tipodocumento)
                                                        <option value="{{ $tipodocumento->id }}"
                                                            {{ old('tipo_documento') == $tipodocumento->id ? 'selected' : '' }}>
                                                            {{ $tipodocumento->nombre }}</option>
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
                                            <input type="text" id="edit_numero_documento" name="numero_documento"
                                                value="{{ old('numero_documento') }}" class="form-control"
                                                maxlength="15" oninput="validateNumberInputlet2(this)" required>
                                            @if ($errors->has('numero_documento'))
                                                <span
                                                    class="text-danger">{{ $errors->first('numero_documento') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row">
                                        @php
                                            $pais = \App\Models\Pais::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="pais">País Documento</label>
                                            @if (isset($pais) && $pais->isNotEmpty())
                                                <select id="pais2" name="pais" value="{{ old('pais') }}"
                                                    class="form-control" required>
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
                                            <label for="ciudad">Ciudad Documento</label>
                                            <select id="ciudad2" name="municipio" value="{{ old('municipio') }}"
                                                class="form-control" required>
                                                <option value="">Seleccione una ciudad</option>
                                            </select>
                                            @if ($errors->has('municipio'))
                                                <span class="text-danger">{{ $errors->first('municipio') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="fachadoc">Fecha Documento</label>
                                            <input type="date" id="fachadoc2" name="fachadoc"
                                                class="form-control" max="{{ date('Y-m-d') }}"
                                                value="{{ old('fachadoc') }}" required>
                                            @if ($errors->has('fachadoc'))
                                                <span class="text-danger">{{ $errors->first('fachadoc') }}</span>
                                            @endif
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <label for="fachacadoc">Fecha Caducidad Documento</label>
                                            <input type="date" id="fachacadoc2" name="fachacadoc"
                                                value="{{ old('fachacadoc') }}" class="form-control" required>
                                            @if ($errors->has('fachacadoc'))
                                                <span class="text-danger">{{ $errors->first('fachacadoc') }}</span>
                                            @endif
                                        </div>

                                        <script>
                                            document.getElementById('fachadoc2').addEventListener('change', function() {
                                                var fechaDocumento = this.value;
                                                // Establece la fecha mínima de "Fecha Caducidad Documento" como la "Fecha Documento" seleccionada
                                                document.getElementById('fachacadoc2').min = fechaDocumento;
                                            });
                                        </script>


                                    </div>

                                    <div class="row">
                                        @php
                                            $tipocarnet = \App\Models\TipoCarnet::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_carnet">Tipo de Carnet</label>
                                            @if (isset($tipocarnet) && $tipocarnet->isNotEmpty())
                                                <select id="tipo_carnet2" name="tipo_carnet"
                                                    value="{{ old('tipo_carnet') }}" class="form-control" required>
                                                    <option value="">Seleccione un tipo carnet</option>
                                                    @foreach ($tipocarnet as $tipocarne)
                                                        <option value="{{ $tipocarne->id }}"
                                                            {{ old('tipo_carnet') == $tipocarne->id ? 'selected' : '' }}>
                                                            {{ $tipocarne->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay documentos disponibles.</p>
                                            @endif
                                            @if ($errors->has('tipo_carnet'))
                                                <span class="text-danger">{{ $errors->first('tipo_carnet') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="numero_carnet">Número de Carnet</label>
                                            <input type="text" id="edit_numero_carnet" name="numero_carnet"
                                                value="{{ old('numero_carnet') }}" class="form-control"
                                                maxlength="15" oninput="validateNumberInputlet2(this)" required>
                                            @if ($errors->has('numero_carnet'))
                                                <span class="text-danger">{{ $errors->first('numero_carnet') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="row">

                                        @php
                                            $paisdocumentos = \App\Models\Pais::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">País del Carnet</label>
                                            @if (isset($paisdocumentos) && $paisdocumentos->isNotEmpty())
                                                <select id="pais_carnet2" name="pais_carnet"
                                                    value="{{ old('pais_carnet') }}" class="form-control" required>
                                                    <option value="">Seleccione un país</option>
                                                    @foreach ($paisdocumentos as $paisdocumento)
                                                        <option
                                                            value="{{ $paisdocumento->id }}"{{ old('pais_carnet') == $paisdocumento->id ? 'selected' : '' }}>
                                                            {{ $paisdocumento->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay pais disponibles.</p>
                                            @endif
                                            @if ($errors->has('pais_carnet'))
                                                <span class="text-danger">{{ $errors->first('pais_carnet') }}</span>
                                            @endif

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="ciudad">Ciudad del Carnet</label>
                                            <select id="ciudad_carnet2" name="ciudad_carnet"
                                                value="{{ old('ciudad_carnet') }}" class="form-control" required>
                                                <option value="">Seleccione una ciudad</option>
                                            </select>
                                            @if ($errors->has('ciudad_carnet'))
                                                <span class="text-danger">{{ $errors->first('ciudad_carnet') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="fachacarnet">Fecha Carnet</label>
                                            <input type="date" id="fachacarnet2" name="fachacarnet"
                                                class="form-control" max="{{ date('Y-m-d') }}"
                                                value="{{ old('fachacarnet') }}" required>
                                            @if ($errors->has('fachacarnet'))
                                                <span class="text-danger">{{ $errors->first('fachacarnet') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="fachacacarnet">Fecha Caducidad Carnet</label>
                                            <input type="date" id="fachacacarnet2" name="fachacacarnet"
                                                value="{{ old('fachacacarnet') }}" class="form-control" required>
                                            @if ($errors->has('fachacacarnet'))
                                                <span class="text-danger">{{ $errors->first('fachacacarnet') }}</span>
                                            @endif
                                        </div>

                                        <script>
                                            document.getElementById('fachacarnet2').addEventListener('change', function() {
                                                var fechaDocumento = this.value;
                                                // Establece la fecha mínima de "Fecha Caducidad Documento" como la "Fecha Documento" seleccionada
                                                document.getElementById('fachacacarnet2').min = fechaDocumento;
                                            });
                                        </script>


                                    </div>
                                    <div class="row">

                                        @php
                                            $paisnacido = \App\Models\Pais::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">País de Nacimiento</label>
                                            @if (isset($paisnacido) && $paisnacido->isNotEmpty())
                                                <select id="pais_nacido2" name="pais_nacido"
                                                    value="{{ old('pais_nacido') }}" class="form-control">
                                                    <option value="">Seleccione un país</option>
                                                    @foreach ($paisnacido as $paisnacido)
                                                        <option value="{{ $paisnacido->id }}"
                                                            {{ old('pais_nacido') == $paisnacido->id ? 'selected' : '' }}>
                                                            {{ $paisnacido->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay pais disponibles.</p>
                                            @endif
                                            @if ($errors->has('pais_nacido'))
                                                <span class="text-danger">{{ $errors->first('pais_nacido') }}</span>
                                            @endif

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="ciudad">Ciudad de Nacimiento</label>
                                            <select id="ciudad_nacido2" name="ciudad_nacido"
                                                value="{{ old('ciudad_nacido') }}" class="form-control">
                                                <option value="">Seleccione una ciudad</option>
                                            </select>
                                            @if ($errors->has('ciudad_nacido'))
                                                <span class="text-danger">{{ $errors->first('ciudad_nacido') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="fachanacido">Fecha Nacimiento</label>
                                            <input type="date" id="fachanacido2" name="fachanacido"
                                                class="form-control" max="{{ date('Y-m-d') }}"
                                                value="{{ old('fachanacido') }}" required>
                                            @if ($errors->has('fachanacido'))
                                                <span class="text-danger">{{ $errors->first('fachanacido') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="numero_contacto">Número de Contacto</label>
                                            <div class="input-group mb-2">
                                                <input type="text" id="edit_numero_contacto"
                                                    name="numero_contacto" value="" class="form-control"
                                                    maxlength="15" value="{{ old('numero_contacto') }}"
                                                    oninput="validateNumberInputmas4(this)" required>
                                                @if ($errors->has('numero_contacto'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('numero_contacto') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" id="edit_email" name="email"
                                                value="{{ old('email') }}" class="form-control" required>
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cliente" class="form-label">Usuario Cliente</label>
                                            <select class="form-select" id="cliente2" name="cliente">
                                                <option value="0"
                                                    {{ old('cliente', '0') == '0' ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ old('cliente', '1') == '1' ? 'selected' : '' }}>
                                                    Sí</option>
                                            </select>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="habitual2-tab"
                                                        data-bs-toggle="tab" data-bs-target="#habitual2"
                                                        type="button" role="tab" aria-controls="habitual2"
                                                        aria-selected="true">Dirección Habitual</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="local2-tab" data-bs-toggle="tab"
                                                        data-bs-target="#local2" type="button" role="tab"
                                                        aria-controls="local2" aria-selected="false">Dirección
                                                        Local</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="observaciones2-tab"
                                                        data-bs-toggle="tab" data-bs-target="#observaciones2"
                                                        type="button" role="tab" aria-controls="observaciones2"
                                                        aria-selected="false">Observaciones</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="avisos2-tab" data-bs-toggle="tab"
                                                        data-bs-target="#avisos2" type="button" role="tab"
                                                        aria-controls="avisos2" aria-selected="false">Avisos</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="opciones2-tab" data-bs-toggle="tab"
                                                        data-bs-target="#opciones2" type="button" role="tab"
                                                        aria-controls="opciones2"
                                                        aria-selected="false">Opciones</button>
                                                </li>


                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="habitual2" role="tabpanel"
                                                    aria-labelledby="habitual2-tab">
                                                    <br />
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="text" id="edit_direccionh"
                                                                name="direccionh" class="form-control" maxlength="40"
                                                                value="{{ old('direccionh') }}">
                                                            @if ($errors->has('direccionh'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('direccionh') }}</span>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $paishabitual = \App\Models\Pais::all();
                                                        @endphp
                                                        <div class="col-md-6 mb-3">
                                                            <label for="tipo_documento">País</label>
                                                            @if (isset($paishabitual) && $paishabitual->isNotEmpty())
                                                                <select id="pais_nacidoh2" name="pais_nacidoh"
                                                                    value="{{ old('pais_nacidoh') }}"
                                                                    class="form-control">
                                                                    <option value="">Seleccione un país</option>
                                                                    @foreach ($paishabitual as $paishabitual)
                                                                        <option value="{{ $paishabitual->id }}"
                                                                            {{ old('pais_nacidoh') == $paishabitual->id ? 'selected' : '' }}>
                                                                            {{ $paishabitual->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <p>No hay pais disponibles.</p>
                                                            @endif
                                                            @if ($errors->has('pais_nacidoh'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('pais_nacidoh') }}</span>
                                                            @endif

                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="ciudad">Ciudad</label>
                                                            <select id="ciudadh2" name="ciudadh"
                                                                value="{{ old('ciudadh') }}" class="form-control">
                                                                <option value="">Seleccione una ciudad</option>
                                                            </select>
                                                            @if ($errors->has('ciudadh'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('ciudadh') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="codigo_postalh">Código Postal</label>
                                                            <input type="number" id="edit_codigo_postalh"
                                                                name="codigo_postalh"
                                                                value="{{ old('codigo_postalh') }}"
                                                                class="form-control" maxlength="15"
                                                                oninput="validateNumberInput(this)">
                                                            @if ($errors->has('codigo_postalh'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('codigo_postalh') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="local2" role="tabpanel"
                                                    aria-labelledby="local2-tab">
                                                    <br />
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="text" id="edit_direccionl"
                                                                name="direccionl" class="form-control" maxlength="40"
                                                                value="{{ old('direccionl') }}">
                                                            @if ($errors->has('direccionl'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('direccionl') }}</span>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $paislocal = \App\Models\Pais::all();
                                                        @endphp
                                                        <div class="col-md-6 mb-3">
                                                            <label for="tipo_documento">País</label>
                                                            @if (isset($paislocal) && $paislocal->isNotEmpty())
                                                                <select id="pais_nacidol2" name="pais_nacidol"
                                                                    value="{{ old('pais_nacidol') }}"
                                                                    class="form-control">
                                                                    <option value="">Seleccione un país</option>
                                                                    @foreach ($paislocal as $paislocal)
                                                                        <option value="{{ $paislocal->id }}"
                                                                            {{ old('pais_nacidol') == $paislocal->id ? 'selected' : '' }}>
                                                                            {{ $paislocal->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <p>No hay pais disponibles.</p>
                                                            @endif
                                                            @if ($errors->has('pais_nacidol'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('pais_nacidol') }}</span>
                                                            @endif

                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="ciudadl">Ciudad</label>
                                                            <select id="ciudadl2" name="ciudadl"
                                                                value="{{ old('ciudadl') }}" class="form-control">
                                                                <option value="">Seleccione una ciudad</option>
                                                            </select>
                                                            @if ($errors->has('ciudadl'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('ciudadl') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="codigo_postallocal">Código Postal</label>
                                                            <input type="number" id="edit_codigo_postallocal"
                                                                name="codigo_postallocal"
                                                                value="{{ old('codigo_postallocal') }}"
                                                                class="form-control" maxlength="15"
                                                                oninput="validateNumberInput(this)">
                                                            @if ($errors->has('codigo_postallocal'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('codigo_postallocal') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="observaciones2" role="tabpanel"
                                                    aria-labelledby="observaciones2-tab">

                                                    <label for="observaciones"></label>
                                                    <textarea name="observaciones" id="edit_observaciones" class="form-control" maxlength="255"
                                                        oninput="updateCharacterCount2(this, 'observacionesCount2')">{{ old('observaciones') }}</textarea>
                                                    <small id="observacionesCount2" class="form-text text-muted">255
                                                        caracteres restantes</small>

                                                </div>

                                                <div class="tab-pane fade" id="avisos2" role="tabpanel"
                                                    aria-labelledby="avisos2-tab">

                                                    <label for="avisos"></label>
                                                    <textarea name="avisos" id="edit_avisos" class="form-control" maxlength="255"
                                                        oninput="updateCharacterCount2(this, 'avisosCount2')">{{ old('avisos') }}</textarea>
                                                    <small id="avisosCount2" class="form-text text-muted">255
                                                        caracteres restantes</small>

                                                </div>
                                                <script>
                                                    function updateCharacterCount2(textarea, counterId2) {
                                                        const maxLength2 = 255;
                                                        const currentLength2 = textarea.value.length;
                                                        const remaining2 = maxLength2 - currentLength2;

                                                        // Actualizar el contador de caracteres
                                                        document.getElementById(counterId2).textContent = remaining2 + ' caracteres restantes';
                                                    }
                                                </script>
                                                <div class="tab-pane fade" id="opciones2" role="tabpanel"
                                                    aria-labelledby="opciones2-tab">
                                                    <br />
                                                    <div class="row">
                                                        @php
                                                            $clienteempresa = \App\Models\ClienteEmpresa::all();
                                                        @endphp
                                                        <div class="col-md-6 mb-3">
                                                            <label for="tipo_documento">Conductor de Empresa</label>
                                                            @if (isset($clienteempresa) && $clienteempresa->isNotEmpty())
                                                                <select id="clienteempresa2" name="clienteempresa"
                                                                    value="{{ old('clienteempresa') }}"
                                                                    class="form-control">
                                                                    <option value="">Seleccione una opción
                                                                    </option>
                                                                    @foreach ($clienteempresa as $clienteempresa)
                                                                        <option value="{{ $clienteempresa->id }}"
                                                                            {{ old('clienteempresa') == $clienteempresa->id ? 'selected' : '' }}>
                                                                            {{ $clienteempresa->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <p>No hay pais disponibles.</p>
                                                            @endif
                                                            @if ($errors->has('clienteempresa'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('clienteempresa') }}</span>
                                                            @endif

                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="medio_pago">Medio de Pago</label>
                                                            <select name="medio_pago" id="medio_pago2"
                                                                class="form-control">
                                                                <option value="">Seleccione un medio de pago
                                                                </option>
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
                                                                    {{ old('medio_pago') == 'webpay' ? 'selected' : '' }}>
                                                                    Webpay</option>
                                                                <option value="khipu"
                                                                    {{ old('medio_pago') == 'khipu' ? 'selected' : '' }}>
                                                                    Khipu</option>
                                                                <option value="paypal"
                                                                    {{ old('medio_pago') == 'paypal' ? 'selected' : '' }}>
                                                                    PayPal</option>
                                                                <option value="mercadopago"
                                                                    {{ old('medio_pago') == 'mercadopago' ? 'selected' : '' }}>
                                                                    Mercado Pago</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="incluir_mailing" class="form-label">Incluir
                                                                mailing</label>
                                                            <select class="form-select" id="incluir_mailing2"
                                                                name="incluir_mailing">
                                                                <option value="0"
                                                                    {{ old('incluir_mailing', '0') == '0' ? 'selected' : '' }}>
                                                                    No</option>
                                                                <option value="1"
                                                                    {{ old('incluir_mailing', '0') == '1' ? 'selected' : '' }}>
                                                                    Sí</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="estado" class="form-label">Bloquear
                                                                Cuenta</label>
                                                            <select class="form-select" id="estado2"
                                                                name="estado">
                                                                <option value="0"
                                                                    {{ old('estado', '0') == '0' ? 'selected' : '' }}>
                                                                    No</option>
                                                                <option value="1"
                                                                    {{ old('estado', '0') == '1' ? 'selected' : '' }}>
                                                                    Sí</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="tab-pane fade" id="tab6" role="tabpanel"
                                    aria-labelledby="tab6-tab">
                                    <br />
                                    <div class="row">
                                        <div class="col-md-6 mb-3 d-flex flex-column justify-content-between">
                                            <label for="medio_pago" class="link">Finalidades</label>
                                            <!-- Lista de opciones de canales restringidos -->
                                            <label>Contractual Administración</label>
                                            <label>Encuesta Satisfacción</label>
                                            <label>Comunicación Comerciales</label>
                                            <label>Otras</label>
                                        </div>
                                        <div id="fechas-container2"
                                            class="col-md-6 mb-3 d-flex flex-column justify-content-between">
                                            <!-- Inputs de fecha serán agregados aquí por JavaScript -->
                                            <br />
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', (event) => {
                                                const finalidades2 = [
                                                    'Contractual Administración',
                                                    'Encuesta Satisfacción',
                                                    'Comunicación Comerciales',
                                                    'Otras'
                                                ];

                                                // Obtenemos las fechas seleccionadas previamente de la función old() y las pasamos a JavaScript
                                                const preFechaConsentimiento2 = @json(old('fechas', []));

                                                const fechasContainer2 = document.getElementById('fechas-container2');

                                                finalidades2.forEach((finalidad2, index) => {
                                                    const div2 = document.createElement('div');
                                                    div2.className = 'd-flex align-items-center mb-1';

                                                    const dateInput2 = document.createElement('input');
                                                    dateInput2.className = 'form-control fecha-input'; // Cambiado a clase 'fecha-input'
                                                    dateInput2.type = 'date';
                                                    dateInput2.name = 'fechas[]'; // Todas las fechas se guardarán en el mismo array
                                                    dateInput2.style.marginLeft = '0';

                                                    // Establecer la fecha previamente seleccionada, si existe
                                                    if (preFechaConsentimiento2[index]) {
                                                        dateInput2.value = preFechaConsentimiento2[index];
                                                    }

                                                    const today2 = new Date().toISOString().split('T')[0];
                                                    dateInput2.max = today2;

                                                    div2.appendChild(dateInput2);
                                                    fechasContainer2.appendChild(div2);
                                                });
                                            });
                                        </script>

                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 mb-3 d-flex flex-column justify-content-between">
                                            <label for="medio_pago" class="link">Canales Restringidos</label>
                                            <!-- Lista de opciones de canales restringidos -->
                                            <label>Mailing</label>
                                            <label>Email</label>
                                            <label>Teléfono</label>
                                            <label>Mensajes SMS</label>
                                            <label>WhatsApp</label>
                                            <label>Redes Sociales</label>
                                            <label>Cesión a Terceros</label>
                                        </div>
                                        <div id="checkbox-container2"
                                            class="col-md-6 mb-3 form-check d-flex flex-column justify-content-between">
                                            <!-- Checkboxes will be added here by JavaScript -->
                                            <br />
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', (event) => {
                                                const options2 = [
                                                    '¿Permite contactar vía mailing?',
                                                    '¿Permite contactar vía email?',
                                                    '¿Permite contactar vía telefono?',
                                                    '¿Permite contactar vía SMS?',
                                                    '¿Permite contactar vía WhatsApp?',
                                                    '¿Permite contactar vía redes sociales?',
                                                    '¿Permite ceder datos a terceros?'
                                                ];

                                                // Obtenemos las opciones seleccionadas previamente de la función old()
                                                const preCheckedOptions2 = @json(old('canales_restringidos', []));

                                                const checkboxContainer2 = document.getElementById('checkbox-container2');

                                                // Crear los checkboxes
                                                options2.forEach(option2 => {
                                                    const div2 = document.createElement('div');
                                                    div2.className = 'form-check';

                                                    const input2 = document.createElement('input');
                                                    input2.className = 'form-check-input tarifa-checkbox';
                                                    input2.type = 'checkbox';
                                                    input2.name = 'canales_restringidos[]';
                                                    input2.value = option2;

                                                    // Seleccionar opciones previamente seleccionadas usando old()
                                                    if (preCheckedOptions2.includes(option2)) {
                                                        input2.checked = true;
                                                    }

                                                    const label2 = document.createElement('label');
                                                    label2.className = 'form-check-label';
                                                    label2.textContent = option2;

                                                    div2.appendChild(input2);
                                                    div2.appendChild(label2);
                                                    checkboxContainer2.appendChild(div2);
                                                });
                                            });
                                        </script>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 d-flex flex-column justify-content-between">
                                            <label for="medio_pago" class="link">Consentimiento</label>
                                            <!-- Lista de opciones de canales restringidos -->
                                            <label>Consentimiento Firmado</label>
                                            <label>Documento Impreso</label>
                                            <label>Fecha Impresión Documento</label>
                                        </div>
                                        <div id="checkbox-container5"
                                            class="col-md-6 mb-3 form-check d-flex flex-column justify-content-between">
                                            <!-- Checkboxes will be added here by JavaScript -->
                                            <br />
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', (event) => {
                                                const consentimientos5 = [
                                                    '¿Ha firmado un consentimiento?',
                                                    '¿El consentimiento está impreso?'
                                                ];

                                                // Obtenemos las opciones seleccionadas previamente de la función old()
                                                const preCheckedConsentimiento5 = @json(old('consentimiento', []));

                                                const checkboxContainer5 = document.getElementById('checkbox-container5');

                                                consentimientos5.forEach(consentimiento5 => {
                                                    const div5 = document.createElement('div');
                                                    div5.className = 'form-check';

                                                    const input5 = document.createElement('input');
                                                    input5.className = 'form-check-input consentimiento-checkbox';
                                                    input5.type = 'checkbox';
                                                    input5.name = 'consentimiento[]';
                                                    input5.value = consentimiento5;

                                                    // Seleccionar opciones previamente seleccionadas usando old()
                                                    if (preCheckedConsentimiento5.includes(consentimiento5)) {
                                                        input5.checked = true;
                                                    }

                                                    const label5 = document.createElement('label');
                                                    label5.className = 'form-check-label';
                                                    label5.textContent = consentimiento5;

                                                    div5.appendChild(input5);
                                                    div5.appendChild(label5);

                                                    // Agregar input de tipo date si es necesario (para la opción de fecha de impresión)
                                                    const preFechaImpresion5 = @json(old('consentimiento_fecha'));
                                                    if (consentimiento5 === '¿El consentimiento está impreso?') {
                                                        const dateInput5 = document.createElement('input');
                                                        dateInput5.className = 'form-control';
                                                        dateInput5.type = 'date';
                                                        dateInput5.name =
                                                            'consentimiento_fecha'; // Utiliza un nombre único para el campo de fecha
                                                        dateInput5.id = 'consentimiento_fecha2';
                                                        dateInput5.style.marginTop = '5px'; // Espacio entre el checkbox y el input de fecha
                                                        dateInput5.style.marginLeft = '-30px'; // Ajusta el margen para moverlo a la izquierda

                                                        // Establece la fecha previamente seleccionada, si existe

                                                        if (preFechaImpresion5) {
                                                            dateInput5.value = preFechaImpresion5;
                                                        }

                                                        // Establece la fecha máxima como la fecha de hoy
                                                        const today5 = new Date().toISOString().split('T')[0];
                                                        dateInput5.max = today5; // Establece la fecha máxima en el input

                                                        div5.appendChild(dateInput5);
                                                    }

                                                    checkboxContainer5.appendChild(div5);
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab7" role="tabpanel"
                                    aria-labelledby="tab7-tab">
                                    <br />
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
                                <div class="tab-pane fade" id="tab4" role="tabpanel"
                                    aria-labelledby="tab4-tab">
                                    <br />
                                    <div class="mb-12">

                                    </div>

                                </div>


                                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        var oldPais2 = "{{ old('pais') }}";
                                        var oldciudad2 = "{{ old('ciudad') }}";
                                        var oldpais_carnet2 = "{{ old('pais_carnet') }}";
                                        var oldciudad_carnet2 = "{{ old('ciudad_carnet') }}";
                                        var oldpais_nacido2 = "{{ old('pais_nacido') }}";
                                        var oldciudad_nacido2 = "{{ old('ciudad_nacido') }}";
                                        var oldpais_nacidoh2 = "{{ old('pais_nacidoh') }}";
                                        var oldciudadh2 = "{{ old('ciudadh') }}";
                                        var oldpais_nacidol2 = "{{ old('pais_nacidol') }}";
                                        var oldciudadl2 = "{{ old('ciudadl') }}";
                                        if (oldPais2) {
                                            $('#pais2').val(oldPais2).trigger('change');
                                        }
                                        if (oldpais_carnet2) {
                                            $('#pais_carnet2').val(oldpais_carnet2).trigger('change');
                                        }
                                        if (oldpais_nacidoh2) {
                                            $('#pais_nacidoh2').val(oldpais_nacidoh2).trigger('change');
                                        }
                                        if (oldpais_nacidol2) {
                                            $('#pais_nacidol2').val(oldpais_nacidol2).trigger('change');
                                        }
                                        if (oldpais_nacido2) {
                                            $('#pais_nacido2').val(oldpais_nacido2).trigger('change');
                                        }
                                        $('#pais2').on('change', function() {
                                            var paisId2 = $(this).val();

                                            if (paisId2) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisId2
                                                    },
                                                    success: function(data) {
                                                        $('#ciudad2').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudad2').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected2 = (oldciudad2 == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudad2').append('<option value="' + ciudad.id +
                                                                    '" ' + selected2 + '>' + ciudad.nombre +
                                                                    '</option>');
                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudad2').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudad2').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_carnet2').on('change', function() {
                                            var paisIdCarnet2 = $(this).val();

                                            if (paisIdCarnet2) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdCarnet2
                                                    },
                                                    success: function(data) {
                                                        $('#ciudad_carnet2').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudad_carnet2').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected2 = (oldciudad_carnet2 == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudad_carnet2').append('<option value="' +
                                                                    ciudad.id +
                                                                    '" ' + selected2 + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudad_carnet2').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudad_carnet2').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_nacido2').on('change', function() {
                                            var paisIdNacido2 = $(this).val();

                                            if (paisIdNacido2) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdNacido2
                                                    },
                                                    success: function(data) {
                                                        $('#ciudad_nacido2').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudad_nacido2').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected2 = (oldciudad_nacido2 == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudad_nacido').append('<option value="' +
                                                                    ciudad.id +
                                                                    '" ' + selected2 + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudad_nacido2').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudad_nacido2').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_nacidoh2').on('change', function() {
                                            var paisIdNacidoh2 = $(this).val();

                                            if (paisIdNacidoh2) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdNacidoh2
                                                    },
                                                    success: function(data) {
                                                        $('#ciudadh2').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudadh2').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected2 = (oldciudadh2 == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudadh2').append('<option value="' + ciudad
                                                                    .id +
                                                                    '" ' + selected2 + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudadh2').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudadh2').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_nacidol2').on('change', function() {
                                            var paisIdNacidol2 = $(this).val();

                                            if (paisIdNacidol2) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdNacidol2
                                                    },
                                                    success: function(data) {
                                                        $('#ciudadl2').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudadl2').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected2 = (oldciudadl2 == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudadl2').append('<option value="' + ciudad
                                                                    .id +
                                                                    '" ' + selected2 + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudadl2').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudadl2').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                    });
                                </script>
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
        let deletedFiles = [];

        function validateNumberInput2(input) {
            // Reemplaza cualquier caracter que no sea número
            input.value = input.value.replace(/[^0-9]/g, '');

            // Limita a 10 caracteres como máximo
            if (input.value.length > 10) {
                input.value = input.value.slice(0, 10);
            }
        }

        function validateNumberInputmas4(input) {
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


        document.addEventListener('DOMContentLoaded', function() {
            var editproveedorModal = document.getElementById('editproveedorModal');

            // Crear el campo oculto para contactos eliminados
            const form = document.getElementById('editproveedorForm');
            const deletedFilesInput = document.createElement('input');
            deletedFilesInput.type = 'hidden';
            deletedFilesInput.name = 'deleted_files';
            deletedFilesInput.id = 'deletedFiles';
            deletedFilesInput.value = JSON.stringify(deletedFiles);
            form.appendChild(deletedFilesInput);



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

            function asignarFechas(fechasJson) {
                const fechasArray = JSON.parse(fechasJson); // Parsear el JSON a un array
                const inputsFechas = document.querySelectorAll(
                    '.fecha-input'); // Seleccionar todos los inputs de fechas

                inputsFechas.forEach((input, index) => {
                    if (fechasArray[index]) {
                        input.value = fechasArray[index];
                    }
                });
            }

            function asignarCheckboxes(canalesJson) {
                const canalesArray = JSON.parse(canalesJson); // Parsear el JSON a un array
                const checkboxes = document.querySelectorAll(
                    '.form-check-input'); // Seleccionar todos los checkboxes

                checkboxes.forEach((checkbox) => {
                    if (canalesArray.includes(checkbox.value)) {
                        checkbox.checked = true;
                    }
                });
            }


            // Asegúrate de que el modal exista
            if (editproveedorModal) {
                editproveedorModal.addEventListener('show.bs.modal', function(event) {
                    var form = document.getElementById('editproveedorForm');

                    // Restablece los campos de entrada
                    form.reset();

                    // Limpiar las selecciones del select
                    document.querySelectorAll('select').forEach(function(select) {
                        select.selectedIndex = 0; // Restablece al primer valor
                    });

                    // Limpia los contenedores de archivos existentes y otros elementos dinámicos
                    document.getElementById('existingFilesContainer4').innerHTML = '';
                    deletedFiles = [];
                    document.getElementById('deletedFiles').value = JSON.stringify(deletedFiles);

                    // Desmarca todos los checkboxes
                    document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                    var button = event.relatedTarget; // Botón que activó el modal
                    var id = button.getAttribute('data-id');
                    var name = button.getAttribute('data-name');
                    var cuenta_contable = button.getAttribute('data-cuenta_contable');
                    var email = button.getAttribute('data-email');
                    var tipo_documento = button.getAttribute('data-tipo_documento');
                    var numero_documento = button.getAttribute('data-numero_documento');
                    var idiomas = button.getAttribute('data-idiomas');
                    var observaciones = button.getAttribute('data-observaciones');
                    var medio_pago = button.getAttribute('data-medio_pago');
                    var avisos = button.getAttribute('data-avisos');
                    var documentos2 = button.getAttribute('data-documentos2');
                    var estado = button.getAttribute('data-estado');
                    var cliente = button.getAttribute('data-clientes');
                    var municipio = button.getAttribute('data-municipio');
                    var paisn = button.getAttribute('data-paisn');
                    var fachadoc = button.getAttribute('data-fachadoc');
                    var fachacadoc = button.getAttribute('data-fachacadoc');
                    var numero_carnet = button.getAttribute('data-numero_carnet');
                    var ciudad_carnet = button.getAttribute('data-ciudad_carnet');
                    var pais_carnet = button.getAttribute('data-pais_carnet');
                    var fachacarnet = button.getAttribute('data-fachacarnet');
                    var fachacacarnet = button.getAttribute('data-fachacacarnet');
                    var tipo_carnet = button.getAttribute('data-tipo_carnet');
                    var ciudad_nacido = button.getAttribute('data-ciudad_nacido');
                    var pais_nacido = button.getAttribute('data-pais_nacido');
                    var fachanacido = button.getAttribute('data-fachanacido');
                    var incidencias = button.getAttribute('data-incidencias');
                    var numero_contacto = button.getAttribute('data-numero_contacto');
                    var canal = button.getAttribute('data-canal');
                    var pais = button.getAttribute('data-pais');
                    var direccionh = button.getAttribute('data-direccionh');
                    var codigo_postalh = button.getAttribute('data-codigo_postalh');
                    var ciudadh = button.getAttribute('data-ciudadh');
                    var pais_nacidoh = button.getAttribute('data-pais_nacidoh');
                    var direccionl = button.getAttribute('data-direccionl');
                    var codigo_postallocal = button.getAttribute('data-codigo_postallocal');
                    var ciudadl = button.getAttribute('data-ciudadl');
                    var pais_nacidol = button.getAttribute('data-pais_nacidol');
                    var clienteempresa = button.getAttribute('data-clienteempresa');
                    var incluir_mailing = button.getAttribute('data-incluir_mailing');
                    var canalesRestringidos = button.getAttribute('data-canales_restringidos');
                    var consentimiento = button.getAttribute('data-consentimiento');
                    var consentimiento_fecha = button.getAttribute('data-consentimiento_fecha');
                    var fechas = button.getAttribute('data-fechas');
                    var apellido = button.getAttribute('data-apellido');
                    var genero = button.getAttribute('data-genero');

                    // Actualiza la acción del formulario con el ID del cliente
                    var form = document.getElementById('editproveedorForm');
                    if (form) {
                        form.action = `/proveedores/${id}`;
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
                        var selectGenero = document.getElementById('edit_genero');
                        if (selectGenero) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectGenero.options.length; i++) {
                                console.log('Value:', selectGenero.options[i].value, 'Text:',
                                    selectGenero.options[i].text);
                            }
                            selectGenero.value = genero.toString()
                                .trim();
                            if (selectGenero.value !== genero.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el tipo de documento. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "genero" no se encontró en el DOM.');
                        }
                        var selectNacionalidad = document.getElementById('paisn2');
                        if (selectNacionalidad) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectNacionalidad.options.length; i++) {
                                console.log('Value:', selectNacionalidad.options[i].value, 'Text:',
                                    selectNacionalidad.options[i].text);
                            }
                            selectNacionalidad.value = paisn.toString()
                                .trim();
                            if (selectNacionalidad.value !== paisn.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el tipo de documento. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "genero" no se encontró en el DOM.');
                        }
                        var selectCarnet = document.getElementById('tipo_carnet2');
                        if (selectCarnet) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectCarnet.options.length; i++) {
                                console.log('Value:', selectCarnet.options[i].value, 'Text:',
                                    selectCarnet.options[i].text);
                            }
                            selectCarnet.value = tipo_carnet.toString()
                                .trim();
                            if (selectCarnet.value !== tipo_carnet.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el tipo de documento. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "selectCarnet" no se encontró en el DOM.');
                        }
                        var selectEmpresa = document.getElementById('clienteempresa2');
                        if (selectEmpresa) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectEmpresa.options.length; i++) {
                                console.log('Value:', selectEmpresa.options[i].value, 'Text:',
                                    selectEmpresa.options[i].text);
                            }
                            selectEmpresa.value = clienteempresa.toString()
                                .trim();
                            if (selectEmpresa.value !== clienteempresa.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el tipo de documento. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "selectEmpresa" no se encontró en el DOM.');
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

                        var selectPaisCarnet = document.getElementById('pais_carnet2');
                        var selectCiudadCarnet = document.getElementById('ciudad_carnet2');

                        if (selectPaisCarnet && selectCiudadCarnet) {
                            // Establece el país seleccionado
                            selectPaisCarnet.value = pais_carnet.toString().trim();

                            // Verifica si el país se seleccionó correctamente
                            if (selectPaisCarnet.value !== pais_carnet.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el país. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            } else {
                                // Cargar ciudades correspondientes al país seleccionado
                                $.ajax({
                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                    type: 'GET',
                                    data: {
                                        pais_id: pais_carnet
                                    },
                                    success: function(data) {
                                        selectCiudadCarnet.innerHTML =
                                            ''; // Limpiar el selector de ciudades
                                        selectCiudadCarnet.appendChild(new Option(
                                            'Seleccione una ciudad', ''
                                        )); // Agregar opción predeterminada

                                        // Llenar el select con las ciudades correspondientes
                                        $.each(data, function(key, ciudad) {
                                            var option = new Option(ciudad.nombre,
                                                ciudad.id);
                                            selectCiudadCarnet.appendChild(option);
                                        });

                                        // Establecer la ciudad seleccionada
                                        selectCiudadCarnet.value = ciudad_carnet.toString()
                                            .trim();

                                        // Verifica si la ciudad se seleccionó correctamente
                                        if (selectCiudadCarnet.value !== ciudad_carnet
                                            .toString()
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
                        var selectPaisNacido = document.getElementById('pais_nacido2');
                        var selectCiudadNacido = document.getElementById('ciudad_nacido2');

                        if (selectPaisNacido && selectCiudadNacido) {
                            // Establece el país seleccionado
                            selectPaisNacido.value = pais_nacido.toString().trim();

                            // Verifica si el país se seleccionó correctamente
                            if (selectPaisNacido.value !== pais_nacido.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el país. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            } else {
                                // Cargar ciudades correspondientes al país seleccionado
                                $.ajax({
                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                    type: 'GET',
                                    data: {
                                        pais_id: pais_nacido
                                    },
                                    success: function(data) {
                                        selectCiudadNacido.innerHTML =
                                            ''; // Limpiar el selector de ciudades
                                        selectCiudadNacido.appendChild(new Option(
                                            'Seleccione una ciudad', ''
                                        )); // Agregar opción predeterminada

                                        // Llenar el select con las ciudades correspondientes
                                        $.each(data, function(key, ciudad) {
                                            var option = new Option(ciudad.nombre,
                                                ciudad.id);
                                            selectCiudadNacido.appendChild(option);
                                        });

                                        // Establecer la ciudad seleccionada
                                        selectCiudadNacido.value = ciudad_nacido.toString()
                                            .trim();

                                        // Verifica si la ciudad se seleccionó correctamente
                                        if (selectCiudadNacido.value !== ciudad_nacido
                                            .toString()
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
                        var selectPaisHabitual = document.getElementById('pais_nacidoh2');
                        var selectCiudadHabitual = document.getElementById('ciudadh2');

                        if (selectPaisHabitual && selectCiudadHabitual) {
                            // Establece el país seleccionado
                            selectPaisHabitual.value = pais_nacidoh.toString().trim();

                            // Verifica si el país se seleccionó correctamente
                            if (selectPaisHabitual.value !== pais_nacidoh.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el país. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            } else {
                                // Cargar ciudades correspondientes al país seleccionado
                                $.ajax({
                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                    type: 'GET',
                                    data: {
                                        pais_id: pais_nacidoh
                                    },
                                    success: function(data) {
                                        selectCiudadHabitual.innerHTML =
                                            ''; // Limpiar el selector de ciudades
                                        selectCiudadHabitual.appendChild(new Option(
                                            'Seleccione una ciudad', ''
                                        )); // Agregar opción predeterminada

                                        // Llenar el select con las ciudades correspondientes
                                        $.each(data, function(key, ciudad) {
                                            var option = new Option(ciudad.nombre,
                                                ciudad.id);
                                            selectCiudadHabitual.appendChild(option);
                                        });

                                        // Establecer la ciudad seleccionada
                                        selectCiudadHabitual.value = ciudadh.toString()
                                            .trim();

                                        // Verifica si la ciudad se seleccionó correctamente
                                        if (selectCiudadHabitual.value !== ciudadh
                                            .toString()
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
                        var selectPaisLocal = document.getElementById('pais_nacidol2');
                        var selectCiudadLocal = document.getElementById('ciudadl2');

                        if (selectPaisLocal && selectCiudadLocal) {
                            // Establece el país seleccionado
                            selectPaisLocal.value = pais_nacidol.toString().trim();

                            // Verifica si el país se seleccionó correctamente
                            if (selectPaisLocal.value !== pais_nacidol.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el país. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            } else {
                                // Cargar ciudades correspondientes al país seleccionado
                                $.ajax({
                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                    type: 'GET',
                                    data: {
                                        pais_id: pais_nacidol
                                    },
                                    success: function(data) {
                                        selectCiudadLocal.innerHTML =
                                            ''; // Limpiar el selector de ciudades
                                        selectCiudadLocal.appendChild(new Option(
                                            'Seleccione una ciudad', ''
                                        )); // Agregar opción predeterminada

                                        // Llenar el select con las ciudades correspondientes
                                        $.each(data, function(key, ciudad) {
                                            var option = new Option(ciudad.nombre,
                                                ciudad.id);
                                            selectCiudadLocal.appendChild(option);
                                        });

                                        // Establecer la ciudad seleccionada
                                        selectCiudadLocal.value = ciudadl.toString()
                                            .trim();

                                        // Verifica si la ciudad se seleccionó correctamente
                                        if (selectCiudadLocal.value !== ciudadl
                                            .toString()
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

                        document.getElementById('edit_name').value =
                            name;
                        document.getElementById('edit_apellido').value =
                            apellido;
                        document.getElementById('edit_cuenta_contable').value =
                            cuenta_contable;
                        document.getElementById('edit_email').value =
                            email;
                        document.getElementById('edit_numero_documento').value =
                            numero_documento;
                        document.getElementById('edit_numero_contacto').value =
                            numero_contacto;
                        document.getElementById('fachadoc2').value =
                            fachadoc;
                        document.getElementById('fachacadoc2').value =
                            fachacadoc;
                        document.getElementById('fachacarnet2').value =
                            fachacarnet;
                        document.getElementById('fachanacido2').value =
                            fachanacido;
                        document.getElementById('fachacacarnet2').value =
                            fachacacarnet;
                        document.getElementById('edit_numero_carnet').value =
                            numero_carnet;
                        document.getElementById('edit_direccionh').value =
                            direccionh;
                        document.getElementById('edit_codigo_postalh').value =
                            codigo_postalh;
                        document.getElementById('edit_direccionl').value =
                            direccionl;
                        document.getElementById('edit_codigo_postallocal').value =
                            codigo_postallocal;
                        document.getElementById('edit_observaciones').value =
                            observaciones;
                        document.getElementById('edit_avisos').value =
                            avisos;
                        var selectMailing = document.getElementById('incluir_mailing2');
                        if (selectMailing) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectMailing.options.length; i++) {
                                console.log('Value:', selectMailing.options[i].value, 'Text:',
                                    selectMailing.options[i].text);
                            }
                            selectMailing.value = incluir_mailing.toString()
                                .trim();
                            if (selectMailing.value !== incluir_mailing.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el tipo de documento. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "incluir_mailing" no se encontró en el DOM.');
                        }
                        var selectEstado = document.getElementById('estado2');
                        if (selectEstado) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectEstado.options.length; i++) {
                                console.log('Value:', selectEstado.options[i].value, 'Text:',
                                    selectEstado.options[i].text);
                            }
                            selectEstado.value = estado.toString()
                                .trim();
                            if (selectEstado.value !== estado.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el tipo de documento. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "incluir_mailing" no se encontró en el DOM.');
                        }
                        var selectCliente = document.getElementById('cliente2');
                        if (selectCliente) {
                            console.log('Opciones del select:');
                            for (var i = 0; i < selectCliente.options.length; i++) {
                                console.log('Value:', selectCliente.options[i].value, 'Text:',
                                    selectCliente.options[i].text);
                            }
                            selectCliente.value = cliente.toString()
                                .trim();
                            if (selectCliente.value !== cliente.toString().trim()) {
                                console.error(
                                    'No se pudo seleccionar el selectCliente. Asegúrate de que el valor coincida con una de las opciones del select.'
                                );
                            }
                        } else {
                            console.error(
                                'El elemento select con id "selectCliente" no se encontró en el DOM.');
                        }
                        if (fechas) {
                            asignarFechas(fechas);
                        }
                        if (canalesRestringidos) {
                            asignarCheckboxes(canalesRestringidos);
                        }
                        if (consentimiento) {
                            asignarCheckboxes(consentimiento);
                        }
                        document.getElementById('consentimiento_fecha2').value =
                            consentimiento_fecha;

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

                        document.getElementById('edit_estado').value =
                            estado;


                    } else {
                        console.error('Formulario no encontrado: editproveedorForm');
                    }
                });
            } else {
                console.error('Modal no encontrado: editproveedorModal');
            }
        });
    </script>
</body>

</html>
