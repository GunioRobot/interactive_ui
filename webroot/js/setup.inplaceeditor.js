(function($){
	
	var inplaceeditor_oninit_hook = function( api ) { 
		var htmltext = api.getValue(); 
		htmltext = htmltext.replace(/\r\n/g, '<br />');
		htmltext = htmltext.replace(/(\n|\r)/g, '<br />');
		api.getLabel().html(htmltext);					
	};

	var inplaceeditor_onsave_hook = function( api ) {
		var $target = api.getTarget();
		var key_id = "data["+$target.attr('model')+"][id]";
		var value_id = "data["+$target.attr('model')+"]["+$target.attr('field')+"]";
	
		var data = new Object();
		data[key_id] = $target.attr('data_id');
		data[value_id] = api.getValue();
		data['data[_Token][key]'] = $target.attr('token');
		data['data[_Token][fields]'] = $('#'+$target.attr('id')+'-flame > :hidden :first').val();
		api.saving();
		$('#'+$target.attr('output')).load(
			$target.attr('url')+'/'+$target.attr('data_id'),
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

	$.fn.setupInplaceEditor = function(options) {
		var defaults = {
			'api' : true,
			'dataSelect' : true,
			'nowHover' : true,
			'editorType' : "input",
			'htmlEditor' : false,
			'directEdit' : true,
			'oninit' : function( api ) { inplaceeditor_oninit_hook( api ); },
			'onsave' : function( api ) { inplaceeditor_onsave_hook( api ); }
		};
		var setting = $.extend(defaults, options);
		$(this).exInPlaceEditor(setting);
	}
	
})(jQuery);
