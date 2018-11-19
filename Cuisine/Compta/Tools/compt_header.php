<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root.'/Ztools/global_header.php');

// ==============     check sécurité   ================================================= //
if ($_SESSION['username'] != "Lainlun") {
  DIE("Admin login required");
}

//  ==========  année choisie? sinon par défaut, on prend l'année courante: ======================= //
if (isset($_POST['chosenYear'])) {
  $currentYear = get('chosenYear');
  $_SESSION['AnneeCompta'] = $currentYear;
}
else{
  $currentYear = (isset($_SESSION['AnneeCompta'])) ? $_SESSION['AnneeCompta'] : Date("Y");
}


// ==================================== SQL TABLES ================================ //
$tableCompt_Compte    = "Compt_Compte";
$tableCompt_Annee     = "Compt_Annee";
$tableCompt_Periode   = "Compt_Periode";
$tableCompt_Solde     = "Compt_Solde";
$tableCompt_Mouvement = "Compt_Mouvement";
$tableCompt_FraisFixe = "Compt_FraisFixe";

// ==================================  LANGUAGES  ================================ //
switch($_SESSION['userlang']) {
  case "Fr" : 
    $title        = "Comptabilit&eacute;";
  break;
  case "En" : 
    $title        = "Accounting";
    break;
  case "ZhTr" : 
    $title        = "";
    break;
  default : $title = "Compta, invalid lang:".$_SESSION['userlang'];
}
$css[]             = '/Compta/Tools/css_global.css';
$css[]             = '/Compta/Tools/css_compta.css';
$js[]             = '/Compta/Tools/jquery_all.js';
$optionalCss      = '';
$optionalJs        = '';
$body            = "";
$leftside[]        = "";
$rightside[]        = "";
$beforePage      = "";
$languages['Fr']    = "Yes";
$languages['En']    = "No";
$languages['ZhTr']   = "No";
$metaOthers      = "";
$headerMisc      = "";
 // $headerMisc    = "<noscript> <meta http-equiv='refresh' content='1; URL=std-index.php'> </noscript> ";

if ( isset($isAdminPage) && ($isAdminPage == true) ){
  adminHeader($title, $css, $js, "UTF-8", $optionalCss, $optionalJs, $body, $leftside, $rightside, $beforePage, $languages, $metaOthers, $headerMisc);
}
else{
  globalHeader($title, $css, $js, "UTF-8", $optionalCss, $optionalJs, $body, $leftside, $rightside, $beforePage, $languages, $metaOthers, $headerMisc);
}

echo("
<div class='sommaire'>
  <p>L'année choisie est ".(isset($_SESSION['AnneeCompta']) ? $_SESSION['AnneeCompta'] : $currentYear)."</p>
  <table>
    <tr>
    <th colspan=4> Gestion Compta </th>
    <th colspan=4> Administration </th>
    </tr>
    <tr>
    <td> <a href='/Compta/'> Home </a> </td>
    <td> <a href='/Compta/Admin/admin_FraisFixe.php'> Frais Fixes</a></td>
    <td> <a href='/Compta/Solde/solde_Resume.php'> Soldes Resum&eacute;</a></td>
    <td> <a href='/Compta/Solde/solde_setSolde.php'> Solder Ann&eacute;e </a></td>
    <td> <a href='/Compta/Admin/admin_compte.php'> Compte </a></td>
    <td> <a href='/Compta/Admin/admin_annee.php'> Ann&eacute;e </a> </td>
    <td> <a href='/Compta/Admin/admin_periode.php'> P&eacute;riode </a> </td>
    <td> <a href='/Compta/Tools/compt_checksql.php'> Table Management </a></td>
    </tr>
  </table>
</div>
");


      
              
        
 
        
        