<?php

// ===========================================================================
//      function
// ===========================================================================

/*
 * itemtype: cate or item
 * to move down, we have to increment the order. 
 */
function Xsy_Pho_Move($itemtype, $UpOrDown){

  global $SQL_DATABASE, $sqlPho_MenuCate, $sqlPho_MenuItem;

  // define variables
  $postIdField  = ($itemtype == "item") ? "PhoItemID" : "PhoCateID";
  $postOrdField = ($itemtype == "item") ? "PhoItemOrder" : "PhoCateOrder";

  $itemId       = $_POST[$postIdField];
  $itemOrder    = $_POST[$postOrdField];
  $idField      = ($itemtype == "item") ? "ID_MenuItem" : "ID_MenuCate";
  $orderField   = ($itemtype == "item") ? "Int_Item%Order" : "Int_Cate%Order";
  $sqlTable     = ($itemtype == "item") ? $sqlPho_MenuItem : $sqlPho_MenuCate;
  $targetOrder  = ($UpOrDown == "Down") ? ($itemOrder + 1) : ($itemOrder - 1);

  // search for target order
  $query_target = Xsy_Sql_FetchAll("SELECT `$idField` FROM `$SQL_DATABASE`.`$sqlTable` WHERE `$orderField`='$targetOrder'");
  $targetId     = $query_target[0][$idField];

  // proceed to switches
  Xsy_Sql_Update($SQL_DATABASE, $sqlTable, array($orderField => "0"), $targetId);
  Xsy_Sql_Update($SQL_DATABASE, $sqlTable, array($orderField => $targetOrder), $itemId);
  Xsy_Sql_Update($SQL_DATABASE, $sqlTable, array($orderField => $itemOrder), $targetId);


}



if (isset($_GET['PhoMngt']) AND $_GET['PhoMngt']=="Menu"){



// ===========================================================================
//      SQL Processing if any
// ===========================================================================

  // ---- Move Up or Down (cate or item)
  if(isset($_POST['PhoItemMoveUp'])){
    Xsy_Pho_Move("item", "Up");
  }
  elseif(isset($_POST['PhoItemMoveDown'])){
    Xsy_Pho_Move("item", "Down");
  }
  elseif(isset($_POST['PhoCateMoveUp'])){
    Xsy_Pho_Move("cate", "Up");
  }
  elseif(isset($_POST['PhoCateMoveDown'])){
    Xsy_Pho_Move("cate", "Down");
  }






// ===========================================================================
//      Retrieve data
// ===========================================================================


  $allData      = "";
  $allCate      = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlPho_MenuCate` ORDER BY `Int_Cate%Order`");
  $allItem      = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlPho_MenuItem` ORDER BY `Int_Item%Order`");
  $allCateItem  = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlPho_MenuCateItem`");
  $cateOrderMax = Xsy_Sql_FetchAll("SELECT MAX(`Int_Cate%Order`) AS `Int_Cate%Order` FROM `$SQL_DATABASE`.`$sqlPho_MenuCate`");
  $itemOrderMax = Xsy_Sql_FetchAll("SELECT MAX(`Int_Item%Order`) AS `Int_Item%Order` FROM `$SQL_DATABASE`.`$sqlPho_MenuItem`");
  $cateOrderMax = $cateOrderMax[0]['Int_Cate%Order'];
  $itemOrderMax = $itemOrderMax[0]['Int_Item%Order'];
  $allCateItemRel;


  // sort all the cate-item relationship
  foreach($allCateItem as $key=>$cateItemArray){
    $allCateItemRel[$cateItemArray['Id_MenuCate']][] = $cateItemArray['Id_MenuItem'];
  }




// ===========================================================================
//      Display all data (cate / item)
// ===========================================================================
  foreach($allCate as $key=>$aCateArray){

    $cateId   = $aCateArray['ID_MenuCate'];
    $cateOrder= $aCateArray['Int_Cate%Order'];

    $allData .= "   <div id='Pho_Cate".$cateId."' class='Pho_Cate'>\n    <p> ".$aCateArray['Txt_Cate%Name']." </p>";

    $allData .= "   <form method='post' action=''>
    <input type='hidden' name='PhoCateID' value='".$cateId."' />
    <input type='hidden' name='PhoCateOrder' value='".$aCateArray['Int_Cate%Order']."' />";
    $allData .= ($cateOrder > 1) ? "    <input type='submit' name='PhoCateMoveUp' value='Up' />" : "";
    $allData .= ($cateOrder < $cateOrderMax) ? "    <input type='submit' name='PhoCateMoveDown' value='Down' />" : "";
    $allData .= "   </form>
    <div id='Pho_CateItem".$cateId."' class='Pho_CateItem'>\n";

    // for every item
    foreach($allCateItemRel[$cateId] as $key=>$itemSortedId){

      $itemId    = $allItem[$itemSortedId-1]['ID_MenuItem'];
      $itemOrder = $allItem[$itemSortedId-1]['Int_Item%Order'];

      $allData .= "     <div id='PhoItem".$itemId."' class='Pho_Item'>";
      $allData .= "      <p> ".$allItem[$itemSortedId-1]['Txt_Item%Name']." -- ".$allItem[$itemSortedId-1]['Dble_Price']." &euro; </p>";
      $allData .= "      <form method='post' action=''>
       <input type='hidden' name='PhoItemID' value='".$itemId."' />
       <input type='hidden' name='PhoItemOrder' value='".$itemOrder."' />";
      $allData .= ($itemOrder > 1) ? "       <input type='submit' name='PhoItemMoveUp' value='Up' />" : "";
      $allData .= ($itemOrder < $itemOrderMax) ? "       <input type='submit' name='PhoItemMoveDown' value='Down' />" : "";
      $allData .= "      </form>
    </div>";

    }


    $allData .= "    </div>
  </div>";
  }


echo($allData);
}

?>