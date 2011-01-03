<?php
class InPlaceEditorHelper extends AppHelper {
    public $helpers = array('Html', 'Form');

	var $defaultModel = null;
	
	var $option_default = array(
		'model' => false,
		'data_id' => false,
		'edit_url' => false,
	);
	
	var $editor_default = array(
		'api' => true,
		'dataSelect' => true,
		'nowHover' => true,
		'editorType' => 'input',
		'htmlEditor' => false,
		'directEdit' => true,
		'onsave' => 'inplaceeditor_onsave_hook',
	);
	
	public function init() {
		$tag = $this->Html->css('/interactive_ui/css/exinplaceeditor').PHP_EOL;
		$tag = $tag.$this->Html->script('/interactive_ui/js/jquery.exinplaceeditor.js').PHP_EOL;
		$tag = $tag.$this->Html->script('/interactive_ui/js/setup.inplaceeditor.js').PHP_EOL;

		return $tag;
	}

	public function _getModelName($model = false) {
		if (empty($model) && !empty($this->params['models'])) {
			return $this->defaultModel = $this->params['models'][0];
		}
		return $model;
	}

	public function _getToken() {
		return (isset($this->params['_Token']) && !empty($this->params['_Token'])) ? $this->params['_Token']['key'] : "";
	}
	
	public function _getData($fieldname, $data_id) {
		if (!empty($this->data) && isset($this->data[$this->defaultModel]) && !empty($this->data[$this->defaultModel]['id'])) {
			$data = $this->data;
		} else {
			$m =& ClassRegistry::init($this->defaultModel);
			$cond = ($data_id === false) ? array() : array('conditions' => array($this->defaultModel.".id"=>$data_id));
			$m->fields = array('id', $fieldname);
			$data = $m->find('first', $cond);
		}
		return $data;
	}

	public function input($fieldname, $options = array(), $editor_options = array()) {
		$_options = array_merge($this->option_default, $options);
		extract($_options);

		$_editor_options = json_encode($editor_options);

		$model = $this->_getModelName($model);
		if ($model === false) {
			return;
		}
				
		$data = $this->_getData($fieldname, $data_id);
		$value = $data[$model][$fieldname];
		$data_id = $data[$model]['id'];

		$element_id = "ipe-$model-$fieldname-$data_id";
		$flame_id = $element_id.'-flame';
		$output_id = $element_id.'-output';

		$url = $this->Html->url($edit_url);
		
		$token_id = 'token';
		$token = $this->_getToken();
		
		$fields = array("$model.id" => $data_id, "$model.$fieldname");
		$secure = $this->Form->secure($fields);

		$tag = "<span id='$flame_id'>";
		$tag = $tag.$secure;
		$tag = $tag."<span id='$element_id' data_id='$data_id' output='$output_id' url='$url' model='$model' field='$fieldname' ";
		$tag = $tag."onmouseover='$(\"#$element_id\").setupInplaceEditor($_editor_options);' $token_id='$token'>$value</span>";
		$tag = $tag."<span id='$output_id'></span>";
		$tag = $tag."</span>";

		return $tag.PHP_EOL;
	}

}
?>