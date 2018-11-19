<?php
// $root = $_SERVER['DOCUMENT_ROOT'];
// include_once($root.'/Ztools/global_header.php');
include_once(__DIR__.'/../../Ztools/global_header.php');

// get the content of a php file into a string...
function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
  else{
    echo("<p>$filename not found</p>");
  }
    return false;
}

// =================================== SQL TABLES ================================ //

// ==================================  LANGUAGES  ================================ //
switch($_SESSION['UserLang']) {
  case "Fr" : 
    $title            = "Curriculum vitae";
  break;
  case "En" : 
    $title            = "R&eacute;sum&eacute;";
    break;
  case "ZhTr" : 
    $title            = "簡歷";
    break;
  default : $title = "CV, invalid lang:".$_SESSION['UserLang'];
}

// ==================================  GLOBAL HEADER  ================================ //
$css_array[]        = '/CV/tools/design.css';
$css_array[]        = '/CV/tools/design-global.css';
$js_array[]         = '/CV/tools/jquery_cv.js';
$js_array[]         = '/CV/tools/jquery_side.js';
$body               = '';
$leftside[]         = '';
$rightside[]        = '';
$beforePage         = '';
$metaOther          = '';
$headerMisc         = '';

globalHeader($title, $css_array, $js_array, $body, $leftside, $rightside, $beforePage, $metaOther, $headerMisc);

// ==================================  SUMMARY  ======================================= //
switch($_SESSION['UserLang']) {
  case "Fr" : 
    $home   = "Accueil";
    $contact= "Contact";
    $profile= "Profil";
  break;
  case "En" : 
    $home   = "Home Page";
    $contact= "Contact";
    $profile= "Profile";
    break;
  case "ZhTr" : 
    $home   = "首頁";
    $contact= "聯繫";
    $profile= "側像";
    break;
  default : $summary = "CV, invalid lang:".$_SESSION['UserLang'];
}

echo("
  <div id='summary'>
  <table>
    <tr>
  <td> <a href='/CV/'>         $home </a> </td>
  <td> <a href='/CV/profile/'> $profile </a> </td>
  <td> <a href='/CV/cv/'>      $title </a> </td>
  <td> <a href='/CV/contact/'> $contact </a> </td>  
  </tr>
  </table>
  </div>
");









