<?php
include("addr_header.php");

if(Xsy_Glob_AuthCheck("XsyAddress", $XSY_SESS_NORMALLEVEL)) {
/*
  include_once("addr_getdata.php");
  include_once("addr_displaydata.php");

  echo(" <div id='AddrLeftPanel'>\n");
  echo($leftPanel);
  echo(" </div>\n");
  echo(" <div id='AddrRightPanel'>\n");
  echo($rightPanel);
  echo(" </div>\n");

  if ($_SESSION['FilterAddrType']==0 AND $_SESSION['FilterAddrCountry']==0){
    echo($welcomeMsg);
  }
  else{
    echo(" <div id='AddrItemPanel'>\n");
    echo($itemPanel);
    echo(" </div>\n");
  }
*/

}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}

include("addr_footer.php");
?>







