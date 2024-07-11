<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once('../html/head2.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="../public/lib/calendar/lib/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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

            <!-- Lista de Calificaciones -->
            <div class="container-fluid pt-4 px-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCalificacion">
                    Nueva Calificación
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Calificaciones</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Matrícula</th>
                            <th>Nota</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoCalificaciones">
                        <!-- Aquí se cargarán las calificaciones dinámicamente -->
                    </tbody>
                </table>
            </div>
            <!-- Fin Lista de Calificaciones -->

            <!-- Modal Nueva Calificación -->
            <div class="modal fade" id="modalCalificacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva Calificación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formNuevaCalificacion">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="matriculaCalificacion">Matrícula</label>
                                    <select name="matriculaCalificacion" id="matriculaCalificacion" class="form-control" required>
                                        <!-- Opciones de matrículas se cargarán dinámicamente -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="notaCalificacion">Nota</label>
                                    <input type="number" name="notaCalificacion" id="notaCalificacion" class="form-control" min="0" max="100" required>
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
            <!-- Fin Modal Nueva Calificación -->

            <!-- Modal Edición de Calificación -->
            <div class="modal fade" id="modalEditarCalificacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Calificación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEditarCalificacion">
                            <div class="modal-body">
                                <input type="hidden" name="idCalificacion" id="idCalificacion">
                                <div class="form-group">
                                    <label for="matriculaEditarCalificacion">Matrícula</label>
                                    <select name="matriculaEditarCalificacion" id="matriculaEditarCalificacion" class="form-control" required>
                                        <!-- Opciones de matrículas se cargarán dinámicamente -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="notaEditarCalificacion">Nota</label>
                                    <input type="number" name="notaEditarCalificacion" id="notaEditarCalificacion" class="form-control" min="0" max="100" required>
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
            <!-- Fin Modal Edición de Calificación -->
        </div>
        <!-- Fin Content -->
    </div>
    <!-- Fin Container -->

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="./calificaciones.js"></script>
    <?php require_once('../html/scripts2.php'); ?>
    <script>
        $(document).ready(function() {
            cargarCalificaciones();

            function cargarCalificaciones() {
                $.ajax({
                    url: 'http://localhost/Proyectofinal/controllers/Calificaciones.controllers.php?op=todas',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.length > 0) {
                            mostrarCalificaciones(response);
                        } else {
                            $('#cuerpoCalificaciones').html('<tr><td colspan="4">No se encontraron calificaciones.</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Error al cargar las calificaciones.');
                    }
                });
            }

            function mostrarCalificaciones(calificaciones) {
                var html = '';
                $.each(calificaciones, function(index, calificacion) {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${calificacion.id_matricula}</td>
                            <td>${calificacion.nota}</td>
                            <td> 
                                <button class="btn btn-primary btn-editar-calificacion" data-id="${calificacion.id_calificacion}">Editar</button>
                                <button class="btn btn-danger btn-eliminar-calificacion" data-id="${calificacion.id_calificacion}">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#cuerpoCalificaciones').html(html);
            }

            // Lógica para cargar matrículas dinámicamente
            function cargarMatriculas() {
                $.ajax({
                    url: 'http://localhost/Proyectofinal/controllers/Matriculas.controllers.php?op=todos',
                    type: 'GET',
                    dataType: 'json',
                    success: function(matriculas) {
                        var options = '';
                        $.each(matriculas, function(index, matricula) {
                            options += `<option value="${matricula.id_matricula}">${matricula.nombre_completo}</option>`;
                        });
                        $('#matriculaCalificacion, #matriculaEditarCalificacion').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Error al cargar las matrículas.');
                    }
                });
            }

            cargarMatriculas();

            $('#formNuevaCalificacion').submit(function(event) {
                event.preventDefault();
                var idMatricula = $('#matriculaCalificacion').val();
                var nota = $('#notaCalificacion').val();

                $.ajax({
                    url: 'http://localhost/Proyectofinal/controllers/Calificaciones.controllers.php?op=insertar',
                    type: 'POST',
                    data: {
                        id_matricula: idMatricula,
                        nota: nota
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response === "ok") {
                            $('#modalCalificacion').modal('hide');
                            cargarCalificaciones();
                            $('#formNuevaCalificacion')[0].reset();
                        } else {
                            alert('Error al insertar calificación: ' + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Error de conexión al servidor');
                    }
                });
            });

            $('#cuerpoCalificaciones').on('click', '.btn-editar-calificacion', function() {
                var idCalificacion = $(this).data('id');

                $.ajax({
                    url: 'http://localhost/Proyectofinal/controllers/Calificaciones.controllers.php?op=detalle&id_calificacion=' + idCalificacion,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response) {
                            $('#idCalificacion').val(response.id_calificacion);
                            $('#matriculaEditarCalificacion').val(response.id_matricula);
                            $('#notaEditarCalificacion').val(response.nota);

                            $('#modalEditarCalificacion').modal('show');
                        } else {
                            alert('No se encontró la calificación.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Error al cargar la calificación para editar.');
                    }
                });
            });

            $('#formEditarCalificacion').submit(function(event) {
                event.preventDefault();
                var idCalificacion = $('#idCalificacion').val();
                var idMatricula = $('#matriculaEditarCalificacion').val();
                var nota = $('#notaEditarCalificacion').val();

                $.ajax({
                    url: 'http://localhost/Proyectofinal/controllers/Calificaciones.controllers.php?op=actualizar',
                    type: 'POST',
                    data: {
                        id_calificacion: idCalificacion,
                        id_matricula: idMatricula,
                        nota: nota
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response === "ok") {
                            $('#modalEditarCalificacion').modal('hide');
                            cargarCalificaciones();
                        } else {
                            alert('Error al actualizar calificación: ' + response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Error de conexión al servidor');
                    }
                });
            });

            $('#cuerpoCalificaciones').on('click', '.btn-eliminar-calificacion', function() {
                var idCalificacion = $(this).data('id');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede revertir.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Calificaciones.controllers.php?op=eliminar',
                            type: 'POST',
                            data: {
                                id_calificacion: idCalificacion
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response === "ok") {
                                    cargarCalificaciones();
                                    Swal.fire(
                                        '¡Eliminado!',
                                        'La calificación ha sido eliminada.',
                                        'success'
                                    );
                                } else {
                                    alert('Error al eliminar la calificación: ' + response);
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
    <!-- JavaScript Libraries -->
    <?php require_once('../html/scripts2.php'); ?>
</body>
</html>
