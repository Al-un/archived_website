<?php
include('Tools/compt_header.php');
// ================================================== //
// Ajouter un mouvement?
// ================================================== //

     // ================== Check toutes les années  ======================== //
  $allAnnee = "";
  $tmp_Annee = sql_query("SELECT * FROM `$tableCompt_Annee`");
  while ($aAnnee = mysql_fetch_assoc($tmp_Annee )){
    if ($aAnnee['Int_Annee'] == Date("Y")){
      $allAnnee .= "      <option value='".$aAnnee['ID_Annee']."' selected>".$aAnnee['Int_Annee']."</option>";
    }
    else{
      $allAnnee .= "      <option value='".$aAnnee['ID_Annee']."'>".$aAnnee['Int_Annee']."</option>";
    }
  }
  $allAnnee = " <select name='Annee'>/n".$allAnnee."/n  </select>"; 
   // ================== Check toutes les périodes  ======================== //
  $allPeriode = "";
  $tmp_Periode = sql_query("SELECT * FROM `$tableCompt_Periode`");
  while ($aPeriode = mysql_fetch_assoc($tmp_Periode )){
    
    if ($aPeriode['ID_Periode'] == Date("m")) {
      $allPeriode .= "      <option value='".$aPeriode['ID_Periode']."' selected>".$aPeriode['Txt_NomPeriode']."</option>";
    }
    else{
      $allPeriode .= "      <option value='".$aPeriode['ID_Periode']."'>".$aPeriode['Txt_NomPeriode']."</option>";
    }
  }
  $allPeriode = " <select name='Periode'>/n".$allPeriode."/n  </select>"; 
  // ================== Check tous les comptes  =========================== //
  $allCompte = "";
  $tmp_Compte = sql_query("SELECT * FROM `$tableCompt_Compte`");
  while ($aCompte = mysql_fetch_assoc($tmp_Compte )){
    $allCompte .= "      <option value='".$aCompte['ID_Compte']."'>".$aCompte['Txt_NomCompte']."</option>";
  }
  $allCompte2 = " <select name='Compte2'>/n".$allCompte."/n  </select>";
  $allCompte = " <select name='Compte'>/n".$allCompte."/n  </select>";


$formMouvement = "
  <form method='post' action='MouvementProcessing.php'>
    <table border='1'>
      <tr> <td> Ann&eacute;e </td> <td> $allAnnee                                        </td></tr>
    <tr> <td> Période      </td> <td> $allPeriode                                       </td></tr>
    <tr> <td> Date         </td> <td><input type='date' name='Date' value='".Date("Y-m-d")."'/>      </td></tr>
    <tr> <td> Compte       </td> <td> $allCompte                                      </td></tr>
    <tr> <td> Escroc       </td> <td><input type='text' size='50' maxlength='20' name='Escroc' />    </td></tr>
    <tr> <td> Commentaire  </td> <td><input type='text' size='50' maxlength='100' name='Comment' /></td></tr>
    <tr> <td> Revenu       </td> <td><input type='text' size='50' maxlength='10' name='Revenu' />    </td></tr>
    <tr> <td> Dépense      </td> <td><input type='text' size='50' maxlength='10' name='Depense' />  </td></tr>
    <tr> <td> Débité       </td> <td><input type='checkbox' name='Debite' />                  </td></tr>
    <tr> <td> <input type='submit' name='MouvementAjoute' value='Ajouter le Mouvement' /> </td></tr>
    </table>
  </form>";
  
 
 $formTransfert = "
   <form method='post' action='MouvementProcessing.php'>
    <table border='1'>
      <tr> <td> Ann&eacute;e  </td> <td> $allAnnee                                      </td></tr>
    <tr> <td> Période      </td> <td> $allPeriode                                       </td></tr>
    <tr> <td> Date         </td> <td><input type='date' name='Date' value='".Date("Y-m-d")."'/>  </td></tr>
    <tr> <td> Débiteur     </td> <td> ".$allCompte."                                        </td></tr>
    <tr> <td> Créditeur    </td> <td> ".$allCompte2."                                      </td></tr>
    <tr> <td> Montant      </td> <td><input type='text' size='50' maxlength='10' name='Montant' />  </td></tr>
    <tr> <td> <input type='submit' name='TransfertAjoute' value='Ajouter le Transfert' /> </td></tr>
    </table>
  </form>";
 


if (isset($_POST['AjouterMouvement'])){
  echo $formMouvement;
}
elseif (isset($_POST['AjouterTransfert'])){
  echo $formTransfert;
}
else{
  header("Location:index.php");
}



include("/Tools/compt_footer.php");
?>







