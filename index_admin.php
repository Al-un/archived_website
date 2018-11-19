<?php
include("Accueil/home_header.php");
if(Xsy_Glob_AuthCheck("XsyHome", $XSY_SESS_ADMINLEVEL)) {

  echo("
    <table border='1'>
     <tr>
       <td> <a href='?sqltable=MinisiteAdministration'> Minisite Administration</a> </td>
       <td> <a href='?sqltable=ChangeGlobSettings'> Change Global Settings </a> </td>
       <td> <a href='?sqltable=SqlDirectInput'> SQL Direct Input</a> </td>
       <td> <a href='?sqltable=SqlExport'> SQL Export </a> </td>
       <td> <a href='?sqltable=$sqlTable_all_minisites'> $sqlTable_all_minisites </a> </td>
       <td> <a href='?sqltable=$sqlTable_all_users'> $sqlTable_all_users </a> </td>
       <td> <a href='?sqltable=$sqlTable_all_languages'> $sqlTable_all_languages </a> </td>
       <td> <a href='?sqltable=$sqlTable_all_auths'> $sqlTable_all_auths </a> </td>
       <td> <a href='?sqltable=$sqlTable_all_sitelang'> $sqlTable_all_sitelang </a> </td>
       <td> <a href='?sqltable=$sqlTable_all_siteuser'> $sqlTable_all_siteuser </a> </td>
       <td> <a href='?sqltable=$sqlTable_all_sitedesc'> $sqlTable_all_sitedesc </a> </td>
       <td> <a href='?sqltable=$sqlTable_all_siteupd'> $sqlTable_all_siteupd </a> </td>
     </tr>
    </table>
  ");

  if(isset($_GET['sqltable'])){
    switch($_GET['sqltable']){
      case "MinisiteAdministration" : include('Accueil/minisite_admin.php'); break;
      case "SqlDirectInput"         : include('Accueil/sql_directinput.php'); break;
      case "SqlExport"              : include('Accueil/sql_export.php'); break;
      case "ChangeGlobSettings"     : include('Accueil/global_changesettings.php'); break;
      case $sqlTable_all_minisites  : Xsy_Sql_ManageTableData($sqlTable_all_minisites); break;
      case $sqlTable_all_users      : Xsy_Sql_ManageTableData($sqlTable_all_users); break;
      case $sqlTable_all_languages  : Xsy_Sql_ManageTableData($sqlTable_all_languages); break;
      case $sqlTable_all_auths      : Xsy_Sql_ManageTableData($sqlTable_all_auths); break;
      case $sqlTable_all_sitelang   : Xsy_Sql_ManageTableData($sqlTable_all_sitelang); break;
      case $sqlTable_all_siteuser   : Xsy_Sql_ManageTableData($sqlTable_all_siteuser); break;
      case $sqlTable_all_sitedesc   : Xsy_Sql_ManageTableData($sqlTable_all_sitedesc); break;
      case $sqlTable_all_siteupd    : Xsy_Sql_ManageTableData($sqlTable_all_siteupd); break;
    }
  }
}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}

include("Accueil/home_footer.php");
?>