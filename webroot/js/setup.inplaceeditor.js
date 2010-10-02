
inplaceeditor_oninit_hook = function( api ) { 
	var htmltext = api.getValue(); 
	htmltext = htmltext.replace(/\r\n/g, '<br />');
	htmltext = htmltext.replace(/(\n|\r)/g, '<br />');
	api.getLabel().html(htmltext);					
};

inplaceeditor_onsave_hook = function( api ) { 
	var key_id = "data["+api.getTarget().attr('model')+"][id]";
	var value_id = "data["+api.getTarget().attr('model')+"]["+api.getTarget().attr('field')+"]";
	
	var data = new Object();
	data[key_id] = api.getTarget().attr('data_id');
	data[value_id] = api.getValue();
	data['data[_Token][key]'] = api.getTarget().attr('token');
	data['data[_Token][fields]'] = $('#'+api.getTarget().attr('id')+'-flame > :hidden :first').val();
	api.saving();
	$('#'+api.getTarget().attr('output')).load(
		api.getTarget().attr('url')+'/'+api.getTarget().attr('data_id'),
		data,
		function(data, status){
			if( status.errmsg ){
				api.saveError(status.errmsg);
				return;
			}
			api.saveComplete();
		}
	);
	return false;
};

function setup_inplaceeditor(element_id, editortype, htmleditor, directedit) {

	//alert($('#ipe-Item-name-2').html());
	
	$('#'+element_id).exInPlaceEditor({
		'api' : true,
		'dataSelect' : true,
		'nowHover' : true,
		'editorType' : editortype,
		'htmlEditor' : htmleditor,
		'directEdit' : directedit,
		'oninit' : function( api ) { inplaceeditor_oninit_hook( api ); },
		'onsave' : function( api ) { inplaceeditor_onsave_hook( api ); }
	});
	$('#'+element_id).attr('onmouceover', '');
}