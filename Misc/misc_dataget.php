<?php

/*
 * return an array of Excel files.
 */
function getAllExcels(){

  GLOBAL $SQL_DATABASE, $sqlTable_MiscExcel, $path_ExcelDescs;

  $excel_check = "SELECT COUNT(*) FROM `$SQL_DATABASE`.`$sqlTable_MiscExcel` WHERE '".$_SESSION['UserLevel']."'>=`Id_Auth`";
  $excel_fetch = Xsy_Sql_FetchAll($excel_check);
  $excel_count = $excel_fetch[0]['COUNT(*)'];
  $i           = 0;
  $excel_array = array();

  if($excel_count > 0 ){
    $excel_query = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_MiscExcel` WHERE '".$_SESSION['UserLevel']."'>=`Id_Auth`";
    $excel_fetch = Xsy_Sql_FetchAll($excel_query);
    foreach($excel_fetch as $key=>$itemArray){
      $excel_array[$itemArray['Txt_Excel%Type']][$i]['Name']  = $itemArray['Txt_Excel%Name'];
      $excel_array[$itemArray['Txt_Excel%Type']][$i]['File']  = $itemArray['Txt_File%Name'];
      $excel_array[$itemArray['Txt_Excel%Type']][$i]['Upd']   = $itemArray['UpDT_Last%Update'];
      $excel_array[$itemArray['Txt_Excel%Type']][$i]['Auth']  = $itemArray['Id_Auth'];
      $excel_array[$itemArray['Txt_Excel%Type']][$i]['Desc']  = ($itemArray['Txt_Excel%Desc']!=="") ? file_get_contents($path_ExcelDescs.$itemArray['Txt_Excel%Desc']) : "";
      $i++;
    }
  }

  return $excel_array;
}


/* return a complex array (hierarchy included) for all Sync files */
function getAllSync($root){



}


?>