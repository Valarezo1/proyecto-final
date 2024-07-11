// Función para inicializar eventos al cargar la página
function init() {
    $("#frm_clases").on("submit", function (e) {
      guardaryeditar(e); // Llamar a la función guardaryeditar cuando se envía el formulario
    });
  
    cargaTabla(); // Cargar la tabla de clases al cargar la página
  }
  
  // Función para cargar la tabla de clases
  var cargaTabla = () => {
    var html = "";
  
    // Llamada AJAX para obtener la lista de clases desde el backend
    $.get("http://localhost/Proyectofinal/controllers/Clases.controllers.php", (listaClases) => {
      $.each(listaClases, (indice, unaClase) => {
        html += `
              <tr>
                  <td>${indice + 1}</td>
                  <td>${unaClase.id_asignatura}</td>
                  <td>${unaClase.id_profesor}</td>
                  <td>${unaClase.horario}</td>
                  <td>
                      <button class="btn btn-primary" onclick="editar(${unaClase.id_clase})">Editar</button>
                      <button class="btn btn-danger" onclick="eliminar(${unaClase.id_clase})">Eliminar</button>
                  </td>
              </tr>
          `;
      });
      $("#cuerpoclases").html(html); // Asignar el HTML generado al tbody con id="cuerpoclases"
    }).fail(function(jqXHR, textStatus, errorThrown) {
      console.error("Error al cargar la lista de clases:", errorThrown);
      // Puedes mostrar un mensaje de error aquí si lo deseas
    });
  };
  
  // Función para guardar o editar una clase
  var guardaryeditar = (e) => {
    e.preventDefault();
    var frm_clases = new FormData($("#frm_clases")[0]);
  
    var id_clase = $("#id_clase").val();
    var ruta = "";
    if (id_clase == 0) {
      ruta = "http://localhost/Trabajo/proyectofinal/controllers/Clases.controllers.php";
    } else {
      ruta = `http://localhost/Trabajo/proyectofinal/controllers/Clases.controllers.php?id_clase=${id_clase}&op=actualizar`;
    }
  
    // AJAX para enviar los datos al backend
    $.ajax({
      url: ruta,
      type: "POST",
      data: frm_clases,
      contentType: false,
      processData: false,
      success: function (datos) {
        console.log(datos);
        $("#clasesModal").modal("hide");
        cargaTabla(); // Recargar la tabla después de guardar o editar
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error("Error al guardar o editar clase:", errorThrown);
        // Puedes mostrar un mensaje de error aquí si lo deseas
      }
    });
  };
  
  // Función para cargar datos de una clase específica para edición
  var editar = async (id_clase) => {
    await cargarDatosEspecificos(); // Si necesitas cargar otros datos específicos para la edición
    $.get(`http://localhost/Trabajo/proyectofinal/controllers/Clases.controllers.php?id_clase=${id_clase}`, (clase) => {
      console.log(clase);
      $("#id_asignatura").val(clase.id_asignatura);
      $("#id_profesor").val(clase.id_profesor);
      $("#horario").val(clase.horario);
      $("#id_clase").val(clase.id_clase);
      // Otros campos específicos del formulario de clases
    });
  
    $("#modalClase").modal("show");
  };
  
  // Función para eliminar una clase
  var eliminar = (id_clase) => {
    Swal.fire({
      title: "Clases",
      text: "¿Está seguro que desea eliminar la clase?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `http://localhost/Trabajo/proyectofinal/controllers/Clases.controllers.php?id_clase=${id_clase}`,
          type: "DELETE",
          success: function (resultado) {
            if (resultado) {
              Swal.fire({
                title: "Clases",
                text: "Se eliminó con éxito",
                icon: "success",
              });
              cargaTabla(); // Recargar la tabla después de eliminar
            } else {
              Swal.fire({
                title: "Clases",
                text: "No se pudo eliminar",
                icon: "error",
              });
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error al eliminar clase:", errorThrown);
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
  