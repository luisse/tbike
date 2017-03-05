<?php
App::uses('AppController', 'Controller');
/**
 * Movimientodetalles Controller
 *
 * @property Movimientodetalle $Movimientodetalle
 * @property PaginatorComponent $Paginator
 */
class MovimientodetallesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Movimientodetalle->recursive = 0;
		$this->set('movimientodetalles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Movimientodetalle->exists($id)) {
			throw new NotFoundException(__('Invalid movimientodetalle'));
		}
		$options = array('conditions' => array('Movimientodetalle.' . $this->Movimientodetalle->primaryKey => $id));
		$this->set('movimientodetalle', $this->Movimientodetalle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Movimientodetalle->create();
			if ($this->Movimientodetalle->save($this->request->data)) {
				$this->Session->setFlash(__('El movimientodetalle a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El movimientodetalle no se pudo grabar. Por favor, intente de nuevo.'));
			}
		}
		$formulaimportes = $this->Movimientodetalle->Formulaimporte->find('list');
		$movimientos = $this->Movimientodetalle->Movimiento->find('list');
		$this->set(compact('formulaimportes', 'movimientos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Movimientodetalle->exists($id)) {
			throw new NotFoundException(__('Invalid movimientodetalle'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Movimientodetalle->save($this->request->data)) {
				$this->Session->setFlash(__('El movimientodetalle a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El movimientodetalle no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Movimientodetalle.' . $this->Movimientodetalle->primaryKey => $id));
			$this->request->data = $this->Movimientodetalle->find('first', $options);
		}
		$formulaimportes = $this->Movimientodetalle->Formulaimporte->find('list');
		$movimientos = $this->Movimientodetalle->Movimiento->find('list');
		$this->set(compact('formulaimportes', 'movimientos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Movimientodetalle->id = $id;
		if (!$this->Movimientodetalle->exists()) {
			throw new NotFoundException(__('Invalid movimientodetalle'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Movimientodetalle->delete()) {
			$this->Session->setFlash(__('El movimientodetalle a sido borrado.'));
		} else {
			$this->Session->setFlash(__('El movimientodetalle no se pudo borrar. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'index'));
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
