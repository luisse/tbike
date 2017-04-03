<?php
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
*    @author Luis Sebastian oppe
*    @Fecha 15/12/2010
*    @use Librerias de AJAX para seleccion de usuarios
*/

class AccesorapidosController extends AppController{
	var $name='Accesorapidos';
	var $components=array('RequestHandler','Paginator');
	var $uses=array('Accesorapido','Cliente','Bicicletareparamo','Mensaje','Buttonuser');

	public $helpers = array(
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
	
	function index(){
		$tallercito = $this->Session->read('tallercito');
		$this->set('title_for_layout','Taller -'.$tallercito['Tallercito']['razonsocial']);
		/*Totales de Bicicleta a reparar*/
		$filter='';
		$filtermensajesmant='';
		$mensajeservicependientes=0;
		$bicienespera=0;
		$bicientaller=0;
		$biciconfirmar=0;
		
		/*Filtros necesario para el caso de los usuarios tipo cliente*/
		if($this->Session->read('tipousr') == 2){ 
			$filter = array('Bicicletareparamo.cliente_id'=>$this->Session->read('cliente_id'));
			$filtermensajesmant='Mensaje.bicicleta_id in('.$this->Session->read('bicicleta_id').')';
			//Mensajes de service para el cliente
			$mensajeservice=$this->Mensaje->find('first',array('conditions'=>array('Mensaje.bicicleta_id in('.$this->Session->read('bicicleta_id').')',
																			'Mensaje.confirmadocliente'=>0),
																		'fields'=>array('count(*) as mensajeservicependiente')));
			$mensajeservicependientes = $mensajeservice[0]['mensajeservicependiente'];
		}
		$bicicletareparamostots = $this->Bicicletareparamo->find('all',array('conditions'=>array('Bicicletareparamo.estado in(0,1,2)',
																													'User.tallercito_id'=>$this->Session->read('tallercito_id'),
																													$filter),
																											'group'=>'Bicicletareparamo.estado',
																											'fields'=>array('Count(*) as totalestado','Bicicletareparamo.estado')));
		foreach($bicicletareparamostots as $bicicletareparamostot){
			if($bicicletareparamostot['Bicicletareparamo']['estado'] == 0)
				$bicienespera=$bicicletareparamostot[0]['totalestado'];
			if($bicicletareparamostot['Bicicletareparamo']['estado'] == 1)				
				$bicientaller=$bicicletareparamostot[0]['totalestado'];
			if($bicicletareparamostot['Bicicletareparamo']['estado'] == 2)				
				$biciconfirmar=$bicicletareparamostot[0]['totalestado'];
		}
		/*Totales de Mensajes de Mantenimiento para la fecha*/
		$totalmensajemant = $this->Mensaje->find('first',array('conditions'=>array('Mensaje.fechasendauto = '."'".date('Y-m-d 00:00:00')."'",
																				'Mensaje.tallercito_id'=>$this->Session->read('tallercito_id'),
																				'Mensaje.tipomen_id'=>1,
																				$filtermensajesmant),
																				'fields'=>array('Count(*) as totalmensajesmantenimiento')));
		$mensajesmant=0;	
		if(!empty($totalmensajemant)){
			$mensajesmant = $totalmensajemant[0]['totalmensajesmantenimiento'];
		}
		//Buttons
		/*Recuperamos los datos de botones asociados al usuario*/
		$buttonacces=array();
		if($this->Session->read('tipousr')==1){
			$buttonacces = $this->Buttonuser->find('all',array('conditions'=>array('Buttonuser.user_id'=>$this->Session->read('user_id'),
																					'Buttonuser.active'=>1),
																	'fields'=>array('Button.descripc','Button.modelname','Button.actionname')));
			/*Si no encontramos botones asignamos traemos todos los botones por defecto*/
			if(empty($buttonacces))
				$buttonacces = $this->Buttonuser->find('all',array('conditions'=>array('Button.group_id'=>$this->Session->read('tipousr'))));
					/*Si no encontramos botones asignamos traemos todos los botones por defecto*/
			if(empty($buttonacces))
				$buttonacces = $this->Button->find('all',array('conditions'=>array('Button.group_id'=>$this->Session->read('tipousr'))));
		}	
		$mensajesmant = $mensajesmant + $mensajeservicependientes;
		$this->set(compact('mensajesmant','bicienespera','bicientaller','biciconfirmar','buttonacces'));
		$this->set('mensajesmant',$mensajesmant);
		/**$this->set('bicienespera',$bicienespera);
		$this->set('bicientaller',$bicientaller);
		$this->set('biciconfirmar',$biciconfirmar);**/
	}
	
	function ejemplobootstrap(){
		$this->layout='bootstrap3';
	
	}
	
	function listarclientes(){
		$this->layout='bootstrap3';
		$this->set('clientes',$this->Cliente->find('all'));
	}

	public function seguridaderror($accessmodel = null){
		$this->set('accessmodel',$accessmodel);
	}
	
	function beforeFilter(){
	   parent::beforeFilter();
	   $this->Auth->allow('index', 'view','seguridaderror','verayuda');
	   // For CakePHP 2.0
	   $this->Auth->allow('*');
	   
	   // For CakePHP 2.1 and up
	   $this->Auth->allow();
	   	   
	}
	
	//funcion permite ver ayuda en video
	public function verayuda(){
		
	}


}
?>