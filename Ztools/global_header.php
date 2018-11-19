<?php

// include_once 'session_settings.php';
include_once 'global_settings.php';
include_once 'sql_login.php';
include_once 'session.php';
include_once 'sql_functions.php';
include_once 'sql_manager.php';
// include_once 'sql_displayTable.php';
include_once 'global_function.php';
include_once 'global_lang_variables.php';




// ========================================================================================
// Process language form
// ========================================================================================
// if (isset($_POST['UserLang'])){
if (isset($_POST['UserLangId'])){
  $_SESSION['UserLangId'] = Xsy_Glob_Get('UserLangId');
  $_SESSION['UserLang']   = $XSY_LANG[$_SESSION['UserLangId']]['Tag'];
}
// ========================================================================================
// Admin variables
// ========================================================================================
if($_SESSION['UserLevel'] == $XSY_SESS_ADMINLEVEL){
  // include_once 'admin_page.php';
}



// ============================================================================ //
// =======================  GLOBAL HEADER FUNCTION  ============================= //
// ============================================================================ //

function globalHeader($siteName, $css_array, $js_array, $body, $leftside, $rightside, $beforePage, $metaOthers, $headerMisc) {
 
  GLOBAL $XSY_SESS_ADMINLEVEL, $zToolsRoot, $website;
  $currentPage    = $_SERVER['PHP_SELF'];
  
// ------------------------------------- header ----------------------------------- //
// echo("<!DOCTYPE html>");
echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n");
echo('<html xmlns="http://www.w3.org/1999/xhtml">'."\n");
echo("
<!-- =========================   HEADER   ============================== -->

<head>
 <meta name='author' content='Xsylum' />
 <meta name='keywords' content='Xsylum' />
 <meta name='description' content='Xsylum website' />
 <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
 <!--<meta charset='UTF-8' />-->
$metaOthers
 <title>$siteName</title>
$headerMisc
");


// ---------------------------------------- CSS FILES ---------------------------------- //

// jquery Lightbox css
echo(" <link rel='stylesheet' type = 'text/css' title='Design' media='screen' href='".$zToolsRoot."/Ztools/sql_manager.css' /> \n");
echo(" <link rel='stylesheet' type = 'text/css' title='Design' media='screen' href='".$zToolsRoot."/Ztools/libraries/jquery.fs.scroller.css' /> \n");
  
// css files
foreach($css_array as $key => $cssfile) {
echo(" <link rel='stylesheet' type='text/css' title='Design' media='screen' href='$cssfile' />\n");
}
// if($_SESSION['UserLevel'] == $XSY_SESS_ADMINLEVEL){
  // echo(" <link rel='stylesheet' type='text/css' title='Design' media='screen' href='".$zToolsRoot."/Ztools/admin_page.css' />\n");
// }
  
  
// --------------------------------------- JS FILES ------------------------------------ //

  // Jquery updated on 21/08/2014
  echo(" <script type='text/javascript' src='".$zToolsRoot."/Ztools/libraries/jquery-1.11.1.min.js'> </script>\n");
  // echo(" <script type='text/javascript' src='".$zToolsRoot."/Ztools/libraries/jquery-1.10.2.min.js'> </script>\n");

  echo(" <script type='text/javascript' src='".$zToolsRoot."/Ztools/libraries/jquery-ui-1.10.3.custom.min.js'> </script>\n");

  // For custom scrolling
  echo(" <script type='text/javascript' src='".$zToolsRoot."/Ztools/libraries/jquery.fs.scroller.js'>   </script>\n");

  // for table administration :)
  echo(" <script type='text/javascript' src='".$zToolsRoot."/Ztools/sql_manager.js'> </script>\n");

  // external js files
  foreach($js_array as $key => $jsfile) {
    echo(" <script type='text/javascript' src='$jsfile'></script>\n");
  }
  // if($_SESSION['UserLevel'] == $XSY_SESS_ADMINLEVEL){
    // echo(" <script type='text/javascript' src='".$zToolsRoot."/Ztools/admin_page.js'> </script>\n");
  // }


// ----------------------------------- GOOGLE ANALYTICS --------------------------------- //
// for http://xsylum.fr only
echo(" <script type='text/javascript'>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-16260825-4', 'auto');
  ga('send', 'pageview');

</script>
</head>

<!-- ======================   BODY   =================================== -->

");

// ----------------------------------- BODY ------------------------------------------- //
$body = ($body == "") ? "<body>" : "<body $body>";
echo("$body\n");



// --------------------------- PRIORITY TO SQL FORMS ---------------------------------- //
echo(" <div id='Xsy_Sql_Popup'>
  <div id='Xsy_Sql_Modal'>
  </div>
 </div>\n");


// --------------------------------- LEFT SIDE ---------------------------------------- //
echo("
 <div id='Xsy_Glob_Left'>
  <div id='homepage'>
   <a href = '".$website."'><img src = '".$zToolsRoot."/Accueil/img/Accueil_ban.png' title = 'Main Home' alt = 'Main Home'/></a>
  </div>
");

if ($_SESSION['UserAdmin']){
echo("
  <div Id='SiteAdmin'>
    <div class='AdminLink'> <a href='http://localhost/phpmyadmin/index.php'> PhpMyAdmin Local </a> </div>
    <div class='AdminLink'> <a href='https://pf3.free-h.org:8443/domains/databases/phpMyAdmin/index.php?pleskStartSession'> PhpMyAdmin Free-h </a> </div>
    <div class='AdminLink'> <a href='http://www.xsylum.fr:2082/cpsess3133118438/3rdparty/phpMyAdmin/index.php'> PhpMyAdmin Ex2 </a> </div>
    <div class='AdminLink'> <a href='https://pf3.free-h.org:8443/login_up.php3'> Admin Free-h</a> </div>
    <div class='AdminLink'> <a href='http://xsylum.fr:2082/'> Admin Ex2 </a> </div>
  </div>
");
}

  // ---- LEFT ITEM
  foreach($leftside as $key => $leftItem){

    $extension = substr($leftItem, -4);
    if ($extension == ".php" || $extension == ".htm"){
      include($leftItem);
    }
    else{
      echo($leftItem);
    }    
  }

echo(" </div><!-- end class='left' -->
");
  
// --------------------------------- RIGHT SIDE ---------------------------------------- //
echo(" <div id='Xsy_Glob_Right'>\n");

$langPanel = Xsy_Glob_LangPanel($siteName);
echo($langPanel);
if($_SESSION['UserAdmin']) {echo("  <p class='Xsy_Admin_CheckLanguage'> session language is ".$_SESSION['UserLang']." </p>");}

  // ---- LOGIN  
  include_once('session_login_form.php');
  
  // ---- RIGHT ITEM
  foreach($rightside as $key => $rightItem){
    $extension = substr($rightItem, -4);
    if ($extension == ".php" || $extension == ".htm"){
      include($root.$rightItem);
    }
    else{
      echo($rightItem);
    }
  }


echo(" </div><!-- end class='right' -->  
$beforePage

<!-- =============================   PAGE  =============================== -->  

<div id='Xsy_Glob_Page'>");
}

?>
