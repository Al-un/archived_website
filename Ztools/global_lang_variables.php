<?php
// ========================================================================================
// Retrieve all languages
// ========================================================================================
$query_lang = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_all_languages`";
$array_lang = Xsy_Sql_FetchAll($query_lang);
foreach($array_lang as $key=>$array_langEntry){
  $langId = $array_langEntry['ID_Language'];
  $XSY_LANG[$langId]['Name']  = $array_langEntry['Txt_Lang%Name'];
  $XSY_LANG[$langId]['Tag']   = $array_langEntry['Txt_Lang%Tag'];
  $XSY_LANG[$langId]['Flag']  = $array_langEntry['Txt_Lang%Flag'];
}
// ========================================================================================
// Retrieve all authorizations
// ========================================================================================
$query_auth = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_all_auths`";
$array_auth = Xsy_Sql_FetchAll($query_auth);
foreach($array_auth as $key=>$array_authEntry){
  $authId = $array_authEntry['ID_Auth'];
  $XSY_AUTH[$authId]['Name']  = $array_authEntry['Txt_Auth%Name'];
}


// ========================================================================================
// Global variables
// ========================================================================================
switch($_SESSION['UserLang']){

  case "Fr" :
    $XSY_SESS_NO_AUTH_ERRORTXT    = "Désolé, vous n'êtes pas autorisé(e) à afficher le contenu de cette page.";
    $XSY_SQL_TABLE_IS_EMPTY       = "La table est vide. Veuillez ajouter une entr&eacute;e";
    break;

  case "En" :
    $XSY_SESS_NO_AUTH_ERRORTXT    = "You have no authorization to display this page content.";
    $XSY_SQL_TABLE_IS_EMPTY       = "Table is empty, please add an entry.";
    break;

  case "ZhTr" :
    $XSY_SESS_NO_AUTH_ERRORTXT    = "";
    $XSY_SQL_TABLE_IS_EMPTY       = "";
    break;

  case "Jp" :
    $XSY_SESS_NO_AUTH_ERRORTXT    = "";
    $XSY_SQL_TABLE_IS_EMPTY       = "";
    break;

}

?>