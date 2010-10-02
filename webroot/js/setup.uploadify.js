
uploadify_onopen_hook = function(element_id) { };
uploadify_oncomplete_hook = function(element_id) { };
uploadify_onallcomplate_hook = function(element_id) { };

function setup_uploadify(element_id, url, uploader, cancelimg, limit, multi, auto, buttontext) {

	$('#'+element_id).uploadify(
		{
			'uploader': uploader,
			'cancelImg': cancelimg,
			'auto': auto,
			'sizeLimit': limit,
			'multi': multi,
			'script': url,
			'scriptData': {　'PHPSESSID' : sid　},
			'buttonText': buttontext,
			'fileDesc': 'Select files',		
			'onOpen': function () { 
				uploadify_onopen_hook('"'+element_id+'"');
			},
			'onComplete': function () { 
				uploadify_oncomplete_hook('"'+element_id+'"');
			},
			'onAllComplete': function () { 
				uploadify_onallcomplate_hook('"'+element_id+'"');
			}
		}
	);
}

