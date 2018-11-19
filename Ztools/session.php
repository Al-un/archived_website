<?php
session_start();
unset($_SESSION['LoginError']);


/** #########################################################################################################
 *  User is logged out
 *  #########################################################################################################
 */
if (isset($_POST['XsySessionLogOut'])){

  // Delete cookie if it is set
  if (isset($_COOKIE['USERNAME'])) {
    setcookie('USERNAME', 0, time() - 10, "/");
  }
  
  
  // remove all data contained in the $_SESSION variable
  session_unset();    # Session_unset and Session_destroy
  // session_destroy();  # Will remove all sessions.
}



/** #########################################################################################################
 *  User is logged in
 *  #########################################################################################################
 */
if (isset($_POST['XsySessionLogIn'])){

  // ============================ GET DATA FROM FORM ===================================== //
  $XsySessLogin   = $_POST['XsySessLogin'];
  $XsySessPwd     = $_POST['XsySessPwd'];
  $XsySha1Login   = sha1($XsySessLogin);
  $XsySessCookie  = isset($_POST['XsySessCookie']) ? $_POST['XsySessCookie'] : FALSE;
  $XsySessLogin   = $XSY_SQL_PDO->quote($XsySessLogin);
  $XsySessPwd     = $XSY_SQL_PDO->quote($XsySessPwd);
  $XsySessPwd     = hash( "sha512", substr($XsySessPwd, 1, -1));
  

  // ============================ All fields are filled ?? =============================== //
  if ( $XsySessLogin != "" && $XsySessPwd != ""){
  
    // ----------------- CHECK IN THE DATABASE ------------------- //
    $query_login = "SELECT `ID_User`, `Txt_User%Name`, `Id_Auth`, `Txt_Email`, `$sqlTable_all_users`.`Id_Language`, `Txt_Lang%Tag`
      FROM `$SQL_DATABASE`.`$sqlTable_all_users`,`$SQL_DATABASE`.`$sqlTable_all_languages`
      WHERE `$sqlTable_all_users`.`Txt_User%Name` = $XsySessLogin
      AND `$sqlTable_all_users`.`Pwd_Password` = '$XsySessPwd'
      AND `$sqlTable_all_users`.`Id_Language` = `$sqlTable_all_languages`.`ID_Language`";

    $stmt_sess = $XSY_SQL_PDO->query($query_login);

    if (!$stmt_sess){
      echo("<p> Problem during login sql query: $query_login </p>");
    }

    // --------------- ONLY ONE RESULT, OK GOT IT ---------------- //
    $nb_result = $stmt_sess->rowCount();
    if ($nb_result == 1){
      // update all session related data
      $userdata               = $stmt_sess->fetch(PDO::FETCH_ASSOC);
      $_SESSION['UserId']     = $userdata['ID_User'];
      $_SESSION['UserName']   = $userdata['Txt_User%Name'];
      $_SESSION['UserLevel']  = $userdata['Id_Auth'];
      $_SESSION['UserAdmin']  = ($userdata['Id_Auth'] == $XSY_SESS_ADMINLEVEL);
      $_SESSION['UserMail']   = $userdata['Txt_Email'];
      $_SESSION['UserLang']   = $userdata['Txt_Lang%Tag'];
      $_SESSION['UserLangId'] = $userdata['Id_Language'];
      // cookie valid for 30 days
      $CookieIsSet = ($XsySessCookie == "remember") ? setcookie("USERNAME", $XsySha1Login, time()+30*24*3600, "/") : "CookieNotRequired";

    }
    else{
      $_SESSION['LoginError'] = "Incorrect Login";
    }
  }
  else{
      $_SESSION['LoginError'] = "A field is missing";
  }

}







/** #########################################################################################################
 *  Default session data
 *  #########################################################################################################
 */


  // Default Language
  if (isset($_GET['UserLang']) OR isset($_POST['UserLang'])){
    $userlanguage = (isset($_POST['UserLang'])) ? $_POST['UserLang'] : $_GET['UserLang'];
    if ($userlanguage == "Fr" || $userlanguage == "En" || $userlanguage == "ZhTr"){ 
        $_SESSION['UserLang'] = $userlanguage;
    }
  }
  
  // ========================   User is already logged   ================================ //
  if (isset($_SESSION['UserName'])) {
   // all $_SESSION variables should be set
  }
  
  // ========================   Cookie has been found   ================================= //
  else if (isset($_COOKIE["USERNAME"])) {
  
    $userName = $_COOKIE["USERNAME"];
    
    $query_session = "SELECT `ID_User`, `Txt_User%Name`,`Txt_Lang%Tag`,`Id_Auth`,`Txt_Email`, `$sqlTable_all_users`.`Id_Language`
      FROM `$SQL_DATABASE`.`$sqlTable_all_users`,`$SQL_DATABASE`.`$sqlTable_all_languages`
      WHERE SHA1(`Txt_User%Name`) = '$userName'
      AND `$sqlTable_all_users`.`Id_language` = `$sqlTable_all_languages`.`Id_Language`";

    $stmt_session = $XSY_SQL_PDO->query($query_session);
    // there should be only one entry so fetchAll is allowed
    $UserData = $stmt_session->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['UserName']   = $UserData[0]['Txt_User%Name'];
    $_SESSION['UserId']     = $UserData[0]['ID_User'];
    $_SESSION['UserLevel']  = $UserData[0]['Id_Auth'];
    $_SESSION['UserAdmin']  = ($UserData[0]['Id_Auth'] >= $XSY_SESS_ADMINLEVEL);
    $_SESSION['UserMail']   = $UserData[0]['Txt_Email'];
    $_SESSION['UserLang']   = $UserData[0]['Txt_Lang%Tag'];
    $_SESSION['UserLangId'] = $UserData[0]['Id_Language'];
  }
  
  // ========================   Default user   =========================================== //
  else{
    $_SESSION['UserName']   = "DefaultUser";
    $_SESSION['UserId']     = 1;
    $_SESSION['UserLevel']  = 1;
    $_SESSION['UserAdmin']  = FALSE;
    $_SESSION['UserMail']   = "";
    $_SESSION['UserLang']   = (isset($_SESSION['UserLang'])) ? $_SESSION['UserLang'] : "Fr";
    $_SESSION['UserLangId'] = (isset($_SESSION['UserLangId'])) ? $_SESSION['UserLangId'] : 1;
  }

  // God Like
  $_SESSION['AdminMail'] = "xsylum@gmail.com";

?>