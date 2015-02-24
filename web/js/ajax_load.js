// -------------------------------------------   Ajax load function - LBF  -----------------------------------------------

function loadContentLogin(path_chosen)
{
	$('div#login_content').fadeOut('slow',loadContent);

	function loadContent() {
		var toLoad = path_chosen +' #login_content';
		var headerChange = path_chosen +' #login_name_status';
		$('#login_content').load(toLoad,'',showNewContent())
		$('#login_name_status').load(headerChange,'',showNewHeaderStatus())
	}
	function showNewContent() {
		$('#login_content').fadeIn('slow');
	}
	function showNewHeaderStatus() {
		$('#login_name_status').fadeIn('slow');
	}

	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}

function loadContentCart(path_chosen)
{
	$('div#sectionContentAjax').fadeOut('slow',loadContent);

	function loadContent() {
		document.getElementById('sectionContentAjax').innerHTML = '';
		var toLoad = path_chosen +' #sectionContentAjax';
		var headerChange = path_chosen +' #login_name_status';
		// var headerChangeBis = path_chosen +' #button_cart_div';
		var breadcrumb = path_chosen +' #breadcrumb';
		$('#sectionContentAjax').load(toLoad,'',showNewContent())
		$('#login_name_status').load(headerChange,'',showNewHeaderStatus())
		$('#breadcrumb').load(breadcrumb,'',showNewBreadcrumb())
		// $('#button_cart_div').load(headerChangeBis,'',showNewHeaderBisStatus())
		document.getElementById('button_cart_a').className = "btn btn-log float-right ";
	}
	function showNewContent() {
		$('#sectionContentAjax').fadeIn('slow');
	}
	function showNewHeaderStatus() {
		$('#login_name_status').fadeIn('slow');
	}
	function showNewBreadcrumb() {
		$('#breadcrumb').fadeIn('slow');
	}
	// function showNewHeaderBisStatus() {
	// 	$('#button_cart_div').fadeIn('slow');
	// }


	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}



