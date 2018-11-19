<?php
$sqlTable_MiscExcel   = "_MiscExcel";
$sqlTable_MiscSync  = "_MiscSync";
// $path_ExcelFiles      = ".\Misc\Excel\\";
// $path_ExcelDescs      = ".\Misc\Excel.Desc\\";
$path_ExcelFiles      = "Misc/Excel/";
$path_ExcelDescs      = "Misc/Excel.Desc/";
$path_Sync            = "Misc/OnlineSync/";

$pathArray[] = $path_ExcelFiles;
$pathArray[] = $path_ExcelDescs;
$pathArray[] = $sqlTable_MiscSync;

$fileArray['Txt_File%Name']['Folder']   = $path_ExcelFiles;
$fileArray['Txt_File%Name']['Part'][0]  = "{Type}";
$fileArray['Txt_File%Name']['Part'][1]  = "{Title}";
$fileArray['Txt_File%Name']['Spliter']  = " - ";
$fileArray['Txt_Excel%Desc']['Folder']  = $path_ExcelDescs;
$fileArray['Txt_Excel%Desc']['Part'][0] = "{Title}";
$fileArray['Txt_Excel%Desc']['Spliter'] = "######";
$syncArray['Txt_File%Name']['Folder']   = $path_Sync;
$mapping['{Type}']  = "Txt_Excel%Type";
$mapping['{Title}'] = "Txt_Excel%Name";

switch($_SESSION['UserLang']){

  case "Fr":
    $noExcel  = "Pas de fichier &agrave; disposition pour le moment.";
    $xlDl     = "T&eacute;l&eacute;charger le fichier s&eacute;lectionn&eacute;";
    $xlSelect = "S&eacute;lectionnez un fichier ci-contre pour afficher la description correspondante.";
    $xlIntro  = "    <p> Voici une liste de fichiers utiles. Que ce soit des macros Excel ou des batch (attention, assurez-vous d'avoir des droits d'administrateur pour les lancer!), cela peut toujours servir. Pour simplifier les choses, les fichiers sont class&eacute;s par cat&eacute;gorie. S&eacute;lectionnez un ficher et vous aurez la description sur la droite. </p>\n    <p> La date entre crochet correspondant &agrave; la date de la derni&egrave;re modification du fichier. </p>\n    <p> Si ce fichier vous convient et que vous avez rempli tous les pr&eacute;requis, vous pouvez le t&eacute;l&eacute;charger en cliquant sur le bouton \"T&eacute;l&eacute;charger\". </p>";
    break;

  case "En":
    $noExcel  = "So far, there is no files here.";
    $xlDl     = "Download selected file";
    $xlSelect = "Select a file to display file's description.";
    $xlIntro  = "    <p> There is a list of useful file that I can use for daily life, personal or professional by the way. To make it easy, files are sorted according to categories. Select one file to have a description on your right.</p>\n    <p> Date between bracket are the last file update date.</p>\n    <p> Then, if this file meets your requirements and you have all prerequisites, download it by hitting the \"Download\" button. Hope it will help as much as these files helped me ^^ </p>";
    break;

  case "Jp":
    $noExcel  = "";
    $xlDl     = "";
    $xlSelect = "";
    $xlIntro  = "<p>  </p>";
    break;

}
?>