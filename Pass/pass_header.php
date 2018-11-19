<?php
// ==================================== SQL TABLES ================================ //

// include_once($root.'/Ztools/global_header.php');
include_once('../Ztools/global_header.php');
include_once('pass_settings.php');
$_SESSION['PassSort'] = (isset($_SESSION['PassSort'])) ? $_SESSION['PassSort'] : "Cate"; // Cate or Level
if (isset($_GET['PassSort'])){
  $_SESSION['PassSort'] = $_GET['PassSort'];
}

// ==================================  LANGUAGES  ================================ //
$siteName         = "XsyPass";
$css_array[]      = "css_pass.css";
$js_array[]       = "js_pass.js";
$optionalCss      = "";
$optionalJs       = "";
$body             = "";
$leftside[]       = ($_SESSION['UserAdmin']) ? "    <ul class='PassSummary'>
       <li> <a href='index.php'> Home </a> </li>
       <li> <a href='?sqltable=$sqlTable_PassCate'> $sqlTable_PassCate </a> </li>
       <li> <a href='?sqltable=$sqlTable_PassSite'> $sqlTable_PassSite </a> </li>
       <li> <a href='?sqltable=$sqlTable_PassLevel'> $sqlTable_PassLevel </a> </li>
    </ul>
    <br />
    <p> PassSort : ".$_SESSION['PassSort']."  </p>" : "";
$rightside[]      = "";
$beforePage       = "";
$metaOther        = "";
$headerMisc       = "";

globalHeader($siteName, $css_array, $js_array, $body, $leftside, $rightside, $beforePage, $metaOther, $headerMisc);


  // ========================================= MAIN CONTENT: CENTRAL ============================== //

  echo("
    <table border='1' class='PassSummary'>
     <tr>
      <td colspan='2'> <a href='index.php'> Home </a> </td>
       <td rowspan='2'> <a href='index.php?passaction=pass'> $passAdd </a> </td>
       <td rowspan='2'> <a href='index.php?passaction=cate'> $passCate </a> </td>
       <td rowspan='2'> <a href='index.php?passaction=lvl'> $passLvl </a> </td>
     </tr>
     <tr>
       <td> <a href='index.php?PassSort=Cate'> Sort by Category </a> </td>
       <td> <a href='index.php?PassSort=Level'> Sort by Level </a> </td>
       <!-- <td> <p id='SortByCate'> Sort by Category </p> </td> -->
       <!-- <td> <p id='SortByLevel'> Sort by Level </p> </td> -->
     </tr>
    </table>
  ");

?>




