<?php
$sqlPho_UserAccount   = "Pho_UserAccount";
include_once("phobida_session_mngt.php");
// include_once("phobida_sql_login.php");
include_once("phobida_sql_function.php");
include_once("phobida_setting.php");
// if ($_SESSION['useradmin']){include_once("phobida_sql_table_manager.php");}


// Admin additionnal content
$adminLink = ($_SESSION['useradmin']) ? "<li> <a href='".$urlAdmin."'> ".$contentAdmin." </a> </li>\n" : "";
$adminCss = ($_SESSION['useradmin']) ? "<link rel = 'stylesheet' type = 'text/css' title = 'Design' media = 'screen' href = '".$urlRoot."Tools/phobida_css_admin.css' />\n" : "";
$adminJs = ($_SESSION['useradmin']) ? "<script type='text/javascript' src='".$urlRoot."Tools/phobida_js_query_admin.js'> </script>\n" : "";




// ======================================================================================== //
// >>>>>>>>>>>>>>>>>>>>>>            xHTML 1.0 Strict Header  (DTD)  
// ======================================================================================== //


// xHTML Strict header
echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">');
echo("
<head>
  <meta name = 'author' content = 'Xsylum' />
  <meta http-equiv = 'Content-Type' content = 'text/html;charset=UTF-8' />
  <title> Phở Bida Việt Nam</title>
  <link rel='shortcut icon' href='".$urlRoot."phobida_icon.ico' />
  <!-- CSS stylesheets -->
  <link rel = 'stylesheet' type = 'text/css' title = 'Design' media = 'screen' href = '".$urlRoot."Tools/phobida_css_all.css' />
  $adminCss
  <link rel = 'stylesheet' type = 'text/css' title = 'Design' media = 'screen' href = '".$urlRoot."Tools/Libraries/fancybox/jquery.fancybox-1.3.4.css' />
  <!-- Javascript with jQuery Library -->
  <script type='text/javascript' src='".$urlRoot."Tools/Libraries/jquery-1.5.js'> </script>
  <script type='text/javascript' src='".$urlRoot."Tools/Libraries/fancybox/jquery.fancybox-1.3.4.js'> </script>
  <script type='text/javascript' src='".$urlRoot."Tools/Libraries/fancybox/jquery.mousewheel-3.0.4.pack.js'> </script>
  <script type='text/javascript' src='".$urlRoot."Tools/phobida_js_query_all.js'> </script>
  $adminJs
</head>

<!-- ================================================================================ -->
<!-- ====================================BODY======================================== -->
<!-- ================================================================================ -->

<body>
 <div id='Phobida_TopPanel'>

  <div id='Phobida_Logo'>
    <a href='".$urlHome."'> <img src='".$urlRoot."Tools/img/phobida_logo.png' alt='Phobida' title='Phobida' /> </a>
  </div>
  
  <div id='Phobida_HeaderMenu'>
    <table>
      <tr>
      <td> <a href='".$urlPho."'> ".$contentPho." </a> </td>
      <td> <a href='".$urlMenu."'> ".$contentMenu." </a> </td>
      <td> <a href='".$urlPhoto."'> ".$contentPhoto." </a> </td>
      <td> <a href='".$urlInfo."'> ".$contentInfo." </a> </td>
      </tr>
    </table>
  </div>
 </div> <!-- end Phobida_TopPanel -->
");










  // ======================================================================================== //
  // >>>>>>>>>>>>>>>>>>>>>>            Right Panel
  // ======================================================================================== //
  
  $allLangForm  = "   <div id='LanguagePanel'>\n";
  // French enabled?
  if (  ($_SESSION['useradmin'] OR $lang['Fr'])   && $_SESSION['userlang'] != 'Fr'    ){
    $allLangForm .= "<a href='?userlang=Fr'><img src='".$urlRoot."Tools/img/iconlang_fr.gif' style='height:18px; width:30px' title='Fran&ccedil;ais' alt='Fran&ccedil;ais' /></a>";}
  // English enabled?
  if (  ($_SESSION['useradmin'] OR $lang['En'])  && $_SESSION['userlang'] != 'En'      ){
    $allLangForm .= "<a href='?userlang=En'><img src='".$urlRoot."Tools/img/iconlang_en.gif' style='height:18px; width:30px' title='English' alt='English' /></a>";}
  // Traditional  Chinese enabled?
  if (  ($_SESSION['useradmin'] OR $lang['Tw']) && $_SESSION['userlang'] != 'Tw'  ){
    $allLangForm .= "<a href='?userlang=Tw'><img src='".$urlRoot."Tools/img/iconlang_tw.gif' style='height:18px; width:30px' title='中文-繁寫' alt='中文-繁寫' /></a>";}
  // Vietnamese enabled?
  if (  ($_SESSION['useradmin'] OR $lang['Vn'])   && $_SESSION['userlang'] != 'Vn'    ){
    $allLangForm .= "<a href='?userlang=Vn'><img src='".$urlRoot."Tools/img/iconlang_vn.gif' style='height:18px; width:30px' title='Việt' alt='Việt' /></a>";}

  $allLangForm  .= "   </div>";
  
  
// echo($allLangForm);


?>