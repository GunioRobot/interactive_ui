<?php

class UploadComponent extends Object {

	var $components = array('InteractiveUi.Thumbmake');

	var $_controller;

	//called before Controller::beforeFilter()
	function initialize(&$controller) {
		$this->_controller =& $controller;
	}

	//called after Controller::beforeFilter()
	function startup(&$controller) {

	}
	
	function upload($path = null, $name = null, $width = null, $height = null) {
		$this->layout = null;
		$this->autoLayout = false;

		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			
			$ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
			$ext = strtolower($ext);
			
			if (!$path) {
				$targetPath = WWW_ROOT;
			} else {
				$targetPath = $path;
			}
			
			if (!$name) {
				$targetFile = 'files'.DS.$_FILES['Filedata']['name'];
			} else {
				$targetFile = $name.'.'.$ext;
			}

			$data = array(
				'filename' => $targetFile,
				'path' => $targetPath,
				'ext' => $ext,
			);
			
			move_uploaded_file($tempFile, $targetPath.$targetFile);
			
			if ($width) {
				if ($this->Thumbmake->setImage($targetPath.$targetFile, $targetPath.$targetFile)) {
					if ($this->Thumbmake->resizeCrop($width, $height)) {
						 $this->Thumbmake->save();
					} else {
						$this->set('error', 'サムネイルの作成に失敗しました。');
					}
				} else {
					$this->set('error', 'サムネイルの作成に失敗しました。');
				}
			}

			echo "1";

			// セッションを復元する
			$sid = $_POST['PHPSESSID'];
			session_write_close();
			session_destroy();

			session_id($sid);
			session_start();
			
			return $data;
		}
	}

}
?>