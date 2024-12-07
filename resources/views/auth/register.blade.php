<!doctype html>
<html lang="en">

<head>
    <title>Registrarse</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/estilos2.css') }}">
    <link rel="icon" href="{{ asset('assets/logo.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/logo.jpg') }}" style="width: 555px; height: auto;"
                                            alt="logo">
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show mt-4"
                                            role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <br />
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="nombre">Nombre</label>
                                                    <input type="text" id="name" name="name"
                                                        class="form-control" placeholder="Nombre" required />
                                                    <span class="text-danger" id="nameError"></span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="apellido">Apellido</label>
                                                    <input type="text" id="apellido" name="apellido"
                                                        class="form-control" placeholder="Apellido" required />
                                                    <span class="text-danger" id="apellidoError"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="tipo_documento">Tipo de
                                                        Documento</label>
                                                    <select id="tipo_documento" name="tipo_documento"
                                                        class="form-control" required>
                                                        @foreach ($tipoDocumentos as $tipoDocumento)
                                                            <option value="{{ $tipoDocumento->id }}">
                                                                {{ $tipoDocumento->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="tipoDocumentoError"></span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="numero_documento">Número de
                                                        Documento</label>
                                                    <input type="text" id="numero_documento" name="numero_documento"
                                                        class="form-control" placeholder="Número de Documento"
                                                        required />
                                                    <span class="text-danger" id="numeroDocumentoError"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="numero_telefonico">Número
                                                        Telefónico</label>
                                                    <input type="text" id="numero_telefonico"
                                                        name="numero_telefonico" class="form-control"
                                                        placeholder="Número Telefónico" required />
                                                    <span class="text-danger" id="numeroTelefonicoError"></span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="email">Correo</label>
                                                    <input type="email" id="email" name="email"
                                                        class="form-control" placeholder="Correo Electrónico"
                                                        required />
                                                    <span class="text-danger" id="emailError"></span>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-block fs-lg mb-3"
                                                type="submit">Registrarse</button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Ya tienes cuenta?</p>
                                            <a href="{{ route('login') }}" class="btn btn-danger">Ingresar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="{{ asset('assets/script-register.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
