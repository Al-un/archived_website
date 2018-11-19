<?php

/*
 * return all categories name and children ID in an array.
 */
function addr_getAllCate($findRelatedItem){
  /*
  global $SQL_DATABASE, $sqlTable_AddrCate, $sqlTable_AddrItemCate,  $sqlTable_AddrItem;
  $allTag = array();
  $query  = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrCate`";
  $fetch  = Xsy_Sql_FetchAll($query);

  if(!empty($fetch)){
    foreach($fetch as $index=>$tagArray){
      
      // if there is parent ID, append this ID
      if(isset($tagArray['Int_Addr%Parent%Cate']) and $tagArray['Int_Addr%Parent%Cate']>0){
        $allTag[$tagArray['Int_Addr%Parent%Cate']]['Child'][$tagArray['ID_AddrCate']]['Name'] = $tagArray['Txt_AddrCate%Name'];
      }
      // other create a new root
      else{
        $allTag[$tagArray['ID_AddrCate']]['Name'] = $tagArray['Txt_AddrCate%Name'];
      }
      
      // identified related items
      if($findRelatedItem){
        $queryItem = "SELECT `$sqlTable_AddrItem`.`ID_AddrItem`, `Txt_AddrItem%Name` FROM `$SQL_DATABASE`.`$sqlTable_AddrItem`,`$SQL_DATABASE`.`$sqlTable_AddrItemCate` WHERE `$sqlTable_AddrItem`.`ID_AddrItem`=`$sqlTable_AddrItemCate`.`Id_AddrItem` AND `$sqlTable_AddrItemCate`.`Id_AddrCate`='".$tagArray['ID_AddrCate']."'";
        $fetchItem = Xsy_Sql_FetchAll($queryItem);
        if(!empty($fetchItem)){
          foreach($fetchItem as $index=>$itemArray){
            $allTag[$tagArray['ID_AddrCate']]['Item'][$itemArray['ID_AddrItem']]['Name'] = $itemArray['Txt_AddrItem%Name'];
          }
        }
      }
    }
  }

  return $allTag;*/
}

/*
 * return all areas name and children ID in an array.
 */
function addr_getAllArea($findRelatedItem){

  global $SQL_DATABASE, $sqlTable_AddrArea, $sqlTable_AddrItemArea,  $sqlTable_AddrItem;
  $allTag = array();
  $query  = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrArea`";
  $stmt   = Xsy_Sql_Query($query);

  while($tagArray = Xsy_Sql_Fetch($stmt)){

    // retrieve area name
    $allTag[$tagArray['ID_AddrArea']]['Name']   = $tagArray['Txt_AddrArea%Name'];
    $allTag[$tagArray['ID_AddrArea']]['Count']  = 0;
    // if it has parent, append to child array
    if(isset($tagArray['Int_Addr%Parent%Area']) and $tagArray['Int_Addr%Parent%Area']>0){
      $allTag[$tagArray['Int_Addr%Parent%Area']]['Child'][]   = $tagArray['ID_AddrArea'];
      $allTag[$tagArray['ID_AddrArea']]['Parent']             = $tagArray['Int_Addr%Parent%Area'];
    }
    // otherwise no parent
    else{
      $allTag[$tagArray['ID_AddrArea']]['Parent'] = 0;
    }

  }

  // identified related items once all areas are defined
  if(!empty($allTag) AND $findRelatedItem){

    foreach($allTag as $tagId=>$tagArray){
      $queryItem = "
        SELECT `$sqlTable_AddrItem`.`ID_AddrItem`, `$sqlTable_AddrItem`.`Txt_AddrItem%Name`
        FROM `$SQL_DATABASE`.`$sqlTable_AddrItem`,`$SQL_DATABASE`.`$sqlTable_AddrItemArea`
        WHERE `$sqlTable_AddrItem`.`ID_AddrItem`=`$sqlTable_AddrItemArea`.`Id_AddrItem`
        AND `$sqlTable_AddrItemArea`.`Id_AddrArea`='".$tagId."'";
      $stmt_Item  = Xsy_Sql_Query($queryItem);
      $parentId   = $allTag[$tagId]['Parent'];

      while($itemArray = Xsy_Sql_Fetch($stmt_Item)){
        $allTag[$tagId]['Item'][$itemArray['ID_AddrItem']]['Name'] = $itemArray['Txt_AddrItem%Name'];
        $allTag[$tagId]['Count']                                   = $allTag[$tagId]['Count']+1;
        while($parentId > 0){
          $allTag[$parentId]['Count']++;
          $parentId = $allTag[$parentId]['Parent'];
        }
      }
    }
  }
  

  return $allTag;
}

/*
 * return all items name, website, status, last update 
 * linked cate & linked status in an array.
 */
function addr_getAllItem(){

   global $SQL_DATABASE, $sqlTable_AddrItem,  $sqlTable_AddrItemCate, $sqlTable_AddrItemArea,  $sqlTable_AddrCate, $sqlTable_AddrCate;
  $allItem;
  $queryItem  = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AddrItem`";
  $fetchItem  = Xsy_Sql_FetchAll($queryItem);
  if(!empty($fetchItem)){
    foreach($fetchItem as $index=>$itemArray){

      // item properties
      $itemId  = $itemArray['ID_AddrItem'];
      $allItem[$itemId]['Name']     = $tagArray['Txt_AddrItem%Name'];
      $allItem[$itemId]['Website']  = $tagArray['Txt_Website'];
      $allItem[$itemId]['Status']   = $tagArray['Txt_Test%Status'];
      $allItem[$itemId]['LastUpd']  = $tagArray['UpDT_Last%Update'];

      // all categories
      $queryCate = "
        SELECT * 
        FROM `$SQL_DATABASE`.`$sqlTable_AddrCate`, `$SQL_DATABASE`.`$sqlTable_AddrItemCate`
        WHERE `$sqlTable_AddrCate`.`ID_AddrCate` = `$sqlTable_AddrItemCate`.`Id_AddrCate`";
      $fetchCate = Xsy_Sql_FetchAll($queryCate);
      if(!empty($fetchCate)){
        foreach($fetchCate as $cateArray){
          $allItem[$itemId]['Cate'][$cateArray['ID_AddrCate']]['Name'] = $cateArray[''];
        }
      }

      // all areas
      $queryArea = "
        SELECT * 
        FROM `$SQL_DATABASE`.`$sqlTable_AddrArea`, `$SQL_DATABASE`.`$sqlTable_AddrItemArea`
        WHERE `$sqlTable_AddrArea`.`ID_AddrArea` = `$sqlTable_AddrItemArea`.`Id_AddrArea`";
      $fetchArea = Xsy_Sql_FetchAll($queryArea);
      if(!empty($queryArea)){
        foreach($queryArea as $areaArray){
          $allItem[$itemId]['Area'][$areaArray['ID_AddrArea']]['Name']    = $areaArray['Txt_AddrArea%Name'];
          $allItem[$itemId]['Area'][$areaArray['ID_AddrArea']]['Address'] = $areaArray['Txt_Address'];
          $allItem[$itemId]['Area'][$areaArray['ID_AddrArea']]['Email']   = $areaArray['Txt_Email'];
          $allItem[$itemId]['Area'][$areaArray['ID_AddrArea']]['Phone']   = $areaArray['Txt_Phone'];
        }
      }

    }
  }
  return $allItem;
}

/*
 * display all Categories in the tree structure
 * where parent cate can collapse / expand
 */
function addr_displayAllCate($displayOnly){
  
  $addrDisplay  = "";
  $addrArray    = addr_getAllCate(true);

  // if there is nothing
  if(empty($addrArray)){
    $addrDisplay = "<p> There is currently no category at all </p>";
    return $addrDisplay;
  }


}

function addr_displayAllArea($displayOnly){

  $addrDisplay  = "";
  $addrArray    = addr_getAllArea(true);

  // if there is nothing
  if(empty($addrArray)){
    $addrDisplay = "<p> There is currently no area at all </p>";
    return $addrDisplay;
  }

  foreach($addrArray as $tagId=>$tagArray){
    // $addrDisplay .= // to continue here <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
  }

}

function addr_displayAllItem($displayOnly){

}


function addr_Admin($type){
  $displayOnly = FALSE;
  switch ($type){
    case "Cate" : addr_displayAllCate($displayOnly); break;
    case "Area" : addr_displayAllArea($displayOnly); break;
  }
}
?>