<?php
// ==================================== SQL TABLES ================================ //

// include_once($root.'/Ztools/global_header.php');
include_once('../Ztools/global_header.php');
include_once('misc_settings.php');

// ==================================  LANGUAGES  ================================ //
$siteName         = "XsyMisc";
$css_array[]      = "css_misc.css";
$js_array[]       = "js_misc.js";
$optionalCss      = "";
$optionalJs       = "";
$body             = "";
$leftside[]       = ($_SESSION['UserAdmin']) ? "    <ul class='MiscSummary'>
       <li> <a href='index.php'> Home </a> </li>
       <li>  </li>
       <li> <a href='index_admin.php?sqltable=$sqlTable_MiscExcel'> SQL Excel </a> </li>
       <li> <a href='index_admin.php?sqltable=$sqlTable_MiscSync'> SQL Online </a> </li>
       <li> <a href='index_admin.php?fileTable=$sqlTable_MiscExcel'> Files Excel </a> </li>
       <li> <a href='index_admin.php?fileTable=$sqlTable_MiscSync'> Files Online </a> </li>
       <li> <a href='index_admin.php?fileEdit=All'> Edit files </a> </li>
    </ul>
    <br />" : "";
$leftside[]       = "
    <div id='Summary'>
      <div id='Excel'> Excel Files </div>
      <div id='Sync'> Saving files </div>
    </div>";
$rightside[]      = "";
$beforePage       = "";
$metaOther        = "";
$headerMisc       = "";

globalHeader($siteName, $css_array, $js_array, $body, $leftside, $rightside, $beforePage, $metaOther, $headerMisc);


  // ========================================= MAIN CONTENT: CENTRAL ============================== //

  echo("
  ");

?>




