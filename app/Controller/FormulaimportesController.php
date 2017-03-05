<?php
App::uses('AppController', 'Controller');
/**
 * Formulaimportes Controller
 *
 * @property Formulaimporte $Formulaimporte
 * @property PaginatorComponent $Paginator
 */
class FormulaimportesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	var $uses=array('Formulaimporte','Tipomovimiento');
/**
 * index method
 *
 * @return void
 */
	public function index($tipomovimiento_id = null){
		$this->set('title_for_layout','Importes Formula');
		if(!empty($tipomovimiento_id))
			$this->Session->Write('tipomovimiento_id',$tipomovimiento_id);
		$this->Formulaimporte->recursive = 0;
		$ls_filtros='1=1';
		$tallercito_id = $this->Session->read('tallercito_id');
		$tipomovimiento_id=$this->Session->read('tipomovimiento_id');
		
		if(empty($tallercito_id)) return;
		$ls_filtros=$ls_filtros.' AND Formulaimporte.tallercito_id = '.$tallercito_id;
		if(empty($tipomovimiento_id)) return;
		
		$ls_filtros=$ls_filtros.' AND Formulaimporte.tipomovimiento_id='.$this->Session->read('tipomovimiento_id');
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('descripcion'=>'DESC'),
						'conditions'=>$ls_filtros);		
		$this->set('formulaimportes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Formulaimporte->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		$options = array('conditions' => array('Formulaimporte.' . $this->Formulaimporte->primaryKey => $id));
		$this->set('formulaimporte', $this->Formulaimporte->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add(){
		$this->set('title_for_layout',__('Nuevo Porcentaje Para Calculos'));
		if ($this->request->is('post')) {
			$this->Formulaimporte->create();
			$this->request->data['Formulaimporte']['tallercito_id']=$this->Session->read('tallercito_id');
			$this->request->data['Formulaimporte']['tipomovimiento_id']=$this->Session->read('tipomovimiento_id');
			if ($this->Formulaimporte->save($this->request->data)) {
				$this->Session->setFlash(__('El Item de la Formula se Grabo Satisfacoriamente.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('La Formula no se pudo grabar. Por favor, intente de nuevo.'));
			}
		}
		$tallercitos = $this->Formulaimporte->Tallercito->find('list');
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		/*Seguridad UPDATE*/
		$this->set('title_for_layout',__('Editar Porcentaje para Calculos'));
		$registros = $this->Formulaimporte->find('count',array('conditions'=>array('Formulaimporte.id'=>$id,'Formulaimporte.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if($registros > 0){
			if (!$this->Formulaimporte->exists($id)) {
				throw new NotFoundException(__('Identificador Invalido'));
			}
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Formulaimporte->save($this->request->data)) {
					$this->Session->setFlash(__('La Formula a sido guardado.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('La Formula no se pudo guardar. Por favor, intente de nuevo.'));
				}
			} else {
				$options = array('conditions' => array('Formulaimporte.' . $this->Formulaimporte->primaryKey => $id,
																			'Formulaimporte.tallercito_id'=>$this->Session->read('tallercito_id')));
				$this->request->data = $this->Formulaimporte->find('first', $options);
			}
			$tallercitos = $this->Formulaimporte->Tallercito->find('list');
			$this->set(compact('tallercitos'));
		}else{
			return $this->redirect(array('action' => 'index'));
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		/*Seguridad DELETE */
		$registros = $this->Formulaimporte->find('count',array('conditions'=>array('Formulaimporte.id'=>$id,'Formulaimporte.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if($registros > 0){
			$this->Formulaimporte->id = $id;
			if (!$this->Formulaimporte->exists()) {
				throw new NotFoundException(__('Identificador invalido'));
			}
			try {
				if ($this->Formulaimporte->delete()) {
					$this->Session->setFlash(__('La Formula a sido borrado.'));
				} else {
					$this->Session->setFlash(__('La Formula no se pudo borrar. Por favor, intente de nuevo.'));
				}
			}catch(Exception $e){
				$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a operación'));
			}
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforerender(){
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
		$tipomovimiento_id=$this->Session->read('tipomovimiento_id');
		if(!empty($tipomovimiento_id)){
			$tipodemovimientos=$this->Tipomovimiento->find('first',array('conditions'=>array('Tipomovimiento.id'=>$tipomovimiento_id),
																											'values'=>array('descripcion')));
			$this->set('movimientodescripcion',$tipodemovimientos['Tipomovimiento']['descripcion']);
		}
		$str_esporcentaje[0]='No';
		$str_esporcentaje[1]='Si';
		$this->set('str_esporcentaje',$str_esporcentaje);
		parent::beforeRender();
	}
}
