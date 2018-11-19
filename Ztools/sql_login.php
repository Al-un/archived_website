<?php

/* #####################################################################################################
 *  - SQL Logins and SQL connection
 * #####################################################################################################
 */


// 1°) user UTF-8 charset
// 2°) maintain persistent PDO connection
$SQL_OPTIONS = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_PERSISTENT => TRUE);
// $SQL_OPTIONS = array(PDO::ATTR_PERSISTENT => TRUE);




// define PDO connection
try{
  $XSY_SQL_PDO = new PDO('mysql:host='.$SQL_SERVER.';dbname='.$SQL_DATABASE, $SQL_USER, $SQL_PASSWORD, $SQL_OPTIONS);
  // $SQL_PDO->beginTransaction();
}
catch(PDOException $excep){
  // no admin check because $_SESSION is not set yet
  echo("<p> Error in PDO initialization: <br />".$excep->getMessage()."</p>\n
  <table border='1'>
    <tr> <td> HTTP HOST </td> <td> ".$_SERVER['HTTP_HOST']." </td> </tr>\n
    <tr> <td> Website </td> <td> $website </td> </tr>\n
    <tr> <td> Server </td> <td> $SQL_SERVER </td> </tr>\n
    <tr> <td> Database </td> <td> $SQL_DATABASE </td> </tr>\n
    <tr> <td> User </td> <td> $SQL_USER </td> </tr>\n
    <tr> <td> Options </td> <td> $SQL_OPTIONS </td> </tr>\n
  </table>
");
}





date_default_timezone_set('Europe/Paris');

?>