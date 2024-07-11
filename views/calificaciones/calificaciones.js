// Función para inicializar eventos al cargar la página
function init() {
  $("#frm_calificaciones").on("submit", function (e) {
      guardaryeditar(e); // Llamar a la función guardaryeditar cuando se envía el formulario
  });

  cargaTabla(); // Cargar la tabla de calificaciones al cargar la página

  cargarMatriculas(); // Cargar las matrículas al cargar la página
}

// Función para cargar las matrículas en un select
var cargarMatriculas = () => {
  $.get("http://localhost/Proyectofinal/controllers/Matriculas.controllers.php", (matriculas) => {
      var selectMatriculas = $("#id_matricula");
      selectMatriculas.empty();
      selectMatriculas.append("<option value=''>Seleccione una matrícula</option>");
      $.each(matriculas, (index, matricula) => {
          selectMatriculas.append(`<option value='${matricula.id_matricula}'>${matricula.detalle}</option>`);
      });
  }).fail(function(jqXHR, textStatus, errorThrown) {
      console.error("Error al cargar las matrículas:", errorThrown);
      // Puedes mostrar un mensaje de error aquí si lo deseas
  });
};

// Función para cargar la tabla de calificaciones
var cargaTabla = () => {
  var html = "";

  // Llamada AJAX para obtener la lista de calificaciones desde el backend
  $.get("http://localhost/Proyectofinal/controllers/Calificaciones.controllers.php", (listaCalificaciones) => {
      $.each(listaCalificaciones, (indice, unaCalificacion) => {
          html += `
              <tr>
                  <td>${indice + 1}</td>
                  <td>${unaCalificacion.id_matricula}</td>
                  <td>${unaCalificacion.nota}</td>
                  <td>
                      <button class="btn btn-primary" onclick="editar(${unaCalificacion.id_calificacion})">Editar</button>
                      <button class="btn btn-danger" onclick="eliminar(${unaCalificacion.id_calificacion})">Eliminar</button>
                  </td>
              </tr>
          `;
      });
      $("#cuerpoCalificaciones").html(html); // Asignar el HTML generado al tbody con id="cuerpoCalificaciones"
  }).fail(function(jqXHR, textStatus, errorThrown) {
      console.error("Error al cargar la lista de calificaciones:", errorThrown);
      // Puedes mostrar un mensaje de error aquí si lo deseas
  });
};

// Función para guardar o editar una calificación
var guardaryeditar = (e) => {
  e.preventDefault();
  var frm_calificaciones = new FormData($("#frm_calificaciones")[0]);

  console.log("Formulario de calificaciones:", frm_calificaciones);

  var id_calificacion = $("#id_calificacion").val();
  var ruta = "";
  if (id_calificacion == 0) {
      ruta = "http://localhost/Proyectofinal/controllers/Calificaciones.controllers.php";
  } else {
      ruta = `http://localhost/Proyectofinal/controllers/Calificaciones.controllers.php?id_calificacion=${id_calificacion}&op=actualizar`;
  }

  // AJAX para enviar los datos al backend
  $.ajax({
      url: ruta,
      type: "POST",
      data: frm_calificaciones,
      contentType: false,
      processData: false,
      success: function (datos) {
          console.log(datos);
          $("#modalCalificacion").modal("hide");
          cargaTabla(); // Recargar la tabla después de guardar o editar
      },
      error: function(jqXHR, textStatus, errorThrown) {
          console.error("Error al guardar o editar calificación:", errorThrown);
          // Puedes mostrar un mensaje de error aquí si lo deseas
      }
  });
};

// Función para cargar datos de una calificación específica para edición
var editar = async (id_calificacion) => {
  await cargarDatosEspecificos(); // Si necesitas cargar otros datos específicos para la edición
  $.get(`http://localhost/Proyectofinal/controllers/Calificaciones.controllers.php?id_calificacion=${id_calificacion}`, (calificacion) => {
      console.log(calificacion);
      $("#id_matricula").val(calificacion.id_matricula);
      $("#nota").val(calificacion.nota);
      $("#id_calificacion").val(calificacion.id_calificacion);
      // Otros campos específicos del formulario de calificaciones
  });

  $("#modalCalificacion").modal("show");
};

// Función para eliminar una calificación
var eliminar = (id_calificacion) => {
  Swal.fire({
      title: "Calificaciones",
      text: "¿Está seguro que desea eliminar la calificación?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Eliminar",
  }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
              url: `http://localhost/Proyectofinal/controllers/Calificaciones.controllers.php?id_calificacion=${id_calificacion}`,
              type: "DELETE",
              success: function (resultado) {
                  if (resultado) {
                      Swal.fire({
                          title: "Calificaciones",
                          text: "Se eliminó con éxito",
                          icon: "success",
                      });
                      cargaTabla(); // Recargar la tabla después de eliminar
                  } else {
                      Swal.fire({
                          title: "Calificaciones",
                          text: "No se pudo eliminar",
                          icon: "error",
                      });
                  }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.error("Error al eliminar calificación:", errorThrown);
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
