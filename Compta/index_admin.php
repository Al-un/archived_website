<?php
include('compt_header.php');
if(Xsy_Glob_AuthCheck("Compta", $XSY_SESS_ADMINLEVEL)) {

  echo($summary);

  echo("
    <table border='1'>
     <tr>
       <td> <a href='?sqltable=$sqlTable_ComptCompte'> $sqlTable_ComptCompte </a> </td>
       <td> <a href='?sqltable=$sqlTable_ComptAnnee'> $sqlTable_ComptAnnee </a> </td>
       <td> <a href='?sqltable=$sqlTable_ComptPeriode'> $sqlTable_ComptPeriode </a> </td>
       <td> <a href='?sqltable=$sqlTable_ComptSolde'> $sqlTable_ComptSolde </a> </td>
       <td> <a href='?sqltable=$sqlTable_ComptFraisFixe'> $sqlTable_ComptFraisFixe </a> </td>
     </tr>
    </table>
  ");

  $compteCond['ORDER BY']['Int_Order']    = "";
  $soldeCond['ORDER BY']['Id_ComptAnnee'] = "DESC";

  if(isset($_GET['sqltable'])){
    switch($_GET['sqltable']){
      case $sqlTable_ComptCompte    : Xsy_Sql_ManageTableData($sqlTable_ComptCompte, $compteCond, NULL, NULL); break;
      case $sqlTable_ComptAnnee     : Xsy_Sql_ManageTableData($sqlTable_ComptAnnee); break;
      case $sqlTable_ComptPeriode   : Xsy_Sql_ManageTableData($sqlTable_ComptPeriode); break;
      case $sqlTable_ComptSolde     : Xsy_Sql_ManageTableData($sqlTable_ComptSolde, $soldeCond, NULL, NULL); break;
      case $sqlTable_ComptFraisFixe : Xsy_Sql_ManageTableData($sqlTable_ComptFraisFixe); break;
    }
  }


}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}
include('compt_footer.php');
?>
