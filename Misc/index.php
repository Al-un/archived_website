<?php
include_once("misc_header.php");

if(Xsy_Glob_AuthCheck("XsyMisc", $XSY_SESS_NORMALLEVEL)) {

  include_once("misc_dataprocess.php");
  include_once("misc_dataget.php");
  include_once("misc_datadisplay.php");

}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}
include_once("misc_footer.php");
?>