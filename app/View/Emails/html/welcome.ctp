<?php
/**
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
 * @package       Cake.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<span><?php echo 'Bienvenido '.$usuarionomap.' a nuestro Sistema de Gestion. Confirma tu usuario para poder ver novedades de tu bicicleta en nuestra web'?></span>
<?php
	$content = explode("\n", $content);
	foreach ($content as $line):
		echo '<p> ' . $line . "</p>\n";
	endforeach;
?>