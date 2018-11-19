<?php



/* ==========================================================
 * PHP management 
 ========================================================== */
if (isset($_POST['FilterAddrType'])){
  $_SESSION['FilterAddrType']     = Xsy_Glob_Get("FilterAddrType");
  $_SESSION['FilterAddrCate']     = array();
}
if (isset($_POST['FilterAddrCountry'])){
  $_SESSION['FilterAddrCountry']  = Xsy_Glob_Get("FilterAddrCountry");
  $_SESSION['FilterAddrCity']     = array();
}

if (isset($_POST['FilterAddrCate'])) {
  $_SESSION['FilterAddrCate'] = array();
  foreach($_POST['FilterAddrCate'] as $index=>$filterIdAddrCate) {
    $_SESSION['FilterAddrCate'][] = $filterIdAddrCate;
  }
}

/* ==========================================================
 * Filter management 
 ========================================================== */

// ==== Filter level 0 (Type and Country)
$_SESSION['FilterAddrType']     = (isset($_SESSION['FilterAddrType']))    ? $_SESSION['FilterAddrType']     : 0;
$_SESSION['FilterAddrCountry']  = (isset($_SESSION['FilterAddrCountry'])) ? $_SESSION['FilterAddrCountry']  : 0;

$filterAddrType    = ($_SESSION['FilterAddrType'] == 0)    ? " 1 AND" :
                      "`".$sqlTable_AddrRelCate."`.`".$addrCateLevel[0]['Field']."` = '".$_SESSION['FilterAddrType']."' AND";
$filterAddrCountry = ($_SESSION['FilterAddrCountry'] == 0) ? " 1 AND" :
                      "`".$sqlTable_AddrRelCity."`.`".$addrCityLevel[0]['Field']."` = '".$_SESSION['FilterAddrCountry']."' AND";

// ==== SESSION Management
$_SESSION['FilterAddrCate'] = (isset($_SESSION['FilterAddrCate'])) ? $_SESSION['FilterAddrCate'] : array();
$_SESSION['FilterAddrCity'] = (isset($_SESSION['FilterAddrCity'])) ? $_SESSION['FilterAddrCity'] : array();
$selectItemCate = "";
$selectItemCity = "";

if(!empty($_SESSION['FilterAddrCate'])){

  $selectItemCate = "(0 ";
  foreach($_SESSION['FilterAddrCate'] as $index=>$filterIdAddrCate){
    $selectItemCate .= " OR `".$sqlTable_AddrRelCate."`.`ID_AddrRelCate` = '".$filterIdAddrCate."'";
  }
  $selectItemCate .= " ) AND";

}
if(!empty($_SESSION['FilterAddrCity'])){

  $selectItemCity = "(0 ";
  foreach($_SESSION['FilterAddrCity'] as $index=>$filterIdAddrCity){
   $selectItemCity .= " OR `".$sqlTable_AddrRelCity."`.`ID_AddrRelCity` = '".$filterIdAddrCity."'";
  }
  $selectItemCity .= " ) AND";

}

// ================================================================================ //
// =======================    Retrieve all cate/city text                           //
// ================================================================================ //

  for($level=0; $level<3; $level++){
    $rawAllCateText = Xsy_Sql_FetchAll("
      SELECT `Int_CateId`, `Txt_Item%Name`
      FROM `$SQL_DATABASE`.`$sqlTable_AddrCate`, `$SQL_DATABASE`.`$sqlTable_AddrTranslateShort`
      WHERE `$sqlTable_AddrCate`.`ID_AddrCate` = `$sqlTable_AddrTranslateShort`.`Id_Table%Item`
      AND `$sqlTable_AddrTranslateShort`.`Txt_TranslateTable` = '_AddrCate'
      AND `$sqlTable_AddrCate`.`Txt_CateType`='".$addrCateLevel[$level]['Value']."'
      AND `$sqlTable_AddrTranslateShort`.`Id_Language` = '".$_SESSION['UserLangId']."'");

    foreach($rawAllCateText as $key=>$cateText){
      $allAddrCateText[$level][$cateText['Int_CateId']]   = $cateText['Txt_Item%Name'];
    }
  }



  for($level=0; $level<3; $level++){
    $rawAllCityText = Xsy_Sql_FetchAll("
      SELECT `Int_CityId`, `Txt_Item%Name`
      FROM `$SQL_DATABASE`.`$sqlTable_AddrCity`, `$SQL_DATABASE`.`$sqlTable_AddrTranslateShort`
      WHERE `$sqlTable_AddrCity`.`ID_AddrCity` = `$sqlTable_AddrTranslateShort`.`Id_Table%Item`
      AND `$sqlTable_AddrTranslateShort`.`Txt_TranslateTable` = '_AddrCity'
      AND `$sqlTable_AddrCity`.`Txt_CityType`='".$addrCityLevel[$level]['Value']."'
      AND `$sqlTable_AddrTranslateShort`.`Id_Language` = '".$_SESSION['UserLangId']."'");

    foreach($rawAllCityText as $key=>$cityText){
      $allAddrCityText[$level][$cityText['Int_CityId']]   = $cityText['Txt_Item%Name'];
    }
  }



// ================================================================================ //
// =======================    Retrieve all cate/city sort filtered by type / country//
// ================================================================================ //
  $rawAllCateRel = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrRelCate` WHERE ".$filterAddrType." 1 ");
  $rawAllCityRel = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrRelCity` WHERE ".$filterAddrCountry." 1 ");

  // for each addr type
  foreach($rawAllCateRel as $key=>$aCateRel){
    $idAddrType     = $aCateRel['Int_AddrType'];
    $idAddrCate     = $aCateRel['Int_AddrCate'];
    $idAddrSubCate  = $aCateRel['Int_AddrSubCate'];
    // check if this addr type has already been identified
    if (!isset($allAddrCateTab[$idAddrType])){
      $allAddrCateTab[$idAddrType]['Selected']  = ($_SESSION['FilterAddrType'] == $idAddrType);
      $allAddrCateTab[$idAddrType]['Count']     = 0;
    }
    // check if this addr cate has been identified
    if (!isset($allAddrCateTab[$idAddrType]['Child'][$idAddrCate])){
      $allAddrCateTab[$idAddrType]['Child'][$idAddrCate]['Selected'] = 0;
      $allAddrCateTab[$idAddrType]['Child'][$idAddrCate]['Count']    = 0;
    }
    // as any sub cate is unique, no need to checked
    $allAddrCateTab[$idAddrType]['Child'][$idAddrCate]['Child'][$idAddrSubCate]['Selected']   = (in_array($aCateRel['ID_AddrRelCate'], $_SESSION['FilterAddrCate']));
    $allAddrCateTab[$idAddrType]['Child'][$idAddrCate]['Child'][$idAddrSubCate]['Count']      = 0;
    $allAddrCateTab[$idAddrType]['Child'][$idAddrCate]['Child'][$idAddrSubCate]['ID_AddrRel'] = $aCateRel['ID_AddrRelCate'];
  }

  // for each addr country
  foreach($rawAllCityRel as $key=>$aCityRel){
    $idAddrCountry  = $aCityRel['Int_AddrCountry'];
    $idAddrArea     = $aCityRel['Int_AddrArea'];
    $idAddrCity     = $aCityRel['Int_AddrCity'];
    // check if this addr country has already been identified
    if (!isset($allAddrCityTab[$idAddrCountry])){
      $allAddrCityTab[$idAddrCountry]['Selected'] = ($_SESSION['FilterAddrCountry'] == $idAddrCountry);
      $allAddrCityTab[$idAddrCountry]['Count']    = 0;
    }
    // check if this addr area has been identified
    if (!isset($allAddrCityTab[$idAddrCountry]['Child'][$idAddrArea])){
      $allAddrCityTab[$idAddrCountry]['Child'][$idAddrArea]['Selected'] = 0;
      $allAddrCityTab[$idAddrCountry]['Child'][$idAddrArea]['Count']    = 0;
    }
    // as any city is unique, no need to checked
    $allAddrCityTab[$idAddrCountry]['Child'][$idAddrArea]['Child'][$idAddrCity]['Selected']   = 0;
    $allAddrCityTab[$idAddrCountry]['Child'][$idAddrArea]['Child'][$idAddrCity]['Count']      = 0;
    $allAddrCityTab[$idAddrCountry]['Child'][$idAddrArea]['Child'][$idAddrCity]['ID_AddrRel'] = $aCityRel['ID_AddrRelCity'];
  }


// ================================================================================ // 
// =======================                                       ================== //
// ================================================================================ //  


$query_item = "
  SELECT
    `$sqlTable_AddrItem`.`ID_AddrItem`,
    `$sqlTable_AddrRelCate`.`ID_AddrRelCate`,
    `$sqlTable_AddrRelCity`.`ID_AddrRelCity`,
    `Txt_Name`,
    `Txt_Item%Name`,
    `Txt_Email`,
    `Txt_Website`,
    `Txt_a_tester`,
    `UpDT_Date`,
    `Int_AddrType`,
    `Int_AddrCate`,
    `Int_AddrSubCate`,
    `Int_AddrCountry`,
    `Int_AddrArea`,
    `Int_AddrCity`,
    `Txt_Address`,
    `Txt_Postal`,
    `Txt_Phone`
  FROM
    `$SQL_DATABASE`.`$sqlTable_AddrItem`,
    `$SQL_DATABASE`.`$sqlTable_AddrTranslateLong`,
    `$SQL_DATABASE`.`$sqlTable_AddrItemCate`,
    `$SQL_DATABASE`.`$sqlTable_AddrItemCity`,
    `$SQL_DATABASE`.`$sqlTable_AddrRelCate`,
    `$SQL_DATABASE`.`$sqlTable_AddrRelCity`
  WHERE
    $selectItemCate
    $selectItemCity
    $filterAddrType
    $filterAddrCountry
    `$sqlTable_AddrItem`.`ID_AddrItem` = `$sqlTable_AddrItemCate`.`Id_AddrItem` AND
    `$sqlTable_AddrItem`.`ID_AddrItem` = `$sqlTable_AddrItemCity`.`Id_AddrItem` AND
    `$sqlTable_AddrItem`.`Id_Auth` <= '".$_SESSION['UserLevel']."' AND
    `$sqlTable_AddrItemCate`.`Id_AddrRelCate` = `$sqlTable_AddrRelCate`.`ID_AddrRelCate` AND
    `$sqlTable_AddrItemCity`.`Id_AddrRelCity` = `$sqlTable_AddrRelCity`.`ID_AddrRelCity` AND
    `$sqlTable_AddrTranslateLong`.`Id_Table%Item` = `$sqlTable_AddrItem`.`ID_AddrItem` AND
    `$sqlTable_AddrTranslateLong`.`Txt_TranslateTable` = '_AddrItem' AND
    `$sqlTable_AddrTranslateLong`.`Id_Language` = '".$_SESSION['UserLangId']."'";


$stmt_item = Xsy_Sql_Query($query_item);
echo("<p>".$query_item."</p>");

while ($anItem = Xsy_Sql_Fetch($stmt_item)){

  $addrItemId = $anItem['ID_AddrItem'];
  // item was already identified ?
  if (!isset($dataItem[$addrItemId])){
    $dataItem[$addrItemId]['Name']  = $anItem['Txt_Name'];
    $dataItem[$addrItemId]['Desc']  = $anItem['Txt_Item%Name'];
    $dataItem[$addrItemId]['Email'] = $anItem['Txt_Email'];
    $dataItem[$addrItemId]['Web']   = $anItem['Txt_Website'];
    $dataItem[$addrItemId]['Test']  = $anItem['Txt_a_tester'];
    $dataItem[$addrItemId]['Update']= $anItem['UpDT_Date'];
  }

  // category hasn't already been registered for this item
  if (!isset($dataItem[$addrItemId]['Cate'][$anItem['ID_AddrRelCate']])){
    $idAddrType     = $anItem['Int_AddrType'];
    $idAddrCate     = $anItem['Int_AddrCate'];
    $idAddrSubCate  = $anItem['Int_AddrSubCate'];
    $dataItem[$addrItemId]['Cate'][$anItem['ID_AddrRelCate']]['Type']     = $idAddrType;
    $dataItem[$addrItemId]['Cate'][$anItem['ID_AddrRelCate']]['Cate']     = $idAddrCate;
    $dataItem[$addrItemId]['Cate'][$anItem['ID_AddrRelCate']]['SubCate']  = $idAddrSubCate;
    $allAddrCateTab[$idAddrType]['Count']                                                 += 1;
    $allAddrCateTab[$idAddrType]['Child'][$idAddrCate]['Count']                           += 1;
    $allAddrCateTab[$idAddrType]['Child'][$idAddrCate]['Child'][$idAddrSubCate]['Count']  += 1;
  }

  // city hasn't already been registered for this item
  if (!isset($dataItem[$addrItemId]['City'][$anItem['ID_AddrRelCity']])){
    $idAddrCountry    = $anItem['Int_AddrCountry'];
    $idAddrArea       = $anItem['Int_AddrArea'];
    $idAddrCity       = $anItem['Int_AddrCity'];
    $allAddrCityTab[$idAddrCountry]['Count']                                                += 1;
    $allAddrCityTab[$idAddrCountry]['Child'][$idAddrArea]['Count']                          += 1;
    $allAddrCityTab[$idAddrCountry]['Child'][$idAddrArea]['Child'][$idAddrCity]['Count']    += 1;
    $dataItem[$addrItemId]['City'][$anItem['ID_AddrRelCity']]['Address']  = $anItem['Txt_Address'];
    $dataItem[$addrItemId]['City'][$anItem['ID_AddrRelCity']]['Postal']   = $anItem['Txt_Postal'];
    $dataItem[$addrItemId]['City'][$anItem['ID_AddrRelCity']]['Phone']    = $anItem['Txt_Phone'];
    $dataItem[$addrItemId]['City'][$anItem['ID_AddrRelCity']]['Country']  = $idAddrCountry;
    $dataItem[$addrItemId]['City'][$anItem['ID_AddrRelCity']]['Area']     = $idAddrArea;
    $dataItem[$addrItemId]['City'][$anItem['ID_AddrRelCity']]['City']     = $idAddrCity;
  }

}

?>