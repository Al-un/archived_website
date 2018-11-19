<?php
// ==================================== SQL TABLES ================================ //

// include_once($root.'/Ztools/global_header.php');
include_once(__DIR__.'/../Ztools/global_header.php');


// ==================================  LANGUAGES  ================================ //
$siteName         = "XsyHome";
$css_array[]      = "/Accueil/tools/css_global.css";
$css_array[]      = "/Accueil/tools/css_page.css";
// $css_array[]      = "/Accueil/tools/std-css_minisite.css";
$css_array[]      = "/Accueil/tools/css_minisite.css";
$css_array[]      = "/Accueil/tools/css_profile.css";
$js_array[]       = "/Accueil/tools/jquery_minisite.js";
$optionalCss      = "";
$optionalJs       = "";
//$body           = "onload = 'displayLoadScreen();'";
$body             = "";
$leftside[]       = "";
  // admin see all websites
  if ($_SESSION['UserAdmin']){
  
    $leftside[]     = "  <p><a href = 'index_admin.php'>Admin Panel</a></p>\n";
    $leftside[]     = "  <div>\n";
    // $leftside[]     = "  <p><a href = '/Compta'> Compta </a></p>";
/*
    $tmp_site     = Xsy_Sql_Query("SELECT `Site%Name`,`Url_Site%Url` FROM `$SQL_DATABASE`.`$table_all_minisites`");
    while ($aSite = mysql_fetch_assoc($tmp_site)){
      $leftside[] = "<p style='margin:auto;'> <a href='".$aSite['Url_Site%Url']."'> ".$aSite['Site%Name']." </a> </p>\n";
    }*/
    $leftside[]     = "  </div>\n";
  }
//$leftside[]     = '/Accueil/fav.php';
$rightside[]    = "";
//$rightside[]    = $root.'/Accueil/pense_bete.php';
$beforePage       = " <div id=HomeContent>
  <div id='HomeBan'>
  <a href = '/'> <img src='/Accueil/img/Accueil_ban.png' title='Xsylum Website' alt='Xsylum Website' width='96%'/> </a>
  </div>";
$metaOther        = "";
$headerMisc       = "";



globalHeader($siteName, $css_array, $js_array, $body, $leftside, $rightside, $beforePage, $metaOther, $headerMisc);


  // ========================================= MAIN CONTENT: CENTRAL ============================== //

?>
  
  <!--
  <div id = 'blank_left' style = 'position:fixed;visibility:visible;width:100%;height:100%;top:0;left:0%;'>
    <img src = '/Accueil/img/blank_left.png' title = 'Blank' alt = 'Blank image' width = '100%' height = '100%' />
  </div>
  <div id = 'blank_right' style = 'position:fixed;visibility:visible;width:100%;height:100%;top:0;right:0%;'>
    <img src = '/Accueil/img/blank_right.png' title = 'Blank' alt = 'Blank image' width = '100%' height = '100%' />
  </div>
  -->
  
  <!-- Banniere Xsylum -->


