

// ---------- function to show the sub menu under the menu on the top --------- //
function showsubmenu(i){
 
	var zesubmenu = "";
	var num = 0;
	for (num = 0; num < submenu[i].length; num++){
		zesubmenu += submenu[i][num];
	}
	document.getElementById("submenu").innerHTML =  zesubmenu;
}

// -------------- hide all submenu under the menu ------------------------------ //
function hidesubmenu(){
 	document.getElementById("submenu").innerHTML =  "";	
}

// -------------- show the menu on the left if necessary ----------------------- //
function showleftmenu(i){
 
 	if (i >= 0 && i <submenu.length){
		var zesubmenu = "";
		var num = 0;
			for (num = 0; num < submenu[i].length; num++){
				zesubmenu += submenu[i][num];
			}
		document.getElementById("menuleft").innerHTML =  zesubmenu;
	}
}

