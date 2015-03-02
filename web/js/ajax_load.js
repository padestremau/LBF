// -------------------------------------------   Ajax load function - LBF  -----------------------------------------------

function loadContentLogin(path_chosen)
{
	$('#login_content').fadeOut('slow',loadContent);

	function loadContent() {
		document.getElementById('login_content').innerHTML = '';   // A enlever ?
		var toLoad = path_chosen +' #login_content';
		var headerChange = path_chosen +' #login_name_status';
		var headerChange_XS = path_chosen +' #login_name_status_XS';
		// setTimeout(function(){alert('Hello')},3000);
		$('#login_content').load(toLoad,'',showNewContent());
		$('#login_name_status').load(headerChange,'',showNewHeaderStatus());
		$('#login_name_status_XS').load(headerChange_XS,'',showNewHeaderStatusXS());
	}
	function showNewContent() {
		$('#login_content').fadeIn('slow');
	}
	function showNewHeaderStatus() {
		$('#login_name_status').fadeIn('slow');
	}
	function showNewHeaderStatusXS() {
		$('#login_name_status_XS').fadeIn('slow');
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
		var headerChangeXS = path_chosen +' #login_name_status_XS';
		var breadcrumb = path_chosen +' #breadcrumb';
		$('#sectionContentAjax').load(toLoad,'',showNewContent());
		$('#login_name_status').load(headerChange,'',showNewHeaderStatus());
		$('#breadcrumb').load(breadcrumb,'',showNewBreadcrumb());
		$('#login_name_status_XS').load(headerChangeXS,'',showNewHeaderXSStatus());
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
	function showNewHeaderXSStatus() {
		$('#login_name_status_XS').fadeIn('slow');
	}


	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}


function loadContentAdmin(path_chosen)
{
	$('div#section_admin').fadeOut('slow',loadContent);

	function loadContent() {
		document.getElementById('section_admin').innerHTML = '';
		var toLoad = path_chosen +' #section_admin';
		var headerChange = path_chosen +' #login_name_status';
		var headerChangeXS = path_chosen +' #login_name_status_XS';
		var breadcrumb = path_chosen +' #breadcrumb';
		$('#section_admin').load(toLoad,'',showNewContent());
		$('#login_name_status').load(headerChange,'',showNewHeaderStatus());
		$('#breadcrumb').load(breadcrumb,'',showNewBreadcrumb());
		$('#login_name_status_XS').load(headerChangeXS,'',showNewHeaderXSStatus());
		document.getElementById('button_cart_a').className = "btn btn-log float-right ";
	}
	function showNewContent() {
		$('#section_admin').fadeIn('slow');
	}
	function showNewHeaderStatus() {
		$('#login_name_status').fadeIn('slow');
	}
	function showNewBreadcrumb() {
		$('#breadcrumb').fadeIn('slow');
	}
	function showNewHeaderXSStatus() {
		$('#login_name_status_XS').fadeIn('slow');
	}


	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}



section_admin