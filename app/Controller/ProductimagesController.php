<?php
App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
class ProductimagesController extends AppController {

	public $name = 'Productimages';
	public $components = array('RequestHandler','Session','Cimage');
	public $uses = array('Productimage','Productsdetail');

	public function index($product_id = null) {
		$this->set('title_for_layout',__('Fotos del Producto'));
		if(!empty($product_id)){
			$this->Session->write('product_id',$product_id);
		}else{
			$product_id = $this->Session->read('product_id');
		}

		$this->paginate=array('limit' => 10,
						'page' 		=> 1,
						'conditions'=>array('Productimage.product_id'=>$product_id),
						'url' 				=> $this->passedArgs,
						'joins'			=>array(array('table'=>'products',
															'alias'=>'Product',
															'type'=>'LEFT',
															'conditions'=>array('Product.id = Productimage.product_id',
																							'Product.tallercito_id = '.$this->Session->read('tallercito_id')
																							)
															)
														)
												);

		$this->set('productimages', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Código de imagen inválido', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('productimage', $this->Productimage->read(null, $id));
	}

	public function add() {
		$this->set('title_for_layout',__('Nueva Foto'));
		//si llegan datos los procesamos
		if ($this->request->is('post')) {
			if(!empty($this->request->data)){
				$this->request->data['Productimage']['product_id'] = $this->Session->read('product_id');
				$this->Productimage->create();
				print_r($this->request->data);
				if ($this->Productimage->save($this->request->data)) {
					$this->Session->setFlash(__('La Imagen fue Guardada', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('La Imagen no pudo ser guardada. Por favor, Intente de nuevo.', true);
				}
			}
		}
	}

	public function edit($id = null) {
		$this->set('title_for_layout',__('Actualizar Foto',true));
		if (!$this->Productimage->exists($id)) {
			$this->Session->setFlash(__('Código Invalido'));
			$this->redirect(array('action'=>'index'));
			return;
		}
		if ($this->request->is(array('post', 'put'))) {
			if (!empty($this->request->data)) {
				if ($this->Productimage->save($this->data)) {
					$this->Session->setFlash(__('La Imagen fue actualizada', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('No se pudo actualizar la Imagen. Por favor, Intente de nuevo.', true));
				}
			}
		}else{
			if (empty($this->request->data)) {
				$options = array('conditions' => array('Productimage.' . $this->Productimage->primaryKey => $id));
				$this->request->data = $this->Productimage->find('first', $options);
			}
		}
	}

	public function delete($id = null) {
		$this->Productimage->id = $id;
		if (!$this->Productimage->exists()) {
			$this->Session->setFlash(__('Código de Imagen Inválido', true));
			$this->redirect(array('action'=>'index'));
		}
		
		try{
			if ($this->Productimage->delete($id)) {
				$this->Session->setFlash(__('La Imagen fue borrada', true));
				$this->redirect(array('action'=>'index'));
			}
		}catch(Exception $e){
			$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado.'));
		}
		$this->redirect(array('action' => 'index'));
	}

	/*
	 * Funcion: permite realizar la carga de las imagenes en el servidor
	 * */
	public function cargarimagen(){
			$this->layout = '';
			$result = '';
			$result = 'Datos: '.$_FILES['userfile']['name'];
			if(!empty($_FILES)){
				$carpetaimagenes ='imgproducts/'.$this->Session->read('negocio_id').'/'.
				$this->Session->read('productsdetails_id').'/';
					$fileok = $this->uploadFiles($carpetaimagenes,$_FILE);
					if(array_key_exists('urls',$fileok)){
						$result = __('Imagen Cargada Satisfactoriamente', true);
					}else{
						$result= __('Error al Cargar la Imagen'.$fileok['errors'][0], true);
					}
			}
			$this->set('result',$result);
	}

	public function mostrarimagenthumbs($id = null){
		$this->layout='';
		$noimage='';
		$filename=WWW_ROOT."/files/img/".$id.'mgimin'.$this->Session->read('tallercito_id').'.png';
		if(!file_exists($filename)){
			$file = new File($filename,true,0644);
			$productimage = $this->Productimage->find("first",array('fields'=>
													array('Productimage.type',
													'Productimage.thumbs'),
													'conditions'=>array('Productimage.id'=>$id),
													'order'=>array('Productimage.type'=>'desc')));
			if(empty($productimage)){
				$productimage = $this->Productimage->find("first",array('fields'=>
													array('Productimage.type',
													'Productimage.thumbs'),
													'conditions'=>array('Productimage.product_id'=>$id),
													'order'=>array('Productimage.type'=>'desc')));

			}

			/*$datos = $this->Productimage->read();*/
			if(!empty($productimage)){
				$cimage = new CimageComponent(new ComponentCollection());
				$file->write($productimage['Productimage']['thumbs'],'wb',true);
				$file->close();
				$cimage->view($productimage['Productimage']['thumbs'],$productimage['Productimage']['type']);
			}else{
				$file->close();
				$noimage='../img/noimage.png';
			}

		}else{
			$file = new File($filename);
			$file->open('r',true);
			$result = $file->read($filename,'rb',true);
			$file->close();
			$cimage = new CimageComponent(new ComponentCollection());
			$cimage->view($result,'image/jpeg');
		}
		$this->set('noimage',$noimage);
	}

	public function mostrarimagencompleta($id = null){
		$this->layout='';
		$filename=WWW_ROOT."/files/img/".$id.'mgi'.$this->Session->read('tallercito_id').'.png';
		//echo $filename;
		if(!file_exists($filename)){
			$file = new File($filename,true,0644);
			$productimage = $this->Productimage->find("first",array('fields'=>
												array('Productimage.type',
												'Productimage.imagen'),
												'conditions'=>array('Productimage.id'=>$id),
												'order'=>array('Productimage.type'=>'desc')));
			if(empty($productimage)){
				$productimage = $this->Productimage->find("first",array('fields'=>
													array('Productimage.type',
													'Productimage.imagen'),
													'conditions'=>array('Productimage.product_id'=>$id),
													'order'=>array('Productimage.type'=>'desc')));

			}
			if(!empty($productimage)){
				$cimage = new CimageComponent(new ComponentCollection());
				$file->write($productimage['Productimage']['imagen'],'wb',true);
				$file->close();
				$cimage->view($productimage['Productimage']['imagen'],$productimage['Productimage']['type']);


			}else{
				$file->close();
				echo 'No se pudo Cargar la imagen';
			}

			$this->set('filename',$filename);
		}else{
			$file = new File($filename);
			$file->open('r',true);
			$result = $file->read($filename,'rb',true);
			$file->close();
			$cimage = new CimageComponent(new ComponentCollection());
			$cimage->view($result,'image/jpeg');
			//$this->set('filename',$filename);
		}
	}

	public function viewpictures($id = null){
		$this->layout = 'imageview';
		$productimages = array();
		$productimages = $this->Productimage->find("all",array('fields'=>
												array('Productimage.id',
												'Productimage.description'),
												'conditions'=>array('Productimage.productsdetail_id'=>$id),
												'order'=>array('Productimage.type'=>'desc')));
		$this->set('productimages',$productimages);
	}

	function isgd(){

	}

	public function beforeRender(){
		$str_estado[0]='No';
		$str_estado[1]='Si';
		$this->set(compact('str_estado'));
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
