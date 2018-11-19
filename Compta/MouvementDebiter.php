<?php

// ================================================== //
// Mouvement débité !
// ================================================== // 

  $idMouvement      = Xsy_Glob_Get('XsyComptMouvID');
  $updateArray['Bool_Debite'] = 1;
  $debiterMouvement = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_ComptMouvement, $updateArray, $idMouvement);

  if ($debiterMouvement){
    echo("Mouvement correctement débité");
  }
  else{
    echo("Mouvement débité: ERROR");
  }


?>







