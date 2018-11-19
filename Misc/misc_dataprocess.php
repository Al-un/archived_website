<?php

/*
 * if a file is in the table, get full root path
 */
function getFullParentPath($fileId){

  $path     = "";
  $parentID = 0;

  /* check if there is any entry */
  $checkQuery   = "
    SELECT COUNT(*)
    FROM `$SQL_DATABASE`.`$sqlTable_MiscSync`
    WHERE `ID_Sync` = '$fileId'";
  $checkFetch   = Xsy_Sql_FetchAll($checkQuery);
  $checkCount   = $checkFetch[0]['COUNT(*)'];

  if($checkCount > 0 ){
    $query      = "
      SELECT `Int_Parent%Folder`
      FROM `$SQL_DATABASE`.`$sqlTable_MiscSync`
      WHERE `Id_Sync` = '$fileId'";
    $fetch      = Xsy_Sql_FetchAll($query);
    
    $parentID = $fetch[0]['Int_Parent%Folder`'];
    
    if($parentID == 0){
      return "/";
    }
    else{
      return getFullParentPath($parentID).findFolderNameById($parentID)."/";
    }

  }
  else{
    $path = NULL;
  }

  return $path;
}


/**
 * return a folder name when giving an ID. Check
 * if folder exist. 
 *
 * If folder doesn't exist, function retuns NULL
 * If file exists but isn't a folder, function
 * returns the "-1" string; 
 */
function findFolderNameById($folderId){

  GLOBAL $SQL_DATABASE, $sqlTable_MiscSync;
  $folderName   = "";
  $isDirectory  = FALSE;

  /* check if there is any entry */
  $checkQuery   = "
    SELECT COUNT(*)
    FROM `$SQL_DATABASE`.`$sqlTable_MiscSync`
    WHERE `ID_Sync` = '$folderId'";
  $checkFetch   = Xsy_Sql_FetchAll($checkQuery);
  $checkCount   = $checkFetch[0]['COUNT(*)'];

  if($checkCount > 0 ){
    $query      = "
      SELECT `Txt_File%Name`, `Bool_isDirectory`
      FROM `$SQL_DATABASE`.`$sqlTable_MiscSync`
      WHERE `Id_Sync` = '$folderId'";
    $fetch      = Xsy_Sql_FetchAll($query);
    
    $isDirectory= ($fetch[0]['Bool_isDirectory`']==1);
    $folderName = $fetch[0]['Txt_File%Name`'];

    if(!$isDirectory){
      $folderName = "-1";
    }

  }
  else{
    $folderName = NULL;
  }

  return $folderName;

}

/**
 * reverse function
 *
 * If folder isn't in table, function retuns NULL
 * returns the "-1" string; 
 */
function findFolderIdByName($folderName){

  GLOBAL $SQL_DATABASE, $sqlTable_MiscSync;
  $folderId     = 0;
  $isDirectory  = FALSE;

  /* check if there is any entry */
  $checkQuery   = "
    SELECT COUNT(*)
    FROM `$SQL_DATABASE`.`$sqlTable_MiscSync`
    WHERE `Txt_File%Name` = '$folderName'
    AND `Bool_isDirectory` = '1'";
  $checkFetch   = Xsy_Sql_FetchAll($checkQuery);
  $checkCount   = $checkFetch[0]['COUNT(*)'];

  if($checkCount > 0 ){
    $query      = "
      SELECT `ID_Sync`
      FROM `$SQL_DATABASE`.`$sqlTable_MiscSync`
      WHERE `Id_Sync` = '$folderName'
      AND `Bool_isDirectory` = '1'";
    $fetch      = Xsy_Sql_FetchAll($query);
    
    $folderId = $fetch[0]['ID_Sync`'];
  }

  return $folderId;

}

/*
 * function scan a folder and check if entries is in DB
 *
 * return an array if folder not empty
 * return NULL if folder is empty
 */
function scanSync($root, $isRecursive){

  GLOBAL $SQL_DATABASE, $sqlTable_MiscSync, $path_Sync;

  $scanRoot     = $path_Sync.$root;
  $scanDir      = scandir($scanRoot); // add 1 as second argument to reverse order
  $scanFolder   = array();
  $parentID     = 0;
  $isDirectory  = 0; // boolean in 0 / 1 format
  $rootID       = findFolderIdByName($root);
  $currentID    = 0;

  /* 2 because of "." & ".." folder */
  if(count($scanDir)==2){
    return NULL;
  }

  foreach($scanDir as $fileIndex => $fileName){
    if ($fileName!=="." and $fileName!==".."){

      // file / folder characteristics
      $scanFolder[$currentID]['FileName']     = $fileName;
      $scanFolder[$currentID]['isDirectory']  = (is_dir($scanRoot.$fileName)) ? 1 : 0;
      $scanFolder[$currentID]['ParentPath']   = $root;
      $scanFolder[$currentID]['FileExt']      = pathinfo($root.$fileName, PATHINFO_EXTENSION);
      // size for folders only for the moment
      // $scanFolder[$currentID]['FileSize']     = (is_dir($scanRoot.$fileName)) ? filesize($root.$fileName) : 0;
      // SQL tables cross check
      $scanFolder[$currentID]['inSyncTable']  = 0; // boolean in 0 / 1 format
      $scanFolder[$currentID]['correctParent']= 1; // boolean in 0 / 1 format
      $scanFolder[$currentID]['ParentWrongID']= "";
      $scanFolder[$currentID]['correctIsDir'] = 1; // boolean in 0 / 1 format
      $scanFolder[$currentID]['AuthID']       = -1;
      $scanFolder[$currentID]['AuthInherit']  = 1; // boolean
      // children in case of folders
      $scanFolder[$currentID]['Child']        = array();

      // is file in table?
      $query = "
          SELECT COUNT(*)
          FROM `$SQL_DATABASE`.`$sqlTable_MiscSync`
          WHERE `Txt_File%Name` = '$fileName'";
      $fetch = Xsy_Sql_FetchAll($query);
      $count = $fetch[0]['COUNT(*)'];

      // is the directory tag correct ?
      if($count !== "0"){ // zero is return in String format

        $query        = "
            SELECT `Bool_isDirectory`, `Int_Parent%Folder`
            FROM `$SQL_DATABASE`.`$sqlTable_MiscSync`
            WHERE `Txt_File%Name` = '$fileName'";
        $fetch        = Xsy_Sql_FetchAll($query);
        $parentID     = $fetch[0]['Int_Parent%Folder`'];
        $isDirectory  = ($fetch[0]['Bool_isDirectory`'] == 1);

        if($rootID !== $parentID){
          $scanFolder[$currentID]['correctParent'] = 0;
          $scanFolder[$currentID]['ParentWrongID'] = $parentID;
        }

        if($isDirectory !== is_dir($root.$fileName)){
          $scanFolder[$currentID]['correctIsDir'] = 0;
        }
        $scanFolder[$currentID]['inSyncTable'] = 1;
      }

      // Retrieve child
      if(($scanFolder[$currentID]['isDirectory']==1) AND ($isRecursive)){
        $scanFolder[$currentID]['Child'] = scanSync($root.$fileName."", $isRecursive);
      }
      $currentID++;

    }
  }


  return $scanFolder;
}


/*
 * display in text form the scan folder array
 */
function printScanSync($root, $isRecursive){

  $scanArray    = scanSync($root, $isRecursive);
  $scanText     = "";
  $scanCharact  = "";
  $scanTempOut  = array();
  $divFileSize  = "";
  $divContent   = "";  // container for folder & file list
  $divInDb      = "";

// test only
// echo("<pre>");
// print_r($scanArray);
// echo("</pre>");

  if(count($scanArray)==0){
    return "<p> There is nothing to scan so nothing to print!!! </p>\n";
  }

  foreach ($scanArray as $i => $fileArray){
// echo("<pre>");
// print_r($fileArray);
// echo("</pre>");
    // if date is supposed to be in the sync table
    // if ($fileArray[$i]['inSyncTable']==1){

      if(($fileArray['correctIsDir']==1) AND ($fileArray['isDirectory']==1)){
        // $scanText .= "    <div  class='syncFolder' >\n";
        $scanText .= "      <p class='SyncHeader' id='folder'".$fileArray['FileName'].">";
        $scanText .= " <img src='Resources/misc.icon.folder.32.png' height='30px' alt='' title='folder' class='icon'/> ";
        $scanText .= $fileArray['FileName']." </p>\n";

        $scanCharact .= "    <div class='CharactRow'>";
        // get folder characteristics
        if($fileArray['inSyncTable']==1){
          $scanCharact .= "      <div class='inTable'> in Table </div>";
          if($fileArray['correctParent']==1){
            $scanCharact .= "      <div class='Parent'> Parent OK </div>";
          }
          else{
            $scanCharact .= "      <div class='Parent'> Parent KO </div>";
          }
        }
        else{
          $scanCharact .= "      <div class='inTable'>
        <form method='post' action=''>
          <input type='checkbox' name='toto' />
        </form>
      </div>";
        }
        // $scanCharact .= "      </div>";

        // expand children
        if(count($fileArray['Child']) !==0){
          $scanTempOut   = printScanSync($fileArray['FileName'], $isRecursive);
          $scanText     .= $scanTempOut[0];
          $scanCharact  .= $scanTempOut[1];
        }

        $scanText .= "    </div>\n";


      }
      else{
        $scanText .= "      <div id='file".$fileArray['FileName']."' class='syncFile' >\n ";
        $scanText .= "        <p>";
        // have an icon according to file extension
        switch($fileArray['FileExt']){
          default:
            $scanText .= " <img src='Resources/misc.icon.file.blank.32.png' height='25px' alt='' title='file' class='icon'/> ";
        }
        // print file name
        $scanText .= $fileArray['FileName']." </p>\n";
        $scanText .= "      </div>\n";

        // get file characteristics
        if($fileArray['inSyncTable']==1){
          $scanCharact .= "      <div class='inTable'> in Table </div>";
          if($fileArray['correctParent']==1){
            $scanCharact .= "      <div class='Parent'> Parent OK </div>";
          }
          else{
            $scanCharact .= "      <div class='Parent'> Parent KO </div>";
          }
        }
        else{
          $scanCharact .= "      <div class='inTable'>
        <form method='post' action=''>
          <input type='checkbox' name='toto' />
        </form>
      </div>";
        }
      }
    // }
  }

  $scanOutput = array($scanText, $scanCharact);
  return $scanOutput;
}



function displayTest(){

  $output = printScanSync("", TRUE);
  echo("   <div id='SyncBlock' style='/*display:none*/' class='plop'>");
  echo("   <div id='SyncExplorer'>\n".$output[0]."\n   </div>");
  echo("   <div id='SyncCharact'>\n".$output[1]."\n   </div>");
  echo("   </div>");

}

displayTest();
?>