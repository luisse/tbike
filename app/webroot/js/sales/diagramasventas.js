google.load('visualization', '1.0', {'packages':['corechart']});
//google.setOnLoadCallback(inicializarJquery);    
$(document).ready(function(){ 
    InicalizarEvent();}) 
      
function InicalizarEvent(){
	$('#anio').numeric()
    $('#btmostrar').click(inicializarJquery)
}   
      
function inicializarJquery(){
   // var data = new google.visualization.DataTable();
    var datos = CargarDatos()
    var data = google.visualization.arrayToDataTable(JSON.parse(datos));
    if(typeof(datos) == 'undefined'){
    	$().toastmessage('showErrorToast', "No se encontraron datos para la fecha ingresada...");
    }else{
	     /* Se definen algunas opciones para el grafico*/
	    var opciones = {
	        title: 'Ventas del Año',
	        hAxis: {title: 'MESES', titleTextStyle: {color: 'green'}},
	        vAxis: {title: 'Monto Total', titleTextStyle: {color: '#FF0000'}},
	        backgroundColor:'#ffffcc',
	        legend:{position: 'bottom', textStyle: {color: 'green', fontSize: 10}},
	        width:900,
	        height:500
	    };
	  
	    // Instantiate and draw our chart, passing in some options.
	    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
	    chart.draw(data, opciones);
    }
}
  
function CargarDatos(){
    var anio = $('#anio').val()
    var datos = $.ajax({
            url:'/sales/totalesdiagrama/'+anio,
            type:'post',
            dataType:'json',
            async:false
        }).responseText;
    return datos;
}