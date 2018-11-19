<?php
// ====================================  SWITCH LANGUAGES  ======================================= //

switch($_SESSION['UserLang']){

case "Fr" :
  $formText      = "Pour s'enregistrer, il faut juste choisir un identifiant, une langue (histoire de) et fournir un e-mail valide.";
  $formLogin      = "Identifiant";
  $formLang       = "Langue";
  $formEmail      = "E-mail";
  $formAdd        = "Cr&eacute;er un compte";
  $errLoginEmpty  = "Le nom d'utilisateur est vide, veuillez fournir un nom d'utilisateur.";
  $errEmailEmpty  = "L'adresse email est vide, veuillez fournir une adresse email.";
  $errLoginExist  = "Le nom d'utilisateur existe déjà. Veuillez en choisir un autre";
  $mailConfirm    = "";
  $mailError      = "";
  $mailSubject    = "";
  $mailContent    = "Bonjour <<USERLOGIN>>,\r\n \r\n
Merci pour ton enregistrement sur mon site http://xsylum.fr. Voici tes logins:\r\n
login: <<USERLOGIN>> \r\n
password: <<USERPASSWORD>> \r\n
Tu peux changer le login et autres informations dans 'Modifier mon profil' une fois connecté(e). A très bientôt! \r\n
\r\n
Xsylum";
  break;
  
case "En" :
  $formText       = "To register, you just need to set up a login name, choose a language and provide a valid email address.";
  $formLogin      = "Login";
  $formLang       = "Language";
  $formEmail      = "Email";
  $formAdd        = "Create an account";
  $errLoginEmpty  = "Login field is empty, please provide a login.";
  $errEmailEmpty  = "Email field is empty, please provide an email.";
  $errLoginExist  = "Login already exists, please choose another one.";
  $mailConfirm    = "";
  $mailError      = "";
  $mailSubject    = "";
  $mailContent    = "Hello <<USERLOGIN>>,\r\n \r\n
Thank you for your registration on my website http://xsylum.fr. Here are the logins:\r\n \r\n
login: <<USERLOGIN>> \r\n
password: <<USERPASSWORD>>\r\n
\r\n
You can modify it and some information later. Once connected, there will be a section 'Modify my profile'.\r\n
\r\n
Xsylum";
  break;
  
case "ZhTr" :
  $formText       = "";
  $formLogin      = "登入名稱";
  $formLang       = "語言";
  $formEmail      = "電子郵件";
  $formAdd        = "建立";
  $errLoginEmpty  = "";
  $errEmailEmpty  = "";
  $errLoginExist  = "";
  $mailConfirm    = "";
  $mailError      = "";
  $mailSubject    = "";
  $mailContent    = "";
  break;
  
case "Jp" :
  $formText       = "";
  $formLogin      = "";
  $formLang       = "";
  $formEmail      = "";
  $formAdd        = "";
  $errLoginEmpty  = "";
  $errEmailEmpty  = "";
  $errLoginExist  = "";
  $mailConfirm    = "";
  $mailError      = "";
  $mailSubject    = "";
  $mailContent    = "";
  break;
  
default:
  echo("Wrong language input: ".$_SESSION['userlang']);

}


// =========================================================================================================
// ---------    ADDING A ADD LOGIN FORM  
// =========================================================================================================

// -- the form
$formAddProfile = "$formText";

  $formAddProfile .= "  <form method='post' action=''>\n";
  $formAddProfile .= "  <table>\n";
  // ---- User Name 
  $loginValue     = (isset($_POST['XsyUserLogin'])) ? Xsy_Glob_Get('XsyUserLogin') : "";
  $formAddProfile .= "  <tr> <td> $formLogin </td> <td> <input type='text' name='XsyUserLogin' size='20' maxlength='16' value='$loginValue'/> </td> </tr>\n";
  

  // ---- User Lang
  $formAddProfile .= "  <tr> <td> $formLang </td> <td> <select name='XsyUserLang'>\n";
  $langRaw = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_all_languages`");
  foreach ($langRaw as $lang) {
    $langSelected   = (isset($_POST['XsyUserLang']) and $_POST['XsyUserLang'] == $lang['ID_Language']) ? "Selected" : "";
    $formAddProfile .= "    <option value='".$lang['ID_Language']."' $langSelected> ".$lang['Txt_Lang%Name']."</option>\n";
  }
  $formAddProfile .= "    </select> </td> </tr>\n";

  // ---- User Email
  $emailValue     = (isset($_POST['XsyUserEmail'])) ? Xsy_Glob_Get('XsyUserEmail') : "";
  $formAddProfile .= "  <tr> <td> $formEmail </td> <td> <input type='text' name='XsyUserEmail' size='20' maxlength='80' value='$emailValue'/> </td> </tr>\n";

  // ---- submit it
  $formAddProfile .= "  <tr> <td> <input type = 'submit' name = 'XsyUserAdd' value = '$formAdd' /> </td> </tr>\n";

  // ---- close form
  $formAddProfile .=  "  </table>\n  </form>";






// =========================================================================================================
// ---------    DISPLAY or PHP Processing
// =========================================================================================================


// php processing
if (isset($_POST['XsyUserAdd'])){
  processLoginRegistration();
}

// display form without errors
echo("<div class='Register'>\n $formAddProfile \n </div> <!-- class = 'register' -->");


















 




/***************************************************
 * Generate a random string for the password
 **************************************************/

function processLoginRegistration(){

  global $errLoginEmpty, $errEmailEmpty, $errLoginExist, $mailConfirm, $mailError, $mailSubject, $mailContent, $SQL_DATABASE, $sqlTable_all_users;

 // -- retrieve data and submit it to a SQL request
  $userLogin  = Xsy_Glob_Get('XsyUserLogin');
  $userLang   = Xsy_Glob_Get('XsyUserLang');
  $userEmail  = Xsy_Glob_Get('XsyUserEmail');
  $password   = generateRandomString(10);
  $hashPwd    = hash("sha512", $password);



  // === CHECK ON LOGIN and EMAIL
  $checkOK = TRUE;
  // empty user login?
  if ($userLogin == ""){
    echo("<p style='color:red;'>".$errLoginEmpty."</p>");
    $checkOK = FALSE;
  }
  // empty user email?
  if ($userEmail == ""){
    echo("<p style='color:red;'>".$errEmailEmpty."</p>");
    $checkOK = FALSE;
  }
  // check if the login already exists or not.
  $query      = "SELECT COUNT(*), `Txt_User%Name` FROM `$SQL_DATABASE`.`$sqlTable_all_users`  WHERE `Txt_User%Name`='$userLogin' ";
  $stmt       = Xsy_Sql_Query($query);
  $fetch      = Xsy_Sql_Fetch($stmt);
  $nb_login   = $fetch['COUNT(*)'];
  if ( $nb_login > 0 ){
    echo("<p style='color:red;'>".$errLoginExist."</p>");
    // echo("<p> ".$nb_login." result(s) for query : ".$query."</p>");
    $checkOK = FALSE;
  }


  // === at least ONE CHECK FAILED
  if ($checkOK == FALSE){
    return FALSE;
  }


  // insert the data
  $userDataArray = array('Txt_User%Name' => $userLogin, 'Pwd_Password' => $hashPwd, 'Id_Auth' => '1', 'Id_Language' => $userLang, 'Txt_Email' => $userEmail);
  Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_all_users, $userDataArray);


  // -- mail
  $mailContent = str_replace("<<USERLOGIN>>", $userLogin, $mailContent);
  $mailContent = str_replace("<<USERPASSWORD>>", $password, $mailContent);


  // Display message:  
  // echo("<p>Following message has been sent: <br /> $mailContent</p>");
  

  // -- to send an confirmation email in the proper language.
  $mailContent = str_replace("<br />","\r",$mailContent);
  $mailTitle    = "Xsylum";
  $mailFrom     = $_SERVER['HTTP_HOST'];
  $mailBcc      = $_SESSION['AdminMail'];
  $mailReplyTo  = "";
  $mailSentUser = Xsy_Glob_Mail($mailSubject, $mailContent, $mailTitle, $userEmail, $mailFrom, $mailBcc, $mailReplyTo);
  
  
  // -- then display confirmation OK or error
  echo(($mailSentUser) ? $mailConfirm : $mailError);


  return TRUE;
}



/***************************************************
 * Generate a random string for the password
 **************************************************/
function generateRandomString($length){

  $character = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $random_string = "";

  for ($p=0; $p<$length; $p++){
    $random_string .= $character[mt_rand(0,strlen($character))];
  }

  return $random_string;
}


?>