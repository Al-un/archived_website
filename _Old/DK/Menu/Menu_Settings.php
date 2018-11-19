<?php
switch($_SESSION['userlang']){

  case "En": 
    $MenuPdf  = "PDF Version";
  break;

  case "Tw":
    $MenuPdf  = "(pdf)";
  break;

  case "Vn":
    $MenuPdf  = "(pdf)";
  break;

  default:
    $MenuPdf  = "Version PDF";

}
?>