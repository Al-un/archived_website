<?php
$sqlTable_PassLevel   = "_PassLevel";
$sqlTable_PassCate    = "_PassCate";
$sqlTable_PassSite    = "_PassSite";

$conditionArray['WHERE']['Id_User']         = $_SESSION['UserId'];
$conditionArray['Constant']['Id_User']      = $_SESSION['UserId'];

$cateSelectedField[]['FieldName'] = "Txt_Cate%Name";
$cateSelectedField[]['FieldName'] = "Int_Cate%Order";
$cateSelectedField[]['FieldName'] = "Bool_Active";
$lvlSelectedField[]['FieldName'] = "Int_Level%Order";
$lvlSelectedField[]['FieldName'] = "Txt_Level%Name";
$lvlSelectedField[]['FieldName'] = "Txt_Level%Memo";
$lvlSelectedField[]['FieldName'] = "Bool_Active";

switch($_SESSION['UserLang']){

  case "Fr":

    $passAdd  = "Ajouter un pass";
    $passCate = "Mes cat&eacute;gories";
    $passLvl  = "Mes niveaux";
    $noPass   = "<p> Aucun pass n'existe actuellement. Vous pouvez en cr&eacute;er un en cliquant sur \"Ajouter un pass\". Assurez-vous d'avoir des cat&eacute;gories et des niveaux avant ! </p>";

    // comment line if you want the default value
    $cateTextArray['DispPage']['AddEntry'] = "Ajouter un entr&eacute;e";
    $cateTextArray['DispPage']['UpdEntry'] = "Modifier";
    $cateTextArray['DispPage']['DelEntry'] = "Supprimer";
    $cateTextArray['DispItem']['AddEntry'] = "Ajouter";
    $cateTextArray['DispItem']['UpdEntry'] = "Modifier";
    $cateTextArray['DispItem']['Cancel']   = "Annuler";
    // $cateTextArray['DispItem']['IntroAdd'] = "";
    // $cateTextArray['DispItem']['IntroUpd'] = "";
    // $cateTextArray['DispItem']['IntroDis'] = "";
    // $cateTextArray['SqlItem']['AddOk'] = "";
    // $cateTextArray['SqlItem']['AddErr'] = "";
    // $cateTextArray['SqlItem']['UpdOk'] = "";
    // $cateTextArray['SqlItem']['UpdErr'] = "";
    // $cateTextArray['SqlItem']['DelOk'] = "";
    // $cateTextArray['SqlItem']['DelErr'] = "";
    break;

  case "En":

    $passAdd  = "Add a pass";
    $passCate = "My categories";
    $passLvl  = "My levels";
    $noPass   = "<p> No pass exists. You can create one by hitting the \"Add a pass\" button on the top. Before, make sure that you have some categories and levels. </p>";
    // comment line if you want the default value
    $cateTextArray['DispPage']['AddEntry'] = "Add Entry";
    $cateTextArray['DispPage']['UpdEntry'] = "Update";
    $cateTextArray['DispPage']['DelEntry'] = "Delete";
    $cateTextArray['DispItem']['AddEntry'] = "Add";
    $cateTextArray['DispItem']['UpdEntry'] = "Update";
    $cateTextArray['DispItem']['Cancel']   = "Cancel";
    // $cateTextArray['DispItem']['IntroAdd'] = "";
    // $cateTextArray['DispItem']['IntroUpd'] = "";
    // $cateTextArray['DispItem']['IntroDis'] = "";
    // $cateTextArray['SqlItem']['AddOk'] = "";
    // $cateTextArray['SqlItem']['AddErr'] = "";
    // $cateTextArray['SqlItem']['UpdOk'] = "";
    // $cateTextArray['SqlItem']['UpdErr'] = "";
    // $cateTextArray['SqlItem']['DelOk'] = "";
    // $cateTextArray['SqlItem']['DelErr'] = "";
    break;

}
?>