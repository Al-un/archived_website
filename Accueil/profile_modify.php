<?php
switch($_SESSION['UserLang']) {

  case "Fr" :
  $UpdProfOk      = "<p>Profil correctement modifi&eacute;</p>";
  $UpdProfErr     = "<p style='color:red;'>Erreur lors de la modification du profil.</p>";
  $UpdProfChange  = "Mettre &agrave; jour";
  $UpdPassErrOld  = "<p style='color:red;'>Ancien mot de passe incorrect.</p>";
  $UpdPassErrNew  = "<p style='color:red;'>Les deux nouveaux mots de passe ne concordent pas.</p>";
  $UpdPassOk      = "<p>Mot de passe correctement mis &agrave; jour.</p>";
  $UpdPassOld     = "Ancien mot de passe";
  $UpdPassNew     = "Nouveau mot de passe";
  $UpdPassConfirm = "Confirmez le mot de passe";
  $UpdPassChange  = "Changer le mot de passe";
    break;
  case "En" :
  $UpdProfOk      = "<p>Profile properly updated</p>";
  $UpdProfErr     = "<p style='color:red;'>Error when modifying the profile.</p>";
  $UpdProfChange  = "Update profile";
  $UpdPassErrOld  = "<p style='color:red;'>Invalid old password. Try Again!</p>";
  $UpdPassErrNew  = "<p style='color:red;'>The new password don't match. Try Again!</p>";
  $UpdPassOk      = "<p>Password updated.</p>";
  $UpdPassOld     = "Old Password";
  $UpdPassNew     = "New Password";
  $UpdPassConfirm = "Confirm New Password";
  $UpdPassChange  = "Change Password";
    break;
  case "ZhTr" :
  $UpdProfOk      = "";
  $UpdProfErr     = "";
  $UpdProfChange  = "";
  $UpdPassErrOld  = "";
  $UpdPassErrNew  = "";
  $UpdPassOk      = "";
  $UpdPassOld     = "";
  $UpdPassNew     = "";
  $UpdPassConfirm = "";
  $UpdPassChange  = "";
    break;

}  


// =========================================================================================================
// ---------    PHP Processing
// =========================================================================================================

// ======================================= MODIFY USER ITEM ================================== //

if (isset($_POST['XsyUpdProfile'])) {

  if(XsySqlModifyEntry($SQL_DATABASE, $sqlTable_all_users)){
    $_SESSION['UserName'] = Xsy_Glob_Get('Txt_User%Name');
    echo("<p>$UpdProfOk</p>");
  }
  else{
    echo("<p>$UpdProfErr</p>");
  }

}

// ======================================= MODIFY USER PASSWORD ================================== //
else if(isset($_POST['XsyUpdPassword'])) {

  $oldPwd  = Xsy_Glob_Get('XsyPwdOld');
  $oldPwd  = hash( "sha512", $oldPwd);
  $newPwd1 = Xsy_Glob_Get('XsyPwdNew1');
  $newPwd2 = Xsy_Glob_Get('XsyPwdNew2');

  $query_pwd = "SELECT `Pwd_Password` FROM `$SQL_DATABASE`.`$sqlTable_all_users` WHERE `ID_User` = '".$_SESSION['UserId']."' AND `Pwd_Password`='".$oldPwd."'";
  $stmt_pwd = Xsy_Sql_Query($query_pwd);

  // Wrong password?
  if (Xsy_Sql_RowCount($stmt_pwd) == 0) {
    echo($UpdPassErrOld);
  }
  // else, old password is correct, need to check the two new ones
  else{
    if ($newPwd1 == $newPwd2 && $newPwd1 != ""){
      $updPassArray['Pwd_Password'] = hash( "sha512", $newPwd1);
      $updPassStatus = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_all_users, $updPassArray, $_SESSION['UserId']);
      if($updPassStatus){
        echo($UpdPassOk);
      }
      else{
        echo($UpdPassErrNew);
      }
    }
    else{
      echo($UpdPassErrNew);
    }
  }


}



// =========================================================================================================
// ---------    User Data form and change password form
// =========================================================================================================


// -- user master data
$userData = Xsy_Sql_FetchAll("
    SELECT `Txt_User%Name`, `Txt_First%Name`, `Txt_Last%Name`, `Id_Language`, `Txt_Email`
    FROM `$SQL_DATABASE`.`$sqlTable_all_users`
    WHERE `ID_User` = '".$_SESSION['UserId']."'");

$updProfForm = " <form method='post' action=''>\n";
$updProfForm .= " <table>\n";
$updProfForm .= " <input type='hidden' name='ID_User' value='".$_SESSION['UserId']."' />\n";

foreach($userData[0] as $fieldName => $fieldValue){
  $updProfForm .= "  <tr> <td>".Xsy_Sql_DisplayFieldName($fieldName)."</td> <td>".Xsy_Sql_DisplayFieldValue($fieldName, $fieldValue, 'Update')."</td> </tr>\n";
}

$updProfForm .= "  <tr> <td colspan=2> <input type='submit' name='XsyUpdProfile' value='$UpdProfChange' class='button' /> </td> </tr>\n";
$updProfForm .= " </table>\n";
$updProfForm .= " </form>\n";



// -- user password

$updPassForm = " <form method='post' action=''>
  <table>
    <tr> <td> $UpdPassOld </td>      <td> <input type='password' name='XsyPwdOld' size='value' /> </td>                </tr>
    <tr> <td> $UpdPassNew </td>      <td> <input type='password' name='XsyPwdNew1' size='value' maxlength='16'/> </td> </tr>
    <tr> <td> $UpdPassConfirm </td>  <td> <input type='password' name='XsyPwdNew2' size='value' maxlength='16'/> </td> </tr>
    <tr> <td colspan=2> <input type='submit' name='XsyUpdPassword' value='$UpdPassChange' class='button'  /> </td>                                </tr>
  </table>
 <form>";


// =========================================================================================================
// ---------    DISPLAY
// =========================================================================================================

echo("

<div class = 'register'>
$updProfForm
</div> <!-- class = 'register' -->

<div class = 'register'>
$updPassForm
</div> <!-- class = 'register' -->
");


?>