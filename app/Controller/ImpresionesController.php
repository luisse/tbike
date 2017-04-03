<?php
/*
*    This program is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>
*    @author Luis Sebastian oppe
*    @Fecha 05/03/2015
*    @use Librerias de PHP para impresiones globales no son muchas :-)
*/

class ImpresionesController extends AppController{
	var $name='Impresiones';
	public function imprimir($whoprint = null,$id=null){
		$this->layout='';
		
		switch($whoprint){
			case 0:
				$link='/bicicletareparamos/imprimircomprobantepago/'.$id;
				break;
			case 1:
				$link='/sales/imprimirticket/'.$id;
				break;
			default:
				$link='';
		}
		$this->set('link',$link);
		$this->set('id',$id);	
	}
	
	public function beforeFilter(){
		// For CakePHP 2.0
		$this->Auth->allow('*');
		
		// For CakePHP 2.1 and up
		$this->Auth->allow();
		
	}
	
}	
?>

