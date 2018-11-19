<?php
switch($_SESSION['userlang']){

  case "En" :
    $textInfos['Address']     = "Address";
    $textInfos['Phone']       = "Phone";
    $textInfos['Email']       = "Email";
    $textInfos['LargerMap']   = "View Larger Map";
    $textInfos['Metro']       = "Metro";
    $textInfos['OpenedTitle'] = "Opened Time";
    $textInfos['OpenedDesc']  = "";
  break;
  case "Tw" :
    $textInfos['Address']     = "??";
    $textInfos['Phone']       = "??";
    $textInfos['Email']       = "????";
    $textInfos['LargerMap']   = "???????";
    $textInfos['Metro']       = "??";
    $textInfos['OpenedTitle'] = "Opened Time";
    $textInfos['OpenedDesc']  = "";
  break;

  case "Vn" :
    $textInfos['Address']     = "";
    $textInfos['Phone']       = "";
    $textInfos['Email']       = "";
    $textInfos['LargerMap']   = "";
    $textInfos['Metro']       = "";
    $textInfos['OpenedTitle'] = "Opened Time";
    $textInfos['OpenedDesc']  = "";
  break;

  default:
    $textInfos['Address']     = "Adresse";
    $textInfos['Phone']       = "T&eacute;l&eacute;phone";
    $textInfos['Email']       = "E-mail";
    $textInfos['LargerMap']   = "Agrandir le plan";
    $textInfos['Metro']       = "M&eacute;tro";
    $textInfos['OpenedTitle'] = "Horaires d'ouverture";
    $textInfos['OpenedDesc']  = "
  <span style='display:block;'> Du xxx au yyy :</span> <span style='margin-left:10%;'> de 00h00 à 00h00 </span> <br />
  <span style='display:block;'> Du www au zzz :</span> <span style='margin-left:10%;'> de 11h11 à 11h11 </span>";

}
?>