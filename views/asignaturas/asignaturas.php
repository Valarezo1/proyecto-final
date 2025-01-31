<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once('../html/head4.php'); ?>
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

            <!-- Lista de Asignaturas -->
            <div class="container-fluid pt-4 px-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAsignatura">
                    Nueva Asignatura
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Asignaturas</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre de Asignatura</th>
                            <th>Créditos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoAsignaturas">
                        <!-- Aquí se cargarán las asignaturas dinámicamente -->
                    </tbody>
                </table>
            </div>
            <!-- Fin Lista de Asignaturas -->

            <!-- Modal Nueva Asignatura -->
            <div class="modal fade" id="modalAsignatura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva Asignatura</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formNuevaAsignatura">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombreAsignatura">Nombre de Asignatura</label>
                                    <input type="text" name="nombreAsignatura" id="nombreAsignatura" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="creditos">Créditos</label>
                                    <input type="number" name="creditos" id="creditos" class="form-control hide-arrows" required>
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
            <!-- Fin Modal Nueva Asignatura -->

            <!-- Modal Edición de Asignatura -->
            <div class="modal fade" id="modalEditarAsignatura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Asignatura</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEditarAsignatura">
                            <div class="modal-body">
                                <input type="hidden" name="idAsignatura" id="idAsignatura">
                                <div class="form-group">
                                    <label for="nombreEditarAsignatura">Nombre de Asignatura</label>
                                    <input type="text" name="nombreEditarAsignatura" id="nombreEditarAsignatura" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="creditosEditar">Créditos</label>
                                    <input type="number" name="creditosEditar" id="creditosEditar" class="form-control hide-arrows" required>
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
            <!-- Fin Modal Edición de Asignatura -->

            <!-- JavaScript Libraries -->
            <?php require_once('../html/scripts4.php'); ?>
            <!-- Aquí deberías incluir el archivo "asignaturas.js" -->
            <script src="./asignaturas.js"></script>
            <script>
                $(document).ready(function() {
                    cargarAsignaturas();

                    function cargarAsignaturas() {
                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Asignaturas.controllers.php?op=todas',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response && response.length > 0) {
                                    mostrarAsignaturas(response);
                                } else {
                                    $('#cuerpoAsignaturas').html('<tr><td colspan="4">No se encontraron asignaturas.</td></tr>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al cargar las asignaturas.');
                            }
                        });
                    }

                    function mostrarAsignaturas(asignaturas) {
                        var html = '';
                        $.each(asignaturas, function(index, asignatura) {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${asignatura.nombre_asignatura}</td>
                                    <td>${asignatura.creditos}</td>
                                    <td>
                                        <button class="btn btn-primary btn-editar-asignatura" data-id="${asignatura.id_asignatura}">Editar</button>
                                        <button class="btn btn-danger btn-eliminar-asignatura" data-id="${asignatura.id_asignatura}">Eliminar</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#cuerpoAsignaturas').html(html);
                    }

                    $('#formNuevaAsignatura').submit(function(event) {
                        event.preventDefault();
                        var nombreAsignatura = $('#nombreAsignatura').val();
                        var creditos = $('#creditos').val();

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Asignaturas.controllers.php?op=insertar',
                            type: 'POST',
                            data: {
                                nombre_asignatura: nombreAsignatura,
                                creditos: creditos
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response === "ok") {
                                    $('#modalAsignatura').modal('hide');
                                    cargarAsignaturas();
                                    $('#formNuevaAsignatura')[0].reset();
                                } else {
                                    alert('Error al insertar asignatura: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoAsignaturas').on('click', '.btn-editar-asignatura', function() {
                        var idAsignatura = $(this).data('id');

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Asignaturas.controllers.php?op=detalle&id_asignatura=' + idAsignatura,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#idAsignatura').val(response.id_asignatura);
                                    $('#nombreEditarAsignatura').val(response.nombre_asignatura);
                                    $('#creditosEditar').val(response.creditos);

                                    $('#modalEditarAsignatura').modal('show');
                                } else {
                                    alert('No se pudo obtener los detalles de la asignatura.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al obtener detalles de la asignatura.');
                            }
                        });
                    });

                    $('#formEditarAsignatura').submit(function(event) {
                        event.preventDefault();

                        var idAsignatura = $('#idAsignatura').val();
                        var nombreAsignatura = $('#nombreEditarAsignatura').val();
                        var creditos = $('#creditosEditar').val();

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Asignaturas.controllers.php?op=actualizar',
                            type: 'POST',
                            data: {
                                id_asignatura: idAsignatura,
                                nombre_asignatura: nombreAsignatura,
                                creditos: creditos
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#modalEditarAsignatura').modal('hide');
                                    cargarAsignaturas();
                                    $('#formEditarAsignatura')[0].reset();
                                } else {
                                    alert('Error al actualizar asignatura: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoAsignaturas').on('click', '.btn-eliminar-asignatura', function() {
                        var idAsignatura = $(this).data('id');

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
                                    url: 'http://localhost/Proyectofinal/controllers/Asignaturas.controllers.php?op=eliminar',
                                    type: 'POST',
                                    data: {
                                        id_asignatura: idAsignatura
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response === "ok") {
                                            cargarAsignaturas();
                                            Swal.fire(
                                                '¡Eliminada!',
                                                'La asignatura ha sido eliminada.',
                                                'success'
                                            );
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                'No se pudo eliminar la asignatura.',
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
