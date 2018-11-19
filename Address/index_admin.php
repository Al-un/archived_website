<?php
include("addr_header.php");

if(Xsy_Glob_AuthCheck("XsyAddress", $XSY_SESS_ADMINLEVEL)) {

  echo("  <table>
  <tr>
    <td> <a href='index_admin.php?AddrAdmin=Area'> Admin Area </a> </td>
    <td>  </td>
  </tr>
  </table>");

  if(isset($_GET['AddrAdmin'])){
    switch($_GET['AddrAdmin']){
      case "Cate" : addr_Admin("Cate"); break;
      case "Area" : addr_Admin("Area"); break;
      case "Item" : break;
    }
  }
  elseif(isset($_GET['SqlAdmin'])){
    Xsy_Sql_ManageTableData($_GET['SqlAdmin']);
  }

}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}

      // case $sqlTable_AddrItem     : break;
      // case $sqlTable_AddrArea     : break;
      // case $sqlTable_AddrCate     : break;
      // case $sqlTable_AddrItemArea : break;
      // case $sqlTable_AddrItemCate : break;
      // case $sqlTable_AddrTranslate: break;
include("addr_footer.php");
?>







