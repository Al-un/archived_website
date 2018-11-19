<?php
$sqlTable_memocontent   = "_MemoContent";
$sqlTable_memocate      = "_MemoCate";
$sqlTable_memostatus    = "_MemoStatus";
$sqlTable_memoshareuser = "_MemoShareUser";

$XSY_NOTE_SHARE_DIS = 1;
$XSY_NOTE_SHARE_UPD = 2;
$XSY_NOTE_SHARE_OWN = 3;

switch ($_SESSION['UserLang']){

  case "Fr" :
    $XSY_SESS_NO_AUTH_ERRORTXT = "<p> !!! Vous n'avez pas l'autorisation d'afficher cette page. Pour continuer, veuillez cr&eacute;er en cliquant sur <span style='font-variant:small-caps;'>\"<b>Cr&eacute;er un compte</b>\"</span> &agrave; droite. !!! </p>";

    $summaryHome  = "Accueil";
    $summaryMemo  = "Ajouter un mémo";
    $summaryCate  = "G&eacute;rer les cat&eacute;gories";
    $summaryStat  = "G&eacute;rer les statuts";
    $sortCate     = "Trier par cat&eacute;gorie";
    $sortStatus   = "Trier par statut";

    $cateTextArray['DispPage']['IntroTxt'] = "Vous pouvez g&eacute;rer ici vos cat&eacute;gories ou statuts personnels.";
    $cateTextArray['DispPage']['AddEntry'] = "Ajouter une entr&eacute;e";
    $cateTextArray['DispPage']['UpdEntry'] = "Mettre &agrave; jour";
    $cateTextArray['DispPage']['DelEntry'] = "Supprimer";
    $cateTextArray['DispItem']['AddEntry'] = "Ajouter";
    $cateTextArray['DispItem']['UpdEntry'] = "Modifier";
    $cateTextArray['DispItem']['Cancel']   = "Annuler, retour &agrave; la liste";
    $cateTextArray['DispItem']['IntroAdd'] = "Ajouter une entr&eacute;e en saissant un nom de cat&eacute;gorie ou de statut";
    $cateTextArray['DispItem']['IntroUpd'] = "Modifier le nom de la cat&eacute;gorie ou du statut";
    // $cateTextArray['DispItem']['IntroDis'] = "";
    // $cateTextArray['SqlItem']['AddOk'] = "";
    // $cateTextArray['SqlItem']['AddErr'] = "";
    // $cateTextArray['SqlItem']['UpdOk'] = "";
    // $cateTextArray['SqlItem']['UpdErr'] = "";
    // $cateTextArray['SqlItem']['DelOk'] = "";
    // $cateTextArray['SqlItem']['DelErr'] = "";
    break;

  case "En" :
    $XSY_SESS_NO_AUTH_ERRORTXT = "<p> !!! You don't have any authorization to display this page. Please create an account via the <span style='font-variant:small-caps;'>\"<b>Register</b>\"</span> button on your right. !!! </p>";

    $summaryHome  = "Home";
    $summaryMemo  = "Add a memo";
    $summaryCate  = "Manage categories";
    $summaryStat  = "Manage status";
    $sortCate     = "Sort by Categories";
    $sortStatus   = "Sort by Status";

    $cateTextArray['DispPage']['IntroTxt'] = "You can manage here your personal categories and status";
    $cateTextArray['DispPage']['AddEntry'] = "Add Entry";
    $cateTextArray['DispPage']['UpdEntry'] = "Update";
    $cateTextArray['DispPage']['DelEntry'] = "Delete";
    $cateTextArray['DispItem']['AddEntry'] = "Add";
    $cateTextArray['DispItem']['UpdEntry'] = "Update";
    $cateTextArray['DispItem']['Cancel']   = "Cancel, back to list";
    $cateTextArray['DispItem']['IntroAdd'] = "Add an entry by entering a category or status name";
    $cateTextArray['DispItem']['IntroUpd'] = "Update category or status name";
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