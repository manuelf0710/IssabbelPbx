$(document).ready(function () {
  $("#criterio").change(function () {
    if ($("#criterio").val() != "") {
      document.form_reporte.submit();
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

  var tableRows2 = document.querySelectorAll("#divcontent_eventosdd table tbody tr");

  // agregar un manejador de eventos "click" a cada fila
  tableRows2.forEach(function (row) {
    row.addEventListener("click", function () {
      // obtener el texto de la primera celda de la fila
      var textoPrimeraCelda = this.cells[0].textContent;
      console.log("fila clickeada! Primer celda:", textoPrimeraCelda.trim());
    });
  });

  var tableRows = document.querySelectorAll("#divcontent_eventos table tbody tr");

  tableRows.forEach(function (row) {
    row.addEventListener("click", function () {
      var firstCell = this.cells[0];
      var lastCell = this.cells[this.cells.length - 1];

      if (event.target === firstCell) {
        // se hizo clic en la primera celda, se llama a la función "miFuncion1"
        detailEvent(firstCell.textContent.trim(), "forevento_id");
      } else if (event.target === lastCell) {
        // se hizo clic en la última celda, se llama a la función "miFuncion2"
        detailEvent(lastCell.textContent.trim(), "forcampania_id");
      }
    });
  });

  function detailEvent(value, fieldSearch) {
    console.log(value, fieldSearch);
    location.href = "index.php?menu=reportes&criterio=" + fieldSearch + "&action=isDetailEvent&detalleid_filter=" + value;
  }
});
