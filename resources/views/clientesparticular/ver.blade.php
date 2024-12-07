<!doctype html>
<html lang="en">

<head>
    <title>Cliente Particular</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Carga de JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        #existingFilesContainer5 {
            display: flex;
            /* Utiliza flexbox para alinear en fila */
            flex-wrap: wrap;
            /* Permite que los elementos se envuelvan si es necesario */
            gap: 10px;
            /* Espacio entre elementos */
            justify-content: start;
            /* Alinea los elementos al inicio */
        }

        .file-preview5 {
            flex: 1 0 auto;
            /* Ajusta el tamaño del contenedor del archivo */
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
            margin: 5px;
            /* Margen alrededor de cada elemento */
        }

        .preview5-img {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 5px;
        }

        .file-preview5 embed {
            width: 100px;
            height: 100px;
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
        <div class="modal fade" id="verparticularModal" tabindex="-1" aria-labelledby="verparticularModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verparticularModalLabel">Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="verParticularForm" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="RegistroId" />
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
                                    <a class="nav-link active" id="tab9-tab" data-toggle="tab" href="#tab9"
                                        role="tab" aria-controls="tab9" aria-selected="true">Datos Generales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab10-tab" data-toggle="tab" href="#tab10" role="tab"
                                        aria-controls="tab10" aria-selected="false">RGPD</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab11-tab" data-toggle="tab" href="#tab11" role="tab"
                                        aria-controls="tab11" aria-selected="false">Archivos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab12-tab" data-toggle="tab" href="#tab12" role="tab"
                                        aria-controls="tab12" aria-selected="false">Ojear</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab9" role="tabpanel"
                                    aria-labelledby="tab5-tab">
                                    <br />
                                    <div class="row">
                                        <!-- Campos para Tab 1 -->
                                        <div class="col-md-6 mb-3">
                                            <label for="cuenta_contable">Cuenta Contable</label>
                                            <input type="number" id="edit_cuenta_contable2" name="cuenta_contable"
                                                value="{{ old('cuenta_contable') }}" class="form-control" maxlength="20"
                                                readonly>
                                            @if ($errors->has('cuenta_contable'))
                                                <span class="text-danger">{{ $errors->first('cuenta_contable') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Nombres</label>
                                            <input type="text" id="edit_name2" name="name" maxlength="30"
                                                value="{{ old('name') }}" class="form-control" readonly>
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="apellido">Apellidos</label>
                                            <input type="text" id="edit_apellido2" name="apellido"
                                                value="{{ old('apellido') }}" class="form-control" maxlength="30"
                                                readonly>
                                            @if ($errors->has('apellido'))
                                                <span class="text-danger">{{ $errors->first('apellido') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="genero">Género</label>
                                            <select id="edit_genero2" name="genero" class="form-control" disabled>
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
                                                <select id="paisn3" name="paisn" value="{{ old('paisn') }}"
                                                    class="form-control" disabled>
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
                                                <select id="idioma3" name="idiomas"
                                                    value="{{ old('idiomas') }}"class="form-control" disabled>
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
                                                <select id="tipo_documento3" name="tipo_documento"
                                                    value="{{ old('tipo_documento') }}" class="form-control"
                                                    disabled>
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
                                            <input type="text" id="edit_numero_documento2" name="numero_documento"
                                                value="{{ old('numero_documento') }}" class="form-control"
                                                maxlength="15" oninput="validateNumberInputlet2(this)" readonly>
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
                                                <select id="pais3" name="pais" value="{{ old('pais') }}"
                                                    class="form-control" disabled>
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
                                            <select id="ciudad3" name="municipio" value="{{ old('municipio') }}"
                                                class="form-control" disabled>
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
                                            <input type="date" id="fachadoc3" name="fachadoc"
                                                class="form-control" max="{{ date('Y-m-d') }}"
                                                value="{{ old('fachadoc') }}" readonly>
                                            @if ($errors->has('fachadoc'))
                                                <span class="text-danger">{{ $errors->first('fachadoc') }}</span>
                                            @endif
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <label for="fachacadoc">Fecha Caducidad Documento</label>
                                            <input type="date" id="fachacadoc3" name="fachacadoc"
                                                value="{{ old('fachacadoc') }}" class="form-control" readonly>
                                            @if ($errors->has('fachacadoc'))
                                                <span class="text-danger">{{ $errors->first('fachacadoc') }}</span>
                                            @endif
                                        </div>

                                        <script>
                                            document.getElementById('fachadoc3').addEventListener('change', function() {
                                                var fechaDocumento = this.value;
                                                // Establece la fecha mínima de "Fecha Caducidad Documento" como la "Fecha Documento" seleccionada
                                                document.getElementById('fachacadoc3').min = fechaDocumento;
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
                                                <select id="tipo_carnet3" name="tipo_carnet"
                                                    value="{{ old('tipo_carnet') }}" class="form-control" disabled>
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
                                            <input type="text" id="edit_numero_carnet2" name="numero_carnet"
                                                value="{{ old('numero_carnet') }}" class="form-control"
                                                maxlength="15" oninput="validateNumberInputlet2(this)" readonly>
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
                                                <select id="pais_carnet3" name="pais_carnet"
                                                    value="{{ old('pais_carnet') }}" class="form-control" disabled>
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
                                            <select id="ciudad_carnet3" name="ciudad_carnet"
                                                value="{{ old('ciudad_carnet') }}" class="form-control" disabled>
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
                                            <input type="date" id="fachacarnet3" name="fachacarnet"
                                                class="form-control" max="{{ date('Y-m-d') }}"
                                                value="{{ old('fachacarnet') }}" readonly>
                                            @if ($errors->has('fachacarnet'))
                                                <span class="text-danger">{{ $errors->first('fachacarnet') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="fachacacarnet">Fecha Caducidad Carnet</label>
                                            <input type="date" id="fachacacarnet3" name="fachacacarnet"
                                                value="{{ old('fachacacarnet') }}" class="form-control" readonly>
                                            @if ($errors->has('fachacacarnet'))
                                                <span class="text-danger">{{ $errors->first('fachacacarnet') }}</span>
                                            @endif
                                        </div>

                                        <script>
                                            document.getElementById('fachacarnet3').addEventListener('change', function() {
                                                var fechaDocumento = this.value;
                                                // Establece la fecha mínima de "Fecha Caducidad Documento" como la "Fecha Documento" seleccionada
                                                document.getElementById('fachacacarnet3').min = fechaDocumento;
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
                                                <select id="pais_nacido3" name="pais_nacido"
                                                    value="{{ old('pais_nacido') }}" class="form-control" disabled>
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
                                            <select id="ciudad_nacido3" name="ciudad_nacido"
                                                value="{{ old('ciudad_nacido') }}" class="form-control" disabled>
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
                                            <input type="date" id="fachanacido3" name="fachanacido"
                                                class="form-control" max="{{ date('Y-m-d') }}"
                                                value="{{ old('fachanacido') }}" readonly>
                                            @if ($errors->has('fachanacido'))
                                                <span class="text-danger">{{ $errors->first('fachanacido') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="numero_contacto">Número de Contacto</label>
                                            <div class="input-group mb-2">
                                                <input type="text" id="edit_numero_contacto2"
                                                    name="numero_contacto" value="" class="form-control"
                                                    maxlength="15" value="{{ old('numero_contacto') }}"
                                                    oninput="validateNumberInputmas4(this)" readonly>
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
                                            <input type="email" id="edit_email2" name="email"
                                                value="{{ old('email') }}" class="form-control" readonly>
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="habitual3-tab"
                                                        data-bs-toggle="tab" data-bs-target="#habitual3"
                                                        type="button" role="tab" aria-controls="habitual3"
                                                        aria-selected="true">Dirección Habitual</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="local3-tab" data-bs-toggle="tab"
                                                        data-bs-target="#local3" type="button" role="tab"
                                                        aria-controls="local3" aria-selected="false">Dirección
                                                        Local</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="observaciones3-tab"
                                                        data-bs-toggle="tab" data-bs-target="#observaciones3"
                                                        type="button" role="tab" aria-controls="observaciones3"
                                                        aria-selected="false">Observaciones</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="avisos3-tab" data-bs-toggle="tab"
                                                        data-bs-target="#avisos3" type="button" role="tab"
                                                        aria-controls="avisos3" aria-selected="false">Avisos</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="opciones3-tab" data-bs-toggle="tab"
                                                        data-bs-target="#opciones3" type="button" role="tab"
                                                        aria-controls="opciones3"
                                                        aria-selected="false">Opciones</button>
                                                </li>


                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="habitual3" role="tabpanel"
                                                    aria-labelledby="habitual3-tab">
                                                    <br />
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="text" id="edit_direccionh2"
                                                                name="direccionh" class="form-control" maxlength="40"
                                                                value="{{ old('direccionh') }}" readonly>
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
                                                                <select id="pais_nacidoh3" name="pais_nacidoh"
                                                                    value="{{ old('pais_nacidoh') }}"
                                                                    class="form-control" disabled>
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
                                                            <select id="ciudadh3" name="ciudadh"
                                                                value="{{ old('ciudadh') }}" class="form-control"
                                                                disabled>
                                                                <option value="">Seleccione una ciudad</option>
                                                            </select>
                                                            @if ($errors->has('ciudadh'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('ciudadh') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="codigo_postalh">Código Postal</label>
                                                            <input type="number" id="edit_codigo_postalh2"
                                                                name="codigo_postalh"
                                                                value="{{ old('codigo_postalh') }}"
                                                                class="form-control" maxlength="15"
                                                                oninput="validateNumberInput(this)" readonly>
                                                            @if ($errors->has('codigo_postalh'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('codigo_postalh') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="tab-pane fade" id="local3" role="tabpanel"
                                                    aria-labelledby="local3-tab">
                                                    <br />
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="text" id="edit_direccionl2"
                                                                name="direccionl" class="form-control" maxlength="40"
                                                                value="{{ old('direccionl') }}" readonly>
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
                                                                <select id="pais_nacidol3" name="pais_nacidol"
                                                                    value="{{ old('pais_nacidol') }}"
                                                                    class="form-control" disabled>
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
                                                            <select id="ciudadl3" name="ciudadl"
                                                                value="{{ old('ciudadl') }}" class="form-control"
                                                                disabled>
                                                                <option value="">Seleccione una ciudad</option>
                                                            </select>
                                                            @if ($errors->has('ciudadl'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('ciudadl') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="codigo_postallocal">Código Postal</label>
                                                            <input type="number" id="edit_codigo_postallocal2"
                                                                name="codigo_postallocal"
                                                                value="{{ old('codigo_postallocal') }}"
                                                                class="form-control" maxlength="15"
                                                                oninput="validateNumberInput(this)" readonly>
                                                            @if ($errors->has('codigo_postallocal'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('codigo_postallocal') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="observaciones3" role="tabpanel"
                                                    aria-labelledby="observaciones3-tab">

                                                    <label for="observaciones"></label>
                                                    <textarea name="observaciones" id="edit_observaciones2" class="form-control" maxlength="255"
                                                        oninput="updateCharacterCount3(this, 'observacionesCount3')" readonly>{{ old('observaciones') }}</textarea>
                                                    <small id="observacionesCount3" class="form-text text-muted">255
                                                        caracteres restantes</small>

                                                </div>

                                                <div class="tab-pane fade" id="avisos3" role="tabpanel"
                                                    aria-labelledby="avisos3-tab">

                                                    <label for="avisos"></label>
                                                    <textarea name="avisos" id="edit_avisos2" class="form-control" maxlength="255"
                                                        oninput="updateCharacterCount3(this, 'avisosCount3')" readonly>{{ old('avisos') }}</textarea>
                                                    <small id="avisosCount3" class="form-text text-muted">255
                                                        caracteres restantes</small>

                                                </div>
                                                <script>
                                                    function updateCharacterCount3(textarea, counterId3) {
                                                        const maxLength2 = 255;
                                                        const currentLength2 = textarea.value.length;
                                                        const remaining2 = maxLength2 - currentLength2;

                                                        // Actualizar el contador de caracteres
                                                        document.getElementById(counterId3).textContent = remaining2 + ' caracteres restantes';
                                                    }
                                                </script>
                                                <div class="tab-pane fade" id="opciones3" role="tabpanel"
                                                    aria-labelledby="opciones3-tab">
                                                    <br />
                                                    <div class="row">
                                                        @php
                                                            $clienteempresa = \App\Models\ClienteEmpresa::all();
                                                        @endphp
                                                        <div class="col-md-6 mb-3">
                                                            <label for="tipo_documento">Conductor de Empresa</label>
                                                            @if (isset($clienteempresa) && $clienteempresa->isNotEmpty())
                                                                <select id="clienteempresa3" name="clienteempresa"
                                                                    value="{{ old('clienteempresa') }}"
                                                                    class="form-control" disabled>
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
                                                            <select name="medio_pago" id="medio_pago3"
                                                                class="form-control" disabled>
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
                                                            <select class="form-select" id="incluir_mailing3"
                                                                name="incluir_mailing" disabled>
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
                                                            <select class="form-select" id="estado3" name="estado"
                                                                disabled>
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
                                <div class="tab-pane fade" id="tab10" role="tabpanel"
                                    aria-labelledby="tab10-tab">
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
                                        <div id="fechas-container3"
                                            class="col-md-6 mb-3 d-flex flex-column justify-content-between">
                                            <!-- Inputs de fecha serán agregados aquí por JavaScript -->
                                            <br />
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', (event) => {
                                                const finalidades3 = [
                                                    'Contractual Administración',
                                                    'Encuesta Satisfacción',
                                                    'Comunicación Comerciales',
                                                    'Otras'
                                                ];

                                                // Obtenemos las fechas seleccionadas previamente de la función old() y las pasamos a JavaScript
                                                const preFechaConsentimiento3 = @json(old('fechas', []));

                                                const fechasContainer3 = document.getElementById('fechas-container3');

                                                finalidades3.forEach((finalidad3, index) => {
                                                    const div3 = document.createElement('div');
                                                    div3.className = 'd-flex align-items-center mb-1';

                                                    const dateInput3 = document.createElement('input');
                                                    dateInput3.className = 'form-control fecha-input2'; // Cambiado a clase 'fecha-input'
                                                    dateInput3.type = 'date';
                                                    dateInput3.name = 'fechas[]'; // Todas las fechas se guardarán en el mismo array
                                                    dateInput3.style.marginLeft = '0';
                                                    dateInput3.readOnly = true; // Hace que el campo sea de solo lectura


                                                    // Establecer la fecha previamente seleccionada, si existe
                                                    if (preFechaConsentimiento3[index]) {
                                                        dateInput3.value = preFechaConsentimiento3[index];
                                                    }

                                                    const today3 = new Date().toISOString().split('T')[0];
                                                    dateInput3.max = today3;

                                                    div3.appendChild(dateInput3);
                                                    fechasContainer3.appendChild(div3);
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
                                        <div id="checkbox-container6"
                                            class="col-md-6 mb-3 form-check d-flex flex-column justify-content-between">
                                            <!-- Checkboxes will be added here by JavaScript -->
                                            <br />
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', (event) => {
                                                const options6 = [
                                                    '¿Permite contactar vía mailing?',
                                                    '¿Permite contactar vía email?',
                                                    '¿Permite contactar vía telefono?',
                                                    '¿Permite contactar vía SMS?',
                                                    '¿Permite contactar vía WhatsApp?',
                                                    '¿Permite contactar vía redes sociales?',
                                                    '¿Permite ceder datos a terceros?'
                                                ];

                                                // Obtenemos las opciones seleccionadas previamente de la función old()
                                                const preCheckedOptions6 = @json(old('canales_restringidos', []));

                                                const checkboxContainer6 = document.getElementById('checkbox-container6');

                                                // Crear los checkboxes
                                                options6.forEach(option6 => {
                                                    const div6 = document.createElement('div');
                                                    div6.className = 'form-check';

                                                    const input6 = document.createElement('input');
                                                    input6.className = 'form-check-input tarifa-checkbox';
                                                    input6.type = 'checkbox';
                                                    input6.name = 'canales_restringidos[]';
                                                    input6.value = option6;
                                                    input6.disabled = true; // Deshabilita el checkbox para que no se pueda seleccionar


                                                    // Seleccionar opciones previamente seleccionadas usando old()
                                                    if (preCheckedOptions6.includes(option6)) {
                                                        input6.checked = true;
                                                    }

                                                    const label6 = document.createElement('label');
                                                    label6.className = 'form-check-label';
                                                    label6.textContent = option6;

                                                    div6.appendChild(input6);
                                                    div6.appendChild(label6);
                                                    checkboxContainer6.appendChild(div6);
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
                                        <div id="checkbox-container7"
                                            class="col-md-6 mb-3 form-check d-flex flex-column justify-content-between">
                                            <!-- Checkboxes will be added here by JavaScript -->
                                            <br />
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', (event) => {
                                                const consentimientos7 = [
                                                    '¿Ha firmado un consentimiento?',
                                                    '¿El consentimiento está impreso?'
                                                ];

                                                // Obtenemos las opciones seleccionadas previamente de la función old()
                                                const preCheckedConsentimiento7 = @json(old('consentimiento', []));

                                                const checkboxContainer7 = document.getElementById('checkbox-container7');

                                                consentimientos7.forEach(consentimiento7 => {
                                                    const div7 = document.createElement('div');
                                                    div7.className = 'form-check';

                                                    const input7 = document.createElement('input');
                                                    input7.className = 'form-check-input consentimiento-checkbox';
                                                    input7.type = 'checkbox';
                                                    input7.name = 'consentimiento[]';
                                                    input7.value = consentimiento7;
                                                    input7.disabled = true; // Deshabilita el checkbox para que no se pueda seleccionar
                                                    // Seleccionar opciones previamente seleccionadas usando old()
                                                    if (preCheckedConsentimiento7.includes(consentimiento7)) {
                                                        input7.checked = true;
                                                    }

                                                    const label7 = document.createElement('label');
                                                    label7.className = 'form-check-label';
                                                    label7.textContent = consentimiento7;

                                                    div7.appendChild(input7);
                                                    div7.appendChild(label7);

                                                    // Agregar input de tipo date si es necesario (para la opción de fecha de impresión)
                                                    const preFechaImpresion7 = @json(old('consentimiento_fecha'));
                                                    if (consentimiento7 === '¿El consentimiento está impreso?') {
                                                        const dateInput7 = document.createElement('input');
                                                        dateInput7.className = 'form-control';
                                                        dateInput7.type = 'date';
                                                        dateInput7.name =
                                                            'consentimiento_fecha'; // Utiliza un nombre único para el campo de fecha
                                                        dateInput7.id = 'consentimiento_fecha7';
                                                        dateInput7.style.marginTop = '5px'; // Espacio entre el checkbox y el input de fecha
                                                        dateInput7.style.marginLeft = '-30px'; // Ajusta el margen para moverlo a la izquierda
                                                        dateInput7readOnly = true;
                                                        // Establece la fecha previamente seleccionada, si existe

                                                        if (preFechaImpresion7) {
                                                            dateInput7.value = preFechaImpresion7;
                                                        }

                                                        // Establece la fecha máxima como la fecha de hoy
                                                        const today7 = new Date().toISOString().split('T')[0];
                                                        dateInput7.max = today7; // Establece la fecha máxima en el input

                                                        div7.appendChild(dateInput7);
                                                    }

                                                    checkboxContainer7.appendChild(div7);
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab11" role="tabpanel"
                                    aria-labelledby="tab11-tab">
                                    <br />
                                    <div class="row">

                                        <div id="additionalFilesContainer5"></div>
                                        <div id="existingFilesContainer5">
                                            <!-- Aquí se cargarán los archivos existentes para previsualización -->
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tab12" role="tabpanel"
                                    aria-labelledby="tab12-tab">
                                    <br />
                                    <div class="mb-12">

                                    </div>

                                </div>


                                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        var oldPais3 = "{{ old('pais') }}";
                                        var oldciudad3 = "{{ old('ciudad') }}";
                                        var oldpais_carnet3 = "{{ old('pais_carnet') }}";
                                        var oldciudad_carnet3 = "{{ old('ciudad_carnet') }}";
                                        var oldpais_nacido3 = "{{ old('pais_nacido') }}";
                                        var oldciudad_nacido3 = "{{ old('ciudad_nacido') }}";
                                        var oldpais_nacidoh3 = "{{ old('pais_nacidoh') }}";
                                        var oldciudadh3 = "{{ old('ciudadh') }}";
                                        var oldpais_nacidol3 = "{{ old('pais_nacidol') }}";
                                        var oldciudadl3 = "{{ old('ciudadl') }}";
                                        if (oldPais3) {
                                            $('#pais3').val(oldPais3).trigger('change');
                                        }
                                        if (oldpais_carnet3) {
                                            $('#pais_carnet3').val(oldpais_carnet3).trigger('change');
                                        }
                                        if (oldpais_nacidoh3) {
                                            $('#pais_nacidoh3').val(oldpais_nacidoh3).trigger('change');
                                        }
                                        if (oldpais_nacidol3) {
                                            $('#pais_nacidol3').val(oldpais_nacidol3).trigger('change');
                                        }
                                        if (oldpais_nacido3) {
                                            $('#pais_nacido3').val(oldpais_nacido3).trigger('change');
                                        }
                                        $('#pais3').on('change', function() {
                                            var paisId3 = $(this).val();

                                            if (paisId3) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisId3
                                                    },
                                                    success: function(data) {
                                                        $('#ciudad3').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudad3').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected3 = (oldciudad3 == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudad3').append('<option value="' + ciudad.id +
                                                                    '" ' + selected3 + '>' + ciudad.nombre +
                                                                    '</option>');
                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudad3').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudad3').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_carnet3').on('change', function() {
                                            var paisIdCarnet3 = $(this).val();

                                            if (paisIdCarnet3) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdCarnet3
                                                    },
                                                    success: function(data) {
                                                        $('#ciudad_carnet3').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudad_carnet3').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected3 = (oldciudad_carnet3 == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudad_carnet3').append('<option value="' +
                                                                    ciudad.id +
                                                                    '" ' + selected3 + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudad_carnet3').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudad_carnet3').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_nacido3').on('change', function() {
                                            var paisIdNacido3 = $(this).val();

                                            if (paisIdNacido3) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdNacido3
                                                    },
                                                    success: function(data) {
                                                        $('#ciudad_nacido3').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudad_nacido3').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected3 = (oldciudad_nacido3 == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudad_nacido3').append('<option value="' +
                                                                    ciudad.id +
                                                                    '" ' + selected3 + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudad_nacido3').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudad_nacido3').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_nacidoh3').on('change', function() {
                                            var paisIdNacidoh3 = $(this).val();

                                            if (paisIdNacidoh3) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdNacidoh3
                                                    },
                                                    success: function(data) {
                                                        $('#ciudadh3').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudadh3').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected3 = (oldciudadh3 == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudadh3').append('<option value="' + ciudad
                                                                    .id +
                                                                    '" ' + selected2 + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudadh3').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudadh3').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                        $('#pais_nacidol3').on('change', function() {
                                            var paisIdNacidol3 = $(this).val();

                                            if (paisIdNacidol3) {
                                                $.ajax({
                                                    url: '{{ route('getCiudadesByPais') }}', // Ruta para la solicitud AJAX
                                                    type: 'GET',
                                                    data: {
                                                        pais_id: paisIdNacidol3
                                                    },
                                                    success: function(data) {
                                                        $('#ciudadl3').empty(); // Limpiar el selector de ciudades
                                                        $('#ciudadl3').append(
                                                            '<option value="">Seleccione una ciudad</option>');

                                                        $.each(data, function(key, ciudad) {
                                                            var selected3 = (oldciudadl3 == ciudad.id) ?
                                                                'selected' :
                                                                $('#ciudadl3').append('<option value="' + ciudad
                                                                    .id +
                                                                    '" ' + selected3 + '>' + ciudad.nombre +
                                                                    '</option>');

                                                        });
                                                    }
                                                });
                                            } else {
                                                $('#ciudadl3').empty(); // Limpiar el selector si no se selecciona un país
                                                $('#ciudadl3').append('<option value="">Seleccione una ciudad</option>');
                                            }
                                        });
                                    });
                                </script>
                                <script></script>

                                <script>
                                    // Cambia entre las pestañas
                                    $('#myTab a').on('click', function(e) {
                                        e.preventDefault()
                                        $(this).tab('show')
                                    })
                                </script>



                                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

                                <script>
                                    // Cambia entre las pestañas
                                    $('#myTab a').on('click', function(e) {
                                        e.preventDefault()
                                        $(this).tab('show')
                                    })
                                </script>


                                <div class="text-center pt-1 mb-5 pb-1">

                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
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
            var verparticularModal = document.getElementById('verparticularModal');

            // Crear el campo oculto para contactos eliminados
            const form = document.getElementById('verParticularForm');





            function asignarFechas(fechasJson) {
                const fechasArray = JSON.parse(fechasJson); // Parsear el JSON a un array
                const inputsFechas = document.querySelectorAll(
                    '.fecha-input2'); // Seleccionar todos los inputs de fechas

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
            if (verparticularModal) {
                verparticularModal.addEventListener('show.bs.modal', function(event) {
                    var form = document.getElementById('verParticularForm');

                    // Restablece los campos de entrada
                    form.reset();

                    // Limpiar las selecciones del select
                    document.querySelectorAll('select').forEach(function(select) {
                        select.selectedIndex = 0; // Restablece al primer valor
                    });

                    // Limpia los contenedores de archivos existentes y otros elementos dinámicos
                    document.getElementById('existingFilesContainer5').innerHTML = '';



                    // Desmarca todos los checkboxes
                    document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                    var button = event.relatedTarget; // Botón que activó el modal
                    var id = button.getAttribute('data-id');
                    var name2 = button.getAttribute('data-name');
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
                    var form = document.getElementById('verParticularForm');
                    if (form) {
                        form.action = `/clientesparticular/${id}`;
                        var selectTipoDocumento = document.getElementById('tipo_documento3');
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
                        var selectGenero = document.getElementById('edit_genero2');
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
                        var selectNacionalidad = document.getElementById('paisn3');
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
                        var selectCarnet = document.getElementById('tipo_carnet3');
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
                        var selectEmpresa = document.getElementById('clienteempresa3');
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
                        var selectIdioma = document.getElementById('idioma3');
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
                        var selectPago = document.getElementById('medio_pago3');

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
                        var selectPais = document.getElementById('pais3');
                        var selectCiudad = document.getElementById('ciudad3');

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

                        var selectPaisCarnet = document.getElementById('pais_carnet3');
                        var selectCiudadCarnet = document.getElementById('ciudad_carnet3');

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
                        var selectPaisNacido = document.getElementById('pais_nacido3');
                        var selectCiudadNacido = document.getElementById('ciudad_nacido3');

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
                        var selectPaisHabitual = document.getElementById('pais_nacidoh3');
                        var selectCiudadHabitual = document.getElementById('ciudadh3');

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
                        var selectPaisLocal = document.getElementById('pais_nacidol3');
                        var selectCiudadLocal = document.getElementById('ciudadl3');

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

                        document.getElementById('edit_name2').value =
                            name2;
                        document.getElementById('edit_apellido2').value =
                            apellido;
                        document.getElementById('edit_cuenta_contable2').value =
                            cuenta_contable;
                        document.getElementById('edit_email2').value =
                            email;
                        document.getElementById('edit_numero_documento2').value =
                            numero_documento;
                        document.getElementById('edit_numero_contacto2').value =
                            numero_contacto;
                        document.getElementById('fachadoc3').value =
                            fachadoc;
                        document.getElementById('fachacadoc3').value =
                            fachacadoc;
                        document.getElementById('fachacarnet3').value =
                            fachacarnet;
                        document.getElementById('fachanacido3').value =
                            fachanacido;
                        document.getElementById('fachacacarnet3').value =
                            fachacacarnet;
                        document.getElementById('edit_numero_carnet2').value =
                            numero_carnet;
                        document.getElementById('edit_direccionh2').value =
                            direccionh;
                        document.getElementById('edit_codigo_postalh2').value =
                            codigo_postalh;
                        document.getElementById('edit_direccionl2').value =
                            direccionl;
                        document.getElementById('edit_codigo_postallocal2').value =
                            codigo_postallocal;
                        document.getElementById('edit_observaciones2').value =
                            observaciones;
                        document.getElementById('edit_avisos2').value =
                            avisos;
                        var selectMailing = document.getElementById('incluir_mailing3');
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
                        var selectEstado = document.getElementById('estado3');
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
                        if (fechas) {
                            asignarFechas(fechas);
                        }
                        if (canalesRestringidos) {
                            asignarCheckboxes(canalesRestringidos);
                        }
                        if (consentimiento) {
                            asignarCheckboxes(consentimiento);
                        }
                        document.getElementById('consentimiento_fecha7').value =
                            consentimiento_fecha;

                        // Verifica que el contenedor de archivos existentes existe
                        var existingFilesContainer = document.getElementById('existingFilesContainer5');
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
                        console.error('Formulario no encontrado: editParticularForm');
                    }
                });
            } else {
                console.error('Modal no encontrado: verparticularModal');
            }
        });
    </script>
</body>

</html>
