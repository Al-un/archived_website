<?php
include_once('../Ztools/global_header.php');


// ==================================== SQL TABLES ================================ //
$table_cuisineRecette		= "cuisinerecette";
$table_cuisineIngredient	= "cuisineingredient";
$table_cuisineCate		 	= "cuisinecate";
$table_cuisineMateriel		= "cuisinemateriel";
$table_cuisineComm			= "cuisinecomm";
$table_cuisinePhoto  		= "cuisinephoto";
$table_cuisineIngreCate		= "cuisineingrecate";

$table_cuisineCateRecette	= "cuisinecaterecette";
$table_cuisineRecetteIngre	= "cuisinerecetteingre";
$table_cuisineRecetteMatos	= "cuisinerecettematos";
$table_cuisineCateIngre		= "cuisinecateingre";


// ==================================  LANGUAGES  ================================ //
$siteName         = "XsyMiam";
$css_array[] 			= '/Cuisine/tools/css_global.css';
$css_array[] 			= '/Cuisine/tools/css_recette.css';
// $css_array[] 			= '/Cuisine/tools/css_main.css';
$css_array[]			= '/Cuisine/tools/css_leftside.css';
$js_array[] 			= '/Cuisine/tools/jquery_all.js';
$optionalCss    = '';
$optionalJs     = '';
$body           = '';
$leftside[]		= "
  <div class = 'recette_menu'>	
  <ul>
   <li><a href = '/Cuisine/index.php'> Accueil </a></li>
   <li><a href = '/Cuisine/recette/recette_miam.php'> Les Recettes </a></li>";
if ($_SESSION['UserLevel'] >= 1){
$leftside[]		= "   <a href = '/Cuisine/recette/creer_menu.php'><li> Créer </li></a>";
// $leftside[]		= "   <a href = '/Cuisine/flood.php'><li> Commentaires </li></a>";
}
if ($_SESSION['UserLevel'] >= 2){
$leftside[]		= "   <a href = '/Cuisine/admin/admin_index.php'><li>Admin Control Panel</li></a>";
}
$leftside[]		= "  </ul>\n  </div>";
// $leftside[]		= "<div id='switch_JS'><p><a href='/Art/std-index.php'>$without_js</a></p></div>";
$rightside[] 	= '';
$beforePage		= '';
// $languages['Fr']= "Yes";
// $languages['En']= "No";
// $languages['ZhTr'] = "No";
$metaOthers		= "";
$headerMisc		= "";

globalHeader($siteName,$css_array, $js_array, $body,$leftside, $rightside, $beforePage, $metaOthers, $headerMisc) 
// globalHeader($siteName, $css, $js, "UTF-8", $optionalCss, $optionalJs, $body, $leftside, $rightside, $beforePage, $languages, $metaOthers, $headerMisc);

?>





			
							
				
 
				
				

<div style = 'text-align:center;'>
<a href = '/Cuisine/index.php'>
  <img src = '/Cuisine/img/ban.jpg' title = 'Miam' alt = 'Miam Ban' width = '95%'/>
</a>
</div>


	
	
		
	
	