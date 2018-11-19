<?php

$formerError        = "";
$formerID           = 0;
$formerMemoName     = "";
$formerMemoContent  = "";
$formerMemoCate     = "";
$formerMemoStatus   = "";





// ============================================================================================== //
// =========================== PHP Processing                          ========================== //
// ============================================================================================== //


// a memo will be modified
if (isset($_POST['XsyMemoModify'])){

  $modifiedId         = Xsy_Glob_Get('XsyMemoID');
  $allMemoData        = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_memocontent` WHERE `ID_MemoContent`='$modifiedId'");
  $formerMemoName     = $allMemoData[0]['Txt_Memo%Name'];
  $formerMemoContent  = $allMemoData[0]['Text_Memo%Content'];
  $formerMemoCate     = $allMemoData[0]['Id_MemoCate'];
  $formerMemoStatus   = $allMemoData[0]['Id_MemoStatus'];
  $formerID           = $modifiedId;
}



// note is added or modified
if(isset($_POST['XsyMemoSubmit'])){

  $noteId                           = Xsy_Glob_Get('XsyMemoId');
  $memoAddData['Id_User']           = $_SESSION['UserId'];
  $memoAddData['Txt_Memo%Name']     = Xsy_Glob_Get('Txt_Memo%Name');
  $memoAddData['Text_Memo%Content'] = Xsy_Glob_Get('Text_Memo%Content');
  $memoAddData['Id_MemoCate']       = Xsy_Glob_Get('Id_MemoCate');
  $memoAddData['Id_MemoStatus']     = Xsy_Glob_Get('Id_MemoStatus');

  // check if valid values
  if ($memoAddData['Txt_Memo%Name'] != "" AND $memoAddData['Text_Memo%Content'] != ""){
    if($noteId == 0){
      Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_memocontent, $memoAddData);
    }
    else{
      Xsy_Sql_Update($SQL_DATABASE, $sqlTable_memocontent, $memoAddData, $noteId);
    }
  }
  // try again !
  else{
    $formerError        = "<p style='color:red;'> Memo Name or Memo Content is empty. Check again! </p>\n";
    $formerMemoName     = $memoAddData['Txt_Memo%Name'];
    $formerMemoContent  = $memoAddData['Text_Memo%Content'];
    $formerMemoCate     = $memoAddData['Id_MemoCate'];
    $formerMemoStatus   = $memoAddData['Id_MemoStatus'];
  }
}


// note is deleted
elseif (isset($_POST['XsyMemoDelete'])){
  print_r($_POST);
  $deleteId = Xsy_Glob_Get('XsyMemoID');
  Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_memocontent, 'ID_MemoContent', $deleteId);
  // echo("<p style='color:red;'> Memo ID $deleteId is deleted </p>");
}


// note is shared
elseif (isset($_POST['XsyMemoShared'])){
  echo("plop");
  $noteId                  = Xsy_Glob_Get('XsyNoteId');
  $memoShare['Bool_is%Category']  = 0;
  $memoShare['Id_MemoContent']    = Xsy_Glob_Get('XsyMemoID');
  $memoShare['Id_MemoCate']       = 0;
  $memoShare['Id_User']           = Xsy_Glob_Get('Id_User');
  $memoShare['Bool_Can%Modify']   = Xsy_Glob_Get('Bool_Can%Modify');
  Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_memoshareuser, $memoShare);
}
// sharing is removed
elseif (isset($_POST['MemoShareDeleted'])){

  $shareId                  = Xsy_Glob_Get('MemoShareId');
  Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_memoshareuser, 'ID_MemoShareUser', $shareId);
}



?>