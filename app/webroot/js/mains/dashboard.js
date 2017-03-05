$(document).ready(function(){
	IniciarEventos();}
);

var initialTimeLeft = 30;
var timeLeft = initialTimeLeft;
var kpi_json='';
var kpi_selected = 0;

function IniciarEventos(){
	get_kpi();
	setInterval(decrementTimer,1000);

	$('#btn_refrescar').click(refreshNow);

	$('#link_kpi_libre').click(function(){
		kpi_selected = 1;
		showDetails();
		return false;});

	$('#link_kpi_ocupado').click(function(){
		kpi_selected = 2;
		showDetails();
		return false;});

	$('#link_kpi_en_camino').click(function(){
		kpi_selected = 3;
		showDetails();
		return false;});

	$('#link_kpi_fuera_de_servicio').click(function(){
		kpi_selected = 4;
		showDetails();
		return false;});
}

function refreshNow() {
	timeLeft = 1;
}

function decrementTimer() {
	timeLeft--;
	$('#time_left').html(timeLeft);
	if (timeLeft<=0) {
		get_kpi();
		timeLeft = initialTimeLeft;
	}
}

function showDetails(){
		if (kpi_selected == 1) {
			view_kpi('kpi_libre_list','success','Libre');
			return;
		}

		if (kpi_selected == 2) {
			view_kpi('kpi_ocupado_list','danger','Ocupado');
			return;
		}

		if (kpi_selected == 3) {
			view_kpi('kpi_en_camino_list','warning','En camino');
			return;
		}

		if (kpi_selected == 4) {
			view_kpi('kpi_fuera_servicio_list','default','Fuera de servicio');
			return;
		}
}

function view_kpi (data,css_class,kpi_name) {

	$('#view_detail_kpi').html('<thead> <tr> <th> Telefono </th> <th>Apellido y Nombre</th> <th>Patente</th> <th>Licencia</th> <th>Ver en mapa</th> </tr>');
	$('#detail_kpi').html('<h3><span class="label label-'+css_class+'">'+kpi_name+'</span></h3>');


	var items = [];
	  $.each( kpi_json[data], function( key, val ) {
	  		var row = $("<tr />");
			 $("#view_detail_kpi").append(row);
			  row.append($("<td>" + val.phonenumber  + "</td>"));
   			row.append($("<td>" + val.apellido +", "+ val.nombre  + "</td>"));
   			row.append($("<td>" + val.carcode + "</td>"));
   			row.append($("<td>" + val.licencenumber + "</td>"));
   			row.append($("<td>" + generateGoogleMapLink(val.carcode,val.lat,val.lng) + "</td>"));
	});
}

function generateGoogleMapLink (label,lat,lng) {
	if (!label) return;
	if (!lat) return;
	if (!lng) return;
	var link = 'http://maps.google.com/?q='+label+'@'+lat +','+lng;
	var htmllink = '<a href="'+link+'" target="_blank">Ver</a>';
	return htmllink;
}

function get_kpi(){
	var myUrl = '/kpis/kpis_count.json?is_test='+test;
	$('#pingpong').html("Enviando");
	$.ajax({url:myUrl,
		type:'get',
		dataType:'json',
		success: function(data){
			  	if(data){
			  		$('#pingpong').html("Recibido");
			  		$('#kpi_libre').html(data.kpi_libre);
			  		$('#kpi_ocupado').html(data.kpi_ocupado);
			  		$('#kpi_en_camino').html(data.kpi_en_camino);
			  		$('#kpi_fuera_de_servicio').html(data.kpi_fuera_servicio);
			  		kpi_json = data;
			  		setTimeout(function() {$('#pingpong').html("");},2500);
			  	}
			  	showDetails();
		},
		error: function () {
			alert('Error con la conexion al servidor');
			//setTimeout(get_kpi,100);
		 }

	})
}
