<?php
include("addr_header.php");

if(Xsy_Glob_AuthCheck("XsyAddress", $XSY_SESS_ADMINLEVEL)) {
  include_once("addr_settings.php");
  include_once("admin_item.php");
}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}

include("addr_footer.php");
?>







