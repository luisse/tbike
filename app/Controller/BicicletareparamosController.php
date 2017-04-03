<?php
App::uses('AppController', 'Controller');
/**
 * Bicicletareparamos Controller
 *
 * @property Bicicletareparamo $Bicicletareparamo
 * @property PaginatorComponent $Paginator
 */
class BicicletareparamosController extends AppController {
	var $uses=array('Bicicletareparamo','Cliente');
/**
 * Components
 *
 * @var array
 */
	var $components=array('RequestHandler','Paginator');
	var $helpers=array('Time');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout','Ingreso Taller');
	}

	public function listbicicletareparamos(){
		$this->Bicicletareparamo->recursive = 0;
		$this->layout = '';
		$ls_filtronotexist='';
		$ls_filtro = '1 = 1 AND Cliente.tallercito_id ='.$this->Session->read('tallercito_id');
		if(!empty($this->request->data)){

				if($this->request->data['Cliente']['documento']!= null &&
					$this->request->data['Cliente']['documento']!= '')
					$ls_filtronotexist = $ls_filtronotexist.' AND Cliente.documento = '.str_replace('.', '', $this->request->data['Cliente']['documento']);
				if($this->request->data['Cliente']['nombre']!= null &&
					$this->request->data['Cliente']['nombre']!= '')
					$ls_filtronotexist = $ls_filtronotexist.' AND Cliente.nombre like "%'.$this->request->data['Cliente']['nombre'].'%"';
				if($this->request->data['Cliente']['apellido']!= null &&
					$this->request->data['Cliente']['apellido']!= '')
					$ls_filtronotexist = $ls_filtronotexist.' AND Cliente.apellido  like "%'.$this->request->data['Cliente']['apellido'].'%"';
		}
		$ls_filtro = $ls_filtro.$ls_filtronotexist;
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('Cliente.nomape'=>'ASC','fechaingreso'=>'ASC'),
						'conditions'=>$ls_filtro);
		$this->set('bicicletareparamos', $this->Paginator->paginate());
	}

	public function servicesclientes(){
		$this->set('title_for_layout','Service Realizados al Cliente');

	}

	public function listbicicletasreparadas(){
		$this->Bicicletareparamo->recursive = 0;
		$this->layout = '';
		$cliente_id = $this->Session->read('cliente_id');
		$ls_filtro = '1 = 1';
		if($this->Session->read('tipousr') == 2){
			if(!empty($cliente_id) && $cliente_id != 'undefined')
				$ls_filtro = '1 = 1 AND Bicicletareparamo.cliente_id ='.$cliente_id;
		}

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

		$ls_filtro = $ls_filtro;
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('id'=>'DESC','fechaingreso'=>'DESC'),
						'conditions'=>$ls_filtro);
		$this->set('bicicletareparamos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bicicletareparamo->exists($id)) {
			throw new NotFoundException(__('Invalid bicicletareparamo'));
		}
		$options = array('conditions' => array('Bicicletareparamo.' . $this->Bicicletareparamo->primaryKey => $id));
		$this->set('bicicletareparamo', $this->Bicicletareparamo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Nuevo Ingreso de Bicicleta a Taller');
		if ($this->request->is('post')) {
			$this->Bicicletareparamo->create();
			/*
			* Determina el estado, en espera 1, en taller 2, finalizada 3, en espera de confirmación repuesto 5,6 Cancelado
			*/
			$this->request->data['Bicicletareparamo']['estado'] = 0;
			$this->request->data['Bicicletareparamo']['entregada'] = 0;
			$this->request->data['Bicicletareparamo']['user_id']=$this->Session->read('user_id');
			if ($this->Bicicletareparamo->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('El registro a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El registro no se pudo grabar. Por favor, intente de nuevo.'));
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
		$this->set('title_for_layout','Actualizar Ingreso de Bicicleta a Taller');
		/*Seguridad UPDATE*/
		$registros = $this->Bicicletareparamo->find('count',array('conditions'=>array('Bicicletareparamo.id'=>$id,'Cliente.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if($registros > 0){
			if (!$this->Bicicletareparamo->exists($id)) {
				throw new NotFoundException(__('Identificador Invalido'));
			}
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Bicicletareparamo->saveAssociated($this->request->data)) {
					$this->Session->setFlash(__('El registro a sido guardado.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('El registro no se pudo guardar. Por favor, intente de nuevo.'));
				}
			} else {
				$options = array('conditions' => array('Bicicletareparamo.' . $this->Bicicletareparamo->primaryKey => $id));
				$this->request->data = $this->Bicicletareparamo->find('first', $options);
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
		/*Seguridad DELETE*/
		$registros = $this->Bicicletareparamo->find('count',array('conditions'=>array('Bicicletareparamo.id'=>$id,'Cliente.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if($registros > 0){
			$this->Bicicletareparamo->id = $id;
			if (!$this->Bicicletareparamo->exists()) {
				throw new NotFoundException(__('Identificador Invalido'));
			}
			try {
					if ($this->Bicicletareparamo->delete()) {
						$this->Session->setFlash(__('El registro a sido borrado.'));
					} else {
						$this->Session->setFlash(__('El registro no se pudo borrar. Por favor, intente de nuevo.'));
					}
				}catch(Exception $e){
					$this->Session->setFlash(__('Error: No se puede eliminar el registro. Atributo asignado a operación'));
				}
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeRender(){
		// For CakePHP 2.0
		//$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		 //$this->Auth->allow();
		 $str_estadossino[0]='NO';
		 $str_estadossino[1]='SI';
		 $str_estados = array('0'=>'Espera','1'=>'En Taller','2'=>'Confirmar Cliente','3'=>'Arreglo Finalizado','4'=>'Arreglo Cancelado');
		$this->set(compact('str_estadossino','str_estados'));
		 /****if($this->params['action'] == 'detalletaller'){

		 }else{
			//$this->set('str_estados',$str_estados);
			$this->set(compact('str_estadossino','str_estados'));
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
		}***/
			parent::beforeRender();
	}

	public function tallerlistarbicicletas(){
		$this->set('title_for_layout','Bicicletas a Reparar');
		$this->Session->write('CALLREMOTE','tallerlistarbicicletas');
	}

	public function listadobicicletarepar(){
		$this->layout='';
		$this->Bicicletareparamo->recursive = 0;
		$this->layout = '';
		$ls_filtronotexist='';
		$ls_filtro = '1 = 1 AND Cliente.tallercito_id = '.$this->Session->read('tallercito_id');
		if(!empty($this->request->data)){
				if($this->request->data['Cliente']['documento']!= null &&
					$this->request->data['Cliente']['documento']!= '')
					$ls_filtronotexist = $ls_filtronotexist.' AND Cliente.documento = '.str_replace('.', '', $this->request->data['Cliente']['documento']);
				if($this->request->data['Cliente']['nombre']!= null &&
					$this->request->data['Cliente']['nombre']!= '')
					$ls_filtronotexist = $ls_filtronotexist.' AND Cliente.nombre like "%'.$this->request->data['Cliente']['nombre'].'%"';
				if($this->request->data['Cliente']['apellido']!= null &&
					$this->request->data['Cliente']['apellido']!= '')
					$ls_filtronotexist = $ls_filtronotexist.' AND Cliente.apellido  like "%'.$this->request->data['Cliente']['apellido'].'%"';
				if($this->request->data['Bicicletareparamo']['nrodecuadro']!='' && $this->request->data['Bicicletareparamo']['nrodecuadro'] != null)
					$ls_filtro = $ls_filtro." AND Bicicleta.nrocuadro = '".$this->request->data['Bicicletareparamo']['nrodecuadro']."'";
		}
		if($this->request->data['Bicicletareparamo']['estado'] == 5)
			$ls_estados = ' AND Bicicletareparamo.estado in(0,1,2) ';
		else
			$ls_estados = ' AND Bicicletareparamo.estado = '.$this->request->data['Bicicletareparamo']['estado'];

		$ls_filtro = $ls_filtro.$ls_estados.$ls_filtronotexist;
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('fechaingreso,id'=>'DESC'),
						'conditions'=>$ls_filtro,
						'fields'=>array('*','(SELECT COUNT(*) FROM mensajes WHERE mensajes.bicicleta_id = Bicicletareparamo.bicicleta_id and mensajes.tipomen_id = 2 and (mensajes.confirmadocliente = 0 OR mensajes.confirmadocliente IS NULL)) AS cantmensajes'));
		$this->set('bicicletareparamos', $this->Paginator->paginate());
	}


	public function cambiarestado($id = null,$estado = null){
		$this->layout='';
		$error='';
		if (!$this->Bicicletareparamo->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		$options = array('conditions' => array('Bicicletareparamo.' . $this->Bicicletareparamo->primaryKey => $id));
		$this->request->data = $this->Bicicletareparamo->find('first', $options);
		//Ingreso en taller
		if($estado == 1)
			$this->request->data['Bicicletareparamo']['fechaentaller'] = date('Y-m-d H:i:s');
		if($estado == 3)
			$this->request->data['Bicicletareparamo']['fechasaltaller'] = date('Y-m-d H:i:s');

		$this->request->data['Bicicletareparamo']['user_id'] = $this->Session->read('user_id');
		$this->request->data['Bicicletareparamo']['estado']=$estado;
		if ($this->Bicicletareparamo->Save($this->request->data)) {
			$error='';
		} else {
			$error = __('El registro no se pudo actualizar. Por favor, intente de nuevo.');
		}
		$this->set('error',$error);
	}

	public function marcanentregado($id = null){
		$this->layout='';
		if (!$this->Bicicletareparamo->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}
		$error='';
		$options = array('conditions' => array('Bicicletareparamo.' . $this->Bicicletareparamo->primaryKey => $id));
		$this->request->data = $this->Bicicletareparamo->find('first', $options);
		$this->request->data['Bicicletareparamo']['entregada'] = 1;
		if ($this->Bicicletareparamo->Save($this->request->data)) {
			$error='';
		} else {
			$error = __('El registro no se pudo actualizar. Por favor, intente de nuevo.');
		}
		$this->set('error',$error);
	}

	public function bicicletareparamocalendario($llamdodesde=null){
		$this->set('title_for_layout','Calendario de Taller');
		$this->set('llamadodesde',$llamdodesde);
	}

	public function jsonretornocalendario(){
		$this->layout='';
		$bicicletareparamos = $this->Bicicletareparamo->find('all',array(
								'conditions'=>array('Bicicletareparamo.estado in(0,1,2)',
										'Bicicletareparamo.fechaingreso >='=>$this->Bicicletareparamo->formatDate($this->request->data['fechadesde']),
										'Bicicletareparamo.fechaingreso <='=>$this->Bicicletareparamo->formatDate($this->request->data['fechasta']))
								));
		$this->set('bicicletareparamos',$bicicletareparamos);
	}


	public function vertotalservicemes(){
		$this->set('title_for_layout','Importe total de Services Anual');
	}

	/*
	* Funcion: permite recuperar por medio del JSON el total de lo facturado en los meses para el año
	*/
	public function totalservicemes($anio = null){
		$this->layout= null;
		$categoria = array('Mes');
		$categoria[] = __('Ventas del Mes');
		/*MESES DEL AÑO*/
		$enero = array('ENERO');
		$febrero = array('FEBRERO');
		$marzo = array('MARZO');
		$abril = array('ABRIL');
		$mayo = array('MAYO');
		$junio = array('JUNIO');
		$julio = array('JULIO');
		$agosto = array('AGOSTO');
		$septiembre = array('SEPTIEMBRE');
		$octubre = array('OCTUBRE');
		$noviembre = array('NOVIEMBRE');
		$diciembre = array('DICIEMBRE');
		$bicicletareparamos=$this->Bicicletareparamo->find('all',array('conditions'=>array('Bicicletareparamo.estado'=>3,'YEAR(Bicicletareparamo.fechaingreso)'=>$anio),
											'fields'=>array('DATE_FORMAT(Bicicletareparamo.fechaingreso,"%m/%Y") as anio',
													'ROUND(SUM(Bicicletareparamo.importetotal),2) as totalsale',
													'MONTH(Bicicletareparamo.fechaingreso) as mes'),
											'order'=>array('Bicicletareparamo.fechaingreso ASC'),
											'group'=>array('anio')));
		foreach($bicicletareparamos as $bicicletareparamo){
			switch($bicicletareparamo[0]['mes']){
			 case 1:
				$enero[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 2:
				$febrero[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 3:
				$marzo[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 4:
				$abril[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 5:
				$mayo[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 6:
				$junio[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 7:
				$julio[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 8:
				$agosto[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 9:
				$septiembre[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 10:
				$octubre[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 11:
				$noviembre[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			 case 12:
				$diciembre[]=(double)$bicicletareparamo[0]['totalsale'];
			 break;
			}
		}
		//ENVIAMOS LOS DATOS A LA VISTA
		$this->set(compact('categoria','enero',
							'febrero','marzo','abril','mayo','junio',
							'julio','agosto','septiembre','octubre',
							'noviembre','diciembre'));

	}

	public function imprimircomprobante($id = null){
		$this->layout='pdf';
		$bicicletareparamos = $this->Bicicletareparamo->find('all',array('conditions'=>array('Bicicletareparamo.id'=>$id)));
		//recuperamos la IP del servidor
		Configure::load('appconf');
		$ipaddres = Configure::read('IPSERVER');
		$this->set('ipaddres',$ipaddres);
		$this->set('bicicletareparamos',$bicicletareparamos);
	}

	public function imprimiringresotaller($id = null){
		$this->layout='pdf';
		$Bicicletareparamorepuesto=ClassRegistry::init('Bicicletareparamorepuesto');
		$bicicletareparamos = $this->Bicicletareparamo->find('first',array('conditions'=>array('Bicicletareparamo.id'=>$id,
																								'Bicicletareparamo.estado in(0,1,2)',
																								'Cliente.tallercito_id = '.$this->Session->read('tallercito_id'))));

		$bicicletareparamorepuestos = $Bicicletareparamorepuesto->find('all',array('conditions'=>array('bicicletareparamo_id'=>$id)));
		$this->set('bicicletareparamos',$bicicletareparamos);
		$this->set('bicicletareparamorepuestos',$bicicletareparamorepuestos);
	}

	public function imprimircomprobantepago($id = null){
		$this->layout='pdf';
		$Bicicletareparamorepuesto=ClassRegistry::init('Bicicletareparamorepuesto');
		$bicicletareparamos = $this->Bicicletareparamo->find('first',array('conditions'=>array('Bicicletareparamo.id'=>$id)));
		$bicicletareparamorepuestos = $Bicicletareparamorepuesto->find('all',array('conditions'=>array('bicicletareparamo_id'=>$id)));
		//Buscamos el tipo de movimiento que se realizo en el sistema solo en caso de existir mostramos el tipo de movimiento
		//la bicicleta debe estar en estado entregado
		$totaldeuda = 0;
		$tipomovimientodesc='';
		$tipomovimiento=0;
		if($bicicletareparamos['Bicicletareparamo']['entregada'] == 1){
			$Movimiento = ClassRegistry::init('Movimiento');
			$movimiento = $Movimiento->find('first',array('conditions'=>array('Movimiento.comprobanteint'=>$bicicletareparamos['Bicicletareparamo']['id'],
																															'Movimiento.tallercito_id'=>	$this->Session->read('tallercito_id'))
																															)
																			);
			if(!empty($movimiento)){
				//movimiento de credito
				$tipomovimiento = $movimiento['Tipomovimiento']['id'];
				$tipomovimientodesc = $movimiento['Tipomovimiento']['descripcion'];

				if($movimiento['Tipomovimiento']['id'] == 2){

					$Movimiento = ClassRegistry::init('Movimiento');
					$totaldeuda = $Movimiento->GetTotalCuenta($movimiento['Movimiento']['cuenta_id']);
				}
			}
		}

		$this->set('totaldeuda',$totaldeuda);
		$this->set('tipomovimientodesc',$tipomovimientodesc);
		$this->set('tipomovimiento',$tipomovimiento);
		$this->set('bicicletareparamos',$bicicletareparamos);
		$this->set('bicicletareparamorepuestos',$bicicletareparamorepuestos);
	}
	/*
	* Funcion: permite visualizar los detalles de ingresos a taller
	*/
	public function detalletaller($id = null,$encrypt = null){
		$this->layout='usersadd';
		if (!$this->Bicicletareparamo->exists($id)) {
			throw new NotFoundException(__('Identificador Invalido'));
		}else{
			$options = array('conditions' => array('Bicicletareparamo.' . $this->Bicicletareparamo->primaryKey => $id,
																											'Bicicletareparamo.estado in(0,1,2)',
																											'md5(Bicicleta.nrocuadro) = "'.$encrypt.'"'));
			$this->request->data = $this->Bicicletareparamo->find('first', $options);
		}
	}

	public function tiemposreparestimado(){
		$this->set('title_for_layout','Tiempos Promedios de reparación');
		$User = ClassRegistry::init('User');
		$users = $User->find('list',array('fields'=>array('User.id','User.username'),
																							'conditions'=>array('User.group_id in(1,3)')));

		//array_push($users,'');
		asort($users,2);
		$users[0]='Todos';
		$this->set(compact('users'));
	}

	public function listtiemposreparaestimado(){
		$this->layout='';
		App::uses('CakeTime', 'Utility');
		$filtros = CakeTime::daysAsSql($this->Bicicletareparamo->formatDate($this->request->data['Bicicletareparamo']['fecdesde']),
																	$this->Bicicletareparamo->formatDate($this->request->data['Bicicletareparamo']['fechasta']),
																	'fechaentaller');
		//filtro por usuario tipo administrador u mecanico
		if($this->Session->read('user_id') != 0){
			$filtros = $filtros.' AND Bicicletareparamo.user_id = '.$this->Session->read('user_id');
		}
		if($this->request->data['Bicicletareparamo']['detallereparacion'] != '' &&
			$this->request->data['Bicicletareparamo']['detallereparacion'] != null)
			$filtros = $filtros." AND Upper(Bicicletareparamo.detallereparacion) like '%".$this->request->data['Bicicletareparamo']['detallereparacion']."%'";

		$bicicletareparamos=$this->Bicicletareparamo->find('all',array('conditions'=>$filtros,
																								'fields'=>array('Bicicletareparamo.id','Bicicletareparamo.fechaingreso',
																														'Bicicletareparamo.detallereparacion',
																														'TIMESTAMPDIFF(SECOND,fechaentaller,fechasaltaller) DIV 86400 As Dias',
																														'(TIMESTAMPDIFF(SECOND,fechaentaller,fechasaltaller) % 86400) DIV 3600 AS Horas',
																														'((TIMESTAMPDIFF(SECOND,fechaentaller,fechasaltaller) % 86400)%3600) DIV 60 AS Minutos',
																														'((TIMESTAMPDIFF(SECOND,fechaentaller,fechasaltaller) % 86400)%3600) & 60 AS Segundos',
																														'Bicicletareparamo.cliente_id',
																														'Cliente.apellido',
																														'Cliente.nombre',
																														'User.username'),
																								'order'=>array('Bicicletareparamo.fechaingreso DESC')
																								)
																					);
		$this->set('bicicletareparamos',$bicicletareparamos);
	}

	public function bicicletasentaller($estado = null){
		$this->layout = '';
		$cliente_id = $this->Session->read('cliente_id');
		$filter=array();
		if(!empty($cliente_id) && $this->Session->read('tipousr') == 2) $filter = array('Bicicletareparamo.cliente_id'=>$this->Session->read('cliente_id'));
		$bicicletareparamos = $this->Bicicletareparamo->find('all',array('conditions'=>array('Bicicletareparamo.estado'=>$estado,$filter)));
		$this->set('bicicletareparamos',$bicicletareparamos);

	}

	public function bicicletasentrega(){
		$this->set('title_for_layout',__('Entregas de Bicicleta'));
	}

	public function listbicicletasentrega(){
		$this->Bicicletareparamo->recursive = 0;
		$this->layout = '';
		$ls_filtronotexist='';
		$ls_filtro = '1 = 1 AND Cliente.tallercito_id ='.$this->Session->read('tallercito_id');
		$ls_filtro = $ls_filtro.' AND Bicicletareparamo.estado = 3';
		$ls_filtro = $ls_filtro.' AND Bicicletareparamo.entregada = 0';
		if(!empty($this->request->data)){

				if($this->request->data['Cliente']['documento']!= null &&
					$this->request->data['Cliente']['documento']!= '')
					$ls_filtronotexist = $ls_filtronotexist.' AND Cliente.documento = '.str_replace('.', '', $this->request->data['Cliente']['documento']);
				if($this->request->data['Cliente']['nombre']!= null &&
					$this->request->data['Cliente']['nombre']!= '')
					$ls_filtronotexist = $ls_filtronotexist.' AND Cliente.nombre like "%'.$this->request->data['Cliente']['nombre'].'%"';
				if($this->request->data['Cliente']['apellido']!= null &&
					$this->request->data['Cliente']['apellido']!= '')
					$ls_filtronotexist = $ls_filtronotexist.' AND Cliente.apellido  like "%'.$this->request->data['Cliente']['apellido'].'%"';
		}

		$ls_filtro = $ls_filtro.$ls_filtronotexist;
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('id'=>'DESC','fechaingreso'=>'DESC'),
						'conditions'=>$ls_filtro);
		$this->set('bicicletareparamos', $this->Paginator->paginate());
	}
	/*
	* Funcion: permite ve la ubicación en el mapa de una referencia
	*/
	public function mapsbicicletaentrega($id){
		$this->set('title_for_layout','Mapa Ubicación de Entrega');
		$tallercito = $this->Session->read('tallercito');
		$bicicletareparamos=array();
		if(!empty($id)){
			$bicicletareparamos = $this->Bicicletareparamo->find('first',array('conditions'=>array('Cliente.tallercito_id'=>$this->Session->read('tallercito_id'),
																		'Bicicletareparamo.estado in(3,0)',
																		'Bicicletareparamo.id'=>$id)));
		}
		$this->set('bicicletareparamos',$bicicletareparamos);
		$this->set('provincia',$tallercito['Provincia']['nombre']);
	}

	/*
	 * Function: permite ver la ubicacion de todas las entregas
	 * */
	public function mapbicicletaentregaall(){
		$this->set('title_for_layout','Mapa Ubicación de Entregas');
		$tallercito = $this->Session->read('tallercito');
		$bicicletareparamos=array();
		$this->Bicicletareparamo->unbindModel(
				array('belongsTo' => array('Cliente')));
		$bicicletareparamos = $this->Bicicletareparamo->find('all',
								array('conditions'=>array('Cliente.tallercito_id'=>$this->Session->read('tallercito_id'),
										'Bicicletareparamo.estado in(3,0)',
										'Bicicletareparamo.enviodom'=>1),
									'joins'=>array(
											array('table'=>'clientes',
													'alias'=>'Cliente',
													'type'=>'LEFT',
													'conditions'=>array('Cliente.id = Bicicletareparamo.cliente_id')),
											array('table'=>'localidades',
												'alias'=>'Localidade',
												'type'=>'LEFT',
												'conditions'=>array('Localidade.id = Cliente.localidade_id')),
											array('table'=>'departamentos',
													'alias'=>'Departamento',
													'type'=>'LEFT',
													'conditions'=>array('Departamento.id = Cliente.departamento_id')),
											array('table'=>'provincias',
													'alias'=>'Provincia',
													'type'=>'LEFT',
													'conditions'=>array('Provincia.id = Cliente.provincia_id'))
									),
								'fields'=>array('Cliente.id','Cliente.nombre','Cliente.apellido','Cliente.domicilio',
												'Cliente.telefono','Cliente.lat','Cliente.lng',
												'Localidade.nombre','Provincia.nombre','Departamento.nombre'),
								'order'=>array('Cliente.apellido ASC','Cliente.nombre ASC')
								));

		$this->set('bicicletareparamos',$bicicletareparamos);
		$this->set('provincia',$tallercito['Provincia']['nombre']);
		$this->set('localidad',$tallercito['Localidade']['nombre']);
	}

	/*
	* Funcion: Permite localizar el punto dónde dejamos la cleta
	*/
	public function getlocalize($id=null){
		$this->set('title_for_layout',__('Ubicacion GPS'));
		if(!empty($id))
			$this->Session->write('id');
		else
			$id=$this->Session->write('id');
		if(!empty($id)){
			$bicicletareparamos = $this->Bicicletareparamo->find('first',array('conditions'=>array('Cliente.tallercito_id'=>$this->Session->read('tallercito_id'),
																		'Bicicletareparamo.estado in(3,0)',
																		'Bicicletareparamo.id'=>$id)));
			if(!empty($bicicletareparamos)){
				if (!$this->Bicicletareparamo->exists($id)) {
					throw new NotFoundException(__('Identificador Invalido'));
				}
				if ($this->request->is(array('post', 'put'))) {
					$cliente['Cliente']['id']=$this->request->data['Bicicletareparamo']['cliente_id'];
					$cliente['Cliente']['lat']=$this->request->data['Bicicletareparamo']['latitude'];
					$cliente['Cliente']['lng']=$this->request->data['Bicicletareparamo']['longitude'];
					$this->Cliente->create();
					if($this->Cliente->save($cliente)){
						$this->Session->setFlash('Ubicación GPS guardada satisfactoriamente');
					}else{
						$this->Session->setFlash('No se pudo almacenar el punto GPS');
					}
					return $this->redirect(array('action' => 'mapbicicletaentregaall'));
				}
			}
			$this->set('bicicletareparamos',$bicicletareparamos);
		}
	}

	public function listbicreparpersona($cliente_id = null){
		$this->set('title_for_layout',__('Historial de Mantenimiento'));
		$bicicletareparamos=array();
		if(!empty($cliente_id)){
			$bicicletareparamos = $this->Bicicletareparamo->find('all',array('conditions'=>array('Bicicletareparamo.cliente_id'=>$cliente_id,
																		'Cliente.tallercito_id'=>$this->Session->read('tallercito_id')),
																		'fields'=>array('Bicicletareparamo.detallereparacion','Bicicletareparamo.fechaingreso','Bicicletareparamo.fechaegreso','Bicicleta.modelo','Bicicleta.marca'),
																		'order'=>array('Bicicletareparamo.fechaegreso'=>'desc')));
		}
		$this->set(compact('bicicletareparamos'));
	}


	public function beforeFilter(){
		// For CakePHP 2.0
		/**$this->Auth->allow('*');

		// For CakePHP 2.1 and up
		$this->Auth->allow();**/
		parent::beforeFilter();
		if($this->params['action'] == 'detalletaller'){

		}else{
		 //$this->set('str_estados',$str_estados);
		 $this->set(compact('str_estadossino','str_estados'));
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

}
