// Función para inicializar eventos al cargar la página
function init() {
    $("#frm_asignaturas").on("submit", function (e) {
      guardarYEditar(e);
    });
  
    // Cargar la tabla de asignaturas al cargar la página
    cargarTabla();
  }
  
  // Función para cargar la tabla de asignaturas
  var cargarTabla = () => {
    var html = "";
  
    // Llamada AJAX para obtener la lista de asignaturas desde el backend
    $.get("../../controllers/Asignaturas.controllers.php", (listaAsignaturas) => {
      $.each(listaAsignaturas, (indice, unaAsignatura) => {
        html += `
              <tr>
                  <td>${indice + 1}</td>
                  <td>${unaAsignatura.nombre}</td>
                  <td>${unaAsignatura.codigo}</td>
                  <td>
                      <button class="btn btn-primary" onclick="editar(${unaAsignatura.id_asignatura})">Editar</button>
                      <button class="btn btn-danger" onclick="eliminar(${unaAsignatura.id_asignatura})">Eliminar</button>
                  </td>
              </tr>
          `;
      });
      $("#cuerpoAsignaturas").html(html); // Asignar el HTML generado al tbody con id="cuerpoAsignaturas"
    });
  };
  
  // Función para guardar o editar una asignatura
  var guardarYEditar = (e) => {
    e.preventDefault();
    var frm_asignaturas = new FormData($("#frm_asignaturas")[0]);
  
    var id_asignatura = $("#id_asignatura").val();
    var ruta = "";
    if (id_asignatura == 0) {
      ruta = "../../controllers/Asignaturas.controllers.php";
    } else {
      ruta = `../../controllers/Asignaturas.controllers.php?id_asignatura=${id_asignatura}&op=actualizar`;
    }
  
    // AJAX para enviar los datos al backend
    $.ajax({
      url: ruta,
      type: "POST",
      data: frm_asignaturas,
      contentType: false,
      processData: false,
      success: function (datos) {
        console.log(datos);
        $("#asignaturasModal").modal("hide");
        cargarTabla(); // Recargar la tabla después de guardar o editar
      },
    });
  };
  
  // Función para cargar datos de una asignatura específica para edición
  var editar = async (id_asignatura) => {
    await cargarDatosEspecificos(); // Si necesitas cargar otros datos específicos para la edición
    $.get(`..../controllers/Asignaturas.controllers.php?id_asignatura=${id_asignatura}`, (asignatura) => {
      console.log(asignatura);
      $("#nombre").val(asignatura.nombre);
      $("#codigo").val(asignatura.codigo);
      $("#id_asignatura").val(asignatura.id_asignatura);
      // Otros campos específicos del formulario de asignaturas
    });
  
    $("#modalAsignatura").modal("show");
  };
  
  // Función para eliminar una asignatura
  var eliminar = (id_asignatura) => {
    Swal.fire({
      title: "Asignaturas",
      text: "¿Está seguro que desea eliminar la asignatura?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `../controllers/Asignaturas.controllers.php?id_asignatura=${id_asignatura}`,
          type: "DELETE",
          success: function (resultado) {
            if (resultado) {
              Swal.fire({
                title: "Asignaturas",
                text: "Se eliminó con éxito",
                icon: "success",
              });
              cargarTabla(); // Recargar la tabla después de eliminar
            } else {
              Swal.fire({
                title: "Asignaturas",
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
  