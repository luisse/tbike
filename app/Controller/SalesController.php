<?php
class SalesController extends AppController {

	var $name = 'Sales';
	var $helpers = array('Time');
	var $uses=array('Sale','Salesdetail','Numeradore','Subtypeproduct','Typeproduct','Categoria','Cliente','Product','Movimiento','Cuenta','Sysconfig');

	function index(){
		$this->set('title_for_layout','Listado de Ventas');
		$str_tipofactura = array(''=>'Todo','V'=>'Venta','P'=>'Presupuesto');
		$this->set('str_tipofactura',$str_tipofactura);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid sale', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sale', $this->Sale->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Sale->create();
			if ($this->Sale->save($this->data)) {
				$this->Session->setFlash(__('The sale has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		$this->set('title_for_layout','Actualizar Datos de Venta');
		$this->set('errorval','');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid sale', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Sale->saveAll($this->data)) {
				$this->Session->setFlash(__('Los datos fueron guardados', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('No se pudo guardar los datos. Por favor intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$str_tipofactura = array('V'=>'Venta','P'=>'Presupuesto');
			$this->set('str_tipofactura',$str_tipofactura);

			$data = $this->Sale->read(null,$id);
			if(!empty($data)){
				$i=0;
				foreach($data['Salesdetail'] as $saledetail){
					$products = $this->Product->find('first',array('conditions'=>array('Product.id'=>$saledetail['product_id']),
							'fields'=>array('Product.descripcion')));
					$data['Salesdetail'][$i]['descripcion']=$products['Product']['descripcion'];
					$i++;
				}
			}

			$this->data=$data;
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Identificador de Venta invalido', true));
			$this->redirect(array('action'=>'index'));
		}

		if ($this->Sale->delete($id,true)) {
				$this->Session->setFlash(__('La Venta fue borrada', true));
				$this->redirect(array('action'=>'index'));
			}
		$this->Session->setFlash(__('La Venta no se pudo borrar', true));
		$this->redirect(array('action' => 'index'));
	}

	/*Funcion: permite realizar el alta de una nueva venta*/
	function newsale(){
		$this->set('title_for_layout',__('Nueva Venta Online'));
		if(!empty($this->request->data)){
			$this->request->data['Sale']['user_id']=$this->Session->read('user_id');
			$this->request->data['Sale']['tallercito_id'] = $this->Session->read('tallercito_id');
			$this->request->data['Sale']['saledate']=date('Y-m-d H:i:s');
			$this->request->data['Sale']['state']=1;//La venta se encuentra habilitada no entregada por defecto
			if($this->Sale->savesale($this->request->data)){
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('No se pudo Guardar la Venta, Verifique los datos ingresados'));
			}
		}else{
			$numerador = $this->Numeradore->retornaValor($this->Session->read('tallercito_id'),'FACTURA');
			$str_tipofactura = array('V'=>'Venta','P'=>'Presupuesto');
			if(!empty($numerador)){
				$nrofactura = strval($numerador['Numeradore']['rangodesde'] + 1);
				$nrofactura = str_pad($nrofactura,6 - strlen($nrofactura),'0',STR_PAD_LEFT);
			}else{
				$nrofactura='0';
				$nrofactura = str_pad($nrofactura,6 - strlen($nrofactura),'0',STR_PAD_LEFT);
				$this->Session->setFlash(__('No se encontro configuración para numerador de Ventas'));
			}
			//envios de parametros a la vista
			$this->set('str_tipofactura',$str_tipofactura);
			$this->set('nrofactura',$nrofactura);
		}
	}
	/*
	 * Funcion: permite dar de alta una nueva fila
	 * */
	function newrow($row = null){
		$this->layout = '';
		$this->set('row',$row);
	}

	function listsales(){
		$this->layout='';
		$filtrar = $this->data;
		$resulttotal = $this->Sale->totalsales($filtrar);

		$this->Sale->recursive = 0;
		//Filter
		$ls_filtro='1 = 1 ';
		$fieldName = 'Sale.fecha';
		if(!empty($this->request->data)){
			if($this->request->data['fecdesde'] != null && $this->request->data['fecdesde'] != '' &&
				$this->request->data['fechasta'] != null &&  $this->request->data['fechasta'] != ''){
				$ls_filtro = $ls_filtro.' AND ( '.$fieldName.' >= "'.
						$this->Sale->formatDate($this->request->data['fecdesde']).'" AND '.
						$fieldName.' <= "'.$this->Sale->formatDate($this->request->data['fechasta']).'" )';
			}
			//filtro por tipo de factura
			if($this->request->data['tipofactura'] != null &&
				$this->request->data['tipofactura']!=''){
				$ls_filtro = $ls_filtro.' AND tipofactura = "'.$this->request->data['tipofactura'].'"';
			}
			//filtro por nombre de cliente
			if($this->request->data['Sale']['cliente_id']!= '' && $this->request->data['Sale']['cliente_id']!= null){
				$ls_filtro = $ls_filtro.' AND cliente_id = '.$this->request->data['Sale']['cliente_id'];
			}
		}

		$this->paginate=array('limit' => 10,
						'page' => 1,
						'order'=>array('Sale.nrofactura'=>'desc'),
						'conditions'=>$ls_filtro);
		$str_tipofactura = array('V'=>'Venta','P'=>'Presupuesto');

		$this->set('sales', $this->paginate());
		$this->set('totalsales',$resulttotal[0][0]['totalsales']);
		$this->set('str_tipofactura',$str_tipofactura);
	}

	function salepage($totalsale=null){
		$this->layout = 'buscar';
		//asignamos ls JS necesarios para el proceso de búsqueda
		$js_funciones = array('jquery','jquery-ui.min','jquery.numeric.js',
				'fmensajes.js','fgenerales.js','jquery.price.js');
		$this->set('js_funciones',$js_funciones);
		$this->set('totalSale',$totalsale);

	}
	/*SOLO FUNCIONES PARA PROCESAMIENTO DE PAGOS!!!*/
	function salepagesave($cliente_id = null){
		$this->layout = '';
		$result = '';
		$this->set('result',$result);
	}


	function totalesdiagrama($anio = null){
        $this->layout = null;

        $categoria=array('MES');
        $categoria[] = 'Ventas del Mes';
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

        $sales = $this->Sale->find('all',array('conditions'=>array('Sale.state'=>1,' YEAR( Sale.fecha )'=>$anio),
                                    'fields'=>array('DATE_FORMAT(Sale.fecha,"%m/%Y") as anio',
                                                    'SUM(Sale.totalsale) as totalsale',
                                                    'MONTH(fecha) as mes'),
                                    'order'=>array('Sale.fecha ASC'),
                                    'group'=>array('anio')));
        foreach($sales as $sale){
            switch($sale[0]['mes']){
             case 1:
                $enero[]=(double)$sale[0]['totalsale'];
             break;
             case 2:
                $febrero[]=(double)$sale[0]['totalsale'];
             break;
             case 3:
                $marzo[]=(double)$sale[0]['totalsale'];
             break;
             case 4:
                $abril[]=(double)$sale[0]['totalsale'];
             break;
             case 5:
                $mayo[]=(double)$sale[0]['totalsale'];
             break;
             case 6:
                $junio[]=(double)$sale[0]['totalsale'];
             break;
             case 7:
                $julio[]=(double)$sale[0]['totalsale'];
             break;
             case 8:
                $agosto[]=(double)$sale[0]['totalsale'];
             break;
             case 9:
                $septiembre[]=(double)$sale[0]['totalsale'];
             break;
             case 10:
                $octubre[]=(double)$sale[0]['totalsale'];
             break;
             case 11:
                $noviembre[]=(double)$sale[0]['totalsale'];
             break;
             case 12:
                $diciembre[]=(double)$sale[0]['totalsale'];
             break;
            }
        }
        $this->set(compact('categoria','enero',
                            'febrero','marzo','abril','mayo','junio',
                            'julio','agosto','septiembre','octubre',
                            'noviembre','diciembre'));
    }

	public function beforeRender(){
		/**try{
			$result =	$this->Acl->check(array(
					'model' => 'Group',       # The name of the Model to check agains
					'foreign_key' => $this->Session->read('tipousr') # The foreign key the Model is bind to
			), ucfirst($this->params['controller']).'/'.$this->params['action']);
			//SI NO TIENE PERMISOS DA ERROR!!!!!!
			if(!$result)
				$this->redirect(array('controller' => 'accesorapidos','action'=>'seguridaderror',ucfirst($this->params['controller']).'-'.$this->params['action']));
		}catch(Exeption $e){
		}***/

		if($this->params['action'] == 'newsale' ||
			$this->params['action'] == 'edit' ||
			$this->params['action'] == 'rankingproduct'){
			$categorias = $this->Categoria->find('list',
				array('fields'=>array('Categoria.id','Categoria.descripcion'),
				'order'=>array('Categoria.descripcion'),
				'conditions'=>array('Categoria.tallercito_id'=>$this->Session->read('tallercito_id'),'Categoria.padre_id IS NULL')));
			$categorias[0]='Todas';
			$this->set(compact('categorias','subcategorias'));
		}
		parent::beforeRender();
	}


	public function marcaentregado($id = null){
		$this->layout='';
		$error='';
		$sale = $this->Sale->find('first',array('conditions' => array('Sale.nrofactura'=> $id,'Sale.tallercito_id'=>$this->Session->read('tallercito_id'))));
		if(!empty($sale)){
			if (!$this->Sale->exists($sale['Sale']['id'])) {
				throw new NotFoundException(__('Identificador Invalido'));
			}
			$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $sale['Sale']['id'],'Sale.tallercito_id'=>$this->Session->read('tallercito_id')));
			$this->request->data = $this->Sale->find('first', $options);
			$this->request->data['Sale']['state'] = 2; //pagada
			if ($this->Sale->Save($this->request->data)) {
				$error='';
			} else {
				$error = __('El registro no se pudo actualizar. Por favor, intente de nuevo.');
			}
		}
		$this->set('error',$error);

	}

	public function verdetalleventa($id=null){
		$this->layout='';
		$venta = array();
		$str_tipofactura = array('V'=>'Venta','P'=>'Presupuesto');
		if(!empty($id)){
			$venta = $this->Sale->find('first',array('conditions'=>array('Sale.id'=>$id,
																		'Sale.tallercito_id'=>$this->Session->read('tallercito_id'))
													)
										);
			if(!empty($venta)){
				$i=0;
				foreach($venta['Salesdetail'] as $saledetail){
					$products = $this->Product->find('first',array('conditions'=>array('Product.id'=>$saledetail['product_id']),
																	'fields'=>array('Product.descripcion')));
					$venta['Salesdetail'][$i]['descripcion']=$products['Product']['descripcion'];
					$i++;
				}
			}
		}
		$this->set(compact('venta','str_tipofactura'));
	}

	function beforeFilter(){
	    parent::beforeFilter();
	    // For CakePHP 2.0
	    $this->Auth->allow('*');

	    // For CakePHP 2.1 and up
	    $this->Auth->allow();

	}

	/*
	* Funcion: permite imprimir un ticked de la venta realizada
	*/
	public function imprimirticket($id){
		$this->layout='pdf';
		$venta = array();
		$str_tipofactura = array('V'=>'Venta','P'=>'Presupuesto');
		$deuda=0;
		if(!empty($id)){
			//recuperamos los datos de la venta
			$venta = $this->Sale->find('first',array('conditions'=>array('Sale.id'=>$id,
																		'Sale.tallercito_id'=>$this->Session->read('tallercito_id'))
													)
										);
			if(!empty($venta)){
				$i=0;
				foreach($venta['Salesdetail'] as $saledetail){
					$products = $this->Product->find('first',array('conditions'=>array('Product.id'=>$saledetail['product_id']),
																	'fields'=>array('Product.descripcion')));
					$venta['Salesdetail'][$i]['descripcion']=$products['Product']['descripcion'];
					$i++;
				}

				//recuperamos el monto de la deuda si tiene cliente
				//$cuenta_id = $this->Cuenta->getctactecliente($venta['Sale']['cliente_id'],$this->Session->read('tallercito_id'));
				//$deuda = $this->Movimiento->GetTotalCuenta($cuenta_id);
			}
		}
		$this->set('deuda',$deuda);
		$this->set(compact('venta','str_tipofactura'));
	}

	public function applicationerror(){
	}

	public function rankingproduct(){
		$this->set('title_for_layout',__('Ranking de Productos Vendidos'));
	}

	public function listrankproduct(){
		$this->layout ='';
		$ls_filtro = '1=1';
		$fieldName = 'Sale.fecha';
		if(!empty($this->request->data)){
			if($this->request->data['Product']['fecdesde'] != null && $this->request->data['Product']['fecdesde'] != '' &&
				$this->request->data['Product']['fechasta'] != null &&  $this->request->data['Product']['fechasta'] != ''){
				$ls_filtro = $ls_filtro.' AND ( '.$fieldName.' >= "'.
						$this->Sale->formatDate($this->request->data['Product']['fecdesde']).'" AND '.
						$fieldName.' <= "'.$this->Sale->formatDate($this->request->data['Product']['fechasta']).'" )';
			}

			if($this->request->data['Product']['descripcion'] != null && $this->request->data['Product']['descripcion'] != ''){
				$ls_filtro = $ls_filtro.' AND Upper(Product.descripcion) like Upper("%'.$this->request->data['Product']['descripcion'].'%")';
			}
			if(!empty($this->request->data['Product']['categoria_id']) &&
						$this->request->data['Product']['categoria_id'] != 0 &&
						$this->request->data['Product']['categoria_id'] !=''){
				$ls_filtro = $ls_filtro.' AND Product.categoria_id = '.$this->request->data['Product']['categoria_id'];
			}
			if(!empty($this->request->data['Product']['subcategoria_id']) && $this->request->data['Product']['subcategoria_id'] != 0){
				$ls_filtro = $ls_filtro.' AND Product.subcategoria_id = '.$this->request->data['Product']['subcategoria_id'];
			}
		}
		$rankresult = $this->Sale->find('all',array('conditions'=>array($ls_filtro),
                                    'fields'=>array('Product.codbarra','Product.descripcion','Categoria.descripcion','Subcategoria.descripcion','SUM(Salesdetail.cantidad) AS totalvendido',
													'SUM(Salesdetail.subtotal) AS total'),
													'joins'=>array(
															array('table'=>'salesdetails',
																'alias'=>'Salesdetail',
																'type'=>'LEFT',
																'conditions'=>array('Salesdetail.sale_id = Sale.id')),
															array('table'=>'products',
															'alias'=>'Product',
															'type'=>'LEFT',
															'conditions'=>array('Product.id = Salesdetail.product_id',
																				'Product.tallercito_id = '.$this->Session->read('tallercito_id'))),
															array('table'=>'categorias',
															'alias'=>'Categoria',
															'type'=>'LEFT',
															'conditions'=>array('Categoria.id = Product.categoria_id')),
															array('table'=>'categorias',
															'alias'=>'Subcategoria',
															'type'=>'LEFT',
															'conditions'=>array('Subcategoria.padre_id = Product.subcategoria_id'))),
                                    'group'=>array('Product.descripcion,Product.codbarra','Categoria.descripcion','Subcategoria.descripcion'),
									'order'=>array('totalvendido'=>'desc')));
		$this->set(compact('rankresult'));
	}

	function diagramasventas(){

	}

	function pagoconmercadopago($sale_id=null){
		$this->set('title_for_layout',__('Pago Mercado Pago'));
		$sysconfig=$this->Sysconfig->find('first',array('conditions'=>array('Sysconfig.tallercito_id'=>$this->Session->read('tallercito_id')),
																			'fields'=>array('Sysconfig.tokenmp','Sysconfig.usermp')));
		if(!empty($sale_id)){
				$sales=$this->Sale->find('first',array('conditions'=>array('Sale.id'=>$sale_id)));
			if(!empty($sales)){
				$i=0;
				foreach($sales['Salesdetail'] as $saledetail){
					$products = $this->Product->find('first',array('conditions'=>array('Product.id'=>$saledetail['product_id']),
																	'fields'=>array('Product.descripcion')));
					$sales['Salesdetail'][$i]['descripcion']=$products['Product']['descripcion'];
					$i++;
				}

			}
		}
		$this->set(compact('sysconfig','sales'));
		$str_tipofactura = array('V'=>'Venta','P'=>'Presupuesto');
		$this->set('str_tipofactura',$str_tipofactura);

	}

	/**
	 * exportsalesincvs method permite exportar los datos en archivo cvs
	 *
	 * @return void
	 */
	function exportsalesincvs(){
		$this->layout='ajax';
		$this->response->download('Ventas-'.$this->Session->read('tallercito_id').'-'.date('Ymd').'.cvs');
		$ls_filtro='1 = 1 ';
		$fieldName = 'Sale.fecha';
		$sales=array();

		if(!empty($this->request->data)){
			if($this->request->data['fecdesde'] != null && $this->request->data['fecdesde'] != '' &&
				$this->request->data['fechasta'] != null &&  $this->request->data['fechasta'] != ''){
				$ls_filtro = $ls_filtro.' AND ( '.$fieldName.' >= "'.
						$this->Sale->formatDate($this->request->data['fecdesde']).'" AND '.
						$fieldName.' <= "'.$this->Sale->formatDate($this->request->data['fechasta']).'" )';
			}
			//filtro por tipo de factura
			if($this->request->data['tipofactura'] != null &&
				$this->request->data['tipofactura']!=''){
				$ls_filtro = $ls_filtro.' AND tipofactura = "'.$this->request->data['tipofactura'].'"';
			}
			//filtro por nombre de cliente
			if($this->request->data['Sale']['cliente_id']!= '' && $this->request->data['Sale']['cliente_id']!= null){
				$ls_filtro = $ls_filtro.' AND cliente_id = '.$this->request->data['Sale']['cliente_id'];
			}
			$sales = $this->Sale->find('all',array('conditions'=>array($ls_filtro),
																						'fields'=>array('Sale.saledate','Sale.totalsale','Sale.descuento','Tallercito.CUIT','Tallercito.razonsocial')));
		}
		$this->set(compact('sales'));
		return;
	}
}
?>
