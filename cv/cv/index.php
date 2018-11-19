<?php
include("../tools/cv_header.php");
if(Xsy_Glob_AuthCheck("XsyCV", $XSY_SESS_USERLEVEL)) {


  echo("  <div id='cv'>");
  if ($_SESSION['UserLang'] == 'Fr' || $_SESSION['UserLang'] == 'En' || $_SESSION['UserLang'] == 'ZhTr') {
    include('cv_'.$_SESSION['UserLang'].'.htm');
  }
  echo("  </div>");

}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}
include("../tools/cv_footer.php");
?>