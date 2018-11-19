<?php
include('Tools/compt_header.php');

// ================================================== //
//                 Mouvement ajouté !
// ================================================== //
if (isset($_POST['MouvementAjoute'])) {
  $zeAnnee    = get("Annee");
  $zePeriode  = get("Periode");
  $zeCompte   = get("Compte");
  $zeDate     = get("Date");
  $zeEscroc   = get("Escroc");
  $zeComm     = get("Comment");
  $zeRevenu   = get("Revenu");
  $zeDepense  = get("Depense");
  $zeDebite   = (get("Debite")==TRUE) ? 1 : 0;
  
  $addMouvement = sql_query("
  INSERT INTO `$SQL_DATABASE`.`$tableCompt_Mouvement`
  VALUES (
    NULL, 
    '$zeCompte', 
    '$zeAnnee', 
    '$zePeriode', 
    '$zeDate',
    '$zeEscroc',
    '$zeComm',
    '$zeRevenu',
    '$zeDepense',
    '$zeDebite')");
  
  // destroy $_POST['...'] variables
  unset($_POST['MouvementAjoute']);
  unset($_POST['Annee']);
  unset($_POST['Periode']);
  unset($_POST['Compte']);
  unset($_POST['Date']);
  unset($_POST['Escroc']);
  unset($_POST['Comment']);
  unset($_POST['Revenu']);
  unset($_POST['Depense']);
  unset($_POST['Debite']);
  
  
  // check and back
  if ($addMouvement){
    header("Location: index.php");
    echo("<p> Mouvement correctement ajouté </p>");
  }
  else{
    echo("<p> Erreur dans l'ajout du mouvement</p>");
  }

}



// ================================================== //
//                 Frais fixe ajouté !
// ================================================== //
if (isset($_POST['AjouterFraisFixe'])) {

  $tmp_FraisFixe      = sql_query("SELECT * FROM `".$SQL_DATABASE."`.`".$tableCompt_FraisFixe."`");
  $tmp_Annee          = sql_query("SELECT `ID_Annee` FROM `".$SQL_DATABASE."`.`".$tableCompt_Annee."` WHERE `Int_Annee`='".Date("Y")."'");
  $fraisfixe_annee    = mysql_fetch_assoc($tmp_Annee);
  $fraisfixe_annee    = $fraisfixe_annee['ID_Annee'];
  $fraisfixe_periode  = Date("m");
  $fraisfixe_date     = Date("Y-m-d");
  $fraisfixe_ajout    = TRUE;
  
  while ($aFraisFixe = mysql_fetch_assoc($tmp_FraisFixe) ){
    
     $addMouvement = sql_query("
  INSERT INTO `$SQL_DATABASE`.`$tableCompt_Mouvement`
  VALUES (
    NULL, 
    '".$aFraisFixe['Id_Compte']."', 
    '".$fraisfixe_annee."', 
    '".$fraisfixe_periode."', 
    '".$fraisfixe_date."',
    '".$aFraisFixe['Txt_Escroc']."',
    '".$aFraisFixe['Txt_Comment']."',
    '".$aFraisFixe['Dble_Revenu']."',
    '".$aFraisFixe['Dble_Depense']."',
    '0')");
  
    $fraisfixe_ajout = $fraisfixe_ajout && $addMouvement;
  
  }
 
  
  if ($fraisfixe_ajout){
    header("Location: index.php");
    echo("<p> Frais Fixes correctement ajoutés </p>");
  }
  else{
    echo("<p> Erreur dans l'ajout des Frais Fixes </p>");  
  }
  
}


// ================================================== //
//                 Transfert ajouté !
// ================================================== //
if (isset($_POST['TransfertAjoute'])) {

  $zeAnnee    = get("Annee");
  $zePeriode  = get("Periode");
  $zeDate     = get("Date");
  $zeCompte   = get("Compte");
  $zeCompte2  = get("Compte2");
  $zeMontant  = get("Montant");
  
  $addTransfert = sql_query("
  INSERT INTO `$SQL_DATABASE`.`$tableCompt_Mouvement`
  VALUES (
    NULL, 
    '$zeCompte', 
    '$zeAnnee', 
    '$zePeriode', 
    '$zeDate',
    '',
    'Transfert',
    '',
    '$zeMontant',
    '0')");
  
  $addTransfert2 = sql_query("
  INSERT INTO `$SQL_DATABASE`.`$tableCompt_Mouvement`
  VALUES (
    NULL, 
    '$zeCompte2', 
    '$zeAnnee', 
    '$zePeriode', 
    '$zeDate',
    '',
    'Transfert',
    '',
    '-$zeMontant',
    '0')");
  
  if ($addTransfert && $addTransfert2){
    header("Location: index.php");
    echo("<p> Transfert correctement ajouté </p>");
  }
  else{
    echo("<p> Transfert raté </p>");
  }
  
}


// ================================================== //
//                 Mouvement modifié !
// ================================================== //
if (isset($_POST['MouvementModifie'])) {

  $idMouvement = get('IdMouvement');

  $zeAnnee    = "`Id_Annee`='".get("Annee")."'";
  $zePeriode  = "`Id_Periode`='".get("Periode")."'";
  $zeCompte   = "`Id_Compte`='".get("Compte")."'";
  $zeDate     = "`DT_Date`='".get("Date")."'";
  $zeEscroc   = "`Txt_Escroc`='".get("Escroc")."'";
  $zeComm     = "`Txt_Comment`='".get("Comment")."'";
  $zeRevenu   = "`Dble_Revenu`='".get("Revenu")."'";
  $zeDepense  = "`Dble_Depense`='".get("Depense")."'";
  $zeDebite   = "`Bool_Debite`='".((get("Debite")==TRUE) ? 1 : 0)."'";
  
  $ModifMouvement = sql_query("
  UPDATE `$SQL_DATABASE`.`$tableCompt_Mouvement`
  SET
    $zeCompte, 
    $zeAnnee, 
    $zePeriode, 
    $zeDate,
    $zeEscroc,
    $zeComm,
    $zeRevenu,
    $zeDepense,
    $zeDebite
  WHERE
    `ID_Mouvement`='".$idMouvement."'");
  
  if ($ModifMouvement){
    header("Location: index.php#".$idMouvement);
    echo("<p> Mouvement correctement modifié </p>");
  }
  else{
     echo("<p> Erreur dans la requête de mise à jour <br /> 
     UPDATE `$SQL_DATABASE`.`$tableCompt_Mouvement`
  SET
    $zeCompte, 
    $zeAnnee, 
    $zePeriode, 
    $zeDate,
    $zeEscroc,
    $zeComm,
    $zeRevenu,
    $zeDepense,
    $zeDebite
  WHERE
    `ID_Mouvement`='".get('IdMouvement')."')</p>");  
  }
  
}
else{
  header("Location: index.php");
}
include("/Tools/compt_footer.php");
?>







