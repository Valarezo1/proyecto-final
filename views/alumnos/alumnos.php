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

                <!-- Lista de Alumnos -->
                <div class="container-fluid pt-4 px-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAlumno">
                        Nuevo Alumno
                    </button>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Lista de Alumnos</h6>
                    </div>
                    <table class="table table-bordered table-striped table-hover table-responsive">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoAlumnos">
                            <!-- Aquí se cargarán los alumnos dinámicamente -->
                        </tbody>
                    </table>
                </div>
                <!-- Fin Lista de Alumnos -->

                <!-- Modal Nuevo Alumno -->
                <div class="modal fade" id="modalAlumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevo Alumno</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formNuevoAlumno">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nombreAlumno">Nombre</label>
                                        <input type="text" name="nombreAlumno" id="nombreAlumno" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidoAlumno">Apellido</label>
                                        <input type="text" name="apellidoAlumno" id="apellidoAlumno" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                        <input type="text" name="fechaNacimiento" id="fechaNacimiento" class="form-control custom-flatpickr" required>
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
                <!-- Fin Modal Nuevo Alumno -->

                <!-- Modal Edición de Alumno -->
                <div class="modal fade" id="modalEditarAlumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Alumno</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formEditarAlumno">
                                <div class="modal-body">
                                    <input type="hidden" name="idAlumno" id="idAlumno">
                                    <div class="form-group">
                                        <label for="nombreEditarAlumno">Nombre</label>
                                        <input type="text" name="nombreEditarAlumno" id="nombreEditarAlumno" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidoEditarAlumno">Apellido</label>
                                        <input type="text" name="apellidoEditarAlumno" id="apellidoEditarAlumno" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaNacimientoEditar">Fecha de Nacimiento</label>
                                        <input type="text" name="fechaNacimientoEditar" id="fechaNacimientoEditar" class="form-control custom-flatpickr" required>
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
                <!-- Fin Modal Edición de Alumno -->

                <!-- JavaScript Libraries -->
                <?php require_once('../html/scripts2.php'); ?>
                <!-- Aquí deberías incluir el archivo "alumnos.js" -->
                <script src="./alumnos.js"></script>
                <script>
                    $(document).ready(function() {
                        // Inicializar Flatpickr
                        flatpickr(".custom-flatpickr", {
                            dateFormat: "Y-m-d"
                        });

                        cargarAlumnos();

                        function cargarAlumnos() {
                            $.ajax({
                                url: 'http://localhost/Proyectofinal/controllers/alumnos.controllers.php?op=todos',
                                type: 'GET',
                                dataType: 'json',
                                success: function(response) {
                                    if (response && response.length > 0) {
                                        mostrarAlumnos(response);
                                    } else {
                                        $('#cuerpoAlumnos').html('<tr><td colspan="5">No se encontraron alumnos.</td></tr>');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                    alert('Error al cargar los alumnos.');
                                }
                            });
                        }

                        function mostrarAlumnos(alumnos) {
                            var html = '';
                            $.each(alumnos, function(index, alumno) {
                                html += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${alumno.nombre}</td>
                                        <td>${alumno.apellido}</td>
                                        <td>${alumno.fecha_nacimiento}</td>
                                        <td> 
                                            <button class="btn btn-primary btn-editar-alumno" data-id="${alumno.id_alumno}">Editar</button>
                                            <button class="btn btn-danger btn-eliminar-alumno" data-id="${alumno.id_alumno}">Eliminar</button>
                                        </td>
                                    </tr>
                                `;
                            });
                            $('#cuerpoAlumnos').html(html);
                        }

                        $('#formNuevoAlumno').submit(function(event) {
        event.preventDefault();
        var nombre = $('#nombreAlumno').val();
        var apellido = $('#apellidoAlumno').val();
        var fechaNacimiento = $('#fechaNacimiento').val();

        // Verifica aquí que los valores se estén capturando correctamente
        console.log("jhasjhasjhasajhs",nombre, apellido, fechaNacimiento);

        $.ajax({
            url: 'http://localhost/Proyectofinal/controllers/alumnos.controllers.php?op=insertar',
            type: 'POST',
            data: {
                nombre: nombre,
                apellido: apellido,
                fecha_nacimiento: fechaNacimiento
            },
            dataType: 'json',
            success: function(response) {
                if (response === "ok") {
                    $('#modalAlumno').modal('hide');
                    cargarAlumnos();
                    $('#formNuevoAlumno')[0].reset();
                } else {
                    alert('Error al insertar alumno: ' + response);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Error de conexión al servidor');
            }
        });
    });

                        $('#cuerpoAlumnos').on('click', '.btn-editar-alumno', function() {
                            var idAlumno = $(this).data('id');

                            $.ajax({
                                url: 'http://localhost/Proyectofinal/controllers/alumnos.controllers.php?op=detalle&id_alumno=' + idAlumno,
                                type: 'GET',
                                dataType: 'json',
                                success: function(response) {
                                    if (response) {
                                        $('#idAlumno').val(response.id_alumno);
                                        $('#nombreEditarAlumno').val(response.nombre);
                                        $('#apellidoEditarAlumno').val(response.apellido);
                                        $('#fechaNacimientoEditar').val(response.fecha_nacimiento);

                                        $('#modalEditarAlumno').modal('show');
                                    } else {
                                        alert('No se pudo obtener los detalles del alumno.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                    alert('Error al obtener detalles del alumno.');
                                }
                            });
                        });

                        $('#formEditarAlumno').submit(function(event) {
                            event.preventDefault();
                            
                            var idAlumno = $('#idAlumno').val();
                            var nombre = $('#nombreEditarAlumno').val();
                            var apellido = $('#apellidoEditarAlumno').val();
                            var fechaNacimiento = $('#fechaNacimientoEditar').val();

                            $.ajax({
                                url: 'http://localhost/Proyectofinal/controllers/alumnos.controllers.php?op=actualizar',
                                type: 'POST',
                                data: {
                                    id_alumno: idAlumno,
                                    nombre: nombre,
                                    apellido: apellido,
                                    fecha_nacimiento: fechaNacimiento
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response) {
                                        $('#modalEditarAlumno').modal('hide');
                                        cargarAlumnos();
                                        $('#formEditarAlumno')[0].reset();
                                    } else {
                                        alert('Error al actualizar alumno: ' + response);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                    alert('Error de conexión al servidor');
                                }
                            });
                        });

                        $('#cuerpoAlumnos').on('click', '.btn-eliminar-alumno', function() {
                            var idAlumno = $(this).data('id');

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
                                        url: 'http://localhost/Proyectofinal/controllers/alumnos.controllers.php?op=eliminar',
                                        type: 'POST',
                                        data: {
                                            id_alumno: idAlumno
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response === "ok") {
                                                cargarAlumnos();
                                                Swal.fire(
                                                    '¡Eliminado!',
                                                    'El alumno ha sido eliminado.',
                                                    'success'
                                                );
                                            } else {
                                                Swal.fire(
                                                    'Error!',
                                                    'No se pudo eliminar el alumno.',
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
