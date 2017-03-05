<?php
class ClientesController extends AppController {

	var $name = 'Clientes';
	var $uses = array('Cliente','Movimiento','Provincia','Localidade','Departamento');
	var $components = array('Paginator','Session','Cimage');
	var $helpers = array('Html','Form','Time');

	public function index() {
		$this->layout = 'bootstrap3';
		$this->Cliente->recursive = 0;
		$this->paginate=array('limit' => 2,
						'page' => 1,
						'order'=>array('Cliente.nombre'=>'desc'),
						'conditions'=>'');

		$this->set('clientes', $this->paginate());
	}

	public function view($id = null) {
		$this->layout = 'bmodalbox';
		if (!$id) {
			$this->Session->setFlash(__('Cliente Invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		$js_funciones=array('view');
		$this->set('js_funciones',$js_funciones);
		$this->set('cliente', $this->Cliente->read(null, $id));
	}

	public function add() {
		$this->layout='bootstrap3';
		if (!empty($this->data)) {
			$this->Cliente->create();
				$this->request->data['Cliente']['tallercito_id']=$this->Session->read('tallercito_id');
				$this->request->data['Cliente']['user_id']=$this->Session->read('user_id');
				$result = $this->Cliente->GuardarCliente($this->request->data);
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash(__('No se pudo Guardar el Cliente ', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El Cliente no se pudo grabar. Intente nuevamente.', true));
			}
		}
	}

	public function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Cliente invalido', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			$this->request->data['Cliente']['documento']=str_replace('.', '', $this->request->data['Cliente']['documento']);;
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('Actualización de Datos del Cliente correcta', true));
				$this->redirect(array('controller' => 'users','action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar el Cliente. Por favor intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cliente->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Cliente Invalido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cliente->delete($id)) {
			$this->Session->setFlash(__('Cliente Borrado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('No se pudo borrar el Cliente', true));
		$this->redirect(array('action' => 'index'));
	}

	public function getclient($nro = null){
		$this->layout='';
		$documento = str_replace('.','',$nro);
		if(!empty($nro) && $nro <> 0){
			$clientes=$this->Cliente->find('all',array('conditions'=>array('Cliente.documento'=>$nro),
																'fields'=>array('Cliente.id','Cliente.documento','nomape','User.email',
																		'Cliente.telefono','Cliente.domicilio')));
		}
		if(empty($clientes)){
			$clientes=$this->Cliente->find('all',array('conditions'=>array('Cliente.id'=>$nro),
																	'fields'=>array('Cliente.id','Cliente.documento','nomape','User.email',
																			'Cliente.telefono','Cliente.domicilio')));
		}
		$this->set('clientes',$clientes);
	}

	public  function seleccionarcliente(){
		$this->layout = 'bmodalbox';
	}

	public function seleccionarclientemov(){
		$this->layout = 'bmodalbox';
	}

	public function seleccionarclienteventa(){
		$this->layout='bmodalbox';
	}

	public function listarclientes(){
			$this->layout = '';
			$ls_filtro = '1=1 ';
			if(!empty($this->request->data)){
				if($this->request->data['Cliente']['Documento']!= null &&
					$this->request->data['Cliente']['Documento']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.documento = '.str_replace('.', '', $this->request->data['Cliente']['Documento']);
				if($this->request->data['Cliente']['Nombre']!= null &&
					$this->request->data['Cliente']['Nombre']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.nombre like "%'.$this->request->data['Cliente']['Nombre'].'%"';
				if($this->request->data['Cliente']['Apellido']!= null &&
					$this->request->data['Cliente']['Apellido']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.apellido  like "%'.$this->request->data['Cliente']['Apellido'].'%"';
			}
			$clientes = $this->Cliente->find('all',array('conditions'=>$ls_filtro));
			$this->paginate=array('limit' => 6,
						'page' => 1,
						'order'=>array('Cliente.apellido,Cliente.nombre'=>'desc'),
						'conditions'=>array($ls_filtro,'Cuenta.tallercito_id'=>$this->Session->read('tallercito_id')),
						'fields'=>array('Cliente.id','Cliente.documento','Cliente.fechanac','Cliente.nombre','Cliente.apellido','Cuenta.id','Cliente.telefono','Cliente.domicilio'),
						'joins'=>array(array('table'=>'cuentas',
													'alias'=>'Cuenta',
													'type'=>'LEFT',
													'conditions'=>array('Cuenta.cliente_id=Cliente.id'))));
			$this->set('clientes', $this->paginate());
	}

	/*
	 * @funcion: permite grabar siempre el lugar dónde es llamado el objeto
	 * */
	public function beforeRender(){
			$this->Session->Write('LLAMADO_DESDE','clientes');
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
			/*Agregado provincia */
			if($this->params['action']=='add' ||
				$this->params['action']=='edit' ){
						$provincias = $this->Provincia->find('list',array('fields'=>array('Provincia.id','Provincia.nombre')));
						array_push($provincias, '');
						asort($provincias,2);
				$this->set(compact('provincias'));
				if($this->params['action']=='edit'){
					$localidades = $this->Localidade->find('list',array('fields'=>array('Localidade.id','Localidade.nombre'),'conditions'=>array('Localidade.departamento_id'=>$this->request->data['Cliente']['departamento_id'])));
					$departamentos = $this->Departamento->find('list',array('fields'=>array('Departamento.id','Departamento.nombre'),'conditions'=>array('Departamento.provincia_id'=>$this->request->data['Cliente']['provincia_id'])));
					$this->set(compact('localidades','departamentos'));
				}
			}
			parent::beforeRender();
	}

	public function editimage(){
		if ($this->request->is(array('post', 'put'))) {
				if ($this->Cliente->save($this->request->data)) {
					$this->Session->setFlash(__('Los Datos han sido guardado.'));
				} else {
					$clienteval = $this->Cliente->invalidFields();
					if(!empty($clienteval)){
						$this->Session->setFlash(__($clienteval['foto'][0]));
					}else{
						$this->Session->setFlash(__('No se pudo guardar los datos. Por favor, intente de nuevo.'));
					}
				}
		}
		$this->redirect(array('controller' => 'users','action'=>'edit',$this->request->data['Cliente']['user_id']));
	}

	public function mostrarfoto($id=null){
		//buffer
		$filename=WWW_ROOT."/files/img/".$id.'client'.'.png';
		if(!file_exists($filename)){
			$cliente = $this->Cliente->find("first",array('fields'=>
													array('Cliente.foto'),
													'conditions'=>array('Cliente.id'=>$id)));
			if(!empty($cliente)){
				//buffer the file
				$file = new File($filename,true,0644);
				$file->write(base64_decode($cliente['Cliente']['foto']),'wb',true);
				$file->close();
				$cimage = new CimageComponent(new ComponentCollection());
				$cimage->view(base64_decode($cliente['Cliente']['foto']),'jpg');
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

	public function clientedeuda(){
		$this->set('title_for_layout','Listado de Deudas de Clientes');

	}

	public function listarclientedeuda(){
			$this->layout = '';
			$ls_filtro = '1=1 ';
			if(!empty($this->request->data)){
				if($this->request->data['Cliente']['documento']!= null &&
					$this->request->data['Cliente']['documento']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.documento = '.str_replace('.', '', $this->request->data['Cliente']['documento']);
				if($this->request->data['Cliente']['nombre']!= null &&
					$this->request->data['Cliente']['nombre']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.nombre like "%'.$this->request->data['Cliente']['nombre'].'%"';
				if($this->request->data['Cliente']['apellido']!= null &&
					$this->request->data['Cliente']['apellido']!= '')
					$ls_filtro = $ls_filtro.' AND Cliente.apellido  like "%'.$this->request->data['Cliente']['apellido'].'%"';
			}
			//$clientes = $this->Cliente->find('all',array('conditions'=>$ls_filtro));
			$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('Cliente.apellido,Cliente.nombre'=>'desc'),
						'conditions'=>$ls_filtro,
						'fields'=>array('Cliente.id','Cliente.documento','Cliente.fechanac','Cliente.nombre','Cliente.apellido','Cuenta.id'),
						'joins'=>array(array('table'=>'cuentas',
													'alias'=>'Cuenta',
													'type'=>'LEFT',
													'conditions'=>array('Cuenta.cliente_id=Cliente.id'))));
			$clientes = $this->paginate();
			$i=0;
			foreach($clientes as $cliente){
				$saldo = $this->Movimiento->GetTotalCuenta($cliente['Cliente']['id']);
				if($saldo > 0){
					$clientes[$i]['Cliente']['saldo']=$saldo;
				}/*else{
					unset($clientes[$i]);
				}*/
				$i++;
			}
			$this->set('clientes', $clientes);
	}

	/*
	 * Function: exportar los datos de deuda a un cvs
	 * */
	public function exportdeudatcvs(){
		$this->layout = 'ajax';
		$this->response->download('clientedeuda-'.date('Y-m-d').'.cvs');
		$clientes = $this->Cliente->find('all',array('fields'=>array('Cliente.id','Cliente.documento',
																	'Cliente.nombre','Cliente.apellido')));
		$i=0;
		foreach($clientes as $cliente){
			$saldo = $this->Movimiento->GetTotalCuenta($cliente['Cliente']['id']);
			if($saldo > 0){
				$clientes[$i]['Cliente']['saldo']=$saldo;
			}else{
				unset($clientes[$i]);
			}
			$i++;
		}
		$this->set('clientes', $clientes);
		return;
	}
}
?>
