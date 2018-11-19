/*Variables globales???*/
var tab2 = new Array();
	tab2[0] = new Image();tab2[0].src = "../img/animest2003.jpg";
	tab2[1] = new Image();tab2[1].src = "../img/animest2003v2.jpg";
	tab2[2] = new Image();tab2[2].src = "../img/animest2004.jpg";
	tab2[3] = new Image();tab2[3].src = "../img/animest2005.jpg";
	tab2[4] = new Image();tab2[4].src = "../img/animest2006.jpg";
	tab2[5] = new Image();tab2[5].src = "../img/animest2007.jpg";
	tab2[6] = new Image();tab2[6].src = "../img/animest2008.jpg";
	
var compteur = 0;
var nmax = 6;	

//redimensionnement des Affiches
function redim()
{
	affiche = new Image();
	affiche = document.images[3];
	
	largeur = affiche.width + 60;
	hauteur = affiche.height;
	
	window.resizeTo(largeur,hauteur);
	window.focus();
}

//créer la diapo
function diapo(i)
{
	compteur = i;
	test = window.open('affiche/affiche.html','Anim\'Est','width = 500, height = 500, scrollbars = yes, toolbar = no');
	alert(compteur);
}

function update()
{
	alert(compteur);
	affiche = new Image();
	affiche = document.images[3];
	affiche.src = tab2[compteur].src;
	redim();
}

function next()
{
	if (compteur == nmax)
		{compteur = 0;}
	else
		{compteur++;}
		
	affiche = new Image();
	affiche = document.images[3];
	affiche.src = tab2[compteur].src;
	redim();	
}

function back()
{
	if (compteur == 0)
		{compteur = nmax;}
	else
		{compteur--;}
		
	affiche = new Image();
	affiche = document.images[3];
	affiche.src = tab2[compteur].src;
}

function fermer()
{
	window.close();
}