<?php
class NumeradoresController extends AppController {

	var $name = 'Numeradores';

	function index() {
		$this->Numeradore->recursive = 0;
		$ls_filtro ='negocio_id = "'.$this->Session->read('negocio_id').'"';
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('detalle'=>'desc'),
						'conditions'=>$ls_filtro);
		$this->set('numeradores', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Numero de Identificador invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('numeradore', $this->Numeradore->read(null, $id));
	}

	function add() {
		$this->set('errorval','');
		if (!empty($this->data)) {
			$this->Numeradore->create();
			$this->request->data['Numeradore']['negocio_id']=$this->Session->read('negocio_id');
			if ($this->Numeradore->save($this->data)) {
				$this->Session->setFlash(__('El numerador fue Grabajo', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El numerador no se pudo grabar. Intente de nuevo', true));
			}
		}
		$this->set(compact('negocios'));
	}

	function edit($id = null) {
		$this->set('errorval','');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Numerador Invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Numeradore->save($this->data)) {
				$this->Session->setFlash(__('El Numerador fue grabado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Numerador no se pudo Grabar. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Numeradore->read(null, $id);
		}
		$negocios = $this->Numeradore->Negocio->find('list');
		$this->set(compact('negocios'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Id de Numerador invalido', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Numeradore->delete($id)) {
			$this->Session->setFlash(__('El Numerador fue borrado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('No se pudo borrar el numerador', true));
		//$this->redirect(array('action' => 'index'));
	}
	
	function retornaNumerador($negocio_id = null,$detalle = null){
		return $this->retornaValor($negocio_id,$detalle);
		
	}
	
	public function beforeRender(){
		try{
			$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
			), ucfirst($this->params['controller']).'/'.$this->params['action']);
			//SI NO TIENE PERMISOS DA ERROR!!!!!!
			if(!$result)
				$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',ucfirst($this->params['controller']).'-'.$this->params['action']));
		}catch(Exeption $e){
		
		}
	}
}
?>