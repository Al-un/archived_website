<?php

// =================================== INITIALIZE VARIABLES ========================= //
// where are we from?
$page = $_SERVER['PHP_SELF'];
$errorlogin = Xsy_Glob_Get('errorlogin');

// log variables
$logWelcome    = "welcome";
$logModify      = "modify";
$logLogout     = "disconnect";

$logLogin      = "login";
$logPassword   = "pwd";
$logRemember   = "remember"; 
$logSubmit     = "submit";
$logRegister    = "register";  


// =================================== SWITCH LANGUAGE ================================ //
switch ($_SESSION['UserLang']) {
    
case "Fr" :
  $logWelcome     = "Bienvenue";
  $logModify      = "Modifier son profil";
  $logLogout      = "Se d&eacute;connecter";

  $logErrLog      = (isset($_SESSION['LoginError'])) ? "<p style='color:red;'>Identifiants incorrects</p>" : "";
  $logLogin       = "Identifiant";
  $logPassword    = "Mot de Passe";
  $logRemember    = "Rester connect&eacute;"; 
  $logSubmit      = "Se connecter";
  $logRegister    = "Cr&eacute;er un compte";
  break;

case "En" :
  $logErrLog      = (isset($_SESSION['LoginError'])) ? "<p style='color:red;'>Incorrect logins</p>" : "";
  $logWelcome     = "Welcome";
  $logModify      = "Modify profile";
  $logLogout      = "Sign out";

  $logLogin       = "Login";
  $logPassword    = "Password";
  $logRemember    = "Stay signed in"; 
  $logSubmit      = "Sign in";
  $logRegister    = "Register";
  break;

case "ZhTr" :
  $logErrLog      = (isset($_SESSION['LoginError'])) ? "<p style='color:red;'></p>" : "";
  $logWelcome     = "";
  $logModify      = "";
  $logLogout      = "";

  $logLogin       = "";
  $logPassword    = "";
  $logRemember    = ""; 
  $logSubmit      = "";  
  $logRegister    = "";
  break;

case "Jp" :
  $logErrLog      = (isset($_SESSION['LoginError'])) ? "<p style='color:red;'></p>" : "";
  $logWelcome     = "";
  $logModify      = "";
  $logLogout      = "";

  $logLogin       = "";
  $logPassword    = "";
  $logRemember    = ""; 
  $logSubmit      = "";  
  $logRegister    = "";
  break;

default:
  echo('    <p>session_login_form.php: Wrong language input: '.$_SESSION['UserLang'].'</p>');
}


// =================================== DISPLAY LOGIN FORM ============================= //

// here we go
echo("  <div id = 'MainLoginForm' class = 'loginform'>");
     
// -------------  if already logged  -------------- //
if (isset($_SESSION['UserName']) AND $_SESSION['UserName'] !== "DefaultUser") {
// if (isset($_SESSION['UserName'])) {
  echo("
  <div class='logged'>
   <p>".$logWelcome." ".$_SESSION['UserName']."</p>
   <form method='post' action='http://".$_SERVER['HTTP_HOST']."'> <input class='submit' type='submit' name='XsyHomeUpdProfile' value='".$logModify."' /> </form>
   <form method='post' action=''> <input class='submit' type='submit' name='XsySessionLogOut' value='".$logLogout."' /> </form>
  </div>");   
}
    
    
// ------------  else need the login form  --------- //
else{
  $login = Xsy_Glob_Get('login');
  echo("
   $logErrLog  
   <form method = 'post' action = ''>
    <div>
    <p> $logLogin </p>
    <input class='input' type = 'text'     name = 'XsySessLogin'    value = '$login' size = '12'/>  
    <p> $logPassword</p>        
    <input class='input' type = 'password' name = 'XsySessPwd' size = '12'/>
    <input class='check' type = 'checkbox' name = 'XsySessCookie'   value = 'remember'/> $logRemember
    <input class='submit' type = 'submit'   name = 'XsySessionLogIn'   value = '$logSubmit' />
   </div>
   </form>  

   <form method='post' action='".$zToolsRoot."'> <input class = 'submit' type='submit' name='XsyHomeRegister' value='".$logRegister."' /> </form>");
}
    
echo("
  </div><!-- end class = 'login' -->
");
    
?>