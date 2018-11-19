<?php	
include('Accueil/home_header.php');

echo("  <img src='/Accueil/img/Home_Content_Back_PartTop.png' width='100%' id='FakeBackGroundTop'/>\n");
echo("  <div id='FakeContent'>");

  // new user is created
  if( isset($_POST['XsyUserAdd']) OR isset($_POST['XsyHomeRegister']) ){
    if(Xsy_Glob_AuthCheck("XsyHome", $XSY_SESS_NORMALLEVEL)) { include('Accueil/profile_register.php'); }
      else{ echo $XSY_SESS_NO_AUTH_ERRORTXT; }
  }
  elseif( isset($_POST['XsyHomeUpdProfile']) OR isset($_POST['XsyUpdProfile']) OR isset($_POST['XsyUpdPassword']) ) {
    if(Xsy_Glob_AuthCheck("XsyHome", $XSY_SESS_NORMALLEVEL)) { include('Accueil/profile_modify.php');}
      else{ echo $XSY_SESS_NO_AUTH_ERRORTXT; }
  }
  else{
    include('Accueil/minisite_display.php');
  }


// include('Accueil/contactme.php');
// include('Accueil/update.php');

echo("  </div>");

echo("  <div id='FakeBackground'>\n  <img src='/Accueil/img/Home_Content_Back_PartMid.png' /></div>\n");
echo("  <img src='/Accueil/img/Home_Content_Back_PartBot.png' width='100%' id='FakeBackGroundBot' />\n");

include('Accueil/home_footer.php');
?>