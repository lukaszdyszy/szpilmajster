<?php
	function splitURL(){
		// zajebisty łańcuszek XDDDD
		return  explode('/', trim(explode('?', substr_replace($_SERVER['REQUEST_URI'], '', strpos($_SERVER['REQUEST_URI'], INDEX), strlen(INDEX)))[0], '/'));
	}

	function uploadFile($fileName){
		$file_info = pathinfo($_FILES[$fileName]['name']);
		$target = IMG_FOLDER.$file_info['filename'];
		$i = 1;

		// zmień nazwę jeżeli plik istnieje na serwerze
		if(file_exists($target.'.'.$file_info['extension'])){
			while(file_exists($target.'('.$i.')'.'.'.$file_info['extension'])){
				$i++;
			}
			$target .= '('.$i.').'.$file_info['extension'];
		} else {$target .= '.'.$file_info['extension'];}

		// sprawdź rozmiar pliku (max. 1MB)
		if ($_FILES[$fileName]["size"] > 1048576) {
			throw new FileUploadException(400, 'Plik za duży! (max. 1MB)');
		}

		// tylko pliki graficzne
		$filetype = mime_content_type($_FILES[$fileName]['tmp_name']);
		if($filetype != "image/png" && $filetype != "image/jpeg" && $filetype != "image/gif" ) {
			throw new FileUploadException(400, 'Niedozwolony typ pliku! (tylko jpg, jpeg, png, gif)');
		}

		// zapisanie pliku na dysku
		if(!move_uploaded_file($_FILES[$fileName]['tmp_name'], $target)){
			throw new FileUploadException(500, 'Wystąpił błąd podczas przysyłania pliku.');
		}

		return end(explode('/', $target));
	}

	function initHeader(){
		global $db;
		$header = array();
		require_once(MODEL.'categorymodel.model.php');

		$catModel = new Categorymodel($db);
		
		$header['categories'] = $catModel->getCategories();

		$header['title'] = 'Szpilmajster.pl';

		return $header;
	}
?>