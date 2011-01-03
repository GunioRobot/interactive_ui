# CakePHP interactive-ui helper

This plugin provides helper for in-place-editor, uploadify

## originals
    inplaceeditor : https://github.com/cyokodog/jquery.ex-in-place-editor

## Installation

movo to APP/plugins/

	git clone https://hidetoshing@github.com/hidetoshing/interactive_ui.git

## Usage

### 
	InPlaceEditor->input(fieldname, option, InPlaceEditor option);

### setup controller

	var $helpers = array(
		'InteractiveUi.InPlaceEditor',
	);

	function ajax_edit() {
		$this->layout = null;
		if (!empty($this->data)) {
			if (!$this->Item->save($this->data)) {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
			}
		}
	}

### view sample

	<?php echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js', array('inline' => false));?>
	<?php 
	echo $this->InPlaceEditor->init();
	echo $this->Uploadify->init();
	
	// set data_id for id, edit_url for data save action.
	$input_option = array('data_id' => $item['Item']['id'], 'edit_url' => array('action'=>'ajax_edit'));	
	?>
	
	<h1>intaractive-ui sample:</h1>
	
	<div id="contents">
		<?php echo $this->InPlaceEditor->input('name', $input_option, array('editorType' => 'input')); ?>
		<?php echo $this->InPlaceEditor->input('description', $input_option, array('editorType' => 'textarea')); ?>
	</div>

## License

Licensed under The MIT License.
Redistributions of files must retain the above copyright notice.

Copyright 2010, hidetoshing. (http://www.nanagaiku.com)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.


