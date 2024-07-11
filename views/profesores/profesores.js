// Función para inicializar eventos al cargar la página
function init() {
  $("#frm_profesores").on("submit", function (e) {
    guardaryeditar(e); // Llamar a la función guardaryeditar cuando se envía el formulario
  });

  cargaTabla(); // Cargar la tabla de profesores al cargar la página
}

// Función para cargar la tabla de profesores
var cargaTabla = () => {
  var html = "";

  // Llamada AJAX para obtener la lista de profesores desde el backend
  $.get("http://localhost/Proyectofinal/controllers/Profesores.controller.php", (listaProfesores) => {
    $.each(listaProfesores, (indice, unProfesor) => {
      html += `
            <tr>
                <td>${indice + 1}</td>
                <td>${unProfesor.nombre}</td>
                <td>${unProfesor.apellido}</td>
                <td>${unProfesor.especialidad}</td>
                <td>
                    <button class="btn btn-primary" onclick="editar(${unProfesor.id_profesor})">Editar</button>
                    <button class="btn btn-danger" onclick="eliminar(${unProfesor.id_profesor})">Eliminar</button>
                </td>
            </tr>
        `;
    });
    $("#cuerpoprofesores").html(html); // Asignar el HTML generado al tbody con id="cuerpoprofesores"
  }).fail(function(jqXHR, textStatus, errorThrown) {
    console.error("Error al cargar la lista de profesores:", errorThrown);
    // Puedes mostrar un mensaje de error aquí si lo deseas
  });
};

// Función para guardar o editar un profesor
var guardaryeditar = (e) => {
  e.preventDefault();
  var frm_profesores = new FormData($("#frm_profesores")[0]);

  console.log("Datos del formulario:", frm_profesores);

  var id_profesor = $("#id_profesor").val();
  var ruta = "";
  if (id_profesor == 0) {
    ruta = "http://localhost/Proyectofinal/controllers/Profesores.controller.php";
  } else {
    ruta = `http://localhost/Proyectofinal/controllers/Profesores.controller.php?id_profesor=${id_profesor}&op=actualizar`;
  }

  // AJAX para enviar los datos al backend
  $.ajax({
    url: ruta,
    type: "POST",
    data: frm_profesores,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      $("#profesoresModal").modal("hide");
      cargaTabla(); // Recargar la tabla después de guardar o editar
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("Error al guardar o editar profesor:", errorThrown);
      // Puedes mostrar un mensaje de error aquí si lo deseas
    }
  });
};

// Función para cargar datos de un profesor específico para edición
var editar = async (id_profesor) => {
  await cargarDatosEspecificos(); // Si necesitas cargar otros datos específicos para la edición
  $.get(`http://localhost/Proyectofinal/controllers/Profesores.controller.php?id_profesor=${id_profesor}`, (profesor) => {
    console.log(profesor);
    $("#nombre").val(profesor.nombre);
    $("#apellido").val(profesor.apellido);
    $("#especialidad").val(profesor.especialidad);
    $("#id_profesor").val(profesor.id_profesor);
    // Otros campos específicos del formulario de profesores
  });

  $("#modalProfesor").modal("show");
};

// Función para eliminar un profesor
var eliminar = (id_profesor) => {
  Swal.fire({
    title: "Profesores",
    text: "¿Está seguro que desea eliminar al profesor?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: `http://localhost/Proyectofinal/controllers/Profesores.controller.php?id_profesor=${id_profesor}`,
        type: "DELETE",
        success: function (resultado) {
          if (resultado) {
            Swal.fire({
              title: "Profesores",
              text: "Se eliminó con éxito",
              icon: "success",
            });
            cargaTabla(); // Recargar la tabla después de eliminar
          } else {
            Swal.fire({
              title: "Profesores",
              text: "No se pudo eliminar",
              icon: "error",
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error("Error al eliminar profesor:", errorThrown);
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