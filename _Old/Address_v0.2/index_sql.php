<?php
include("addr_header.php");

if(Xsy_Glob_AuthCheck("XsyAddress", $XSY_SESS_ADMINLEVEL)) {

  include_once("addr_settings.php");

  echo("
  <div id='AddrSummary'>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrType'>   $sqlTable_AddrType     </a>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrCate'>   $sqlTable_AddrCate     </a>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrSubCate'>$sqlTable_AddrSubCate  </a>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrCountry'>$sqlTable_AddrCountry  </a>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrArea'>   $sqlTable_AddrArea     </a>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrCity'>   $sqlTable_AddrCity     </a>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrItem'>   $sqlTable_AddrItem     </a>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrItemCate'>      $sqlTable_AddrItemCate  </a>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrItemCity'>      $sqlTable_AddrItemCity  </a>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrTranslateShort'>$sqlTable_AddrTranslateShort  </a>
  <a href='index_sql.php?sqlTable=$sqlTable_AddrTranslateLong'> $sqlTable_AddrTranslateLong   </a>
  </div>
");

  if (isset($_GET['sqlTable'])){
    Xsy_Sql_ManageTableData($_GET['sqlTable']);
  }

}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}

include("addr_footer.php");
?>







