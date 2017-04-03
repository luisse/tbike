<?php
App::uses('AppController', 'Controller');
/**
 * Subtypeproducts Controller
 *
 * @property Subtypeproducts $Subtypeproducts
 * @property PaginatorComponent $Paginator
 */

class SubtypeproductsController extends AppController {

	public $name = 'Subtypeproducts';
	public $components = array('RequestHandler');
	public $uses = array('Subtypeproduct','Negocio');

/**
 * index method
 *
 * @return void
 */	
	public function index() {
		$this->set('title_for_layout',__('Administración Tipo de Subtipos',true));
		$this->Subtypeproduct->recursive = 0;
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('descripction'=>'asc'));				
		$this->Subtypeproduct->recursive = 0;
		$this->set('subtypeproducts', $this->paginate());
	}

/**
 * view method
 *
 * @return void
 */
	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid subtypeproduct', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subtypeproduct', $this->Subtypeproduct->read(null, $id));
	}
	
/**
 * add method
 *
 * @return void
 */
	public function add() {

		$this->set('title_for_layout',__('Alta de Subtipo de Productos',true));
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {
				$this->Subtypeproduct->create();
				$this->request->data['Subtypeproduct']['est'] = 1; //por defecto se encuentra habilitado
				$this->request->data['Subtypeproduct']['tiponegocio_id']=2;
				if ($this->Subtypeproduct->save($this->request->data)) {
					$this->Session->setFlash(__('El Subtipo fue dado de alta', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se puedo dar del alta el Subtipo. Por favor Intente de Nuevo.', true));
				}
			}
		}
	}
/**
 * edit method
 *
 * @return void
 */
	public function edit($id = null) {
		$this->set('title_for_layout',__('Modificación de Subtipo de Productos',true));
		if (!$this->Subtypeproduct->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			if (!empty($this->request->data)) {
				if ($this->Subtypeproduct->save($this->request->data)) {
					$this->Session->setFlash(__('Los Datos Fueron Actualizados', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se pudo actualizar el Subtipo . Por favor intented de Nuevo.', true));
				}
			}
		}else{
			if (empty($this->request->data)) {
				$options = array('conditions' => array('Subtypeproduct.' . $this->Subtypeproduct->primaryKey => $id));
				$this->request->data = $this->Subtypeproduct->find('first', $options);
			}
		}
	}

/**
 * delete method
 *
 * @return void
 */
	public function delete($id = null){
		$this->Subtypeproduct->id = $id;
		if (!$this->Subtypeproduct->exists()) {
			$this->Session->setFlash(__('Código de Subtipo Inválido', true));
			$this->redirect(array('action'=>'index'));		}
	
		if (!$id) {
			$this->Session->setFlash(__('Código de Subtipo Inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		try {		
			if ($this->Subtypeproduct->delete($id)) {
				$this->Session->setFlash(__('El subtipo fue borrado', true));
				$this->redirect(array('action'=>'index'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado.'));
		}			
		$this->redirect(array('action' => 'index'));
	}

/**
 * cargarsubtypeprodcvs method permite cargar los subtypos de productos desde un CVS
 *
 * @return void
 */	
	public function cargarsubtypeprodcvs(){
		$this->set('title_for_layout',__('Carga Masiva de Subtipos',true));
		if(!empty($this->request->data)){
			//validamos que el archivo sea del tipo string
			if(strstr($this->request->data['Subtypeproduct']['File']['type'],'application/octet-stream')){
				//cargamos el parseado de archivos CVS
				App::import("Vendor","parsecsv");
				//nuevo objeto cvs
				$cvs = new parseCSV();
				$cvs->auto($this->request->data['Subtypeproduct']['File']['tmp_name']);
				if(!empty($cvs->request->data)){
					//validamos si algún dato existe lo marcamos como malo
					$count = 0;
					$i = 0;
					foreach ($cvs->data as $datas){
						$count = $this->Subtypeproduct->find('count',
										array('conditions'=>
												array('Subtypeproduct.descripction'=>$datas['descripction'])));
						if($count > 0)
							$cvs->data[$i]['existe'] = 1;
						else
							$cvs->data[$i]['existe'] = 0;
						$i++;
					}
					$this->Session->Write('arrayprocesar',$cvs->data);
					$this->redirect(array('action'=>'procesarcvs'));
				}					
			}else{
				$this->set('error','El archivo ingresado no es válido. El formato debe ser un archivo tipo TXT');
			}
		}	
	}
	
/**
 * procesarcvs permite procesar los datos recuperados desde CVS
 *
 * @return void
 */		
	public function procesarcvs(){
		$this->set('title_for_layout',__('Carga Masiva de Subtipos',true));
		if(empty($this->request->data)){
			$data=$this->Session->read('arrayprocesar');
			$this->set('data',$data);
			if(!empty($data)){
				//validamos si algún dato existe lo marcamos como malo
				$count = 0;
				$i = 0;
				foreach ($data as $datas){
					$count = $this->Subtypeproduct->find('count',
									array('conditions'=>
											array('Subtypeproduct.descripction'=>$datas['descripction'])));
					if($count > 0)
						$data[$i]['existe'] = 1;
					else
						$data[$i]['existe'] = 0;
					$i++;
				}
				$this->set('data',$data);
			}
		}else{
			//guardamos las filas que no contienen ningún tipo de error
			foreach ($this->data as $datas){
				//contador para recorrer el array
				$i = 0;
				$filas = count($datas);
				for($i = 0;$i < $filas;$i++){
					//si existe en la DB no debe ser insertado de nuevo
					if($datas[$i]['existe'] == 1){
						unset($datas[$i]);
					}else{
						$datas[$i]['tiponegocio_id'] = 1;
						unset($datas[$i]['existe']);
					}
				}
			}
			$this->data['Subtypeproduct']=$datas;
			//Guardamos los datos
			$this->Subtypeproduct->Create();
			if ($this->Subtypeproduct->saveAll($this->data['Subtypeproduct'])) {
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se puedo dar del alta los Subtipos. Por favor Intente Nuevamente y Verifique el Archivo.',true));
				$this->set('error',__('No se puedo dar del alta los Subtipos. Por favor Intente Nuevamente y Verifique el Archivo.', true));
			}
		}
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
?>