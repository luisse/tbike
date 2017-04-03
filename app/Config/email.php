<?php
/**
 * This is email configuration file.
 *
 * Use it to configure email transports of Cake.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * In this file you set up your send email details.
 *
 * @package       cake.config
 */
/**
 * Email configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * transport => The name of a supported transport; valid options are as follows:
 *		Mail 		- Send using PHP mail function
 *		Smtp		- Send using SMTP
 *		Debug		- Do not send the email, just return the result
 *
 * You can add custom transports (or override existing transports) by adding the
 * appropriate file to app/Network/Email.  Transports should be named 'YourTransport.php',
 * where 'Your' is the name of the transport.
 *
 * from =>
 * The origin email. See CakeEmail::from() about the valid values
 *
 */
class EmailConfig {

	public $default = array(
		'transport' => 'Mail',
		'from' => 'tallercitobike@tallercitobike.esy.es',
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

	public $smtp = array();

	public $fast = array(
		'from' => 'you@localhost',
		'sender' => null,
		'to' => null,
		'cc' => null,
		'bcc' => null,
		'replyTo' => null,
		'readReceipt' => null,
		'returnPath' => null,
		'messageId' => true,
		'subject' => null,
		'message' => null,
		'headers' => null,
		'viewRender' => null,
		'template' => false,
		'layout' => false,
		'viewVars' => null,
		'attachments' => null,
		'emailFormat' => null,
		'transport' => 'Smtp',
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null,
		'log' => true,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);
	//clase encargada de crear el constructor de clase
	public function __construct(){
		$sysconfig = CakeSession::read('sysconfig');
		$default=false;

		if(!empty($sysconfig)){
			if(!empty($sysconfig['Sysconfig']['mailtransport']) &&
			   !empty($sysconfig['Sysconfig']['mailhost']) &&
			   !empty($sysconfig['Sysconfig']['mailport']) &&
			   !empty($sysconfig['Sysconfig']['mailuser']) &&
			   !empty($sysconfig['Sysconfig']['mailpassword'])){
				$this->smtp=array( 'transport' => $sysconfig['Sysconfig']['mailtransport'],
					   'from' => array('tallercitobike@tallercitobike.esy.es' => 'www.tallercitobike.esy.es'),
                			   'host' => $sysconfig['Sysconfig']['mailhost'],
				                'port' => $sysconfig['Sysconfig']['mailport'],
				                'timeout' => 30,
				                'username' => $sysconfig['Sysconfig']['mailuser'],
				                'password' => $sysconfig['Sysconfig']['mailpassword'],
				                'client' => null,
				                'log' => false);
				}else{
					$default=true;
				}
		}else{
			$default=true;
		}
		//SI NO TIENE SETEADO DATOS TOMAMOS EL SERVIDOR POR DEFECTO
		if($default){
			$this->smtp = array(
			                'transport' => 'Smtp',
			                'from' => array('tallercitobike@tallercitobike.esy.es' => 'www.tallercitobike.esy.es'),
			                'host' => 'ssl://smtp.gmail.com',
			                'port' => 465,
			                'timeout' => 30,
			                'username' => 'gestiondocumental.proime@gmail.com',
			                'password' => '2468Gestion',
			                'client' => null,
			                'log' => false
			        );
							//print_r($this->smtp);
		}
	}
}
