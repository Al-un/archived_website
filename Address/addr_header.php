<?php
include_once(__DIR__.'/../Ztools/global_header.php');
include_once("addr_settings.php");
include_once("addr_functions.php");

// ================================================================================ // 
// ==================================  Header  ==================================== //
// ================================================================================ // 

$siteName       = "XsyAddress";
$css_array[]    = 'addr_css_global.css';
$css_array[]    = 'addr_css_addr.css';
// if($_SESSION['UserAdmin']){$css_array[] = "addr_css_admin.css";}
$js_array[]     = '';
// $js_array[]     = 'addr_js_addr.js';
$js_array[]     = '';
// $js_array[]     = 'addr_js_admin.js';
$body           = "";

if ($_SESSION['UserAdmin']){
  $leftside[]     = "
  <div class='AdminLink'> <a href='index.php'> Home  </a> </div>
  <div class='AdminLink'> <a href='index_admin.php'> Custom Admin  </a> </div>
  <div class='AdminLink'> <a href='index_sql.php'> SQL Admin  </a> </div>

";
}
else{
  $leftside[]     = "";
}

$rightsite[]    = "";
$rightside[]    = "";
$beforePage     = "";
$metaOthers     = "";
$headerMisc     = "";

globalHeader($siteName, $css_array, $js_array, $body, $leftside, $rightside, $beforePage, $metaOthers, $headerMisc);

?>