/*Funcion: Permite dibujar un diagrama con API de google chart*/
$(document).ready(function(){ 
    InicalizarEvent();}) 
	
function InicalizarEvent(){
	$('#buscar').click(function(){
			loadchar()
			});	
	$('#anio').numeric()
}	
function loadchar(){
   // var data = new google.visualization.DataTable();
	var anio = $('#anio').val()
	anio = anio.trim()
	if(typeof(anio) !='undefined' &&  anio != ' '){
	  var datos = CargarDatos()
    var barOptions = {
        series: {
            bars: {
                show: true,
                barWidth: 0.6,
							align: "center"
            }
        },
        xaxis: {
            mode: "categories",
					tickLength:0
        },
        grid: {
            hoverable: true,
					clickable: true
        }
    };
    var barData = {
        label: "Service Mensuales Montos",
        data:JSON.parse(datos)
    };
	
		var bar_data = {
			data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
            color: "#3c8dbc"
        };	
	

	//TOOLTIPS
		$("<div id='tooltip'></div>").css({
					position: "absolute",
					display: "none",
					border: "1px solid #fdd",
					padding: "2px",
					"background-color": "#fee",
					opacity: 0.80
				}).appendTo("body");	
				
	$.plot($("#flot-bar-chart"), [barData], barOptions);
		$("#flot-bar-chart").bind("plothover", function (event, pos, item) {
						
						if (item) {
							var x = item.datapoint[0].toFixed(2),
								y = item.datapoint[1].toFixed(2);

							$("#tooltip").html(item.series.label + " del Mes " + x + " = " + y)
								.css({top: item.pageY+5, left: item.pageX+5})
								.fadeIn(200);
						} else {
							$("#tooltip").hide();
						}
				});
	}else{
		mensaje('Debe Ingresar una Año para visualizar la Gráfica','Totales del Año')
	}
}


function CargarDatos(){
	var anio = $('#anio').val()
	var datos = $.ajax({
            url:'/bicicletareparamos/totalservicemes/'+anio,
            type:'post',
            dataType:'json',
            async:false
        }).responseText;
	return datos;
}