<?php

// ================================================== //
// Modifier un mouvement?
// ================================================== //

  // ================== Check le mouvement à modifier======================= //
  $idMouvement     = Xsy_Glob_Get('XsyComptMouvID');
  $tmp_Mouvement   = Xsy_Sql_Query("SELECT * FROM `$sqlTable_ComptMouvement` WHERE `ID_ComptMouvement`='$idMouvement'");
  $aMouvement      = Xsy_Sql_Fetch($tmp_Mouvement);

     // ================== Check toutes les années  ======================== //
  $allAnnee = Xsy_Sql_DisplayFieldValue('Id_ComptAnnee', $aMouvement['Id_ComptAnnee'], "Update");
  
   // ================== Check toutes les périodes  ======================== //
  $allPeriode = Xsy_Sql_DisplayFieldValue('Id_ComptPeriode', $aMouvement['Id_ComptPeriode'], "Update");
  
  // ================== Check tous les comptes  =========================== //
  $allCompte = Xsy_Sql_DisplayFieldValue('Id_ComptCompte', $aMouvement['Id_ComptCompte'], "Update");
  
  // ================== Check mouvement débité ou non=========================== // 
  $debite = $aMouvement['Bool_Debite']==1 ? "checked='checked'" : "";
  
$formMouvementModify = "
  <form method='post' action='index.php#".$idMouvement."'>
  <input type='hidden' name='IdMouvement' value='".$idMouvement."' />
    <table border='1'>
      <tr> <td> Ann&eacute;e  </td> <td> $allAnnee </td></tr>
    <tr> <td> Période      </td> <td> $allPeriode </td></tr>
    <tr> <td> Date        </td> <td><input type='date' name='Date' value='".$aMouvement['DT_Date']."'/> </td></tr>
    <tr> <td> Compte      </td> <td> $allCompte </td></tr>
    <tr> <td> Escroc       </td> <td><input type='text' size='50' maxlength='20' name='Escroc' value='".$aMouvement['Txt_Escroc']."'/> </td></tr>
    <tr> <td> Commentaire   </td> <td><input type='text' size='50' maxlength='100' name='Comment' value='".$aMouvement['Txt_Comment']."'/> </td></tr>
    <tr> <td> Revenu        </td> <td><input type='text' size='50' maxlength='10' name='Revenu' value='".$aMouvement['Dble_Revenu']."' /> </td></tr>
    <tr> <td> Dépense      </td> <td><input type='text' size='50' maxlength='10' name='Depense' value='".$aMouvement['Dble_Depense']."'  /> </td></tr>
    <tr> <td> Débité        </td> <td><input type='checkbox' name='Debite' ".$debite." /> </td></tr>
    <tr> <td colspan=2> <input type='submit' name='XsyComptMouvModified' value='Modifier le Mouvement' /> </td></tr>
    </table>
  </form>";


  // print form !!
  echo $formMouvementModify;

?>







