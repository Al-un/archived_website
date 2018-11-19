<?php

function Xsy_Pass_DisplayByCate(){

  GLOBAL $SQL_DATABASE, $sqlTable_PassCate, $sqlTable_PassLevel, $sqlTable_PassSite;

// ============================================================================================== //
// ============================ Sort by cate 
// ============================================================================================== //
  $passTextCate;
  $passAllCate;
  $query_cate   = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_PassCate` WHERE `Id_User`='".$_SESSION['UserId']."' ORDER BY `Int_Cate%Order`";
  $rawCate      = Xsy_Sql_Query($query_cate);
  
  while($aCate = Xsy_Sql_Fetch($rawCate)){

    $idPassCate = $aCate['ID_PassCate'];
    $passAllCate[$idPassCate] = $aCate['Txt_Cate%Name'];
    
    $query_item = "
      SELECT * 
      FROM `$SQL_DATABASE`.`$sqlTable_PassSite`, `$SQL_DATABASE`.`$sqlTable_PassLevel`
      WHERE `$sqlTable_PassSite`.`Id_PassLevel` = `$sqlTable_PassLevel`.`ID_PassLevel`
      AND `$sqlTable_PassSite`.`Id_PassCate` = '$idPassCate'
      ORDER BY `$sqlTable_PassSite`.`Txt_Title`, `$sqlTable_PassLevel`.`Int_Level%Order`";
    $rawItem    = Xsy_Sql_Query($query_item);

    while($anItem = Xsy_Sql_Fetch($rawItem)){
    
      $idPassSite = $anItem['ID_PassSite'];
      $passTextCate[$idPassCate][$idPassSite]['Title']    = $anItem['Txt_Title'];
      $passTextCate[$idPassCate][$idPassSite]['Url']      = $anItem['Txt_SiteUrl'];
      $passTextCate[$idPassCate][$idPassSite]['Login']    = $anItem['Txt_Login'];
      $passTextCate[$idPassCate][$idPassSite]['Comment']  = $anItem['Txt_Comment'];
      $passTextCate[$idPassCate][$idPassSite]['Level']    = $anItem['Txt_Level%Name'];
      $passTextCate[$idPassCate][$idPassSite]['Memo']     = $anItem['Txt_Level%Memo'];
    
    }

  }


// ============================================================================================== //
// ============================ display by cate 
// ============================================================================================== //
$displayCate = "<div id='SiteByCate'>";

foreach($passTextCate as $cateId=>$siteArray){
  
  $displayCate .= "  <div class='Item' id='Cate".$cateId."'>\n  <p class='Title'> ".$passAllCate[$cateId]." </p>\n";
  
  foreach($siteArray as $siteId=>$sitePerCateArray){
    $displayCate .= "   <div class='Site'>\n";
    $displayCate .= "   <div class='Memo'> ".$sitePerCateArray['Memo']." </div> \n";
    $displayCate .= "   <div class='Login'> >> ".$sitePerCateArray['Login']." </div> \n";
    if ($sitePerCateArray['Url']!==""){
    $displayCate .= "   <div class='ItemName'> [".$sitePerCateArray['Level']."] : <a href='".$sitePerCateArray['Url']."'>".$sitePerCateArray['Title']." </a> </div> \n";
    }
    else{
    $displayCate .= "   <div class='ItemName'> [".$sitePerCateArray['Level']."] : ".$sitePerCateArray['Title']." </div> \n";
    }
    $displayCate .= "   <div class='Form'> <form method='post' action=''>
    <input type='hidden' name='CateId' value='".$cateId."' />
    <input type='hidden' name='SiteId' value='".$siteId."' />
    <input type='submit' name='SiteUpdate' value='Update' />
    <input type='submit' name='SiteDeleted' value='Delete' />
   </form> </div> \n";
    $displayCate .= ( $sitePerCateArray['Comment']!=="") ? "   <div class='Comment'> ".$sitePerCateArray['Comment']." </div> \n" : "";
    $displayCate .= "   </div>";
  }

  $displayCate .= "  </div>";
}
$displayCate .= "</div>";

 return $displayCate;
}







function Xsy_Pass_DisplayByLevel(){
  GLOBAL $SQL_DATABASE, $sqlTable_PassCate, $sqlTable_PassLevel, $sqlTable_PassSite;

// ============================================================================================== //
// ============================ Sort by pass level 
// ============================================================================================== //
  $passTextLevel;
  $passAllLevel;
  $query_level    = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_PassLevel` WHERE `Id_User`='".$_SESSION['UserId']."' ORDER BY `Int_Level%Order`";
  $rawLevel       = Xsy_Sql_Query($query_level);
  
  while($aLevel = Xsy_Sql_Fetch($rawLevel)){

    $idPassLvl = $aLevel['ID_PassLevel'];
    $passAllLevel[$idPassLvl]['Name'] = $aLevel['Txt_Level%Name'];
    $passAllLevel[$idPassLvl]['Memo'] = $aLevel['Txt_Level%Memo'];

    $query_item = "
      SELECT * 
      FROM `$SQL_DATABASE`.`$sqlTable_PassSite`, `$SQL_DATABASE`.`$sqlTable_PassCate`
      WHERE `$sqlTable_PassSite`.`Id_PassCate` = `$sqlTable_PassCate`.`ID_PassCate`
      AND `$sqlTable_PassSite`.`Id_PassLevel` = '$idPassLvl'
      ORDER BY `$sqlTable_PassSite`.`Txt_Title`, `$sqlTable_PassCate`.`Int_Cate%Order`";
    $rawItem    = Xsy_Sql_Query($query_item);

    while($anItem = Xsy_Sql_Fetch($rawItem)){
    
      $idPassSite = $anItem['ID_PassSite'];
      $passTextLevel[$idPassLvl][$idPassSite]['Title']    = $anItem['Txt_Title'];
      $passTextLevel[$idPassLvl][$idPassSite]['Url']      = $anItem['Txt_SiteUrl'];
      $passTextLevel[$idPassLvl][$idPassSite]['Login']    = $anItem['Txt_Login'];
      $passTextLevel[$idPassLvl][$idPassSite]['Comment']  = $anItem['Txt_Comment'];
      $passTextLevel[$idPassLvl][$idPassSite]['Cate']     = $anItem['Txt_Cate%Name'];
    
    }

  }

// ============================================================================================== //
// ============================ display by pass level 
// ============================================================================================== //
$displayLevel = "<div id='SiteByLevel'>";

foreach($passTextLevel as $lvlId=>$siteArray){
  $displayLevel .= "  <div class='Item' id='Level".$lvlId."'> <p class='Title'> ".$passAllLevel[$lvlId]['Name']." </p>\n";
  
  foreach($siteArray as $siteId=>$sitePerLevelArray){
    $displayLevel .= "   <div class='Site'>\n";
    $displayLevel .= "   <div class='Memo'> ".$passAllLevel[$lvlId]['Memo']." </div> \n";
    $displayLevel .= "   <div class='Login'> >> ".$sitePerLevelArray['Login']." </div> \n";
    if ($sitePerLevelArray['Url']!==""){
    $displayLevel .= "   <div class='ItemName'> [".$sitePerLevelArray['Cate']."] : <a href='".$sitePerLevelArray['Url']."'>".$sitePerLevelArray['Title']." </a> </div> \n";
    }
    else{
    $displayLevel .= "   <div class='ItemName'> [".$sitePerLevelArray['Cate']."] : ".$sitePerLevelArray['Title']." </div> \n";
    }
    $displayLevel .= "   <div class='Form'> <form method='post' action=''>
    <input type='hidden' name='LevelId' value='".$lvlId."' />
    <input type='hidden' name='SiteId' value='".$siteId."' />
    <input type='submit' name='SiteUpdate' value='Update' />
    <input type='submit' name='SiteDeleted' value='Delete' />
   </form> </div> \n";
    $displayLevel .= ( $sitePerLevelArray['Comment']!=="") ? "   <div class='Comment'> ".$sitePerLevelArray['Comment']." </div> \n" : "";
    $displayLevel .= "   </div>";
  }

  $displayLevel .= "  </div>";
}
$displayLevel .= "  </div>";

 return $displayLevel;
}
?>