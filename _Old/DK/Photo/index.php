<?php
include("../Tools/phobida_header.php");
include("Photo_Settings.php");

$allPhotos = "";


// ==================================================================================
//  ---  Retrieve all photos
// ==================================================================================

// REMOVED in query : 
    // `Int_Width`,
    // `Int_Height`,

$photo_query  = Xsy_Sql_Query("
  SELECT
    `ID_Photo`,
    `Txt_FileName`,
    `Txt_PhotoName`,
    `Txt_Desc%".$_SESSION['userlang']."`
  FROM
    `".$SQL_DATABASE."`.`".$sqlPho_Photo."`
  ORDER BY
    `Int_Photo%Order`");

$photo_check  = Xsy_Sql_RowCount($photo_query);





// ==================================================================================
//  ---  Some Photos to display
//  ---  photos will be separated in three columns with fixed width.
//  ---  Photo order is as follow:
//  ---   1 || 2 || 3
//  ---   4 || 5 || ...
// ==================================================================================

$photoCounter = 0;
$nbOfColumns  = 3;

  // ==================================================================================
  //  ---  Check if DK has uploaded some photos
  // ==================================================================================
  if ($photo_check==0){
    $photoCol[0] = "No photo to display for the moment due to maintenance reasons. Sorry for the inconvenience.";
  }
  else{
    for($i=0; $i<$nbOfColumns; $i++){
    $photoCol[$i] = "  <div id='Pho_Photo_Col".$i."' class='Photo_Column'>\n ";
    }
  }

while ($aPhoto = Xsy_Sql_Fetch($photo_query)){

  // echo("<p> ".($photoCounter % $nbOfColumns)." </p>");

  // add photo to proper columns
  $photoCol[$photoCounter % $nbOfColumns] .= "  <a id='PhoPhoto".$aPhoto['ID_Photo']."' class='PhoPhoto' rel='PhoPhotoGallery' href='img/".$aPhoto['Txt_FileName']."' title='".$aPhoto['Txt_Desc%'.$_SESSION['userlang']]."'>\n";
  $photoCol[$photoCounter % $nbOfColumns] .= "    <img src='img/".$aPhoto['Txt_FileName']."' title='".$aPhoto['Txt_PhotoName']."' alt='".$aPhoto['Txt_PhotoName']."' />\n";
  $photoCol[$photoCounter % $nbOfColumns] .= "  </a>\n";

  // next photo
  $photoCounter += 1;
}

for($i=0; $i<$nbOfColumns; $i++){
  $photoCol[$i] .= "  </div>\n ";
}


// ==================================================================================
//  ---  Display the columns
// ==================================================================================

echo("  <div id='Phobida_Photo'>
  <div id='MoveUp' class='Phobida_MoveUrBody'>
    <p> Up </p>
  </div>

  <div id='Phobida_PhotoArea'>
    <div id='Phobida_PhotoWrapper'>
");


for($i=0; $i<$nbOfColumns; $i++){
  echo($photoCol[$i]);
}

echo("
    </div>
  </div> <!-- end of Phobida_PhotoArea -->

  <div id='MoveDown' class='Phobida_MoveUrBody'>
    <p> Down </p>
  </div>
  </div>");

include("../Tools/phobida_footer.php");
?>









