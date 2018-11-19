<?php
// ==================================== SQL TABLES ================================ //

// include_once($root.'/Ztools/global_header.php');
include_once('../Ztools/global_header.php');
include_once('art_settings.php');
$_SESSION['ArtSort'] = (isset($_SESSION['ArtSort'])) ? $_SESSION['ArtSort'] : "Date"; 
if (isset($_GET['ArtSort'])){
  $_SESSION['ArtSort'] = $_GET['ArtSort'];
}
include_once('art_functions.php');

// ==================================  LANGUAGES  ================================ //
$siteName         = "XsyArt";
$css_array[]      = "art_css.css";
$js_array[]       = "art_js.js";
$optionalCss      = "";
$optionalJs       = "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>";
$body             = "";
$leftside[]       = "";
$rightside[]      = ($_SESSION['UserAdmin']) ? "
    <p> <a href='index_admin.php'> Admin </a>&nbsp;&nbsp; <a href='index.php'> Home </a> </p>" : "";
/* ORIGINAL VERSION NOT W3C COMPLIANT !!!! FCUKING FACEBOOK
$beforePage       = "
  <div id='fb-root'></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = '//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
*/
$beforePage       = "
  <div id='GallerySlideShow'>
    <div id='GalleryLeftPanel'>
      <div id='GalleryClose'> <p> Close </p> </div>
      <div id='GalleryWidth'> <p> Fit Picture </p> </div>
      <div id='GallerySummary'>  </div>
    </div>
    <div id='GalleryContent'>
    </div>
    <div id='GalleryComment'>
    </div>
  </div>
  <div id='Art_Header'>\n  </div>";
$metaOther        = "";
$headerMisc       = "";

globalHeader($siteName, $css_array, $js_array, $body, $leftside, $rightside, $beforePage, $metaOther, $headerMisc);

?>




