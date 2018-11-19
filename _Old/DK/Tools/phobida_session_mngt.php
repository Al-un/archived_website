<?php
  session_start();
  
  if (isset($_POST['LogoutSubmit'])) {
    // ============================ DESTROY EVERYTHING ============================ //
    session_unset();     #Session_unset and Session_destroy
    session_destroy();  #Will remove all sessions.
  }
  
  // current language. French is chosen by default
  //  Fr  = French
  //  En  = English
  //  Tw= Traditional Chinese (Taiwan, Hong Kong, Macau)
  //  Zh  = Simplified Chinese (China)
  //  Vn  = Vietnamese
  $_SESSION['userlang']    = ( isset($_SESSION['userlang']) )? $_SESSION['userlang'] :  "Fr";
  $_SESSION['userlang']    = ( isset($_GET['userlang'])   )  ? $_GET['userlang']     :  $_SESSION['userlang'];
  $_SESSION['userlang']    = ( isset($_POST['userlang'])  )  ? $_POST['userlang']    :  $_SESSION['userlang'];
  
  
  $_SESSION['useradmin']  = ( isset($_SESSION['useradmin']) ) ? $_SESSION['useradmin'] : FALSE;
  // if (isset($adminRequired) and $adminRequired and ($_SESSION['useradmin'] == FALSE)){
    // header('Location: index.php');
  // }
  
  
   /*
  // ======================================================================================== //
  // >>>>>>>>>>>>>>>>>>>>>>            HTTP Authentication
  // ======================================================================================== //
  
  // set if it is first administration connection
  $sql_query    = sql_query("SHOW TABLES LIKE '".$sqlPho_UserAccount."'");
  $sql_count    = mysql_num_rows($sql_query);
  $firstAdminConnect  = ($sql_count == 1) ? FALSE : TRUE;
  $firstAdmin   = ($firstAdminConnect) ? "First Administration, super user is for the moment allowed" : "User Account already created, super user is not allowed";
  
 
  // page requires admin authorization
  if (isset($adminRequired) and $adminRequired and ($_SESSION['useradmin'] == FALSE)){
  
    // not yet connected, popup login form
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
      $plop = (isset($_SERVER['PHP_AUTH_PW'])) ? $_SERVER['PHP_AUTH_PW'] : "no pwd";
      header('WWW-Authenticate: Basic realm="Pho Admin: '.$firstAdmin.' -- First Try -- '.$plop);
      header('HTTP/1.1 401 Unauthorized');
      // die('Priv&eacute; de Pho !');
    }
    
    // login form has been submitted
    else{
    
      // retrive login data
      $auth_user  = $_SERVER['PHP_AUTH_USER'];
      $auth_pw    = sha1($_SERVER['PHP_AUTH_PW']);
      $auth_check = sql_query("SELECT * FROM `$SQL_DATABASE`.`$sqlPho_UserAccount` WHERE `Login`='$auth_user' and `Pwd_Password`='$auth_pw'");
      
      // first connection? if yes, allow DK super user, if not need to check into the table
      if ($firstAdminConnect and $auth_user == "dk" and $auth_pw == "2c8a4ef59b059c720dd5a46b45a729c832914b52"){
        $_SESSION['useradmin'] = TRUE;
        $_SESSION['userlogin'] = "DK Super User";
      }
      elseif (mysql_num_rows($auth_check) > 0){
        $_SESSION['useradmin'] = TRUE;
        $_SESSION['userlogin'] = $auth_user;
      }
      else{
        $_SESSION['useradmin'] = FALSE;
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Pho Admin: '.$firstAdmin.'--'.$auth_pw.'--'.$firstAdminConnect);
      }
    }
  }
  */

?>