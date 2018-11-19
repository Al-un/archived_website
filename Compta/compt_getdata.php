<?php

// ================================================== //
// Filtres en place ??
// ================================================== //


$_SESSION['FiltreEscroc'] = (isset($_SESSION['FiltreEscroc'])) ? $_SESSION['FiltreEscroc'] : "";
$_SESSION['FiltreCompte'] = (isset($_SESSION['FiltreCompte'])) ? $_SESSION['FiltreCompte'] : "";
$_SESSION['FiltreDebite'] = (isset($_SESSION['FiltreDebite'])) ? $_SESSION['FiltreDebite'] : "";

// selection filtrée
// si le formulaire renvoit "0" mais la valeur n'était pas vide
// alors on réinitialise le filtre
if (isset($_POST['FiltreEscroc'])){
 $_SESSION['FiltreEscroc'] = (Xsy_Glob_Get('FiltreEscroc') !== "0") ? Xsy_Glob_Get('FiltreEscroc') : "";
 $_SESSION['FiltreCompte'] = (Xsy_Glob_Get('FiltreCompte') !== "0") ? Xsy_Glob_Get('FiltreCompte') : "";
 $_SESSION['FiltreDebite'] = (Xsy_Glob_Get('FiltreDebite') !== "0") ? Xsy_Glob_Get('FiltreDebite') : "";
}

$selectFiltreEscroc = "";
$selectFiltreCompte = "";
$selectFiltreDebite = "";


$selectFiltreEscroc   = ($_SESSION['FiltreEscroc'] !== "") ? "`$sqlTable_ComptMouvement`.`Txt_Escroc` = '".$_SESSION['FiltreEscroc']."' AND"  : "";
$selectFiltreCompte   = ($_SESSION['FiltreCompte'] !== "") ? "`$sqlTable_ComptMouvement`.`Id_ComptCompte` = '".$_SESSION['FiltreCompte']."' AND"   : "";
if($_SESSION['FiltreDebite'] == "Oui"){
  $selectFiltreDebite = "`$sqlTable_ComptMouvement`.`Bool_Debite` = '1' AND";
}
elseif($_SESSION['FiltreDebite'] == "Non"){
  $selectFiltreDebite = "`$sqlTable_ComptMouvement`.`Bool_Debite` = '0' AND";
}


// ================================================== //
// La Liste des filtres
// ================================================== //

$filtreEscroc   = "  <select name='FiltreEscroc'>\n   <option value='0'> --- </option>\n";
$filtreCompte   = "  <select name='FiltreCompte'>\n   <option value='0'> --- </option>\n";
$filtreDebite   = "  <select name='FiltreDebite'>
    <option value='0'> --- </option>
    <option value='Oui' ".(($_SESSION['FiltreDebite']=="Oui") ? "selected" : "")."> Oui </option>
    <option value='Non' ".(($_SESSION['FiltreDebite']=="Non") ? "selected" : "")."> Non </option>
  </select>";


// all Escrocs
$allEscrocArray = Xsy_Sql_FetchAll("
  SELECT
    DISTINCT(`$sqlTable_ComptMouvement`.`Txt_Escroc`)
  FROM
    `$SQL_DATABASE`.`$sqlTable_ComptMouvement`, `$SQL_DATABASE`.`$sqlTable_ComptAnnee`
  WHERE
    `$sqlTable_ComptAnnee`.`ID_ComptAnnee` =`$sqlTable_ComptMouvement`.`Id_ComptAnnee` AND
    `$sqlTable_ComptAnnee`.`Int_ComptAnnee%Name` = ".$_SESSION['ComptAnnee']."
  ORDER BY `$sqlTable_ComptMouvement`.`Txt_Escroc`");

foreach ($allEscrocArray as $key => $anEscroc){
  if ($anEscroc['Txt_Escroc'] != ""){
    $isSelected  = ($_SESSION['FiltreEscroc'] == $anEscroc['Txt_Escroc']) ? "selected" : "";
    $filtreEscroc .= "    <option value='".$anEscroc['Txt_Escroc']."' ".$isSelected."> ".$anEscroc['Txt_Escroc']." </option> \n";
  }
}


// all bank account
$allBankArray = Xsy_Sql_FetchAll("
  SELECT
    DISTINCT(`$sqlTable_ComptCompte`.`ID_ComptCompte`),
    `$sqlTable_ComptCompte`.`Txt_ComptCompte%Name`
  FROM
    `$SQL_DATABASE`.`$sqlTable_ComptMouvement`,
    `$SQL_DATABASE`.`$sqlTable_ComptCompte`,
    `$SQL_DATABASE`.`$sqlTable_ComptAnnee`
  WHERE
    `$sqlTable_ComptAnnee`.`ID_ComptAnnee` =`$sqlTable_ComptMouvement`.`Id_ComptAnnee` AND
    `$sqlTable_ComptAnnee`.`Int_ComptAnnee%Name` = ".$_SESSION['ComptAnnee']." AND
    `$sqlTable_ComptCompte`.`ID_ComptCompte` =`$sqlTable_ComptMouvement`.`Id_ComptCompte`");

foreach($allBankArray as $key => $aCompte){
  $isSelected  = ($_SESSION['FiltreCompte'] == $aCompte['ID_ComptCompte']) ? "selected" : "";
  $filtreCompte .= "    <option value='".$aCompte['ID_ComptCompte']."' ".$isSelected."> ".$aCompte['Txt_ComptCompte%Name']." </option> \n";
}



$filtreEscroc   .= "  </select>";
$filtreCompte   .= "  </select>";


$tableFiltre ="
 <form method='post' action='index.php'>
 <tr>
   <td> \n </td>
   <td> \n".$filtreEscroc." </td>
   <td> </td>
   <td> \n".$filtreCompte." </td>
   <td> </td>
   <td> </td>
   <td> \n".$filtreDebite." </td>
   <td colspan=3> <input type='submit' name='Filtrer' value='Filtrer' style='width:100%'>  </td>
 </tr>
 </form>
";





// ================================================== //
// La Liste des Mouvements pour une année donnée
// ================================================== //

$currentPeriode = "currentPeriode";
$tableMouvement = "";

// sélection des mouvements
$query_AllMouvements = "
  SELECT 
    `$sqlTable_ComptPeriode`.`ID_ComptPeriode`,
    `$sqlTable_ComptPeriode`.`Txt_ComptPeriode%Name`,
    `$sqlTable_ComptMouvement`.`DT_Date`,
    `$sqlTable_ComptCompte`.`Txt_ComptCompte%Name`,
    `$sqlTable_ComptCompte`.`Txt_Devise`,
    `$sqlTable_ComptMouvement`.`ID_ComptMouvement`,
    `$sqlTable_ComptMouvement`.`Txt_Escroc`,
    `$sqlTable_ComptMouvement`.`Txt_Comment`,
    `$sqlTable_ComptMouvement`.`Dble_Revenu`,
    `$sqlTable_ComptMouvement`.`Dble_Depense`,
    `$sqlTable_ComptMouvement`.`Bool_Debite`
  FROM 
    `$SQL_DATABASE`.`$sqlTable_ComptMouvement`,
    `$SQL_DATABASE`.`$sqlTable_ComptAnnee`,
    `$SQL_DATABASE`.`$sqlTable_ComptCompte`,
    `$SQL_DATABASE`.`$sqlTable_ComptPeriode`
  WHERE
    ".$selectFiltreEscroc."
    ".$selectFiltreCompte."
    ".$selectFiltreDebite."
    `$sqlTable_ComptCompte`.`ID_ComptCompte` =`$sqlTable_ComptMouvement`.`Id_ComptCompte` AND
    `$sqlTable_ComptPeriode`.`ID_ComptPeriode` =`$sqlTable_ComptMouvement`.`Id_ComptPeriode` AND
    `$sqlTable_ComptAnnee`.`ID_ComptAnnee` =`$sqlTable_ComptMouvement`.`Id_ComptAnnee` AND
    `$sqlTable_ComptAnnee`.`Int_ComptAnnee%Name` = ".$_SESSION['ComptAnnee']."
  ORDER BY 
    `$sqlTable_ComptMouvement`.`Id_ComptPeriode` DESC,
    `$sqlTable_ComptMouvement`.`DT_Date` DESC,
    `$sqlTable_ComptMouvement`.`ID_ComptMouvement` DESC";

$stmt_AllMovements = Xsy_Sql_Query($query_AllMouvements);


// pour chaque mouvement 
while ($aMouvement = Xsy_Sql_Fetch($stmt_AllMovements)) {

  // on passe à une nouvelle période?
  if ($currentPeriode != $aMouvement['Txt_ComptPeriode%Name']){
    $currentPeriode = $aMouvement['Txt_ComptPeriode%Name'];    
    $periodeID      = $aMouvement['ID_ComptPeriode'];    
    $tableMouvement .= "
  <tr> <td class='NewPeriode' colspan=10 id='ComptPeriode".$periodeID."'> $currentPeriode </td> </tr>";
  }  
  
  $debite         = ($aMouvement['Bool_Debite'] == 1)   ? "Oui" : "Non";
  $classNonDebite = ($aMouvement['Bool_Debite'] == 0)   ? "class='NonDebite'" : "class='ComptMouvement".$periodeID."'";
  $revenucolor    = ($aMouvement['Dble_Revenu'] > 0 )   ? "class='Revenu SoldePositif'" : "class='Revenu SoldeNegatif'";
  $depensecolor   = ($aMouvement['Dble_Depense'] < 0 )  ? "class='Depense SoldePositif'" : "class='Depense SoldeNegatif'";
  $revenuvalue    = ($aMouvement['Dble_Revenu'] != 0 )  ? $aMouvement['Dble_Revenu']." ".$aMouvement['Txt_Devise'] : "";
  $depensevalue   = ($aMouvement['Dble_Depense'] != 0 ) ? $aMouvement['Dble_Depense']." ".$aMouvement['Txt_Devise']  : "";
  
  $tableMouvement .= "
  <tr $classNonDebite id='".$aMouvement['ID_ComptMouvement']."'>
    <td class='Date'> ".$aMouvement['DT_Date']." </td>
    <td class='Escroc'> ".$aMouvement['Txt_Escroc']." </td>
    <td class='Comm'> ".$aMouvement['Txt_Comment']." </td>
    <td class='Compte'> ".$aMouvement['Txt_ComptCompte%Name']." </td>
    <td $revenucolor> ".$revenuvalue." </td>
    <td $depensecolor> ".$depensevalue." </td>
    <td class='Debite'> ".$debite." </td>
  <td class='Debiter'> <form method='post' action='index.php#".$aMouvement['ID_ComptMouvement']."'>
        <input type='hidden' name='XsyComptMouvID' value='".$aMouvement['ID_ComptMouvement']."' />
        <input type='submit' name='XsyComptMouvDeb' value='Debiter' /> </form> </td>
    <td class='Modifier'> <form method='post' action='index.php'>
        <input type='hidden' name='XsyComptMouvID' value='".$aMouvement['ID_ComptMouvement']."' />
        <input type='submit' name='XsyComptMouvUpd' value='Modifier' /> </form> </td>
    <td class='Supprimer'> <form method='post' action='index.php#".($aMouvement['ID_ComptMouvement']+1)."'>
        <input type='hidden' name='XsyComptMouvID' value='".$aMouvement['ID_ComptMouvement']."' />
        <input type='submit' name='XsyComptMouvDel' value='Supprimer' /> </form> </td>
  </tr>";

}


// ================================================== //
// Les soldes de chaque compte
// ================================================== //


$totalValue      = 0;

$allBankArray = Xsy_Sql_FetchAll("SELECT `ID_ComptCompte`, `Txt_ComptCompte%Name`, `Txt_Devise`, `Dble_TauxConversion`, `Bool_Active` FROM $sqlTable_ComptCompte ORDER BY `Int_Order`");

// ================================================== //
// Etat courant des comptes
// ================================================== //

  $totalCompteInit   = 0;
  $totalCompteReal   = 0;
  $totalCompteCurr   = 0;
  $tableSoldeName    = "";
  $tableSoldeChange  = "";
  $rowTitle          = "";
  $tableSoldePrev    = "";
  $tableSoldeReal    = "";
  $tableSoldeCurr    = "";
  $tableTotalMouv    = "";

  // prépare une colone "other" pour les comptes non actifs.
  $otherSoldeName    = "    <th colspan=2> <i> Others </i> </th>\n";
  $otherSoldeChange  = "    <th colspan=2> Mixed </th>\n";
  $otherrowTitle     = "    <td> D&eacute;pense </td>\n    <td> Revenu </td>";  
  $otherCompteInit   = 0;
  $otherCompteReal   = 0;
  $otherCompteCurr   = 0;
  $otherDepense      = 0;
  $otherRevenu       = 0;

  $CompteId          = 0;
  $CompteName        = "";


  // récupère le solde du compte X à l'année N-1
  $query_oldSolde = "
  SELECT
    `$sqlTable_ComptSolde`.`Dble_Value`
  FROM
    `$SQL_DATABASE`.`".$sqlTable_ComptSolde."`, `$SQL_DATABASE`.`".$sqlTable_ComptAnnee."`, `$SQL_DATABASE`.`".$sqlTable_ComptCompte."`
  WHERE
    `$sqlTable_ComptSolde`.`ID_ComptCompte` = :IdCompte AND
    `$sqlTable_ComptCompte`.`ID_ComptCompte` = :IdCompte AND
    `$sqlTable_ComptAnnee`.`Int_ComptAnnee%Name`='".($_SESSION['ComptAnnee']-1)."' AND
    `$sqlTable_ComptAnnee`.`ID_ComptAnnee` = `$sqlTable_ComptSolde`.`Id_ComptAnnee`";

  $query_RevenuDepense = "
  SELECT 
    SUM(`".$sqlTable_ComptMouvement."`.`Dble_Revenu`), SUM(`".$sqlTable_ComptMouvement."`.`Dble_Depense`)
  FROM 
    `$SQL_DATABASE`.`".$sqlTable_ComptMouvement."`, `$SQL_DATABASE`.`".$sqlTable_ComptAnnee."`, `$SQL_DATABASE`.`".$sqlTable_ComptCompte."`
  WHERE
    `$sqlTable_ComptCompte`.`Txt_ComptCompte%Name` = :NameCompte AND
    `$sqlTable_ComptCompte`.`ID_ComptCompte` =`".$sqlTable_ComptMouvement."`.`Id_ComptCompte` AND
    `$sqlTable_ComptAnnee`.`Int_ComptAnnee%Name` = ".$_SESSION['ComptAnnee']." AND
    `$sqlTable_ComptAnnee`.`ID_ComptAnnee` =`".$sqlTable_ComptMouvement."`.`Id_ComptAnnee`";

  $query_MouvCourant = "
  SELECT
    SUM(`".$sqlTable_ComptMouvement."`.`Dble_Revenu`), SUM(`".$sqlTable_ComptMouvement."`.`Dble_Depense`)
  FROM 
    `$SQL_DATABASE`.`".$sqlTable_ComptMouvement."`, `$SQL_DATABASE`.`".$sqlTable_ComptAnnee."`, `$SQL_DATABASE`.`".$sqlTable_ComptCompte."`
  WHERE
    `$sqlTable_ComptCompte`.`Txt_ComptCompte%Name` = :NameCompte AND
    `$sqlTable_ComptCompte`.`ID_ComptCompte` = `".$sqlTable_ComptMouvement."`.`Id_ComptCompte` AND
    `$sqlTable_ComptAnnee`.`Int_ComptAnnee%Name` = ".$_SESSION['ComptAnnee']." AND
    `$sqlTable_ComptAnnee`.`ID_ComptAnnee` = `".$sqlTable_ComptMouvement."`.`Id_ComptAnnee` AND
    `$sqlTable_ComptMouvement`.`Bool_Debite` = '1' ";

  $query_Solde = "
  SELECT 
    `".$sqlTable_ComptSolde."`.`Dble_Value`
  FROM 
    `$SQL_DATABASE`.`".$sqlTable_ComptSolde."`, `$SQL_DATABASE`.`".$sqlTable_ComptAnnee."`, `$SQL_DATABASE`.`".$sqlTable_ComptCompte."`
  WHERE
    `$sqlTable_ComptCompte`.`Txt_ComptCompte%Name` = :NameCompte AND
    `$sqlTable_ComptAnnee`.`Int_ComptAnnee%Name` = ".$_SESSION['ComptAnnee']." AND
    `$sqlTable_ComptSolde`.`Id_ComptCompte` = `$sqlTable_ComptCompte`.`ID_ComptCompte` AND
    `$sqlTable_ComptSolde`.`Id_ComptAnnee` = (`$sqlTable_ComptAnnee`.`ID_ComptAnnee` - 1)";



$stmt_oldSolde      = $XSY_SQL_PDO->prepare($query_oldSolde);
$stmt_RevenuDepense = $XSY_SQL_PDO->prepare($query_RevenuDepense);
$stmt_MouvCourant   = $XSY_SQL_PDO->prepare($query_MouvCourant);
$stmt_Solde         = $XSY_SQL_PDO->prepare($query_Solde);
$stmt_oldSolde->bindParam(':IdCompte', $CompteId);
$stmt_RevenuDepense->bindParam(':NameCompte', $CompteName);
$stmt_MouvCourant->bindParam(':NameCompte', $CompteName);
$stmt_Solde->bindParam(':NameCompte', $CompteName);





foreach($allBankArray as $key => $aCompte){

  $activeBank        = $aCompte['Bool_Active']==1;
  $CompteId          = $aCompte['ID_ComptCompte'];
  $CompteName        = $aCompte['Txt_ComptCompte%Name'];
  $CompteDevise      = $aCompte['Txt_Devise'];
  $CompteChange      = $aCompte['Dble_TauxConversion'];
  $totalRevenuReel   = 0;
  $totalDepenseReel  = 0;
  $totalRevenuCour   = 0;
  $totalDepenseCour  = 0;

  // old Solde
  $stmt_oldSolde->execute();
  $aOldSolde = $stmt_oldSolde->fetch(PDO::FETCH_ASSOC);
  // old solde exist ? Year Y-1
  $compteOldSolde   = (isset($aOldSolde['Dble_Value'])) ? $aOldSolde['Dble_Value'] : 0;
  // Soldes
  $stmt_Solde->execute();
  $aSolde = $stmt_Solde->fetch(PDO::FETCH_ASSOC);
  // Total Mouvement Courante
  $stmt_MouvCourant->execute();
  $aMouvement = $stmt_MouvCourant->fetch(PDO::FETCH_ASSOC);
  // calcule mouvements courants
  $totalRevenuCour   = $aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Revenu`)"];
  $totalDepenseCour  = $aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Depense`)"];
  // Total Mouvement Réel
  $stmt_RevenuDepense->execute();
  $aMouvement = $stmt_RevenuDepense->fetch(PDO::FETCH_ASSOC);
  // Totalité des mouvements Revenus et Dépenses
  $totalRevenuReel   = $aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Revenu`)"];
  $totalDepenseReel  = $aMouvement["SUM(`$sqlTable_ComptMouvement`.`Dble_Depense`)"];


  // mise à jour des totaux
  $totalCompteInit += ($compteOldSolde / $CompteChange);
  // Solde Courante
  $newCurrValue = $aSolde['Dble_Value'] + $totalRevenuCour - $totalDepenseCour;
  // Solde Réel
  $newRealValue = $aSolde['Dble_Value'] + $totalRevenuReel - $totalDepenseReel;


  // if account is active
  if($activeBank){
    $tableSoldeName    .= "    <th colspan=2> ".$aCompte['Txt_ComptCompte%Name']." </th>\n";
    $tableSoldeChange  .= "    <th colspan=2> ".$aCompte['Dble_TauxConversion']." </th>\n";
    $rowTitle          .= "    <td> D&eacute;pense </td>\n    <td> Revenu </td>";  

    // add old solde
    $tableSoldePrev  .= "    <td colspan=2> ".$compteOldSolde." ".$CompteDevise."</td>\n";

    // add total real expenses / incomes
    $tableTotalMouv .=  ( $totalDepenseReel < 0) ? 
      "    <td class='SoldePositif'> ".$totalDepenseReel." ".$CompteDevise." </td>\n" : 
      "    <td class='SoldeNegatif'> ".$totalDepenseReel." ".$CompteDevise." </td>\n";
    $tableTotalMouv .=  ( $totalRevenuReel > 0) ?
      "    <td class='SoldePositif'> ".$totalRevenuReel." ".$CompteDevise." </td>\n" : 
      "    <td class='SoldeNegatif'> ".$totalRevenuReel." ".$CompteDevise." </td>\n";

    // Solde Courante
    $tableSoldeCurr .= ($newCurrValue < 0) ? 
      "    <td class='SoldeCourNegatif ' colspan=2> ".$newCurrValue." ".$CompteDevise."</td>\n" : 
      "    <td class='SoldeCour' colspan=2> ".$newCurrValue." ".$CompteDevise." </td>\n";
    $totalCompteCurr  += ($newCurrValue / $CompteChange);

    // Solde Réel
    $tableSoldeReal .= ($newRealValue < 0) ? 
      "    <td class='SoldeCourNegatif' colspan=2> ".$newRealValue." </td>\n" : 
      "    <td class='SoldeCour'   colspan=2> ".$newRealValue." ".$CompteDevise." </td>\n";
    $totalCompteReal  += ($newRealValue / $CompteChange);

  }
  else{
    $otherCompteInit += ($compteOldSolde / $CompteChange);
    $otherCompteReal += ($newCurrValue / $CompteChange);
    $otherCompteCurr += ($newRealValue / $CompteChange);
    $otherDepense    += $totalDepenseReel;
    $otherRevenu     += $totalRevenuReel;
  }

}



// ================================================== //
// Peaufinons les tables
// ================================================== //

$tableSoldeName  = $tableSoldeName.$otherSoldeName;
$tableSoldeChange= $tableSoldeChange.$otherSoldeChange;
$rowTitle        = $rowTitle."    <td> D&eacute;pense </td>\n    <td> Revenu </td>";
$tableSoldePrev  = $tableSoldePrev.".    <td colspan=2>".round($otherCompteInit, 2)." &euro; </td>";
$tableSoldeReal  = $tableSoldeReal.".    <td colspan=2>".round($otherCompteReal, 2)." &euro; </td>";
$tableSoldeCurr  = $tableSoldeCurr.".    <td colspan=2>".round($otherCompteCurr, 2)." &euro; </td>";
$tableTotalMouv .=  ( $otherDepense < 0) ? 
  "    <td class='SoldePositif'> ".$otherDepense." &euro; </td>\n" : 
  "    <td class='SoldeNegatif'> ".$otherDepense." &euro; </td>\n";
$tableTotalMouv .=  ( $otherRevenu > 0) ?
  "    <td class='SoldePositif'> ".$otherRevenu." &euro; </td>\n" : 
  "    <td class='SoldeNegatif'> ".$otherRevenu." &euro; </td>\n";

$tableSoldeName  = "    <th> Compte          </th>\n".$tableSoldeName."    <th> Total </th>\n";
$tableSoldeChange= "    <th> Change          </th>\n".$tableSoldeChange."  <th>  </th>\n";
$rowTitle        = "    <td rowspan=2> Total </td>\n".$rowTitle."    <td>  </td>\n";
$tableSoldePrev  = "    <td> ".($_SESSION['ComptAnnee']-1)."</td>\n".$tableSoldePrev."    <td> ".round($totalCompteInit, 2)." &euro; </td>\n";
$tableSoldeReal  = "    <td> R&eacute;el    </td>\n".$tableSoldeReal."    <td> ".round($totalCompteReal, 2)." &euro; </td>\n";
$tableSoldeCurr  = "    <td> Courant        </td>\n".$tableSoldeCurr."    <td> ".round($totalCompteCurr, 2)." &euro; </td>\n";
$tableTotalMouv  = "    \n  ".$tableTotalMouv;

$tableSolde = "
 <div id='ComptSolde'>
  <table class='Solde'>
  <tr class='SoldeName'>
$tableSoldeName
  </tr>
  <tr class='SoldeName'>
$tableSoldeChange
  </tr>
  <tr class='SoldePrev'>
$tableSoldePrev
  </tr>
  <tr class='SoldeCurr'>
$tableSoldeCurr
  </tr>
  <tr class='SoldeReal'>
$tableSoldeReal
  </tr>
<!--
  <tr class='Mouvement'>
$rowTitle
  </tr>
  <tr class='Mouvement'>
$tableTotalMouv
  </tr>
-->
  </table>
 </div>
";

$tableMouvement = "
  <table class='Mouvement'>
  <tr>
  <th class='Date'>Date</th>
  <th class='Escroc'>Escroc</th>
  <th class='Comm'>Commentaire</th>
  <th class='Compte'>Compte</th>
  <th class='Revenu'>Revenu</th>
  <th class='Depense'>Dépense</th>
  <th class='Debite'>Débité</th>
  <th class='Modifier'>Modifier</th>
  <th class='Supprimer'>Supprimer</th>
  </tr>
$tableFiltre
$tableMouvement
  </table>";



// ================================================== //
// Changer d'année ?
// ================================================== //

$formAnnee = "
  <form method='post' action=''>
    Ann&eacute;e:".Xsy_Sql_DisplayFieldValue('Id_ComptAnnee', $_SESSION['ComptAnneeID'], "Update")."
    <input type='Submit' value='Changer d&#39;année' />
  </form>";




// ================================================== //
//                 Affichage
// ================================================== //

// changer d'année
echo $formAnnee;

// les sous !!!!
echo $tableSolde;
echo $tableMouvement;




?>







