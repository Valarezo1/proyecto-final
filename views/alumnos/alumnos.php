<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
<title></title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="" name="description">

<!-- Favicon -->
<link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="../../public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../../public/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

<!-- Customized Bootstrap Stylesheet -->
<link href="../../public/css/bootstrap.min.css" rel="stylesheet">
<link href="../../public/css/select2.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="../../public/css/style.css" rel="stylesheet">



<style>
  .select2-container {
    width: 100% !important;
  }

  textarea {
    width: 100% !important;
  }
</style>    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <div class='sidebar pe-4 pb-3'>
    <nav class='navbar bg-light navbar-light'>
        <a href='../Dashboard/' class='navbar-brand mx-4 mb-3'>
            <h3 class='text-primary'><i class='fa fa-hashtag me-2'></i>PRUEBA</h3>
        </a>
        <div class='d-flex align-items-center ms-4 mb-4'>
            <div class='position-relative'>
                <img class='rounded-circle' src='img/user.jpg' alt='' style='width: 40px; height: 40px;'>
                <div class='bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1'></div>
            </div>
            <div class='ms-3'>
                <h6 class='mb-0'></h6>
                <span></span>
            </div>
        </div>
        <div class='navbar-nav w-100'>
            <a href='../views/dashboard.php/' class='nav-item nav-link'><i class='fa fa-tachometer-alt me-2'></i>Dashboard</a>

            <a href='./alumnos/alumnos.php'   class='nav-item nav-link'><i class='fa fa-th me-2' target="base" ></i>Alumnos</a>
            <a href='./asignaturas/asiganturas.php'  class='nav-item nav-link' target="base" ><i class='fa fa-th me-2'></i>Profesores</a>
            <a href='./aulas/aulas.php' class='nav-item nav-link' target="base" ><i class='fa fa-th me-2'></i>Asignaturas</a>
            <a href='./calificaciones/calificaciones.php' class='nav-item nav-link' target="base" ><i class='fa fa-th me-2'></i>Clases</a>
            <a href='./clases/clases.php'  class='nav-item nav-link' target="base" ><i class='fa fa-th me-2'></i>Matriculas</a>
            <a href='./matriculas/matriculas.php'  class='nav-item nav-link' target="base" ><i class='fa fa-th me-2'></i>Calificaciones</a>
            <a href='./profesores/profesores.php'  class='nav-item nav-link' target="base" ><i class='fa fa-th me-2'></i>Aulas</a>

        </div>
    </nav>
</div>        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <form class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Search">
    </form>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-envelope me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Message</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="../../public/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                            <small>15 minutes ago</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                            <small>15 minutes ago</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                            <small>15 minutes ago</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all message</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notificatin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Profile updated</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">New user added</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Password changed</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex"></span>
                <small class="text-muted"></small>

            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                <a href="./html/salir.php" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>            <!-- Navbar End -->

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
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../public/lib/chart/chart.min.js"></script>
<script src="../../public/lib/easing/easing.min.js"></script>
<script src="../../public/lib/waypoints/waypoints.min.js"></script>
<script src="../../public/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../../public/lib/tempusdominus/js/moment.min.js"></script>
<script src="../../public/lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="../../public/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Template Javascript -->
<script src="../../public/js/main.js"></script>
<script src="../../public/js/select2.js"></script>
<!-- DataTables 
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
-->

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<!-- Botones de DataTables -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<!-- JSZip (necesario para los botones Excel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- Botones HTML5 de DataTables (Copy, Excel, CSV) -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>


<script src="../../public/lib/cryptojs/crypto-js.min.js"></script>
<script>
    window.dtoCambioCuenta = "1234567";
    $(document).ready(() => {
        var target = '';
        var path = window.location.pathname.split("/").pop();
        // Account for home page with empty path
        const myArray = path.split(".");
        let word = myArray[0];
        if (path == '') {
            target = $('nav div a[href="../alumnos/"]');
        } else {
            target = $('nav div a[href="../' + word + '/' + path + '"]');
        }
        target.addClass('active');
    });
</script>            <!-- Aquí deberías incluir el archivo "profesores.js" -->
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
    console.log('Respuesta del servidor:', response);
    if (response && response.length > 0) {
        mostrarProfesores(response);
    } else {
        $('#cuerpoProfesores').html('<tr><td colspan="5">No se encontraron profesores.</td></tr>');
    }
},
error: function(xhr, status, error) {
    console.error('Error al cargar los profesores:', error);
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
                            url: 'http://localhost/Proyectofinal/controllers/Profesores.controller.php?op=insertar',
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
                            url: 'http://localhost/Proyectofinal/controllers/Profesores.controller.php?op=detalle&id_profesor=' + idProfesor,
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
                            url: 'http://localhost/Proyectofinal/controllers/Profesores.controller.php?op=actualizar',
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
                                    url: 'http://localhost/Proyectofinal/controllers/Profesores.controller.php?op=eliminar',
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
