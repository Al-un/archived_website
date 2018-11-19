<?php








// =========================================================================================== //
// == PHP Processing
// =========================================================================================== //

if(isset($_POST['XsySiteAdd'])){
  $newTableArray  = array("Txt_Site%Name" => $_POST['XsySiteName']);
  Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_all_minisites, $newTableArray);
}



if(isset($_POST['XsySiteId'])){

  $siteId = $_POST['XsySiteId'];
  $userId = 0;
  $log  = " <div style='margin:auto; width:75%;background:black;color:white;'>\n";


  // Site Data
  $siteUpdData['Txt_Site%Name']   = $_POST['XsySiteName'];
  $siteUpdData['Txt_Site%Url']    = $_POST['XsySiteUrl'];
  $siteUpdData['Txt_Site%Domain'] = $_POST['XsySiteDomain'];
  $siteUpdData['Bool_Visible']    = (isset($_POST['XsySiteVisible'])) ? $_POST['XsySiteVisible'] : 0;
  $siteUpdData['UpDT_Last%Update']= Date("Y-m-d H:m:s");
  Xsy_Sql_Update($SQL_DATABASE, $sqlTable_all_minisites, $siteUpdData, $siteId);
  $log .= "<p> Site Data is updated: </p><br />";


  // Site Lang: remove all lang and add checked ones
  Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_all_sitelang, 'Id_Minisite', $siteId);
  foreach($_POST['XsySiteLang'] as $langId){
    Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_all_sitelang, array('Id_Minisite' => $siteId, 'Id_Language' => $langId));
  }
  $log .= "<p> Site Lang is updated: </p> <br />";

  // Site Desc: remove all desc and add checked ones
  Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_all_sitedesc, 'Id_Minisite', $siteId);
  foreach($XSY_LANG as $langId => $langArray){
    if (isset($_POST['XsySiteDesc'.$langId]) AND $_POST['XsySiteDesc'.$langId] !== ""){
      $descArray = array('Id_Minisite' => $siteId, 'Id_Language' => $langId, 'Txt_Description' => $_POST['XsySiteDesc'.$langId]);
      Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_all_sitedesc, $descArray);
    }
  }
  $log .= "<p> Site Desc is updated: </p> <br />";

  // Site Auth: Check all site auth and see if we delete it or not
  $queryDeleteAuth = "DELETE FROM `$SQL_DATABASE`.`$sqlTable_all_siteuser` WHERE `Id_Minisite`='".$siteId."' AND `Id_User`=:UserID";
  $queryCheckAuth  = "SELECT COUNT(*) FROM `$SQL_DATABASE`.`$sqlTable_all_siteuser` WHERE `Id_Minisite`='".$siteId."' AND `Id_User`=:UserID";
  $stmt_DeleteAuth = $XSY_SQL_PDO->prepare($queryDeleteAuth);
  $stmt_CheckAuth  = $XSY_SQL_PDO->prepare($queryCheckAuth);
  $stmt_DeleteAuth->bindParam(':UserID', $userId);
  $stmt_CheckAuth->bindParam(':UserID', $userId);

  if(isset($_POST['SiteAccessKeep'])){

    foreach($_POST['SiteAccessKeep'] as $accessID => $AuthToKeep){
      $userId = $_POST['SiteAccessUserId'][$accessID];

      // empty user?
      if($userId == 0){
        $log .= "<p> User is empty, no authorization addition. </p>";
      }

      // delete auth?
      elseif ($AuthToKeep == 0){
        $stmt_DeleteAuth->execute();
        $log .= "<p>Access for user ".$_POST['SiteAccessUserId'][$accessID]." is deleted for site ID ".$siteId." </p>";
       }

      // create / update auth?
      elseif($AuthToKeep == 1){
        $siteUpdAuth['Id_User']     = $_POST['SiteAccessUserId'][$accessID];
        $siteUpdAuth['Id_Auth']     = $_POST['SiteAccessAuth'][$accessID];
        $siteUpdAuth['Id_Minisite'] = $siteId;
        $stmt_CheckAuth->execute();
        $plop = Xsy_Sql_Fetch($stmt_CheckAuth);
        // if(Xsy_Sql_RowCount($stmt_CheckAuth) == 0){
        if($plop['COUNT(*)'] == 0){
          Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_all_siteuser, $siteUpdAuth);
          $log .= "<p>Access for user ".$_POST['SiteAccessUserId'][$accessID]." is created for site ID ".$siteId." </p>";
        }
        else{
          $log .= "<p>Access for user ".$_POST['SiteAccessUserId'][$accessID]." already exists for site ID ".$siteId." </p>";
        }
      }
    }

  }

  $log .= "</div>";
  echo($log);

}









// ========================================================================================
// Retrieve all the site allowed to the user or DefaultUser
// ========================================================================================

if($_SESSION['UserAdmin']){
  $query_site = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_all_minisites` ORDER BY `Txt_Site%Name`";

}
else{
  $query_site = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_all_minisites`, `$SQL_DATABASE`.`$sqlTable_all_siteuser`, `$SQL_DATABASE`.`$sqlTable_all_users`
    WHERE 
      `$sqlTable_all_minisites`.`ID_Minisite` = `$sqlTable_all_siteuser`.`Id_Minisite` AND
      `$sqlTable_all_users`.`ID_User` = `$sqlTable_all_siteuser`.`Id_User`
    AND ((`$sqlTable_all_siteuser`.`Id_user` = '".$_SESSION['UserId']."')
      OR (`$sqlTable_all_siteuser`.`Id_user` = '".$XSY_GLOB_DEFAULTUSERID."' AND `$sqlTable_all_siteuser`.`Id_Auth` >= `$sqlTable_all_siteuser`.`Id_auth`))
    ORDER BY `$sqlTable_all_minisites`.`Txt_Site%Name`";
}

// ========================================================================================
// Retrieves all sites data:
//  - site name and URL or domain
//  - site languages
//  - site description
// ========================================================================================

$query_lang   = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_all_languages`, `$SQL_DATABASE`.`$sqlTable_all_sitelang`
  WHERE `$sqlTable_all_sitelang`.`Id_Language` = `$sqlTable_all_languages`.`ID_Language` AND `$sqlTable_all_sitelang`.`Id_Minisite` = :siteId";
$query_desc = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_all_languages`,`$SQL_DATABASE`.`$sqlTable_all_sitedesc`
  WHERE `$sqlTable_all_sitedesc`.`Id_Language` = `$sqlTable_all_languages`.`ID_Language` AND `$sqlTable_all_sitedesc`.`Id_Minisite` = :siteId";
$query_user = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_all_auths`,`$SQL_DATABASE`.`$sqlTable_all_users`, `$SQL_DATABASE`.`$sqlTable_all_siteuser`
  WHERE `$sqlTable_all_auths`.`ID_Auth` = `$sqlTable_all_siteuser`.`Id_Auth` AND `$sqlTable_all_users`.`ID_User` = `$sqlTable_all_siteuser`.`Id_User` AND `$sqlTable_all_siteuser`.`Id_Minisite` = :siteId";

$siteId = 0;
$stmt_lang = $XSY_SQL_PDO->prepare($query_lang);
$stmt_desc = $XSY_SQL_PDO->prepare($query_desc);
$stmt_user = $XSY_SQL_PDO->prepare($query_user);
$stmt_lang->bindParam(':siteId', $siteId);
$stmt_desc->bindParam(':siteId', $siteId);
$stmt_user->bindParam(':siteId', $siteId);

// ========================================================================================
// Execute queries and get data into a big table
// ========================================================================================
$stmt_site = Xsy_Sql_FetchAll($query_site);
if(isset($stmt_site) && count($stmt_site) > 1){
  foreach($stmt_site as $siteArray){

    $siteId                       = $siteArray['ID_Minisite'];
    $siteData[$siteId]['ID']      = $siteId;
    $siteData[$siteId]['Name']    = $siteArray['Txt_Site%Name'];
    $siteData[$siteId]['Url']     = $siteArray['Txt_Site%URL'];
    $siteData[$siteId]['Domain']  = $siteArray['Txt_Site%Domain'];
    $siteData[$siteId]['Visible'] = $siteArray['Bool_Visible'];
    $siteData[$siteId]['Update']  = $siteArray['UpDT_Last%Update'];


    // initialize languages and desc
    foreach($XSY_LANG as $id=>$langArray){
      $siteData[$siteId]['Lang'][$id] = 0;
      $siteData[$siteId]['Desc'][$id] = "";
    }
    // retrieve all languages "enabled" for a given site
    $stmt_lang->execute();
    $lang_array = $stmt_lang->fetchAll(PDO::FETCH_ASSOC);
    foreach($lang_array as $id=>$array_langEntry){
      $siteData[$siteId]['Lang'][$array_langEntry['ID_Language']] = 1;
    }


    // retrieve all description
    $stmt_desc->execute();
    $desc_array = $stmt_desc->fetchAll(PDO::FETCH_ASSOC);
    foreach($desc_array as $id => $array_desc){
      $siteData[$siteId]['Desc'][$array_desc['ID_Language']] = $array_desc['Txt_Description'];
    }

    // retrieve all user authorization
    $stmt_user->execute();
    $user_array = $stmt_user->fetchAll(PDO::FETCH_ASSOC);
    foreach($user_array as $id => $array_user){
      $siteData[$siteId]['User'][$array_user['ID_User']]['UserName'] = $array_user['Txt_User%Name'];
      $siteData[$siteId]['User'][$array_user['ID_User']]['UserAuth'] = $array_user['Txt_Auth%Name'];
    }
  }
}


// print_r($siteData);
?>