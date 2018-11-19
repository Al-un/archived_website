

var menu = new Array();
	menu[0] = "home";
	menu[1] = "html";
	menu[2] = "css";
	menu[3]	= "php";
	menu[4] = "sql";
	menu[5] = "javascript";
	
var submenu = new Array();
	// -- Home
	submenu[0] = new Array();
	// -- HTML
	submenu[1] = new Array();
	submenu[1][0] = "<a href = '/Tuto/html/header.php?index=1'><li>Le début</li></a>";
	submenu[1][1] = "<a href = '/Tuto/html/hyperlink.php?index=1'><li>Liens Hypertextes</li></a>" // avec les ancres
	submenu[1][2] = "<a href = '/Tuto/html/list.php?index=1'><li>Les listes</li></a>";
	submenu[1][3] =	"<a href = '/Tuto/html/form.php?index=1'><li>Formulaire</li></a>";
	// -- CSS
	submenu[2] = new Array();
	submenu[2][0] = "<a href = '/Tuto/css/inheritance.php?index=2'><li>héritage</li></a>";
	submenu[2][1] = "<a href = '/Tuto/css/layout.php?index=2'><li>Mise en page</li></a>";
	submenu[2][2] = "<a href = '/Tuto/css/border.php?index=2'><li>Bordures</li></a>";
	submenu[2][3] = "<a href = '/Tuto/css/background.php?index=2'><li>Background</li></a>";
	submenu[2][4] = "<a href = '/Tuto/css/text.php?index=2'><li>Texte</li></a>";
	submenu[2][5] = "<a href = '/Tuto/css/dynamism.php?index=2'><li>du dynamisme</li></a>";
	// -- PHP
	submenu[3] = new Array();
	submenu[3][0] = "<a href = '/Tuto/php/form.php?index=3'><li>Formulaire</li></a>";
	submenu[3][1] = "<a href = '/Tuto/php/function.php?index=3'><li>Fonctions</li></a>";
	submenu[3][2] = "<a href = '/Tuto/php/upload.php?index=3'><li>Envoi de Fichier</li></a>";
	submenu[3][3] = "<a href = '/Tuto/php/session.php?index=3'><li>Session</li></a>";
	// -- SQL
	submenu[4] = new Array();
	submenu[4][0] = "<a href = '/Tuto/sql/connexion.php?index=4'><li>Connexion</li></a>";
	submenu[4][1] = "<a href = '/Tuto/sql/print.php?index=4'><li>Affichage</li></a>";
	submenu[4][2] = "<a href = '/Tuto/sql/modify.php?index=4'><li>Modifier une table</li></a>";
	submenu[4][3] = "<a href = '/Tuto/sql/injection.php?index=4'><li>Injection SQL</li></a>";
	// -- Javascript
	submenu[5] = new Array();
	submenu[5][0] = "<a href = '/Tuto/javascript/basis.php?index=5'><li>les bases</li></a>";
	submenu[5][1] = "<a href = '/Tuto/javascript/poo.php?index=5'><li>la POO</li></a>";
	submenu[5][2] = "<a href = '/Tuto/javascript/timer.php?index=5'><li>Les timers</li></a>";
	submenu[5][3] = "<a href = '/Tuto/javascript/form.php?index=5'><li>formulaires en Js</li></a>";
	// -- C++
	submenu[6] = new Array();