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
		$('#login_content').load(toLoad,'',function(responseTxt, statusTxt, xhr) {
			if(statusTxt == "success") {
				$('#login_content').fadeIn('slow');
			}
			else {
	            alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		});
		$('#login_name_status').load(headerChange,'',function(responseTxt, statusTxt, xhr) {
			if(statusTxt == "success") {
				$('#login_name_status').fadeIn('slow');
			}
			else {
	            alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		});
		$('#login_name_status_XS').load(headerChange_XS,'',function(responseTxt, statusTxt, xhr) {
			if(statusTxt == "success") {
				$('#login_name_status_XS').fadeIn('slow');
			}
			else {
	            alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		});
	}

	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}


function loadContentCart(path_chosen)
{
	$('#sectionContentAjax').fadeOut('slow',loadContent);

	function loadContent() {
		document.getElementById('sectionContentAjax').innerHTML = '';
		var toLoad = path_chosen +' #sectionContentAjax';
		var headerChange = path_chosen +' #login_name_status';
		var headerChangeXS = path_chosen +' #login_name_status_XS';
		var breadcrumb = path_chosen +' #breadcrumb';
		$('#sectionContentAjax').load(toLoad,'',function(responseTxt, statusTxt, xhr) {
			if(statusTxt == "success") {
				$('#sectionContentAjax').fadeIn('slow');
			}
			else {
	            alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		});
		$('#login_name_status').load(headerChange,'',function(responseTxt, statusTxt, xhr) {
			if(statusTxt == "success") {
				$('#login_name_status').fadeIn('slow');
			}
			else {
	            alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		});
		$('#breadcrumb').load(breadcrumb,'',function(responseTxt, statusTxt, xhr) {
			if(statusTxt == "success") {
				$('#breadcrumb').fadeIn('slow');
			}
			else {
	            alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		});
		$('#login_name_status_XS').load(headerChangeXS,'',function(responseTxt, statusTxt, xhr) {
			if(statusTxt == "success") {
				$('#login_name_status_XS').fadeIn('slow');
			}
			else {
	            alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		});
		document.getElementById('button_cart_a').className = "btn btn-log float-right ";
	}

	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}


function loadContentAdmin(path_chosen)
{
	$('#section_admin').fadeOut('slow',loadContent);

	function loadContent() {
		document.getElementById('section_admin').innerHTML = '';
		var toLoad = path_chosen +' #section_admin';
		var headerChange = path_chosen +' #nav_admin';
		$('#section_admin').load(toLoad,'',function(responseTxt, statusTxt, xhr) {
			if(statusTxt == "success") {
				$('#section_admin').fadeIn('slow');
			}
			else {
	            alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		});
		$('#nav_admin').load(headerChange,'',function(responseTxt, statusTxt, xhr) {
			if(statusTxt == "success") {
				$('#nav_admin').fadeIn('slow');
			}
			else {
	            alert("Error: " + xhr.status + ": " + xhr.statusText);
			}
		});
	}

	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}