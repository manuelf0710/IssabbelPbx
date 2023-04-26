$(document).ready(function () {
  $("#criterio").change(function () {
    if ($("#criterio").val() != "") {
      document.form_reporte.submit();
    }
  });

  $("#modulo").change(function () {
    if ($("#modulo").val() == "apache" || $("#modulo").val() == "mariadb") {
      $("#trincludefecha").css("display", "block");
    } else {
      $("#trincludefecha").css("display", "none");
      $("#include_fecha").prop("checked", false);
    }
  });

  $("#btnsearchlogs").click(function () {
    if ($("#fecha_inicial").val() != "" && $("#fecha_inicial").val() != "") {
      document.form_logs.submit();
    } else {
      alert("debe ingresar los valores de fecha inicial y fecha final");
    }
  });

  $(".calendar-reports").datetimepicker({
    showOn: "button",
    firstDay: 1,
    buttonImageOnly: true,
    buttonImage: "images/calendar.gif",
    dateFormat: "dd/mm/yy",
    timeFormat: "HH:mm",
    changeMonth: true,
    showWeek: true,
  });
});
