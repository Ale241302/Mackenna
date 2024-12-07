<!doctype html>
<html lang="en">

<head>
    <title>Editar Rol</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .hidden-content {
            display: none;
        }

        .expand-arrow {
            cursor: pointer;
        }

        .expand-arrow i {
            transition: transform 0.3s;
        }

        .expand-arrow.collapsed i {
            transform: rotate(180deg);
        }

        .permission-group {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="modal fade" id="editUserGroupModal" tabindex="-1" aria-labelledby="editUserGroupModalLabel"
            aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserGroupModalLabel">Editar Rol</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (isset($userGroup))
                            <form id="editUserGroupForm" action="{{ route('usergroups.update', $userGroup->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="edit_name" class="form-label">Nombre</label>
                                    <input type="text" name="name" id="edit_name" class="form-control"
                                        value="{{ $userGroup->name }}" required maxlength="20" />
                                    <div class="error-message text-danger" id="editNameError"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="permissions" class="form-label">Permisos</label>
                                    @php
                                        $tipospermisos = \App\Models\Permiso::all()->groupBy('modulo');
                                    @endphp
                                    @if ($tipospermisos->isNotEmpty())
                                        @foreach ($tipospermisos as $modulo => $permisos)
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input select_all_module_edit"
                                                        type="checkbox" id="select_all_edit_{{ $modulo }}"
                                                        onclick="toggleAllPermissions(this)">
                                                    <label class="form-check-label"
                                                        for="select_all_edit_{{ $modulo }}">
                                                        Módulo {{ $modulo }}
                                                    </label>
                                                </div>
                                                <div class="expand-arrow ms-2" data-module="{{ $modulo }}">
                                                    <i class="bi bi-chevron-down"
                                                        id="chevron_edit_{{ $modulo }}"></i>
                                                </div>
                                            </div>

                                            <br />
                                            <div class="row g-3 hidden-content permission-group"
                                                data-module="{{ $modulo }}">
                                                @foreach ($permisos as $permission)
                                                    <div class="col-md-4">
                                                        <input class="form-check-input permission-checkbox-edit"
                                                            type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}"
                                                            data-module="{{ $modulo }}"
                                                            id="permission_edit_{{ $permission->id }}"
                                                            @if (isset($selectedPermissions) && in_array($permission->id, $selectedPermissions)) checked @endif>
                                                        <label class="form-check-label"
                                                            for="permission_edit_{{ $permission->id }}">
                                                            {{ $permission->nombre }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No hay permisos disponibles.</p>
                                    @endif
                                </div>

                                <div class="text-center pt-1 mb-5 pb-1">
                                    <button class="btn btn-primary btn-block" type="submit">Actualizar</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectAllCheckboxesEdit = document.querySelectorAll('.select_all_module_edit');
            var permissionCheckboxesEdit = document.querySelectorAll('.permission-checkbox-edit');

            function updateSelectAllCheckboxStateEdit(module) {
                var moduleCheckboxes = document.querySelectorAll(
                    `.permission-checkbox-edit[data-module="${module}"]`);
                var allChecked = Array.from(moduleCheckboxes).every(cb => cb.checked);
                var selectAllCheckbox = document.getElementById(`select_all_edit_${module}`);
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = allChecked;
                }
            }

            selectAllCheckboxesEdit.forEach(function(selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    var module = this.dataset.module;
                    var moduleCheckboxes = document.querySelectorAll(
                        `.permission-checkbox-edit[data-module="${module}"]`);
                    moduleCheckboxes.forEach(function(checkbox) {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                });
            });

            permissionCheckboxesEdit.forEach(function(permissionCheckbox) {
                permissionCheckbox.addEventListener('change', function() {
                    var module = this.dataset.module;
                    updateSelectAllCheckboxStateEdit(module);
                });
            });

            var editUserGroupModal = document.getElementById('editUserGroupModal');

            editUserGroupModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var name = button.getAttribute('data-name');
                var permissions = button.getAttribute('data-permissions');

                var form = document.getElementById('editUserGroupForm');
                form.action = `/usergroups/${id}`; // Update the form action
                document.getElementById('edit_name').value = name;

                var selectedPermissions = JSON.parse(permissions || '[]').map(Number);
                permissionCheckboxesEdit.forEach(function(checkbox) {
                    checkbox.checked = selectedPermissions.includes(parseInt(checkbox.value));
                });

                var modules = Array.from(new Set(Array.from(permissionCheckboxesEdit).map(cb => cb.dataset
                    .module)));
                modules.forEach(function(module) {
                    updateSelectAllCheckboxStateEdit(module);
                });
            });

            const expandArrows = document.querySelectorAll('.expand-arrow');

            expandArrows.forEach((arrow) => {
                arrow.addEventListener('click', function() {
                    const module = arrow.getAttribute('data-module');
                    const permissionGroup = document.querySelector(
                        `.permission-group[data-module="${module}"]`);
                    const chevronIcon = document.getElementById(`chevron_edit_${module}`);

                    if (permissionGroup.classList.contains('hidden-content')) {
                        permissionGroup.classList.remove('hidden-content');
                        chevronIcon.classList.add('bi-chevron-up');
                        chevronIcon.classList.remove('bi-chevron-down');
                    } else {
                        permissionGroup.classList.add('hidden-content');
                        chevronIcon.classList.add('bi-chevron-down');
                        chevronIcon.classList.remove('bi-chevron-up');
                    }
                });
            });
        });

        function toggleAllPermissions(checkbox) {
            const module = checkbox.getAttribute('id').replace('select_all_edit_', '');
            const checkboxes = document.querySelectorAll(`input.permission-checkbox-edit[data-module="${module}"]`);
            checkboxes.forEach(cb => cb.checked = checkbox.checked);
        }
    </script>
</body>

</html>
