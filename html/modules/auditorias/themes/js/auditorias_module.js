$(document).ready(function(){
	$( "#criterio" ).change(function() {
	  if($('#criterio').val() != ''){
		  document.form_reporte.submit();
	  }
	});

	$(".calendar-reports").datetimepicker({
		showOn: 'button',
		firstDay:1,
		buttonImageOnly: true,
		buttonImage: 'images/calendar.gif',
		dateFormat: 'dd/mm/yy',
		timeFormat :"HH:mm",
		changeMonth:true,
		showWeek:true,

	});		
	$("#fecha_inicial, #fecha_final").datetimepicker({
		showOn: 'button',
		firstDay:1,
		buttonImageOnly: true,
		buttonImage: 'images/calendar.gif',
		dateFormat: 'dd/mm/yy',
		timeFormat :"HH:mm",
		changeMonth:true,
		showWeek:true,

	});		
});
