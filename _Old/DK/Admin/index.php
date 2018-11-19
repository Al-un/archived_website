<?php
$adminRequired = FALSE;
include("../Tools/phobida_header.php");
include("phobida_usercheck.php");


echo(" <div id='Phobida_Admin'>");

if($_SESSION['useradmin']){

  // welcome box with log out button
  echo("
  <div id='WelcomeBox'>
    <div style='text-align:center;'>
     <form method='post' action='' style='width:50%;margin:auto;'>
       <input type='submit' name='LogoutSubmit' value='Log out' style='width:100%'/>
     </form>
    </div>
  </div>\n");

  // the header menu
  echo("  <div id='Phobida_Summary'>");
  include("phobida_adminsummary.php");
  echo("  </div>");

  // Administration content (sql table management ...)
  // Technical content (server url, database name...)
  echo("  <div id='Phobida_AdminContent'>");
  include("phobida_sqlTables.php");
  include("phobida_technicalinfo.php");
  include("phobida_phpmngt_menu.php");
  echo("  </div>\n");


}
else{
  echo($loginNotAdmin);
}

echo(" </div> <!-- end Phobida_Admin -->");

include("../Tools/phobida_footer.php");
?>