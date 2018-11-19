<?php
switch($_SESSION['userlang']){

  case "En": 
    $pho_about    = "About";
  break;

  case "Tw":
    $pho_about    = "";
  break;

  case "Vn":
    $pho_about    = "";
  break;

  default:
    $pho_about    = "&Agrave; propos";
}
?>