<?php
/*
* Funcion Clase: Clase encargada de realizar la operacion de imagenes convirtiendo las mismas a determinados
*formatos
*/
App::uses('Component', 'Controller');
define('FILE_NOT_FOUND',-1);

class CimageComponent extends Component{
	/*
	*Funcion: permite redimensionar una imagen y pasarla para ser guardada en la base de datos
	*/
	function ImagenToBlob($path,$max_width,$max_height,$namefile,$subdir = ''){
		$types = array(1 => "gif", "jpeg", "png", "swf", "psd", "wbmp",'jpg'); // usado para determinar el tipo de imagen
		if(!file_exists($path)) return FILE_NOT_FOUND; /*No se encuentra la imagen*/
		/*recupera los datos de la imagen que estamos por cargar*/
    		list($width, $height, $image_type) = getimagesize($path);
		/*Si no se especifica una tamano para el width y heigt se toma el que tiene por defecto la imagen*/
		if($max_width == 0 ) $max_width = $width;
		if($max_height == 0) $max_height = $height;

		/*Determinando el tipo de imagen realiza el proceso de creacion de la imagen*/
		$image = call_user_func('imagecreatefrom'.$types[$image_type], $path);
		/*calculamos el tamanio de la imagen dependiendo los ratios*/
		$x_ratio = $max_width / $width;
		$y_ratio = $max_height / $height;

		/*recalculamos el ancho y alto para la imagen ingresada*/
		if( ($width <= $max_width) && ($height <= $max_height) ){
			$tn_width = $width;
			$tn_height = $height;
		}elseif (($x_ratio * $height) < $max_height){
			$tn_height = ceil($x_ratio * $height);
			$tn_width = $max_width;
		}else{
			$tn_width = ceil($y_ratio * $width);
			$tn_height = $max_height;
		}

		/*creamos un contenedor de la imagen*/
		$tmp = imagecreatetruecolor($tn_width,$tn_height);
		/* Check if this image is PNG or GIF, then set if Transparent*/
		if(($image_type == 1) OR ($image_type==3))
		{
			imagealphablending($tmp, false);
			imagesavealpha($tmp,true);
			$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
			imagefilledrectangle($tmp, 0, 0, $tn_width, $tn_height, $transparent);
		}
		imagecopyresampled($tmp,$image,0,0,0,0,$tn_width, $tn_height,$width,$height);
		/*activa el buffer para que la imagen no se enviada como salida*/
    		ob_start();
		call_user_func("image".$types[$image_type],$tmp,NULL);
		/*se recupera la imagen del buffer*/
    		$final_image = ob_get_contents();
		ob_end_clean();
		$filename='';
		if(!empty($namefile)){
			$filename = $this->saveimage($final_image,$types[$image_type],$namefile,$subdir);
		}
    return array($final_image,$filename);
	}

	function view($data,$type){
	  	header("Content-type: ".$type);
		echo $data;
		exit();
	}

	/*Save Image file in server*/
	function saveimage($image,$type,$name,$subdir){
		$valkey = Security::generateAuthKey();
		$filename="/files/img/".$subdir.$valkey.$name.'.'.$type;
		//si existe la imagen la eliminamos y reemplamos por la nueva
		$file = new File(WWW_ROOT.$filename,true,0644);
		$file->write($image,'wb',true);
		$file->close();
		return $filename;
	}

}


?>
