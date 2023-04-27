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

  $(".calendar-reports").datepicker({
    showOn: "button",
    firstDay: 1,
    buttonImageOnly: true,
    buttonImage: "images/calendar.gif",
    dateFormat: "dd/mm/yy",
    // timeFormat: "HH:mm",
    changeMonth: true,
    showWeek: true,
  });
});


{/* <tr class="letra12" id="trincludefecha" style="display:{if $modulo == 'apache' || $modulo == 'mariadb'}block{else}none{/if}">
<td align="left"><b>Filtrar sin fecha:</b></td>
<td align="left">
    <input type="checkbox" id="include_fecha" name="include_fecha" value="1" {if "1" == $include_fecha}checked{/if}>
</td>  
</tr> */}