<?php
if (isset($_GET['Technical']) AND $_GET['Technical']=="Info"){

  echo("

  <p> Server settings: </p>

  <table border='1' style='margin:auto;margin-bottom: 20px;'>
    <tr> <td> HTTP_HOST </td> <td> ".$_SERVER['HTTP_HOST']." </td> </tr>
  </table>

  <p> Database settings: </p>

  <table border='1' style='margin:auto;margin-bottom: 20px;'>
    <tr> <td> SQL_SERVER </td> <td> $SQL_SERVER </td> </tr>
    <tr> <td> SQL_USER </td> <td> $SQL_USER </td> </tr>
    <tr> <td> SQL_DATABASE </td> <td> $SQL_DATABASE </td> </tr>
  </table>

  <p> Screen settings: </p>

  <table border='1' style='margin:auto;margin-bottom: 20px;'>
        <tr> <td> Screen height </td> <td id='Screen_Height'>  </td> </tr>
        <tr> <td> Screen width  </td> <td id='Screen_Width'>  </td> </tr>
        <tr> <td> Top Banner height </td> <td id='Top_Banner_Height'>  </td> </tr>
        <tr> <td> Available height </td> <td id='Available_Height'>  </td> </tr>
  </table>
  ");

}
?>