$(document).ready(function(){
	IniciarEventos();}
);

function IniciarEventos(){
  $('#datetimepicker1').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
  $('#datetimepicker2').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
	fechaactual('RadiotaxiFecdesde');
	fechaactual('RadiotaxiFechasta');

	$('#RadiotaxiGrafica').change(function(){
		var selected_item = $('#RadiotaxiGrafica').val();
		if(selected_item == 0){
			$('#RadiotaxiFecdesde').attr('readonly',false);
			$('#RadiotaxiState').attr('readonly',false);
		}else{
			$('#RadiotaxiFecdesde').attr('readonly',true);
			$('#RadiotaxiState').attr('readonly',true);
			$().toastmessage('showToast', {
				text     : 'Recuerde que la gráfica de taxistas solo es posible visualizarla para un solo día.',
				sticky   : false,
				position : 'top-right',
				type     : 'error',
				closeText: '',
				close    : function () {
				}
			});
		}

	});

	$('#view_chart').click(function(){get_data(1)});
}

/*
* Function: permite dibujar el char
* @labels nombres de etiquetas a mostrar(fechas,licencias eje x)
* @result array de resultados representa el valor del eje Y
* @backcol color puede variar acorde a los requerimientos
*/
function showchart(labels,result, backcol){
	$('#chart').html('<canvas id="myChart" width="1024" height="600"></canvas>');
	var ctx = document.getElementById("myChart");
	var type_grah = result.length > 1 ? "line" : "bar";
	var title = $('#RadiotaxiGrafica').val() == 0 ? $('#RadiotaxiState  :selected').text() : 'Tomados por Choferes';
	var myChart = new Chart(ctx, {
			type: type_grah,
			options: {
        responsive: false
	    },
			title: {
				display: true,
				text: 'Pedidos de Autos por día'
			},
			label:'Autos por días',
			data: {
					labels: labels,

					datasets: [
							{
									fill: false,
									type: type_grah,
									label: 'Total de Pedidos - '+title,
									backgroundColor: backcol,
			            borderColor: "rgba(75,192,192,1)",
									data: result,
							}
					]
			}
	});


}


/*
* Function: recupera los datos parael dibujado de char toma de parametros los
* 	        datos de la fecha desde-hasta, el estado del radio taxi que mostraremos, el tipo de gráfica
*/

function get_data(){
	var labels=[];
	var result=[];
	var backcol = [];

	$.ajax({url:'/radiotaxis/get_data_to_chart.json',
			type:'get',
			dataType:'json',
			data:{date_from: $('#RadiotaxiFecdesde').val(),date_to: $('#RadiotaxiFechasta').val(), state: $('#RadiotaxiState').val(), type: $('#RadiotaxiGrafica').val()},
			success: function(data){
				//creamos estructura para visualizar en la gráfica debe contener la misma cantidas de label que de resultados
			  $.each( data, function( key, val ) {
							var label = val.registerpermision ? 'Lic.: '+val.registerpermision : val.date_order;
							labels.push(label);
							result.push(val.total);
							backcol.push('rgba('+Math.floor((Math.random() * 100) + 1)+','+
																	Math.floor((Math.random() * 100) + 1)+','+
																	Math.floor((Math.random() * 100) + 1)+',0.4)');
			  });
				showchart(labels, result, backcol);
			}
	});
}
