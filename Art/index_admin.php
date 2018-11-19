<?php
include_once("art_header.php");
if (Xsy_Glob_AuthCheck("XsyArt", $XSY_SESS_ADMINLEVEL)){

  echo("
  <div class='ArtAdminSummary'>
  <ul class='ArtAdminSummary'>
    <li> SQL tables </li>
    <li> <a href='index_admin.php?sqlTable=$sqlTable_ArtItem'> $sqlTable_ArtItem </a> </li>
    <li> <a href='index_admin.php?sqlTable=$sqlTable_ArtItemTag'> $sqlTable_ArtItemTag </a> </li>
    <li> <a href='index_admin.php?sqlTable=$sqlTable_ArtProp'> $sqlTable_ArtProp </a> </li>
    <li> <a href='index_admin.php?sqlTable=$sqlTable_ArtTag'> $sqlTable_ArtTag </a> </li>
    <li> <a href='index_admin.php?sqlTable=$sqlTable_ArtTranslate'> $sqlTable_ArtTranslate </a> </li>
    <li> <a href='index_admin.php?sqlTable=$sqlTable_ArtComment'> $sqlTable_ArtComment </a> </li>
  </ul>
  <ul class='ArtAdminSummary'>
    <li> Art Mngt </li>
    <li> <a href='index_admin.php?checkProp=Dessin'> Dessin Prop </a> </li>
    <li> <a href='index_admin.php?checkTag=Dessin'> Dessin Tag </a> </li>
    <li> <a href='index_admin.php?includeFolder=Dessin'> Incl Dessin files </a> </li>
    <li> <a href='index_admin.php?includeFolder=Texte'> Inclu Text files </a> </li>
    <li> . </li>
    <li> . </li>
  </ul>
  <ul class='ArtAdminSummary'>
    <li> Direct Edit </li>
    <li> <a href='index_admin.php?manageFolder=Dessin'> Edit Dessin files</a> </li>
    <li> <a href='index_admin.php?manageFolder=Texte'> Edit Texte files </a> </li>
  </ul>
  </div>
  <div class='ArtAdministration'>\n");

  // manage table ?
  if (isset($_GET['sqlTable'])){
    Xsy_Sql_ManageTableData($_GET['sqlTable']);
  }
  elseif (isset($_GET['manageFolder'])){
    switch($_GET['manageFolder']){
      case "Dessin"   : Xsy_Glob_EditMultipleFolder($drawingPathArray);break;
      case "Texte"    : Xsy_Glob_EditMultipleFolder($textPathArray);break;
    }
  }
  elseif (isset($_GET['includeFolder'])){
    switch($_GET['includeFolder']){
      case "Dessin"   : Xsy_Sql_ManageTableWithFiles($sqlTable_ArtItem, $drawingFileArray, $drawingMapping);break;
      case "Texte"    : echo("<p> nothing to do yet </p>");break;
    }
  }
  elseif (isset($_GET['checkTag'])){
    switch($_GET['checkTag']){
      case "Dessin"   : break;
      case "Texte"    : break;
    }
  }
  elseif (isset($_GET['checkProp'])){
    switch($_GET['checkProp']){
      case "Dessin"   : Xsy_Art_ManageItemProperties();break;
      case "Texte"    : echo("<p> nothing to do yet </p>");break;
    }
  }
  else{
    echo("<p> Nothing to administrate, select one dumbass. </p>");
  }

  echo("</div>");

}
else{
  echo("no authorization");
}
include_once("art_footer.php");
?>
