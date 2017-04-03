<?php
App::uses('AppController', 'Controller');
/**
 * Movimientos Controller
 *
 * @property Movimiento $Movimiento
 * @property PaginatorComponent $Paginator
 */
class MovimientosController extends AppController {
	var $uses= array('Movimiento','Cliente','Cuenta','Tipodemovimiento');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
/**
 * Helpers
 *
 * @var array
 */
	var $helpers=array('Time');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Movimiento->recursive = 0;
		$this->set('movimientos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Movimiento->exists($id)) {
			throw new NotFoundException(__('Invalid movimiento'));
		}
		$options = array('conditions' => array('Movimiento.' . $this->Movimiento->primaryKey => $id));
		$this->set('movimiento', $this->Movimiento->find('first', $options));
	}


	public function agregarmovimiento(){
		$movimiento['Movimiento']['nrocomprobante']=33659876;
		$movimiento['Movimiento']['importe']=4200;
		$movimiento['Movimiento']['cuenta_id']=3;
		$movimiento['Movimiento']['tipomovimiento_id']=2;
		$movimiento['Movimiento']['tallercito_id']=$this->Session->read('tallercito_id');
		$movimiento['Movimiento']['detallemov']='Movimiento de credito a cliente';
		$this->Movimiento->create();
		$retorno = $this->Movimiento->AgregarMovimiento($movimiento);
		echo $retorno;
		if($retorno ==''){
			//return $this->redirect(array('action' => 'index'));
			$this->Session->setFlash(__('El movimiento a sido guardado.'));
		}
	}
	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Movimiento->create();
			if ($this->Movimiento->save($this->request->data)) {
				$this->Session->setFlash(__('El movimiento a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El movimiento no se pudo grabar. Por favor, intente de nuevo.'));
			}
		}
		$tallercitos = $this->Movimiento->Tallercito->find('list');
		$cuentas = $this->Movimiento->Cuentum->find('list');
		$tipomovimientos = $this->Movimiento->Tipomovimiento->find('list');
		$this->set(compact('tallercitos', 'cuentas', 'tipomovimientos'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Movimiento->exists($id)) {
			throw new NotFoundException(__('Invalid movimiento'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Movimiento->save($this->request->data)) {
				$this->Session->setFlash(__('El movimiento a sido guardado.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El movimiento no se pudo guardar. Por favor, intente de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Movimiento.' . $this->Movimiento->primaryKey => $id));
			$this->request->data = $this->Movimiento->find('first', $options);
		}
		$tallercitos = $this->Movimiento->Tallercito->find('list');
		$cuentas = $this->Movimiento->Cuentum->find('list');
		$tipomovimientos = $this->Movimiento->Tipomovimiento->find('list');
		$this->set(compact('tallercitos', 'cuentas', 'tipomovimientos'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Movimiento->id = $id;
		if (!$this->Movimiento->exists()) {
			throw new NotFoundException(__('Identificador de movimiento invalido'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Movimiento->delete()) {
			$this->Session->setFlash(__('El movimiento a sido eliminado.'));
		} else {
			$this->Session->setFlash(__('El movimiento no se pudo borrar. Por favor, intente de nuevo.'));
		}
		return $this->redirect(array('action' => 'veringresosfecha'));
	}

	/**
	* method ventana de pagos genera los movimientos respectivos
	* @param int cliente_id
	* @param int comprobanteint nro comprobante interno
	* @param floa importe importe para generar el movimiento
	* @return void
	*/
	public function pagos($cliente_id = null,$comprobanteint = null,$importe = null,$llamadodesde = null,$comintdesde = null){
		$this->set('title_for_layout','Pago en Caja');
		$this->layout = 'bmodalbox';
		$cerrar = '';
		//INCICIALIZAMOS VARIABLE DE SESION PARA NO PERDER LOS DATOS
		if(!empty($cliente_id) && $cliente_id!=0) $this->Session->Write('mcliente_id',$cliente_id);
		if(!empty($comprobanteint)) $this->Session->Write('comprobanteint',$comprobanteint);
		if(!empty($importe)) $this->Session->Write('importe',$importe);
		if(!empty($comintdesde)) $this->Session->Write('comintdesde',$comintdesde);

		//SI ES PARA GUARDAR DEBEMOS DISPARAR EL MOVIMIENTO
		if ($this->request->is('post')) {
			$movimiento['Movimiento']['comprobanteint']	= $this->request->data['Movimiento']['comprobanteint'];
			//si el comprante esta vacio lo ponemos en 0
			$movimiento['Movimiento']['nrocomprobante']	= $this->request->data['Movimiento']['nrocomprobante'];
			//Marcamos el tipo de movimiento interno
			$movimiento['Movimiento']['comintdesde']		= $this->Session->read('comintdesde');
			//si la cuenta esta vacia el movimiento se realiza a la cuenta del cliente conectado
			if(empty($this->request->data['Movimiento']['cuentaid']) ||
				$this->request->data['Movimiento']['cuentaid'] == 0 ||
				$this->request->data['Movimiento']['cuentaid'] == ''){
					$cuenta_id = $this->Cuenta->getctactecliente($this->Session->read('cliente_id'),$this->Session->read('tallercito_id'));
					if(!empty($cuenta_id)){
						$movimiento['Movimiento']['cuenta_id']=$cuenta_id;
					}
			}else{
				//cuenta del cliente conectado
				$movimiento['Movimiento']['cuenta_id'] = $this->request->data['Movimiento']['cuentaid'];
			}
			//Moviento de tarjeta de credito
			if($this->request->data['Movimiento']['tipomovimientoid'] == 6)
				$movimiento['Movimiento']['nrocomprobante'] = $this->request->data['Movimiento']['nrocomprobantetarjeta'];

			if($this->request->data['Movimiento']['tipomovimientoid'] == 2){
				//movimiento para ingreso de caja ejectivo si deyuda es mayor a 0
				$movimientonodeuda['Movimiento']['tipomovimiento_id']=5;//PAGO EFECTIVO
				$movimientonodeuda['Movimiento']['tallercito_id']=$this->Session->read('tallercito_id');
				$movimientonodeuda['Movimiento']['detallemov']='MOVIMIENTO DE PAGO CON DEUDA';
				$movimientonodeuda['Movimiento']['comprobanteint']=$this->request->data['Movimiento']['comprobanteint'];
				$movimientonodeuda['Movimiento']['nrocomprobante']=$this->request->data['Movimiento']['nrocomprobante'];
				//movimiento sobre la cuenta del taller es efectivo
				$cuenta_id = $this->Cuenta->getctactecliente($this->Session->read('cliente_id'),$this->Session->read('tallercito_id'));
				$movimientonodeuda['Movimiento']['cuenta_id'] =$cuenta_id;
				$deuda = str_replace('$','',$this->request->data['Movimiento']['deuda']);
				$movimientonodeuda['Movimiento']['importe']= $this->request->data['Movimiento']['importe'] - $deuda;


				$movimiento['Movimiento']['importe']=str_replace('$','',$this->request->data['Movimiento']['deuda']);
			}else{
				$movimiento['Movimiento']['importe']=$this->request->data['Movimiento']['importe'];
			}
			$movimiento['Movimiento']['tipomovimiento_id']=$this->request->data['Movimiento']['tipomovimientoid'];
			$movimiento['Movimiento']['tallercito_id']=$this->Session->read('tallercito_id');
			$movimiento['Movimiento']['detallemov']='Movimiento General';
			$this->Movimiento->create();
			$retorno = $this->Movimiento->AgregarMovimiento($movimiento);

			if($retorno ==''){
				if(!empty($movimientonodeuda)){
					if($this->request->data['Movimiento']['tipomovimientoid'] == 2 && $movimientonodeuda['Movimiento']['importe'] > 0){
						$retorno = $this->Movimiento->AgregarMovimiento($movimientonodeuda);
						if($retorno == '')
							$this->Session->setFlash(__('CERRAR'));
						else
							$this->Session->setFlash($retorno);
					}
				}else{
					$this->Session->setFlash(__('CERRAR'));
				}
			}
		}

		//ASIGNACION DE DATOS PARA LA VISTA
		$total = 0;
		$cliente = array();
		$maxdeuda = 0;
		$cuentaid = 0;
		$cliente_id = $this->Session->read('mcliente_id');
		if(!empty($cliente_id) && $cliente_id != 0){
			$cliente = $this->Cliente->find('first',array('conditions'=>array('Cliente.id'=>$this->Session->read('mcliente_id'))));
			$cuenta = $this->Cuenta->find('first',array('conditions'=>array('Cuenta.cliente_id'=>$this->Session->read('mcliente_id'))));
			$total = 0;
			if(!empty($cuenta)){
				$maxdeuda = $cuenta['Cuenta']['maxdeuda'];
				$total = $this->Movimiento->GetTotalCuenta($cuenta['Cuenta']['id']);
				$cuentaid = $cuenta['Cuenta']['id'];
			}
		}
		/*Parametros para el proceso de pagos*/
		$this->set('cuentaid',$cuentaid);
		$this->set('maxdeuda',$maxdeuda);
		$this->set('cliente',$cliente);
		$this->set('totalcredito',$total);
		$this->set('cliente_id',$this->Session->read('mcliente_id'));
		$this->set('comprobanteint',$this->Session->read('comprobanteint'));
		$this->set('importe',$this->Session->read('importe'));
		$this->set('llamadodesde',$llamadodesde);
		$this->set('cerrar',$cerrar);
	}

	/**
	* method ventana  de visualizacion de filtros y listado de movimientos
	* @param fecdesde Fecha desde
	* @param fechasta Fecha Hasta
	* @return void
	*/
	public function veringresosfecha(){
		$this->set('title_for_layout','Movimientos por Fecha');
		$tipomovimientos = $this->Movimiento->Tipomovimiento->find('list',array('fields'=>array('Tipomovimiento.id','Tipomovimiento.descripcion')));
		$tipomovimientos[0]='TODOS';
		$this->set(compact('tipomovimientos'));
	}


	/**
	* method retorna listado de movimiento
	* @param fecdesde Fecha desde
	* @param fechasta Fecha Hasta
	* @return void
	*/
	public function listmovimientos(){
		$this->layout='';
		App::uses('CakeTime', 'Utility');
		$filtros = CakeTime::daysAsSql($this->Movimiento->formatDate($this->request->data['Movimiento']['fecdesde']),
																	$this->Movimiento->formatDate($this->request->data['Movimiento']['fechasta']),
																	'fechamov');
		if($this->request->data['Movimiento']['tipomovimiento_id'] != 0)
			$filtros = $filtros.' AND Movimiento.tipomovimiento_id = '.$this->request->data['Movimiento']['tipomovimiento_id'];
		if($this->request->data['Movimiento']['cuenta_id'] != 0 && $this->request->data['Movimiento']['cuenta_id'] != null){
			$filtros = $filtros.' AND Movimiento.cuenta_id = '.$this->request->data['Movimiento']['cuenta_id'];
		}
		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('Movimiento.fechamov'=>'DESC'),
						'conditions'=>array($filtros,'Movimiento.tallercito_id'=>$this->Session->read('tallercito_id')),
						'fields'=>array('Movimiento.id','Movimiento.fechamov','Movimiento.nrocomprobante','Movimiento.detallemov','Movimiento.cuenta_id',
										'Tallercito.razonsocial','Tipomovimiento.descripcion','Tipomovimiento.Signo','Cuenta.nrocuenta'));
		$movimientos = $this->Paginator->paginate();

		/*Totales por movimiento*/
		$this->Movimiento->unbindModel(
        array('belongsTo' => array('Tallercito','Cuenta','Tipomovimiento'),
					'hasMany'=>array('Movimientodetalle')));

		$totalesxmovimiento = $this->Movimiento->find('all',array('joins'=>array(array('table'=>'movimientodetalles',
																						'alias'=>'Movimientodetalle',
																						'type'=>'LEFT',
																						'conditions'=>array('Movimientodetalle.movimiento_id = Movimiento.id AND (`Movimientodetalle`.`formulaimporte_id` = 0 || `Movimientodetalle`.`formulaimporte_id` IS NULL)')),
																				array('table'=>'tipomovimientos',
																						'alias'=>'Tipomovimiento',
																						'type'=>'LEFT',
																						'conditions'=>array('Tipomovimiento.id = Movimiento.tipomovimiento_id'))
																				),
															'fields'=>array('Tipomovimiento.descripcion','SUM(Movimientodetalle.valor*Movimientodetalle.signo) as total'),
															'group'=>array('Movimiento.tipomovimiento_id'),
															'conditions'=>array($filtros,'Movimiento.tallercito_id'=>$this->Session->read('tallercito_id'))
															)
											);

		$this->set(compact('movimientos','totalesxmovimiento'));

	}

	/**
	* method permite realizar un movimientos manual
	* @param int POST envio por post
	* @param int nrocomprobante int nro de comprobante
	* @param float importe importe para generar el movimiento
	* @param int cuenta_id cuenta sobre la que se realizara el movimiento
	* @param int tipomovimiento_id tipo de movimiento a realizar
	* @param int tallercito_id identificador de taller para el movimiento
	* @param char detallemov el dealle del movimiento a realizar
	* @return void
	*/
	public function movimientosmanuales(){
		$this->set('title_for_layout','Movimientos Manuales');
		$tipomovimientos = $this->Movimiento->Tipomovimiento->find('list',array('fields'=>array('Tipomovimiento.id','Tipomovimiento.descripcion')));
		if ($this->request->is('post')){

			$movimiento['Movimiento']['nrocomprobante']=$this->request->data['Movimiento']['nrocomprobante'];
			$movimiento['Movimiento']['importe']=str_replace('$','',$this->request->data['Movimiento']['importe']);
			//si la cuenta esta vacia el movimiento se realiza a la cuenta del cliente conectado
			if(empty($this->request->data['Movimiento']['cuenta_id']) ||
				$this->request->data['Movimiento']['cuenta_id']==0 ||
				$this->request->data['Movimiento']['cuenta_id'] ==''){
					$conditions['joins']=array(array('table'=>'cuentas',
															'alias'=>'Cuenta',
															'type'=>'LEFT',
															'conditions'=>array('Cuenta.cliente_id = Cliente.id',
															'Cuenta.tallercito_id = '.$this->Session->read('tallercito_id'))));
					$conditions['conditions']=array('Cliente.user_id'=>$this->Session->read('user_id'));
					$conditions['fields']=array('Cuenta.id');
					$cliente = $this->Cliente->find('first',$conditions);
					if(!empty($cliente)){
						$movimiento['Movimiento']['cuenta_id']=$cliente['Cuenta']['id'];
					}
			}else{
				$movimiento['Movimiento']['cuenta_id']=$this->request->data['Movimiento']['cuenta_id'];
			}

			$movimiento['Movimiento']['tipomovimiento_id']=$this->request->data['Movimiento']['tipomovimiento_id'];
			$movimiento['Movimiento']['tallercito_id']=$this->Session->read('tallercito_id');
			$movimiento['Movimiento']['detallemov']=$this->request->data['Movimiento']['detallemov'];//detallemov
			$this->Movimiento->create();
			$retorno = $this->Movimiento->AgregarMovimiento($movimiento);
			if(!empty($retorno)){
				$this->Session->setFlash(__('No se pudo generar el movimiento. '.$retorno));
			}else{
				$this->Session->setFlash(__('El Movimiento se genero satisfactoriamente. '));
				$this->redirect(array('action' => 'movimientosmanuales'));
			}
		}
		$this->set(compact('tipomovimientos'));
	}

	public function deudatotalcliente($cliente_id = null){
		$total=0;
		$this->layout = '';
		if(!empty($cliente_id)){
			$cuenta = $this->Cuenta->find('first',array('conditions'=>array('Cuenta.cliente_id'=>$cliente_id)));
			if(!empty($cuenta)) $total = $this->Movimiento->GetTotalCuenta($cuenta['Cuenta']['id']);
		}
		$this->set('total',$total);

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
