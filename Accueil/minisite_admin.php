<?php
include_once('minisite_getdata.php');
$http_host  = $_SERVER['HTTP_HOST'];


$selectListUser = " <select name='SiteAccessUserId[]'>\n <option value='0'></option>\n";
$selectListAuth = " <select name='SiteAccessAuth[]'>\n";
$allUser = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_all_users`");
$allAuth = Xsy_Sql_FetchAll("SELECT * FROM `$SQL_DATABASE`.`$sqlTable_all_auths`");
foreach($allUser as $user_key => $anUser){
  $selectListUser .= "  <option value='".$anUser['ID_User']."'> ".$anUser['Txt_User%Name']." </option>\n";
}
foreach($allAuth as $_auth_key => $anAuth){
  $selectListAuth .= "  <option value='".$anAuth['ID_Auth']."'> ".$anAuth['Txt_Auth%Name']." </option>\n";
}
$selectListUser .= " </select>\n";
$selectListAuth .= " </select>\n";

$selectListKeep = " <select name='SiteAccessKeep[]'>\n <option value='1'> Yes </option>\n <option value='0'> No </option>\n </select>\n";



// =========================================================================================== //
// == Display Site Data, Lang, Desc
// =========================================================================================== //

foreach($siteData as $siteId => $dataArray){

  // ---- main title
  $siteTxt[$siteId] = "<div id=MiniSite".$siteId." class='MiniSite'>
  <form method='post' action=''>
    <input type='hidden' name='XsySiteId' value='$siteId' />\n";


  // ---- site name
  $siteTxt[$siteId] .= " <p id='SiteName".$siteId."'> ".$dataArray['Name']." </p>\n";


  // ---- site data
  $siteTxt[$siteId] .= " <div id='SiteData".$siteId."' class='SiteData'>\n  <p> Site Data: </p>\n";
  $siteTxt[$siteId] .= " <table>
  <tr> <td> Name </td> <td colspan=2> <input type='text' name='XsySiteName' value='".$dataArray['Name']."' style='width:100%;'/> </td> </tr>
  <tr> <td> Url </td>  
      <td> <a href='http://".$http_host.$dataArray['Url']."'>".$http_host.$dataArray['Url']."</a> </td>
      <td> <input type='text' name='XsySiteUrl' value='".$dataArray['Url']."' /> </td> </tr>
  <tr> <td> Domain </td> 
      <td> <a href='http://".$dataArray['Domain'].".".$http_host."'>".$dataArray['Domain'].".".$http_host."</a> </td> 
      <td> <input type='text' name='XsySiteDomain' value='".$dataArray['Domain']."' /> </td> </tr>
  <tr> <td> is Visible</td> <td colspan=2> <input type='checkbox' name='XsySiteVisible' value='1' ".(($dataArray['Visible'] == 1) ? "checked" : "")."/> Visible </td> </tr>
  <tr> <td> Last Update</td> <td colspan=2> ".$dataArray['Update']." </td> </tr>
 </table>\n";
  $siteTxt[$siteId] .= " </div>\n";


  // ---- lang
  $siteTxt[$siteId] .= " <div id='SiteLang".$siteId."' class='SiteLang'>\n  <p> Language: </p>\n";
  foreach($dataArray['Lang'] as $langId => $langIsActive){
    $checked  = ($langIsActive == 1) ? "checked" : "";
    $siteTxt[$siteId] .= "  <input type='checkbox' name='XsySiteLang[]' value='".$langId."' $checked />(".$langId.")".$XSY_LANG[$langId]['Name']."\n";
  }
  $siteTxt[$siteId] .= "</div>\n";


  // ---- desc
  $siteTxt[$siteId] .= " <div id='SiteDesc".$siteId."' class='SiteDesc'>\n  <p> Description: </p>\n";
  $siteTxt[$siteId] .= "  <table>\n";
    foreach($dataArray['Desc'] as $langId => $description){
      $disabledLang    = ($dataArray['Lang'][$langId] == 1) ? "class='SiteDescEnabled'" : "class='SiteDescDisabled'";
      $siteTxt[$siteId] .= "   <tr> <td> Desc ".$XSY_LANG[$langId]['Tag']." </td> <td> <textarea name='XsySiteDesc$langId' cols='70' rows='4' $disabledLang>$description </textarea> </td> </tr>\n";
    }
  $siteTxt[$siteId] .= "  </table>\n";
  $siteTxt[$siteId] .= " </div>\n";


  // ---- user auth
  $siteTxt[$siteId] .= " <div id='SiteAuth".$siteId."' class='SiteAuth'>\n  <p> User Authorization: </p>\n";
  $siteTxt[$siteId] .= "  <table id='SiteAuthTable".$siteId."'>\n";
  $siteTxt[$siteId] .= "   <tr> <th> User ID </th> <th> User Login </th> <th> Authorization Level </th> <th> To Keep </th></tr>\n";
  if (isset($dataArray['User'])){
    foreach($dataArray['User'] as $userId => $userArray){
      $siteTxt[$siteId] .= "   <tr>
          <td> <input type='Text' name='SiteAccessUserId[]' value='".$userId."' readonly /> </td> 
          <td> <input type='Text' name='SiteAccessUser[]' value='".$userArray['UserName']."' readonly /> </td>
          <td> <input type='Text' name='SiteAccessAuth[]' value='".$userArray['UserAuth']."' readonly /> </td>
          <td > ".$selectListKeep." </td> </tr>\n";
    }
  }
  $siteTxt[$siteId] .= "  <tr id='UserAuthAddEntry'> <td> <td> ".$selectListUser." </td> <td> ".$selectListAuth." </td> <td > ".$selectListKeep." </td> </tr>\n";
  $siteTxt[$siteId] .= "  </table>\n";
  $siteTxt[$siteId] .= " <p id='SiteAuthClick".$siteId."' style='width:50%;margin:auto;background:black;color:white;'> Add another user auth entry </p>\n";
  $siteTxt[$siteId] .= " </div>\n";



  // ---- close
  $siteTxt[$siteId] .= "<div id='SiteClose".$siteId."' class='SiteClose'>\n";
  $siteTxt[$siteId] .= "<input type='submit' name'XsySiteUpdate' value='Update' style='width:50%; margin-left:25%;'/>\n";
  $siteTxt[$siteId] .= "</form>\n";
  $siteTxt[$siteId] .= "</div>\n";
  $siteTxt[$siteId] .= "</div>\n";
}

// add new site?
$formNewSite = " <div>
  <form method='post' action=''>
   Site Name: <input type='text' name='XsySiteName' size='30' maxlength='50'/>
   <input type='Submit' name='XsySiteAdd' value='Add Site' />
  </form>
 </div>";


// echo
echo($formNewSite);
foreach($siteTxt as $id => $siteContent){
  echo($siteContent);
}
?>