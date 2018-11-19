<?php
$leftPanel  = "";
$rightPanel = "";


// ================================================================================ // 
// ==================== Select list : addr type and addr country
// ================================================================================ // 
$leftPanel  .= "  <form method='post' action=''>\n   <select name='FilterAddrType'>\n    <option value='0'> --All-- </option>";
$rightPanel .= "  <form method='post' action=''>\n   <select name='FilterAddrCountry'>\n    <option value='0'> --All-- </option>";

foreach($allAddrCateText[0] as $typeIndex => $typeValue)      {
  $selected   = ($_SESSION['FilterAddrType'] == $typeIndex) ? "selected" : "" ;
  $leftPanel  .= "   <option value='".$typeIndex."' ".$selected."> ".$typeValue." </option>\n";
}
foreach($allAddrCityText[0] as $countryIndex => $countryValue){
  $selected   = ($_SESSION['FilterAddrCountry'] == $countryIndex) ? "selected" : "" ;
  $rightPanel .= "   <option value='".$countryIndex."' ".$selected."> ".$countryValue." </option>\n";
}

$leftPanel  .= "   </select>\n   <input type='submit' name='AddrTypeSubmit' value='Filter' />  </form>\n";
$rightPanel .= "   </select>\n   <input type='submit' name='AddrCitySubmit' value='Filter' />  </form>\n";

// ================================================================================ // 
// ==================== Left : Cate List with checkboxes
// ================================================================================ // 

$leftPanel .= "   <form method='post' action=''>
    <input type='submit' name='AddrCateSubmit' value='Filter' />";

foreach($allAddrCateTab as $typeIndex => $typeArray){

  // $leftPanel .= "  <div class='LeftPanel_AddrType'> \n   <p> <input type='checkbox' id='AddrType".$typeIndex."' name='AddrCate[]' value='".$typeIndex."-0-0' />";
  // $leftPanel .= $allAddrCateText[0][$typeIndex]." (".$typeArray['Count'].")</p> \n";

  foreach($typeArray['Child'] as $cateIndex => $cateArray){

    $leftPanel .= "   <div class='LeftPanel_AddrCate'>
    <p ".( ($cateArray['Count']==0) ? "class='zeroCount'" : "" ).">
    <input type='checkbox' id='AddrCate".$typeIndex."-".$cateIndex."' />
    ".$allAddrCateText[1][$cateIndex]." (".$cateArray['Count'].")
    </p> \n";

    foreach($cateArray['Child'] as $subcateIndex => $subcateArray){

      $leftPanel .= "    <div class='LeftPanel_AddrSubCate'>
     <p ".( ($subcateArray['Count']==0) ? "class='zeroCount'" : "" ).">
      <input type='checkbox' id='AddrSubCate".$typeIndex."-".$cateIndex."-".$subcateIndex."' name='FilterAddrCate[]' value='".$subcateArray['ID_AddrRel']."' ".( ($subcateArray['Selected']) ? "checked" : "")."/>".
      $allAddrCateText[2][$subcateIndex]." (".$subcateArray['Count'].")
    </p> \n";
      $leftPanel .= "    </div>\n";

    }

    $leftPanel .= "   </div>\n";

  }

  // $leftPanel .= "  </div>\n";
}

$leftPanel .= "   </form>";

// ================================================================================ // 
// ==================== Right : City List with checkboxes
// ================================================================================ // 

$rightPanel .= "   <form method='post' action=''>
    <input type='submit' name='AddrCitySubmit' value='Filter' />";
foreach($allAddrCityTab as $countryIndex => $countryArray){

  // $rightPanel .= "  <div class='RightPanel_AddrCountry'> \n   <p> <input type='checkbox' id='AddrCountry".$countryIndex."' name='AddrCity[]' value='".$countryIndex."-0-0' />";
  // $rightPanel .= $allAddrCityText[0][$countryIndex]." (".$countryArray['Count'].")</p> \n";

  foreach($countryArray['Child'] as $areaIndex => $areaArray){

    $rightPanel .= "   <div class='RightPanel_AddrArea'>
    <p ".( ($areaArray['Count']==0) ? "class='zeroCount'" : "" ).">
      <input type='checkbox' id='AddrArea".$countryIndex."-".$areaIndex."' name='AddrCity[]' value='".$countryIndex."-".$areaIndex."-0' />".
      $allAddrCityText[1][$areaIndex]." (".$areaArray['Count'].")
    </p> \n";

    foreach($areaArray['Child'] as $cityIndex => $cityArray){

      $rightPanel .= "    <div class='RightPanel_AddrCity'> 
    <p ".( ($cityArray['Count']==0) ? "class='zeroCount'" : "" ).">
     <input type='checkbox' id='AddrCity".$countryIndex."-".$areaIndex."-".$cityIndex."' name='FilterAddrCity[]' value='".$cityArray['ID_AddrRel']."' />".
    $allAddrCityText[2][$cityIndex]." (".$cityArray['Count'].")
    </p> \n";
      $rightPanel .= "    </div>\n";

    }

    $rightPanel .= "   </div>\n";

  }

  // $rightPanel .= "  </div>\n";
}

$rightPanel .= "   </form>";
// ================================================================================ // 
// ==================== Center : Item
// ================================================================================ // 

$itemPanel = "";

if (!isset($dataItem)){
  $itemPanel .= "no data";
}
else{
  foreach($dataItem as $itemId => $itemArray){

    $itemPanel .= "  <div class='ItemPanel_AddrItem'>\n";
    $itemPanel .= "   <p> ".$itemArray['Name']." </p>\n ";
    $itemPanel .= "   <p> ".$itemArray['Desc']." </p>\n ";
    $itemPanel .= "   <p> <a href='mailto:".$itemArray['Email']."'> ".$itemArray['Email']." </a> </p>\n ";
    $itemPanel .= "   <p> <a href='".$itemArray['Web']."'> ".$itemArray['Web']." </a> </p>\n ";
    $itemPanel .= "   <p> ".$itemArray['Test']." </p>\n ";
    $itemPanel .= "   <p> ".$itemArray['Update']." </p>\n ";

    foreach($itemArray['Cate'] as $cateRelIndex=>$cateArray){
      $itemPanel .= "   <p> ".$allAddrCateText[0][$cateArray['Type']]." > ".$allAddrCateText[1][$cateArray['Cate']]." > ".$allAddrCateText[2][$cateArray['SubCate']]." </p>\n ";
    }
    foreach($itemArray['City'] as $cityRelIndex=>$cityArray){
      $itemPanel .= "   <p> ".$cityArray['Address']." <br /> ".$allAddrCityText[0][$cityArray['Country']]." >  ".$allAddrCityText[1][$cityArray['Area']]." > ".$allAddrCityText[2][$cityArray['City']]." </p>\n ";
    }

    $itemPanel .= "  </div>\n";

  }
}

?>