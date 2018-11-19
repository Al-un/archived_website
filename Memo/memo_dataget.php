<?php
switch($_SESSION['MemoSort']){
  case "Cate" :
    $array_memo_cate    = array();
    $fetch_memo_cate    = Xsy_Sql_FetchAll("SELECT COUNT(*) FROM `$SQL_DATABASE`.`$sqlTable_memocate` WHERE `Id_User`='".$_SESSION['UserId']."'");
    $check_memo_cate    = $fetch_memo_cate[0]["COUNT(*)"] > 0;
    if ($check_memo_cate){
      $array_memo_cate    = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_memocate` WHERE `Id_User`='".$_SESSION['UserId']."' ORDER BY `Int_Cate%Order`");
      foreach($array_memo_cate as $key => $aCateArray){
        $sortingData[$aCateArray['ID_MemoCate']]['ID']   = $aCateArray['ID_MemoCate'];
        $sortingData[$aCateArray['ID_MemoCate']]['Name'] = $aCateArray['Txt_Cate%Name'];
      }
    }
    break;
  case "Status" :
    $array_memo_status  = array();
    $fetch_memo_status  = Xsy_Sql_FetchAll("SELECT COUNT(*) FROM `$SQL_DATABASE`.`$sqlTable_memostatus` WHERE `Id_User`='".$_SESSION['UserId']."'");
    $check_memo_status  = $fetch_memo_status[0]["COUNT(*)"] > 0;
    if ($check_memo_status){
      $array_memo_status  = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_memostatus` WHERE `Id_User`='".$_SESSION['UserId']."' ORDER BY `Int_Status%Order`");
      foreach($array_memo_status as $key => $aStatusArray){
        $sortingData[$aStatusArray['ID_MemoStatus']]['ID']   = $aStatusArray['ID_MemoStatus'];
        $sortingData[$aStatusArray['ID_MemoStatus']]['Name'] = $aStatusArray['Txt_Status%Name'];
      }
    }
    break;
}

// ============================================================================================== //
// =========================== RETRIEVE SHARED MEMOS for A SPECIFIC USER ======================== //
// ============================================================================================== //

$checkOwnedMemo   = "SELECT COUNT(*) FROM `$SQL_DATABASE`.`$sqlTable_memocontent` WHERE `Id_User`='".$_SESSION['UserId']."'";
$checkSharedMemo  = "SELECT COUNT(*) FROM `$SQL_DATABASE`.`$sqlTable_memoshareuser` WHERE `Id_User`='".$_SESSION['UserId']."'";
$rawOwnedMemo     = Xsy_Sql_FetchAll($checkOwnedMemo);
$rawSharedMemo    = Xsy_Sql_FetchAll($checkSharedMemo);
$countOwnedMemo   = $rawOwnedMemo[0]['COUNT(*)'];
$countSharedMemo  = $rawSharedMemo[0]['COUNT(*)'];

/* pour admin pour tester */
if($_SESSION['UserAdmin']){
  if ($countOwnedMemo==0 AND $countSharedMemo==0){
    echo("<p style='color:white;'> aucun mémo, ni propre, ni partagé </p>");
  }
  elseif ($countOwnedMemo>0 AND $countSharedMemo==0){
    echo("<p style='color:white;'> pas de mémo partagé, uniquement propre </p>");
  }
  elseif ($countOwnedMemo==0 AND $countSharedMemo>0){
    echo("<p style='color:white;'> pas de mémo propre, uniquement partagé </p>");
  }
  elseif ($countOwnedMemo>0 AND $countSharedMemo>0){
    echo("<p style='color:white;'> mémo propre et partagé</p>");
  }
}


// easy, select owned queries
$query_owned = "
  SELECT 
    `$sqlTable_memocontent`.`ID_MemoContent`, 
    `$sqlTable_memocontent`.`Txt_Memo%Name`, 
    `$sqlTable_memocontent`.`Text_Memo%Content`, 
    `$sqlTable_memocontent`.`UpDT_Last%Update`, 
    `$sqlTable_memocate`.`Txt_Cate%Name`, 
    `$sqlTable_memocate`.`ID_MemoCate`, 
    `$sqlTable_memostatus`.`Txt_Status%Name`, 
    `$sqlTable_memostatus`.`ID_MemoStatus`
  FROM `$SQL_DATABASE`.`$sqlTable_memocontent`, `$SQL_DATABASE`.`$sqlTable_memocate`, `$SQL_DATABASE`.`$sqlTable_memostatus`
  WHERE `$sqlTable_memocontent`.`Id_User`='".$_SESSION['UserId']."'
  AND `$sqlTable_memocontent`.`Id_MemoCate` = `$sqlTable_memocate`.`ID_MemoCate`
  AND `$sqlTable_memocontent`.`Id_MemoStatus` = `$sqlTable_memostatus`.`ID_MemoStatus`
  ORDER BY `$sqlTable_memocontent`.`UpDT_Last%Update` DESC";
// check if memo is shared
$query_checkSharing  = "
  SELECT COUNT(*)
  FROM `$SQL_DATABASE`.`$sqlTable_memoshareuser`, `$SQL_DATABASE`.`$sqlTable_all_users`
  WHERE `$sqlTable_memoshareuser`.`Id_User` = `$sqlTable_all_users`.`ID_User`
  AND `$sqlTable_memoshareuser`.`Id_MemoContent` = '###ID_MEMO###'";
// and notify who the owned memo is shared to
$query_sharedByUser  = "
  SELECT `$sqlTable_memoshareuser`.`Id_MemoShareUser`, `$sqlTable_all_users`.`ID_User`, `$sqlTable_all_users`.`Txt_User%Name`, `$sqlTable_memoshareuser`.`Bool_Can%Modify`
  FROM `$SQL_DATABASE`.`$sqlTable_memoshareuser`, `$SQL_DATABASE`.`$sqlTable_all_users`
  WHERE `$sqlTable_memoshareuser`.`Id_User` = `$sqlTable_all_users`.`ID_User`
  AND `$sqlTable_memoshareuser`.`Id_MemoContent` = '###ID_MEMO###'";
// check what is shared to user. If it is a category, memo will be retrived later
$query_sharedToUser = "
  SELECT 
    `$sqlTable_memocontent`.`ID_MemoContent`,
    `$sqlTable_memocontent`.`Txt_Memo%Name`,
    `$sqlTable_memocontent`.`Text_Memo%Content`,
    `$sqlTable_memocontent`.`UpDT_Last%Update`,
    `$sqlTable_memocate`.`Txt_Cate%Name`,
    `$sqlTable_memocate`.`ID_MemoCate`,
    `$sqlTable_memostatus`.`Txt_Status%Name`,
    `$sqlTable_memostatus`.`ID_MemoStatus`,
    `$sqlTable_memoshareuser`.`Bool_is%Category`,
    `$sqlTable_memoshareuser`.`Bool_Can%Modify`,
    `$sqlTable_all_users`.`Txt_User%Name`
  FROM `$SQL_DATABASE`.`$sqlTable_memoshareuser`, `$SQL_DATABASE`.`$sqlTable_all_users`, `$sqlTable_memocontent`, `$SQL_DATABASE`.`$sqlTable_memocate`, `$SQL_DATABASE`.`$sqlTable_memostatus`
  WHERE `$sqlTable_memoshareuser`.`Id_User`='".$_SESSION['UserId']."'
  AND `$sqlTable_memocontent`.`Id_User` = `$sqlTable_all_users`.`ID_User`
  AND `$sqlTable_memocontent`.`Id_MemoCate` = `$sqlTable_memocate`.`ID_MemoCate`
  AND `$sqlTable_memocontent`.`Id_MemoStatus` = `$sqlTable_memostatus`.`ID_MemoStatus`
  AND `$sqlTable_memocontent`.`ID_MemoContent` = `$sqlTable_memoshareuser`.`Id_MemoContent`";
$query_sharedByCate = "
  SELECT *
  FROM `$SQL_DATABASE`.`$sqlTable_memocontent`
  WHERE `$sqlTable_memocontent`.`Id_User`= '###ID_USER###'
  AND `$sqlTable_memocontent`.`Id_MemoCate`= '###ID_CATE###'
  ORDER BY `$sqlTable_memocontent`.`UpDT_Last%Update` DESC";

$memoData;

// --- if there is any owned memo
if($countOwnedMemo > 0){
  $rawAllOwnedMemo = Xsy_Sql_FetchAll($query_owned);
  foreach($rawAllOwnedMemo as $key=>$memoArray){

    // -- retrieve memo content
    $idMemoContent = $memoArray['ID_MemoContent'];
    $memoData[$idMemoContent]['Title']      = $memoArray['Txt_Memo%Name'];
    $memoData[$idMemoContent]['Content']    = $memoArray['Text_Memo%Content'];
    $memoData[$idMemoContent]['Update']     = $memoArray['UpDT_Last%Update'];
    $memoData[$idMemoContent]['Cate']       = $memoArray['Txt_Cate%Name'];
    $memoData[$idMemoContent]['Status']     = $memoArray['Txt_Status%Name'];
    $idForSorting = 0;
    switch($_SESSION['MemoSort']){
      case "Cate"     : $idForSorting = $memoArray['ID_MemoCate']; break;
      case "Status"   : $idForSorting = $memoArray['ID_MemoStatus']; break;
    }

    // -- check if it is shared
    $rawCheckSharing    = Xsy_Sql_FetchAll(str_replace("###ID_MEMO###", $idMemoContent, $query_checkSharing));
    $countSharing       = $rawCheckSharing[0]['COUNT(*)'];

    // -- and look who it is shared with
    if($countSharing > 0){
      $rawAllSharedToUser  = Xsy_Sql_FetchAll(str_replace("###ID_MEMO###", $idMemoContent, $query_sharedByUser));
      foreach($rawAllSharedToUser as $key=> $userArray){
        $idSharedToUser = $userArray['ID_User'];
        $memoData[$idMemoContent]['ShareTo'][$idSharedToUser]['IdShare'] = $userArray['Id_MemoShareUser'];
        $memoData[$idMemoContent]['ShareTo'][$idSharedToUser]['Name'] = $userArray['Txt_User%Name'];
        $memoData[$idMemoContent]['ShareTo'][$idSharedToUser]['Auth'] = $userArray['Bool_Can%Modify'];
      }
    }

    // -- add it to cate / status sort
    $sortingData[$idForSorting]['LinkedMemoId'][] = $idMemoContent;
  }

}


// --- if there is any shared memo
if($countSharedMemo > 0){
  $rawAllSharedMemo = Xsy_Sql_FetchAll($query_sharedToUser);
  foreach($rawAllSharedMemo as $key=>$shareArray){

    // -- is the whole category shared ?
    $shareWholeCate = $shareArray['Bool_is%Category']==1;

    // - whole category is shared
    if ($shareWholeCate){

    }
    // - only single memo is shared
    else{
      // -- retrieve memo content
      $idMemoContent = $shareArray['ID_MemoContent'];
      $memoData[$idMemoContent]['Title']      = $shareArray['Txt_Memo%Name'];
      $memoData[$idMemoContent]['Content']    = $shareArray['Text_Memo%Content'];
      $memoData[$idMemoContent]['Update']     = $shareArray['UpDT_Last%Update'];
      $memoData[$idMemoContent]['Owner']      = $shareArray['Txt_User%Name'];
      $memoData[$idMemoContent]['Cate']       = $shareArray['Txt_Cate%Name'];
      $memoData[$idMemoContent]['Status']     = $shareArray['Txt_Status%Name'];
      $memoData[$idMemoContent]['Auth']       = $shareArray['Bool_Can%Modify'];
      switch($_SESSION['MemoSort']){
        case "Cate"     : $idForSorting = $shareArray['ID_MemoCate']; break;
        case "Status"   : $idForSorting = $shareArray['ID_MemoStatus']; break;
      }
      // -- add it to cate / status sort
      if(isset($sortingData[$idForSorting])){
        $sortingData[$idForSorting]['LinkedMemoId'][] = $idMemoContent;
      }
      else{
        $missingTable = "";
        $missingId    = "";
        $missingName  = "";
        switch($_SESSION['MemoSort']){
          case "Cate"     : $missingTable = $sqlTable_memocate; $missingId="ID_MemoCate"; $missingName="Txt_Cate%Name"; break;
          case "Status"   : $missingTable = $sqlTable_memostatus; $missingId="ID_MemoStatus"; $missingName="Txt_Status%Name"; break;
        }
        $missing_sorting  = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$missingTable` WHERE `".$missingId."`='".$idForSorting."'");
        $sortingData[$idForSorting]['ID']   = $missing_sorting[0][$missingId];
        $sortingData[$idForSorting]['Name'] = $missing_sorting[0][$missingName];
        $sortingData[$idForSorting]['Owner']= $missing_sorting[0]['Id_User'];
        $sortingData[$idForSorting]['LinkedMemoId'][] = $idMemoContent;
      }
    }
  }
}


?>