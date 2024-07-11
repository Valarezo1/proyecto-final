<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once('../html/head2.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="../public/lib/calendar/lib/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .custom-flatpickr {
            display: flex;
            align-items: center;
        }
        .custom-flatpickr input {
            margin-right: 5px;
            flex: 1;
        }
        .hide-arrows::-webkit-outer-spin-button,
        .hide-arrows::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php require_once('../html/menu.php'); ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php require_once('../html/header.php'); ?>
            <!-- Navbar End -->

            <!-- Lista de Clases -->
            <div class="container-fluid pt-4 px-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalClase">
                    Nueva Clase
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Clases</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Asignatura</th>
                            <th>Profesor</th>
                            <th>Horario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoClases">
                        <!-- Aquí se cargarán las clases dinámicamente -->
                    </tbody>
                </table>
            </div>
            <!-- Fin Lista de Clases -->

            <!-- Modal Nueva Clase -->
            <div class="modal fade" id="modalClase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva Clase</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formNuevaClase">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="asignaturaClase">Asignatura</label>
                                    <input type="text" name="asignaturaClase" id="asignaturaClase" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="profesorClase">Profesor</label>
                                    <input type="text" name="profesorClase" id="profesorClase" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="horarioClase">Horario</label>
                                    <input type="text" name="horarioClase" id="horarioClase" class="form-control custom-flatpickr" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Fin Modal Nueva Clase -->

            <!-- Modal Edición de Clase -->
            <div class="modal fade" id="modalEditarClase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Clase</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEditarClase">
                            <div class="modal-body">
                                <input type="hidden" name="idClase" id="idClase">
                                <div class="form-group">
                                    <label for="asignaturaEditarClase">Asignatura</label>
                                    <input type="text" name="asignaturaEditarClase" id="asignaturaEditarClase" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="profesorEditarClase">Profesor</label>
                                    <input type="text" name="profesorEditarClase" id="profesorEditarClase" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="horarioEditarClase">Horario</label>
                                    <input type="text" name="horarioEditarClase" id="horarioEditarClase" class="form-control custom-flatpickr" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Fin Modal Edición de Clase -->

            <!-- JavaScript Libraries -->
            <?php require_once('../html/scripts2.php'); ?>
            <script src="./clases.js"></script>
            <script>
                $(document).ready(function() {
                    // Inicializar Flatpickr
                    flatpickr(".custom-flatpickr", {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i"
                    });

                    cargarClases();

                    function cargarClases() {
                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Clases.controllers.php?op=todos',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response && response.length > 0) {
                                    mostrarClases(response);
                                } else {
                                    $('#cuerpoClases').html('<tr><td colspan="5">No se encontraron clases.</td></tr>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al cargar las clases.');
                            }
                        });
                    }

                    function mostrarClases(clases) {
                        var html = '';
                        $.each(clases, function(index, clase) {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${clase.id_asignatura}</td>
                                    <td>${clase.id_profesor}</td>
                                    <td>${clase.horario}</td>
                                    <td>
                                        <button class="btn btn-primary btn-editar-clase" data-id="${clase.id_clase}">Editar</button>
                                        <button class="btn btn-danger btn-eliminar-clase" data-id="${clase.id_clase}">Eliminar</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#cuerpoClases').html(html);
                    }

                    $('#formNuevaClase').submit(function(event) {
                        event.preventDefault();
                        var asignatura = $('#asignaturaClase').val();
                        var profesor = $('#profesorClase').val();
                        var horario = $('#horarioClase').val();

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Clases.controllers.php?op=insertar',
                            type: 'POST',
                            data: {
                                id_asignatura: asignatura,
                                id_profesor: profesor,
                                horario: horario
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#modalClase').modal('hide');
                                    cargarClases();
                                    $('#formNuevaClase')[0].reset();
                                } else {
                                    alert('Error al insertar clase: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoClases').on('click', '.btn-editar-clase', function() {
                        var idClase = $(this).data('id');

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Clases.controllers.php?op=detalle&id_clase=' + idClase,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#idClase').val(response.id_clase);
                                    $('#asignaturaEditarClase').val(response.id_asignatura);
                                    $('#profesorEditarClase').val(response.id_profesor);
                                    $('#horarioEditarClase').val(response.horario);

                                    $('#modalEditarClase').modal('show');
                                } else {
                                    alert('No se pudo obtener los detalles de la clase.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al obtener detalles de la clase.');
                            }
                        });
                    });

                    $('#formEditarClase').submit(function(event) {
                        event.preventDefault();

                        var idClase = $('#idClase').val();
                        var asignatura = $('#asignaturaEditarClase').val();
                        var profesor = $('#profesorEditarClase').val();
                        var horario = $('#horarioEditarClase').val();

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Clases.controllers.php?op=actualizar',
                            type: 'POST',
                            data: {
                                id_clase: idClase,
                                id_asignatura: asignatura,
                                id_profesor: profesor,
                                horario: horario
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#modalEditarClase').modal('hide');
                                    cargarClases();
                                    $('#formEditarClase')[0].reset();
                                } else {
                                    alert('Error al actualizar clase: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoClases').on('click', '.btn-eliminar-clase', function() {
                        var idClase = $(this).data('id');

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¡No podrás revertir esto!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminarla!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: 'http://localhost/Proyectofinal/controllers/Clases.controllers.php?op=eliminar',
                                    type: 'POST',
                                    data: {
                                        id_clase: idClase
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response) {
                                            cargarClases();
                                            Swal.fire(
                                                '¡Eliminada!',
                                                'La clase ha sido eliminada.',
                                                'success'
                                            );
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                'No se pudo eliminar la clase.',
                                                'error'
                                            );
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(error);
                                        alert('Error de conexión al servidor');
                                    }
                                });
                            }
                        });
                    });

                });
            </script>
        </div>
    </div>
</body>
</html>