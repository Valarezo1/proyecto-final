// Función para inicializar eventos al cargar la página
function init() {
    $("#frm_aulas").on("submit", function (e) {
        guardarYEditar(e);
    });

    // Cargar la tabla de aulas al cargar la página
    cargarTabla();
}

// Función para cargar la tabla de aulas
var cargarTabla = () => {
    var html = "";

    // Llamada AJAX para obtener la lista de aulas desde el backend
    $.get("../../controllers/aulas.controllers.php", (listaAulas) => {
        $.each(listaAulas, (indice, unAula) => {
            html += `
                <tr>
                    <td>${indice + 1}</td>
                    <td>${unAula.nombre_aula}</td>
                    <td>${unAula.capacidad}</td>
                    <td>
                        <button class="btn btn-primary" onclick="editar(${unAula.id_aula})">Editar</button>
                        <button class="btn btn-danger" onclick="eliminar(${unAula.id_aula})">Eliminar</button>
                    </td>
                </tr>
            `;
        });
        $("#cuerpoAulas").html(html); // Asignar el HTML generado al tbody con id="cuerpoAulas"
    });
};

// Función para guardar o editar un aula
var guardarYEditar = (e) => {
    e.preventDefault();
    var frm_aulas = new FormData($("#frm_aulas")[0]);

    var id_aula = $("#id_aula").val();
    var ruta = "";
    if (id_aula == 0) {
        ruta = "../../controllers/aulas.controllers.php";
    } else {
        ruta = `../../controllers/aulas.controllers.php?id_aula=${id_aula}&op=actualizar`;
    }

    // AJAX para enviar los datos al backend
    $.ajax({
        url: ruta,
        type: "POST",
        data: frm_aulas,
        contentType: false,
        processData: false,
        success: function (datos) {
            console.log(datos);
            $("#aulasModal").modal("hide");
            cargarTabla(); // Recargar la tabla después de guardar o editar
        },
    });
};

// Función para cargar datos de un aula específica para edición
var editar = async (id_aula) => {
    await cargarDatosEspecificos(); // Si necesitas cargar otros datos específicos para la edición
    $.get(`../../controllers/aulas.controllers.php?id_aula=${id_aula}`, (aula) => {
        console.log(aula);
        $("#nombre_aula").val(aula.nombre_aula);
        $("#capacidad").val(aula.capacidad);
        $("#id_aula").val(aula.id_aula);
        // Otros campos específicos del formulario de aulas
    });

    $("#modalAula").modal("show");
};

// Función para eliminar un aula
var eliminar = (id_aula) => {
    Swal.fire({
        title: "Aulas",
        text: "¿Está seguro que desea eliminar el aula?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `../../controllers/aulas.controllers.php?id_aula=${id_aula}`,
                type: "DELETE",
                success: function (resultado) {
                    if (resultado) {
                        Swal.fire({
                            title: "Aulas",
                            text: "Se eliminó con éxito",
                            icon: "success",
                        });
                        cargarTabla(); // Recargar la tabla después de eliminar
                    } else {
                        Swal.fire({
                            title: "Aulas",
                            text: "No se pudo eliminar",
                            icon: "error",
                        });
                    }
                },
            });
        }
    });
};

// Inicializar la página
$().ready(() => {
    init();
});
