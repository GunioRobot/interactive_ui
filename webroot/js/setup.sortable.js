
function setup_sortable_list(element_id, url) {
	$("#"+element_id).sortable({ 
		stop : function() {
			$("#"+element_id+" > li").each(function(index, e){
				$.post(url+'/'+$(this).find('[data_id]').attr('data_id')+'/'+index);
			});
		}
	});
}

function setup_sortable_table(element_id, url) {
	$("#"+element_id).sortable({ 
		stop : function(){
			$("#"+element_id+" > tr").each(function(index, e){
				$.post(url+'/'+$(this).attr('data_id')+'/'+index);
			});
		}
	});
}

function unset_sortable(element_id) {
	$("#"+element_id).sortable('destory');			
}
