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

        .link {
            color: blue;
            /* Color azul */
            text-decoration: underline;
            /* Subraya el texto */
            cursor: pointer;
            /* Hace que el cursor cambie a una mano, como un enlace */
        }

        #fechas-container .d-flex {
            display: flex;
            align-items: center;
            /* Alinea verticalmente el contenido centrado */
        }

        #fechas-container .form-control {
            margin: 0;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="createClientParticularModal" tabindex="-1"
            aria-labelledby="createClientParticularModalLabel" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createClientParticularModalLabel">Crear Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('clientesparticular.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="tipo_cliente" name="tipo_cliente" value="6">
                            <input type="hidden" id="estado" name="estado" value="0">
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
                                        aria-controls="tab2" aria-selected="false">RGPD</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab"
                                        aria-controls="tab3" aria-selected="false">Archivos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab"
                                        aria-controls="tab4" aria-selected="false">Ojear</a>
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
                                            <input type="number" name="cuenta_contable"
                                                value="{{ old('cuenta_contable') }}" class="form-control" maxlength="20"
                                                required>
                                            @if ($errors->has('cuenta_contable'))
                                                <span class="text-danger">{{ $errors->first('cuenta_contable') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Nombres</label>
                                            <input type="text" name="name" maxlength="30"
                                                value="{{ old('name') }}" class="form-control" required>
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="apellido">Apellidos</label>
                                            <input type="text" name="apellido" value="{{ old('apellido') }}"
                                                class="form-control" maxlength="30">
                                            @if ($errors->has('apellido'))
                                                <span class="text-danger">{{ $errors->first('apellido') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="genero">Género</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="" disabled selected>Seleccione una opción</option>
                                                <option value="Masculino"
                                                    {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino
                                                </option>
                                                <option value="Femenino"
                                                    {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino
                                                </option>
                                                <option value="Otro"
                                                    {{ old('genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
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
                                                <select id="paisn" name="paisn" value="{{ old('paisn') }}"
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
                                                <select id="idiomas" name="idiomas"
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
                                                <select id="tipo_documento" name="tipo_documento"
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
                                            <input type="text" name="numero_documento"
                                                value="{{ old('numero_documento') }}" class="form-control"
                                                maxlength="15" oninput="validateNumberInputlet(this)" required>
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
                                                <select id="pais" name="pais" value="{{ old('pais') }}"
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
                                            <select id="ciudad" name="municipio" value="{{ old('municipio') }}"
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
                                            <input type="date" id="fachadoc" name="fachadoc"
                                                class="form-control" max="{{ date('Y-m-d') }}"
                                                value="{{ old('fachadoc') }}" required>
                                            @if ($errors->has('fachadoc'))
                                                <span class="text-danger">{{ $errors->first('fachadoc') }}</span>
                                            @endif
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <label for="fachacadoc">Fecha Caducidad Documento</label>
                                            <input type="date" id="fachacadoc" name="fachacadoc"
                                                value="{{ old('fachacadoc') }}" class="form-control" required>
                                            @if ($errors->has('fachacadoc'))
                                                <span class="text-danger">{{ $errors->first('fachacadoc') }}</span>
                                            @endif
                                        </div>

                                        <script>
                                            document.getElementById('fachadoc').addEventListener('change', function() {
                                                var fechaDocumento = this.value;
                                                // Establece la fecha mínima de "Fecha Caducidad Documento" como la "Fecha Documento" seleccionada
                                                document.getElementById('fachacadoc').min = fechaDocumento;
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
                                                <select id="tipo_carnet" name="tipo_carnet"
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
                                            <input type="text" name="numero_carnet"
                                                value="{{ old('numero_carnet') }}" class="form-control"
                                                maxlength="15" oninput="validateNumberInputlet(this)" required>
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
                                                <select id="pais_carnet" name="pais_carnet"
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
                                            <select id="ciudad_carnet" name="ciudad_carnet"
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
                                            <input type="date" id="fachacarnet" name="fachacarnet"
                                                class="form-control" max="{{ date('Y-m-d') }}"
                                                value="{{ old('fachacarnet') }}" required>
                                            @if ($errors->has('fachacarnet'))
                                                <span class="text-danger">{{ $errors->first('fachacarnet') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="fachacacarnet">Fecha Caducidad Carnet</label>
                                            <input type="date" id="fachacacarnet" name="fachacacarnet"
                                                value="{{ old('fachacacarnet') }}" class="form-control" required>
                                            @if ($errors->has('fachacacarnet'))
                                                <span class="text-danger">{{ $errors->first('fachacacarnet') }}</span>
                                            @endif
                                        </div>

                                        <script>
                                            document.getElementById('fachacarnet').addEventListener('change', function() {
                                                var fechaDocumento = this.value;
                                                // Establece la fecha mínima de "Fecha Caducidad Documento" como la "Fecha Documento" seleccionada
                                                document.getElementById('fachacacarnet').min = fechaDocumento;
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
                                                <select id="pais_nacido" name="pais_nacido"
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
                                            <select id="ciudad_nacido" name="ciudad_nacido"
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
                                            <input type="date" id="fachanacido" name="fachanacido"
                                                class="form-control" max="{{ date('Y-m-d') }}"
                                                value="{{ old('fachanacido') }}" required>
                                            @if ($errors->has('fachanacido'))
                                                <span class="text-danger">{{ $errors->first('fachanacido') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="numero_contacto">Número de Contacto</label>
                                            <div class="input-group mb-2">
                                                <input type="text" name="numero_contacto" value=""
                                                    class="form-control" maxlength="15"
                                                    value="{{ old('numero_contacto') }}"
                                                    oninput="validateNumberInputmas5(this)" required>
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
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control" required>
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="habitual-tab"
                                                        data-bs-toggle="tab" data-bs-target="#habitual"
                                                        type="button" role="tab" aria-controls="habitual"
                                                        aria-selected="true">Dirección Habitual</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="local-tab" data-bs-toggle="tab"
                                                        data-bs-target="#local" type="button" role="tab"
                                                        aria-controls="local" aria-selected="false">Dirección
                                                        Local</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="observaciones-tab"
                                                        data-bs-toggle="tab" data-bs-target="#observaciones"
                                                        type="button" role="tab" aria-controls="observaciones"
                                                        aria-selected="false">Observaciones</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="avisos-tab" data-bs-toggle="tab"
                                                        data-bs-target="#avisos" type="button" role="tab"
                                                        aria-controls="avisos" aria-selected="false">Avisos</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="opciones-tab" data-bs-toggle="tab"
                                                        data-bs-target="#opciones" type="button" role="tab"
                                                        aria-controls="opciones"
                                                        aria-selected="false">Opciones</button>
                                                </li>


                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="habitual" role="tabpanel"
                                                    aria-labelledby="habitual-tab">
                                                    <br />
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="text" name="direccionh"
                                                                class="form-control" maxlength="40"
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
                                                                <select id="pais_nacidoh" name="pais_nacidoh"
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
                                                            <select id="ciudadh" name="ciudadh"
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
                                                            <input type="number" name="codigo_postalh"
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
                                                <div class="tab-pane fade" id="local" role="tabpanel"
                                                    aria-labelledby="local-tab">
                                                    <br />
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="text" name="direccionl"
                                                                class="form-control" maxlength="40"
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
                                                                <select id="pais_nacidol" name="pais_nacidol"
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
                                                            <select id="ciudadl" name="ciudadl"
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
                                                            <input type="number" name="codigo_postallocal"
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
                                                <div class="tab-pane fade" id="observaciones" role="tabpanel"
                                                    aria-labelledby="observaciones-tab">

                                                    <label for="observaciones"></label>
                                                    <textarea name="observaciones" id="observaciones" class="form-control" maxlength="255"
                                                        oninput="updateCharacterCount(this, 'observacionesCount')">{{ old('observaciones') }}</textarea>
                                                    <small id="observacionesCount" class="form-text text-muted">255
                                                        caracteres restantes</small>

                                                </div>

                                                <div class="tab-pane fade" id="avisos" role="tabpanel"
                                                    aria-labelledby="avisos-tab">

                                                    <label for="avisos"></label>
                                                    <textarea name="avisos" id="avisos" class="form-control" maxlength="255"
                                                        oninput="updateCharacterCount(this, 'avisosCount')">{{ old('avisos') }}</textarea>
                                                    <small id="avisosCount" class="form-text text-muted">255
                                                        caracteres restantes</small>

                                                </div>
                                                <script>
                                                    function updateCharacterCount(textarea, counterId) {
                                                        const maxLength = 255;
                                                        const currentLength = textarea.value.length;
                                                        const remaining = maxLength - currentLength;

                                                        // Actualizar el contador de caracteres
                                                        document.getElementById(counterId).textContent = remaining + ' caracteres restantes';
                                                    }
                                                </script>
                                                <div class="tab-pane fade" id="opciones" role="tabpanel"
                                                    aria-labelledby="opciones-tab">
                                                    <br />
                                                    <div class="row">
                                                        @php
                                                            $clienteempresa = \App\Models\ClienteEmpresa::all();
                                                        @endphp
                                                        <div class="col-md-6 mb-3">
                                                            <label for="tipo_documento">Conductor de Empresa</label>
                                                            @if (isset($clienteempresa) && $clienteempresa->isNotEmpty())
                                                                <select id="clienteempresa" name="clienteempresa"
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
                                                            <select name="medio_pago" id="medio_pago"
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
                                                            <select class="form-select" id="incluir_mailing"
                                                                name="incluir_mailing">
                                                                <option value="0"
                                                                    {{ old('incluir_mailing', '0') == '0' ? 'selected' : '' }}>
                                                                    No</option>
                                                                <option value="1"
                                                                    {{ old('incluir_mailing', '0') == '1' ? 'selected' : '' }}>
                                                                    Sí</option>
                                                            </select>
                                                        </div>


                                                    </div>


                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="tab-pane fade" id="tab2" role="tabpanel"
                                    aria-labelledby="tab2-tab">
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
                                        <div id="fechas-container"
                                            class="col-md-6 mb-3 d-flex flex-column justify-content-between">
                                            <!-- Inputs de fecha serán agregados aquí por JavaScript -->
                                            <br />
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', (event) => {
                                                // Finalidades que requieren fechas
                                                const finalidades = [
                                                    'Contractual Administración',
                                                    'Encuesta Satisfacción',
                                                    'Comunicación Comerciales',
                                                    'Otras'
                                                ];

                                                // Obtenemos las fechas seleccionadas previamente de la función old() y las pasamos a JavaScript
                                                const preFechaConsentimiento = @json(old('fechas', []));

                                                const fechasContainer = document.getElementById('fechas-container');

                                                finalidades.forEach((finalidad, index) => {
                                                    const div = document.createElement('div');
                                                    div.className =
                                                        'd-flex align-items-center mb-1'; // Utiliza Flexbox para alinear los elementos

                                                    const dateInput = document.createElement('input');
                                                    dateInput.className = 'form-control';
                                                    dateInput.type = 'date';
                                                    dateInput.name = 'fechas[]'; // Todas las fechas se guardarán en el mismo array
                                                    dateInput.style.marginLeft = '0'; // Ajusta el margen izquierdo si es necesario

                                                    // Establecer la fecha previamente seleccionada, si existe
                                                    if (preFechaConsentimiento[index]) {
                                                        dateInput.value = preFechaConsentimiento[index];
                                                    }

                                                    // Obtener la fecha de hoy en formato 'YYYY-MM-DD'
                                                    const today = new Date().toISOString().split('T')[0];
                                                    dateInput.max = today; // Establecer la fecha máxima en el input

                                                    // Añadir el input de fecha al contenedor
                                                    div.appendChild(dateInput);
                                                    fechasContainer.appendChild(div);
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
                                        <div id="checkbox-container"
                                            class="col-md-6 mb-3 form-check d-flex flex-column justify-content-between">
                                            <!-- Checkboxes will be added here by JavaScript -->
                                            <br />
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', (event) => {
                                                const options = [
                                                    '¿Permite contactar vía mailing?',
                                                    '¿Permite contactar vía email?',
                                                    '¿Permite contactar vía telefono?',
                                                    '¿Permite contactar vía SMS?',
                                                    '¿Permite contactar vía WhatsApp?',
                                                    '¿Permite contactar vía redes sociales?',
                                                    '¿Permite ceder datos a terceros?'
                                                ];

                                                // Obtenemos las opciones seleccionadas previamente de la función old()
                                                const preCheckedOptions = @json(old('canales_restringidos', []));

                                                const checkboxContainer = document.getElementById('checkbox-container');

                                                options.forEach(option => {
                                                    const div = document.createElement('div');
                                                    div.className = 'form-check';

                                                    const input = document.createElement('input');
                                                    input.className = 'form-check-input tarifa-checkbox';
                                                    input.type = 'checkbox';
                                                    input.name = 'canales_restringidos[]';
                                                    input.value = option;

                                                    // Seleccionar opciones previamente seleccionadas usando old()
                                                    if (preCheckedOptions.includes(option)) {
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
                                    <div class="row">
                                        <div class="col-md-6 mb-3 d-flex flex-column justify-content-between">
                                            <label for="medio_pago" class="link">Consentimiento</label>
                                            <!-- Lista de opciones de canales restringidos -->
                                            <label>Consentimiento Firmado</label>
                                            <label>Documento Impreso</label>
                                            <label>Fecha Impresión Documento</label>
                                        </div>
                                        <div id="checkbox-container3"
                                            class="col-md-6 mb-3 form-check d-flex flex-column justify-content-between">
                                            <!-- Checkboxes will be added here by JavaScript -->
                                            <br />
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', (event) => {
                                                const consentimientos = [
                                                    '¿Ha firmado un consentimiento?',
                                                    '¿El consentimiento está impreso?'
                                                ];

                                                // Obtenemos las opciones seleccionadas previamente de la función old()
                                                const preCheckedConsentimiento = @json(old('consentimiento', []));

                                                const checkboxContainer3 = document.getElementById('checkbox-container3');

                                                consentimientos.forEach(consentimiento => {
                                                    const div = document.createElement('div');
                                                    div.className = 'form-check';

                                                    const input = document.createElement('input');
                                                    input.className = 'form-check-input consentimiento-checkbox';
                                                    input.type = 'checkbox';
                                                    input.name = 'consentimiento[]';
                                                    input.value = consentimiento;

                                                    // Seleccionar opciones previamente seleccionadas usando old()
                                                    if (preCheckedConsentimiento.includes(consentimiento)) {
                                                        input.checked = true;
                                                    }

                                                    const label = document.createElement('label');
                                                    label.className = 'form-check-label';
                                                    label.textContent = consentimiento;

                                                    div.appendChild(input);
                                                    div.appendChild(label);

                                                    // Agregar input de tipo date si es necesario (para la opción de fecha de impresión)
                                                    if (consentimiento === '¿El consentimiento está impreso?') {
                                                        const dateInput = document.createElement('input');
                                                        dateInput.className = 'form-control';
                                                        dateInput.type = 'date';
                                                        dateInput.name =
                                                            'consentimiento_fecha'; // Utiliza un nombre único para el campo de fecha
                                                        dateInput.style.marginTop = '5px'; // Espacio entre el checkbox y el input de fecha
                                                        dateInput.style.marginLeft = '-30px'; // Ajusta el margen para moverlo a la izquierda

                                                        // Establece la fecha previamente seleccionada, si existe
                                                        const preFechaImpresion = @json(old('consentimiento_fecha'));
                                                        if (preFechaImpresion) {
                                                            dateInput.value = preFechaImpresion;
                                                        }

                                                        // Establece la fecha máxima como la fecha de hoy
                                                        const today = new Date().toISOString().split('T')[0];
                                                        dateInput.max = today; // Establece la fecha máxima en el input

                                                        div.appendChild(dateInput);
                                                    }

                                                    checkboxContainer3.appendChild(div);
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3" role="tabpanel"
                                    aria-labelledby="tab3-tab">
                                    <br />
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <br />
                                            <label for="archivo2" class="form-label">Archivos</label>
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
                                <div class="tab-pane fade" id="tab4" role="tabpanel"
                                    aria-labelledby="tab4-tab">
                                    <br />
                                    <div class="mb-12">

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
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        var oldPais = "{{ old('pais') }}";
                                        var oldciudad = "{{ old('ciudad') }}";
                                        var oldpais_carnet = "{{ old('pais_carnet') }}";
                                        var oldciudad_carnet = "{{ old('ciudad_carnet') }}";
                                        var oldpais_nacido = "{{ old('pais_nacido') }}";
                                        var oldciudad_nacido = "{{ old('ciudad_nacido') }}";
                                        var oldpais_nacidoh = "{{ old('pais_nacidoh') }}";
                                        var oldciudadh = "{{ old('ciudadh') }}";
                                        var oldpais_nacidol = "{{ old('pais_nacidol') }}";
                                        var oldciudadl = "{{ old('ciudadl') }}";
                                        if (oldPais) {
                                            $('#pais').val(oldPais).trigger('change');
                                        }
                                        if (oldpais_carnet) {
                                            $('#pais_carnet').val(oldpais_carnet).trigger('change');
                                        }
                                        if (oldpais_nacidoh) {
                                            $('#pais_nacidoh').val(oldpais_nacidoh).trigger('change');
                                        }
                                        if (oldpais_nacidol) {
                                            $('#pais_nacidol').val(oldpais_nacidol).trigger('change');
                                        }
                                        if (oldpais_nacido) {
                                            $('#pais_nacido').val(oldpais_nacido).trigger('change');
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
                                                            var selected = (oldciudad == ciudad.id) ?
                                                                'selected' :
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
                                        $('#pais_carnet').on('change', function() {
                                            var paisIdCarnet = $(this).val();

                                            if (paisIdCarnet) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdCarnet
                                                    },
                                                    success: function(data) {
                                                        $('#ciudad_carnet').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudad_carnet').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected = (oldciudad_carnet == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudad_carnet').append('<option value="' +
                                                                    ciudad.id +
                                                                    '" ' + selected + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudad_carnet').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudad_carnet').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_nacido').on('change', function() {
                                            var paisIdNacido = $(this).val();

                                            if (paisIdNacido) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdNacido
                                                    },
                                                    success: function(data) {
                                                        $('#ciudad_nacido').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudad_nacido').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected = (oldciudad_nacido == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudad_nacido').append('<option value="' +
                                                                    ciudad.id +
                                                                    '" ' + selected + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudad_nacido').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudad_nacido').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_nacidoh').on('change', function() {
                                            var paisIdNacidoh = $(this).val();

                                            if (paisIdNacidoh) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdNacidoh
                                                    },
                                                    success: function(data) {
                                                        $('#ciudadh').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudadh').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected = (oldciudadh == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudadh').append('<option value="' + ciudad.id +
                                                                    '" ' + selected + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudadh').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudadh').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_nacidol').on('change', function() {
                                            var paisIdNacidol = $(this).val();

                                            if (paisIdNacidol) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdNacidol
                                                    },
                                                    success: function(data) {
                                                        $('#ciudadl').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudadl').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected = (oldciudadl == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudadl').append('<option value="' + ciudad.id +
                                                                    '" ' + selected + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudadl').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudadl').append('<option value="">Seleccione una ciudad</option>');
                                            }
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
                                    <br />
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

        function validateNumberInputmas5(input) {
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
                var modal = new bootstrap.Modal(document.getElementById('createClientParticularModal'), {});
                modal.show();
            @endif
        });
    </script>

</body>

</html>
