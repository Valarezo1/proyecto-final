// Función para inicializar eventos al cargar la página
function init() {
  $("#frm_alumnos").on("submit", function (e) {
    guardaryeditar(e); // Llamar a la función guardaryeditar cuando se envía el formulario
  });

  cargaTabla(); // Cargar la tabla de alumnos al cargar la página
}

// Función para cargar la tabla de alumnos
var cargaTabla = () => {
  var html = "";

  // Llamada AJAX para obtener la lista de alumnos desde el backend
  $.get("http://localhost/Proyectofinal/controllers/alumnos.controllers.php", (listaAlumnos) => {
    $.each(listaAlumnos, (indice, unAlumno) => {
      html += `
            <tr>
                <td>${indice + 1}</td>
                <td>${unAlumno.nombre}</td>
                <td>${unAlumno.apellido}</td>
                <td>${unAlumno.fecha_nacimiento}</td>
                <td>
                    <button class="btn btn-primary" onclick="editar(${unAlumno.id_alumno})">Editar</button>
                    <button class="btn btn-danger" onclick="eliminar(${unAlumno.id_alumno})">Eliminar</button>
                </td>
            </tr>
        `;
    });
    $("#cuerpoalumnos").html(html); // Asignar el HTML generado al tbody con id="cuerpoalumnos"
  }).fail(function(jqXHR, textStatus, errorThrown) {
    console.error("Error al cargar la lista de alumnos:", errorThrown);
    // Puedes mostrar un mensaje de error aquí si lo deseas
  });
};

// Función para guardar o editar un alumno
var guardaryeditar = (e) => {
  e.preventDefault();
  var frm_alumnos = new FormData($("#frm_alumnos")[0]);

  console.log("assdadsaasidsaidasio",frm_alumnos);

  var id_alumno = $("#id_alumno").val();
  var ruta = "";
  if (id_alumno == 0) {
    ruta = "http://localhost/Trabajo/proyectofinal/controllers/alumnos.controllers.php";
  } else {
    ruta = `http://localhost/Trabajo/proyectofinal/controllers/alumnos.controllers.php?id_alumno=${id_alumno}&op=actualizar`;
  }

  // AJAX para enviar los datos al backend
  $.ajax({
    url: ruta,
    type: "POST",
    data: frm_alumnos,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      $("#alumnosModal").modal("hide");
      cargaTabla(); // Recargar la tabla después de guardar o editar
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("Error al guardar o editar alumno:", errorThrown);
      // Puedes mostrar un mensaje de error aquí si lo deseas
    }
  });
};

// Función para cargar datos de un alumno específico para edición
var editar = async (id_alumno) => {
  await cargarDatosEspecificos(); // Si necesitas cargar otros datos específicos para la edición
  $.get(`http://localhost/Trabajo/proyectofinal/controllers/alumnos.controllers.php?id_alumno=${id_alumno}`, (alumno) => {
    console.log(alumno);
    $("#nombre").val(alumno.nombre);
    $("#apellido").val(alumno.apellido);
    $("#fecha_nacimiento").val(alumno.fecha_nacimiento);
    $("#id_alumno").val(alumno.id_alumno);
    // Otros campos específicos del formulario de alumnos
  });

  $("#modalAlumno").modal("show");
};

// Función para eliminar un alumno
var eliminar = (id_alumno) => {
  Swal.fire({
    title: "Alumnos",
    text: "¿Está seguro que desea eliminar al alumno?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: `http://localhost/Trabajo/proyectofinal/controllers/alumnos.controllers.php?id_alumno=${id_alumno}`,
        type: "DELETE",
        success: function (resultado) {
          if (resultado) {
            Swal.fire({
              title: "Alumnos",
              text: "Se eliminó con éxito",
              icon: "success",
            });
            cargaTabla(); // Recargar la tabla después de eliminar
          } else {
            Swal.fire({
              title: "Alumnos",
              text: "No se pudo eliminar",
              icon: "error",
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error("Error al eliminar alumno:", errorThrown);
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
