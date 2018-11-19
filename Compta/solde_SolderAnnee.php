<?php
include_once("compt_header.php");
if(Xsy_Glob_AuthCheck("Compta", $XSY_SESS_ADMINLEVEL)) {

  echo($summary);

// ================================================== //
// Choisissons une année à consolider
// ================================================== //


$formConsoliderAnnee = "
  <form method='post' action=''>
    ".Xsy_Sql_DisplayFieldValue('Id_ComptAnnee', $_SESSION['ComptAnneeID'], "Update")."
    <input type='submit' name='XsyComptSolderAnnee' value='Consolider' />
  </form>
";
$formConsoliderAnneeDelete = "
  <form method='post' action=''>
    ".Xsy_Sql_DisplayFieldValue('Id_ComptAnnee', $_SESSION['ComptAnneeID'], "Update")."
    <input type='submit' name='XsyComptSupprSoldeAnnee' value='Supprimer Année de consolidation' />
  </form>
";


// ================================================== //
// Supprimer une année de consolidation
// ================================================== //
if (isset($_POST['XsyComptSupprSoldeAnnee'])) {

  if(Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_ComptSolde, 'Id_ComptAnnee', Xsy_Glob_Get('Id_ComptAnnee'))){
    echo ("Consolidation correctement supprimée pour l'année.");
  }
  else{
    echo(" Erreur dans la suppression de la consolidation de l'année.");
  }  
}



// ================================================== //
// Calcul du solde de l'année n basé sur les soldes 
// de l'année n-1 et tous les mouvements
// ================================================== //
if (isset($_POST['XsyComptSolderAnnee'])){

  // quelle année?
  $idAnneeSoldee = Xsy_Glob_Get('Id_ComptAnnee');
  $idAnneePrec  = $idAnneeSoldee - 1;

  // pour chacun des comptes...
  $allCompteArray = Xsy_Sql_FetchAll("SELECT `ID_ComptCompte`, `Txt_ComptCompte%Name` FROM `$SQL_DATABASE`.`$sqlTable_ComptCompte` ORDER BY `ID_ComptCompte`");
  $allInsert = TRUE;

  
  foreach($allCompteArray as $key => $aCompte){

    $allMouvementArray = Xsy_Sql_FetchAll("
    SELECT  SUM(`$sqlTable_ComptMouvement`.`Dble_Revenu`), SUM(`$sqlTable_ComptMouvement`.`Dble_Depense`)
    FROM `$SQL_DATABASE`.`$sqlTable_ComptMouvement`
    WHERE `$sqlTable_ComptMouvement`.`Id_ComptCompte` = '".$aCompte['ID_ComptCompte']."' AND `$sqlTable_ComptMouvement`.`Id_ComptAnnee` = '".$idAnneeSoldee."'");
    $allOldSoldeArray = Xsy_Sql_FetchAll("
    SELECT `$sqlTable_ComptSolde`.`Dble_Value`
    FROM `$SQL_DATABASE`.`$sqlTable_ComptSolde`
    WHERE `$sqlTable_ComptSolde`.`Id_ComptCompte` = '".$aCompte['ID_ComptCompte']."' AND `$sqlTable_ComptSolde`.`Id_ComptAnnee` = '".$idAnneePrec."'");


    $newSolde = $allOldSoldeArray[0]['Dble_Value'] + 
                $allMouvementArray[0]["SUM(`$sqlTable_ComptMouvement`.`Dble_Revenu`)"] -
                $allMouvementArray[0]["SUM(`$sqlTable_ComptMouvement`.`Dble_Depense`)"];

    $newSoldeToInsert['Id_ComptCompte'] = $aCompte['ID_ComptCompte'];
    $newSoldeToInsert['Id_ComptAnnee'] = $idAnneeSoldee;
    $newSoldeToInsert['Dble_Value'] = $newSolde;
    
    if (Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_ComptSolde, $newSoldeToInsert)){
      echo ("<p>Consolidation correctement effectuée pour l'année ($idAnneeSoldee) pour le compte ".$aCompte['Txt_ComptCompte%Name']."</p>");
    }
    else{
      echo("<p>Erreur dans la consolidation de l'année ($idAnneeSoldee) pour le compte ".$aCompte['Txt_ComptCompte%Name']."</p>");
    }
  }
}



// ================================================== //
// Affichage de toutes les soldes
// ================================================== //
$allCompteArray = Xsy_Sql_FetchAll("SELECT `Txt_ComptCompte%Name` FROM $sqlTable_ComptCompte ORDER BY `ID_ComptCompte`");

  $allCompte = "    <th> Compte </th>\n";
  foreach($allCompteArray as $key => $aCompte){
    $allCompte .= "    <th> ".$aCompte['Txt_ComptCompte%Name']." </th>\n";
  }
  $allCompte = "  <tr> ".$allCompte."\n  </tr>";

  $allSoldeArray = Xsy_Sql_FetchAll("
  SELECT
    `$sqlTable_ComptAnnee`.`Int_ComptAnnee%Name`,
    `$sqlTable_ComptSolde`.`Dble_Value`,
    `$sqlTable_ComptCompte`.`Txt_Devise` 
  FROM
    `$SQL_DATABASE`.`$sqlTable_ComptAnnee`, 
    `$SQL_DATABASE`.`$sqlTable_ComptCompte`,
    `$SQL_DATABASE`.`$sqlTable_ComptSolde`
  WHERE
    `$sqlTable_ComptSolde`.`Id_ComptCompte` = `$sqlTable_ComptCompte`.`ID_ComptCompte` AND
    `$sqlTable_ComptAnnee`.`ID_ComptAnnee` =`$sqlTable_ComptSolde`.`Id_ComptAnnee`
  ORDER BY
    `$sqlTable_ComptAnnee`.`ID_ComptAnnee`,
    `$sqlTable_ComptSolde`.`Id_ComptCompte`");

  $annee   = 0;
  $allSolde  = "";
foreach($allSoldeArray as $key => $aSolde ) {
  if ($annee != $aSolde['Int_ComptAnnee%Name']){
    $annee = $aSolde['Int_ComptAnnee%Name'];
    $allSolde .= "</tr>\n  <tr>\n    <td> ".$aSolde['Int_ComptAnnee%Name']." </td>\n";
  }
    $allSolde .= "    <td> ".$aSolde['Dble_Value']." ".$aSolde['Txt_Devise']." </td>\n";
}


// Set solde
echo $formConsoliderAnnee;
echo $formConsoliderAnneeDelete;


// Display all Solde
echo("
  <table class='setSoldeDisplay'>
$allCompte
$allSolde
  </table>");




}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}
include_once("compt_footer.php");
?>