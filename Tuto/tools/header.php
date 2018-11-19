<?php		
	$index = (-1);
	if ( isset($_GET['index']) ){ $index = $_GET['index'];}	
	

include('../Ztools/global_header.php');


$title = "Tuto";
$css_array[] 					= '/Tuto/tools/css_global.css';
$css_array[] 					= '/Tuto/tools/design.css';
$js_array[] 						= '/Tuto/tools/script.js';
$js_array[] 						= '/Tuto/tools/menu.js';
$body           		= "onclick = 'hidesubmenu();' onload = 'showleftmenu($index);'";
$leftside[] 				= "";
$rightside[] 			= "";
$beforePage			= "";

$metaOthers			= "";
$headerMisc			= "";
// if ( isset($isAdminPage) && ($isAdminPage == true) ){
	// adminHeader($title, $css, $js, "UTF-8", $optionalCss, $optionalJs, $body, $leftside, $rightside, $beforePage, $languages, $metaOthers, $headerMisc);
// }
// else{
	// globalHeader($title, $css, $js, "UTF-8", $optionalCss, $optionalJs, $body, $leftside, $rightside, $beforePage, $languages, $metaOthers, $headerMisc);
// }
globalHeader($title,$css_array, $js_array, $body,$leftside, $rightside, $beforePage, $metaOthers, $headerMisc)
?>

<!-- the banner for the link to the real main page -->
	<div style = 'text-align:center;'>
		<a href = "/Tuto/index.php">
		<img src = "/Tuto/tools/ban_tuto.jpg" title = "Home Page" width = '95%' alt = "Tuto Ban" />
		</a>  
	</div>

<!-- 
	/*
	 * SIDE BAR
	 */-->
			
<div class = "sidebar">
				
	<!-- 
	/*
	 * the sub menu on the left
	 */-->
	<div  class = "menuleft">
		<ul id = "menuleft">
		</ul>
	</div>
			
			
	</div> <!-- end SIDE BAR -->


<!-- //begin the header  -->		
	<div class = "main">		
			
									
	<!--
	/*
	 * the main menu
	 */ -->	
	<div class = "menu">
		<ul>
		<a href = "/Tuto/?index=0">		<li onMouseOver = "showsubmenu(0);">Home Page</li>	</a>
		<a href = "/Tuto/html/?index=1">		<li onMouseOver = "showsubmenu(1);">HTML</li>		</a>
		<a href = "/Tuto/css/?index=2">		<li onMouseOver = "showsubmenu(2);">CSS</li>		</a>
		<a href = "/Tuto/php/?index=3">		<li onMouseOver = "showsubmenu(3);">PHP</li>		</a>
		<a href = "/Tuto/sql/?index=4">		<li onMouseOver = "showsubmenu(4);">SQL</li>		</a>
		<a href = "/Tuto/javascript?index=5">	<li onMouseOver = "showsubmenu(5);">Javascript</li>	</a>
		</ul>
	
	<!--
	/*
	 * the sub menu
	 */ -->				  

		<ul id = "submenu">
		</ul>
	</div>
			
	<br />
	<br />
			
