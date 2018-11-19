<?php
include("../Tools/compt_header.php");

// ================================================== //
// Choisissons une année à consolider
// ================================================== //

$tmp_Annee = sql_query("SELECT `Int_Annee` FROM `$tableCompt_Annee`");
$allYear = "";
while ($aYear = mysql_fetch_assoc($tmp_Annee)){
  if ($aYear['Int_Annee'] == ($currentYear - 1)){
  $allYear .= "    <option value='".$aYear['Int_Annee']."' selected> ".$aYear['Int_Annee']." </option>";
  }
  else{
   $allYear .= "    <option value='".$aYear['Int_Annee']."'> ".$aYear['Int_Annee']." </option>"; 
  }
}

$formChangeYear = "
  <form method='post' action='solde_Resume.php'>
    <select name='chosenYear'>
$allYear
    </select>
    <input type='submit' name='ChangeYear' value='Changer d&#39;année' />
  </form>
";


// ================================================== //
// Pour toutes les périodes avec mouvement de l'année n
// on affiche toutes les périodes et le solde de chaque compte après 
// la période
// De plus, le total des mouvements par période est affiché
// ================================================== //

  $rowAllCompte    = "    <th> Compte </th>\n    <th> Delta </th>\n    <th colspan=2> Total </th>";
  $rowTitle        = "    <th> </th>\n    <th> Rev - Dep </th>\n    <th> D&eacute;pense </th>\n    <th> Revenu </th>";  
  $rowPeriode      = "";
  $tableAllPeriode  = "";
  // cumulatf par compte
  $soldeRevenu[]    = 0;
  $soldeDepense[]  = 0;
  // total par periode
  $totalRevenu      = 0;
  $totalDepense    = 0;
  // total de l'année
  $totalDelta      = 0;

  // récupère ID_Annee
  $tmp_Annee     = sql_query("SELECT `ID_Annee` FROM `$SQL_DATABASE`.`$tableCompt_Annee` WHERE `Int_Annee`='".$currentYear."' ");
  $aAnnee      = mysql_fetch_assoc($tmp_Annee);
  $idAnnee      = $aAnnee['ID_Annee'];
  $idPrevAnnee  = $idAnnee - 1;
  
  // Récupération de tous les comptes classé par ID_Compte
  $tmp_AllCompte = sql_query("
  SELECT 
    `Txt_NomCompte` 
  FROM 
    `$SQL_DATABASE`.`$tableCompt_Compte`
  ORDER BY 
    `ID_Compte`");
    
  while ($aCompte = mysql_fetch_assoc($tmp_AllCompte)){
    $rowAllCompte   .= "    <th colspan=2> ".$aCompte['Txt_NomCompte']." </th>\n";
    $rowTitle      .= "    <th> D&eacute;pense </th>\n    <th> Revenu </th>";  
  }
  
  
  // Selection de toutes les périodes
  $tmp_Periode = sql_query("
  SELECT 
    `$tableCompt_Periode`.`ID_Periode`, `$tableCompt_Periode`.`Txt_NomPeriode`
  FROM
    `$SQL_DATABASE`.`$tableCompt_Mouvement`,
    `$SQL_DATABASE`.`$tableCompt_Periode`
  WHERE
    `$tableCompt_Mouvement`.`Id_Annee` = '".$idAnnee."' AND
    `$tableCompt_Mouvement`.`Id_Periode` = `$tableCompt_Periode`.`ID_Periode`
  GROUP BY
    `$tableCompt_Periode`.`ID_Periode`
  ");
  
  
  // pour chacune des périodes
  while ($aPeriode = mysql_fetch_assoc($tmp_Periode)){
  
    $tmp_AllCompte = sql_query("
    SELECT 
      `ID_Compte`, `Txt_NomCompte`, `Txt_Devise`
    FROM 
      `$SQL_DATABASE`.`$tableCompt_Compte`
    ORDER BY 
      `ID_Compte`");  
  
    while ($aCompte = mysql_fetch_assoc($tmp_AllCompte)){
    
      $tmp_allMouvement = sql_query("
      SELECT 
        SUM(`$tableCompt_Mouvement`.`Dble_Revenu`),
        SUM(`$tableCompt_Mouvement`.`Dble_Depense`)
      FROM 
        `$SQL_DATABASE`.`$tableCompt_Mouvement`
      WHERE
        `$tableCompt_Mouvement`.`Id_Compte` = '".$aCompte['ID_Compte']."' AND
        `$tableCompt_Mouvement`.`Id_Annee` = '".$idAnnee."' AND
        `$tableCompt_Mouvement`.`Id_Periode`  = '".$aPeriode['ID_Periode']."'
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
      
      $aMouvement = mysql_fetch_assoc($tmp_allMouvement);
      // $soldeRevenu[$aCompte['ID_Compte']]  += $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Revenu`)"];
      // $soldeDepense[$aCompte['ID_Compte']]  += $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Depense`)"];
      $totalRevenu                      += $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Revenu`)"];
      $totalDepense                    += $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Depense`)"];
  
      $colorTag    = ($aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Depense`)"] <= 0 ) ? "class='SoldePositif'" : "class='SoldeNegatif'";
      $value      = ($aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Depense`)"] != 0) ? $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Depense`)"]." ".$aCompte['Txt_Devise'] : "";
      $rowPeriode  .= "    <td $colorTag> ".$value." </td>\n";  
      $colorTag    = ($aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Revenu`)"] >=   0 ) ? "class='SoldePositif'" : "class='SoldeNegatif'";
      $value      = ($aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Revenu`)"] != 0) ? $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Revenu`)"]." ".$aCompte['Txt_Devise'] : "";
      $rowPeriode   .= "    <td $colorTag> ".$value." </td>\n";

      
    }
    
    $DeltaColor      = ($totalRevenu < $totalDepense) ? "color:red;" : "color: darkgreen;";
    
    $rowPeriode     = "    <td> ".$aPeriode['Txt_NomPeriode']." </td>\n    <td style='font-weight:bold; $DeltaColor text-align:right;'> ".($totalRevenu- $totalDepense)." €</td>\n    <td> ".$totalDepense." </td>\n    <td> ".$totalRevenu." </td>\n".$rowPeriode;
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
echo $formChangeYear;

    
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
    
include("../Tools/compt_footer.php");
?>