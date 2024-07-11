<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../public/lib/calendar/lib/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LCwiW/i12FvAyo4zsAE4xQhYdY7t0sYs0N7lgm8IaqQzWqKtx22zAtTr1md1k5VZ"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .custom-flatpickr {
            display: flex;
            align-items: center;
        }

        .custom-flatpickr input {
            margin-right: 5px;
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>

        <!-- Sidebar -->
        <?php require_once('./html/menu.php'); ?>

        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            <?php require_once('./html/header.php'); ?>

            <!-- iframe para gráficos -->
            <iframe name="base" id="base" src="graficos.php" style="border: none; width: 100%; height: 1000px;"></iframe>

            <!-- Lista de Alumnos -->
            <div class="container-fluid pt-4 px-4" id="sectionAlumnos">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAlumno">
                    Nuevo Alumno
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Alumnos</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre y Apellido</th>
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

            <!-- Lista de Profesores -->
            <div class="container-fluid pt-4 px-4" id="sectionProfesores">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalProfesor">
                    Nuevo Profesor
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Profesores</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre y Apellido</th>
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

            <!-- Lista de Asignaturas -->
            <div class="container-fluid pt-4 px-4" id="sectionAsignaturas">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAsignatura">
                    Nueva Asignatura
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Asignaturas</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre Asignatura</th>
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

            <!-- Lista de Clases -->
            <div class="container-fluid pt-4 px-4" id="sectionClases">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalClase">
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

            <!-- Lista de Matrículas -->
            <div class="container-fluid pt-4 px-4" id="sectionMatriculas">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalMatricula">
                    Nueva Matrícula
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Matrículas</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Alumno</th>
                            <th>Clase</th>
                            <th>Fecha de Matrícula</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoMatriculas">
                        <!-- Aquí se cargarán las matrículas dinámicamente -->
                    </tbody>
                </table>
            </div>
            <!-- Fin Lista de Matrículas -->

            <!-- Lista de Calificaciones -->
            <div class="container-fluid pt-4 px-4" id="sectionCalificaciones">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCalificacion">
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

            <!-- Lista de Aulas -->
            <div class="container-fluid pt-4 px-4" id="sectionAulas">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAula">
                    Nueva Aula
                </button>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Lista de Aulas</h6>
                </div>
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre Aula</th>
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

            <!-- Modales -->
            <?php require_once('./html/modals.php'); ?>

            <!-- JavaScript -->
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-6/5N6HPX0JW9CO/cgcvZ+oyq0W8ZO3j7X7WYhVLG4abNdM4EjeyHr3OqGY0+ojHR"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="dashboard.js"></script>
            <script>
                // Código JavaScript adicional
            </script>
        </div>
        <!-- Fin Content -->
    </div>
</body>

</html>