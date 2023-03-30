$(document).ready(function () {
  $(".calendar-configgeneral").datetimepicker({
    showOn: "button",
    firstDay: 1,
    buttonImageOnly: true,
    buttonImage: "images/calendar.gif",
    dateFormat: "yy-mm-dd",
    timeFormat: "HH:mm:ss",
    changeMonth: true,
    showWeek: true,
  });
  const formulario = document.querySelector("#form_configuraciongeneral");
  const campos = formulario.querySelectorAll("input, select");

  // Bandera para indicar si ha habido cambios
  let haHabidoCambios = false;

  // Agregar un listener a cada campo para detectar cambios
  campos.forEach((campo) => {
    campo.addEventListener("input", () => {
      haHabidoCambios = true;
    });
  });

  // Agregar el evento onbeforeunload a la ventana
  window.addEventListener("beforeunload", (event) => {
    if (haHabidoCambios) {
      event.preventDefault();
      event.returnValue = "Si continúa, se perderán los cambios. ¿Desea continuar?.";
    }
  });

  function handleBeforeUnload(event) {
    event.preventDefault();
    event.returnValue = ""; // Necesario para que el mensaje de confirmación no aparezca
  }

  function validarformDestinos() {
    validacionesDestino = 0;
    $(".chkivr").each(function () {
      console.log("algo" + $(this).is(":checked"));
      if ($(this).is(":checked")) {
        if ($("#" + $(this).attr("data-destino")).val() == "") {
          validacionesDestino++;
        }
      }
    });
    return validacionesDestino;
  }

  function validateOutboundRoutes() {
    let counter = 0;
    $(".chkrouteoutbounds").each(function () {
      if ($(this).is(":checked")) {
        counter++;
      }
    });
    return counter;
  }

  $("#btnguardardatos").click(function () {
    validarDestinos = validarformDestinos();
    if (validarDestinos > 0) {
      alert("Debe ingresar un destino");
      return;
    }

    if ($("#cant_lineas").val() == "") {
      alert("Debe ingresar la cantidad de líneas");
      return;
    }
    if ($("#barridos").val() == "") {
      alert("Debe ingresar el campo barrido");
      return;
    }
    if ($("#fecha_busqueda").val() == "") {
      alert("Debe ingresar una fecha de búsqueda");
      return;
    }
    if ($("#horainicialnot").val() == "") {
      alert("Debe ingresar la hora inicial notificación");
      return;
    }
    if ($("#minutoinicialnot").val() == "") {
      alert("Debe ingresar el minuto inicial notificación");
      return;
    }
    if ($("#horafinalnot").val() == "") {
      alert("Debe ingresar la hora final notificación");
      return;
    }
    if ($("#minutofinalnot").val() == "") {
      alert("Debe ingresar el minuto final notificación");
      return;
    }
    if ($("#diainicialnot").val() == "") {
      alert("Debe ingresar el día inicial notificación");
      return;
    }
    if ($("#diafinalnot").val() == "") {
      alert("Debe ingresar el día final notificación");
      return;
    }

    /*if (validateOutboundRoutes() == 0) {
      alert("Debe marcar alguna ruta de plan de marcado");
      return;
    } */

    if ($("#notificacion_troncal").val() == "") {
      alert("Debe selecciona un plan de marcado");
      return;
    }

    window.removeEventListener("beforeunload", handleBeforeUnload);

    document.form_configuraciongeneral.action = "index.php?menu=configuracion_general&action=save";
    document.form_configuraciongeneral.submit();
  });

  $(".chkivr").change(function () {
    let id = $(this).attr("id");
    let checked = $("#" + id).is(":checked");
    let selectToShowAndHide = id.split("_")[1];
    $("#ivr" + selectToShowAndHide).css("display", "none");

    if (checked) {
      $("#ivr" + selectToShowAndHide).css("display", "block");
    }
  });
});
