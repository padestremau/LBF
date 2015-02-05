// -------------------------------------------   Ajax load function - LBF  -----------------------------------------------

function loadContentLogin(path_chosen)
{
	$('div#login_content').hide('slow',loadContent);

	function loadContent() {
		var toLoad = path_chosen +' #login_content';
		var headerChange = path_chosen +' #login_name_status';
		$('#login_content').load(toLoad,'',showNewContent())
		$('#login_name_status').load(headerChange,'',showNewHeaderStatus())
	}
	function showNewContent() {
		$('#login_content').show('slow');
	}
	function showNewHeaderStatus() {
		$('#login_name_status').show('slow');
	}

	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}


function modalLoad(path_chosen)
{
	var toLoad = path_chosen +' #login_content';
	$('#div_toBeFilled_login').load(toLoad,'',showNewContent())

	function showNewContent() {
		$('#div_toBeFilled_login').show('slow');
	}
	
	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}


