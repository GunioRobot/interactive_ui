<?php

class InPlaceEditorComponent extends Object {

	var $components = array('RequestHandler');
	var $_controller;

	//called before Controller::beforeFilter()
	function initialize(&$controller) {
		// saving the controller reference for later use
		$this->_controller =& $controller;
		
	}

	//called after Controller::beforeFilter()
	function startup(&$controller) {

	}

}
?>