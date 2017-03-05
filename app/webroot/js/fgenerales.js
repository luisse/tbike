/*
 * Funcion: permite validar las fechas
 * @return -1 Fecha desde no definida
 *         -2 Fecha hasta no definida
 *         -3 Fecha inicial invalida
 *         -4 Fecha final invalida
 *         -5 Fecha final menor que fecha incial
 * */
function validafechas(ps_fecdese,ps_fechasta){
   var ld_fecdesde =$(ps_fecdese).val()
   var ld_fechasta =$(ps_fechasta).val()
   
   if(typeof(ld_fecdesde) == 'undefined' || ld_fecdesde=='' )
       return -1

   if(typeof(ld_fechasta) == 'undefined' || ld_fechasta=='' )
       return -2

   lst_fecdesde = ld_fecdesde.split('/')
   lst_fechasta = ld_fechasta.split('/')

   if(lst_fecdesde.length != 3)
       return -3


   if(lst_fechasta.length != 3)
       return -4

   //dia
   if(lst_fecdesde[0].charAt(0)=='0')
       ls_dia_desde = lst_fecdesde[0].charAt(1)
   else
       ls_dia_desde = lst_fecdesde[0]
   li_dia_desde = parseInt(ls_dia_desde)
   //mes
   if(lst_fecdesde[1].charAt(0)=='0')
       ls_mes_desde = lst_fecdesde[1].charAt(1)
   else
       ls_mes_desde = lst_fecdesde[1]
   li_mes_desde = parseInt(ls_mes_desde)
   li_anio_desde = parseInt(lst_fecdesde[2])
   ld_fechadesde_val = new Date(li_mes_desde+'/'+li_dia_desde+'/'+li_anio_desde)
   //Fechasta
   //dia
   if(lst_fechasta[0].charAt(0)=='0')
       ls_dia_hasta = lst_fechasta[0].charAt(1)
   else
       ls_dia_hasta = lst_fechasta[0]
   li_dia_hasta = parseInt(ls_dia_desde)
   
   //mes
   if(lst_fechasta[1].charAt(0)=='0')
       ls_mes_hasta = lst_fechasta[1].charAt(1)
   else
	   ls_mes_hasta = lst_fechasta[1]
   
   li_mes_hasta = parseInt(ls_mes_hasta)
   li_anio_hasta = parseInt(lst_fechasta[2])
   ld_fechasta_val = new Date(li_mes_hasta+'/'+ls_dia_hasta+'/'+li_anio_hasta)

   if(ld_fechadesde_val> ld_fechasta_val){
       return -5
   }
   return 0
}

function retornaFechaDate(ps_fecha){
	   if(typeof(ps_fecha) == 'undefined' || ps_fecha == '' )
	       return -1 //no definida
	   lst_fecha = ps_fecha.split('/')
	   if(lst_fecha.length != 3)
	       return -3 //formato invalido es dd/mm/yyyy
       //dia
       if(lst_fecha[0].charAt(0)=='0')
           ls_dia_desde = lst_fecha[0].charAt(1)
       else
           ls_dia_desde = lst_fecha[0]
       li_dia_desde = parseInt(ls_dia_desde)
       //mes
       if(lst_fecha[1].charAt(0)=='0')
           ls_mes_desde = lst_fecha[1].charAt(1)
       else
           ls_mes_desde = lst_fecha[1]
	   
       li_mes_desde = parseInt(ls_mes_desde)
       li_anio_desde = parseInt(lst_fecha[2])	   
	   if(li_dia_desde>31) return -4
	   if(li_mes_desde>12) return -4
	   

       ld_fecha = new Date(li_mes_desde+'/'+li_dia_desde+'/'+li_anio_desde)
	   return ld_fecha
}

/*
 * Funcion: permite validar una fecha
 * */
function fechacorrecta(ps_fecha){
	   if(typeof(ps_fecha) == 'undefined' || ps_fecha == '' )
	       return -1 //no definida
	   lst_fecha = ps_fecha.split('/')
	   if(lst_fecha.length != 3)
	       return -3 //formato invalido es dd/mm/yyyy
       //dia
       if(lst_fecha[0].charAt(0)=='0')
           ls_dia_desde = lst_fecha[0].charAt(1)
       else
           ls_dia_desde = lst_fecha[0]
       li_dia_desde = parseInt(ls_dia_desde)
       //mes
       if(lst_fecha[1].charAt(0)=='0')
           ls_mes_desde = lst_fecha[1].charAt(1)
       else
           ls_mes_desde = lst_fecha[1]
	   
       li_mes_desde = parseInt(ls_mes_desde)
       li_anio_desde = parseInt(lst_fecha[2])	   
	   if(li_dia_desde>31) return -4
	   if(li_mes_desde>12) return -4
	   if(li_anio_desde<1900) return -4
	   

       ld_fecha = new Date(li_mes_desde+'/'+li_dia_desde+'/'+li_anio_desde)	       
	   if(typeof(ld_fecha) == 'undefined' || typeof(ld_fecha) != 'object') return -4
	   ldt_hoy=new Date();

	   if(ld_fecha>ldt_hoy) return -5
	   return 0 //ok
}

//recibe una fecha en formato yyyy-mm-dd y retorna dd/mm/yyyy
function formateafecha(nom_object){
	var ls_fecha=$('#'+nom_object).val();
	if(ls_fecha =='' || typeof(ls_fecha) == 'undefined') return
	lst_fecha = ls_fecha.split('-')
    ls_dia = lst_fecha[2]
    //mes
    ls_mes = lst_fecha[1]
	
	ls_fecha=ls_dia+'/'+ls_mes+'/'+lst_fecha[0]
	$('#'+nom_object).val(ls_fecha);
	
}

/*requiere dateformat ;-)*/
function fechaactual(object_name){
	var ldt_hoy=new Date()
	ls_format=ldt_hoy.format('dd/mm/yyyy')
	$('#'+object_name).val(ls_format)
}

/*
 * Funcion: permite controlar la cantidad de digitos ingresados en caso
 * de ser menor a lo requerido rellena el mismo con 0 a la izquierda
 * @param nombre del objeto JS
 * @cantdigitos cantidad de dígitos requeridos
 * **/

function controladigitos(name_obj,can_dig,pos){
	var ls_value = $('#'+name_obj).val()
	if(ls_value == '' || typeof(ls_value) == 'undefined') return
	li_cantidad_dig=  can_dig - ls_value.length
	if(ls_value.length < can_dig){
		for(i=0;i < li_cantidad_dig ;i++){
			if(pos =='I')
				ls_value='0'+ls_value
			else
				ls_value=ls_value+'0'
		}
		$('#'+name_obj).val(ls_value)
	}
	
	
}

/*
 * Funcion: mascaras para importes
 * @param objeto a aplicar la mascara
 * @param evento generado en el objeto html
 */
function mascara_importes(object,event) {
   var keynum
   // teclas que permiten el movimiento dentro del text box
   if(event.altKey) return false;
   /*
   *Comentado por sloppe se agrega nuevo código para recuperar
   *la tecla presionada para compatibilidad con IE/FX
   */
   //tecla = window.event.keyCode;
   tecla = event.keyCode



   //tecla = = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
   if (tecla == 37 || tecla == 39 || tecla == 8 || tecla == 36 || tecla == 35 || tecla == 16 || tecla == 17 || tecla == 9)
   {
       return false;
   }

   /*Agreg x sloppe en CR falla cuando llega un valor undefines*/
   if(tecla == null){
       return false
   }


  // if(object.value == object.valant) return

   ls_valor = object.value
   result=''
   lb_sep=false
   li_con_dec=1
   li_pos_sep=0
   for(z=0;z<ls_valor.length;z++){
           if(isNaN(ls_valor.charAt(z))){
               if(ls_valor.charAt(z) !='.' && ls_valor.charAt(z) != ','){
                   letra = new RegExp(ls_valor.charAt(z),"g")
                   ls_valor = ls_valor.replace(letra,"")
               }else{
                   if(lb_sep==false){
                       result=result+ls_valor.charAt(z)
                       lb_sep=true
                   }
               }
           }else{
               if(lb_sep==false)
                   result=result+ls_valor.charAt(z)
               else
                   if(li_con_dec <= 2){
                       result=result+ls_valor.charAt(z)
                       li_con_dec++
                   }
           }
   }
   //solo dejamos dos decimales
   if(lb_sep==false) ls_valor=ls_valor
   object.value = ls_valor
   object.valant= ls_valor

   return 0
}



function inicializaMascara(obj,valor){
	var ls_val=$('#'+obj).val()
	if(typeof(ls_val)=='undefined' || ls_val=='')
		$('#'+obj).val('0.00')
}



function decimales(ps_val){
	var ls_decimales=''
	if(String(ps_val).indexOf(',') <=0 && String(ps_val).indexOf('.') <=0){ 
		ls_decimales = '.00'
	}else{
		pi_posdec=String(ps_val).indexOf(',')
		if(pi_posdec <=0) pi_posdec = String(ps_val).indexOf('.')
		ps_decimal = ps_val.substr(pi_posdec + 1,ps_val.length)
		if(ps_decimal.length <=1) ps_val = ps_val+'0'
	}
	ls_val=String(ps_val)
	ps_val=ls_val.replace(',','.')
	return ps_val+ls_decimales
}


function dateAddExtention(p_Interval, p_Number){ 
	var thing = new String(); 
	//in the spirt of VB we'll make this function non-case sensitive 
	//and convert the charcters for the coder. 
	p_Interval = p_Interval.toLowerCase(); 
	if(isNaN(p_Number)){ 
		//Only accpets numbers  
		//throws an error so that the coder can see why he effed up	 
		throw "The second parameter must be a number. \n You passed: " + p_Number; 
		return false; 
	} 
 
	p_Number = new Number(p_Number); 
	switch(p_Interval.toLowerCase()){ 
		case "yyyy": {// year 
			this.setFullYear(this.getFullYear() + p_Number); 
			break; 
		} 
		case "q": {		// quarter 
			this.setMonth(this.getMonth() + (p_Number*3)); 
			break; 
		} 
		case "m": {		// month 
			this.setMonth(this.getMonth() + p_Number); 
			break; 
		} 
		case "y":		// day of year 
		case "d":		// day 
		case "w": {		// weekday 
			this.setDate(this.getDate() + p_Number); 
			break; 
		} 
		case "ww": {	// week of year 
			this.setDate(this.getDate() + (p_Number*7)); 
			break; 
		} 
		case "h": {		// hour 
			this.setHours(this.getHours() + p_Number); 
			break; 
		} 
		case "n": {		// minute 
			this.setMinutes(this.getMinutes() + p_Number); 
			break; 
		} 
		case "s": {		// second 
			this.setSeconds(this.getSeconds() + p_Number); 
			break; 
		} 
		case "ms": {		// second 
			this.setMilliseconds(this.getMilliseconds() + p_Number); 
			break; 
		} 
		default: { 
		 
			//throws an error so that the coder can see why he effed up and 
			//a list of elegible letters. 
			throw	"The first parameter must be a string from this list: \n" + 
					"yyyy, q, m, y, d, w, ww, h, n, s, or ms.  You passed: " + p_Interval; 
			return false; 
		} 
	} 
	return this; 
} 
Date.prototype.dateAdd = dateAddExtention; 
//pay attention to the new.  If you don't use it 
//you won't create a Date object, and that code up there won't work			

function mascaraimporte(object){
	$('#'+object).priceFormat({
		limit:10,
		centsLimit:2,
	    prefix: '$ ',
	    centsSeparator: '.',
	    thousandsSeparator: ''
	})	
}

function mascaraimporteclass(object){
	$('.'+object).priceFormat({
		limit:10,
		centsLimit:2,
	    prefix: '$ ',
	    centsSeparator: '.',
	    thousandsSeparator: ''
	})	
}


function diasfecha(fechadesde){
	   if(typeof(fechadesde) == 'undefined' || fechadesde == '' )
	       return -1 //no definida
	   lst_fecha = fechadesde.split('/')
	   if(lst_fecha.length != 3)
	       return -3 //formato invalido es dd/mm/yyyy
       //dia
       if(lst_fecha[0].charAt(0)=='0')
           ls_dia_desde = lst_fecha[0].charAt(1)
       else
           ls_dia_desde = lst_fecha[0]
       li_dia_desde = parseInt(ls_dia_desde)
       //mes
       if(lst_fecha[1].charAt(0)=='0')
           ls_mes_desde = lst_fecha[1].charAt(1)
       else
           ls_mes_desde = lst_fecha[1]
	   
       li_mes_desde = parseInt(ls_mes_desde)
       li_anio_desde = parseInt(lst_fecha[2])

	fecha= new Date();
	hoy = new Date(fecha.getFullYear(),fecha.getMonth()+1,fecha.getDate());
	//reemplaza new Date(2001,03,26) por la fecha de inicio de tu site asi: new Date(aaaa,mm,dd)
	inicio = new Date(li_anio_desde,li_mes_desde,li_dia_desde)
	resta = hoy.getTime()-inicio.getTime();
	resultado = Math.floor(resta/(1000*60*60*24));
	return resultado
} 

/*
* Funcion: Permite cargar un drop down a partir del control y del campos a rellenar
* Parametros:
* @controlget: nombre donde recuperaremos el id
* @url: url que recupera los datos del xmlp
* @controlcargar: control que se debería cargar
*/
function cargardropdown(controlget,url,controlcargar){
  var li_value = $('#'+controlget).val()
  $(controlcargar).val('')
  if(li_value == 0 || typeof(li_value)=='undefined') return
  $.ajax({type:'GET',
          url:url+li_value,
          datatype:'xml',
          success:function(data){
                  var xml;
		var options = '';
				xml = data;
               $(xml).find('datos').each(function(){
               //Cargamos el drow dow con las provincias
			var li_id = $(this).find('id').text()
			var ls_name = $(this).find('nombre').text()
			options += '<option value="' +li_id+ '">' + ls_name + '</option>'

		});//close each
		//cargamos el drop down
		if(options == '') options = '<option value="0">Desconocido</option>'
		$('#'+controlcargar).html(options)
		$('#'+controlcargar).show()
          },
          error:function(xtr,fr,ds){
                  mensaje('No se pudieron recuperar las Provincias Asociadas. Verifique la conexión al server','Plan','')
          }
  })//close ajax
}

function cargardropcateg(controlget,url,controlcargar){
  var li_value = $('#'+controlget).val()
  $(controlcargar).val('')
  if(li_value == 0 || typeof(li_value)=='undefined') return
  $.ajax({type:'GET',
          url:url+li_value,
          datatype:'xml',
          success:function(data){
                  var xml;
		var options = '';
				xml = data;
               $(xml).find('datos').each(function(){
               //Cargamos el drow dow con las provincias
			var li_id = $(this).find('id').text()
			var ls_name = $(this).find('descripcion').text()
			options += '<option value="' +li_id+ '">' + ls_name + '</option>'

		});//close each
		//cargamos el drop down
		if(options == '') options = '<option value="0">Sin Sub Categoria</option>'
		$('#'+controlcargar).html(options)
		$('#'+controlcargar).show()
          },
          error:function(xtr,fr,ds){
                  mensaje('No se pudieron recuperar las Categorias Asociadas. Verifique la conexión al server','Plan','')
          }
  })//close ajax
}

/*
 * Funcion: permite validar fechas menores a una fecha inicial
 * @return -1 Fecha desde no definida
 *         -2 Fecha hasta no definida
 * */
function validafechasAll(ld_fecdesde,ld_fechasta){
  
   
   if(typeof(ld_fecdesde) == 'undefined' || ld_fecdesde=='' )
       return -1

   if(typeof(ld_fechasta) == 'undefined' || ld_fechasta=='' )
       return -2

   lst_fecdesde = ld_fecdesde.split('/')
   lst_fechasta = ld_fechasta.split('/')

   if(lst_fecdesde.length != 3)
       return -3


   if(lst_fechasta.length != 3)
       return -4

   //dia
   if(lst_fecdesde[0].charAt(0)=='0')
       ls_dia_desde = lst_fecdesde[0].charAt(1)
   else
       ls_dia_desde = lst_fecdesde[0]
   li_dia_desde = parseInt(ls_dia_desde)
   //mes
   if(lst_fecdesde[1].charAt(0)=='0')
       ls_mes_desde = lst_fecdesde[1].charAt(1)
   else
       ls_mes_desde = lst_fecdesde[1]
   li_mes_desde = parseInt(ls_mes_desde)
   li_anio_desde = parseInt(lst_fecdesde[2])
   ld_fechadesde_val = new Date(li_mes_desde+'/'+li_dia_desde+'/'+li_anio_desde)
   //Fechasta
   //dia
   if(lst_fechasta[0].charAt(0)=='0')
       ls_dia_hasta = lst_fechasta[0].charAt(1)
   else
       ls_dia_hasta = lst_fechasta[0]
   li_dia_hasta = parseInt(ls_dia_desde)
   
   //mes
   if(lst_fechasta[1].charAt(0)=='0')
       ls_mes_hasta = lst_fechasta[1].charAt(1)
   else
	   ls_mes_hasta = lst_fechasta[1]
   
   li_mes_hasta = parseInt(ls_mes_hasta)
   li_anio_hasta = parseInt(lst_fechasta[2])
   ld_fechasta_val = new Date(li_mes_hasta+'/'+ls_dia_hasta+'/'+li_anio_hasta)

   if(ld_fechadesde_val> ld_fechasta_val){
       return -5
   }
   return 0
}


function showmessage(message,type){
	if(typeof(message) != 'undefined' && message.trim() != ''){
		$().toastmessage('showToast', {
				text     : message,
				sticky   : false,
				position : 'top-right',
				type     : type,
				closeText: '',
				close    : function () {
					//console.log("toast is closed ...");
				}
			});	
	}
}
/*
 * Funcion: permite mostrar una vista de una imagen cargada en el browser
 * Parametros:
 * 			fileobjec: el objeto dónde el usuario carga la imagen
 * 			filevuew: el lugar dónde mostraremos la imagen
 * 			pbjecbase64: el objeto dónde guardaremos la imagen base64
 * */
function mostrarVistaPrevia(fileobject,fileview,objetbase64) {
    var Archivos, Lector;
	//Para navegadores antiguos
    if (typeof FileReader !== "function") {
    	showmessage('Vista Previa no disponible','error')
        return;
    }

    Archivos = $('#'+fileobject)[0].files;
    if (Archivos.length > 0) {
        Lector = new FileReader();
        Lector.onloadend = function(e) {
            var origen, tipo;
            //Envia la imagen a la pantalla
            origen = e.target; //objeto FileReader
            //Prepara la información sobre la imagen
            tipo = obtenerTipoMIME(origen.result.substring(0, 30));
            //Si el tipo de archivo es válido lo muestra, 
            //sino muestra un mensaje 
            if (tipo !== 'image/jpeg' && tipo !== 'image/png' && tipo !== 'image/gif') {
            	showmessage('El formato de imagen no es válido: debe seleccionar una imagen JPG, PNG o GIF.','error')
            } else {
				$( "#"+fileview ).html('');
				$( "#"+fileview ).append( '<img width="300px" height="300px" src="' + origen.result + '" >');
				if(typeof($("#"+objetbase64).val())!='undefined'){
					$("#"+objetbase64).val(origen.result.substr(22,origen.result.lenght))
				}
            }
        };
        Lector.onerror = function(e) {
            console.log(e)
        }
        Lector.readAsDataURL(Archivos[0]);

    } else {
    };
}

function obtenerTipoMIME(cabecera) {
    return cabecera.replace(/data:([^;]+).*/, '\$1');
}
