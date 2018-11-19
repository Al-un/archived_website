<?php
include_once("art_header.php");

if(Xsy_Glob_AuthCheck("XsyArt", $XSY_SESS_NORMALLEVEL)) {

  // user change settings (sort, filetering ...)
  if(isset($_POST['ChangeArtSort'])){
  
  }
  // user add comments, popup add form is handled by javascript
  elseif(isset($_POST['ArtCommAdded'])){
  
  }
  // user update comments, popup update form is handled by javascript
  elseif(isset($_POST['ArtCommUpdated'])){
  
  }

  Xsy_Art_DisplayAllDrawings();

}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}
include_once("art_footer.php");
?>