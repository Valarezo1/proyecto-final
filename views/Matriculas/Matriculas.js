// Función para inicializar eventos al cargar la página
function init() {
  $("#frm_matriculas").on("submit", function (e) {
    guardaryeditar(e); // Llamar a la función guardaryeditar cuando se envía el formulario
  });

  cargaTabla(); // Cargar la tabla de matrículas al cargar la página
}

// Función para cargar la tabla de matrículas
var cargaTabla = () => {
  var html = "";

  // Llamada AJAX para obtener la lista de matrículas desde el backend
  $.get("http://localhost/Proyectofinal/controllers/Matriculas.controllers.php", (listaMatriculas) => {
    $.each(listaMatriculas, (indice, unaMatricula) => {
      html += `
            <tr>
                <td>${indice + 1}</td>
                <td>${unaMatricula.id_alumno}</td>
                <td>${unaMatricula.id_clase}</td>
                <td>${unaMatricula.fecha_matricula}</td>
                <td>
                    <button class="btn btn-primary" onclick="editar(${unaMatricula.id_matricula})">Editar</button>
                    <button class="btn btn-danger" onclick="eliminar(${unaMatricula.id_matricula})">Eliminar</button>
                </td>
            </tr>
        `;
    });
    $("#cuerpomatriculas").html(html); // Asignar el HTML generado al tbody con id="cuerpomatriculas"
  }).fail(function(jqXHR, textStatus, errorThrown) {
    console.error("Error al cargar la lista de matrículas:", errorThrown);
    // Puedes mostrar un mensaje de error aquí si lo deseas
  });
};

// Función para guardar o editar una matrícula
var guardaryeditar = (e) => {
  e.preventDefault();
  var frm_matriculas = new FormData($("#frm_matriculas")[0]);

  var id_matricula = $("#id_matricula").val();
  var ruta = "";
  if (id_matricula == 0) {
    ruta = "http://localhost/Trabajo/proyectofinal/controllers/Matriculas.controllers.php";
  } else {
    ruta = `http://localhost/Trabajo/proyectofinal/controllers/Matriculas.controllers.php?id_matricula=${id_matricula}&op=actualizar`;
  }

  // AJAX para enviar los datos al backend
  $.ajax({
    url: ruta,
    type: "POST",
    data: frm_matriculas,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      $("#matriculasModal").modal("hide");
      cargaTabla(); // Recargar la tabla después de guardar o editar
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("Error al guardar o editar matrícula:", errorThrown);
      // Puedes mostrar un mensaje de error aquí si lo deseas
    }
  });
};

// Función para cargar datos de una matrícula específica para edición
var editar = async (id_matricula) => {
  await cargarDatosEspecificos(); // Si necesitas cargar otros datos específicos para la edición
  $.get(`http://localhost/Trabajo/proyectofinal/controllers/Matriculas.controllers.php?id_matricula=${id_matricula}`, (matricula) => {
    console.log(matricula);
    $("#id_alumno").val(matricula.id_alumno);
    $("#id_clase").val(matricula.id_clase);
    $("#fecha_matricula").val(matricula.fecha_matricula);
    $("#id_matricula").val(matricula.id_matricula);
    // Otros campos específicos del formulario de matrículas
  });

  $("#modalMatricula").modal("show");
};

// Función para eliminar una matrícula
var eliminar = (id_matricula) => {
  Swal.fire({
    title: "Matrículas",
    text: "¿Está seguro que desea eliminar la matrícula?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: `http://localhost/Trabajo/proyectofinal/controllers/Matriculas.controllers.php?id_matricula=${id_matricula}`,
        type: "DELETE",
        success: function (resultado) {
          if (resultado) {
            Swal.fire({
              title: "Matrículas",
              text: "Se eliminó con éxito",
              icon: "success",
            });
            cargaTabla(); // Recargar la tabla después de eliminar
          } else {
            Swal.fire({
              title: "Matrículas",
              text: "No se pudo eliminar",
              icon: "error",
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error("Error al eliminar matrícula:", errorThrown);
          // Puedes mostrar un mensaje de error aquí si lo deseas
        }
      });
    }
  });
};

// Inicializar la página cuando el DOM esté completamente cargado
$(document).ready(() => {
  init();
});
