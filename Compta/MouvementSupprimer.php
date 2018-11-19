<?php
// ================================================== //
// Supprimer un mouvement?
// ================================================== //
  
  $idMovement       = Xsy_Glob_Get("XsyComptMouvID");
  $DeleteMouvement  = Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_ComptMouvement, 'ID_ComptMouvement', $idMovement);
  
  if ($DeleteMouvement){
    echo("<p> Mouvement correctement supprimé </p>");
  }
  else{
     echo("<p> Erreur dans la requête de mise à jour <br /> DELETE FROM `$SQL_DATABASE`.`$tableCompt_Mouvement` WHERE `ID_Mouvement`='".get('IdMouvement')."'");
  }

?>







