$(document).ready(function() {
	$("#BicicletareparamoFechadesde").datetimepicker({pickTime: false,language:'es'});
	$("#BicicletareparamoFechasta").datetimepicker({pickTime: false,language:'es'});
	fechaactual('BicicletareparamoFechadesde');
	fechaactual('BicicletareparamoFechasta');

	$('#buscar').click(function(){
		var result = validafechas('#BicicletareparamoFechadesde','#BicicletareparamoFechasta')
		var mensaje = ''
		if(result == -1 || result == -2){
			mensaje = 'Debe Ingresar las Fechas';
		}
		if(result == -5){
			mensaje = 'La Fecha Hasta debe ser mayor o igual a la Fecha Desde'
		}

		if(mensaje != ''){
			showmessage(mensaje,'error')
			$('#BicicletareparamoFechasta').focus();
			return
		}
		mostrarCalendario()
	})
});



function mostrarCalendario(){
	$('#calendar').empty();
	$('#calendar').fullCalendar({
		editable: false,
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		events:{
			type:'POST',
			url:"/bicicletareparamos/jsonretornocalendario.json",
			data:{fechadesde:$("#BicicletareparamoFechadesde").val(),
					fechasta:$("#BicicletareparamoFechasta").val()}
		},
		buttonText: {
					prev: "<span class='fc-text-arrow'>&lsaquo;</span>",
					next: "<span class='fc-text-arrow'>&rsaquo;</span>",
					prevYear: "<span class='fc-text-arrow'>&laquo;</span>",
					nextYear: "<span class='fc-text-arrow'>&raquo;</span>",
					today: 'Hoy',
					month: 'Mes',
					week: 'Semanas',
					day: 'Días'
		},
		loading: function(bool) {
			if (bool) $('#loading').show();
			else $('#loading').hide();
		},
		monthNames:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
						'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		dayNames:['Domingo', 'Lunes', 'Martes', 'Miercoles',
						'Jueves', 'Viernes', 'Sabado'],
		dayNamesShort:['Dom', 'Lun', 'Mar', 'Mie',
						'Jue', 'Vie', 'Sab'],
		titleFormat: {
				month: 'MMMM yyyy',
				week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d yyyy}",
				day: 'dddd, MMM d, yyyy'
			},
		dayClick: function(date, allDay, jsEvent, view) {
				/****if (allDay) {
					alert('Clicked on the entire day: ' + date);
				}else{
					alert('Clicked on the slot: ' + date);
				}
				alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
				alert('Current view: ' + view.name);
				// change the day's background color just for fun
				$(this).css('background-color', 'red');***/

			},
			minTime: '8:00am',
			maxTime: '09:00pm'
	});

}
