<?php
include("compt_header.php");
if(Xsy_Glob_AuthCheck("Compta", $XSY_SESS_ADMINLEVEL)) {

  echo($summary);

// ================================================== //
// Choisissons une année à consolider
// ================================================== //

$formAnnee = "
  <form method='post' action=''>
    Ann&eacute;e:".Xsy_Sql_DisplayFieldValue('Id_ComptAnnee', $_SESSION['ComptAnneeID'], "Update")."
    <input type='Submit' value='Changer d&#39;année' />
  </form>";



// ================================================== //
// Pour toutes les périodes avec mouvement de l'année n
// on affiche toutes les périodes et le solde de chaque compte après 
// la période
// De plus, le total des mouvements par période est affiché
// ================================================== //

  $rowAllCompte     = "    <th> Compte </th>\n    <th> Delta </th>\n    <th colspan=2> Total </th>";
  $rowTitle         = "    <th> </th>\n    <th> Rev - Dep </th>\n    <th> D&eacute;pense </th>\n    <th> Revenu </th>";  
  $rowPeriode       = "";
  $tableAllPeriode  = "";
  // cumulatf par compte
  $soldeRevenu[]    = 0;
  $soldeDepense[]   = 0;
  // total par periode
  $totalRevenu      = 0;
  $totalDepense     = 0;
  // total de l'année
  $totalDelta       = 0;

  // récupère ID_Annee
/*
  $tmp_Annee     = sql_query("SELECT `ID_Annee` FROM `$SQL_DATABASE`.`$tableCompt_Annee` WHERE `Int_Annee`='".$currentYear."' ");
  $aAnnee        = mysql_fetch_assoc($tmp_Annee);
  $idAnnee      = $aAnnee['ID_Annee'];*/
  $idPrevAnnee  = $_SESSION['ComptAnneeID'] - 1;
  
  // Récupération de tous les comptes classé par ID_Compte
  $allCompteArray = Xsy_Sql_FetchAll("SELECT `Txt_ComptCompte%Name`, `Txt_Devise`, `Dble_TauxConversion` FROM `$SQL_DATABASE`.`$sqlTable_ComptCompte` ORDER BY `ID_ComptCompte`");

  foreach($allCompteArray as $key => $aCompte){
    $rowAllCompte   .= "    <th colspan=2> ".$aCompte['Txt_ComptCompte%Name']." </th>\n";
    $rowTitle      .= "    <th> D&eacute;pense </th>\n    <th> Revenu </th>";  
  }
  
  
  // Selection de toutes les périodes
  $allPeriodeArray = Xsy_Sql_FetchAll("
  SELECT 
    `$sqlTable_ComptPeriode`.`ID_ComptPeriode`, `$sqlTable_ComptPeriode`.`Txt_ComptPeriode%Name`
  FROM
    `$SQL_DATABASE`.`$sqlTable_ComptMouvement`, `$SQL_DATABASE`.`$sqlTable_ComptPeriode`
  WHERE
    `$sqlTable_ComptMouvement`.`Id_ComptAnnee` = '".$_SESSION['ComptAnneeID']."' AND
    `$sqlTable_ComptMouvement`.`Id_ComptPeriode` = `$sqlTable_ComptPeriode`.`ID_ComptPeriode`
  GROUP BY
    `$sqlTable_ComptPeriode`.`ID_ComptPeriode`
  ");
  
  // need all compte again?
  $allCompteArray = Xsy_Sql_FetchAll("SELECT `ID_ComptCompte`, `Txt_ComptCompte%Name`, `Txt_Devise`, `Dble_TauxConversion` FROM `$SQL_DATABASE`.`$sqlTable_ComptCompte` ORDER BY `ID_ComptCompte`");

  // pour chacune des périodes
  foreach($allPeriodeArray as $key => $aPeriode){
  
    foreach ($allCompteArray as $key => $aCompte){
    
      $stmt_Mouvement = Xsy_Sql_Query("
      SELECT 
        SUM(`$sqlTable_ComptMouvement`.`Dble_Revenu`),
        SUM(`$sqlTable_ComptMouvement`.`Dble_Depense`)
      FROM 
        `$SQL_DATABASE`.`$sqlTable_ComptMouvement`
      WHERE
        `$sqlTable_ComptMouvement`.`Id_ComptCompte` = '".$aCompte['ID_ComptCompte']."' AND
        `$sqlTable_ComptMouvement`.`Id_ComptAnnee` = '".$_SESSION['ComptAnneeID']."' AND
        `$sqlTable_ComptMouvement`.`Id_ComptPeriode`  = '".$aPeriode['ID_ComptPeriode']."'
      ");
      // $tmp_oldSolde = sql_query("
      // SELECT 
        // `$tableCompt_Solde`.`Dble_Value`
      // FROM 
        // `$SQL_DATABASE`.`$tableCompt_Solde`
      // WHERE
        // `$tableCompt_Solde`.`Id_Compte` = '".$aCompte['ID_Compte']."' AND
        // `$tableCompt_Solde`.`Id_Annee` = '".$idPrevAnnee."'
      // ");
      
      $aMouvement = Xsy_Sql_Fetch($stmt_Mouvement);
      // $soldeRevenu[$aCompte['ID_Compte']]  += $aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Revenu`)"];
      // $soldeDepense[$aCompte['ID_Compte']]  += $aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Depense`)"];
      $totalRevenu    += $aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Revenu`)"] / $aCompte['Dble_TauxConversion'];
      $totalDepense   += $aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Depense`)"] / $aCompte['Dble_TauxConversion'];
  
      $colorTag     = ($aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Depense`)"] <= 0 ) ? "class='SoldePositif'" : "class='SoldeNegatif'";
      $value        = ($aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Depense`)"] != 0) ? $aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Depense`)"]." ".$aCompte['Txt_Devise'] : "";
      $rowPeriode  .= "    <td $colorTag> ".$value." </td>\n";  
      $colorTag    = ($aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Revenu`)"] >=   0 ) ? "class='SoldePositif'" : "class='SoldeNegatif'";
      $value      = ($aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Revenu`)"] != 0) ? $aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Revenu`)"]." ".$aCompte['Txt_Devise'] : "";
      $rowPeriode   .= "    <td $colorTag> ".$value." </td>\n";

      
    }
    
    $DeltaColor      = ($totalRevenu < $totalDepense) ? "color:red;" : "color: darkgreen;";
    
    $rowPeriode     = "    <td> ".$aPeriode['Txt_ComptPeriode%Name']." </td>\n    <td style='font-weight:bold; $DeltaColor text-align:right;'> ".($totalRevenu- $totalDepense)." €</td>\n    <td> ".$totalDepense." </td>\n    <td> ".$totalRevenu." </td>\n".$rowPeriode;
    $tableAllPeriode.= "  <tr>\n".$rowPeriode."  </tr>\n";
    
    $totalDelta    += ($totalRevenu - $totalDepense);
    
    $rowPeriode    = "";
    $totalRevenu    = 0;
    $totalDepense  = 0;
    
    
  }
  

// ================================================== //
// Affichage de toutes les soldes
// ================================================== //

    
// Changer d'année
echo $formAnnee;

    
// Display all Solde
echo("
  <table class='setSoldeDisplay'>
  <tr>
$rowAllCompte
  </tr>
  <tr>
$rowTitle
  </tr>
$tableAllPeriode
  <tr>
    <td> Total </td>
  <td style='font-size:14px; text-align:right; background:darkblue;color:yellow; font-weight:bold;'> ".$totalDelta." € </td>
  </tr>
  </table>");




}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}
include("compt_footer.php");
?>