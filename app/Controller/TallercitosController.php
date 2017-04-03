<?php
App::uses('AppController', 'Controller');
/**
 * Tallercitos Controller
 *
 * @property Tallercito $Tallercito
 * @property PaginatorComponent $Paginator
 */
class TallercitosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Cimage');
	public $use = array('Tallercito','Provincia','Localidade','Departamento');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout','Datos del Taller');
		$this->Tallercito->recursive = 0;
		//$user_id = $this->Session->read('user_id');
		$this->paginate=array('limit' => 10,
						'page' => 1,
						//'order'=>array('username'=>'desc'),
						'conditions'=>array('Tallercito.id'=>$this->Session->read('tallercito_id')));
		$this->Tallercito->recursive = 0;
		$this->set('tallercitos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tallercito->exists($id)) {
			throw new NotFoundException(__('Invalid tallercito'));
		}
		$options = array('conditions' => array('Tallercito.' . $this->Tallercito->primaryKey => $id));
		$this->set('tallercito', $this->Tallercito->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Agregar Datos del Taller');
		$error = '';
		if ($this->request->is('post')) {
			if(!is_uploaded_file($this->data['Productimage']['imagen']['tmp_name'])){
				$error = __('El Archivo no puede ser importado',true);
			}else{
				//Cargamos la imagen en un blob
				$cimage = new CimageComponent(new ComponentCollection());
				/*imagen tamanio normal*/
				$fileData = $cimage->ImagenToBlob($this->request->data['Tallercito']['logotallercito']['tmp_name'],0,0);
				$this->request->data['Productimage']['logotallercito'] = $fileData;
				$this->Tallercito->create();
				if ($this->Tallercito->save($this->request->data)) {
					$this->Session->setFlash(__('Los Datos han sido guardados.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se pudo grabar los datos. Por favor, intente de nuevo.'));
				}
			}
		}
		$this->set('error',$error);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$id = $this->Session->read('tallercito_id');
		$this->set('title_for_layout','Actualizar Datos del Taller');
		if (!$this->Tallercito->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		if ($this->request->is(array('post', 'put'))) {
<<<<<<< HEAD
			if(!empty($data['Tallercito']['imglogotallercito']['tmp_name'])){
				$cimage = new CimageComponent(new ComponentCollection());
				/*imagen tamanio normal*/
				list($fileData,$file_npath) = $cimage->ImagenToBlob($this->request->data['Tallercito']['imglogotallercito']['tmp_name'],50,100,'BENJABIKE.jpg','');
=======
			if(!empty($this->request->data['Tallercito']['imglogotallercito']['tmp_name'])){
				$cimage = new CimageComponent(new ComponentCollection());
				/*imagen tamanio normal*/
				list($fileData,$file_npath) = $cimage->ImagenToBlob($this->request->data['Tallercito']['imglogotallercito']['tmp_name'],50,100,'TALLER_BANNER.jpg','');
>>>>>>> d1dd9254b21e573d5d9674487d0b9be918df744a
				if($fileData != -1){
					$this->request->data['Tallercito']['logotallercito'] = $fileData;
				}
			}

			if ($this->Tallercito->save($this->request->data)) {
				$this->Session->setFlash(__('Los Datos han sido actualizados.'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar los datos. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Tallercito.' . $this->Tallercito->primaryKey => $id/*,'user_id'=>$this->Session->read('user_id')*/));
			$this->request->data = $this->Tallercito->find('first', $options);
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
		$this->Tallercito->id = $id;
		if (!$this->Tallercito->exists()) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tallercito->delete()) {
			$this->Session->setFlash(__('Los Datos han sido borrado.'));
		} else {
			$this->Session->setFlash(__('No se pudo borrar los datos. Por favor, intente de nuevo.'));
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

		if($this->params['action']=='add' ||
			$this->params['action']=='edit' ){
					$provincias = $this->Tallercito->Provincia->find('list',array('fields'=>array('Provincia.id','Provincia.nombre')));
					array_push($provincias, '');
					asort($provincias,2);
			$this->set(compact('provincias'));
			if($this->params['action']=='edit'){
				$localidades = $this->Tallercito->Localidade->find('list',array('fields'=>array('Localidade.id','Localidade.nombre'),'conditions'=>array('Localidade.departamento_id'=>$this->request->data['Tallercito']['departamento_id'])));
				$departamentos = $this->Tallercito->Departamento->find('list',array('fields'=>array('Departamento.id','Departamento.nombre'),'conditions'=>array('Departamento.provincia_id'=>$this->request->data['Tallercito']['provincia_id'])));
				$this->set(compact('localidades','departamentos'));

			}
			$str_estadossino[0]='No';
			$str_estadossino[1]='Si';
			$this->set('str_estadossino',$str_estadossino);

		}
		parent::beforeRender();
	}

	public function mostrarimagen($id = null){
		$tallercitologo = $this->Tallercito->find("first",array('fields'=>
												array('Tallercito.logotallercito'),
												'conditions'=>array('Tallercito.id'=>$id)));
		if(!empty($tallercitologo)){
			$cimage = new CimageComponent(new ComponentCollection());
			$cimage->view($tallercitologo['Tallercito']['logotallercito'],'jpg');
		}
	}
}
