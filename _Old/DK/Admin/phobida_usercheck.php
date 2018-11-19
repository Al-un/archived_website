<?php

// first admin login?
  $sql_query    = Xsy_Sql_Query("SHOW TABLES LIKE '".$sqlPho_UserAccount."'");
  $sql_count    = Xsy_Sql_RowCount($sql_query);
  $firstAdminConnect  = ($sql_count == 1) ? FALSE : TRUE;

// First Login attempt?
  if (isset($_POST['PhoLoginSubmit'])){
    
    // retrieve login data
    $auth_user  = $firstAdminConnect ? sha1(Xsy_Glob_Get('PhoLogin')) : Xsy_Glob_Get('PhoLogin');
    $auth_pw    = sha1(Xsy_Glob_Get('PhoPw'));
    $auth_check = Xsy_Sql_Query("SELECT * FROM `$SQL_DATABASE`.`$sqlPho_UserAccount` WHERE `Txt_Login`='$auth_user' and `Txt_Password`='$auth_pw'");
    // echo("SELECT * FROM `$SQL_DATABASE`.`$sqlPho_UserAccount` WHERE `Login`='$auth_user' and `Txt_Password`='$auth_pw'");

    if ($firstAdminConnect and $auth_user == "64faf5d0b1dc311fd0f94af64f6c296a03045571" and $auth_pw == "06e675f91c421183750a1faee6812061ff8a55ec"){
      $_SESSION['useradmin'] = TRUE;
      $_SESSION['userlogin'] = "Plop Super User";
    }
    elseif (Xsy_Sql_RowCount($auth_check) > 0){
      $_SESSION['useradmin'] = TRUE;
      $_SESSION['userlogin'] = $auth_user;
    }
    else{
      $_SESSION['useradmin'] = FALSE;
    }
  }

// Login Form
$LoginForm = "
  <form method='post' action=''>
    <table style='margin:auto;'>
     <tr> <td> Login </td> <td> <input type='text' name='PhoLogin' size='30' /> </td> </tr>
     <tr> <td> Password </td> <td> <input type='password' name='PhoPw' size='30' /> </td> </tr>
     <tr> <td colspan='2' style='text-align:center;'> <input type='submit' name='PhoLoginSubmit' value='Log In' style='width:80%;' /> </td> </tr>
    </table>
  </form>
";


$loginWelcome  = "<p>Welcome ".(isset($_SESSION['userlogin']) ? $_SESSION['userlogin'] : "<i>no user defined</i>") ."</p>";
$loginNotAdmin = "<p>Administrator only: you are not authorized to display this page</p>".$LoginForm;

?>