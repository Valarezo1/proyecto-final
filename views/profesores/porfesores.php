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

            <!-- Lista de Profesores -->
            <div class="container-fluid pt-4 px-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProfesor">
                    Nuevo Profesor
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Profesores</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Especialidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoProfesores">
                        <!-- Aquí se cargarán los profesores dinámicamente -->
                    </tbody>
                </table>
            </div>
            <!-- Fin Lista de Profesores -->

            <!-- Modal Nuevo Profesor -->
            <div class="modal fade" id="modalProfesor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Profesor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formNuevoProfesor">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombreProfesor">Nombre</label>
                                    <input type="text" name="nombreProfesor" id="nombreProfesor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidoProfesor">Apellido</label>
                                    <input type="text" name="apellidoProfesor" id="apellidoProfesor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="especialidadProfesor">Especialidad</label>
                                    <input type="text" name="especialidadProfesor" id="especialidadProfesor" class="form-control" required>
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
            <!-- Fin Modal Nuevo Profesor -->

            <!-- Modal Edición de Profesor -->
            <div class="modal fade" id="modalEditarProfesor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Profesor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEditarProfesor">
                            <div class="modal-body">
                                <input type="hidden" name="idProfesor" id="idProfesor">
                                <div class="form-group">
                                    <label for="nombreEditarProfesor">Nombre</label>
                                    <input type="text" name="nombreEditarProfesor" id="nombreEditarProfesor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellidoEditarProfesor">Apellido</label>
                                    <input type="text" name="apellidoEditarProfesor" id="apellidoEditarProfesor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="especialidadEditarProfesor">Especialidad</label>
                                    <input type="text" name="especialidadEditarProfesor" id="especialidadEditarProfesor" class="form-control" required>
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
            <!-- Fin Modal Edición de Profesor -->

            <!-- JavaScript Libraries -->
            <?php require_once('../html/scripts2.php'); ?>
            <!-- Aquí deberías incluir el archivo "profesores.js" -->
            <script src="./profesores.js"></script>
            <script>
                $(document).ready(function() {
                    cargarProfesores();

                    function cargarProfesores() {
                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Profesores.controller.php?op=todos',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response && response.length > 0) {
                                    mostrarProfesores(response);
                                } else {
                                    $('#cuerpoProfesores').html('<tr><td colspan="5">No se encontraron profesores.</td></tr>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al cargar los profesores.');
                            }
                        });
                    }

                    function mostrarProfesores(profesores) {
                        var html = '';
                        $.each(profesores, function(index, profesor) {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${profesor.nombre}</td>
                                    <td>${profesor.apellido}</td>
                                    <td>${profesor.especialidad}</td>
                                    <td> 
                                        <button class="btn btn-primary btn-editar-profesor" data-id="${profesor.id_profesor}">Editar</button>
                                        <button class="btn btn-danger btn-eliminar-profesor" data-id="${profesor.id_profesor}">Eliminar</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#cuerpoProfesores').html(html);
                    }

                    $('#formNuevoProfesor').submit(function(event) {
                        event.preventDefault();
                        var nombre = $('#nombreProfesor').val();
                        var apellido = $('#apellidoProfesor').val();
                        var especialidad = $('#especialidadProfesor').val();

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/profesores.controllers.php?op=insertar',
                            type: 'POST',
                            data: {
                                nombre: nombre,
                                apellido: apellido,
                                especialidad: especialidad
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response === "ok") {
                                    $('#modalProfesor').modal('hide');
                                    cargarProfesores();
                                    $('#formNuevoProfesor')[0].reset();
                                } else {
                                    alert('Error al insertar profesor: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoProfesores').on('click', '.btn-editar-profesor', function() {
                        var idProfesor = $(this).data('id');

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/profesores.controllers.php?op=detalle&id_profesor=' + idProfesor,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#idProfesor').val(response.id_profesor);
                                    $('#nombreEditarProfesor').val(response.nombre);
                                    $('#apellidoEditarProfesor').val(response.apellido);
                                    $('#especialidadEditarProfesor').val(response.especialidad);

                                    $('#modalEditarProfesor').modal('show');
                                } else {
                                    alert('No se pudo obtener los detalles del profesor.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al obtener detalles del profesor.');
                            }
                        });
                    });

                    $('#formEditarProfesor').submit(function(event) {
                        event.preventDefault();
                        
                        var idProfesor = $('#idProfesor').val();
                        var nombre = $('#nombreEditarProfesor').val();
                        var apellido = $('#apellidoEditarProfesor').val();
                        var especialidad = $('#especialidadEditarProfesor').val();

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/profesores.controllers.php?op=actualizar',
                            type: 'POST',
                            data: {
                                id_profesor: idProfesor,
                                nombre: nombre,
                                apellido: apellido,
                                especialidad: especialidad
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#modalEditarProfesor').modal('hide');
                                    cargarProfesores();
                                    $('#formEditarProfesor')[0].reset();
                                } else {
                                    alert('Error al actualizar profesor: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoProfesores').on('click', '.btn-eliminar-profesor', function() {
                        var idProfesor = $(this).data('id');

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¡No podrás revertir esto!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminarlo!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: 'http://localhost/Proyectofinal/controllers/profesores.controllers.php?op=eliminar',
                                    type: 'POST',
                                    data: {
                                        id_profesor: idProfesor
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response === "ok") {
                                            cargarProfesores();
                                            Swal.fire(
                                                '¡Eliminado!',
                                                'El profesor ha sido eliminado.',
                                                'success'
                                            );
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                'No se pudo eliminar el profesor.',
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