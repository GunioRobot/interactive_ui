<?php
class UploadifyHelper extends AppHelper {
    var $helpers = array('Html');
	var $config = null;

	public function init() {
		
		$sid = session_id();
		
		$script = "<script type='text/javascript'>";
		$script = $script." sid = '$sid'; ";
		$script = $script."</script>".PHP_EOL;

		$tag = $this->Html->css('/interactive_ui/css/uploadify').PHP_EOL;
		$tag = $tag. $this->Html->script('/interactive_ui/js/swfobject.js').PHP_EOL;
		$tag = $tag. $this->Html->script('/interactive_ui/js/jquery.uploadify.min.js').PHP_EOL;
		$tag = $tag. $this->Html->script('/interactive_ui/js/setup.uploadify.js').PHP_EOL;
		
		return $script.$tag;
	}

	public function upload($id, $url, $options = array()) {
		
		//pr($this);
		
		$url = $this->Html->url($url);
		
		$uploader = $this->Html->webroot('interactive_ui/flash/uploadify.swf');
		$cancelimg = $this->Html->webroot('interactive_ui/img/cancel.png');
		
		$caption = 'Browse';
		$limit = '2000000';
		$multi = 'false';
		$auto = 'true';
		
		if ($options) {
			if (isset($options['limit'])) {
				$limit = $options['limit'];
			}
			if (isset($options['multi'])) {
				$multi = $options['multi'];
			}
			if (isset($options['auto'])) {
				$auto = $options['auto'];
			}
			if (isset($options['caption'])) {
				$caption = $options['caption'];
			}
		}
		
		$tag = "<div id='$id'>uploadify</div><div id='fileQueue'></div>";
		$script = "<script type='text/javascript'>";
		$script = $script." $(function(){ setup_uploadify('$id', '$url', '$uploader', '$cancelimg', $limit, $multi, $auto, '$caption' ); }); ";
		$script = $script."</script>";
		
		return $tag.$script.PHP_EOL;
	}
}
?>