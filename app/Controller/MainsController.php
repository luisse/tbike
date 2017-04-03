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

class MainsController extends AppController{
	var $name='Mains';

  public function index(){
		$this->set('title_for_layout',__('Pagina Principal - TESTING'));
		if($this->Session->read('tipousr') == 5) return $this->redirect(array('controller' => 'mains','action'=>'policiamonitor'));
  }

  public function dashboard(){
		$this->set('title_for_layout',__('TaxiAr - Dashboard'));
		$this->set('test',!empty($this->request->query['test']) ? $this->request->query['test'] : 0);
  }

  public function beforeFilter(){
		$acepted_func=array('securityerror','index');
		if(in_array($this->params['action'],$acepted_func)){
					$this->Auth->allow();
		}else{
			try{
				$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
					), ucfirst($this->params['controller']).'/'.$this->params['action']);
				//SI NO TIENE PERMISOS DA ERROR!!!!!!
						if(!$result)
							$this->redirect(array('controller' => 'mains','action'=>'securityerror',$this->params['controller'].'-'.$this->params['action']));
			}catch(Exeption $e){

			}
			//
		}
  	//parent::beforeFilter();
	  // For CakePHP 2.0
	  //$this->Auth->allow('*');
	  // For CakePHP 2.1 and up
	  //$this->Auth->allow();
  }

	public function securityerror($accessmodel = null){
		$this->set('accessmodel',$accessmodel);
	}

	public function seguridaderror($accessmodel = null){
		$this->set('accessmodel',$accessmodel);
	}

	public function showalldriversonmap($accessmodel = null){
		$this->set('title_for_layout',__('Posicionamiento de taxistas'));
		$this->set('accessmodel',$accessmodel);
		Configure::load('appconf');
		$key_api_maps = Configure::read('key_api_maps');
		$this->set('key_api_maps',$key_api_maps);
	}

	public function vieworders(){

	}

	public function sendmsgactivecar(){
		$error = '';
		$total_msg_send = 0;
		if($this->request->is(array('post'))){
			if($this->request->data['Main']['mensaje']){
				$rsesions = $this->Rsesion->find('all',array('conditions'=>array('User.group_id in (1,2)',
																				'Rsesion.state = 1')));
				$ids = array();

				foreach($rsesions as $rsesion){
					if(!empty($rsesion['Rsesion']['phone_id']))
						$ids[]=trim($rsesion['Rsesion']['phone_id']);
						$total_msg_send++;
				}

				/*SEND MESSAGE TO ALL CAR O NO*/
				$data = array( "title" => "Taxiar",
											'message' => $this->request->data['Main']['mensaje'],
											"priority"=> 2,
											"vibrationPattern" => [1000, 400, 1000, 1000],
											"style" =>"message",
											"picture"=> "https://taxiar-files.s3.amazonaws.com/img/TaxiAppLogo.png",
											"ledColor" =>[255, 3, 169, 244],
											"count" =>3);
				if(!empty($ids)){
					$this->sendGoogleCloudMessage($data,$ids);
				}
			}else{
				$error = 'Debe Ingresar el mensaje a enviar';
			}
		}

		$this->set('error',$error);
		$this->set('total_msg_send',$total_msg_send);
	}

	function policiamonitor(){
		$this->set('title_for_layout',__('TaxiAr - Rastreabilidad y Seguridad'));
		Configure::load('appconf');
		$key_api_maps = Configure::read('key_api_maps');
		$this->set('key_api_maps',$key_api_maps);
		$this->set('test',!empty($this->request->query['test']) ? $this->request->query['test'] : 0);
	}
}

?>
