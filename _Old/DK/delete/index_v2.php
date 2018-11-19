<?php
include("../Tools/phobida_header.php");

  $allCate;
  $allItem;
  $currentCateId = 0;

  // select all categories
  $query_cate = sql_query("
    SELECT 
      `ID_MenuCate`,
      `Txt_CateTitle`,
      `Txt_CateTitle%".$_SESSION['userlang']."`,
      `Txt_PicName`,
      `Txt_AvailableRating`
    FROM
      `$SQL_DATABASE`.`$sqlPho_MenuCate`");
  
  // for each category
  while ($aCate = mysql_fetch_assoc($query_cate)){
  
    $currentCateId = $aCate['ID_MenuCate'];
  
    // show a icon + desc or each category
    $allCate[$currentCateId] = "
   <div id='MenuCate".$currentCateId."' class='MenuCate'>
    <img src = '".$urlRoot."Menu/pic-cate/".$aCate['Txt_PicName']."'
      title = '".$aCate['Txt_CateTitle%'.$_SESSION['userlang']]."'  alt = '".$aCate['Txt_CateTitle%'.$_SESSION['userlang']]."' />
    <p class='title'> ".$aCate['Txt_CateTitle%'.$_SESSION['userlang']]." </p>
   </div>\n";
    
    // retrieve all Item data (desc & rating)
    $query_item = sql_query("
      SELECT
        `$sqlPho_MenuItem`.`ID_MenuItem`,
        `Txt_ItemTitle`,
        `Txt_ItemTitle%".$_SESSION['userlang']."`,
        `Txt_PicName`,
        `Dble_Price`
       FROM
        `$SQL_DATABASE`.`$sqlPho_MenuItem`,
        `$SQL_DATABASE`.`$sqlPho_MenuCateItem`
       WHERE
        `$SQL_DATABASE`.`$sqlPho_MenuCateItem`.`Id_MenuItem` = `$sqlPho_MenuItem`.`ID_MenuItem` AND
        `$SQL_DATABASE`.`$sqlPho_MenuCateItem`.`Id_MenuCate` = '".$currentCateId."'");
        
     while ($anItem = mysql_fetch_assoc($query_item)){
        $allItem[$currentCateId][$anItem['ID_MenuItem']] = "    <p>".$anItem['Txt_ItemTitle%'.$_SESSION['userlang']]."</p>\n";
     }
        
  }

  
  
  
echo(" <div id='PhoMenu'>
  <div id='ClickBack'><a href=''>Click Here to go back to all categories.</a></div>");


foreach($allCate as $key => $value){
  echo($value);
}

foreach($allItem as $key => $value){
  echo("  <div id=MenuCateContent".$key." class='MenuCateContent'>\n");
  foreach ($value as $keyItem => $valueItem){
    echo("   <div id=MenuItem".$keyItem." class='MenuItem'>\n");
    echo($valueItem);
    echo("   </div>\n");
  }
  echo("  </div>\n\n");
}

echo(" </div>");
include("../Tools/phobida_footer.php");
?>









