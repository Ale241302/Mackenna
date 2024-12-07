<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('assets/logo.jpg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="sidebar">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/logo.jpg') }}" style="width: 250px; height: auto;" alt="logo">
        </a>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i>Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="configLink3">
                    <i class="fas fa-store"></i> Rental
                    <i class="fas fa-chevron-down toggle-icon" id="toggleIcon3"></i>
                </a>
                <ul class="nav hidden" id="configMenu3" style="flex-direction: column;">

                    @if (in_array('14', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tarifas.index') }}">
                                <i class="fas fa-money-bill-wave"></i> Tarifas Vehiculos
                            </a>
                        </li>
                    @endif
                    @if (in_array('48', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tarifacombustible.index') }}">
                                <i class="fa-solid fa-gas-pump"></i> Combustibles
                            </a>
                        </li>
                    @endif

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="configLink2">
                    <i class="fas fa-car"></i> Vehículos
                    <i class="fas fa-chevron-down toggle-icon" id="toggleIcon2"></i>
                </a>
                <ul class="nav hidden" id="configMenu2" style="flex-direction: column;">
                    @if (in_array('41', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('registrovehiculo.index') }}">
                                <i class="fas fa-car-side"></i> Flota
                            </a>
                        </li>
                    @endif
                    @if (in_array('45', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('llavevehiculo.index') }}">
                                <i class="fa-solid fa-key"></i> Llavero Flota
                            </a>
                        </li>
                    @endif
                    @if (in_array('7', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tipovehiculo.index') }}">
                                <i class="fas fa-car-rear"></i> Grupos
                            </a>
                        </li>
                    @endif
                    @if (in_array('2', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('marcavehiculo.index') }}">
                                <i class="fas fa-car-side"></i> Marcas
                            </a>
                        </li>
                    @endif
                    @if (in_array('37', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('modelovehiculo.index') }}">
                                <i class="fas fa-car"></i> Modelos
                            </a>
                        </li>
                    @endif
                    @if (in_array('25', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('accesoriovehiculo.index') }}">
                                <i class="fa-solid fa-cart-shopping"></i>Accesorios
                            </a>
                        </li>
                    @endif
                    @if (in_array('29', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('equipamientovehiculo.index') }}">
                                <i class="fa-solid fa-toolbox"></i> Equipamentos
                            </a>
                        </li>
                    @endif
                    @if (in_array('33', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('graficovehiculo.index') }}">
                                <i class="fa-solid fa-image"></i> Graficos
                            </a>
                        </li>
                    @endif
                    @if (in_array('56', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('grupovehiculo.index') }}">
                                <i class="fas fa-car-side"></i> Tipos de Vehículos
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" id="configLink">
                    <i class="fas fa-cogs"></i> Configuración
                    <i class="fas fa-chevron-down toggle-icon" id="toggleIcon"></i>
                </a>
                <ul class="nav hidden" id="configMenu" style="flex-direction: column;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clientesparticular.index') }}">
                            <i class="fas fa-users"></i> Clientes Particulares
                        </a>
                    </li>
                    @if (in_array('60', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clientesempresa.index') }}">
                                <i class="fas fa-user-tie"></i> Clientes Empresa
                            </a>
                        </li>
                    @endif
                    @if (in_array('68', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('proveedores.index') }}">
                                <i class="fas fa-user-friends"></i> Proveedores
                            </a>
                        </li>
                    @endif
                    @if (in_array('17', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="fas fa-user-cog"></i> Usuarios
                            </a>
                        </li>
                    @endif
                    @if (in_array('10', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('usergroups.index') }}">
                                <i class="fas fa-user-tag"></i> Roles
                            </a>
                        </li>
                    @endif

                    @if (in_array('52', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('extracliente.index') }}">
                                <i class="fa-solid fa-plus"></i> Extras Clientes
                            </a>
                        </li>
                    @endif
                    @if (in_array('64', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tipocarnet.index') }}">
                                <i class="fa-solid fa-id-card"></i>Tipo Carnet
                            </a>
                        </li>
                    @endif
                    @if (in_array('72', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('canalventa.index') }}">
                                <i class="fa-solid fa-money-check"></i>Canal Venta
                            </a>
                        </li>
                    @endif

                    @if (in_array('21', $permisosUsuario))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('surcursales.index') }}">
                                <i class="fas fa-store"></i> Sucursales
                            </a>
                        </li>
                    @endif
                </ul>
            </li>

        </ul>
    </div>

    <!-- User Profile Dropdown -->
    <div class="dropdown profile-dropdown">
        @if (Auth::check())
            <button class="btn btn-outline-danger dropdown-toggle" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Editar Perfil</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar
                        Sesión</a>
                </li>
            </ul>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-danger">Ingresar</a>
        @endif
    </div>

    <div class="content">
        <div class="container mt-4">
            @yield('content') <!-- Aquí se renderizará el contenido de la sección -->
        </div>
    </div>

    @stack('modals')
    @livewireScripts
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/qrcodejs@1.0.0/dist/qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var configLink = document.getElementById('configLink');
        var configLink2 = document.getElementById('configLink2');
        var configLink3 = document.getElementById('configLink3');
        var configMenu = document.getElementById('configMenu');
        var configMenu2 = document.getElementById('configMenu2');
        var configMenu3 = document.getElementById('configMenu3');
        var toggleIcon = document.getElementById('toggleIcon');
        var toggleIcon2 = document.getElementById('toggleIcon2');
        var toggleIcon3 = document.getElementById('toggleIcon3');

        configLink.addEventListener('click', function(event) {
            event.preventDefault();
            configMenu.classList.toggle('hidden');
            toggleIcon.classList.toggle('rotate');
        });

        configLink2.addEventListener('click', function(event) {
            event.preventDefault();
            configMenu2.classList.toggle('hidden');
            toggleIcon2.classList.toggle('rotate');
        });
        configLink3.addEventListener('click', function(event) {
            event.preventDefault();
            configMenu3.classList.toggle('hidden');
            toggleIcon3.classList.toggle('rotate');
        });

        // Ensure that dropdowns are initialized
        var dropdowns = document.querySelectorAll('.dropdown-toggle');
        dropdowns.forEach(function(dropdown) {
            new bootstrap.Dropdown(dropdown);
        });
    });
</script>

@yield('scripts')

</html>
