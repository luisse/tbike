<?php
App::uses('AppController', 'Controller');
/**
 * Proveedores Controller
 *
 * @property Proveedore $Proveedore
 * @property PaginatorComponent $Paginator
 */
class ProveedoresController extends AppController {

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
		$this->Proveedore->recursive = 0;
		$this->set('proveedores', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Proveedore->exists($id)) {
			throw new NotFoundException(__('Invalid proveedore'));
		}
		$options = array('conditions' => array('Proveedore.' . $this->Proveedore->primaryKey => $id));
		$this->set('proveedore', $this->Proveedore->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Proveedore->create();
			$this->request->data['Proveedore']['tallercito_id']=$this->Session->read('tallercito_id');
			if ($this->Proveedore->save($this->request->data)) {
				$this->Session->setFlash(__('El Registro a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Registro no se pudo grabar. Por favor, intente de nuevo.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Proveedore->exists($id)) {
			$this->Session->setFlash(__('Invalid proveedore'));
			return $this->redirect(array('action'=>'index'));
		}
		$count = $this->Proveedore->find('count',array('conditions'=>array('Proveedore.id'=>$id,'Proveedore.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if($count > 0){
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Proveedore->save($this->request->data)) {
					$this->Session->setFlash(__('El proveedore a sido guardado.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('El proveedore no se pudo guardar. Por favor, intente de nuevo.'));
				}
			} else {
				$options = array('conditions' => array('Proveedore.' . $this->Proveedore->primaryKey => $id));
				$this->request->data = $this->Proveedore->find('first', $options);
			}
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
		$this->Proveedore->id = $id;
		if (!$this->Proveedore->exists()) {
			$this->Session->setFlash(__('Invalid proveedore'));
			return $this->redirect(array('action'=>'index'));
		}
		$count = $this->Proveedore->find('count',array('conditions'=>array('Proveedore.id'=>$id,'Proveedore.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if($count > 0){
			if ($this->Proveedore->delete()) {
				$this->Session->setFlash(__('El proveedore a sido borrado.'));
			} else {
				$this->Session->setFlash(__('El proveedore no se pudo borrar. Por favor, intente de nuevo.'));
			}
		}
			return $this->redirect(array('action' => 'index'));
	}
/**
 * autocompletarpv method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function autocompletarpv($buscar = null){
		$this->layout ='';
		$proveedores = $this->Proveedore->find('all',array('conditions'=>array('Proveedore.tallercito_id'=>$this->Session->read('tallercito_id'),
																							'Upper(Proveedore.denominacion) like Upper("%'.$buscar.'%")'),
																							'fields'=>array('Proveedore.id','Proveedore.denominacion')
																							)
												);
		$this->set(compact('proveedores'));
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
	
	/*		function autocompletar($buscar){
			$this->layout='salidajson';
			$arrayElementos=array();
			$respuesta=array();
			$result=$this->Cliente->query('SELECT id,concat(nombre,", ",apellido) as nomap 
									FROM clientes 
									HAVING Upper(nomap) like Upper("%'.$buscar.'%")');
			$i=0;
			foreach($result as $resultado){
				array_push($arrayElementos, new ElementoAutocompletar(utf8_encode($resultado[0]["nomap"]),utf8_encode($resultado[0]["nomap"])));
				$respuesta[$i]['label']=utf8_encode($resultado[0]["nomap"]);
				$respuesta[$i]['value']=$resultado['clientes']["id"];
			}
			$this->set('respuesta',$arrayElementos);
		}
		
<?php 
	echo json_encode($respuesta);
?>
	JS
	$("#SaleNombrecliente").autocomplete({
		source:function(request, response){ 
			$.ajax({
				url: "/clientes/autocompletar/"+request.term,
				dataType: "json",
				success: function(data) {
					response(data);
				}
			});
		
		},
		minLength    : 1,
		change: function( event, ui ) {
			recuperaridcliente();
		}
	});
	
function recuperaridcliente(){
	var nombreapellido = jQuery('<div />').text($("#SaleNombrecliente").val()).html() 
	var url='/clientes/retornarclientexml/'+nombreapellido
	if(nombreapellido != ''){
		$.ajax({type:'GET',
	          url:url,
	          datatype:'xml',
	          success:function(data){
	                  var xml;
	                  var options = '';
	                  xml = data;
	                  $(xml).find('datos').each(function(){
	                	  		var li_id = $(this).find('id').text()
	                	  		$('#SaleClienteId').val(li_id)
	                  });//close each
	          },
	          error:function(xtr,fr,ds){
	                  mensaje('No se pudieron cargar los datos del Cliente. Verifique la conexión al server','Cliente','')
	          }
	  })//close ajax
	}else{
		$('#SaleClienteId').val('')
	}
}		
		
		*
		*/

}
