<?php

/* #####################################################################################################
 *  - SQL methods (insert, delete)

function Xsy_Sql_Query($query)
function Xsy_Sql_Fetch($stmt, $fetchMode = PDO::FETCH_ASSOC)
function Xsy_Sql_FetchAll($query, $fetchMode = PDO::FETCH_ASSOC)
function Xsy_Sql_Insert($SQL_DATABASE, $SQL_TABLE, $valueArray)
function Xsy_Sql_Update($SQL_DATABASE, $SQL_TABLE, $valueArray, $idValue)
function Xsy_Sql_Delete($SQL_DATABASE, $SQL_TABLE, $field, $value)
function Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE)
function Xsy_Sql_Escape($strEntry)
function Xsy_Sql_RowCount($pdoStatement)
function Xsy_Sql_CheckCount($table, $conditions)

 * #####################################################################################################

 *  - SQL Table management
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

function Xsy_Sql_ManageTableData($SQL_TABLE, $conditionArray=NULL, $selectedField=NULL, $textArray=NULL)
 * #####################################################################################################

 *  - SQL table with file as txt field (no upload management)
function Xsy_Sql_ManageTableWithFiles($SQL_TABLE, $fileArray, $mappingArray)
function Xsy_Sql_CheckTableWithFiles($SQL_TABLE, $fileArray)
function Xsy_Sql_AddIntoTableWithFiles($SQL_TABLE, $fileArray, $mappingArray)
function Xsy_Sql_UpdateTableWithFiles($SQL_TABLE, $fileArray, $mappingArray)
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

    $errorMessage = $_SESSION['UserAdmin'] ? 
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
    $errorMessage = $_SESSION['UserAdmin'] ? 
                  "<p>PDO MYSQL REQUEST ERROR in Xsy_Sql_Fetch: <br /> $stmt is not defined </i></p>" :
                  "<p>SQL object is not defined while fetch. Please report it to the administrator.</p>";
    echo $errorMessage;
    return FALSE;
  }

  try{
    $fetchedResult = $stmt->fetch($fetchMode);
  }
  catch(PDOException $excep){
    $errorMessage = $_SESSION['UserAdmin'] ? 
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
    if ($_SESSION['UserAdmin']){
      echo("<div class='SQL_ERROR'> <p> No entry for query: <br /> $query</p> </div>");
    }
    return FALSE;
  }

  try{
    $fetched  = $stmt->fetchAll($fetchMode);
  }
  catch(PDOException $except){
    $errorMessage = $_SESSION['UserAdmin'] ? 
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
  // echo($updateQuery);
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
  // echo("SHOW COLUMNS FROM `".$SQL_DATABASE."`.`".$SQL_TABLE."` WHERE `Key`='PRI'");
  if ($stmt->rowCount() == 0){
    if ($_SESSION['UserAdmin']){
      echo("<div class='SQL_ERROR'> <p>Primary key was not found for table $SQL_TABLE</p> </div>");
    }
    return FALSE;
  }
  elseif( $stmt->rowCount() > 1){
    if ($_SESSION['UserAdmin']){
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

  return $pdoStatement->columnCount();
  
}

// =========================================================
// check if entry is not null
// return boolean
// =========================================================
function Xsy_Sql_CheckCount($table, $conditions){

  $check_query = "
    SELECT COUNT(*)
    FROM ".$table." ".$conditions;
  $check_fetch = Xsy_Sql_FetchAll($check_query);
  $check_count = $check_fetch[0]['COUNT(*)'];
  return ($check_count > 0);
}




















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
  $field = Xsy_Glob_EscapeString($field, array("%"=>" "));
  
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
function Xsy_Sql_DisplayFieldValue($fieldName, $fieldValue='', $displayMode='Display', $selectedField=NULL, $refTable=NULL){

  global $SQL_DATABASE, $XSY_SESS_ADMINLEVEL;
  $item = "";

  // ---- a file needs to be uploaded -------------------------- ==> not handled anymore !!!! (Aug 2014)
  // if (stristr($fieldName, "File_") != FALSE){
    // $item = ($displayMode == "Update") ? 
            // "<a href='$fieldValue'> $fieldValue </a> <br /> New File: <input type='file' name='$fieldName' />" :
            // "<a href='$fieldValue'> $fieldValue </a>";   
  // }
  // elseif (strstr($fieldName, "ID_") != FALSE){ ==> because first "if" instance is removed


  // ---- ID can not be added, automatic -----------------------
  if (strstr($fieldName, "ID_") != FALSE){
    $item = ($displayMode == "Update") ? "(auto increment value) <input type='hidden' name='$fieldName' value='$fieldValue' /> " : "<p> $fieldValue </p>";   
  }


  // ---- id is a reference to another table ------------------
  elseif (strstr($fieldName, "Id_") != FALSE){

    // -- ref Table is not found
    if($refTable == NULL){
      $refTable = Xsy_Sql_GetRefTableData($SQL_DATABASE, $fieldName);
    }

    // if update, provide the the list
    if ($displayMode == "Update"){

      // --- get all names
      $whereCond = "";
      if ($selectedField!==NULL AND isset($selectedField['WHERE'])){
        foreach($selectedField['WHERE'] as $fieldWhereName=>$fieldWhereValue){
          $whereCond = ($whereCond=="") ? "WHERE `$fieldWhereName`='$fieldWhereValue'" : $whereCond." AND `$fieldWhereName`='$fieldWhereValue'";
        }
      }
      $allNamesRaw = Xsy_Sql_Query("SELECT `".$refTable['RefIdField']."`,`".$refTable['RefNameField']."` FROM `$SQL_DATABASE`.`".$refTable['RefTableName']."` $whereCond");

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



  // ---- manual date entry
  elseif (stristr($fieldName, "Dat_") != false) {
    $item = ($displayMode == "Update") ?
            "<input type='date' name='$fieldName' ".( ($fieldValue !='')? "value='$fieldValue'" : "")." />" :
            "<p> $fieldValue </p>";
  }


  // ---- automatic update date
  elseif (stristr($fieldName, "UpDT_") != false){
    $item = ($displayMode == "Update") ? "(date/time automatically added) <input type='hidden' name='$fieldName' value='".date("Y-m-d H:i:s")."' />" : "<p> ".$fieldValue." </p>";
  }


  // ---- bool is only 1 or 0
  elseif (stristr($fieldName, "Bool_") != false) {
    $item = ($displayMode == "Update") ? "  <select name='$fieldName' '>
   <option value='1' ".(($fieldValue==1)? "SELECTED" : "").">True</option>
   <option value='0' ".(($fieldValue==0)? "SELECTED" : "").">False</option>
  </select>\n"  :
           "<p> ".(($fieldValue==1) ? "True" : "False" )."</p>";
  }


  // ---- a password is hidden for adding ==> only admin can change it
  elseif (stristr($fieldName, "Pwd_") != false) {
    if($_SESSION['UserLevel'] >= $XSY_SESS_ADMINLEVEL){
    $item = ($displayMode == "Update") ? "<input type='text' name='$fieldName' ".( ($fieldValue !='')? "value='$fieldValue'" : "")." '/>" : "<p> $fieldValue </p>";
    }
    else{
    $item = ($displayMode == "Update") ? "a password will be given. Please change it later." : "**********";
    }
  }


  // ---- a txt field is requiered
  elseif (stristr($fieldName, "Text_") != false) {
    $item = ($displayMode == "Update") ?
            "<textarea name='$fieldName'>$fieldValue</textarea>" :
            "<p> $fieldValue </p>";
  }


  // ---- text value
  elseif (stristr($fieldName, "Txt_") != false) {
    $item = ($displayMode == "Update") ?
            "<input type='text' name='$fieldName' ".( ($fieldValue !='')? "value='$fieldValue'" : "")." />" :
            "<p> $fieldValue </p>";
  }

  // ---- url value
  elseif (stristr($fieldName, "Url_") != false) {
    $item = ($displayMode == "Update") ?
            "<input type='url' name='$fieldName' ".( ($fieldValue !='')? "value='$fieldValue'" : "")." />" :
            "<p> <a href='$fieldValue'> $fieldValue </a> </p>";
  }

  // ---- integer or decimal value value
  elseif ((stristr($fieldName, "Int_") != false) OR (stristr($fieldName, "Dble") != false)) {
    $item = ($displayMode == "Update") ?
            "<input type='number' step='any' name='$fieldName' ".( ($fieldValue != 0)? "value='$fieldValue'" : "")." />" :
            "<p> $fieldValue </p>";
  }

  // ----  WTF
  else {
    $item = ($displayMode == "Update") ? "<input type='text' name='$fieldName' /> ==> ERROR: Field is incorrect : ".$fieldName :
             "<p> $fieldValue (ERROR: Field is incorrect : ".$fieldName.")</p>" ;
  }


  return $item;
}











/***********************************************************************************************************
 * Internal function : return all the field name in a array 
 **********************************************************************************************************/
function Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE){

  // check if table or database is empty
  if($SQL_DATABASE=="" OR $SQL_TABLE==""){
    if ($_SESSION['UserAdmin']){
      echo("<div class='SQL_ERROR'> <p> SQL Database ($SQL_DATABASE) or SQL Table ($SQL_TABLE) is not defined </p> </div>");
    }
    return FALSE;
  }

  // retrieve all headers
  $query  = "SHOW COLUMNS FROM `$SQL_DATABASE`.`$SQL_TABLE`";
  $stmt   = Xsy_Sql_Query($query);

  // if not columns were found
  if ($stmt->rowCount() == 0){
    if ($_SESSION['UserAdmin']){
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
function Xsy_Sql_GetColumnsData($SQL_DATABASE, $SQL_TABLE, $conditionArray, $selectedField, $textArray){

  $fields       = "*";
  $whereCond    = "";
  $orderCond    = "";
  $idFieldName  = Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE);
  $primKeyIncl  = TRUE;
  // limited fields
  if($selectedField!==NULL){

    foreach($selectedField as $index=>$fieldName){
      $fields = ($fields=="*") ? "`".$idFieldName."`, `".$fieldName['FieldName']."`" : $fields.",`".$fieldName['FieldName']."`" ;
    }
    // primary key is included ?
    if (!isset($selectedField[$idFieldName])){
      $primKeyIncl = FALSE;
      $fields     .= ",`".$idFieldName."`";
    }
  }
  // where restriction
  if(isset($conditionArray['WHERE']) AND $conditionArray['WHERE']!==NULL){
    foreach($conditionArray['WHERE'] as $fieldName=>$fieldRestriction){
      $whereCond .= ($whereCond=="") ? "WHERE `$SQL_TABLE`.`$fieldName`='$fieldRestriction'" : "AND `$SQL_TABLE`.`$fieldName`='$fieldRestriction'";
    }
  }
  // ordering !
  if(isset($conditionArray['ORDER BY']) AND $conditionArray['ORDER BY']!==NULL){
    foreach($conditionArray['ORDER BY'] as $fieldName=>$fieldOrdering){
      $orderCond .= ($orderCond=="") ? "ORDER BY `$SQL_TABLE`.`$fieldName` $fieldOrdering" : ", `$SQL_TABLE`.`$fieldName` $fieldOrdering";
    }
  }

  $rawColData   = Xsy_Sql_Query("SELECT ".$fields." FROM `$SQL_DATABASE`.`$SQL_TABLE` ".$whereCond." ".$orderCond);

  $columnsData;

  // for all entries, sort entries by ID (PrimKey)
  while ($aColData = Xsy_Sql_Fetch($rawColData)){
    // for each entry, get all fields
    foreach ($aColData as $fieldName => $fieldValue){
      // add the field data, if it isn't an unexpected id field
      if($primKeyIncl OR ($fieldName!==$idFieldName)){
        $columnsData[$aColData[$idFieldName]][$fieldName] = $fieldValue;
      }
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
function Xsy_Sql_DisplaySqlTable($SQL_DATABASE, $SQL_TABLE, $conditionArray, $selectedField, $textArray){

  global $XSY_SQL_TABLE_IS_EMPTY;

  // where restriction
  $whereCond = "";
  if(isset($conditionArray['WHERE']) AND $conditionArray['WHERE']!==NULL){
    foreach($conditionArray['WHERE'] as $fieldName=>$fieldRestriction){
      $whereCond .= ($whereCond=="") ? "WHERE `$SQL_TABLE`.`$fieldName`='$fieldRestriction'" : "AND `$SQL_TABLE`.`$fieldName`='$fieldRestriction'";
    }
  }

  // ---- check if table is empty or not
  $checkQuery     = "SELECT COUNT(*) FROM `$SQL_DATABASE`.`$SQL_TABLE` $whereCond";
  $checkFetch     = Xsy_Sql_FetchAll($checkQuery);
  $checkCount     = $checkFetch[0]['COUNT(*)'];
  if($checkCount==0){
    return "<p> ".$XSY_SQL_TABLE_IS_EMPTY." </p>";
  }

  $columnsHeader  = ($selectedField==NULL) ? Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE) : $selectedField;
  $columnsData    = Xsy_Sql_GetColumnsData($SQL_DATABASE, $SQL_TABLE, $conditionArray, $selectedField, $textArray);

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
    $strOutput .= "  <input type='submit' name='XsySqlModifyEntry' value='".( (isset($textArray['DispPage']['UpdEntry'])) ? $textArray['DispPage']['UpdEntry'] : "Modify" )."' />\n";
    $strOutput .= "  <input type='submit' name='XsySqlEntryDeleted' value='".( (isset($textArray['DispPage']['DelEntry'])) ? $textArray['DispPage']['DelEntry'] : "Delete" )."' />\n";
    $strOutput .= "  </form> </td>\n";
    // close row / entry
    $strOutput .= "  </tr>\n";
  }

  // ----  close table
  $strOutput .= " </table>";

  return $strOutput;
}







/***********************************************************************************************************
 * Internal function : return all the field name in a array 
 **********************************************************************************************************/
function Xsy_Sql_DisplaySingleEntry($SQL_DATABASE, $SQL_TABLE, $displayMode="Display", $selectedField=NULL, $textArray=NULL, $idEntry=0){

  $columnsHeader  = ($selectedField==NULL) ? Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE) : $selectedField;
  $strOutput      = "";
  $primKeyIncl    = TRUE;

  // ---- if form needs value
  if ($displayMode !== "Add"){
    $idFieldName  = Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE);
    $fields       = "";
    if($selectedField!==NULL){
      // retrieve selected fields
      foreach($selectedField as $index=>$fieldName){
        $fields = ($fields=="") ? "`".$fieldName['FieldName']."`" : $fields.", `".$fieldName['FieldName']."`";
      }
      // check if prim key is here or not
      if (!isset($selectedField[$idFieldName])){
        $fields .= ", `".$idFieldName."`";
        $primKeyIncl = FALSE;
      }
    }
    else{
      $fields = "*";
    }
    $arrayEntry   = Xsy_Sql_FetchAll("SELECT ".$fields." FROM `$SQL_DATABASE`.`$SQL_TABLE` WHERE `$idFieldName`='$idEntry'");
  }

  // ---- it is update/add mode !
  if ($displayMode !== "Display"){
    $strOutput   .= " <div id='Xsy_Sql_Form'>\n <form method='post' action=''>\n";
  }

  if ($displayMode == "Add"){
    $strOutput .= ( (isset($textArray['DispItem']['IntroAdd'])) ? $textArray['DispItem']['IntroAdd'] : "" );
  }
  elseif($displayMode == "Update"){
    $strOutput .= ( (isset($textArray['DispItem']['IntroUpd'])) ? $textArray['DispItem']['IntroUpd'] : "" );
  }
  elseif($displayMode == "Display"){
    $strOutput .= ( (isset($textArray['DispItem']['IntroDis'])) ? $textArray['DispItem']['IntroDis'] : "");
  }

  // ---- Default data
  $strOutput     .= " <table border='1'>";
  // $strOutput     .= "  <tr>\n   <th> Field Name </th>\n   <th> Field Value </th>\n  </tr>\n";

  // ---- primary key is not included so it is added as a hidden input
  if (!$primKeyIncl){
    $strOutput   .= " <input type='hidden' name='".$idFieldName."' value='".$arrayEntry[0][$idFieldName]."' /> ";
  }

  // for all headers ...
  foreach($columnsHeader as $fieldName){  
    $strOutput  .= "  <tr>\n";
    $strOutput  .= "   <td> ".Xsy_Sql_DisplayFieldName($fieldName['FieldName'])." </td>\n";
    switch($displayMode){
      case "Add" :    $strOutput  .= "   <td> ".Xsy_Sql_DisplayFieldValue($fieldName['FieldName'], "", "Update", $selectedField, NULL)." </td>\n";
      break;
      case "Update" : $strOutput  .= "   <td> ".Xsy_Sql_DisplayFieldValue($fieldName['FieldName'], $arrayEntry[0][$fieldName['FieldName']], "Update", $selectedField, NULL)." </td>\n";
      break;
      case "Display" :$strOutput  .= "   <td> ".Xsy_Sql_DisplayFieldValue($fieldName['FieldName'], $arrayEntry[0][$fieldName['FieldName']], "Display", $selectedField, NULL)." </td>\n";
      break;
    }
    $strOutput  .= "   </td>\n";
    $strOutput  .= "  </tr>\n";

  }

  if ($displayMode == "Add"){
    $strOutput .= "  <tr> <td colspan='2'> <input type='submit' name='XsySqlEntryAdded' value='".( (isset($textArray['DispItem']['AddEntry'])) ? $textArray['DispItem']['AddEntry'] : "Add entry" )."' class='Xsy_Sql_Button' /></td> </tr>\n";
  }
  elseif ($displayMode == "Update"){
    $strOutput .= "  <tr> <td colspan='2'> <input type='submit' name='XsySqlEntryModified' value='".( (isset($textArray['DispItem']['UpdEntry'])) ? $textArray['DispItem']['UpdEntry'] : "Update entry" )."' class='Xsy_Sql_Button' /></td> </tr>\n";
  }
  
  $strOutput .= " </table>";

  if ($displayMode != "Display"){
    $strOutput .= " <p> <a href=''> ".( (isset($textArray['DispItem']['Cancel'])) ? $textArray['DispItem']['Cancel'] : "Click here to cancel" )." </a> </p>\n";
    $strOutput .= " </div>\n </form>\n";
  }

  return $strOutput;
}









// ===============================================================================
//
// ===============================================================================
function XsySqlAddEntry($SQL_DATABASE, $SQL_TABLE, $conditionArray){

  // for each fields, retrieve $_POST value
  $fieldArray   = Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE);
  $entryData;

  foreach($fieldArray as $field){

    if(isset($_POST[$field['FieldName']])){
      $entryData[$field['FieldName']] = Xsy_Glob_Get($field['FieldName']);
    }
  }

  if (isset($conditionArray['Constant'])){
    foreach($conditionArray['Constant'] as $fieldName=>$fieldValue){
      $entryData[$fieldName] = $fieldValue;
    }
  }


  return Xsy_Sql_Insert($SQL_DATABASE, $SQL_TABLE, $entryData);
}

// ===============================================================================
//
// ===============================================================================
function XsySqlModifyEntry($SQL_DATABASE, $SQL_TABLE, $conditionArray){

  // id value
  $idFieldName  = Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE);
  $idFieldValue = $_POST[$idFieldName];

  // for each fields, retrieve $_POST value
  $fieldArray   = Xsy_Sql_GetColumnsHeader($SQL_DATABASE, $SQL_TABLE);
  $entryData;

  foreach($fieldArray as $field){
    $entryData[$field['FieldName']] = (isset($_POST[$field['FieldName']])) ? Xsy_Glob_Get($field['FieldName']) : "";
  }

  if (isset($conditionArray['Constant'])){
    foreach($conditionArray['Constant'] as $fieldName=>$fieldValue){
      $entryData[$fieldName] = $fieldValue;
    }
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
 *
 * conditionArray looks like conditionArray['WHERE'] = ""; conditionArray['ORDER BY']['FieldName'] = "Desc" ...

 */
function Xsy_Sql_ManageTableData($SQL_TABLE, $conditionArray=NULL, $selectedField=NULL, $textArray=NULL){

  // $action      =(isset($_POST['action'])) ? $_POST['action'] : "Display";
  // $root      = $_SERVER['HTTP_HOST'];
  // $currentPage  = 'http://'.$root.$_SERVER['PHP_SELF'];
  global $SQL_DATABASE;
  $buttonAdd    = " <form method='post' action=''> <input type='submit' name='XsySqlAddEntry' value='".( (isset($textArray['DispPage']['AddEntry'])) ? $textArray['DispPage']['AddEntry'] : "Add Entry" )."' /> </form>\n";

  // ---- Entry is added and then display the whole table
  if(isset($_POST['XsySqlEntryAdded'])){
    $sqlQuery = XsySqlAddEntry($SQL_DATABASE, $SQL_TABLE, $conditionArray);
    if ($sqlQuery){
      echo((isset($textArray['SqlItem']['AddOk'])) ? $textArray['SqlItem']['AddOk'] : "<p> Entry correctly inserted </p>" );
    }
    else{
      echo((isset($textArray['SqlItem']['AddErr'])) ? $textArray['SqlItem']['AddErr'] : "<p> Entry insertion error </p>" );
    }
  }

  // ---- Entry is modified and then display the whole table
  elseif(isset($_POST['XsySqlEntryModified'])){
    $sqlQuery = XsySqlModifyEntry($SQL_DATABASE, $SQL_TABLE, $conditionArray);
    if ($sqlQuery){
      echo((isset($textArray['SqlItem']['UpdOk'])) ? $textArray['SqlItem']['UpdOk'] : "<p> Entry correctly modified </p>" );
    }
    else{
      echo((isset($textArray['SqlItem']['UpdErr'])) ? $textArray['SqlItem']['UpdErr'] : "<p> Entry modification error </p>" );
    }
  }

  // ---- Entry is deleted and then display the whole table
  elseif(isset($_POST['XsySqlEntryDeleted'])){
    $sqlQuery = XsySqlDeleteEntry($SQL_DATABASE, $SQL_TABLE);
    if ($sqlQuery){
      echo((isset($textArray['SqlItem']['DelOk'])) ? $textArray['SqlItem']['DelOk'] : "<p> Entry correctly deleted </p>" );
    }
    else{
      echo((isset($textArray['SqlItem']['DelErr'])) ? $textArray['SqlItem']['DelErr'] : "<p> Entry deletion error </p>" );
    }
  }

  // ---- Display the "add entry" form
  elseif(isset($_POST['XsySqlAddEntry'])){
    $xsy_Sql_ItemForm = Xsy_Sql_DisplaySingleEntry($SQL_DATABASE, $SQL_TABLE, "Add", $selectedField, $textArray);
    echo($xsy_Sql_ItemForm);
  }

  // ---- Display the "modify entry" form
  elseif(isset($_POST['XsySqlModifyEntry'])){
    $idValue = $_POST['XsySqlTableId'];
    $xsy_Sql_ItemForm = Xsy_Sql_DisplaySingleEntry($SQL_DATABASE, $SQL_TABLE, "Update", $selectedField, $textArray, $idValue);
    echo($xsy_Sql_ItemForm);
  }

  // ---- Nothing special, display it
  $tableData    = Xsy_Sql_DisplaySqlTable($SQL_DATABASE, $SQL_TABLE, $conditionArray, $selectedField, $textArray);
  echo($buttonAdd);
  echo(( (isset($textArray['DispPage']['IntroTxt'])) ? "<p>".$textArray['DispPage']['IntroTxt']."</p>\n" : "" ));
  echo($tableData.$buttonAdd);
  

}


















function Xsy_Sql_ManageTableWithFiles($SQL_TABLE, $fileArray, $mappingArray){

  GLOBAL $SQL_DATABASE;

  if (isset($_POST['Xsy_File_Added'])){
    Xsy_Sql_AddIntoTableWithFiles($SQL_TABLE, $fileArray, $mappingArray);
  }
  elseif(isset($_POST['Xsy_File_DelEntry'])){
    $title = Xsy_Glob_Get("Xsy_Entry_Name");
    Xsy_Sql_Delete($SQL_DATABASE, $SQL_TABLE, $mappingArray["{Title}"], $title);
  }
  elseif(isset($_POST['Xsy_File_Upd']) OR isset($_POST['Xsy_File_Updated'])){
    Xsy_Sql_UpdateTableWithFiles($SQL_TABLE, $fileArray, $mappingArray);
  }
  elseif(isset($_POST['Xsy_File_DelFiles'])){
    // $title = Xsy_Glob_Get("Xsy_Entry_Name");
    // Xsy_Sql_Delete($SQL_DATABASE, $SQL_TABLE, $mappingArray["{Title}"], $title);
  }

  Xsy_Sql_CheckTableWithFiles($SQL_TABLE, $fileArray, $mappingArray);
}

/*******************************************************************************************************
 * Check table with file :
 * $fileArray['FieldName']['Folder']  => where to search for the file
 * $fileArray['FieldName']['Part'][]  => all part of the file name eg: {Date}##{Title}.extension as {Title} for PRIMKEY
 * $fileArray['FieldName']['Spliter'] => give the value for the explode() function
 * $mappingArray['{Date}'] = 'Dat_Date' or mappingArray['{Title}'] = 'Txt_Title', the title mapping MUST be defined
 */

function Xsy_Sql_CheckTableWithFiles($SQL_TABLE, $fileArray, $mappingArray){

  GLOBAL $SQL_DATABASE;
  $XSY_SCANDIR_SORT_ASC   = 0;
  $XSY_SCANDIR_SORT_DESC  = 1;
  $allIncluded = array();
  $notIncluded = array();
  $arrayHeader = array();

  // check for each field
  foreach($fileArray as $fieldName=>$fileFilter){

    /* for each file, except the "." and ".." file (current foler and parent folder) */
    foreach(scandir($fileFilter['Folder']) as $fileIndex=>$fileName){

      // if it is not the "current folder" or "parent folder" file name ...
      if($fileName!=="." AND $fileName!==".."){

        // get rid of extension name and split into all parts, number of part is the number of value of the 'Part' field
        $fileNameNoExt= substr($fileName, 0, strripos($fileName, "."));
        $allPartText  = (count($fileFilter["Part"] > 1)) ? explode($fileFilter["Spliter"], $fileNameNoExt, count($fileFilter["Part"])) : array(0=>$fileNameNoExt);
        $titleValue   = "";
        $partName     = $fileFilter['Part'];

        // look for title value
        foreach($allPartText as $partIndex=>$partValue){

          if(isset($mappingArray[$partName[$partIndex]])){
            $arrayHeader[$mappingArray[$partName[$partIndex]]]['Type'] = 'Field';
          }
          else{
            $arrayHeader[$partName[$partIndex]]['Type'] = 'Fixed';
          }

          if($partName[$partIndex] == "{Title}"){
            $titleValue = $partValue;
            $arrayHeader[$mappingArray[$partName[$partIndex]]]['PrimKey'] = TRUE;
          }

        }
        // add the current field name as header list :)
         $arrayHeader[$fieldName]['Type'] = 'Field';

        // check if the title value entry exists !
        $check_File_query = "SELECT COUNT(*) FROM `$SQL_DATABASE`.`$SQL_TABLE` WHERE `".$mappingArray['{Title}']."`='".Xsy_Glob_EscapeString($titleValue, array("'"=>"''"))."'";
        $check_File_fetch = Xsy_Sql_FetchAll($check_File_query);
        $isInTable        = $check_File_fetch[0]['COUNT(*)'] > 0;

        // if it isn't in the table yet
        if (!$isInTable){
          foreach($allPartText as $partIndex=>$partValue){
            $fieldLevel1 = isset($mappingArray[$partName[$partIndex]]) ? 'Field' : 'Fixed';
            $fieldLevel2 = isset($mappingArray[$partName[$partIndex]]) ? $mappingArray[$partName[$partIndex]] : $partName[$partIndex];
            $notIncluded[$titleValue][$fieldLevel1][$fieldLevel2] = $partValue;
            $notIncluded[$titleValue][$fieldLevel1][$fieldLevel2] = $partValue;
          }
          // do not forget the file itself !
          $notIncluded[$titleValue]['Field'][$fieldName] = $fileName;
          $notIncluded[$titleValue]['Path'][$fieldName]  = $fileFilter['Folder'].$fileName;
          // check if title already exist : all titles are unique !
        }

        // title value is in the table, check data consistency then
        else{

          $fieldList  = "`".$fieldName."`";
          foreach($mappingArray as $fieldTag=>$mappedFieldName){
            $fieldList .= ",`".$mappedFieldName."`";
          }

          $query_File = "SELECT ".$fieldList." FROM `$SQL_DATABASE`.`$SQL_TABLE` WHERE `".$mappingArray['{Title}']."`='".Xsy_Glob_EscapeString($titleValue)."'";
          $fetch_File = Xsy_Sql_FetchAll($query_File);
          $array_File = $fetch_File[0];

          // for all part names ...
          foreach($allPartText as $partIndex=>$partValue){

            // if this is actually a field
            if(isset($mappingArray[$partName[$partIndex]])){
              $allIncluded[$titleValue]['Field'][$mappingArray[$partName[$partIndex]]] = $partValue;
              // if part name is not the same as table entry =>  ERROR
              if($array_File[$mappingArray[$partName[$partIndex]]]!==$partValue){
                $allIncluded[$titleValue]['InTable'][$partName[$partIndex]] = $array_File[$mappingArray[$partName[$partIndex]]];
              }
            }

            // not a field so OSEF
            else{
              $allIncluded[$titleValue]['Fixed'][$partName[$partIndex]] = $partValue;
            }
          }
          // do not forget the file itself !
          $allIncluded[$titleValue]['Field'][$fieldName]  = $fileName;
          $allIncluded[$titleValue]['Path'][$fieldName]   = $fileFilter['Folder'].$fileName;
          
        }
      }
    }
  }



  $txtNotInclFiles = "<table border='1' style='margin:15px auto;background:#001729;border:2px outset #B4C3C8;'>
  <form method='post' action=''>\n  <tr>\n   <th> <input type='checkbox' id='Xsy_Sql_CheckAllFilesCheckboxes' /> </th>\n";
  $txtAllInclFiles = "<table border='1' style='margin:20px auto;background:#001729;border:2px outset #B4C3C8;'>
  <tr>\n";
  foreach($arrayHeader as $fieldName=>$fieldNameArray){
    $txtNotInclFiles .= "    <th style='padding:4px;'> ".Xsy_Sql_DisplayFieldName($fieldName)." </th>\n";
    $txtAllInclFiles .= "    <th style='padding:4px;'> ".Xsy_Sql_DisplayFieldName($fieldName)." </th>\n";
  }
  $txtNotInclFiles .= "  </tr>\n";
  $txtAllInclFiles .= "    <th style='padding:4px;'> Action </th>\n  </tr>\n";
  $fileAddNum       = 0;

  foreach($notIncluded as $titleValue=>$titleArray){

    // new line
    $txtNotInclFiles .= "   <tr>\n <td> <input type='checkbox' name='FileAdd[]' value='".$fileAddNum."' class='fileCheckbox' /> </td>\n";
    foreach($arrayHeader as $fieldName=>$fieldNameArray){
      $value          = isset($titleArray[$fieldNameArray['Type']][$fieldName]) ? $titleArray[$fieldNameArray['Type']][$fieldName] : "";
      if ($fieldNameArray['Type']=="Field"){
        $txtNotInclFiles .= "    <td style='min-width:150px;text-align:center;'> <input type='text' name='".$fieldName."[]' value='".Xsy_Glob_EscapeString($value, array("'"=>"&#39;"))."' /> </td>\n";
      }
      elseif($fieldNameArray['Type']=="Fixed"){
        $txtNotInclFiles .= "    <td style='min-width:150px;text-align:center;'> <p style='margin:auto;'>".$value."</p> </td>\n";
      }
      else{
        echo("<p style='color:red;'>WTF field/fixed type : ".$fieldNameArray['Type']."</p>");
      }
    }
    $txtNotInclFiles .= "   </tr>\n";
    $fileAddNum += 1;
  }



  foreach($allIncluded as $titleValue=>$titleArray){

    // new line
    $txtAllInclFiles .= "   <tr>\n";
    $titleValue       = "";
    foreach($arrayHeader as $fieldName=>$fieldNameArray){

      if (isset($titleArray['InTable'][$fieldName])){
        $txtAllInclFiles .= "    <td style='min-width:150px;'> ".$titleArray['InTable'][$fieldName]." <br /> (not in table) </td>\n";
      }

      $value          = isset($titleArray[$fieldNameArray['Type']][$fieldName]) ? $titleArray[$fieldNameArray['Type']][$fieldName] : "";
      $titleValue     = (isset($fieldNameArray['PrimKey'])) ? $value : $titleValue;
      if (isset($titleArray['Path'][$fieldName])){
        $txtAllInclFiles .= "    <td style='min-width:150px;'> <a href='".Xsy_Glob_EscapeString($titleArray['Path'][$fieldName])."'> ".$value." </a> </td>\n";
      }
      else{
        $txtAllInclFiles .= "    <td> ".$value." </td>\n";
      }
    }

    // action form
    $txtAllInclFiles .= "   <td> <form method='post' action=''>
  <input type='hidden' name='Xsy_Entry_Name' value='$titleValue'/>
  <input type='submit' name='Xsy_File_Upd' value='Update'/>
  <input type='submit' name='Xsy_File_DelEntry' value='Del. Entry'/>
  <!--<input type='submit' name='Xsy_File_DelFiles' value='Del Files'/>-->
 </form> </td>
 </tr>\n";

  }

  $txtNotInclFiles .= "  <tr> <td colspan='".(count($arrayHeader)+1)."' style='text-align:center;'> <input type='submit' name='Xsy_File_Added' value='Add' style='width:75%;' /> </td> </tr> </form>\n</table>\n";
  $txtAllInclFiles .= "</table>\n";

  echo($txtNotInclFiles);
  echo($txtAllInclFiles);
}



function Xsy_Sql_AddIntoTableWithFiles($SQL_TABLE, $fileArray, $mappingArray){

  GLOBAL $SQL_DATABASE;

  $fileAddArray = $_POST['FileAdd'];
  foreach($fileAddArray as $key=>$index){
 
    $entryAdded = array();
    $entryText  = "";
    // listed field names
    foreach($fileArray as $fieldName=>$toto){
      $entryAdded[$fieldName] = Xsy_Glob_EscapeString($_POST[$fieldName][$index], array("'"=>"''"));
      $entryText .= "$fieldName >> ".$_POST[$fieldName][$index]." <br />";
    }
    // mapped field names
    foreach($mappingArray as $mappedField=>$fieldName){
      $entryAdded[$fieldName] = Xsy_Glob_EscapeString($_POST[$fieldName][$index], array("'"=>"''"));
      $entryText .= "$fieldName >> ".$_POST[$fieldName][$index]." <br />";
    }
    $inserted = Xsy_Sql_Insert($SQL_DATABASE, $SQL_TABLE, $entryAdded);

    if ($inserted){
      echo("<p style='color:green;'> Following entry is successfully inserted: <br /> $entryText ------------------------ </p>");

    }
    else{
      echo("<p style='color:red;'> Error when inserting following entry : <br /> $entryText </p>");

    }

  }
}


function Xsy_Sql_UpdateTableWithFiles($SQL_TABLE, $fileArray, $mappingArray){

  GLOBAL $SQL_DATABASE;

  if(isset($_POST['Xsy_File_Updated'])){

    $idValue = Xsy_Glob_Get('idEntry');

    $entryText    = "";
    // listed field names
    foreach($fileArray as $fieldName=>$toto){
      $entryData[$fieldName] = Xsy_Glob_EscapeString($_POST[$fieldName], array("'"=>"''"));
      $entryText .= "$fieldName >> ".$_POST[$fieldName]." <br />";
    }
    // mapped field names
    foreach($mappingArray as $mappedField=>$fieldName){
      $entryData[$fieldName] = Xsy_Glob_EscapeString($_POST[$fieldName], array("'"=>"''"));
      $entryText .= "$fieldName >> ".$_POST[$fieldName]." <br />";
    }
    $inserted = Xsy_Sql_Update($SQL_DATABASE, $SQL_TABLE, $entryData, $idValue);

    if ($inserted){
      echo("<p style='color:green;'> Following entry is successfully updated: <br /> $entryText </p>");

    }
    else{
      echo("<p style='color:red;'> Error when updating following entry : <br /> $entryText </p>");

    }

  }
  elseif(isset($_POST['Xsy_File_Upd'])){

    $title = Xsy_Glob_Get("Xsy_Entry_Name");
    $query = "SELECT * FROM `$SQL_DATABASE`.`$SQL_TABLE` WHERE `".$mappingArray['{Title}']."`='".$title."'";
    $fetch = Xsy_Sql_FetchAll($query);
    $array = $fetch[0];

    $updateForm = " <div id='Xsy_Sql_Form'>\n  <form method='post' action=''>
   <input type='hidden' name='idEntry' value='".$array[Xsy_Sql_GetPrimKey($SQL_DATABASE, $SQL_TABLE)]."' />
   <table>\n";
    // listed field names
    foreach($fileArray as $fieldName=>$toto){
      $updateForm .= " <tr> <td> ".Xsy_Sql_DisplayFieldName($fieldName)." </td> <td> <input type='text' name='$fieldName' value='".$array[$fieldName]."' size='40' /> </td> </tr>\n";
    }
    // mapped field names
    foreach($mappingArray as $mappedField=>$fieldName){
      $updateForm .= " <tr> <td> ".Xsy_Sql_DisplayFieldName($fieldName)." </td> <td> <input type='text' name='$fieldName' value='".$array[$fieldName]."' size='40' /> </td> </tr>\n";
    }
    $updateForm .= "   <tr> <td colspan='2'> <input type='submit' name='Xsy_File_Updated' value='Update entry' class='Xsy_Sql_Button' /></td> </tr>
   </table>
  </form>
  <p> <a href=''> Click here to cancel </a> </p>
 </div>";


    echo($updateForm);
  }
}
?>