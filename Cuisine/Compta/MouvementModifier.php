<?php
include('Tools/compt_header.php');
// ================================================== //
// Modifier un mouvement?
// ================================================== //

  // ================== Check le mouvement à modifier======================= //
  $idMouvement     = get('idMouvement');
  $tmp_Mouvement   = sql_query("SELECT * from $tableCompt_Mouvement WHERE `ID_Mouvement`='$idMouvement'");
  $aMouvement      = mysql_fetch_assoc($tmp_Mouvement);

     // ================== Check toutes les années  ======================== //
  $allAnnee = "";
  $tmp_Annee = sql_query("SELECT * FROM `$tableCompt_Annee`");
  while ($aAnnee = mysql_fetch_assoc($tmp_Annee )){
    if ($aAnnee['ID_Annee'] == $aMouvement['Id_Annee']){
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
    
    if ($aPeriode['ID_Periode'] == $aMouvement['Id_Periode']) {
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
    if ($aCompte['ID_Compte'] == $aMouvement['Id_Compte']) {
      $allCompte .= "      <option value='".$aCompte['ID_Compte']."' selected>".$aCompte['Txt_NomCompte']."</option>";
    }
    else{
      $allCompte .= "      <option value='".$aCompte['ID_Compte']."'>".$aCompte['Txt_NomCompte']."</option>";
    }
  }
  $allCompte = " <select name='Compte'>/n".$allCompte."/n  </select>";
  
  // ================== Check mouvement débité ou non=========================== // 
  $debite = $aMouvement['Bool_Debite']==1 ? "checked='checked'" : "";
  
$formMouvementModify = "
  <form method='post' action='MouvementProcessing.php'>
  <input type='hidden' name='IdMouvement' value='".$idMouvement."' />
    <table border='1'>
      <tr> <td> Ann&eacute;e  </td> <td> $allAnnee                                                      </td></tr>
    <tr> <td> Période      </td> <td> $allPeriode                                                     </td></tr>
    <tr> <td> Date        </td> <td><input type='date' name='Date' value='".$aMouvement['DT_Date']."'/>            </td></tr>
    <tr> <td> Compte      </td> <td> $allCompte                                                    </td></tr>
    <tr> <td> Escroc       </td> <td><input type='text' size='50' maxlength='20' name='Escroc' value='".$aMouvement['Txt_Escroc']."'/>      </td></tr>
    <tr> <td> Commentaire   </td> <td><input type='text' size='50' maxlength='100' name='Comment' value='".$aMouvement['Txt_Comment']."'/>  </td></tr>
    <tr> <td> Revenu        </td> <td><input type='text' size='50' maxlength='10' name='Revenu' value='".$aMouvement['Dble_Revenu']."' />    </td></tr>
    <tr> <td> Dépense      </td> <td><input type='text' size='50' maxlength='10' name='Depense' value='".$aMouvement['Dble_Depense']."'  />  </td></tr>
    <tr> <td> Débité        </td> <td><input type='checkbox' name='Debite' ".$debite." />                      </td></tr>
    <tr> <td colspan=2> <input type='submit' name='MouvementModifie' value='Modifier le Mouvement' /> </td></tr>
    </table>
  </form>";


  // print form !!
  echo $formMouvementModify;

include("/Tools/compt_footer.php");
?>







