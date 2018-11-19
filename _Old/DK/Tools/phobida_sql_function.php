<?php


/*

This Sql Library includes:
- Sql login data
- Sql functions :


Xsy_Sql_Query($query)
Xsy_Sql_Fetch($stmt, $fetchMode = PDO::FETCH_ASSOC)
Xsy_Sql_FetchAll($query, $fetchMode = PDO::FETCH_ASSOC)
Xsy_Sql_Insert($SQL_DATABASE, $SQL_TABLE, $valueArray)
Xsy_Sql_Update($SQL_DATABASE, $SQL_TABLE, $valueArray, $idValue
Xsy_Sql_Delete($SQL_DATABASE, $SQL_TABLE, $field, $value)
Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE)
Xsy_Sql_Escape($strEntry)
Xsy_Sql_RowCount($pdoStatement)
Xsy_Glob_Get($champ)


Xsy_Sql_DisplayFieldName($fieldName)
Xsy_Sql_DisplayFieldValue($fieldName, $fieldValue='', $displayMode='Display', $refTable=NULL, $width='300px', $height='70px')
Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE)
Xsy_Sql_GetColumnsData($SQL_DATABASE, $SQL_TABLE)
Xsy_Sql_GetRefTableData($SQL_DATABASE, $fieldName)
Xsy_Sql_DisplaySqlTable($SQL_DATABASE, $SQL_TABLE)
Xsy_Sql_DisplaySingleEntry($SQL_DATABASE, $SQL_TABLE, $displayMode="Display", $idEntry=0)

XsySqlAddEntry($SQL_DATABASE, $SQL_TABLE)
XsySqlModifyEntry($SQL_DATABASE, $SQL_TABLE)
XsySqlDeleteEntry($SQL_DATABASE, $SQL_TABLE)

Xsy_Sql_ManageTableData($SQL_TABLE)


sqlManager($sqlTableRootName)
Xsy_Sql_RenameTableInOld($nameDb, $nameTable)
Xsy_Sql_DeleteTable($nameDb, $nameTable)
Xsy_Sql_ExportTable($nameDb, $nameTable)

*/





  // =========================== DEFINE MYSQL VARIABLES ========================== //
  
if ($_SERVER['HTTP_HOST'] == "localhost"){
  $website       = "http://Localhost/Web";
  $SQL_SERVER    = "localhost";
  $SQL_USER      = "root";
  $SQL_PASSWORD  = "";
  $SQL_DATABASE  = "freeh_taetili";
}
elseif($_SERVER['HTTP_HOST'] == "www.phobida.com"){
  $website       = "http://www.phobida.com";
  $SQL_SERVER    = "sql31.free-h.org";
  $SQL_USER      = "dk";
  $SQL_PASSWORD  = "pho75013";
  $SQL_DATABASE  = "phobida";
}
elseif($_SERVER['HTTP_HOST'] == "xsylum.free-h.net"){
  $website       = "http://xsylum.free-h.net/";
  $SQL_SERVER    = "sql31.free-h.org";
  $SQL_USER      = "XsyDbUser";
  $SQL_PASSWORD  = "32Hakur3i@Sql!";
  $SQL_DATABASE  = "xsylum";
}



// 1°) user UTF-8 charset
// 2°) maintain persistent PDO connection
$SQL_OPTIONS = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_PERSISTENT => TRUE);
// $SQL_OPTIONS = array(PDO::ATTR_PERSISTENT => TRUE);



// define PDO connection
try{
  $XSY_SQL_PDO = new PDO('mysql:host='.$SQL_SERVER.';dbname='.$SQL_DATABASE, $SQL_USER, $SQL_PASSWORD, $SQL_OPTIONS);
  // $SQL_PDO->beginTransaction();
}
catch(PDOException $excep){
  // no admin check because $_SESSION is not set yet
  echo("<p> Error in PDO initialization: <br />".$excep->getMessage()."</p>\n
  <table border='1'>
    <tr> <td> HTTP HOST </td> <td> ".$_SERVER['HTTP_HOST']." </td> </tr>\n
    <tr> <td> Website </td> <td> $website </td> </tr>\n
    <tr> <td> Server </td> <td> $SQL_SERVER </td> </tr>\n
    <tr> <td> Database </td> <td> $SQL_DATABASE </td> </tr>\n
    <tr> <td> User </td> <td> $SQL_USER </td> </tr>\n
    <tr> <td> Options </td> <td> $SQL_OPTIONS </td> </tr>\n
  </table>
");
}

















/* #####################################################################################################
 *  - SQL methods (insert, delete)
 * #####################################################################################################
 */


// ==============================================================
// Execute SQL query and return the PDO statement
// ==============================================================
function Xsy_Sql_Query($query){

  global $XSY_SQL_PDO;
  
  try{
    $stmt = $XSY_SQL_PDO->query($query);
  }
  catch(PDOException $excep){
    $errorMessage = $_SESSION['useradmin'] ? 
                  "<p>PDO MYSQL REQUEST ERROR: <br /> $query <br /> <b>Error#".$excep->getCode()."</b>: <i>".$excep->getMessage()."</i></p>" :
                  "<p>The SQL request failed. Please report it to the administrator.</p>";
    echo $errorMessage;
    return FALSE;
  }

  return $stmt;
}



// ==============================================================
// Fetch a PDO Statement
// ==============================================================
function Xsy_Sql_Fetch($stmt, $fetchMode = PDO::FETCH_ASSOC){

  if(!$stmt){
    $errorMessage = $_SESSION['useradmin'] ? 
                  "<p>PDO MYSQL REQUEST ERROR in Xsy_Sql_Fetch: <br /> $stmt is not defined </i></p>" :
                  "<p>SQL object is not defined while fetch. Please report it to the administrator.</p>";
    echo $errorMessage;
    return FALSE;
  }

  try{
    $fetchedResult = $stmt->fetch($fetchMode);
  }
  catch(PDOException $excep){
    $errorMessage = $_SESSION['useradmin'] ? 
                  "<p>PDO MYSQL REQUEST ERROR while fetch $stmt: <br /> <b>Error#".$excep->getCode()."</b>: <i>".$excep->getMessage()."</i></p>" :
                  "<p>The SQL request failed. Please report it to the administrator.</p>";
    echo $errorMessage;
    return FALSE;
  }
  return $fetchedResult;
}

// ==============================================================
// Execute SQL query and return the fetched data
// ==============================================================
function Xsy_Sql_FetchAll($query, $fetchMode = PDO::FETCH_ASSOC){
  
  $stmt     = Xsy_Sql_Query($query);

  if (!$stmt OR $stmt->rowCount() == 0){
    if ($_SESSION['useradmin']){
      echo("<div class='SQL_ERROR'> <p> No entry for query: <br /> $query</p> </div>");
    }
    return FALSE;
  }

  try{
    $fetched  = $stmt->fetchAll($fetchMode);
  }
  catch(PDOException $except){
    $errorMessage = $_SESSION['useradmin'] ? 
                  "<p>PDO MYSQL REQUEST ERROR: <br /> $query <br /> <b>Error#".$excep->getCode()."</b>: <i>".$excep->getMessage()."</i></p>" :
                  "<p>The SQL request failed. Please report it to the administrator.</p>";
    echo $errorMessage;
    return FALSE;
  }

  return $fetched;
}



// =========================================================
// insert an array value into a specific table
// =========================================================
function Xsy_Sql_Insert($SQL_DATABASE, $SQL_TABLE, $valueArray){

  $tableString = "`".$SQL_DATABASE."`.`".$SQL_TABLE."`";
  $fieldString = "(";
  $valueString = "(";

  foreach($valueArray as $key => $value){
    $fieldString .= "`".$key."`, ";
    $valueString .= "'".$value."', ";
  }
  
  $fieldString = substr($fieldString, 0, -2).")";
  $valueString = substr($valueString, 0, -2).")";
  
  $insertQuery = "INSERT INTO ".$tableString." ".$fieldString." VALUES".$valueString;
  return Xsy_Sql_Query($insertQuery);
}




// =========================================================
// update a table based on an ID (PrimKey) criterai
// =========================================================
function Xsy_Sql_Update($SQL_DATABASE, $SQL_TABLE, $valueArray, $idValue){
  
  $idField      = Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE);
  $updateValue  = "";
  $condition    = "WHERE `".$idField."`='".$idValue."'";

  foreach ($valueArray as $key=>$value){
    $updateValue .= "`".$key."`='".$value."', ";
  }
  $updateValue = substr($updateValue, 0, -2);
  
  $updateQuery = "UPDATE `".$SQL_DATABASE."`.`".$SQL_TABLE."` SET ".$updateValue." ".$condition;
  return Xsy_Sql_Query($updateQuery);
  
}




// =========================================================
// delete an single value from a specific table. 
// Criteria (arguments) are
//  - a single field
//  - the value for this field
//  - of course, the table name
// =========================================================
function Xsy_Sql_Delete($SQL_DATABASE, $SQL_TABLE, $field, $value){

  return Xsy_Sql_Query("DELETE FROM `".$SQL_DATABASE."`.`".$SQL_TABLE."` WHERE `".$field."`='".$value."'");
  
}




// =========================================================
// get the ID field (primary key) from a table
// =========================================================
function Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE){

  $stmt = Xsy_Sql_Query("SHOW COLUMNS FROM `".$SQL_DATABASE."`.`".$SQL_TABLE."` WHERE `Key`='PRI'");
  if ($stmt->rowCount() == 0){
    if ($_SESSION['useradmin']){
      echo("<div class='SQL_ERROR'> <p>Primary key was not found for table $SQL_TABLE</p> </div>");
    }
    return FALSE;
  }
  elseif( $stmt->rowCount() > 1){
    if ($_SESSION['useradmin']){
      echo("<div class='SQL_ERROR'> <p>More than one Primary Key (".$stmt->rowCount().") was found for table $SQL_TABLE</p> </div>");
    }
    return FALSE;
  }
  else{
    $arrayId = Xsy_Sql_Fetch($stmt);
    return $arrayId['Field'];
  }
}





// =========================================================
// escape string 
// =========================================================
function Xsy_Sql_Escape($strEntry){
  
  GLOBAL $XSY_SQL_PDO;
  return $XSY_SQL_PDO->quote($strEntry);
  
}


// =========================================================
// count the number of entries in a PDOStatement
// =========================================================
function Xsy_Sql_RowCount($pdoStatement){

  return $pdoStatement->rowCount();
  
}



/* *****************************************************************************************************
 * get function which receives data from a get method or post 
 * method in a form. moreover, only some special html char are
 * accepted. Other tags are deleted to prevent from php/html injection
 * but there is no anti sql injections methods.
 * @return the field data or "" if isset is false
 * ****************************************************************************************************/
function Xsy_Glob_Get($champ){
  
  // POST or GET method?
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $result = (isset($_POST[$champ])) ? $_POST[$champ] : "";
  }
  else if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $result = (isset($_GET[$champ])) ? $_GET[$champ] : "";
  }
  else{
    DIE('<b> Wrong Server Requst method for '.$champ.' : '.$_SERVER['REQUEST_METHOD'].'</b>');
  }

  $result = str_replace("'","''",$result);                    // pour enregistrer les apostrophes en SQL
  $result = strip_tags($result,"<b><u><i><a><br />");         // supprimer les tags HTML/PHP sauf les balises indiquées
  $result = htmlspecialchars($result);                        // pour encadrer les balises HTML par des doubles quotes
  // $result = nl2br($result);                                   // pour marquer les retours à la ligne
  // $result = str_replace("<br /><br />","<br />",$result);     // pour éviter les doubles retours à la ligne
  
  return $result;
}

















/*
function Xsy_Sql_DisplayFieldName($fieldName)
function Xsy_Sql_DisplayFieldValue($fieldName, $fieldValue='', $displayMode='Display', $refTable=NULL, $width='300px', $height='70px')
function Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE)
function Xsy_Sql_GetColumnsData($SQL_DATABASE, $SQL_TABLE)
function Xsy_Sql_GetRefTableData($SQL_DATABASE, $fieldName)
function Xsy_Sql_DisplaySqlTable($SQL_DATABASE, $SQL_TABLE)
function Xsy_Sql_DisplaySingleEntry($SQL_DATABASE, $SQL_TABLE, $displayMode="Display", $idEntry=0)

function XsySqlAddEntry($SQL_DATABASE, $SQL_TABLE)
function XsySqlModifyEntry($SQL_DATABASE, $SQL_TABLE)
function XsySqlDeleteEntry($SQL_DATABASE, $SQL_TABLE)

function Xsy_Sql_ManageTableData($SQL_TABLE)
*/





/** *********************************************************************************************************
 * display a field on screen
 **********************************************************************************************************/
function Xsy_Sql_DisplayFieldName($fieldName){

  // separate field type from field name
  $split = explode("_", $fieldName);
  
  // if there were a field, take the second part, otherwise, split 
  // has only one key: 0.
  $index = (stristr($fieldName, "_") != false) ? 1 : 0;
  // if field name contains "_"
  $field = "";
  for($i = $index; $i < count($split); $i++){
    $field .= $split[$i]."_";
  }
  $field = substr($field, 0, -1);

  // all "%" become space
  $field = str_replace("%"," ",$field);
  
  return $field;
}






/***********************************************************************************************************
 * display an SQL item for an add form (field type are case sensitive)
 * File   => formerly Img
 * ID
 * id
 * UpDT(Update date time)
 * Bool
 * Pwd
 * Txt
 * (default value)
 *
 * displayMode = Display | Update
 **********************************************************************************************************/
function Xsy_Sql_DisplayFieldValue($fieldName, $fieldValue='', $displayMode='Display', $refTable=NULL, $width='300px', $height='70px'){

  global $SQL_DATABASE;
  $item = "";

  // ---- a file needs to be uploaded --------------------------
  if (stristr($fieldName, "File") != FALSE){
    $item = ($displayMode == "Update") ? 
            "File Name (new file need to be manually reuploaded): <br /> <input type='text' name='$fieldName' style='width:$width;' value='$fieldValue'/>" :
            "<a href='$fieldValue'> $fieldValue </a>";   
  }


  // ---- ID can not be added, automatic -----------------------
  elseif (strstr($fieldName, "ID") != FALSE){
    $item = ($displayMode == "Update") ? "(auto increment value) <input type='hidden' name='$fieldName' value='$fieldValue' /> " : "<p> $fieldValue </p>";   
  }


  // ---- id is a reference to another table ------------------
  elseif (strstr($fieldName, "Id") != FALSE){

    // -- ref Table is not found
    if($refTable == NULL){
      $refTable = Xsy_Sql_GetRefTableData($SQL_DATABASE, $fieldName);
    }

    // if update, provide the the list
    if ($displayMode == "Update"){

      // --- get all names
      $allNamesRaw = Xsy_Sql_Query("SELECT `".$refTable['RefIdField']."`,`".$refTable['RefNameField']."` FROM `$SQL_DATABASE`.`".$refTable['RefTableName']."`");

      $item = "  <select name='$fieldName'>\n";
      while($itemName = Xsy_Sql_Fetch($allNamesRaw)) {
        $isSelected = ($fieldValue == $itemName[$refTable['RefIdField']]) ? "SELECTED" : "";
        $item    .= "  <option value='".$itemName[$refTable['RefIdField']]."' $isSelected>".$itemName[$refTable['RefNameField']]."</option>\n";
      }
      $item .= "  </select>\n";
    }

    // if display only, provide the selected value
    else{
      // --- get all names
      $allNamesRaw  = Xsy_Sql_FetchAll("SELECT `".$refTable['RefIdField']."`,`".$refTable['RefNameField']."` FROM `$SQL_DATABASE`.`".$refTable['RefTableName']."` WHERE `".$refTable['RefIdField']."`='".$fieldValue."'");
      $item         = $allNamesRaw[0][$refTable['RefNameField']];
    }
  }



  // ---- automatic update date
  elseif (stristr($fieldName, "UpDT") != false) {
    $item = ($displayMode == "Update") ? "(date/time automatically added)" : "<p> ".$fieldValue." </p>";
  }


  // ---- bool is only 1 or 0
  elseif (stristr($fieldName, "Bool") != false) {
    $item = ($displayMode == "Update") ? "  <select name='$fieldName' style='width:$width;'>
   <option value='1' ".(($fieldValue==1)? "SELECTED" : "").">True</option>
   <option value='0' ".(($fieldValue==0)? "SELECTED" : "").">False</option>
  </select>\n"  :
           "<p> ".(($fieldValue==1) ? "True" : "False" )."</p>";
  }


  // ---- a password is hidden for adding
  elseif (stristr($fieldName, "Pwd") != false) {
    $item = ($displayMode == "Update") ? "a password will be given. Please change it later." : "**********";
  }


  // ---- a txt field is requiered
  elseif (stristr($fieldName, "Text") != false) {
    $item = ($displayMode == "Update") ?
            "<textarea name='$fieldName' style='width:$width; height:$height;'>$fieldValue</textarea>" :
            "<p> $fieldValue </p>";
  }


  // ---- text value
  elseif (stristr($fieldName, "Txt") != false) {
    $item = ($displayMode == "Update") ?
            "<input type='text' name='$fieldName' value='$fieldValue' style='width:$width;'/>" :
            "<p> $fieldValue </p>";
  }

  // ---- integer or decimal value value
  elseif ((stristr($fieldName, "Int") != false) OR (stristr($fieldName, "Dble") != false)) {
    $item = ($displayMode == "Update") ?
            "<input type='text' name='$fieldName' value='$fieldValue' style='width:$width;'/>" :
            "<p> $fieldValue </p>";
  }

  // ----  WTF
  else {
    $item = ($displayMode == "Update") ? "<input type='text' name='$fieldName'  style='width:$width;' /> ==> ERROR: Field is incorrect : ".$fieldName :
             "<p> $fieldValue (ERROR: Field is incorrect : ".$fieldName.")</p>" ;
  }


  return $item;
}











/***********************************************************************************************************
 * Internal function : return all the field name in a array 
 **********************************************************************************************************/
function Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE){

  // retrieve all headers
  $query  = "SHOW COLUMNS FROM `$SQL_DATABASE`.`$SQL_TABLE`";
  $stmt   = Xsy_Sql_Query($query);

  // if not columns were found
  if ($stmt->rowCount() == 0){
    if ($_SESSION['useradmin']){
      echo("<div class='SQL_ERROR'> <p> No columns were found for table $SQL_TABLE: <br /> $query</p> </div>");
    }
    return FALSE;
  }

  // everything is OK, return the array
  $columnsHeaders;
  $i = 0;
  while ($aColHeader = Xsy_Sql_Fetch($stmt)){

      $columnsHeaders[$i]['FieldName'] = $aColHeader['Field'];

      // reference table !
      if (stristr($aColHeader['Field'], "Id") != FALSE){
        $columnsHeaders[$i]['RefTable'][] = Xsy_Sql_GetRefTableData($SQL_DATABASE, $aColHeader['Field']);
      }

      // go to next field
      $i++;
  }
  
  return $columnsHeaders;
}


/***********************************************************************************************************
 * Internal function : return all the field name in a array 
 **********************************************************************************************************/
function Xsy_Sql_GetColumnsData($SQL_DATABASE, $SQL_TABLE){

  $rawColData   = Xsy_Sql_Query("SELECT * FROM `$SQL_DATABASE`.`$SQL_TABLE`");
  $idFieldName  = Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE);
  $columnsData;

  // for all entries, sort entries by ID (PrimKey)
  while ($aColData = Xsy_Sql_Fetch($rawColData)){
    // for each entry, get all fields
    foreach ($aColData as $fieldName => $fieldValue){
      // add the field data
      $columnsData[$aColData[$idFieldName]][$fieldName] = $fieldValue;
    }
  }

  return $columnsData;
}


/***********************************************************************************************************
 * get reference table data
 **********************************************************************************************************/
function Xsy_Sql_GetRefTableData($SQL_DATABASE, $fieldName){

  $refTable = null;

  // just check but supposed to be a ref id field
  if (strstr($fieldName, "Id") != false){
   // -- get reference table name
    $split = explode("_", $fieldName);
    $ref_field_Name = "";
    for($i = 1; $i < count($split); $i++){
      $ref_field_Name .= $split[$i]."_";
    }
    $ref_field_Name = substr($ref_field_Name, 0, -1);
    $ref_table_Array = Xsy_Sql_FetchAll("
      SELECT `TABLE_NAME` FROM `information_schema`.`TABLES` 
      WHERE `TABLE_SCHEMA` = '$SQL_DATABASE' AND INSTR(`TABLE_NAME`,'_$ref_field_Name') != 0
      LIMIT 0,1");
    $ref_table_Name = $ref_table_Array[0]['TABLE_NAME'];

    // --- get field name
    $ref_field_Array  = Xsy_Sql_FetchAll("SHOW COLUMNS FROM `$SQL_DATABASE`.`$ref_table_Name` WHERE INSTR(field,'name') != 0");
    $ref_field_Name   = $ref_field_Array[0]['Field'];
    $ref_id_Array     = Xsy_Sql_FetchAll("SHOW COLUMNS FROM `$SQL_DATABASE`.`$ref_table_Name` WHERE INSTR(field,'id') != 0");
    $ref_id_Name      = $ref_id_Array[0]['Field'];
    $ref_field_Name   = ($ref_field_Name != "") ? $ref_field_Name : $ref_id_Name;

    $refTable['RefTableName'] = $ref_table_Name;
    $refTable['RefIdField']   = $ref_id_Name;
    $refTable['RefNameField'] = $ref_field_Name;
  }

  return $refTable;
}








/***********************************************************************************************************
 * Internal function : return all the field name in a array 
 **********************************************************************************************************/
function Xsy_Sql_DisplaySqlTable($SQL_DATABASE, $SQL_TABLE){

  $columnsHeader  = Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE);
  $columnsData    = Xsy_Sql_GetColumnsData($SQL_DATABASE, $SQL_TABLE);

  // ---- initialize table
  $strOutput = " <table border='1' style='margin:auto;background:#03092B; color:#A9D7DF;'>\n";

  // ---- table headers
  $strOutput .= "  <tr>\n";
  foreach($columnsHeader as $field){
    $strOutput .= "   <th> ".Xsy_Sql_DisplayFieldName($field['FieldName'])." </th>\n";
  }
  $strOutput .= "  <th> Action </th>\n";
  $strOutput .= "  </tr>\n";

  // ---- table data : for each entry
  foreach($columnsData as $idValue => $entry){
    $strOutput .= "  <tr>\n";
    // for all fields
    foreach($entry as $fieldName => $fieldValue){
      // $refTable   = (isset($fieldValue['RefTable'])) ? $fieldValue['RefTable'] : NULL;
      $refTable   = NULL;
      $strOutput .= "   <td> ".Xsy_Sql_DisplayFieldValue($fieldName, $fieldValue, 'Display', $refTable)." </td> \n";
    }
    // modify / deleteentry button
    $strOutput .= "  <td> <form method='post' action=''>\n";
    $strOutput .= "  <input type='hidden' name='XsySqlTableName' value='".$SQL_TABLE."' />\n";
    $strOutput .= "  <input type='hidden' name='XsySqlTableId' value='".$idValue."' />\n";
    $strOutput .= "  <input type='submit' name='XsySqlModifyEntry' value='Modify' />\n";
    $strOutput .= "  <input type='submit' name='XsySqlEntryDeleted' value='Delete' />\n";
    $strOutput .= "  </form> </td>\n";
    // close row / entry
    $strOutput .= "  </tr>\n";
  }

  // ----  close table
  $strOutput .= " </table>";

  // ---- add "add table forms"
  $formAddTable = " <form method='post' action=''> <input type='submit' name='XsySqlAddEntry' value='Add Entry' style=' width:50%;margin-left:25%; background:#03092B; color: #A9D7DF;'/> </form>\n";
  $strOutput = $formAddTable.$strOutput.$formAddTable;

  echo $strOutput;
}







/***********************************************************************************************************
 * Internal function : return all the field name in a array 
 **********************************************************************************************************/
function Xsy_Sql_DisplaySingleEntry($SQL_DATABASE, $SQL_TABLE, $displayMode="Display", $idEntry=0){

  $columnsHeader  = Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE);
  $strOutput      = "";

  // ---- it is update/add mode !
  if ($displayMode !== "Display"){
    $idFieldName  = Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE);
    $arrayEntry   = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$SQL_TABLE` WHERE `$idFieldName`='$idEntry'");
    $strOutput   .= " <form method='post' action=''>\n";
  }


  // ---- Default data
  $strOutput     .= " <table border='1'>";
  $strOutput     .= "  <tr>\n   <th> Field Name </th>\n   <th> Field Value </th>\n  </tr>\n";



  foreach($columnsHeader as $fieldName){  
    $strOutput  .= "  <tr>\n";
    $strOutput  .= "   <td> ".Xsy_Sql_DisplayFieldName($fieldName['FieldName'])." </td>\n";
    switch($displayMode){
      case "Add" :    $strOutput  .= "   <td> ".Xsy_Sql_DisplayFieldValue($fieldName['FieldName'], "", "Update", NULL)." </td>\n";
      break;
      case "Update" : $strOutput  .= "   <td> ".Xsy_Sql_DisplayFieldValue($fieldName['FieldName'], $arrayEntry[0][$fieldName['FieldName']], "Update", NULL)." </td>\n";
      break;
      case "Display" :$strOutput  .= "   <td> ".Xsy_Sql_DisplayFieldValue($fieldName['FieldName'], $arrayEntry[0][$fieldName['FieldName']], "Display", NULL)." </td>\n";
      break;
    }
    $strOutput  .= "   </td>\n";
    $strOutput  .= "  </tr>\n";

  }

  if ($displayMode == "Add"){
    $strOutput .= "  <tr> <td colspan='2'> <input type='submit' name='XsySqlEntryAdded' value='Add'></td> </tr>\n";
  }
  elseif ($displayMode == "Update"){
    $strOutput .= "  <tr> <td colspan='2'> <input type='submit' name='XsySqlEntryModified' value='Modify'></td> </tr>\n";
  }
  
  $strOutput .= " </table>";

  if ($displayMode != "Display"){
    $strOutput .= " </form>\n";
  }

  echo $strOutput;
}









// ===============================================================================
//
// ===============================================================================
function XsySqlAddEntry($SQL_DATABASE, $SQL_TABLE){

  // for each fields, retrieve $_POST value
  $fieldArray   = Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE);
  $entryData;

  foreach($fieldArray as $field){
    $entryData[$field['FieldName']] = (isset($_POST[$field['FieldName']])) ? $_POST[$field['FieldName']] : "";
  }

  return Xsy_Sql_Insert($SQL_DATABASE, $SQL_TABLE, $entryData);
}

// ===============================================================================
//
// ===============================================================================
function XsySqlModifyEntry($SQL_DATABASE, $SQL_TABLE){

  // id value
  $idFieldName  = Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE);
  $idFieldValue = $_POST[$idFieldName];

  // for each fields, retrieve $_POST value
  $fieldArray   = Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE);
  $entryData;

  foreach($fieldArray as $field){
    $entryData[$field['FieldName']] = (isset($_POST[$field['FieldName']])) ? $_POST[$field['FieldName']] : "";
  }

  return Xsy_Sql_Update($SQL_DATABASE, $SQL_TABLE, $entryData, $idFieldValue);
}

// ===============================================================================
//
// ===============================================================================
function XsySqlDeleteEntry($SQL_DATABASE, $SQL_TABLE){

  // for each fields, retrieve $_POST value
  $idFieldName  = Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE);
  $idFieldValue = $_POST['XsySqlTableId'];
  return Xsy_Sql_Delete($SQL_DATABASE, $SQL_TABLE, $idFieldName, $idFieldValue);
}


 




// =========================== DISPLAY A TABLE ================================ //
   
/*******************************************************************************************************
 * Display a SQL table content as a list table: for one item:
 *
 * +---------+-------------+
 * |   ID    |             |
 * +---------+-------------+
 * |  title  |    title    | 
 * +---------+-------------+
 * | content |   content   |
 * +---------+-------------+
 * |    ..   |     ...     |
 * +---------+-------------+
 */
function Xsy_Sql_ManageTableData($SQL_TABLE){

  // $action      =(isset($_POST['action'])) ? $_POST['action'] : "Display";
  // $root      = $_SERVER['HTTP_HOST'];
  // $currentPage  = 'http://'.$root.$_SERVER['PHP_SELF'];
  global $SQL_DATABASE;
  

  // ---- Entry is added and then display the whole table
  if(isset($_POST['XsySqlEntryAdded'])){
    XsySqlAddEntry($SQL_DATABASE, $SQL_TABLE);
    Xsy_Sql_DisplaySqlTable($SQL_DATABASE, $SQL_TABLE);
  }

  // ---- Entry is modified and then display the whole table
  elseif(isset($_POST['XsySqlEntryModified'])){
    XsySqlModifyEntry($SQL_DATABASE, $SQL_TABLE);
    Xsy_Sql_DisplaySqlTable($SQL_DATABASE, $SQL_TABLE);
  }

  // ---- Entry is deleted and then display the whole table
  elseif(isset($_POST['XsySqlEntryDeleted'])){
    XsySqlDeleteEntry($SQL_DATABASE, $SQL_TABLE);
    Xsy_Sql_DisplaySqlTable($SQL_DATABASE, $SQL_TABLE);
  }

  // ---- Display the "add entry" form
  elseif(isset($_POST['XsySqlAddEntry'])){
    Xsy_Sql_DisplaySingleEntry($SQL_DATABASE, $SQL_TABLE, "Add");
  }

  // ---- Display the "modify entry" form
  elseif(isset($_POST['XsySqlModifyEntry'])){
    $idValue = $_POST['XsySqlTableId'];
    Xsy_Sql_DisplaySingleEntry($SQL_DATABASE, $SQL_TABLE, "Update", $idValue);
  }

  // ---- Nothing special, display it
  else{
    Xsy_Sql_DisplaySqlTable($SQL_DATABASE, $SQL_TABLE);
  }

}































/* ====================================================================================================
 *
 *  - SQL manager (manage table data display)
 *
 * ====================================================================================================
 */


// ====================================================================== //
// Input is like "all". Wildcard is assumed to be not set.
//
// ====================================================================== //
function sqlManager($sqlTableRootName){

  global $XSY_SQL_PDO;



  // Action on table has to be done?
  if (isset($_POST['XsySqlRenameTable'])){
    Xsy_Sql_RenameTableInOld($_POST['XsySqlDbName'], $_POST['XsySqlTableName']);
  }
  if (isset($_POST['XsySqlDeleteTable'])){
    Xsy_Sql_DeleteTable($_POST['XsySqlDbName'], $_POST['XsySqlTableName']);
  }
  if (isset($_POST['XsySqlExportTable'])){
    Xsy_Sql_ExportTable($_POST['XsySqlDbName'], $_POST['XsySqlTableName']);
  }






  // ===MCV=== :: Model
  $rawTable   = null;
  $rawColumn  = null;
  $rawEntry   = null;

  $rawTable = $XSY_SQL_PDO->query("SELECT * FROM `information_schema`.`tables` WHERE `table_name` LIKE '%".$sqlTableRootName."%'");

  // for all tables
  while($table = $rawTable->fetch(PDO::FETCH_ASSOC)){
    // Intialize array
    $tableData[$table['TABLE_NAME']]['Info']  = "  <p>\n";
    $tableData[$table['TABLE_NAME']]['Field'] = "  <table border='1'>\n";
    $tableData[$table['TABLE_NAME']]['Entry'] = "  <table border='1'>\n";
    $tableData[$table['TABLE_NAME']]['NameDb'] = $table['TABLE_SCHEMA'];
    
    // =============      Look for table info (create, rows...)    ========== //
    $tableData[$table['TABLE_NAME']]['Info']  .= "Number of Entries: ".$table['TABLE_ROWS']." <br />";
    $tableData[$table['TABLE_NAME']]['Info']  .= "Created on: ".$table['CREATE_TIME']." <br />";

    // =============      Look for table data (field, type...)     ========== //

    // look for all columns:
    $rawColumn  = $XSY_SQL_PDO->query("SHOW COLUMNS FROM `".$table['TABLE_SCHEMA']."`.`".$table['TABLE_NAME']."`");

    // table fields header
    $tableData[$table['TABLE_NAME']]['Field'] .= "  <tr>\n";
    $tableData[$table['TABLE_NAME']]['Field'] .= "   <th> Field Name</th>\n";
    $tableData[$table['TABLE_NAME']]['Field'] .= "   <th> Data Type</th>\n";
    $tableData[$table['TABLE_NAME']]['Field'] .= "   <th> Null </th>\n";
    $tableData[$table['TABLE_NAME']]['Field'] .= "   <th> Key</th>\n";
    $tableData[$table['TABLE_NAME']]['Field'] .= "   <th> Default</th>\n";
    $tableData[$table['TABLE_NAME']]['Field'] .= "   <th> Extra</th>\n  </tr>\n";
    $tableData[$table['TABLE_NAME']]['Field'] .= "  </tr>\n";
    // table entry header fill
    $tableData[$table['TABLE_NAME']]['Entry'] .= "  <tr>\n";
    // table fields : list all fields name, type, is null, primkey, default value and extra
    foreach($rawColumn as $column){
      $tableData[$table['TABLE_NAME']]['Field'] .= "   <tr> \n";
      $tableData[$table['TABLE_NAME']]['Field'] .= "   <td> ".$column['Field']." </td>\n";
      $tableData[$table['TABLE_NAME']]['Field'] .= "   <td> ".$column['Type']." </td>\n";
      $tableData[$table['TABLE_NAME']]['Field'] .= "   <td> ".$column['Null']." </td>\n";
      $tableData[$table['TABLE_NAME']]['Field'] .= "   <td> ".$column['Key']." </td>\n";
      $tableData[$table['TABLE_NAME']]['Field'] .= "   <td> ".$column['Default']." </td>\n";
      $tableData[$table['TABLE_NAME']]['Field'] .= "   <td> ".$column['Extra']." </td>\n";
      $tableData[$table['TABLE_NAME']]['Field'] .= "   </tr> \n";
      $tableData[$table['TABLE_NAME']]['Entry'] .= "   <th> ".$column['Field']." </th>\n";
    }
    $tableData[$table['TABLE_NAME']]['Entry'] .= "  </tr>\n";


    // =============      Look for all entries                       ========== //
    $rawEntry = $XSY_SQL_PDO->query("SELECT * FROM `".$table['TABLE_SCHEMA']."`.`".$table['TABLE_NAME']."`");
    $rawEntry->setFetchMode(PDO::FETCH_ASSOC);

    // for each entry
    foreach($rawEntry->fetchAll() as $entry){
     $tableData[$table['TABLE_NAME']]['Entry'] .= "  <tr>\n";
     // go through all fields
     foreach($entry as $field => $value){
      $tableData[$table['TABLE_NAME']]['Entry'] .= "   <td> ".$value." </td>\n";
     }
     $tableData[$table['TABLE_NAME']]['Entry'] .= "  </tr>\n";
    }


    $tableData[$table['TABLE_NAME']]['Info']  .= "  </p>\n";
    $tableData[$table['TABLE_NAME']]['Field'] .= "  </table>\n";
    $tableData[$table['TABLE_NAME']]['Entry'] .= "  </table>\n";

  }






  // print_r($tableData);

  // ===MCV=== :: View
  foreach ($tableData as $tableName => $singleTableData){

    echo(" <div class='sqlManager_Table' id='SqlTable".$tableName."'>\n");
    echo("  <div class='sqlManager_TableMngt'>\n");
    echo("  <table>\n   <tr>\n");
    echo("    <td> <p id='SqlTableName".$tableName."'> ".$tableName."</p> </td>\n");
    echo("    <td> <form method='post' action=''>\n");
    echo("    <input type='hidden' name='XsySqlDbName'    value='".$singleTableData['NameDb']."' />\n");
    echo("    <input type='hidden' name='XsySqlTableName' value='$tableName' />\n");
    echo("    <input type='submit' name='XsySqlRenameTable' value='Rename SQL Table' />\n");
    echo("    <input type='submit' name='XsySqlDeleteTable' value='Delete SQL Table' />\n");
    echo("    <input type='submit' name='XsySqlExportTable' value='Export SQL Table' />\n");
    echo("    </form> </td> \n");
    echo("  </tr> </table>\n");
    echo("  </div>\n");
    echo("  <div class='sqManager_TableInfo' id='SqlTableInfo".$tableName."'>\n".$singleTableData['Info']."\n  </div>\n");
    echo("  <div class='sqManager_TableData' id='SqlTableData".$tableName."'>\n".$singleTableData['Field']."\n  </div>\n");
    echo("  <div class='sqlManage_TableEntry' id='SqlTableEntry".$tableName."'>\n".$singleTableData['Entry']."\n  </div>\n");
    echo(" </div>\n");

  }

}









// ====================================================================== //
//
// ====================================================================== //
function Xsy_Sql_RenameTableInOld($nameDb, $nameTable){
  
  global $XSY_SQL_PDO;
  Xsy_Sql_Query("DROP TABLE IF EXISTS `".$nameDb."`.`".$nameTable."_old`");
  Xsy_Sql_Query("RENAME TABLE  `".$nameDb."`.`".$nameTable."` TO  `".$nameDb."`.`".$nameTable."_old`");

}


// ====================================================================== //
//
// ====================================================================== //
function Xsy_Sql_DeleteTable($nameDb, $nameTable){
  
  global $SQL_PDO;
  Xsy_Sql_Query("DROP TABLE IF EXISTS `".$nameDb."`.`".$nameTable."`");

}


// ====================================================================== //
//
// ====================================================================== //
function Xsy_Sql_ExportTable($nameDb, $nameTable){

  // in txt format
  $strOutputTable  = "CREATE TABLE IF NOT EXISTS `$nameDb`.`$nameTable` (\n";
  $strOutputEntry  = "INSERT INTO `$nameDb`.`$nameTable` (";
  $allField[0]= "";
  $allType[0] = "";
  $i          = 0;
  $iMax       = 0;


  // retrieves all data
  $stmt = Xsy_Sql_Query("SHOW COLUMNS FROM `$nameDb`.`$nameTable`");
  while ($anEntry = Xsy_Sql_Fetch($stmt)){
  
    // for the table creation
    $strOutputTable .= " `".$anEntry['Field']. "` ".$anEntry['Type'];
    $strOutputTable .= ($anEntry['Null'] == "No") ? " NOT NULL " : "";
    $strOutputTable .= ($anEntry['Default'] != "") ? " DEFAULT ".$anEntry['Default']." " : "";
    $strOutputTable .= " ".$anEntry['Extra'].",\n";
    $strOutputTable .= ($anEntry['Key'] == "PRI") ? "PRIMARY KEY (`".$anEntry['Field']."`),\n" : "";
  
    // for the entries
    $strOutputEntry .= "`".$anEntry['Field']."`, ";
    $allField[$i] = $anEntry['Field'];
    $allType[$i]  = $anEntry['Type'];
    $i++;
  }

  // remove last comma
  $strOutputTable = substr($strOutputTable, 0, -2).")";
  $strOutputEntry = substr($strOutputEntry, 0, -2);
  $strOutputEntry .= ") VALUES\n";
  $iMax = $i;

  
  // retrieves all data
  $stmt = Xsy_Sql_Query("SELECT * FROM `$nameDb`.`$nameTable`");
  while ($anEntry = Xsy_Sql_Fetch($stmt)){
    $strOutputEntry .= "(";
    // check through all fields
    for ($i = 0; $i < $iMax; $i++){
      // check if entry if a varchar
      if ( strstr($allType[$i], "varchar") !== FALSE ){
        $strOutputEntry .= "'".str_replace("'", "''", $anEntry[$allField[$i]])."'";
      }
      elseif (strstr($allType[$i], "timestamp") !== FALSE){
        $strOutputEntry .= "'".$anEntry[$allField[$i]]."'";
      }
      // if not, no need to add "'"
      else{
        $strOutputEntry .= $anEntry[$allField[$i]];
      }
      $strOutputEntry .= ", ";
    }
    // remove last commas
    $strOutputEntry = substr($strOutputEntry, 0, -2);
    $strOutputEntry .= "),\n";
  }
  $strOutputEntry =substr($strOutputEntry, 0, -2);
  $strOutputEntry .= ";";


  // export to a local file
  $fileName     = "XsySqlDB_Export_".Date("Ymd_Hi")."_".$nameTable.".sql";
  $fileHandler  = fopen($fileName, "w+");
  fwrite($fileHandler, $strOutputTable."\n\n".$strOutputEntry);
  fclose($fileHandler);

  // force txt file download
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename='.basename($fileName));
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($fileName));
  ob_clean();
  flush();
  readfile($fileName);
  
  // delete txt file from server
  unlink($fileName);
}


?>