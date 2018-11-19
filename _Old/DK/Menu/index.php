<?php
include("../Tools/phobida_header.php");
include("Menu_Settings.php");


  
// ======================================================================================
// Display the retrieved content
// ======================================================================================

  $allCate;
  $allItem;
  $currentCateId = 0;
  $phobida_menu = "<div id='Phobida_Menu_Content'>";



  // select all categories
  $query_cate = Xsy_Sql_Query("
    SELECT 
      `ID_MenuCate`,
      `Txt_Cate%Name`,
      `Txt_CateTitle%".$_SESSION['userlang']."`,
      `Txt_PicName`,
      `Txt_AvailableRating`
    FROM
      `$SQL_DATABASE`.`$sqlPho_MenuCate`
    ORDER BY 
      `Int_Cate%Order`");


  // for each category
  while ($aCate = Xsy_Sql_Fetch($query_cate)){
  
    $currentCateId  = $aCate['ID_MenuCate'];
    $cateTitle      = str_replace("&", "&amp;", $aCate['Txt_CateTitle%'.$_SESSION['userlang']]);    // to avoid special char "&" and replace with &amp;

    // cate title
    $allCate[$currentCateId] = "
   <img src='".$urlRoot."Menu/img/".$aCate['Txt_PicName']."' alt='".$cateTitle."' class='Pho_Cate_Logo'/>
   <p class='title'> ".$cateTitle." </p>\n";
    
    // retrieve all Item data (desc & rating)
    $query_item = Xsy_Sql_Query("
      SELECT
        `$sqlPho_MenuItem`.`ID_MenuItem`,
        `Txt_Item%Name`,
        `Txt_ItemTitle%".$_SESSION['userlang']."`,
        `Txt_PicName`,
        `Dble_Price`
       FROM
        `$SQL_DATABASE`.`$sqlPho_MenuItem`,
        `$SQL_DATABASE`.`$sqlPho_MenuCateItem`
       WHERE
        `$SQL_DATABASE`.`$sqlPho_MenuCateItem`.`Id_MenuItem` = `$sqlPho_MenuItem`.`ID_MenuItem` AND
        `$SQL_DATABASE`.`$sqlPho_MenuCateItem`.`Id_MenuCate` = '".$currentCateId."'
       ORDER BY 
        `Int_Item%Order`");
        
     while ($anItem = Xsy_Sql_Fetch($query_item)){
       $allItem[$currentCateId][$anItem['ID_MenuItem']] = "    <p class='Item_Title'>".$anItem['Txt_Item%Name']." - ".$anItem['Dble_Price']." €</p>\n";
       $allItem[$currentCateId][$anItem['ID_MenuItem']] .= "    <p class='Item_Desc'> ".$anItem['Txt_ItemTitle%'.$_SESSION['userlang']]." </p>\n";
     }
        
  }

  
  
// ======================================================================================
// Display the retrieved content
// ======================================================================================

// --- PDF Menu
echo(" 
<div id='PhoMenu'>

<p class='pdf_file'><a href='Menu_Pho_Bida.pdf'> <img src='".$urlRoot."Menu/img/icon_pdf.png' alt='pdf' /> ".$MenuPdf."</a></p>
<p class='action_button'> <span id='Pho_Menu_OpenAll'> Ouvrir </span> <span id='Pho_Menu_CloseAll'> Fermer </span>  </p>

  ");

// --- All cate/items
foreach($allCate as $cateKey => $cateValue){

  $newCate = "";
  $newCate .= "  <div id='MenuCateContent".$cateKey."' class='MenuCate'>\n";
  $newCate .= $cateValue;
  $newCate .= "  <div id='MenuItemContent".$cateKey."' class='MenuItemContent'>
    <img class='Pho_Menu_Separator' src='".$urlRoot."Menu/img/phobida_menu_separator.png' alt='separator' />";

  foreach($allItem[$cateKey] as $itemKey => $itemValue){
    $newCate .= "   <div id='MenuItem".$itemKey."' class='MenuItem'>\n";
    $newCate .= $itemValue;
    $newCate .= "   </div>\n";
  }
  $newCate .= "  </div>\n  </div>\n";
  
  $phobida_menu .= $newCate;

}


$phobida_menu .= "</div>";

echo $phobida_menu;


echo(" </div>");
include("../Tools/phobida_footer.php");
?>









