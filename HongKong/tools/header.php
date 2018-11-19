<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include($root.'/Ztools/global_header.php');
 

// =========================  SQL TABLES  ====================================== //
$table_HK_StoryItem   = "HK_StoryItem";
$table_HK_StoryCate   = "HK_StoryCate";
$table_HK_StoryComm   = "HK_StoryComm";
$table_HK_StoryPhoto  = "HK_StoryPhoto";
$table_HK_Background  = "HK_Background";
$table_HK_Comment     = "HK_Comment";
$table_pic_folder     = "all_picfolder";
$table_update         = "all_update";
$table_minisite       = "all_minisite";

// ---------------  PRELOAD BACKGROUND ----------------------------------------- //

  $allBackRaw   = sql_query("SELECT `UrlImgHK_Background` FROM `$SQL_DATABASE`.`$table_HK_Background`");
  $backCountRaw = sql_assoc("SELECT COUNT(Id_Background) FROM `$SQL_DATABASE`.`$table_HK_Background`");
  
  $backCount    = $backCountRaw['COUNT(Id_Background)'];
  
  $preloadBackground = "
    function preloadBackgrounds() {
    var allBackground = new Array();";
  $i = 0;
  
  while($back = mysql_fetch_assoc($allBackRaw)){
    $preloadBackground .="
    allBackground[$i] = new Image();
    allBackground[$i].src = (\"".$back['UrlImgHK_Background']."\");
    ";
    $i++;
  }
  
  $preloadBackground .= "}";
    
  
// ---------------- CHOOSE A BACKGROUND ------------------------------- //  

  $backID        = rand(0,$backCount-1);
  
  $backRaw = sql_assoc("
        SELECT `UrlImgHK_Background`,`Place`,`Description` 
        FROM `$SQL_DATABASE`.`$table_HK_Background`
        ORDER BY `Id_Background` LIMIT $backID,1");
  $backURL    = $backRaw['UrlImgHK_Background'];
  $backPlace  = $backRaw['Place'];
  $backDesc   = $backRaw['Description'];
  
  $backCss    = "
    body{
      background-image : url('$backURL');
      background-position: center top;
      background-attachment: fixed;
    }";
  
  
 // --------------------------- HEADER -------------------------------------- //

switch($_SESSION['userlang']) {
	case "fr" : 
    $title = "Tour &agrave; Hong Kong"; break;
	case "en" : 
    $title = "Hong Kong Tour"; break;
	case "zh-tr" :
    $title = ""; break;
	default : 
    $title = "Website Home Page, invalid lang:".$_SESSION['userlang'];
}
$css[]			= '/HongKong/tools/css_global.css';
$css[] 			= '/HongKong/tools/css_main.css';
$css[] 			= '/HongKong/tools/css_stories.css';
$css[] 			= '/HongKong/tools/css_home.css';
$css[] 			= '/HongKong/tools/css_vivre.css';
$css[] 			= '/HongKong/tools/css_tourisme.css';
$js[] 			= '/HongKong/tools/tool.js';
$optionalCss    = $backCss;
$optionalJs     = $preloadBackground;
$body           = "onload='preloadBackgrounds();'";
$leftside[] 	= "Description:<br />$backDesc at $backPlace";
$rightside[] 	= "";
$beforePage			= "";
$languages['Fr']		= "Yes";
$languages['En']	= "No";
$languages['ZhTr'] 	= "No";
$metaOthers			= "";
$headerMisc			= "";
if ( isset($isAdminPage) && ($isAdminPage == true) ){
	adminHeader($title, $css, $js, "UTF-8", $optionalCss, $optionalJs, $body, $leftside, $rightside, $beforePage, $languages, $metaOthers, $headerMisc);
}
else{
	globalHeader($title, $css, $js, "UTF-8", $optionalCss, $optionalJs, $body, $leftside, $rightside, $beforePage, $languages, $metaOthers, $headerMisc);
}
?>

  <!-- // ====================== MAIN SUMMARY ============================== // -->
  <ul class='summary_main'>
  <a href='/HongKong/index.php'>          <li>Accueil du mini-site   </li></a>
	<a href='/HongKong/Stories/index.php'>  <li>Anecdote               </li></a>
	<a href='/HongKong/Vivre/index.php'>    <li>Vivre a Hong Kong      </li></a>
	<a href='/HongKong/Tourisme/index.php'>  <li>Tourisme              </li></a>
	  <!-- // me only -->
		<?php if ($_SESSION['userlevel'] >= 3) {?>
		<a href='/HongKong/Admin/index.php'><li>Admin Panel</li></a>
		<?php } ?>
  </ul>



  <!-- // ====================== SUB SUMMARY ========================== // -->

  <div id = "submenu_home" class = "sub_menu">
  <ul>
    <a href='/HongKong/index.php'>       <li>Index</li></a>
    <a href='/HongKong/Home/update.php'> <li>Updates</li></a>
  </ul>
  </div>

  <div id = "submenu_admin" class = "sub_menu">
  <ul>
    <a href='/HongKong/Admin/index.php'>              <li>Admin Index</li></a>
    <a href='/HongKong/Admin/admin_oufcategorie.php'> <li>Story Cate</li></a>
    <a href='/HongKong/Admin/admin_oufcreate.php'>    <li>Story Item</li></a>
    <a href='/HongKong/Admin/admin_oufphoto.php'>     <li>Story Photo</li></a>
    <a href='/HongKong/Admin/admin_oufcomment.php'>   <li>Story Comment</li></a>
    <a href='/HongKong/Admin/admin_checksql.php'>     <li>Check SQL</li></a>
    <a href='/HongKong/Admin/admin_background.php'>   <li>Background</li></a>
    <a href='/HongKong/Admin/admin_mainupdate.php'>   <li>Main Update</li></a>
  </ul>
  </div>
  
  
  <div id = "submenu_stories" class = "sub_menu">
  <ul>
    <a href='/HongKong/Stories/index.php'><li>Index</li></a>
    <a href='/HongKong/Stories/ouf_display.php'><li>Les Histoires</li></a>
  </ul>
  </div>
  
  
  <div id = "submenu_vivre" class = "sub_menu">
  <ul>
    <a href='/HongKong/Vivre/index.php'>    <li>Index</li></a>
    <a href='/HongKong/Vivre/manger.php'>   <li>Manger</li></a>
    <a href='/HongKong/Vivre/bouger.php'>   <li>Bouger</li></a>
    <a href='/HongKong/Vivre/boire.php'>    <li>Boire</li></a>
    <a href='/HongKong/Vivre/habiter.php'>  <li>Habiter</li></a>
    <a href='/HongKong/Vivre/shopping.php'> <li>Shopping</li></a>
  </ul>	
  </div>
  
  
  <div id = "submenu_tourisme" class = "sub_menu">
  <ul>
    <a href='/HongKong/Tourisme/index.php'><li>Tourisme Index</li></a>
  </ul>
  </div>
  
      
  
  
  <div class = 'page_left'>
  <?php
  /*
    $currentFolder = dirname($_SERVER['PHP_SELF']);
    $currentFolder = substr($currentFolder, 10);
    //echo($currentFolder.'<br />');
	
    if ($currentFolder == "" || $currentFolder == "Home") {
      echo("
        <p class = 'summary'> >> Home </p>
          <ul class='summary_leftside'>
            <a href='/HongKong/index.php'>       <li>Index</li></a>
            <a href='/HongKong/Home/update.php'> <li>Updates</li></a>
          </ul>
      ");
    }

	
    if ($currentFolder == "Admin" && $_SESSION['userlevel'] >= 3) {
      echo("
        <p class = 'summary'> >> Admin Panel </p>
          <ul class='summary_leftside'>
            <a href='/HongKong/Admin/index.php'>              <li>Admin Index</li></a>
            <a href='/HongKong/Admin/admin_oufcategorie.php'> <li>Story Cate</li></a>
            <a href='/HongKong/Admin/admin_oufcreate.php'>    <li>Story Item</li></a>
            <a href='/HongKong/Admin/admin_oufphoto.php'>     <li>Story Photo</li></a>
            <a href='/HongKong/Admin/admin_oufcomment.php'>   <li>Story Comment</li></a>
            <a href='/HongKong/Admin/admin_checksql.php'>     <li>Check SQL</li></a>
            <a href='/HongKong/Admin/admin_background.php'>   <li>Background</li></a>
            <a href='/HongKong/Admin/admin_mainupdate.php'>   <li>Main Update</li></a>
          </ul>
        ");
    }
    else if ($currentFolder == "Stories") {
      echo("
        <p class = 'summary'> >> Anecdotes </p>
        <ul class='summary_leftside'>
           <a href='/HongKong/Stories/index.php'><li>Index</li></a>
           <a href='/HongKong/Stories/ouf_display.php'><li>Les Histoires</li></a>
        </ul>
      ");

    }
    else if ($currentFolder == "Vivre") {
      echo("
      <p class = 'summary'> >> Vivre &agrave; Hong Kong </p>
        <ul class='summary_leftside'>
          <a href='/HongKong/Vivre/index.php'>    <li>Index</li></a>
          <a href='/HongKong/Vivre/manger.php'>   <li>Manger</li></a>
          <a href='/HongKong/Vivre/bouger.php'>   <li>Bouger</li></a>
          <a href='/HongKong/Vivre/boire.php'>    <li>Boire</li></a>
          <a href='/HongKong/Vivre/habiter.php'>  <li>Habiter</li></a>
          <a href='/HongKong/Vivre/shopping.php'> <li>Shopping</li></a>
       </ul>	
      ");
    }
    else if ($currentFolder == "Tourisme") {
      echo("
      <p class = 'summary'> >> Tourisme </p>
        <ul class='summary_leftside'>
          <a href='/HongKong/Tourisme/index.php'><li>Tourisme Index</li></a>
        </ul>	
      ");
    }
    */
?>

    </div> <!-- end div class = 'page_left' -->
    
    <div class = 'page_center'>


