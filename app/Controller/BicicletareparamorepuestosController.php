<?php
App::uses('AppController', 'Controller');
/**
 * Bicicletareparamorepuestos Controller
 *
 * @property Bicicletareparamorepuesto $Bicicletareparamorepuesto
 * @property PaginatorComponent $Paginator
 */
class BicicletareparamorepuestosController extends AppController {

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
		$this->Bicicletareprepuesto->recursive = 0;
		$this->set('bicicletareparamorepuestos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bicicletareparamorepuesto->exists($id)) {
			throw new NotFoundException(__('Invalid bicicletareparamorepuesto'));
		}
		$options = array('conditions' => array('Bicicletareparamorepuesto.' . $this->Bicicletareparamorepuesto->primaryKey => $id));
		$this->set('bicicletareparamorepuesto', $this->Bicicletareparamorepuesto->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Bicicletareparamorepuesto->create();
			if ($this->Bicicletareparamorepuesto->save($this->request->data)) {
				$this->Session->setFlash(__('El bicicletareparamorepuesto a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El bicicletareparamorepuesto no se pudo grabar. Por favor, intente de nuevo.'));
			}
		}
		$bicicletareparamos = $this->Bicicletareparamorepuesto->Bicicletareparamo->find('list');
		$this->set(compact('bicicletareparamos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Bicicletareparamorepuesto->exists($id)) {
			throw new NotFoundException(__('Invalid bicicletareparamorepuesto'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bicicletareparamorepuesto->save($this->request->data)) {
				$this->Session->setFlash(__('El bicicletareparamorepuesto a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El bicicletareparamorepuesto no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Bicicletareparamorepuesto.' . $this->Bicicletareparamorepuesto->primaryKey => $id));
			$this->request->data = $this->Bicicletareparamorepuesto->find('first', $options);
		}
		$bicicletareparamos = $this->Bicicletareparamorepuesto->Bicicletareparamo->find('list');
		$this->set(compact('bicicletareparamos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->layout='';
		$this->Bicicletareparamorepuesto->id = $id;
		$error = '';
		if (!$this->Bicicletareparamorepuesto->exists()) {
			$error = 'No existe el registro a eliminar';
			//throw new NotFoundException(__('Invalid bicicletareparamorepuesto'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Bicicletareparamorepuesto->delete()) {
			$error = '';
		} else {
			$error = __('El Repuesto no se pudo borrar. Por favor, intente de nuevo.');
		}
		$this->set('error',$error);
	}
	
	public function nuevafila($fila=null){
		$this->layout = '';
		$this->set('fila',$fila);
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
		parent::beforeRender();
	}	

}
