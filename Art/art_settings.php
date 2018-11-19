<?php
/* SQL stuff */
$sqlTable_ArtItem       = "_ArtItem";
$sqlTable_ArtTag        = "_ArtTag";
$sqlTable_ArtItemTag    = "_ArtItemTag";
$sqlTable_ArtTranslate  = "_ArtTranslate";
$sqlTable_ArtComment    = "_ArtComment";
$sqlTable_ArtProp       = "_ArtProp";

/* no hardcoded folder path */
$path_DrawingArt        = "ArtZone/Art.Dessin/";
$path_DrawingOrig       = "ArtZone/Art.Dessin.Orig/";
$path_DrawingDesc       = "ArtZone/Art.Dessin.Desc/";
$path_DrawingMisc       = "ArtZone/Art.Dessin.Misc/";
$path_TextArt           = "";
$path_TextDesc          = "";


$drawingPathArray[]     = $path_DrawingArt;
$drawingPathArray[]     = $path_DrawingOrig;
$drawingPathArray[]     = $path_DrawingDesc;
$drawingPathArray[]     = $path_DrawingMisc;
$textPathArray[]        = $path_TextArt;
$textPathArray[]        = $path_TextDesc;

$drawingFileArray['Txt_File%Art']['Folder']   = $path_DrawingArt;
$drawingFileArray['Txt_File%Art']['Part'][0]  = "{Date}";
$drawingFileArray['Txt_File%Art']['Part'][1]  = "{Title}";
$drawingFileArray['Txt_File%Art']['Spliter']  = " ";
$drawingFileArray['Txt_File%Desc']['Folder']  = $path_DrawingDesc;
$drawingFileArray['Txt_File%Desc']['Part'][0] = "{Date}";
$drawingFileArray['Txt_File%Desc']['Part'][1] = "{Title}";
$drawingFileArray['Txt_File%Desc']['Spliter'] = " - ";
$drawingFileArray['Txt_File%Orig']['Folder']  = $path_DrawingOrig;
$drawingFileArray['Txt_File%Orig']['Part'][0] = "{Date}";
$drawingFileArray['Txt_File%Orig']['Part'][1] = "{Title}";
$drawingFileArray['Txt_File%Orig']['Part'][2] = "original";
$drawingFileArray['Txt_File%Orig']['Spliter'] = " - ";
$drawingMiscArray['Txt_File%Misc']['Folder']  = $path_DrawingMisc;
$drawingMiscArray['Txt_File%Misc']['Part'][0] = "{Date}";
$drawingMiscArray['Txt_File%Misc']['Part'][1] = "{Title}";
$drawingMiscArray['Txt_File%Misc']['Part'][2] = "";
$drawingMiscArray['Txt_File%Misc']['Spliter'] = " - ";
$drawingMapping['{Title}']  = "Txt_Art%Name";
$drawingMapping['{Date}']   = "Dat_Date";
// $drawingMapping['{Auth}']   = "Id_Auth";

// number of picture per row for the Art List
$nb_img_row           = 4;

// start of translation
$textContactFormIntro   = "Feel free to contact me through the following form";
$textContactFormName    = "You aren't John Doe, are you ?'";
$textContactFormEmail   = "Email: where can I contact you back ?";
$textContactFormText    = "What do you want to tell me?";

?>
