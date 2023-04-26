function tooglePassword(id) {
	let x = document.getElementsByName("" + id)[0].type;
	if (x == "password") {
		document.getElementsByName("" + id)[0].type = "text";
	} else {
		document.getElementsByName("" + id)[0].type = "password";
	}
}

$(document).ready(function () {
	$("#criterio").change(function () {
		if ($('#criterio').val() != '') {
			document.form_reporte.submit();
		}
	});
	$(".calendar-reports").datetimepicker({
		showOn: 'button',
		firstDay: 1,
		buttonImageOnly: true,
		buttonImage: 'images/calendar.gif',
		dateFormat: 'dd/mm/yy',
		timeFormat: "HH:mm",
		changeMonth: true,
		showWeek: true,

	});




});
