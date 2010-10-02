<?php
class InPlaceEditorHelper extends AppHelper {
    public $helpers = array('Html', 'Form');

	public function init() {
		$tag = $this->Html->css('/interactive_ui/css/exinplaceeditor').PHP_EOL;
		$tag = $tag.$this->Html->script('/interactive_ui/js/jquery.exinplaceeditor.js').PHP_EOL;
		$tag = $tag.$this->Html->script('/interactive_ui/js/setup.inplaceeditor.js').PHP_EOL;
		
		return $tag;		
	}


	public function inplace_input($model, $field, $data_id, $url, $options = null) {
		$element_id = "ipe-$model-$field-$data_id";

		$m = ClassRegistry::init($model);
		$data = $m->find('first', array('conditions' => array("$model.id"=>$data_id)));

		return $this->_inplace_input($model, $field, $data_id, $url, $data[$model][$field], $element_id, 'input', $options);
	}


	public function inplace_textarea($model, $field, $data_id, $url, $options = null) {
		$element_id = "ipe-$model-$field-$data_id";

		$m = ClassRegistry::init($model);
		$data = $m->find('first', array('conditions' => array("$model.id"=>$data_id)));

		return $this->_inplace_input($model, $field, $data_id, $url, $data[$model][$field], $element_id, 'textarea', $options);
	}


	public function input($model, $field, $data_id, $url, $value, $id, $options = null) {
		return $this->_inplace_input($model, $field, $data_id, $url, $value, $id, 'input', $options);
	}


	public function _inplace_input($model, $field, $data_id, $url, $value, $id, $type, $options = null) {
		$flame_id = $id.'-flame';
		$output_id = $id.'-output';
		
		$url = $this->Html->url($url);
		
		$token_id = 'token';
		if (isset($this->params['_Token']) && !empty($this->params['_Token'])) {
			$token = $this->params['_Token']['key'];
		} else {
			$token = "";
		}
		
		$fields = array("$model.id"=>$data_id);
		$fields[] = "$model.$field";
		
		$secure = $this->Form->secure($fields);

		// options
		$htmledit = "false";
		$directedit = "true";
		
		if ($options) {
			if (isset($options['htmledit'])) {
				$htmledit = $options['htmledit'];
			}
			if (isset($options['directedit'])) {
				$directedit = $options['directedit'];
			}
		}
		
		$tag = "<span id='$flame_id'>";
		$tag = $tag.$secure;
		$tag = $tag."<span id='$id' data_id='$data_id' output='$output_id' url='$url' model='$model' field='$field' ";
		$tag = $tag."onmouseover=\"setup_inplaceeditor('$id', '$type', '$htmledit', '$directedit');\" $token_id='$token'>$value</span>";
		$tag = $tag."<span id='$output_id'></span>";
		$tag = $tag."</span>";

		return $tag.PHP_EOL;
	}

}
?>