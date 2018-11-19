<?php
include('Tools/compt_header.php');
// ================================================== //
// Mouvement débité !
// ================================================== // 
if (isset($_POST['DebiterMovement'])) {

  $idMouvement      = get('idMouvement');
  $debiterMouvement = sql_query("UPDATE `$SQL_DATABASE`.`$tableCompt_Mouvement` SET `Bool_Debite`='1' WHERE `ID_Mouvement`='".$idMouvement."'");
 
  if ($debiterMouvement){
    header("Location: index.php#".$idMouvement);
    echo("Mouvement correctement débité");
  }
  else{
    echo("Mouvement débité: ERROR");
  }
 
}
else{
  header("Location: index.php");
}
include("/Tools/compt_footer.php");
?>







