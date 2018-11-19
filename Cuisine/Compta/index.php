<?php
include('Tools/compt_header.php');
// include('MouvementAjouter.php');




// ================================================== //
// Filtres en place ??
// ================================================== //

  $selectFiltreDate   = "";
  $selectFiltreEscroc = "";
  $selectFiltreCompte = "";
  $selectFiltreDebite = "";


// selection filtrée
if (isset($_POST['Filtrer'])){

  if (get('FiltreDate') != 0){
    $selectFiltreDate   = "`$tableCompt_Mouvement`.`Id_Periode` = '".get('FiltreDate')."' AND";
    $_SESSION['FiltreDate'] = get('FiltreDate');
  }
  else{
    $_SESSION['FiltreDate'] = "";
  }
  
  if (get('FiltreEscroc') != "0"){
    $selectFiltreEscroc = "`$tableCompt_Mouvement`.`Txt_Escroc` = '".get('FiltreEscroc')."' AND";
    $_SESSION['FiltreEscroc'] = get('FiltreEscroc');
  }
  else{
    $_SESSION['FiltreEscroc'] = "";
  }
  
  if (get('FiltreCompte') != 0){
    $selectFiltreCompte = "`$tableCompt_Mouvement`.`Id_Compte` = '".get('FiltreCompte')."' AND";
    $_SESSION['FiltreCompte'] = get('FiltreCompte');
  }
  else{
    $_SESSION['FiltreCompte'] = "";
  }
  
  if (get('FiltreDebite') == "Oui"){
    $selectFiltreDebite = "`$tableCompt_Mouvement`.`Bool_Debite` = '1' AND";
    $_SESSION['FiltreDebite'] = "Oui";
  }
  elseif (get('FiltreDebite') == "Non"){
    $selectFiltreDebite = "`$tableCompt_Mouvement`.`Bool_Debite` = '0' AND";
    $_SESSION['FiltreDebite'] = "Non";
  }
  else{
    $_SESSION['FiltreDebite'] = "";
  }
  
}


// ================================================== //
// La Liste des filtres
// ================================================== //

$_SESSION['FiltreDate']   = (isset($_SESSION['FiltreDate'])) ? $_SESSION['FiltreDate'] : "";
$_SESSION['FiltreEscroc'] = (isset($_SESSION['FiltreEscroc'])) ? $_SESSION['FiltreEscroc'] : "";
$_SESSION['FiltreCompte'] = (isset($_SESSION['FiltreCompte'])) ? $_SESSION['FiltreCompte'] : "";
$_SESSION['FiltreDebite'] = (isset($_SESSION['FiltreDebite'])) ? $_SESSION['FiltreDebite'] : "";


$filtreDate     = "  <select name='FiltreDate'>\n   <option value='0'> --- </option>\n";
$filtreEscroc   = "  <select name='FiltreEscroc'>\n   <option value='0'> --- </option>\n";
$filtreCompte   = "  <select name='FiltreCompte'>\n   <option value='0'> --- </option>\n";
$filtreDebite   = "  <select name='FiltreDebite'>
    <option value='0'> --- </option>
    <option value='Oui' ".($_SESSION['FiltreDebite']=="Oui" ? "selected" : "")."> Oui </option>
    <option value='Non' ".($_SESSION['FiltreDebite']=="Non" ? "selected" : "")."> Non </option>
  </select>";


// all period
$tmp_AllMouvement = sql_query("
  SELECT  
    DISTINCT(`$tableCompt_Periode`.`ID_Periode`),
    `$tableCompt_Periode`.`Txt_NomPeriode`
  FROM
    `$SQL_DATABASE`.`$tableCompt_Mouvement`,
    `$SQL_DATABASE`.`$tableCompt_Periode`,
    `$SQL_DATABASE`.`$tableCompt_Annee`
  WHERE
    `$tableCompt_Periode`.`ID_Periode` =`$tableCompt_Mouvement`.`Id_Periode` AND
    `$tableCompt_Annee`.`ID_Annee` =`$tableCompt_Mouvement`.`Id_Annee` AND
    `$tableCompt_Annee`.`Int_Annee` = $currentYear
  ORDER BY `$tableCompt_Mouvement`.`Id_Periode` DESC");
  
while ($aPeriod = mysql_fetch_assoc($tmp_AllMouvement)) {
  $isSelected  = ($_SESSION['FiltreDate'] == $aPeriod['ID_Periode']) ? "selected" : "";
  $filtreDate .= "    <option value='".$aPeriod['ID_Periode']."' ".$isSelected."> ".$aPeriod['Txt_NomPeriode']." </option> \n";
}


// all Escrocs
$tmp_AllMouvement = sql_query("
  SELECT
    DISTINCT(`$tableCompt_Mouvement`.`Txt_Escroc`)
  FROM
    `$SQL_DATABASE`.`$tableCompt_Mouvement`,
    `$SQL_DATABASE`.`$tableCompt_Annee`
  WHERE
    `$tableCompt_Annee`.`ID_Annee` =`$tableCompt_Mouvement`.`Id_Annee` AND
    `$tableCompt_Annee`.`Int_Annee` = $currentYear
  ORDER BY `$tableCompt_Mouvement`.`Id_Periode` DESC");
  
while ($anEscroc = mysql_fetch_assoc($tmp_AllMouvement)) {
  if ($anEscroc['Txt_Escroc'] != ""){
    $isSelected  = ($_SESSION['FiltreEscroc'] == $anEscroc['Txt_Escroc']) ? "selected" : "";
    $filtreEscroc .= "    <option value='".$anEscroc['Txt_Escroc']."' ".$isSelected."> ".$anEscroc['Txt_Escroc']." </option> \n";
  }
}


// all bank account
$tmp_AllMouvement = sql_query("
  SELECT
    DISTINCT(`$tableCompt_Compte`.`ID_Compte`),
    `$tableCompt_Compte`.`Txt_NomCompte`
  FROM
    `$SQL_DATABASE`.`$tableCompt_Mouvement`,
    `$SQL_DATABASE`.`$tableCompt_Compte`,
    `$SQL_DATABASE`.`$tableCompt_Annee`
  WHERE
    `$tableCompt_Annee`.`ID_Annee` =`$tableCompt_Mouvement`.`Id_Annee` AND
    `$tableCompt_Annee`.`Int_Annee` = $currentYear AND
    `$tableCompt_Compte`.`ID_Compte` =`$tableCompt_Mouvement`.`Id_Compte`");
  
while ($aCompte = mysql_fetch_assoc($tmp_AllMouvement)) {
  $isSelected  = ($_SESSION['FiltreCompte'] == $aCompte['ID_Compte']) ? "selected" : "";
  $filtreCompte .= "    <option value='".$aCompte['ID_Compte']."' ".$isSelected."> ".$aCompte['Txt_NomCompte']." </option> \n";
}



$filtreDate     .= "  </select>";
$filtreEscroc   .= "  </select>";
$filtreCompte   .= "  </select>";


$tableFiltre ="
 <form method='post' action=''>
 <tr>
   <td> \n".$filtreDate." </td>
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

$currentPeriode   = "currentPeriode";
$tableMouvement  = "";

// sélection des mouvements
$tmp_AllMouvement = sql_query("
  SELECT 
    `$tableCompt_Periode`.`Txt_NomPeriode`,
    `$tableCompt_Mouvement`.`DT_Date`,
    `$tableCompt_Compte`.`Txt_NomCompte`,
    `$tableCompt_Compte`.`Txt_Devise`,
    `$tableCompt_Mouvement`.`ID_Mouvement`,
    `$tableCompt_Mouvement`.`Txt_Escroc`,
    `$tableCompt_Mouvement`.`Txt_Comment`,
    `$tableCompt_Mouvement`.`Dble_Revenu`,
    `$tableCompt_Mouvement`.`Dble_Depense`,
    `$tableCompt_Mouvement`.`Bool_Debite`,
    `$tableCompt_Mouvement`.`ID_Mouvement`
  FROM 
    `$SQL_DATABASE`.`$tableCompt_Mouvement`,
    `$SQL_DATABASE`.`$tableCompt_Annee`,
    `$SQL_DATABASE`.`$tableCompt_Compte`,
    `$SQL_DATABASE`.`$tableCompt_Periode`
  WHERE
    ".$selectFiltreDate."
    ".$selectFiltreEscroc."
    ".$selectFiltreCompte."
    ".$selectFiltreDebite."
    `$tableCompt_Compte`.`ID_Compte` =`$tableCompt_Mouvement`.`Id_Compte` AND
    `$tableCompt_Periode`.`ID_Periode` =`$tableCompt_Mouvement`.`Id_Periode` AND
    `$tableCompt_Annee`.`ID_Annee` =`$tableCompt_Mouvement`.`Id_Annee` AND
    `$tableCompt_Annee`.`Int_Annee` = $currentYear
  ORDER BY 
    `$tableCompt_Mouvement`.`Id_Periode` DESC,
    `$tableCompt_Mouvement`.`DT_Date` DESC,
    `$tableCompt_Mouvement`.`ID_Mouvement` DESC");

// pour chaque mouvement 
while ($aMouvement = mysql_fetch_assoc($tmp_AllMouvement)) {

  // on passe à une nouvelle période?
  if ($currentPeriode != $aMouvement['Txt_NomPeriode']){
    $currentPeriode = $aMouvement['Txt_NomPeriode'];    
    $tableMouvement .= "
  <tr> <td class='NewPeriode' colspan=10> $currentPeriode </td> </tr>";
  }  
  
  $debite         = ($aMouvement['Bool_Debite'] == 1) ? "Oui" : "Non";
  $classNonDebite = ($aMouvement['Bool_Debite'] == 0) ? "class='NonDebite'" : "";
  $revenucolor    = ($aMouvement['Dble_Revenu'] > 0 ) ? "class='Revenu SoldePositif'" : "class='Revenu SoldeNegatif'";
  $depensecolor   = ($aMouvement['Dble_Depense'] < 0 ) ? "class='Depense SoldePositif'" : "class='Depense SoldeNegatif'";
  $revenuvalue    = ($aMouvement['Dble_Revenu'] != 0 ) ? $aMouvement['Dble_Revenu']." ".$aMouvement['Txt_Devise'] : "";
  $depensevalue   = ($aMouvement['Dble_Depense'] != 0 ) ? $aMouvement['Dble_Depense']." ".$aMouvement['Txt_Devise']  : "";
  
  $tableMouvement .= "
  <tr $classNonDebite id='".$aMouvement['ID_Mouvement']."'>
    <td class='Date'> ".$aMouvement['DT_Date']." </td>
    <td class='Escroc'> ".$aMouvement['Txt_Escroc']." </td>
    <td class='Comm'> ".$aMouvement['Txt_Comment']." </td>
    <td class='Compte'> ".$aMouvement['Txt_NomCompte']." </td>
    <td $revenucolor> ".$revenuvalue." </td>
    <td $depensecolor> ".$depensevalue." </td>
    <td class='Debite'> ".$debite." </td>
  <td class='Debiter'> <form method='post' action='MouvementDebiter.php'>
        <input type='hidden' name='idMouvement' value='".$aMouvement['ID_Mouvement']."' />
        <input type='submit' name='DebiterMovement' value='Debiter' /> </form> </td>
    <td class='Modifier'> <form method='post' action='MouvementModifier.php'>
        <input type='hidden' name='idMouvement' value='".$aMouvement['ID_Mouvement']."' />
        <input type='submit' name='ModifyMovement' value='Modifier' /> </form> </td>
    <td class='Supprimer'> <form method='post' action='MouvementSupprimer.php'>
        <input type='hidden' name='idMouvement' value='".$aMouvement['ID_Mouvement']."' />
        <input type='submit' name='DeleteMovement' value='Supprimer' /> </form> </td>
  </tr>";

}


// ================================================== //
// Les soldes de chaque compte
// ================================================== //


$totalValue      = 0;

$tmp_AllCompte = sql_query("SELECT `ID_Compte`, `Txt_NomCompte`, `Txt_Devise` FROM $tableCompt_Compte");

// ================================================== //
// Etat courant des comptes
// ================================================== //

  $totalCompteInit   = 0;
  $totalCompteReal   = 0;
  $totalCompteCurr   = 0;
  $tableSoldeName    = "";
  $rowTitle          = "";
  $tableSoldePrev    = "";
  $tableSoldeReal    = "";
  $tableSoldeCurr    = "";
  $tableTotalMouv    = "";
  
while ($aCompte = mysql_fetch_assoc($tmp_AllCompte)){

  $tableSoldeName    .= "    <th colspan=2> ".$aCompte['Txt_NomCompte']." </th>\n";
  $rowTitle          .= "    <td> D&eacute;pense </td>\n    <td> Revenu </td>";  
  $totalRevenuReel   = 0;
  $totalDepenseReel  = 0;
  $totalRevenuCour   = 0;
  $totalDepenseCour  = 0;

  
  // old Solde
  $tmp_oldSolde = sql_query("
  SELECT
    `$tableCompt_Compte`.`Txt_Devise`,
    `$tableCompt_Compte`.`Dble_TauxConversion`,
    `$tableCompt_Solde`.`Dble_Value`
  FROM
    `$SQL_DATABASE`.`$tableCompt_Solde`,
    `$SQL_DATABASE`.`".$tableCompt_Annee."`, 
    `$SQL_DATABASE`.`".$tableCompt_Compte."`
  WHERE
    `$tableCompt_Solde`.`Id_Compte` = '".$aCompte['ID_Compte']."' AND
    `$tableCompt_Compte`.`ID_Compte` =' ".$aCompte['ID_Compte']."' AND
    `$tableCompt_Annee`.`Int_Annee`='".($currentYear-1)."' AND
    `$tableCompt_Annee`.`ID_Annee` = `$tableCompt_Solde`.`Id_Annee`
  ");
  $aOldSolde        = mysql_fetch_assoc($tmp_oldSolde);
  $tableSoldePrev  .= "    <td colspan=2> ".$aOldSolde['Dble_Value']." ".$aOldSolde['Txt_Devise']."</td>\n";
  $totalCompteInit  += ($aOldSolde['Dble_Value'] / $aOldSolde['Dble_TauxConversion']);
  
  // Total Mouvement Réel
  $tmp_Mouvement = sql_query("
  SELECT 
    `$tableCompt_Compte`.`Txt_Devise`,
    `$tableCompt_Compte`.`Dble_TauxConversion`,
    SUM(`".$tableCompt_Mouvement."`.`Dble_Revenu`),
    SUM(`".$tableCompt_Mouvement."`.`Dble_Depense`)
  FROM 
    `$SQL_DATABASE`.`".$tableCompt_Mouvement."`,
    `$SQL_DATABASE`.`".$tableCompt_Annee."`, 
    `$SQL_DATABASE`.`".$tableCompt_Compte."`
  WHERE
      `$tableCompt_Compte`.`Txt_NomCompte` ='".$aCompte['Txt_NomCompte']."'AND
    `$tableCompt_Compte`.`ID_Compte` =`".$tableCompt_Mouvement."`.`Id_Compte` AND
    `$tableCompt_Annee`.`Int_Annee` = ".$currentYear." AND
    `$tableCompt_Annee`.`ID_Annee` =`".$tableCompt_Mouvement."`.`Id_Annee`");
  $aMouvement = mysql_fetch_assoc($tmp_Mouvement);
  // Totalité des mouvements Revenus et Dépenses
    $totalRevenuReel    = $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Revenu`)"];
  $totalDepenseReel  = $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Depense`)"];

  $tableTotalMouv .=  ( $totalDepenseReel < 0) ? 
      "    <td class='SoldePositif'> ".$totalDepenseReel." ".$aMouvement['Txt_Devise']." </td>\n" : 
      "    <td class='SoldeNegatif'> ".$totalDepenseReel." ".$aMouvement['Txt_Devise']." </td>\n";
  $tableTotalMouv .=  ( $totalRevenuReel > 0) ?
    "    <td class='SoldePositif'> ".$totalRevenuReel." ".$aMouvement['Txt_Devise']." </td>\n" : 
    "    <td class='SoldeNegatif'> ".$totalRevenuReel." ".$aMouvement['Txt_Devise']." </td>\n";

  
  // Total Mouvement Courante
  $tmp_Mouvement = sql_query("
  SELECT
    `$tableCompt_Compte`.`Txt_Devise`,
    `$tableCompt_Compte`.`Dble_TauxConversion`,
    SUM(`".$tableCompt_Mouvement."`.`Dble_Revenu`),
    SUM(`".$tableCompt_Mouvement."`.`Dble_Depense`)
  FROM 
    `$SQL_DATABASE`.`".$tableCompt_Mouvement."`,
    `$SQL_DATABASE`.`".$tableCompt_Annee."`, 
    `$SQL_DATABASE`.`".$tableCompt_Compte."`
  WHERE
      `$tableCompt_Compte`.`Txt_NomCompte` ='".$aCompte['Txt_NomCompte']."'AND
    `$tableCompt_Compte`.`ID_Compte` =`".$tableCompt_Mouvement."`.`Id_Compte` AND
    `$tableCompt_Annee`.`Int_Annee` = ".$currentYear." AND
    `$tableCompt_Annee`.`ID_Annee` =`".$tableCompt_Mouvement."`.`Id_Annee` AND
    `$tableCompt_Mouvement`.`Bool_Debite` = '1' ");
  $aMouvement = mysql_fetch_assoc($tmp_Mouvement);
  // Totalité des mouvements Revenus et Dépenses
    $totalRevenuCour    = $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Revenu`)"];
  $totalDepenseCour  = $aMouvement["SUM(`$tableCompt_Mouvement`.`Dble_Depense`)"];
    
    
    
    
  // Soldes
  $tmp_SoldeCourante = sql_query("
  SELECT 
    `".$tableCompt_Compte."`.`Txt_NomCompte`,
    `".$tableCompt_Solde."`.`Dble_Value`
  FROM 
    `$SQL_DATABASE`.`".$tableCompt_Annee."`, 
    `$SQL_DATABASE`.`".$tableCompt_Compte."`,
    `$SQL_DATABASE`.`".$tableCompt_Solde."`
  WHERE
      `$tableCompt_Compte`.`Txt_NomCompte` ='".$aCompte['Txt_NomCompte']."'AND
    `$tableCompt_Annee`.`Int_Annee` = ".$currentYear." AND
    `$tableCompt_Solde`.`Id_Compte` = `".$tableCompt_Compte."`.`ID_Compte` AND
    `$tableCompt_Solde`.`Id_Annee` = (`".$tableCompt_Annee."`.`ID_Annee` - 1)");
 
  $aSolde = mysql_fetch_assoc($tmp_SoldeCourante);
  
  
  // Solde Courante
  $newValue = $aSolde['Dble_Value'] + $totalRevenuCour - $totalDepenseCour;
  $tableSoldeCurr .= ($newValue < 0) ? 
    "    <td class='SoldeCourNegatif ' colspan=2> ".$newValue." ".$aMouvement['Txt_Devise']."</td>\n" : 
    "    <td class='SoldeCour' colspan=2> ".$newValue." ".$aMouvement['Txt_Devise']." </td>\n";
  $totalCompteCurr  += $newValue;
  
  // Solde Réel
  $newValue = $aSolde['Dble_Value'] + $totalRevenuReel - $totalDepenseReel;
  $tableSoldeReal .= ($newValue < 0) ? 
    "    <td class='SoldeCourNegatif' colspan=2> ".$newValue." </td>\n" : 
    "    <td class='SoldeCour'   colspan=2> ".$newValue." ".$aMouvement['Txt_Devise']." </td>\n";
  $totalCompteReal  += $newValue;
}



// ================================================== //
// Peaufinons les tables
// ================================================== //


$tableSoldeName  = "    <th> Compte          </th>\n".$tableSoldeName."    <th> Total </th>\n";
$rowTitle        = "    <td rowspan=2> Total </td>\n".$rowTitle."    <td>  </td>\n";
$tableSoldePrev  = "    <td> ".($currentYear-1)."</td>\n".$tableSoldePrev."    <td> ".$totalCompteInit." &euro; </td>\n";
$tableSoldeReal  = "    <td> R&eacute;el    </td>\n".$tableSoldeReal."    <td> ".$totalCompteReal." &euro; </td>\n";
$tableSoldeCurr  = "    <td> Courant        </td>\n".$tableSoldeCurr."    <td> ".$totalCompteCurr." &euro; </td>\n";
$tableTotalMouv  = "    \n  ".$tableTotalMouv;

$tableSolde = "
  <table class='Solde'>
  <tr class='SoldeName'>
$tableSoldeName
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
  <tr class='Mouvement'>
$rowTitle
  </tr>
  <tr class='Mouvement'>
$tableTotalMouv
  </tr>
  </table>
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
$allYear = "";
$tmp_Annee = sql_query("SELECT * FROM `$tableCompt_Annee`");

while ($aYear = mysql_fetch_assoc($tmp_Annee)){
  if ($aYear['Int_Annee'] == Date("Y")) {
    $allYear .= "      <option value='".$aYear['Int_Annee']."' selected>".$aYear['Int_Annee']."</option>\n";
  }
  else{
    $allYear .= "      <option value='".$aYear['Int_Annee']."'>".$aYear['Int_Annee']."</option>\n";
  }
}

$formAnnee = "
  <form method='post' action='index.php'>
    Ann&eacute;e: 
    <select name='chosenYear'>
$allYear
    </select>
    <input type='Submit' value='Changer d&#39;année' />
  </form>";


$boutonAjouter ="
  <form method='post' action='MouvementAjouter.php' style='float:left;'>
    <input type='submit' name='AjouterMouvement' value='Ajouter un mouvement' />
    <input type='submit' name='AjouterTransfert' value='Ajouter un transfert' />
  </form>
  <form method='post' action='MouvementProcessing.php'>
    <input type='submit' name='AjouterFraisFixe' value='Ajouter les Frais Fixes' />
  </form>";

// ================================================== //
//                 Affichage
// ================================================== //

echo $boutonAjouter;

// changer d'année
echo $formAnnee;

// les sous !!!!
echo $tableSolde;
echo $tableMouvement;
echo $boutonAjouter;



include("/Tools/compt_footer.php");
?>







