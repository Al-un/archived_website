<?php
include_once("memo_header.php");
if(Xsy_Glob_AuthCheck("XsyMemo", $XSY_SESS_ADMINLEVEL)) {

  if(isset($_GET['sqltable'])){
    Xsy_Sql_ManageTableData($_GET['sqltable']);
  }
  else{
    echo("<p> what the hell ??? </p>");
  }
}
else{
  echo($XSY_SESS_NO_AUTH_ERRORTXT);
}

include_once("memo_footer.php");
?>