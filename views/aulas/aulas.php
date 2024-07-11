<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once('../html/head3.php'); ?>
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

            <!-- Lista de Aulas -->
            <div class="container-fluid pt-4 px-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAula">
                    Nueva Aula
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Aulas</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Capacidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoAulas">
                        <!-- Aquí se cargarán las aulas dinámicamente -->
                    </tbody>
                </table>
            </div>
            <!-- Fin Lista de Aulas -->

            <!-- Modal Nueva Aula -->
            <div class="modal fade" id="modalAula" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nueva Aula</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formNuevaAula">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombreAula">Nombre</label>
                                    <input type="text" name="nombreAula" id="nombreAula" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="capacidadAula">Capacidad</label>
                                    <input type="number" name="capacidadAula" id="capacidadAula" class="form-control" required>
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
            <!-- Fin Modal Nueva Aula -->

            <!-- Modal Edición de Aula -->
            <div class="modal fade" id="modalEditarAula" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Aula</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEditarAula">
                            <div class="modal-body">
                                <input type="hidden" name="idAula" id="idAula">
                                <div class="form-group">
                                    <label for="nombreEditarAula">Nombre</label>
                                    <input type="text" name="nombreEditarAula" id="nombreEditarAula" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="capacidadEditarAula">Capacidad</label>
                                    <input type="number" name="capacidadEditarAula" id="capacidadEditarAula" class="form-control" required>
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
            <!-- Fin Modal Edición de Aula -->

            <!-- JavaScript Libraries -->
            <?php require_once('../html/scripts3.php'); ?>
            <!-- Aquí deberías incluir el archivo "aulas.js" -->
            <script src="./aulas.js"></script>
            <script>
                $(document).ready(function() {
                    cargarAulas();

                    function cargarAulas() {
                        $.ajax({
                            url: 'http://localhost/Trabajo/proyectofinal/controllers/aulas.controllers.php?op=todos',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response && response.length > 0) {
                                    mostrarAulas(response);
                                } else {
                                    $('#cuerpoAulas').html('<tr><td colspan="4">No se encontraron aulas.</td></tr>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al cargar las aulas.');
                            }
                        });
                    }

                    function mostrarAulas(aulas) {
                        var html = '';
                        $.each(aulas, function(index, aula) {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${aula.nombre_aula}</td>
                                    <td>${aula.capacidad}</td>
                                    <td> 
                                        <button class="btn btn-primary btn-editar-aula" data-id="${aula.id_aula}">Editar</button>
                                        <button class="btn btn-danger btn-eliminar-aula" data-id="${aula.id_aula}">Eliminar</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#cuerpoAulas').html(html);
                    }

                    $('#formNuevaAula').submit(function(event) {
                        event.preventDefault();
                        var nombre = $('#nombreAula').val();
                        var capacidad = $('#capacidadAula').val();

                        $.ajax({
                            url: 'http://localhost/Trabajo/proyectofinal/controllers/aulas.controllers.php?op=insertar',
                            type: 'POST',
                            data: {
                                nombre: nombre,
                                capacidad: capacidad
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response === "ok") {
                                    $('#modalAula').modal('hide');
                                    cargarAulas();
                                    $('#formNuevaAula')[0].reset();
                                } else {
                                    alert('Error al insertar aula: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoAulas').on('click', '.btn-editar-aula', function() {
                        var idAula = $(this).data('id');

                        $.ajax({
                            url: 'http://localhost/Trabajo/proyectofinal/controllers/aulas.controllers.php?op=detalle&id=' + idAula,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                if (response) {
                                    $('#idAula').val(response.id_aula);
                                    $('#nombreEditarAula').val(response.nombre_aula);
                                    $('#capacidadEditarAula').val(response.capacidad);
                                    $('#modalEditarAula').modal('show');
                                } else {
                                    alert('No se encontró el aula.');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error al obtener datos del aula.');
                            }
                        });
                    });

                    $('#formEditarAula').submit(function(event) {
                        event.preventDefault();
                        var idAula = $('#idAula').val();
                        var nombre = $('#nombreEditarAula').val();
                        var capacidad = $('#capacidadEditarAula').val();

                        $.ajax({
                            url: 'http://localhost/Trabajo/proyectofinal/controllers/aulas.controllers.php?op=actualizar',
                            type: 'POST',
                            data: {
                                id: idAula,
                                nombre: nombre,
                                capacidad: capacidad
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response === "ok") {
                                    $('#modalEditarAula').modal('hide');
                                    cargarAulas();
                                } else {
                                    alert('Error al actualizar aula: ' + response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                alert('Error de conexión al servidor');
                            }
                        });
                    });

                    $('#cuerpoAulas').on('click', '.btn-eliminar-aula', function() {
                        var idAula = $(this).data('id');

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: 'El aula será eliminada permanentemente.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: 'http://localhost/Trabajo/proyectofinal/controllers/aulas.controllers.php?op=eliminar',
                                    type: 'POST',
                                    data: {
                                        id: idAula
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response === "ok") {
                                            cargarAulas();
                                            Swal.fire(
                                                '¡Eliminado!',
                                                'El aula ha sido eliminada.',
                                                'success'
                                            );
                                        } else {
                                            alert('Error al eliminar aula: ' + response);
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
