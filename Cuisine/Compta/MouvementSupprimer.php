<?php
include('Tools/compt_header.php');
// ================================================== //
// Supprimer un mouvement?
// ================================================== //
if (isset($_POST['DeleteMovement'])) {
  
  $idMovement       = get("idMouvement");
  $DeleteMouvement  = sql_query("DELETE FROM `$SQL_DATABASE`.`$tableCompt_Mouvement` WHERE `ID_Mouvement`='$idMovement'");
  
  if ($DeleteMouvement){
    header("Location: index.php#".($idMovement-1));
    echo("<p> Mouvement correctement supprimé </p>");
  }
  else{
     echo("<p> Erreur dans la requête de mise à jour <br /> DELETE FROM `$SQL_DATABASE`.`$tableCompt_Mouvement` WHERE `ID_Mouvement`='".get('IdMouvement')."'");
  }
  
}
else{
  header("Location: index.php");
}
include("/Tools/compt_footer.php");
?>







