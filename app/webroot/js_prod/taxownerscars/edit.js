$(document).ready(function(){IniciarEventos()})
function IniciarEventos(){formateafecha('TaxownerscarDateactive');formateafecha('TaxownerscarDateexpire');$('#datetimepicker1').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#datetimepicker2').datetimepicker({locale:'es',format:"DD/MM/YYYY"});$('#TaxownerscarRegisterpermision').numeric();$('#TaxownerscarDecreenro').numeric()
$('.button-checkbox').each(function(){var $widget=$(this),$button=$widget.find('button'),$checkbox=$widget.find('input:checkbox'),color=$button.data('color'),settings={on:{icon:'glyphicon glyphicon-check'},off:{icon:'glyphicon glyphicon-unchecked'}};$button.on('click',function(){$checkbox.prop('checked',!$checkbox.is(':checked'));$checkbox.triggerHandler('change');updateDisplay()});$checkbox.on('change',function(){updateDisplay()});function updateDisplay(){var isChecked=$checkbox.is(':checked');$button.data('state',(isChecked)?"on":"off");$button.find('.state-icon').removeClass().addClass('state-icon '+settings[$button.data('state')].icon);if(isChecked){$button.removeClass('btn-default').addClass('btn-'+color+' active')}
else{$button.removeClass('btn-'+color+' active').addClass('btn-default')}}
function init(){updateDisplay();if($button.find('.state-icon').length==0){$button.prepend('<i class="state-icon '+settings[$button.data('state')].icon+'"></i> ')}}
init()});$('#guardar').click(guardardatos)
$('#cancelar').click(function(){window.history.back()})
showmessage()}
function guardardatos(){$('form#TaxownerscarEditForm').submit()}
function showmessage(){var message=$('#message').text();if(typeof(message)!='undefined'&&message.trim()!=''){$().toastmessage('showToast',{text:message,sticky:!1,position:'top-right',type:'success',closeText:'',close:function(){}})}}