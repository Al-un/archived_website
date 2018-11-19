<?php


// ================================================== //
//                 Mouvement ajouté !
// ================================================== //
if (isset($_POST['XsyComptMouvAdded'])) {


  foreach($_POST['Annee'] as $key=>$value){

    if(($_POST['Revenu'][$key]!=="") OR ($_POST['Depense'][$key]!=="")){

      $addedMouv['Id_ComptAnnee']   = $_POST["Annee"][$key];
      $addedMouv['Id_ComptPeriode'] = $_POST["Periode"][$key];
      $addedMouv['Id_ComptCompte']  = $_POST["Compte"][$key];
      $addedMouv['DT_Date']         = $_POST["Date"][$key];
      $addedMouv['Txt_Escroc']      = $_POST["Escroc"][$key];
      $addedMouv['Txt_Comment']     = $_POST["Comment"][$key];
      $addedMouv['Dble_Revenu']     = $_POST["Revenu"][$key];
      $addedMouv['Dble_Depense']    = $_POST["Depense"][$key];
      $addedMouv['Bool_Debite']     = $_POST["Debite"][$key];

      $addMouvement = Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_ComptMouvement, $addedMouv);
      
      // destroy $_POST['...'] variables
      // unset($_POST['MouvementAjoute']);
      // unset($_POST['Id_ComptAnnee']);
      // unset($_POST['Id_ComptPeriode']);
      // unset($_POST['Id_ComptCompte']);
      // unset($_POST['Date']);
      // unset($_POST['Escroc']);
      // unset($_POST['Comment']);
      // unset($_POST['Revenu']);
      // unset($_POST['Depense']);
      // unset($_POST['Debite']);
      
      
      // check and back
      if ($addMouvement){
        echo("<p> Mouvement correctement ajouté </p>");
      }
      else{
        echo("<p> Erreur dans l'ajout du mouvement</p>");
      }

    }

  }

}



// ================================================== //
//                 Frais fixe ajouté !
// ================================================== //
if (isset($_GET['ComptAction']) AND $_GET['ComptAction']=='XsyComptAddFraisFixe') {

  $allFraisFixeArray = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_ComptFraisFixe`");

  foreach($allFraisFixeArray as $key => $aFraisFixe){

    $addedFraisFixe['Id_ComptCompte']   = $aFraisFixe['Id_ComptCompte'];
    $addedFraisFixe['Id_ComptAnnee']    = $_SESSION['ComptAnneeID'];
    $addedFraisFixe['Id_ComptPeriode']  = Date("m");
    $addedFraisFixe['DT_Date']          = Date("Y-m-d");
    $addedFraisFixe['Txt_Escroc']       = $aFraisFixe['Txt_Escroc'];
    $addedFraisFixe['Txt_Comment']      = $aFraisFixe['Txt_Comment'];
    $addedFraisFixe['Dble_Revenu']      = $aFraisFixe['Dble_Revenu'];
    $addedFraisFixe['Dble_Depense']     = $aFraisFixe['Dble_Depense'];
    Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_ComptMouvement, $addedFraisFixe);

  }

}


// ================================================== //
//                 Transfert ajouté !
// ================================================== //
if (isset($_POST['XsyComptTransfertAdded'])) {

  foreach($_POST['Annee'] as $key=>$value){

    if($_POST['Montant'][$key]!==""){

      $addedTransfert1['Id_ComptAnnee']   = $_POST["Annee"][$key];
      $addedTransfert2['Id_ComptAnnee']   = $_POST["Annee"][$key];
      $addedTransfert1['Id_ComptPeriode'] = $_POST["Periode"][$key];
      $addedTransfert2['Id_ComptPeriode'] = $_POST["Periode"][$key];
      $addedTransfert1['DT_Date']         = $_POST["Date"][$key];
      $addedTransfert2['DT_Date']         = $_POST["Date"][$key];
      $addedTransfert1['Id_ComptCompte']  = $_POST["Compte"][$key];
      $addedTransfert1['Bool_Debite']     = $_POST["Debite"][$key];
      $addedTransfert2['Id_ComptCompte']  = $_POST["Compte2"][$key];
      $addedTransfert2['Bool_Debite']     = $_POST["Debite2"][$key];
      $addedTransfert1['Txt_Escroc']      = "Transfert";
      $addedTransfert2['Txt_Escroc']      = "Transfert";
      $addedTransfert1['Dble_Depense']    = $_POST["Montant"][$key];
      $addedTransfert2['Dble_Depense']    = -$_POST["Montant"][$key];
      
      $addTransfert1 = Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_ComptMouvement, $addedTransfert1);
      $addTransfert2 = Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_ComptMouvement, $addedTransfert2);
      
      if ($addTransfert1 && $addTransfert2){
        echo("<p> Transfert correctement ajouté </p>");
      }
      else{
        echo("<p> Transfert raté </p>");
      }

    }

  }

}


// ================================================== //
//                 Mouvement modifié !
// ================================================== //
if (isset($_POST['XsyComptMouvModified'])) {

  $idMouvement = Xsy_Glob_Get('IdMouvement');

  $modifiedMouv['Id_ComptAnnee']    = Xsy_Glob_Get("Id_ComptAnnee");
  $modifiedMouv['Id_ComptPeriode']  = Xsy_Glob_Get("Id_ComptPeriode");
  $modifiedMouv['Id_ComptCompte']   = Xsy_Glob_Get("Id_ComptCompte");
  $modifiedMouv['DT_Date']          = Xsy_Glob_Get("Date");
  $modifiedMouv['Txt_Escroc']       = Xsy_Glob_Get("Escroc");
  $modifiedMouv['Txt_Comment']      = Xsy_Glob_Get("Comment");
  $modifiedMouv['Dble_Revenu']      = Xsy_Glob_Get("Revenu");
  $modifiedMouv['Dble_Depense']     = Xsy_Glob_Get("Depense");
  $modifiedMouv['Bool_Debite']      = ((Xsy_Glob_Get("Debite")==TRUE) ? 1 : 0);
  
  $ModifMouvement = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_ComptMouvement, $modifiedMouv, $idMouvement);
  
  if ($ModifMouvement){
    echo("<p> Mouvement correctement modifié </p>");
  }
  else{
     echo("<p> Erreur dans la requête de mise à jour <br />");
  }
  
}

?>







