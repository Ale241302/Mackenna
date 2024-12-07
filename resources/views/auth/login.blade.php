<!doctype html>
<html lang="en">

<head>
    <title>Mackenna</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="{{ asset('assets/logo.jpg') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/estilos2.css') }}">
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
                                    <form action="{{ route('login') }}" method="POST" id="loginForm">
                                        @csrf
                                        <br />
                                        @error('email')
                                            <div class="text-danger" style="text-align: center">¡UPS! Algo salió Mal.</div>
                                            <div class="text-danger" style="text-align: center">Estas Credenciales no
                                                coinciden con nuestros registros.
                                            </div>
                                        @enderror
                                        @error('password')
                                            <div class="text-danger" style="text-align: center">¡UPS! Algo salió Mal.</div>
                                            <div class="text-danger" style="text-align: center">Estas Credenciales no
                                                coinciden con nuestros registros.
                                            </div>
                                        @enderror
                                        <div class="form-outline mb-4">
                                            <br />
                                            <label class="form-label" for="email">Correo</label>
                                            <input type="email" id="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Correo Electronico" value="{{ old('email') }}" required />

                                            <div class="error-message text-danger" id="emailError"></div>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Contraseña</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    required />

                                                <div class="input-group-append">
                                                    <span class="input-group-text custom-toggle-password"
                                                        id="togglePassword">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="#" data-bs-toggle="modal"
                                                data-bs-target="#forgotPasswordModal">Olvidaste la Contraseña?</a>
                                        </div>
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fs-lg mb-3"
                                                type="submit">Ingresar</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">No tienes cuenta?</p>
                                            <a href="{{ route('register') }}" class="btn btn-danger">Crear Cuenta</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Recuperar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="statusMessage"></div>
                    <form id="forgotPasswordForm">
                        @csrf
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Correo</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Correo Electronico" required />
                        </div>
                        <div class="text-center pt-1 mb-5 pb-1">
                            <button class="btn btn-primary btn-block fs-lg mb-3" type="submit">Enviar enlace de
                                recuperación</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let form = event.target;
            let formData = new FormData(form);

            fetch("{{ route('password.email') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    let statusMessage = document.getElementById('statusMessage');
                    if (data.message) {
                        statusMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                    } else {
                        statusMessage.innerHTML = `<div class="alert alert-danger">${data.errors.email}</div>`;
                    }
                    form.reset();
                })
                .catch(error => {
                    let statusMessage = document.getElementById('statusMessage');
                    statusMessage.innerHTML =
                        `<div class="alert alert-danger">Ocurrió un error. Inténtalo de nuevo más tarde.</div>`;
                });
        });
    </script>

    <script src="{{ asset('assets/script.login.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
