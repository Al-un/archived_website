<?php

echo("
<p> Current settings are </p>

<table border='1' style='margin:auto;'>
  <tr> <td> HTTP_HOST </td> <td> ".$_SERVER['HTTP_HOST']." </td> </tr>
  <tr> <td> "."$"."website </td> <td> $website </td> </tr>
</table>

<table border='1' style='margin:auto;'>
  <tr> <td> SQL_SERVER </td> <td> $SQL_SERVER </td> </tr>
  <tr> <td> SQL_USER </td> <td> $SQL_USER </td> </tr>
  <tr> <td> SQL_DATABASE </td> <td> $SQL_DATABASE </td> </tr>
</table>

<table border='1' style='margin:auto;'>
  <tr> <td> User ID </td> <td> ".$_SESSION['UserId']." </td> </tr>
  <tr> <td> User Name </td> <td> ".$_SESSION['UserName']." </td> </tr>
  <tr> <td> User Level </td> <td> ".Xsy_Sql_DisplayFieldValue('Id_Auth', $_SESSION['UserLevel'],'Display')."  </td> </tr>
  <tr> <td> User Margin </td> <td> ".$_SESSION['UserMail']."  </td> </tr>
  <tr> <td> User Lang </td> <td> ".$_SESSION['UserLang']."  </td> </tr>
  <tr> <td> User Lang ID </td> <td> ".$_SESSION['UserLangId']."  </td> </tr>
</table>");

?>