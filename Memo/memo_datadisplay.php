<?php
$txtStatus  = ($_SESSION['MemoSort'] !== "Status") ? "Status"     : "";
$txtCate    = ($_SESSION['MemoSort'] !== "Cate")   ? "Category"   : "";

// ============================================================================================== //
// =========================== DISPLAY MEMOS DATA FOR A SPECIFIC USER  ========================== //
// ============================================================================================== //
if(!isset($sortingData) OR count($sortingData)==0){
  $memoData[0]['Title']       = "No content";
  $memoData[0]['Content']     = "There is currently no content. If you are connected as an user, please create categories and status and then a memo.";
  $memoData[0]['Update']      = "2014-08-12 07:55:42";
  $memoData[0]['Cate']        = "Nothing";
  $memoData[0]['Status']      = "Nothing";
  $memoData[0]['Auth']        = FALSE;
  $sortingData[0]['ID']       = 0;
  $sortingData[0]['Name']     = "Nothing";
  $sortingData[0]['LinkedMemoId'][] = 0;
}

foreach($sortingData as $index=>$sortArray){

  $memoDisplay = "<div id='memoCate".$sortArray['ID']."' class='memoCate'>\n";
  $memoDisplay .= " <div class='memoCateTitle'> <p> ".($_SESSION['UserLevel'] >= $XSY_SESS_ADMINLEVEL ? "[ID: ".$sortArray['ID']."]  " : "")." ".$sortArray['Name']." </p> </div>\n";

  if(isset($sortArray['LinkedMemoId'])){
    foreach($sortArray['LinkedMemoId'] as $aMemoId){

      // prepare some stuff
      $editForm = (isset($memoData[$aMemoId]['Auth']) AND $memoData[$aMemoId]['Auth']==FALSE) ? "(no authorization to modify it)" : "    <form method='post' action=''>
    <input type='hidden' name='XsyMemoID' value='$aMemoId' />
    <input type='submit' name='XsyMemoShare' value='Share' /> <br />
    <input type='submit' name='XsyMemoModify' value='Modify' /> <br />
    <input type='submit' name='XsyMemoDelete' value='Delete' /> <br />
   </form>\n";
      $shareTo = "";
      if(isset($memoData[$aMemoId]['ShareTo'])){
        foreach($memoData[$aMemoId]['ShareTo'] as $userId=>$sharedUserArray){
          $shareTo .= "<form method='post' action=''> <p> <input type='hidden' name='MemoShareId' value='".$sharedUserArray['IdShare']."' /> <input type='submit' name='MemoShareDeleted' value='X' /> ".$sharedUserArray['Name']." </p> </form>";
        }
      }

      // add stuff to the display string
      $memoDisplay .= "
  <div id='memoContent$aMemoId' class='memoContent'>
  <p class='memoContentTitle'> ".$memoData[$aMemoId]['Title']." </p>
   <div class='memoContentMngt'>\n
   $editForm
  </div>
  <div class='memoContentInfo'>
".( (isset($memoData[$aMemoId]['Owner'])) ? "   <p> Owner: ".$memoData[$aMemoId]['Owner']."</p>"             : "")."
".( ($txtStatus!=="")                     ? "   <p> ".$txtStatus." : ".$memoData[$aMemoId]['Status']."</p>"  : "")."
".( ($txtCate!=="")                       ? "   <p> ".$txtCate." : ".$memoData[$aMemoId]['Cate']."</p>"      : "")."
"."<p style='font-size: 0.8em;'> <i> Last Update: ".$memoData[$aMemoId]['Update']." </i> </p>
".( ($shareTo!=="")                       ? "   <p> ".$shareTo."</p>"                                        : "")."
  </div>
  <div class='memoContentText'> ".Xsy_Glob_AddLinkToUrl($memoData[$aMemoId]['Content'])." </div>
  </div>\n";
    }
  }
  else{
    $memoDisplay .="<div id='memoContent0' class='memoContent'>
  <p> no memo for this category </p>
  </div>\n";
  }

  $memoDisplay .= "</div>\n";
  echo($memoDisplay);
}

?>