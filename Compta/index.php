<?php
include('compt_header.php');
if(Xsy_Glob_AuthCheck("Compta", $XSY_SESS_ADMINLEVEL)) {

  echo($summary);

  // Ajouter mouvement, modifier mouvement ou ajouter transfert : pas d'affichage de toutes les données.
  if(isset($_GET['ComptAction']) AND ($_GET['ComptAction'] == "XsyComptAddMouv")){
    include_once("MouvementAjouter.php");
  }
  elseif(isset($_GET['ComptAction']) AND ($_GET['ComptAction'] == "XsyComptAddTransfer")){
    include_once("MouvementAjouter.php");
  }
  elseif(isset($_POST['XsyComptMouvUpd'])){
      include_once("MouvementModifier.php");
  }

  else{
    if(isset($_POST['XsyComptMouvDeb'])){
      include_once("MouvementDebiter.php");
    }
    
    elseif(isset($_POST['XsyComptMouvDel'])){
      include_once("MouvementSupprimer.php");
    }
    elseif(isset($_GET['ComptAction']) OR 
          isset($_POST['XsyComptMouvModified']) OR
          isset($_POST['XsyComptMouvAdded']) OR
          isset($_POST['XsyComptMouvModified']) OR
          isset($_POST['XsyComptTransfertAdded'])){
      include_once("MouvementProcessing.php");
    }

    include_once("compt_getdata.php");
  }
}




else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}
include("compt_footer.php");
?>







