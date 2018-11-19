

function prevCate(){
	if (categorie == 0){ categorie = menu.length - 1;}
	else{ categorie--;}
	init(categorie);
}

function nextCate(){
	if (categorie == (menu.length-1)){ categorie = 0;}
	else{ categorie++;}
	init(categorie);
}