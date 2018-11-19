<?php

// ================================================== //
// Ajouter un mouvement?
// ================================================== //

// ================== Check toutes les années  ========================== //
  $tmp_sql      = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_ComptAnnee`");
  $allAnnee     = "    <select name='Annee[]'>\n";
  foreach($tmp_sql as $key=>$value){
    $selected  = ($value['Int_ComptAnnee%Name']==Date("Y")) ? "selected" : "";
    $allAnnee .= "      <option value='".$value['ID_ComptAnnee']."' $selected> ".$value['Int_ComptAnnee%Name']." </option>\n";
  }
  $allAnnee    .= "    </select>\n";

// ================== Check toutes les périodes  ======================== //
  $tmp_sql      = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_ComptPeriode`");
  $allPeriode   = "    <select name='Periode[]'>\n";
  foreach($tmp_sql as $key=>$value){
    $selected  = ($value['ID_ComptPeriode']==Date("m")) ? "selected" : "";
    $allPeriode .= "      <option value='".$value['ID_ComptPeriode']."' $selected> ".$value['Txt_ComptPeriode%Name']." </option>\n";
  }
  $allPeriode  .= "    </select>\n";

// ================== Check tous les comptes  =========================== //
  $tmp_sql      = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_ComptCompte` WHERE `Bool_Active`='1' ORDER BY `Int_Order`");
  $allCompte    = "    <select name='Compte[]'>\n";
  $allCompte2   = "    <select name='Compte2[]'>\n";
  foreach($tmp_sql as $key=>$value){
    $allCompte .= "      <option value='".$value['ID_ComptCompte']."'> ".$value['Txt_ComptCompte%Name']." </option>\n";
    $allCompte2 .= "      <option value='".$value['ID_ComptCompte']."'> ".$value['Txt_ComptCompte%Name']." </option>\n";
  }
  $allCompte   .= "    </select>\n";
  $allCompte2  .= "    </select>\n";

// ================== Liste debite  ======================== //
  $allDebite = "    <select name='Debite[]'>
      <option value='1'> Oui </option>
      <option value='0' selected> Non </option>
    </selected>\n";
  $allDebite2 = "    <select name='Debite2[]'>
      <option value='1'> Oui </option>
      <option value='0' selected> Non </option>
    </selected>\n";


$formMouvement = "
  <form method='post' action='index.php'>
    <table id='ComptAddMoveTable' class='Mouvement'>
    <tr>
      <th> Ann&eacute;e </th>
      <th> Période </th>
      <th> Date </th>
      <th> Compte </th>
      <th> Escroc </th>
      <th> Commentaire </th>
      <th> Revenu </th>
      <th> Dépense </th>
      <th> Débité </th>
    </tr>


    <tr id='ComptAddMoveRow'> 
      <td> $allAnnee </td>
      <td> $allPeriode </td>
      <td> <input type='date' name='Date[]' value='".Date("Y-m-d")."'/> </td>
      <td> $allCompte </td>
      <td><input type='text' size='16' maxlength='20'  name='Escroc[]' /> </td>
      <td><input type='text' size='40' maxlength='100' name='Comment[]' /> </td>
      <td><input type='text' size='15' maxlength='10'  name='Revenu[]' /> </td>
      <td><input type='text' size='15' maxlength='10'  name='Depense[]' /> </td>
      <td> $allDebite </td>
    </tr>

    <tr id='ComptLastRow'>
      <td colspan='9'> <input type='submit' name='XsyComptMouvAdded' value='Ajouter le Mouvement' /> </td>
    </tr>

    </table>
  </form>

  <p id='ComptAddAnotherRow'> Ajouter une ligne  </p>
";
  
 
 $formTransfert = "
  <form method='post' action='index.php'>
    <table id='ComptAddMoveTable' class='Mouvement'>
    <tr>
      <th> Ann&eacute;e </th>
      <th> Période </th>
      <th> Date </th>
      <th> Débiteur </th>
      <th> Débité </th>
      <th> Créditeur </th>
      <th> Débité </th>
      <th> Montant </th>
    </tr>


    <tr id='ComptAddMoveRow'> 
      <td> $allAnnee </td>
      <td> $allPeriode </td>
      <td> <input type='date' name='Date[]' value='".Date("Y-m-d")."'/> </td>
      <td> $allCompte </td>
      <td> $allDebite </td>
      <td> $allCompte2 </td>
      <td> $allDebite2 </td>
      <td> <input type='text' size='50' maxlength='10' name='Montant[]' /> </td>
    </tr>

    <tr id='ComptLastRow'>
      <td colspan='8'> <input type='submit' name='XsyComptTransfertAdded' value='Ajouter le Transfert' /> </td>
    </tr>

    </table>
  </form>

  <p id='ComptAddAnotherRow'> Ajouter une ligne  </p>";



if ($_GET['ComptAction'] == "XsyComptAddMouv"){
  echo $formMouvement;
}
elseif ($_GET['ComptAction'] == "XsyComptAddTransfer"){
  echo $formTransfert;
}
else{
  header("Location:index.php");
}

?>







