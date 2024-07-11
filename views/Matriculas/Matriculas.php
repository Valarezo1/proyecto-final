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

            <!-- Lista de Matriculas -->
            <div class="container-fluid pt-4 px-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMatricula">
                    Nueva Matricula
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Matriculas</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Alumno</th>
                            <th>Clase</th>
                            <th>Fecha de Matricula</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoMatriculas">
                        <!-- Aquí se cargarán las matriculas dinámicamente -->
                    </tbody>
                </table>
            </div>
            <!-- Fin Lista de Matriculas -->

            <!-- Modal Nueva Matricula -->
            <div class="modal fade" id="modalMatricula" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva Matricula</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formNuevaMatricula">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="idAlumnoMatricula">Alumno</label>
                                    <select name="idAlumnoMatricula" id="idAlumnoMatricula" class="form-control" required>
                                        <!-- Aquí se cargarán dinámicamente los alumnos -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idClaseMatricula">Clase</label>
                                    <select name="idClaseMatricula" id="idClaseMatricula" class="form-control" required>
                                        <!-- Aquí se cargarán dinámicamente las clases -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fechaMatricula">Fecha de Matricula</label>
                                    <input type="text" name="fechaMatricula" id="fechaMatricula" class="form-control custom-flatpickr" required>
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
            <!-- Fin Modal Nueva Matricula -->

            <!-- Modal Edición de Matricula -->
            <div class="modal fade" id="modalEditarMatricula" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Matricula</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEditarMatricula">
                            <div class="modal-body">
                                <input type="hidden" name="idMatricula" id="idMatricula">
                                <div class="form-group">
                                    <label for="idAlumnoEditarMatricula">Alumno</label>
                                    <select name="idAlumnoEditarMatricula" id="idAlumnoEditarMatricula" class="form-control" required>
                                        <!-- Aquí se cargarán dinámicamente los alumnos -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idClaseEditarMatricula">Clase</label>
                                    <select name="idClaseEditarMatricula" id="idClaseEditarMatricula" class="form-control" required>
                                        <!-- Aquí se cargarán dinámicamente las clases -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fechaMatriculaEditar">Fecha de Matricula</label>
                                    <input type="text" name="fechaMatriculaEditar" id="fechaMatriculaEditar" class="form-control custom-flatpickr" required>
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
            <!-- Fin Modal Edición de Matricula -->

            <!-- JavaScript Libraries -->
            <?php require_once('../html/scripts2.php'); ?>
            <!-- Aquí deberías incluir el archivo "matriculas.js" -->
            <script src="./matriculas.js"></script>
            <script>
                $(document).ready(function() {
                    // Inicializar Flatpickr
                    flatpickr(".custom-flatpickr", {
                        dateFormat: "Y-m-d"
                    });

                    cargarMatriculas();

                    function cargarMatriculas() {
                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Matriculas.controllers.php?op=todos',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response && response.length > 0) {
                                    mostrarMatriculas(response);
                                } else {
                                    $('#cuerpoMatriculas').html('<tr><td colspan="5">No se encontraron matriculas.</td></tr>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al cargar las matriculas.');
                            }
                        });
                    }

                    function mostrarMatriculas(matriculas) {
                        var html = '';
                        $.each(matriculas, function(index, matricula) {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${matricula.id_alumno}</td>
                                    <td>${matricula.id_clase}</td>
                                    <td>${matricula.fecha_matricula}</td>
                                    <td> 
                                        <button class="btn btn-primary btn-editar-matricula" data-id="${matricula.id_matricula}">Editar</button>
                                        <button class="btn btn-danger btn-eliminar-matricula" data-id="${matricula.id_matricula}">Eliminar</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#cuerpoMatriculas').html(html);
                    }

                    // Cargar alumnos y clases en los select de los modales
                    cargarAlumnosSelect();
                    cargarClasesSelect();

                    function cargarAlumnosSelect() {
                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/alumnos.controllers.php?op=todos',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                var options = '';
                                $.each(response, function(index, alumno) {
                                    options += `<option value="${alumno.id_alumno}">${alumno.nombre} ${alumno.apellido}</option>`;
                                });
                                $('#idAlumnoMatricula, #idAlumnoEditarMatricula').html(options);
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al cargar los alumnos.');
                            }
                        });
                    }

                    function cargarClasesSelect() {
                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Clases.controllers.php?op=todos',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                var options = '';
                                $.each(response, function(index, clase) {
                                    options += `<option value="${clase.id_clase}">${clase.nombre_clase}</option>`;
                                });
                                $('#idClaseMatricula, #idClaseEditarMatricula').html(options);
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al cargar las clases.');
                            }
                        });
                    }

                    $('#formNuevaMatricula').submit(function(event) {
                        event.preventDefault();
                        var idAlumno = $('#idAlumnoMatricula').val();
                        var idClase = $('#idClaseMatricula').val();
                        var fechaMatricula = $('#fechaMatricula').val();

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Matriculas.controllers.php?op=insertar',
                            type: 'POST',
                            data: {
                                id_alumno: idAlumno,
                                id_clase: idClase,
                                fecha_matricula: fechaMatricula
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#modalMatricula').modal('hide');
                                    cargarMatriculas();
                                    $('#formNuevaMatricula')[0].reset();
                                } else {
                                    alert('Error al insertar matricula: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoMatriculas').on('click', '.btn-editar-matricula', function() {
                        var idMatricula = $(this).data('id');

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Matriculas.controllers.php?op=detalle&id_matricula=' + idMatricula,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#idMatricula').val(response.id_matricula);
                                    $('#idAlumnoEditarMatricula').val(response.id_alumno);
                                    $('#idClaseEditarMatricula').val(response.id_clase);
                                    $('#fechaMatriculaEditar').val(response.fecha_matricula);

                                    $('#modalEditarMatricula').modal('show');
                                } else {
                                    alert('No se pudo obtener los detalles de la matricula.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al obtener detalles de la matricula.');
                            }
                        });
                    });

                    $('#formEditarMatricula').submit(function(event) {
                        event.preventDefault();
                        
                        var idMatricula = $('#idMatricula').val();
                        var idAlumno = $('#idAlumnoEditarMatricula').val();
                        var idClase = $('#idClaseEditarMatricula').val();
                        var fechaMatricula = $('#fechaMatriculaEditar').val();

                        $.ajax({
                            url: 'http://localhost/Proyectofinal/controllers/Matriculas.controllers.php?op=actualizar',
                            type: 'POST',
                            data: {
                                id_matricula: idMatricula,
                                id_alumno: idAlumno,
                                id_clase: idClase,
                                fecha_matricula: fechaMatricula
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#modalEditarMatricula').modal('hide');
                                    cargarMatriculas();
                                    $('#formEditarMatricula')[0].reset();
                                } else {
                                    alert('Error al actualizar matricula: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoMatriculas').on('click', '.btn-eliminar-matricula', function() {
                        var idMatricula = $(this).data('id');

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
                                    url: 'http://localhost/Proyectofinal/controllers/matriculas.controllers.php?op=eliminar',
                                    type: 'POST',
                                    data: {
                                        id_matricula: idMatricula
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response === "ok") {
                                            cargarMatriculas();
                                            Swal.fire(
                                                '¡Eliminado!',
                                                'La matricula ha sido eliminada.',
                                                'success'
                                            );
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                'No se pudo eliminar la matricula.',
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
