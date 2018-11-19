<?php

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