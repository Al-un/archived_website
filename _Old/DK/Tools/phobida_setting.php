<?php
  // ======================================================================================== //
  // >>>>>>>>>>>>>>>>>>>>>>            Url change and setting
  // ======================================================================================== //


// Define SQL tables
$sqlPho_UserAccount   = "Phobida_UserAccount";
$sqlPho_MenuItem      = "Phobida_MenuItem";
$sqlPho_MenuRating    = "Phobida_MenuRating";
$sqlPho_MenuCate      = "Phobida_MenuCate";
$sqlPho_MenuCateItem  = "Phobida_MenuCateItem";
$sqlPho_Photo         = "Phobida_Photo";


// 
if ($_SERVER['HTTP_HOST'] == "phobida.com"){
  $urlRoot    = "/";
}
else{
  $urlRoot    = "/DK/";
}
$urlHome    = $urlRoot;
$urlPho     = $urlRoot."Pho/";
$urlInfo    = $urlRoot."Info/";
$urlMenu    = $urlRoot."Menu/";
$urlPhoto   = $urlRoot."Photo/";
$urlAdmin   = $urlRoot."Admin/";
$urlSqlMngt           = $urlRoot."Admin/?TableDesign=Admin";
$urlSqlMenuItem       = $urlRoot."Admin/?TableManaged=".$sqlPho_MenuItem;
$urlSqlMenuCate       = $urlRoot."Admin/?TableManaged=".$sqlPho_MenuCate;
$urlSqlMenuRating     = $urlRoot."Admin/?TableManaged=".$sqlPho_MenuRating;
$urlSqlMenuCateItem   = $urlRoot."Admin/?TableManaged=".$sqlPho_MenuCateItem;
$urlSqlPhoto          = $urlRoot."Admin/?TableManaged=".$sqlPho_Photo;
$urlSqlUserAccount    = $urlRoot."Admin/?TableManaged=".$sqlPho_UserAccount;
$urlSqlDirectSql      = $urlRoot."Admin/?SqlInput=Direct";
$urlTechnicalInfo     = $urlRoot."Admin/?Technical=Info";
$urlPhoMngtMenu       = $urlRoot."Admin/?PhoMngt=Menu";
$urlPhoMngtPhoto      = $urlRoot."Admin/?PhoMngt=Photo";


  // multilanguage website  => which language is enabled?
$lang['Fr'] = TRUE;
$lang['En'] = FALSE;
$lang['Tw'] = FALSE;
$lang['Vn'] = FALSE;




  // ======================================================================================== //
  // >>>>>>>>>>>>>>>>>>>>>>            Switch language
  // ======================================================================================== //

switch($_SESSION['userlang']){
  
  // English
  case "En" :
    $contentHome    = "Home";
    $contentPho     = "About";
    $contentInfo    = "Useful Info";
    $contentMenu    = "Menu";
    $contentPhoto   = "Photos";
    $contentAdmin   = "Admin";
    $contentSqlMngt         = "SQL Table Management";
    $contentSqlDirectSql    = "SQL Direct Input";
    $contentSqlUserAccount  = "User Accounts";
    $contentTechnicalInfo   = "Technical Info";
    $contentPhoMngtMenu     = "Menu Content";
    $contentPhoMngtPhoto    = "Photo Content";
    break;
  
  // Traditional Chinese
  case "Tw" :
    $contentHome    = "首頁";
    $contentPho     = "";
    $contentInfo    = "信息";
    $contentMenu    = "菜單";
    $contentPhoto   = "照片";
    $contentAdmin   = "Admin";
    $contentSqlMngt         = "SQL Table Management";        // Administration is in English
    $contentSqlDirectSql    = "SQL Direct Input";
    $contentSqlUserAccount  = "User Accounts";
    $contentTechnicalInfo   = "Technical Info";
    $contentPhoMngtMenu     = "Menu Content";
    $contentPhoMngtPhoto    = "Photo Content";
    break;
    
   // Vietnamese
  case "Vn":
    $contentHome    = "--";
    $contentPho     = "";
    $contentInfo    = "--";  
    $contentMenu    = "";
    $contentPhoto   = "";
    $contentAdmin   = "Admin";
    $contentSqlMngt         = "SQL Table Management";        // Administration is in English
    $contentSqlDirectSql    = "SQL Direct Input";
    $contentSqlUserAccount  = "User Accounts";
    $contentTechnicalInfo   = "Technical Info";
    $contentPhoMngtMenu     = "Menu Content";
    $contentPhoMngtPhoto    = "Photo Content";
    break;
  
  // French is default language
  default ;
    $contentHome    = "Accueil";
    $contentPho     = "&Agrave; propos";
    $contentInfo    = "Informations Pratiques";
    $contentMenu    = "Menu";
    $contentPhoto   = "Photos";
    $contentAdmin   = "Admin";
    $contentSqlMngt         = "SQL Tables";
    $contentSqlDirectSql    = "SQL Direct Input";
    $contentSqlUserAccount  = "Comptes utilisateurs";
    $contentTechnicalInfo   = "Infos Techniques";
    $contentPhoMngtMenu     = "Gérer le menu";
    $contentPhoMngtPhoto    = "Gérer les photos";
}

?>