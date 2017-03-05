<?php
/*
 * Funcion Clase: Clase encargada de realizar la operacion de imagenes convirtiendo las mismas a determinados
 *formatos
 */
App::uses('Component', 'Controller');
define('FILE_NOT_FOUND',-1);

class UploadfileComponent extends Component{
	/*
	 * Funcion: permite cargar un archivo en un directorio temporal del servidor
	 * */
	function uploadFiles($folder, $formdata, $itemId = null) {
		// setup dir names absolute and relative
		$folder_url = WWW_ROOT.$folder;
		$rel_url = $folder;
	
		// create the folder if it does not exist
		if(!is_dir($folder_url)) {
			mkdir($folder_url);
		}
			
		// if itemId is set create an item folder
		if($itemId) {
			// set new absolute folder
			$folder_url = WWW_ROOT.$folder.'/'.$itemId;
			// set new relative folder
			$rel_url = $folder.'/'.$itemId;
			// create directory
			if(!is_dir($folder_url)) {
				mkdir($folder_url);
			}
		}
	
		// list of permitted file types, this is only images but documents can be added
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png','application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',' application/msword');
		// loop through and deal with the files
	
		foreach($formdata as $file) {
			// replace spaces with underscores
			$filename = str_replace(' ', '_', $file['name']);
			// assume filetype is false
			$typeOK = false;
			// check filetype is ok
			foreach($permitted as $type) {
				if($type == $file['type']) {
					$typeOK = true;
					break;
				}
			}
			// if file type ok upload the file
			if($typeOK) {
				// switch based on error code
				switch($file['error']) {
					case 0:
						// check filename already exists
						if(!file_exists($folder_url.'/'.$filename)) {
							// create full filename
							$full_url = $folder_url.'/'.$filename;
							$url = $rel_url.'/'.$filename;
							// upload the file
							$success = move_uploaded_file($file['tmp_name'], $url);
						} else {
							// create unique filename and upload file
							ini_set('date.timezone', 'Europe/London');
							$now = date('Y-m-d-His');
							$full_url = $folder_url.'/'.$now.$filename;
							$url = $rel_url.'/'.$now.$filename;
							$success = move_uploaded_file($file['tmp_name'], $url);
						}
						// if upload was successful
						if($success) {
							// save the url of the file
							$result['urls'][] = $url;
						} else {
							$result['errors'][] = "Error al subir el archivo $filename. Por favor intente de nuevo.";
						}
						break;
					case 3:
						// an error occured
						$result['errors'][] = "Error al cargar archivo $filename. Por favor intente de nuevo.";
						break;
					default:
						// an error occured
						$result['errors'][] = "Error del sistema al subir el archivo $filename. Contacte con el Administrador del Sitio Web.";
						break;
				}
			} elseif($file['error'] == 4) {
				// no file was selected for upload
				$result['nofiles'][] = "No se selecciono un archivo";
			} else {
				// unacceptable file type
				$result['errors'][] = "$filename no se pudo subir el archivo. Se Aceptan Archivos: gif, jpg, png,pdf.,xls,docx";
			}
		}
		return $result;
	}
	
	public function viewfile($data,$type){
		header("Content-type: ".$type);
		echo $data;
		exit();
	}
}
?>