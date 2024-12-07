<!doctype html>
<html lang="en">

<head>
    <title>Crear Rol</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="createUserGroupModal" tabindex="-1" aria-labelledby="createUserGroupModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserGroupModalLabel">Crear Rol</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('usergroups.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Ingresar Nombre" required maxlength="20" />
                                <div class="error-message text-danger" id="nameError"></div>
                            </div>

                            <div class="mb-3">
                                <label for="permissions" class="form-label">Permisos</label>
                                @php
                                    $tipospermisos = \App\Models\Permiso::all()->groupBy('modulo');
                                @endphp
                                @if (isset($tipospermisos) && $tipospermisos->isNotEmpty())
                                    @foreach ($tipospermisos as $modulo => $permisos)
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input select_all_module" type="checkbox"
                                                        id="select_all_{{ $modulo }}"
                                                        data-module="{{ $modulo }}">
                                                    <label class="form-check-label"
                                                        for="select_all_{{ $modulo }}">
                                                        Módulo {{ $modulo }}
                                                    </label>
                                                </div>
                                                <div class="arrow ms-2" data-module="{{ $modulo }}">
                                                    <i class="bi bi-chevron-down" id="chevron_{{ $modulo }}"></i>
                                                </div>
                                            </div>
                                            <div class="mt-2 hidden permissions-list" data-module="{{ $modulo }}">
                                                <div class="row g-3">
                                                    @foreach ($permisos as $permission)
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input permission-checkbox"
                                                                    type="checkbox" name="permissions[]"
                                                                    value="{{ $permission->id }}"
                                                                    data-module="{{ $modulo }}"
                                                                    id="permission_{{ $permission->id }}">
                                                                <label class="form-check-label"
                                                                    for="permission_{{ $permission->id }}">
                                                                    {{ $permission->nombre }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No hay permisos disponibles.</p>
                                @endif
                            </div>


                            <div class="text-center pt-1 mb-5 pb-1">
                                <button class="btn btn-primary btn-block fa-lg mb-3" type="submit">Guardar</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            var selectAllModuleCheckboxes = document.querySelectorAll('.select_all_module');

            selectAllModuleCheckboxes.forEach(function(moduleCheckbox) {
                moduleCheckbox.addEventListener('change', function() {
                    var module = this.dataset.module;
                    var isChecked = this.checked;
                    document.querySelectorAll(`.permission-checkbox[data-module='${module}']`)
                        .forEach(function(permissionCheckbox) {
                            permissionCheckbox.checked = isChecked;
                        });
                });
            });

            var permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

            permissionCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var module = this.dataset.module;
                    var moduleCheckbox = document.querySelector(
                        `.select_all_module[data-module='${module}']`);
                    var allChecked = Array.from(document.querySelectorAll(
                        `.permission-checkbox[data-module='${module}']`)).every(function(c) {
                        return c.checked;
                    });
                    moduleCheckbox.checked = allChecked;
                });
            });
            const arrows = document.querySelectorAll('.arrow');

            arrows.forEach((arrow) => {
                arrow.addEventListener('click', function() {
                    const module = arrow.getAttribute('data-module');
                    const permissionsList = document.querySelector(
                        `.permissions-list[data-module="${module}"]`);
                    const chevronIcon = document.getElementById(`chevron_${module}`);

                    if (permissionsList.classList.contains('hidden')) {
                        permissionsList.classList.remove('hidden');
                        chevronIcon.classList.add('bi-chevron-up');
                        chevronIcon.classList.remove('bi-chevron-down');
                    } else {
                        permissionsList.classList.add('hidden');
                        chevronIcon.classList.add('bi-chevron-down');
                        chevronIcon.classList.remove('bi-chevron-up');
                    }
                });
            });
        });
    </script>
</body>

</html>
