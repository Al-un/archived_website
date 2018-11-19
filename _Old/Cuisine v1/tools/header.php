<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root.'/Ztools/global_header.php');
// include($root.'/Art/tools/function_art.php');

switch($_SESSION['userlang']) {
	case "fr" : $title = "Coin Cuisine"; break;
	case "en" : $title = "Cooking Area"; break;
	case "zh-tr" : $title = ""; break;
	default : $title = "Cooking, invalid lang:".$_SESSION['userlang'];
}
$css[] 			= '/Cuisine/tools/css_global.css';
$css[] 			= '/Cuisine/tools/css_leftside.css';
$css[] 			= '/Cuisine/tools/css_main.css';
$js[]			= "";
$optionalCss    = "";
$optionalJs     = "";
$body           = "";
$leftside[] 	= "";
$rightside[] 	= "";
$beforePage		= '';
$languages['Fr']= "Yes";
$languages['En']= "No";
$languages['ZhTr'] = "No";
$metaOthers		= "";
$headerMisc		= "";
globalHeader($title, $css, $js, "UTF-8", $optionalCss, $optionalJs, $body, $leftside, $rightside, $beforePage, $languages, $metaOthers, $headerMisc);
?>

<div style = 'text-align:center;'>
<a href = '/Cuisine/index.php'>
  <img src = '/Cuisine/img/ban.jpg' title = 'Miam' alt = 'Miam Ban' width = '95%'/>
</a>
</div>

<div class = 'leftside'>
	
  <div class = 'menu'>	
  <ul>
    <a href = '/Cuisine/index.php'><li>Accueil 			</li></a>
    <a href = '/Cuisine/recette/recette_miam.php'><li> 	Les recettes	</li></a>
	<!-- // Le tableau des utilisateurs simples -->
		<?php if (isset($_SESSION['userid'])) { ?>
			<a href = '/Cuisine/recette/recette_creer.php'><li> 	Cr&eacute;er				</li></a>
			<a href = '/Cuisine/flood.php'><li> 	Commentaires		</li></a>
		<?php } ?>
	<!-- // Le tableau des admins  -->
		<?php if ($_SESSION['userlevel'] >= 2) { ?>
			<a href = '/Cuisine/admin/admin_index.php'><li>Admin Control Panel</li></a>
		<?php } ?>
	</ul>
	</div> <!-- end class = 'menu' -->
		
</div> <!-- class = 'leftside' -->
	
<div class = 'main'>
	
	
	
	
		
	
	