<?php
include_once(__DIR__.'/../Ztools/global_header.php');
include_once('compt_setting.php');

//  ==========  année choisie? sinon par défaut, on prend l'année courante: ======================= //

// année est changée
if (isset($_POST['Id_ComptAnnee'])) {
  $currentYearID = Xsy_Glob_Get('Id_ComptAnnee');
  $_SESSION['ComptAnneeID'] = $currentYearID;
  $comptYearArray = Xsy_Sql_FetchAll("SELECT `Int_ComptAnnee%Name` FROM `$SQL_DATABASE`.`$sqlTable_ComptAnnee` WHERE `ID_ComptAnnee` = '$currentYearID'");
  $_SESSION['ComptAnnee'] = $comptYearArray[0]['Int_ComptAnnee%Name'];
}
// année pas changée mais est-ce déjà définie?
else{
  if (!isset($_SESSION['ComptAnneeID'])){
    $comptYearArray = Xsy_Sql_FetchAll("SELECT `ID_ComptAnnee` FROM `$SQL_DATABASE`.`$sqlTable_ComptAnnee` WHERE `Int_ComptAnnee%Name` = '".Date("Y")."'");
    $_SESSION['ComptAnneeID'] = $comptYearArray[0]['ID_ComptAnnee'];
    $_SESSION['ComptAnnee'] = Date("Y");
  }
}


$summary = "
  <div class='sommaire'>
    <table>
      <tr>
      <th colspan=3> Ajouter entrée(s) </th>
      <th colspan=3> Gestion Compta </th>
      <th colspan=1> Administration </th>
      </tr>
      <tr>
      <td> <a href='index.php?ComptAction=XsyComptAddMouv'> Mouvement </a> </td>
      <td> <a href='index.php?ComptAction=XsyComptAddTransfer'> Transfert </a> </td>
      <td> <a href='index.php?ComptAction=XsyComptAddFraisFixe'> Frais Fixe </a> </td>
      <td> <a href='index.php'> Home </a> </td>
      <td> <a href='solde_Resume.php'> Soldes Resum&eacute;</a></td>
      <td> <a href='solde_SolderAnnee.php'> Solder Ann&eacute;e </a></td>
      <td> <a href='index_admin.php'> Admin Global </a></td>
      </tr>
    </table>
  </div>
  ";


// ==================================  LANGUAGES  ================================ //
$siteName      = "Compta";
$css_array[]   = 'css_global.css';
$css_array[]   = 'css_compta.css';
$js_array[]    = 'compt_all.js';
$body          = "";
$leftside[]    = "";
$rightside[]   = "";
$beforePage    = "";
$metaOther     = "";
$headerMisc    = "";
 // $headerMisc    = "<noscript> <meta http-equiv='refresh' content='1; URL=std-index.php'> </noscript> ";

globalHeader($siteName, $css_array, $js_array, $body, $leftside, $rightside, $beforePage, $metaOther, $headerMisc);








