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


$formConsoliderAnnee = "
  <form method='post' action='solde_setSolde.php'>
    <select name='chosenYear'>
$allYear
    </select>
    <input type='submit' name='SetSoldeYear' value='Consolider' />
  </form>
";
$formConsoliderAnneeDelete = "
  <form method='post' action='solde_setSolde.php'>
    <select name='chosenYear'>
$allYear
    </select>
    <input type='submit' name='DeleteSoldeYear' value='Supprimer Année de consolidation' />
  </form>
";

// ================================================== //
// Supprimer une année de consolidation
// ================================================== //
if (isset($_POST['DeleteSoldeYear'])) {

	// quelle année?
	$tmp_Annee 	= sql_query("SELECT `ID_Annee` FROM `$SQL_DATABASE`.`$tableCompt_Annee` WHERE `Int_Annee`='".$currentYear."'");
	$aAnnee			= mysql_fetch_assoc($tmp_Annee);
	$idAnnee			= $aAnnee['ID_Annee'];
	
	$allDelete			= sql_query("DELETE FROM `$SQL_DATABASE`.`$tableCompt_Solde` WHERE `Id_Annee` = '".$idAnnee."'");
	
	if ($allDelete){
		echo ("Consolidation correctement supprimée pour l'année ".$currentYear);
	}
	else{
		echo(" Erreur dans la suppression de la consolidation de l'année ".$currentYear);
	}	
}



// ================================================== //
// Calcul du solde de l'année n basé sur les soldes 
// de l'année n-1 et tous les mouvements
// ================================================== //
if (isset($_POST['SetSoldeYear'])){

	// quelle année?
	$tmp_Annee 	= sql_query("SELECT `ID_Annee` FROM `$SQL_DATABASE`.`$tableCompt_Annee` WHERE `Int_Annee`='".$currentYear."'");
	$aAnnee			= mysql_fetch_assoc($tmp_Annee);
	$idAnnee			= $aAnnee['ID_Annee'];
	$idPrevAnnee	= $idAnnee - 1;

	
	$tmp_AllCompte = sql_query("SELECT `ID_Compte`, `Txt_NomCompte` FROM `$SQL_DATABASE`.`$tableCompt_Compte` ORDER BY `ID_Compte`");
	$allInsert = TRUE;
	
	while ($aCompte = mysql_fetch_assoc($tmp_AllCompte)){

		$tmp_allMouvement = sql_query("
		SELECT 
			SUM(`$tableCompt_Mouvement`.`Dble_Revenu`),
			SUM(`$tableCompt_Mouvement`.`Dble_Depense`)
		FROM 
			`$SQL_DATABASE`.`$tableCompt_Mouvement`
		WHERE
			`$tableCompt_Mouvement`.`Id_Compte` = '".$aCompte['ID_Compte']."' AND
			`$tableCompt_Mouvement`.`Id_Annee` = '".$idAnnee."'
		");
		$tmp_oldSolde = sql_query("
		SELECT 
			`$tableCompt_Solde`.`Dble_Value`
		FROM 
			`$SQL_DATABASE`.`$tableCompt_Solde`
		WHERE
			`$tableCompt_Solde`.`Id_Compte` = '".$aCompte['ID_Compte']."' AND
			`$tableCompt_Solde`.`Id_Annee` = '".$idPrevAnnee."'
		");
	
		$aMouvement 	= mysql_fetch_assoc($tmp_allMouvement);
	    $aOldSolde		= mysql_fetch_assoc($tmp_oldSolde);
	
		$newSolde = $aOldSolde['Dble_Value'] + $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Revenu`)"] - $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Depense`)"];
		
		$insertSolde = sql_query("
			INSERT INTO
				`$SQL_DATABASE`.`$tableCompt_Solde`
			VALUES(
				NULL,
				'".$aCompte['ID_Compte']."',
				'".$idAnnee."',
				'".$newSolde."'
			)
		");
		
		$allInsert = $allInsert && $insertSolde;
	}
	
	if ($allInsert){
		echo ("Consolidation correctement effectuée pour l'année ".$currentYear);
	}
	else{
		echo(" Erreur dans la consolidation de l'année ".$currentYear);
	}
}

// ================================================== //
// Affichage de toutes les soldes
// ================================================== //
$tmp_AllCompte = sql_query("SELECT `Txt_NomCompte` FROM $tableCompt_Compte ORDER BY `ID_Compte`");

	$allCompte = "    <th> Compte </th>\n";
	while ($aCompte = mysql_fetch_assoc($tmp_AllCompte)) {
		$allCompte .= "    <th> ".$aCompte['Txt_NomCompte']." </th>\n";
	}
	$allCompte = "  <tr> ".$allCompte."\n  </tr>";

$tmp_Solde = sql_query("
	SELECT
		`$tableCompt_Annee`.`Int_Annee`,
		`$tableCompt_Solde`.`Dble_Value`,
		`$tableCompt_Compte`.`Txt_Devise` 
	FROM
		`$SQL_DATABASE`.`$tableCompt_Annee`, 
		`$SQL_DATABASE`.`$tableCompt_Compte`,
		`$SQL_DATABASE`.`$tableCompt_Solde`
	WHERE
		`$tableCompt_Solde`.`Id_Compte` = `$tableCompt_Compte`.`ID_Compte` AND
		`$tableCompt_Annee`.`ID_Annee` =`$tableCompt_Solde`.`Id_Annee`
	ORDER BY
		`$tableCompt_Annee`.`ID_Annee`,
		`$tableCompt_Compte`.`ID_Compte`");

	$annee 	= 0;
	$allSolde	= "";
while ($aSolde = mysql_fetch_assoc($tmp_Solde)) {
	if ($annee != $aSolde['Int_Annee']){
		$annee = $aSolde['Int_Annee'];
		$allSolde .= "</tr>\n  <tr>\n    <td> ".$aSolde['Int_Annee']." </td>\n";
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
		
include("../Tools/compt_footer.php");
?>