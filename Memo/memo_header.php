<?php
// ==================================== SQL TABLES ================================ //

// include_once($root.'/Ztools/global_header.php');
include_once(__DIR__.'/../Ztools/global_header.php');
include_once('memo_settings.php');

$_SESSION['MemoSort'] = (isset($_SESSION['MemoSort'])) ? $_SESSION['MemoSort'] : "Cate";
if(isset($_GET['sorting'])){
  $_SESSION['MemoSort'] = Xsy_Glob_Get('sorting');
}

// ==================================  LANGUAGES  ================================ //
$siteName         = "XsyMemo";
$css_array[]      = "css_global.css";
$css_array[]      = "css_memo.css";
$js_array[]       = "";
$optionalCss      = "";
$optionalJs       = "";
$body             = "";
$leftside[]       = "<div> <ul> <li> <a href='?sorting=Cate'> $sortCate </a> </li>  <li> <a href='?sorting=Status'> $sortStatus </a> </li>  </ul> </div>";
$leftside[]       = ($_SESSION['UserAdmin']) ? "
  <p> Current sorting : ".$_SESSION['MemoSort']." </p>
  <ul class='PassSummary'>
    <li> <a href='index.php'> Home </a> </li>
    <li> <a href='index_admin.php?sqltable=$sqlTable_memocontent'> $sqlTable_memocontent </a> </li>
    <li> <a href='index_admin.php?sqltable=$sqlTable_memocate'> $sqlTable_memocate </a> </li>
    <li> <a href='index_admin.php?sqltable=$sqlTable_memostatus'> $sqlTable_memostatus </a> </li>
    <li> <a href='index_admin.php?sqltable=$sqlTable_memoshareuser'> $sqlTable_memoshareuser </a> </li>
  </ul>" : "";
$rightside[]    = "";
$beforePage       = "";
$metaOther        = "";
$headerMisc       = "";

globalHeader($siteName, $css_array, $js_array, $body, $leftside, $rightside, $beforePage, $metaOther, $headerMisc);


  // ========================================= MAIN CONTENT: CENTRAL ============================== //

  echo("
    <table border='1' id='MemoSummary'>
     <tr>
       <td> <a href='index.php'> ".$summaryHome." </a> </td>
       <td> <a href='index.php?AddMemo=True'> ".$summaryMemo." </a> </td>
       <td> <a href='index.php?memoaction=ManageCate'> ".$summaryCate." </a> </td>
       <td> <a href='index.php?memoaction=ManageStatus'> ".$summaryStat." </a> </td>
     </tr>
    </table>
  ");

?>




