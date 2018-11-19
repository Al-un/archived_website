<?php
// ======================= Define table and so on


$conditionArray['WHERE']['Id_User']         = $_SESSION['UserId'];
$conditionArray['Constant']['Id_User']      = $_SESSION['UserId'];

// comment line if you want the default value
// $cateTextArray is defined in memo_settings.php

if($_GET['memoaction']=="ManageCate"){
  $selectedField[]['FieldName'] = "Txt_Cate%Name";
  $selectedField[]['FieldName'] = "Int_Cate%Order";
  $conditionArray['ORDER BY']['Int_Cate%Order'] = "";
  Xsy_Sql_ManageTableData($sqlTable_memocate, $conditionArray, $selectedField, $cateTextArray);
}
elseif($_GET['memoaction']=="ManageStatus"){
  $selectedField[]['FieldName'] = "Txt_Status%Name";
  $selectedField[]['FieldName'] = "Int_Status%Order";
  $conditionArray['ORDER BY']['Int_Status%Order'] = "";
  Xsy_Sql_ManageTableData($sqlTable_memostatus, $conditionArray, $selectedField, $cateTextArray);
}


?>