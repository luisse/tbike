<?php
App::uses('AppController', 'Controller');
/**
 * Userpeoples Controller
 *
 * @property Userpeople $Userpeople
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UserpeoplesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

}
