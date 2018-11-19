<?php
include_once("misc_header.php");

if(Xsy_Glob_AuthCheck("XsyMisc", $XSY_SESS_ADMINLEVEL)) {

  if(isset($_GET['sqltable'])){
    Xsy_Sql_ManageTableData($_GET['sqltable']);
  }
  elseif(isset($_GET['fileTable'])){
    /* handle Excel file is too different from sync file */
    if($_GET['fileTable']==$sqlTable_MiscExcel){
      Xsy_Sql_ManageTableWithFiles($sqlTable_MiscExcel, $fileArray, $mapping);
    }
    elseif($_GET['fileTable']==$sqlTable_MiscSync){
      // Xsy_Sql_ManageTableWithFiles($sqlTable_MiscSync, $syncArray, $mapping);
    }
  }
  elseif(isset($_GET['fileEdit'])){
    Xsy_Glob_EditMultipleFolder($pathArray);
  }
  else{
    echo("<p> Qu'est ce que tu fous l&agrave;? </p>");
  }

}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}
include_once("misc_footer.php");
?>