<!doctype html>
<html lang="en">

<head>
    <title>Cliente Empresa</title>
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
        <div class="modal fade" id="verEmpresaModal" tabindex="-1" aria-labelledby="verEmpresaModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verEmpresaModalLabel">Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="verEmpresaForm" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="RegistroId" />
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab11-tab" data-bs-toggle="tab" href="#tab11"
                                        role="tab" aria-controls="tab11" aria-selected="true">Datos Generales</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab12-tab" data-toggle="tab" href="#tab12" role="tab"
                                        aria-controls="tab12" aria-selected="false">Datos
                                        Especificos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab13-tab" data-toggle="tab" href="#tab13" role="tab"
                                        aria-controls="tab13" aria-selected="false">Tarifas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab14-tab" data-toggle="tab" href="#tab14" role="tab"
                                        aria-controls="tab14" aria-selected="false">Incrementos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab15-tab" data-toggle="tab" href="#tab15" role="tab"
                                        aria-controls="tab15" aria-selected="false">Extras</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab11" role="tabpanel"
                                    aria-labelledby="tab11-tab">
                                    <br />
                                    <div class="row">
                                        <!-- Campos para Tab 1 -->
                                        <div class="col-md-6 mb-3">
                                            <label for="cuenta_contable">Cuenta Contable</label>
                                            <input type="text" id="edit_cuenta_contable2" name="cuenta_contable"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Nombre Comercial</label>
                                            <input type="text" id="edit_name2" name="name" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="razon_social">Razón Social</label>
                                            <input type="text" id="edit_razon_social2" name="razon_social"
                                                class="form-control" readonly>
                                        </div>
                                        @php
                                            $comerciales = \App\Models\SectorComercial::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">Sector Comercial</label>
                                            @if (isset($comerciales) && $comerciales->isNotEmpty())
                                                <select id="sector_economico3" name="sector_economico"
                                                    class="form-control" disabled>
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
                                            <input type="text" id="edit_direccion2" name="direccion"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="codigo_postal">Código Postal</label>
                                            <input type="number" id="edit_codigo_postal3" name="codigo_postal"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $pais = \App\Models\Pais::all();
                                            $ciudad = \App\Models\Ciudad::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">País</label>
                                            @if (isset($pais) && $pais->isNotEmpty())
                                                <select id="pais3" name="sector_economico" class="form-control"
                                                    disabled>
                                                    <option value="">Seleccione un sector</option>
                                                    @foreach ($pais as $pais)
                                                        <option value="{{ $pais->id }}">
                                                            {{ $pais->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay pais disponibles.</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">Municipio</label>
                                            @if (isset($ciudad) && $ciudad->isNotEmpty())
                                                <select id="ciudad3" name="sector_economico" class="form-control"
                                                    disabled>
                                                    <option value="">Seleccione un municipio</option>
                                                    @foreach ($ciudad as $ciudad)
                                                        <option value="{{ $ciudad->id }}">
                                                            {{ $ciudad->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p>No hay ciudad disponibles.</p>
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
                                                    class="form-control" disabled>
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
                                            <input type="text" id="edit_numero_documento2" name="numero_documento"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                            $paisdocumentos = \App\Models\Pais::all();
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo_documento">País del Documento</label>
                                            @if (isset($paisdocumentos) && $paisdocumentos->isNotEmpty())
                                                <select id="pais_documento3" name="pais_documento"
                                                    class="form-control" disabled>
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
                                            <input type="email" id="edit_email2" name="email"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row contact-group2">

                                        <div class="contact-group4"></div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="web">Página Web</label>
                                            <input type="text" id="web3" name="web2" class="form-control"
                                                readonly>
                                        </div>
                                        @php
                                            $sucursales = \App\Models\Sucursal::all();
                                        @endphp
                                        <div class="form-group">
                                            <label for="tipo_documento">Pertenece a la Sucursal</label>
                                            @if (isset($sucursales) && $sucursales->isNotEmpty())
                                                <select id="sucursal3" name="sucursal" class="form-control" disabled>
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
                                            <select id="edit_vehiculo_propio2" name="vehiculo_propio"
                                                class="form-control" readonly>
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
                                                <select id="idioma3" name="idiomas" class="form-control" disabled>
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
                                <div class="tab-pane fade" id="tab12" role="tabpanel"
                                    aria-labelledby="tab12-tab">
                                    <br />
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="medio_pago">Medio de Pago</label>
                                            <select name="medio_pago" id="medio_pago3" class="form-control" disabled>
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
                                            <input type="number" id="dias_credito3" name="dias_credito"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            @php
                                                $canalventas = \App\Models\Canalventa::all();
                                            @endphp
                                            <label for="canal">Canal</label>
                                            @if (isset($canalventas) && $canalventas->isNotEmpty())
                                                <select id="edit_canal2" name="canal" class="form-control"
                                                    disabled>
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
                                            <input type="number" id="edit_vent_dia2" name="vent_dia"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="observaciones3-tab"
                                                    data-bs-toggle="tab" data-bs-target="#observaciones3"
                                                    type="button" role="tab" aria-controls="observaciones"
                                                    aria-selected="true">Observaciones</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="acuerdos3-tab" data-bs-toggle="tab"
                                                    data-bs-target="#acuerdos3" type="button" role="tab"
                                                    aria-controls="acuerdos" aria-selected="false">Acuerdos</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="opcion3-tab" data-bs-toggle="tab"
                                                    data-bs-target="#opcion3" type="button" role="tab"
                                                    aria-controls="opcion" aria-selected="false">Opciones</button>
                                            </li>

                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="observaciones3"
                                                role="tabpanel" aria-labelledby="observaciones3-tab">

                                                <label for="observaciones"></label>
                                                <textarea id="edit_observaciones2" name="observaciones" class="form-control" readonly></textarea>

                                            </div>
                                            <div class="tab-pane fade" id="acuerdos3" role="tabpanel"
                                                aria-labelledby="acuerdos3-tab">

                                                <label for="acuerdos"></label>
                                                <textarea id="edit_acuerdos2" name="acuerdos" class="form-control" readonly></textarea>

                                            </div>
                                            <div class="tab-pane fade" id="opcion3" role="tabpanel"
                                                aria-labelledby="opcion3-tab">
                                                <br />
                                                <div id="checkbox-container3" class="form-check3">
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
                                                                const checkboxContainer = document.getElementById('checkbox-container3');

                                                                // Limpiar el contenedor antes de agregar nuevas opciones
                                                                checkboxContainer.innerHTML = '';

                                                                options.forEach(option => {
                                                                    const div = document.createElement('div');
                                                                    div.className = 'form-check3';

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

                                            <div id="additionalFilesContainer5"></div>
                                            <div id="existingFilesContainer5">
                                                <!-- Aquí se cargarán los archivos existentes para previsualización -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab13" role="tabpanel"
                                    aria-labelledby="tab13-tab">
                                    <br />
                                    <div id="tarifas-container3" class="mb-12">
                                        <!-- Las tarifas filtradas se cargarán aquí -->
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tab15" role="tabpanel"
                                    aria-labelledby="tab15-tab">
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
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('verEmpresaModal');

            if (modal) {
                modal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;

                    // Extrae los atributos data-* del botón
                    const tarifasSeleccionadas = JSON.parse(button.getAttribute('data-tarifas') || '[]');
                    const extrasSeleccionadas = JSON.parse(button.getAttribute('data-extras') || '[]');
                    const sucursal = button.getAttribute('data-sucursal'); // Obtener la sucursal

                    // Actualiza los campos del formulario con la información del registro
                    document.getElementById('edit_name2').value = button.getAttribute('data-name');
                    document.getElementById('edit_cuenta_contable2').value = button.getAttribute(
                        'data-cuenta_contable');
                    document.getElementById('edit_razon_social2').value = button.getAttribute(
                        'data-razon_social');
                    document.getElementById('edit_email2').value = button.getAttribute('data-email');
                    document.getElementById('edit_direccion2').value = button.getAttribute(
                        'data-direccion');
                    document.getElementById('edit_codigo_postal3').value = button.getAttribute(
                        'data-codigo_postal');
                    document.getElementById('edit_numero_documento2').value = button.getAttribute(
                        'data-numero_documento');
                    document.getElementById('web3').value = button.getAttribute('data-web');
                    document.getElementById('edit_observaciones2').value = button.getAttribute(
                        'data-observaciones');
                    document.getElementById('edit_acuerdos2').value = button.getAttribute('data-acuerdos');
                    document.getElementById('dias_credito3').value = button.getAttribute(
                        'data-dias_credito');
                    document.getElementById('edit_canal2').value = button.getAttribute('data-canal');
                    document.getElementById('edit_vent_dia2').value = button.getAttribute('data-vent_dia');
                    const documentos2 = button.getAttribute('data-documentos2');

                    // Actualiza los selects
                    setSelectValue('sector_economico3', button.getAttribute('data-sector_economico'));
                    setSelectValue('pais3', button.getAttribute('data-pais'));
                    setSelectValue('ciudad3', button.getAttribute('data-municipio'));
                    setSelectValue('tipo_documento3', button.getAttribute('data-tipo_documento'));
                    setSelectValue('pais_documento3', button.getAttribute('data-pais_documento'));
                    setSelectValue('sucursal3', sucursal); // Actualiza la sucursal
                    setSelectValue('idioma3', button.getAttribute('data-idiomas'));
                    setSelectValue('medio_pago3', button.getAttribute('data-medio_pago'));
                    setSelectValue('edit_vehiculo_propio2', button.getAttribute('data-vehiculo_propio'));
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
                                            const isChecked = tarifasSeleccionadas.includes(
                                                tarifa.id.toString()) ? 'checked' : '';
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

                                    document.getElementById('tarifas-container3').innerHTML =
                                        tarifasHtml;

                                    // Manejar el checkbox de "Seleccionar todos"
                                    var selectAllTarifaCheckbox = document.getElementById(
                                        'select_all_tarifa');
                                    if (selectAllTarifaCheckbox) {
                                        selectAllTarifaCheckbox.addEventListener('change', function() {
                                            var tarifaCheckboxes = document.querySelectorAll(
                                                '.tarifa-checkbox');
                                            tarifaCheckboxes.forEach(function(checkbox) {
                                                checkbox.checked =
                                                    selectAllTarifaCheckbox.checked;
                                            });
                                        });
                                    }
                                })
                                .catch(error => console.error('Error fetching tarifas:', error));
                        } else {
                            document.getElementById('tarifas-container3').innerHTML =
                                '<p>No hay tarifas disponibles.</p>';
                        }
                    }

                    // Cargar tarifas inicialmente al mostrar el modal
                    cargarTarifas(sucursal);

                    // Agregar evento change al select para actualizar tarifas al cambiar la sucursal
                    const selectSucursal2 = document.getElementById('sucursal3');
                    if (selectSucursal2) {
                        selectSucursal2.addEventListener('change', function() {
                            var selectedSucursalId2 = selectSucursal2.value;
                            cargarTarifas(selectedSucursalId2);
                        });
                    } else {
                        console.error('El elemento select con id "sucursal3" no se encontró en el DOM.');
                    }

                    // Helper function to set select values
                    function setSelectValue(selectId, value) {
                        const select = document.getElementById(selectId);
                        if (select) {
                            select.value = value;
                            if (select.value !== value) {
                                console.error(
                                    `No se pudo seleccionar el valor para ${selectId}. Asegúrate de que el valor coincida con una de las opciones del select.`
                                );
                            }
                        }
                    }

                    // Function to update checkboxes based on selected values
                    function updateCheckboxes(group, selectedOptions, checkboxClass) {
                        document.querySelectorAll(`.${checkboxClass}`).forEach(function(checkbox) {
                            checkbox.checked = selectedOptions.includes(checkbox.value);
                        });
                    }

                    // Función para agregar campos de contacto
                    function addContactField3(persona = '', numero = '') {
                        const contactGroup = document.querySelector('.contact-group4');

                        if (persona.trim() !== '' || numero.trim() !== '') {
                            const newContactItem = document.createElement('div');
                            newContactItem.className = 'row ';
                            newContactItem.innerHTML = `
                        <div class="col-md-6 mb-3">
                            <label for="persona_contacto">Persona de Contacto</label>
                            <input type="text" name="persona_contacto[]" class="form-control" value="${persona}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="numero_contacto">Número de Contacto</label>
                            <div class="input-group">
                                <input type="text" name="numero_contacto[]" class="form-control" value="${numero}" readonly>
                            </div>
                        </div>
                    `;
                            contactGroup.appendChild(newContactItem);
                        }
                    }
                });
            }
        });
    </script>

</body>

</html>
