$(document).ready(function () {
  $("#criterio").change(function () {
    if ($("#criterio").val() != "") {
      document.form_reporte.submit();
    }
  });

  $("#btnsearchauditorias").click(function () {
    if ($("#fecha_inicial").val() != "" && $("#fecha_inicial").val() != "") {
      document.form_auditorias.submit();
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
  $("#fecha_inicial, #fecha_final, .hasDatepicker").datetimepicker({
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
