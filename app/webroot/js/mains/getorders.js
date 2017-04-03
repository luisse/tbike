/*
*    This program is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>
*    @author <author>
*    @Fecha <fecha>
*    @use <USE DESCRIPCION>
*/

//inicializamos eventos y procesos desde el DOM
$(document).ready(function(){
cargarEventoFilas();})

function cargarEventoFilas(){
$('#cancelar').click(function(){window.history.back()})
$('#datetimepicker1').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
$('#datetimepicker2').datetimepicker({locale:'es',format: "DD/MM/YYYY"});
//fechas por defecto
fechadesde = $('#fecdesde').val()
if(typeof(fechadesde) == 'undefined' || fechadesde == '')
fechaactual('fecdesde')
fechasta = $('#fechasta').val()
if(typeof(fechasta) =='undefined' || fechasta == '')
fechaactual('fechasta')
$('#modalview').on('hidden.bs.modal', function () {
$('#content').empty();
$(this).data('bs.modal', null); //<---- empty() to clear the modal
})
$('#buscar').click(function(){ getorder() });
showmessage();
}


function showmessage(){
var message = $('#message').text();
if(typeof(message) != 'undefined' && message.trim() != ''){
$().toastmessage('showToast', {
text     : message,
sticky   : false,
position : 'top-right',
type     : 'success',
closeText: '',
close    : function () {
}
});
}
}

function getorder(){

  $.ajax({url:link+'?fecha_desde='+$('#fecdesde').val()+'&fecha_hasta='+$('#fechasta').val(),
		type:'get',
		dataType:'json',
		success: function(data){
			  	if(data){
	  		//$('#kpi_libre').html(data.kpi_libre);
            showOrders(data);
			  	}

		},
		error: function () {
			alert('Error con la conexion al servidor');
			//setTimeout(get_kpi,100);
		 }

	})
}

function showOrders (data) {

	$('#view_orders').html('<thead> <tr> <th>Fecha</th> <th>Origen</th> <th>Destino</th> <th>Pasajero</th>  <th>Taxista</th> <th>Estado</th> <th>Pedido por</th></tr>');
/*
  "order_id": 2239,
    "order_date": "2016-05-20 07:30:36",
    "direccionorigen": "Juramento 601-699",
    "direcciondestino": "",
    "pasajeroid": 2530,
    "pasajeronombre": "antonio",
    "pasajeroapellido": "palomo",
    "pasajerotelefono": "3814479061",
    "taxturn_id": null,
    "taxistanombre": null,
    "taxistaapellido": null,
    "taxistatelefono": null
*/

	var items = [];
	  $.each( data, function( key, val ) {
	  		var row = $("<tr />");
        var pasajeronombre = '';
        var state_order = val.state_order ? val.state_order : '';
        var label_text = '';
        var array_direccionorigen = val.direccionorigen.split(',')
        var array_direcciondestino = val.direcciondestino.split(',')
        var direccionorigen = array_direccionorigen[0] ? array_direccionorigen[0] : array_direccionorigen;
        var direcciondestino = array_direcciondestino[0] ? array_direcciondestino[0] : array_direcciondestino;

        $('#search').css('');
			  $("#view_orders").append(row);

       if(val.pasajeronombre === val.taxistanombre){
         if(val.group_id != 6)//no debe ser un radio taxi
          pasajeronombre = val.order_details;
       }else{
          pasajeronombre = val.pasajeroapellido ? val.pasajeroapellido +", "+ val.pasajeronombre : '';
       }


        switch(val.state){
          case 0:
            label_text = 'En Espera';
            break;
          case 1:
            label_text = 'Aceptado';
            break;
          case 2:
            label_text = 'Cancelado';
            break;
          case 3:
            label_text = 'Candelado por el Taxista'
        }
      state_order = state_order === '' ? label_text : state_order;

       var taxistaapellido = val.taxistaapellido || '';
       var coma = taxistaapellido ? ',' : '';
        var taxistanombre = val.taxistanombre || '';
       row.append($("<td>" + val.order_date + "</td>"));
       row.append($("<td>" + direccionorigen + "</td>"));
       row.append($("<td>" + direcciondestino + "</td>"));
   		 row.append($("<td>" + pasajeronombre  + "</td>"));
   		 row.append($("<td>" + taxistaapellido + coma +  taxistanombre  + "</td>"));
       row.append($("<td>" + state_order  + "</td>"));
       row.append($("<td>" + val.group_name  + "</td>"));
	});
}
