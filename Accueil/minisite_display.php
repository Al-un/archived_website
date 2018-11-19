<?php
include_once('minisite_getdata.php');

// =================================  LANGUAGE SWITCH  =========================== //
switch($_SESSION['UserLang']){
  case "Fr" :
    $noWebsite      = "Pas de site disponible =_=\" Je devrais rajouter un peu de contenu ... ";
    $selectWeb      = "Choisissez un minisite. Pour avoir des d&eacute;tails, cliquer sur la loupe. Sinon cliquer directement sur le nom. Il vous faudra vous reconnecter sur chacun des minisites.";
    $txtStatus      = "Statut";
    $txtUpdate      = "Derni&egrave;re mise &agrave; jour";
    $txtLang        = "Langue(s)";

    $minisiteTitle = "Mini Sites";
    $minisite_desc = "<p>Passer la souris sur une ic&ocirc;ne pour avoir une br&egrave;ve description du mini-site. Pour accéder à un ministe, il suffit juste de cliquer sur l'icône du minisite. Pour revenir à cette page d'acceuil, un lien en haut à gauche vous sera fourni. <br /> Les comptes d'utilisateurs sont généralisés à tous les minisites, pas besoin de se connecter plusieurs fois. Pour se créer un compte, c'est sur la droite.</p>";
    $fieldTitle     = "Titre";
    $fieldDesc      = "Contenu"; 
    $DescName       = "Txt_Description%Fr";
  break;
  case "En" :
    $noWebsite      = "No website is currently available. =_= I have to put some content...";
    $selectWeb      = "Select a mini site. Click the magnifier to get more details. Otherwise, directly click site name. You will have to log once again in each minisite.";
    $txtStatus      = "Status";
    $txtUpdate      = "Last update";
    $txtLang        = "Language";

    $minisiteTitle = "Mini Sites";
    $minisite_desc = "<p>Hover over an icon to get a short mini-site description. To access to a miniwebsite, just click on the miniwebsite icon. To come back to this home page, just click on the home page button in the top-left corner. <br /> If you want to use an user account, a simple login will log you in all the miniwebsite. No need to log several times. To create an account, it is on the right.</p>";
    $fieldTitle     = "Title";
    $fieldDesc      = "Content";
    $DescName       = "Txt_Description%En";
    break; 
  case "ZhTr":
    $noWebsite      = "";
    $selectWeb      = "";
    $txtStatus      = "";
    $txtUpdate      = "";
    $txtLang        = "";

    $minisiteTitle  = "Mini Sites";
    $minisite_desc  = "這是我的‘’迷你‘’網站";
    $fieldTitle     = "稱號";
    $fieldDesc      = "內容";
    $DescName       = "Txt_Description%ZhTr";
    break; 
  case "Jp":
    $noWebsite      = "";
    $selectWeb      = "";
    $txtStatus      = "";
    $txtUpdate      = "";
    $txtLang        = "";

    $minisiteTitle  = "サイト";
    $minisite_desc  = "タイトル";
    $fieldTitle     = "稱號";
    $fieldDesc      = "名状";
    $DescName       = "Txt_Description%Jp";
    break; 
  default : echo('Wrong language: '.$_SESSION['UserLang']);
}



// =================================  DISPLAY MINI SITES ============================== //

// =========================================================================================== //
// == Header in a single row
// =========================================================================================== //
$siteHeader = " <div id='MiniSiteHead'>\n";
if(isset($siteData)){
  foreach($siteData as $siteId => $dataArray){

    // site is visible? display hyperlink
    $siteName = $dataArray['Name'];
    if ($dataArray['Visible'] == 1 OR $_SESSION['UserLevel'] == $XSY_SESS_ADMINLEVEL){
      $siteWebLink = ($_SERVER['HTTP_HOST'] == "xsylum.fr") ? "http://".$dataArray['Domain'].".xsylum.fr" : "http://".$_SERVER['HTTP_HOST'].$dataArray['Url'];
      $siteName = "<a href='".$siteWebLink."'> ".$dataArray['Name']." </a>";
    }

    // site header with link or not
    $siteHeader .= "  <p id='SiteHeader".$siteId."'> ".$siteName." <img src='Accueil/img/Minisite_showDesc.gif' height='10px' id='SiteHeader".$siteId."' /> </p>\n";

  }
}
$siteHeader .= " </div>\n";

// =========================================================================================== //
// == Display Site Data, Lang, Desc
// =========================================================================================== //



if(!isset($siteData)){

  $siteTxt[0] = "<div id='MiniSiteDisp0' class='MiniSiteDisp'>\n";
  $siteTxt[0] .= $noWebsite."\n";
  $siteTxt[0] .= "</div>\n";

}
else{
  $siteTxt[0] = "<div id='MiniSiteDisp0' class='MiniSiteDisp'>\n";
  $siteTxt[0] .= $selectWeb."\n";
  $siteTxt[0] .= "</div>\n";

  foreach($siteData as $siteId => $dataArray){

    // ---- main div
    $siteTxt[$siteId] = "<div id='MiniSiteDisp".$siteId."' class='MiniSiteDisp'>\n";

    // site name & URL depends on HTTP_HOST
    if ($dataArray['Visible'] == 1){
      $siteWebLink = ($_SERVER['HTTP_HOST'] == "xsylum.fr") ? "http://'".$dataArray['Domain'].".xsylum.fr" : "http://".$_SERVER['HTTP_HOST']."/".$dataArray['Url'];
      $siteTxt[$siteId] .= " <p id='SiteName".$siteId."' class='SiteName'><a href='".$siteWebLink."'> ".$dataArray['Name']." </a></p>\n";
    }
    else{
      $siteTxt[$siteId] .= " <p id='SiteName".$siteId."' class='SiteName Disabled'>".$dataArray['Name']." </p>\n";
    }


    // Description
    $siteTxt[$siteId] .= "<p class='SiteDesc'> ".$dataArray['Desc'][$_SESSION['UserLangId']]." </p>";

    // last update and status
    $siteTxt[$siteId] .=  "  <table class='SiteInfo'>\n   <tr> <td> ".$txtStatus." </td> <td class='Site".(($dataArray['Visible'] == 1) ? "Online'> Online" : "Offline'> Offline")." </td> </tr>\n";
    $siteTxt[$siteId] .=  "   <tr> <td> ".$txtUpdate." </td> <td> ".$dataArray['Update']." </td> </tr>\n";
    // ---- lang
    $siteTxt[$siteId] .=  "   <tr> <td> ".$txtLang." </td> <td>";
    foreach($dataArray['Lang'] as $langId => $langIsActive){
      $checked  = ($langIsActive == 1) ? "checked" : "";
      // $siteTxt[$siteId] .= ($langIsActive == 1) ? $XSY_LANG[$langId]['Tag']."  " : "";
      $siteTxt[$siteId] .= ($langIsActive == 1) ? "<img src='".$zToolsRoot."/Ztools/pic/lang/".$XSY_LANG[$langId]['Flag']."' style='margin-left:10px;'/>" : "";
    }
    $siteTxt[$siteId] .= " </td> </tr> \n";
    $siteTxt[$siteId] .= " </table> \n";





    // ---- close
    $siteTxt[$siteId] .= "</div>\n";
  }
}



// =================================  ECHO MINI SITES ================================= //
echo($siteHeader);

foreach($siteTxt as $id => $siteContent){
  echo($siteContent);
}

?>