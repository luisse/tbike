<?php
App::uses('AppController', 'Controller');
/**
 * Categorias Controller
 *
 * @property Categoria $Categoria
 * @property PaginatorComponent $Paginator
 * @property AclComponent $Acl
 */
class CategoriasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Acl','Cimage');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Categoria->recursive = 0;
		$this->paginate=array('limit' => 5,
						'page' => 1,
						'order'=>array('padre_id'=>'desc','id'=>'asc'),
						'conditions'=>array('Categoria.tallercito_id'=>$this->Session->read('tallercito_id'),
											'Categoria.padre_id IS NULL'));
		$categorias = $this->Paginator->paginate();
		$i=0;
		foreach($categorias as $categoria){
			$subcategoria = $this->Categoria->find('all',array('conditions'=>array('Categoria.padre_id'=>$categoria['Categoria']['id'])));
			if(!empty($subcategoria))
			$subcategorias[$i]=$subcategoria;
			$i++;
		}
		$this->set('categorias',$categorias);
		$this->set('subcategorias',$subcategorias);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Categoria->exists($id)) {
			throw new NotFoundException(__('Invalid categoria'));
		}
		$options = array('conditions' => array('Categoria.' . $this->Categoria->primaryKey => $id));
		$this->set('categoria', $this->Categoria->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add(){
		if ($this->request->is('post')) {
			$this->Categoria->create();
			$this->request->data['Categoria']['tallercito_id'] = $this->Session->read('tallercito_id');
			if(!empty($id_parent)) $this->Categoria->request['Categoria']['padre_id'] = $id_parent;
			if ($this->Categoria->save($this->request->data)) {
				$this->Session->setFlash(__('La Categoria a sido guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo grabar los datos. Por favor, intente de nuevo.'));
			}
		}
	}

/**
 * addsub method agregar subcategorias
 *
 * @return void
 */
	public function addsub($padre_id = null){
		if(!empty($padre_id))
			$this->Session->write('padre_id',$padre_id);
		else
			$padre_id=$this->Session->read('padre_id');
		if ($this->request->is('post')) {
			$this->Categoria->create();
			//$this->request->data['Categoria']['tallercito_id'] = $this->Session->read('tallercito_id');
			if(!empty($id_parent)) $this->Categoria->request['Categoria']['padre_id'] = $id_parent;
			if ($this->Categoria->saveMany($this->request->data['Categoria'])) {
				$this->Session->setFlash(__('La Categoria a sido guardada.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo grabar los datos. Por favor, intente de nuevo.'));
			}
		}
		$options = array('conditions' => array('Categoria.' . $this->Categoria->primaryKey => $padre_id,'Categoria.tallercito_id'=>$this->Session->read('tallercito_id')),
								'fields'=>array('Categoria.descripcion'));
		$categoria = $this->Categoria->find('first', $options);
		$this->set('padre_id',$padre_id);
		$this->set(compact('categoria'));
	}
	/**
 * nuevafila method agregar nueva fila
 *
 * @return void
 */
	public function nuevafila($row = null,$padre_id=null){
		$this->layout='';
		$this->set('row',$row);
		$this->set('padre_id',$padre_id);
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Categoria->exists($id)) {
			$this->Session->setFlash(__('No existe el identificador'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$count = $this->Categoria->find('count',array('conditions'=>array('Categoria.id'=>$id,'Categoria.tallercito_id'=>$this->Session->read('tallercito_id'))));
			if($count > 0){
				if ($this->Categoria->save($this->request->data)) {
					$this->Session->setFlash(__('Los datos han sido actualizados'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se pudo actualizar la Categoria. Por favor, intente de nuevo.'));
				}
			}
		}else {
				$options = array('conditions' => array('Categoria.' . $this->Categoria->primaryKey => $id));
				$this->request->data = $this->Categoria->find('first', $options);
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
		$this->Categoria->id = $id;
		if (!$this->Categoria->exists()) {
			$this->Session->setFlash(__('No existe el identificador'));
			return $this->redirect(array('action' => 'index'));
		}
		$count = $this->Categoria->find('count',array('conditions'=>array('Categoria.id'=>$id,'Categoria.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if($count > 0){
			try {
				if ($this->Categoria->delete()) {
					$this->Session->setFlash(__('El registro sido borrado.'));
				} else {
					$this->Session->setFlash(__('El registro no se pudo borrar. Por favor, intente de nuevo.'));
				}
			}catch(Exception $e){
					$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a operación'));
			}
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function mostrarimagen($id = null){
		$filename=WWW_ROOT."/files/img/".$id.'mgicat'.$this->Session->read('tallercito_id').'.png';
		if(!file_exists($filename)){
			$categoria = $this->Categoria->find("first",array('fields'=>
													array('Categoria.imagen'),
													'conditions'=>array('Categoria.id'=>$id)));
			if(!empty($categoria)){
				$file = new File($filename,true,0644);
				$file->write($categoria['Categoria']['imagen'],'wb',true);
				$file->close();
				$cimage = new CimageComponent(new ComponentCollection());
				$cimage->view($categoria['Categoria']['imagen'],'jpg');
			}
		}else{
			$file = new File($filename);
			$file->open('r',true);
			$result = $file->read($filename,'rb',true);
			$file->close();
			$cimage = new CimageComponent(new ComponentCollection());
			$cimage->view($result,'image/jpeg');
		}
	}

	public function retornalxmlsubcategoria($id = null){
		$this->layout='';
		$categoria = $this->Categoria->find('all',array('conditions'=>array('Categoria.padre_id'=>$id),
																			'fields'=>array('Categoria.id','Categoria.descripcion')));
		$categoria[count($categoria)]['Categoria']['id']		= 0;
		$categoria[count($categoria)]['Categoria']['descripcion']='Todas';
		asort($categoria);
		$this->set(compact('categoria'));
	}

	public function beforeFilter(){
				parent::beforeFilter();
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
