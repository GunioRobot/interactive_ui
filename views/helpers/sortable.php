<?php
class SortableHelper extends AppHelper {

    public $helpers = array('Html', 'Form');

	var $_id = null;
	var $_url = null;

	public function init() {
		$tag = $this->Html->script('/interactive_ui/js/setup.sortable.js').PHP_EOL;	
		return $tag;	
	}
	
	public function setup_sortable($id, $url, $type) {

		$script = "<script type='text/javascript'>";
		switch($type) {
			case 'list':
				$script = $script." $(function(){ setup_sortable_list(\"$id\", \"$url\"); }); ";
				break;
			case 'table':
				$script = $script." $(function(){ setup_sortable_talbe(\"$id\", \"$url\"); }); ";
				break;
			default:
				$script = $script." $(function(){ setup_sortable_list(\"$id\", \"$url\"); }); ";
				break;
		}
		$script = $script."</script>".PHP_EOL;
		return $script;
	}

	public function list_create($id, $url) {
		
		$url = $this->Html->url($url);
		
		$tag = $this->setup_sortable($id, $url, 'list');
		$tag = $tag."<ul id='$id'>".PHP_EOL;
		return $tag;
	}
	
	public function list_item_start($data_id) {
		$tag = "<li class='sortable'><span data_id='$data_id'></span>".PHP_EOL;
		return $tag;
	}
	
	public function list_item_end() {
		$tag = "</li>";
		return $tag;
	}
	
	public function list_end() {
		$tag = "</ul>";
		return $tag;
	}
	
	
}
?>