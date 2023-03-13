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
      alert("debe ingresar un destino para el evento marcado");
      return;
    }

    if ($("#cant_lineas").val() == "") {
      alert("debe ingresar la cantidad de líneas");
      return;
    }
    if ($("#barridos").val() == "") {
      alert("debe ingresar el campo barridos");
      return;
    }
    if ($("#fecha_busqueda").val() == "") {
      alert("debe ingresar una fecha de busqueda");
      return;
    }
    if ($("#horainicialnot").val() == "") {
      alert("debe ingresar la hora inicial notificación");
      return;
    }
    if ($("#minutoinicialnot").val() == "") {
      alert("debe ingresar el minuto inicial notificación");
      return;
    }
    if ($("#horafinalnot").val() == "") {
      alert("debe ingresar la hora final notificación");
      return;
    }
    if ($("#minutofinalnot").val() == "") {
      alert("debe ingresar el minuto final notificación");
      return;
    }
    if ($("#diainicialnot").val() == "") {
      alert("debe ingresar el dia inicial notificación");
      return;
    }
    if ($("#diafinalnot").val() == "") {
      alert("debe ingresar el dia final notificación");
      return;
    }

    /*if (validateOutboundRoutes() == 0) {
      alert("debe marcar alguna ruta de plan de marcado");
      return;
    } */

    if ($("#notificacion_troncal").val() == "") {
      alert("debe selecciona un plan de marcado");
      return;
    }

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
