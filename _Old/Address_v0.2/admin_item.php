<?php
$dataAddrItem;
$txtAddrItem    = "";



// ================================================================================ //
// =======================    Form : HTML forms                                     //
// ================================================================================ //




if (isset($_POST['AddrItemAdd'])) {
  $addForm = "    <p class='AddrFormTitle'> Item Properties (Name cannot be empty) </p><br />    <table> 
     <tr> <td> Name </td>       <td> <input type='text' name='ItemName' size='20' /> </td> </tr>
     <tr> <td> Website </td>    <td> <input type='text' name='ItemWebsite' size='20' /> </td> </tr>
     <tr> <td> Email </td>      <td> <input type='text' name='ItemEmail' size='20' /> </td> </tr>
     <tr> <td> A tester </td>   <td> <input type='checkbox' name='ItemTest' /> </td> </tr>
     <tr> <td> Auth Level </td> <td> <select name='ItemAuth'>\n";
  foreach($XSY_AUTH as $authId=>$authArray){
    $addForm .= "      <option value='".$authId."'> ".$authArray['Name']." </option>\n";
  }
  $addForm .= "     </select>  </td> </tr> </table>
    <table class='AddrFormSubmit'>
     <tr> <td colspan='2'> <input type='submit' name='AddrItemAdded' value='Add Item'/> </td> </tr>
    </table>\n";
}




if (isset($_POST['AddrItemDescAdd'])) {
  $addForm = "      <p class='AddrFormTitle'> Add a item description </p>
  <input type='hidden' name='AddrItemId' value='".Xsy_Glob_Get("AddrItemId")."' />
  <table>
   <tr> <td colspan='2' id='AddRowDesc' class='AddrFormAddRow'> Add another description row </td> </tr>
   <tr id='RefAddDesc'> <td> <select name='ItemDescLang[]'>\n";
  foreach($XSY_LANG as $langId=>$langArray){
    $addForm .= "      <option value='".$langId."'> ".$langArray['Name']." </option>\n";
  }
  $addForm .= "     </select></td> <td> <textarea name='ItemDescText[]' cols='80' rows='4' ></textarea> </td> </tr>
    </table>

    <table class='AddrFormSubmit'>
     <tr> <td colspan='2'> <input type='submit' name='AddrItemDescAdded' value='Add Description'/> </td> </tr>
    </table>\n";

}
if (isset($_POST['AddrItemCityAdd'])) {
  $addForm = $allCityLvl1;
  $addForm .= $allCityLvl2;
  $addForm .= "  <table>
   <tr> <td colspan='2'> Item City </td> </tr>
    <tr>
     <td> <input type='hidden' name='AddrItemId' value='".Xsy_Glob_Get("AddrItemId")."' /> </td>
     <td> ".Xsy_Sql_DisplayFieldValue('Id_AddrCountry', '', 'Update')." ".Xsy_Sql_DisplayFieldValue('Id_AddrArea', '', 'Update')." ".Xsy_Sql_DisplayFieldValue('Id_AddrCity', '', 'Update')." </td>
    </tr>
    <tr>
      <td> Postal </td>
      <td> <input type='text' name='AddrItemPostal' size='20' /> </td>
    </tr>
    <tr>
      <td> Address </td>
      <td> <input type='text' name='AddrItemAddress' size='20' /> </td>
    </tr>
    <tr>
      <td> Phone </td>
      <td> <input type='text' name='AddrItemPhone' size='20' /> </td>
    </tr>
  </table>
  
  <table class='AddrFormSubmit'>
   <tr> <td colspan='2'> <input type='submit' name='AddrItemCityAdded' value='Add City'/> </td> </tr>
  </table>\n";
}
if (isset($_POST['AddrItemCateAdd'])) {

  $addForm = $allCateLvl1;
  $addForm .= $allCateLvl2;
  $addForm .= "  <table>
   <tr> <td colspan='2'>  Select a type / category / sub category to add : </td> </tr>
    <tr>
     <td> <input type='hidden' name='AddrItemId' value='".Xsy_Glob_Get("AddrItemId")."' /> </td>
     <td> ".Xsy_Sql_DisplayFieldValue('Id_AddrType', '', 'Update')." ".Xsy_Sql_DisplayFieldValue('Id_AddrCate', '', 'Update')." ".Xsy_Sql_DisplayFieldValue('Id_AddrSubCate', '', 'Update')." </td>
    </tr>
  </table>
  
  <table class='AddrFormSubmit'>
   <tr> <td colspan='2'> <input type='submit' name='AddrItemCateAdded' value='Add Cate'/> </td> </tr>
  </table>\n";

}



if (isset($_POST['AddrItemUpdate'])) {

  $itemId  = Xsy_Glob_Get('AddrItemId');
  $query      = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrItem` WHERE `ID_AddrItem`='$itemId'";
  $fetch      = Xsy_Sql_FetchAll($query);

  $updForm = "      <p class='AddrFormTitle'> Update item properties </p>
  <input type='hidden' name='ID_AddrItem' value='".$itemId."' />
  <table>
    <tr> <td> Name </td> <td> <input type='text' name='Txt_Name' value='".$fetch[0]['Txt_Name']."' size='30' /> </td> </tr>
    <tr> <td> Email </td> <td> <input type='text' name='Txt_Email' value='".$fetch[0]['Txt_Email']."' size='30' /> </td> </tr>
    <tr> <td> Website </td> <td> <input type='text' name='Txt_Website' value='".$fetch[0]['Txt_Website']."' size='30' /> </td> </tr>
    <tr> <td> A tester </td> <td> <input type='text' name='Txt_a_tester' value='".$fetch[0]['Txt_a_tester']."' size='30' /> </td> </tr>
    <tr> <td> User Level </td> <td> ".Xsy_Sql_DisplayFieldValue('Id_Auth', $fetch[0]['Id_Auth'], "Update", NULL)." </td> </tr>

    </table>

    <table class='AddrFormSubmit'>
     <tr> <td colspan='2'> <input type='submit' name='AddrItemUpdated' value='Update Description'/> </td> </tr>
    </table>\n";

}




if (isset($_POST['AddrItemCityUpdate'])) {

  $cityRelId  = Xsy_Glob_Get('AddrItemCityId');
  $query      = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrItemCity` WHERE `ID_AddrItemCity`='$cityRelId'";
  $fetch      = Xsy_Sql_FetchAll($query);

  $updForm    = $allCityLvl1;
  $updForm    .= $allCityLvl2;
  $updForm    .= "   <table>
    <tr> <td colspan='2'> Item City Update </td> </tr>
    <tr>
     <td> <input type='hidden' name='AddrItemId' value='".Xsy_Glob_Get("AddrItemId")."' /> </td>
     <td> ".Xsy_Sql_DisplayFieldValue('Id_AddrCountry', '', 'Update')." ".Xsy_Sql_DisplayFieldValue('Id_AddrArea', '', 'Update')." ".Xsy_Sql_DisplayFieldValue('Id_AddrCity', '', 'Update')." </td>
    </tr>
    <tr>
      <td> Postal </td>
      <td> <input type='text' name='AddrItemPostal' size='20' value='".$fetch[0]['Txt_Postal']."' /> </td>
    </tr>
    <tr>
      <td> Address </td>
      <td> <input type='text' name='AddrItemAddress' size='20' value='".$fetch[0]['Txt_Address']."' /> </td>
    </tr>
    <tr>
      <td> Phone </td>
      <td> <input type='text' name='AddrItemPhone' size='20' value='".$fetch[0]['Txt_Phone']."' /> </td>
    </tr>
  </table>
  
  <table class='AddrFormSubmit'>
   <tr> <td colspan='2'> <input type='submit' name='AddrItemCateUpdated' value='Update Cate'/> </td> </tr>
  </table>\n";

}

if (isset($_POST['AddrItemCateUpdate'])) {

  $updForm    = $allCateLvl1;
  $updForm    .= $allCateLvl2;
  $updForm    = "  <table>
   <tr> <td colspan='2'>  Select a type / category / sub category to add : </td> </tr>
    <tr>
     <td> <input type='hidden' name='AddrItemId' value='".Xsy_Glob_Get("AddrItemId")."' /> </td>
     <td> ".Xsy_Sql_DisplayFieldValue('Id_AddrType', '', 'Update')." ".Xsy_Sql_DisplayFieldValue('Id_AddrCate', '', 'Update')." ".Xsy_Sql_DisplayFieldValue('Id_AddrSubCate', '', 'Update')." </td>
    </tr>
  </table>
  
  <table class='AddrFormSubmit'>
   <tr> <td colspan='2'> <input type='submit' name='AddrItemCateAdded' value='Add Cate'/> </td> </tr>
  </table>\n";

}



// ================================================================================ //
// =======================    Form : PHP Management                                 //
// ================================================================================ //



if (isset($_POST['AddrItemAdded'])) {

  $query = "SELECT `ID_AddrItem`,`Txt_Name` FROM `$SQL_DATABASE`.`$sqlTable_AddrItem` WHERE `Txt_Name`='".Xsy_Glob_Get('ItemName')."'";
  $rawAddedItem = Xsy_Sql_Query($query);

    // as Txt_Name is an unique field, there is no need to check it.
    $addrAddedItemProperties['Txt_Name']      = Xsy_Glob_Get('ItemName');
    $addrAddedItemProperties['Txt_Email']     = Xsy_Glob_Get('ItemEmail');
    $addrAddedItemProperties['Txt_Website']   = Xsy_Glob_Get('ItemWebsite');
    $addrAddedItemProperties['Txt_a_tester']  = (isset($_POST['ItemTest'])) ? "à tester" : "";
    $addrAddedItemProperties['Id_Auth'] = Xsy_Glob_Get('ItemAuth');
    $addrItemInsert = Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_AddrItem, $addrAddedItemProperties);
    if($addrItemInsert){
      echo("<p style='margin:auto;'> Item Properties correctly added. </p>");
    }
    else{
      echo($addrItemInsert);
      echo("<p style='color:red;'> Item Properties insertion error </p>");
    }
}

if (isset($_POST['AddrItemDescAdded'])) {

  foreach($_POST['ItemDescLang'] as $key=>$value){
    if($_POST['ItemDescText'][$key]!=""){
      $addrAddedItemDesc['Txt_TranslateTable']  = "_AddrItem";
      $addrAddedItemDesc['Id_Table%Item']       = Xsy_Glob_Get('AddrItemId');
      $addrAddedItemDesc['Id_Language']         = $_POST['ItemDescLang'][$key];
      $addrAddedItemDesc['Txt_Item%Name']       = $_POST['ItemDescText'][$key];
      Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_AddrTranslateLong, $addrAddedItemDesc);
      $addrAddedItemProperties['UpDT_Date'] = Date("Y-m-d H:m:s");
      $addrItemInsert = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_AddrItem, $addrAddedItemProperties, Xsy_Glob_Get('AddrItemId'));
    }
    else{
      echo("<p style='margin:auto;'> Item Description is empty </p>");
    }
  }
}

if (isset($_POST['AddrItemCityAdded'])) {
  $insertedEntry['Id_AddrItem']     = Xsy_Glob_Get("AddrItemId");
  $insertedEntry['Id_AddrCountry']  = Xsy_Glob_Get("Id_AddrCountry");
  $insertedEntry['Id_AddrArea']     = Xsy_Glob_Get("Id_AddrArea");
  $insertedEntry['Id_AddrCity']     = Xsy_Glob_Get("Id_AddrCity");
  $insertedEntry['Txt_Address']     = Xsy_Glob_Get("AddrItemAddress");
  $insertedEntry['Txt_Postal']      = Xsy_Glob_Get("AddrItemPostal");
  $insertedEntry['Txt_Phone']       = Xsy_Glob_Get("AddrItemPhone");
  Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_AddrItemCity, $insertedEntry);
  $addrAddedItemProperties['UpDT_Date'] = Date("Y-m-d H:m:s");
  $addrItemInsert = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_AddrItem, $addrAddedItemProperties, Xsy_Glob_Get('AddrItemId'));
}
if (isset($_POST['AddrItemCateAdded'])) {
  $insertedEntry['Id_AddrItem']     = Xsy_Glob_Get("AddrItemId");
  $insertedEntry['Id_AddrRelCate']  = Xsy_Glob_Get("AddrItemCateId");
  Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_AddrItemCate, $insertedEntry);
  $addrAddedItemProperties['UpDT_Date'] = Date("Y-m-d H:m:s");
  $addrItemInsert = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_AddrItem, $addrAddedItemProperties, Xsy_Glob_Get('AddrItemId'));
}

// --- Update

if (isset($_POST['AddrItemUpdated'])){
  $itemId                                   = Xsy_Glob_Get('ID_AddrItem');
  $addrAddedItemProperties['Txt_Name']      = Xsy_Glob_Get('Txt_Name');
  $addrAddedItemProperties['Txt_Email']     = Xsy_Glob_Get('Txt_Email');
  $addrAddedItemProperties['Txt_Website']   = Xsy_Glob_Get('Txt_Website');
  $addrAddedItemProperties['Txt_a_tester']  = Xsy_Glob_Get('Txt_a_tester');
  $addrAddedItemProperties['Id_Auth'] = Xsy_Glob_Get('Id_Auth');
  $addrItemUpdate = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_AddrItem, $addrAddedItemProperties, $itemId);
}

if (isset($_POST['AddrItemDescUpdated'])) {
  Xsy_Sql_Update($SQL_DATABASE, $sqlTable_AddrTranslateLong, $updatedEntry, $entryId);
  $addrAddedItemProperties['UpDT_Date'] = Date("Y-m-d H:m:s");
  $addrItemInsert = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_AddrItem, $addrAddedItemProperties, Xsy_Glob_Get('AddrItemId'));
}

if (isset($_POST['AddrItemDescUpdate'])) {
  $idDesc = Xsy_Glob_Get("AddrItemDescId");
}


// --- Deletion

if (isset($_POST['AddrItemDel'])) {
  $deletedEntry = Xsy_Glob_Get("AddrItemId");
  Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_AddrItem, 'ID_AddrItem', $deletedEntry);
}
if (isset($_POST['AddrItemDescDeleted'])) {
  $deletedEntry = Xsy_Glob_Get("AddrItemDescId");
  Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_AddrTranslateLong, 'ID_AddrTranslateLong', $deletedEntry);
  // $addrAddedItemProperties['UpDT_Date'] = Date("Y-m-d H:m:s");
  // $addrItemInsert = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_AddrItem, $addrAddedItemProperties, Xsy_Glob_Get('AddrItemId'));
}
if (isset($_POST['AddrItemCityDeleted'])) {
  $deletedEntry = Xsy_Glob_Get("AddrItemCityId");
  Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_AddrItemCity, 'ID_AddrItemCity', $deletedEntry);
  // $addrAddedItemProperties['UpDT_Date'] = Date("Y-m-d H:m:s");
  // $addrItemInsert = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_AddrItem, $addrAddedItemProperties, Xsy_Glob_Get('AddrItemId'));
}
if (isset($_POST['AddrItemCateDeleted'])) {
  $deletedEntry = Xsy_Glob_Get("AddrItemCateId");
  Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_AddrItemCate, 'ID_AddrItemCate', $deletedEntry);
  // $addrAddedItemProperties['UpDT_Date'] = Date("Y-m-d H:m:s");
  // $addrItemInsert = Xsy_Sql_Update($SQL_DATABASE, $sqlTable_AddrItem, $addrAddedItemProperties, Xsy_Glob_Get('AddrItemId'));
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
      $allAddrCateText[$level][$cateText['Int_CateId']] = $cateText['Txt_Item%Name'];
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
      $allAddrCityText[$level][$cityText['Int_CityId']] = $cityText['Txt_Item%Name'];
    }
  }












// ================================================================================ //
// ======================= Retrieve all connected data
// ================================================================================ //
$rawAllAddrItem = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrItem` ORDER BY `UpDT_Date` DESC, `ID_AddrItem` DESC");
foreach($rawAllAddrItem as $key => $itemEntry){

  $idItem     = $itemEntry['ID_AddrItem'];

  $dataAddrItem[$idItem]['Name']    = $itemEntry['Txt_Name'];
  $dataAddrItem[$idItem]['Email']   = $itemEntry['Txt_Email'];
  $dataAddrItem[$idItem]['Web']     = $itemEntry['Txt_Website'];
  $dataAddrItem[$idItem]['Test']    = $itemEntry['Txt_a_tester'];
  $dataAddrItem[$idItem]['UsrLvl']  = $itemEntry['Id_Auth'];
  $dataAddrItem[$idItem]['Upd']     = $itemEntry['UpDT_Date'];

  // ---- Translation ----------------
  $rawAllTranslation = Xsy_Sql_Query("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrTranslateLong`
    WHERE `Txt_TranslateTable`='_AddrItem' AND `Id_Table%Item`='".$idItem."'");

  if (Xsy_Sql_RowCount($rawAllTranslation) > 0) {
    foreach($rawAllTranslation as $key=>$descLangEntry){
      $dataAddrItem[$idItem]['Desc'][$descLangEntry['ID_AddrTranslateLong']]['Lang'] = $descLangEntry['Id_Language'];
      $dataAddrItem[$idItem]['Desc'][$descLangEntry['ID_AddrTranslateLong']]['Text'] = $descLangEntry['Txt_Item%Name'];
    }
  }
  
  // ---- Addresses ------------------
  $rawAllArea  = Xsy_Sql_Query("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrItemCity`
    INNER JOIN `$SQL_DATABASE`.`$sqlTable_AddrRelCity` ON `$sqlTable_AddrRelCity`.`ID_AddrRelCity` = `$sqlTable_AddrItemCity`.`Id_AddrRelCity`
    WHERE `Id_AddrItem`='".$idItem."'");

  if(Xsy_Sql_RowCount($rawAllArea) > 0) {
    foreach($rawAllArea as $key=>$addressEntry){
      $dataAddrItem[$idItem]['Area'][$addressEntry['ID_AddrItemCity']]['Address']   = $addressEntry['Txt_Address'];
      $dataAddrItem[$idItem]['Area'][$addressEntry['ID_AddrItemCity']]['Postal']    = $addressEntry['Txt_Postal'];
      $dataAddrItem[$idItem]['Area'][$addressEntry['ID_AddrItemCity']]['Phone']     = $addressEntry['Txt_Phone'];
      $dataAddrItem[$idItem]['Area'][$addressEntry['ID_AddrItemCity']]['idCountry'] = $addressEntry['Int_AddrCountry'];
      $dataAddrItem[$idItem]['Area'][$addressEntry['ID_AddrItemCity']]['idArea']    = $addressEntry['Int_AddrArea'];
      $dataAddrItem[$idItem]['Area'][$addressEntry['ID_AddrItemCity']]['idCity']    = $addressEntry['Int_AddrCity'];
    }
  }

  // ---- Category ---------------------
  $rawAllCate  = Xsy_Sql_Query("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrItemCate`
    INNER JOIN `$SQL_DATABASE`.`$sqlTable_AddrRelCate` ON `$sqlTable_AddrRelCate`.`ID_AddrRelCate` = `$sqlTable_AddrItemCate`.`Id_AddrRelCate`
    WHERE `Id_AddrItem`='".$idItem."'");

  if(Xsy_Sql_RowCount($rawAllCate) > 0) {
    foreach($rawAllCate as $key=>$cateEntry){
      $dataAddrItem[$idItem]['Cate'][$cateEntry['ID_AddrItemCate']]['idType']    = $cateEntry['Int_AddrType'];
      $dataAddrItem[$idItem]['Cate'][$cateEntry['ID_AddrItemCate']]['idCate']    = $cateEntry['Int_AddrCate'];
      $dataAddrItem[$idItem]['Cate'][$cateEntry['ID_AddrItemCate']]['idSubCate'] = $cateEntry['Int_AddrSubCate'];
    }
  }
}


// ================================================================================ //
// ======================= Display
// ================================================================================ //

foreach($dataAddrItem as $idItem => $item){

  // -- item data
  $txtAddrItem .= " <div id='AddrItem".$idItem."' class='AddrItemAdmin'>\n";
  $txtAddrItem .= "   <div class='ItemButtonSmall'>\n      <form method='post' action=''>
    <input type='hidden' name='AddrItemId' value='".$idItem."' />
    <input type='submit' name='AddrItemDel' value='Delete' />
  </form>\n   </div>\n";
  $txtAddrItem .= "   <div class='ItemUpd'>   ".$item['Upd']." </div>\n";
  $txtAddrItem .= "   <div class='ItemUsrLvl'> Auth: ".$XSY_AUTH[$item['UsrLvl']]['Name']." </div>\n";
  $txtAddrItem .= "   <div class='ItemButton'>\n      <form method='post' action=''>
    <input type='hidden' name='AddrItemId' value='".$idItem."' />
    <input type='submit' name='AddrItemCityAdd' value='Add City' />
  </form>\n   </div>\n";
  $txtAddrItem .= "   <div class='ItemButton'>\n        <form method='post' action=''>
    <input type='hidden' name='AddrItemId' value='".$idItem."' />
    <input type='submit' name='AddrItemCateAdd' value='Add Cate' />
  </form>\n   </div>\n";
  $txtAddrItem .= "   <div class='ItemButton'>\n        <form method='post' action=''>
    <input type='hidden' name='AddrItemId' value='".$idItem."' />
    <input type='submit' name='AddrItemDescAdd' value='Add Description' />
  </form>\n   </div>\n";
  $txtAddrItem .= "   <div class='ItemButton'>\n      <form method='post' action=''>
    <input type='hidden' name='AddrItemId' value='".$idItem."' />
    <input type='submit' name='AddrItemUpdate' value='Update Properties' />
  </form>\n   </div>\n";
  $txtAddrItem .= "   <div class='ItemTest'>  ".$item['Test']." </div>\n";
  $txtAddrItem .= "   <div class='ItemName' id='AddrName".$idItem."'>  ID ".$idItem." - ".$item['Name']." </div>\n";


  $txtAddrItem .= "   <div id='AddrItemNet".$idItem."' class='ItemNet'>\n";
  $txtAddrItem .= "    <div class='ItemEmail'> Email : ".$item['Email']." </div>\n";
  $txtAddrItem .= "    <div class='ItemWeb'> Website: <a href='".$item['Web']."'> ".$item['Web']." </a> </div>\n";
  $txtAddrItem .= "    <p class='ItemInternet'> Internet: </p>\n";
  $txtAddrItem .= "   </div>\n";


  // -- translation
  $txtAddrItem .= "  <div id='AddrItemDesc".$idItem."' class='ItemDesc'>\n";
  if (isset($item['Desc'])){
    $txtAddrItem .= "  <table>\n";
    foreach($item['Desc'] as $idTranslateLong=>$descArry){
      $txtAddrItem .= "   <tr> <td>".$XSY_LANG[$descArry['Lang']]['Name']." </td> <td> ".$descArry['Text']." </td> <td>  <form method='post' action=''>
    <input type='hidden' name='AddrItemDescId' value='".$idTranslateLong."' />
    <input type='submit' name='AddrItemDescUpdate' value='Upd' />
    <input type='submit' name='AddrItemDescDeleted' value='x' />
  </form> </td> </tr>\n";
    }
    $txtAddrItem .= "  </table>\n";
  }
  else{
    $txtAddrItem .= "   <p> No Description </p>\n";
  }
  $txtAddrItem .= "  </div>\n";

  // -- localisation
  $txtAddrItem .= "  <div id='AddrItemArea".$idItem."' class='ItemArea'>\n";
  if (isset($item['Area'])){
    foreach($item['Area'] as $idItemArea=>$area){
      $txtAddrItem .= "  <div class='AreaDelete'>
  <form method='post' action=''>
    <input type='hidden' name='AddrItemCityId' value='".$idItemArea."' />
    <input type='submit' name='AddrItemCityUpdate' value='Update' />
    <input type='submit' name='AddrItemCityDeleted' value='x' />
  </form>
  </div>\n";
      $txtAddrItem .= "   <p class='Phone'> ".$area['Phone']." </p>";
      $txtAddrItem .= "   <p class='Address'> [Address ID ".$idItemArea."] : ";
      $txtAddrItem .= $allAddrCityText[0][$area['idCountry']];
      $txtAddrItem .= " > ".$allAddrCityText[1][$area['idArea']];
      $txtAddrItem .= " > ".$allAddrCityText[2][$area['idCity']]." > ".$area['Postal']." > ".$area['Address']."</p>";
    }
  }
  else{
    $txtAddrItem .= "   <p> No Addresses </p>\n";
  }
  $txtAddrItem .= "  </div>\n";

  // -- category
  $txtAddrItem .= "  <div id='AddrItemCate".$idItem."' class='ItemCate'>\n";
  if (isset($item['Cate'])){
    foreach($item['Cate'] as $idItemCate=>$cate){
      $txtAddrItem .= "    <div class='CateDelete'>
  <form method='post' action=''>
    <input type='hidden' name='AddrItemCateId' value='".$idItemCate."' />
    <input type='submit' name='AddrItemCateUpdate' value='Update' />
    <input type='submit' name='AddrItemCateDeleted' value='X' />
  </form>
  </div>\n";
      $txtAddrItem .= "   <p> [Cate ID ".$idItemCate."] : ";
      $txtAddrItem .= $allAddrCateText[0][$cate['idType']];
      $txtAddrItem .= " > ".$allAddrCateText[1][$cate['idCate']];
      $txtAddrItem .= " > ".$allAddrCateText[2][$cate['idSubCate']]." </p>";
    }
  }
  else{
    $txtAddrItem .= "   <p> No Category </p>\n";
  }
  $txtAddrItem .= "  </div>\n";


  $txtAddrItem .= " </div>";

}




// ================================================================================ //
// ======================= Display
// ================================================================================ //
if (isset($_POST['AddrItemAdd']) OR isset($_POST['AddrItemCityAdd']) OR isset($_POST['AddrItemCateAdd']) OR isset($_POST['AddrItemDescAdd']) ) {

  echo(" <div class='AddrAdminPopup'>
  <div class='AddrAdminModal'>
   <form method='post' action=''>
$addForm
   </form>
  <a href=''> Go Back </a>
  </div>
 </div>\n");
}
/*
if (isset($_POST['AddrItemDescAdd'])) {
  echo(" <div class='AddrAdminPopup'>
   <div class='AddrAdminModal'>
    <form method='post' action=''>

    </form>
   <a href=''> Go Back </a>
   </div>
  </div>\n");
}
*/
if (isset($_POST['AddrItemDescUpdate']) OR isset($_POST['AddrItemCityUpdate']) OR isset($_POST['AddrItemCateUpdate']) OR isset($_POST['AddrItemUpdate'])) {
  echo(" <div class='AddrAdminPopup'>
   <div class='AddrAdminModal'>
    <form method='post' action=''>
$updForm
    </form>
   <a href=''> Go Back </a>
   </div>
  </div>\n");
}

echo("  <div style=' width: 20%; margin:auto; padding: 5px;'>
    <form method='post' action=''>
      <input type='submit' name='AddrItemAdd' value='Add Item' style='width:100%;'/>
    </form>
  </div>\n");

echo($txtAddrItem);
?>







