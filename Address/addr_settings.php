<?php

// ================================================================================ // 
// ==================================== SQL TABLES ================================ //
// ================================================================================ // 
  $sqlTable_AddrArea          = "_AddrArea";
  $sqlTable_AddrCate          = "_AddrCate";
  $sqlTable_AddrItem          = "_AddrItem";
  $sqlTable_AddrItemCate      = "_AddrItemCate";
  $sqlTable_AddrItemArea      = "_AddrItemArea";
  $sqlTable_AddrTranslate     = "_AddrTranslate";

  // $addrCateLevel[0]['Value']           = "AddrType";
  // $addrCateLevel[1]['Value']           = "AddrCate";
  // $addrCateLevel[2]['Value']           = "AddrSubCate";
  // $addrCityLevel[0]['Value']           = "AddrCountry";
  // $addrCityLevel[1]['Value']           = "AddrArea";
  // $addrCityLevel[2]['Value']           = "AddrCity";
  // $addrCateLevel[0]['Field']           = "Int_AddrType";
  // $addrCateLevel[1]['Field']           = "Int_AddrCate";
  // $addrCateLevel[2]['Field']           = "Int_AddrSubCate";
  // $addrCityLevel[0]['Field']           = "Int_AddrCountry";
  // $addrCityLevel[1]['Field']           = "Int_AddrArea";
  // $addrCityLevel[2]['Field']           = "Int_AddrCity";

// ================================================================================ // 
// ==================================  LANGUAGES  ================================= //
// ================================================================================ // 

  switch($_SESSION['UserLang']) {
    case "Fr" : 
      $welcomeMsg     = "<p>Quoi ? vous n'êtes pas encore allé chercher des adresses ? Bougez-vous en sélectionner soit une catégorie (à gauche) ou une zone (à droite). Amusez-vous bien.</p>";
      $title          = "Manger, boire et le reste";
      $changeAddrType = "Choisir le type d'adresse";
      $CateChose      = "Type d'adresse:";
      $PaysChose      = "Pays choisi:";
      $VilleChose     = "Ville choisie";
    break;

    case "En" :
      $welcomeMsg     = "<p> What are you doing ? Hurry up and select either a category (on your left) either a location (on your right). Enjoy !</p>";
      $title          = "Eat, drink and whatevery";
      $changeAddrType = "Change Address type!";
      $CateChose      = "Address Type:";
      $PaysChose      = "Selected country:";
      $VilleChose     = "Selected city";
    break;

    case "ZhTr" :
      $welcomeMsg     = "<p>  </p>";
      $title          = "吃，喝，等等";
      $changeAddrType = "選 地址型";
      $CateChose      = "地址型 :";
      $PaysChose      = "國家 :";
      $VilleChose     = "市 :";
    break;

    default : $title = "MiamAndGlou, invalid lang:".$_SESSION['UserLang'];
  }
  
?>