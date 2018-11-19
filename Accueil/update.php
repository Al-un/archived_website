<?php


// ================================= SWITCH LANGUAGES ========================= //
switch($_SESSION['userlang']) {

  case "Fr" :
    $updateTitle    = "Mises &agrave; jour";
    $sqlContent     = "Txt_Content%Fr";
	$displayPage    = "Page";
    break;
	
  case "En" :
    $updateTitle    = "Updates";
    $sqlContent     = "Txt_Content%En";
	$displayPage    = "Page";
    break;
	
  case "ZhTr" :
    $updateTitle    = "更新";
    $sqlContent     = "Txt_Content%ZhTr";
	$displayPage    = "頁碼";
    break;

  default: echo("<p>Wrong user language: ".$_SESSION['userlang']."</p>");
}

// ============================== DISPLAY TITLE ============================== //

echo("<div id = 'update' class = 'update'>

     <h2>$updateTitle</h2>");
     
     
	 
// ============================== DISPLAY UPDATES ADMIN PANEL ============================== //
/*
if ($_SESSION['userlevel'] >= 3) {
  echo("    <p> <a href = '/Accueil/Admin/admin_update.php'>Manage Updates</a> </p>");
}
*/


// ============================== DISPLAY UPDATES ============================== //

// ---- next page/ previous page -- //
$page      = (isset($_POST['UpdatePage'])) ? get('UpdatePage') : 0;
$nbItemPerPage = 5;

// --- count number of update and number max page
$countRaw  = sql_assoc("SELECT COUNT(`ID_Update%ID`) FROM `$SQL_DATABASE`.`$table_all_updates`");
$countTot  = $countRaw['COUNT(`ID_Update%ID`)'];
$pageMax   = intval($countTot/$nbItemPerPage);

// --- form buttons to change page
$formPrev = "
<form method = 'post' action = '".$_SERVER['PHP_SELF']."#update'>
  <input type = 'hidden' name = 'UpdatePage' value = '".($page-1)."' />
  <input type = 'submit' name = 'UpdatePrev' value = 'Previous Page' />
</form>";
$formNext = "
<form method = 'post' action = '".$_SERVER['PHP_SELF']."#update'>
  <input type = 'hidden' name = 'UpdatePage' value = '".($page+1)."' />
  <input type = 'submit' name = 'UpdatePrev' value = 'Next Page' />
</form>";

// --- display form or not
$textPrev = ($page > 0 ) ? $formPrev : "";
$textNext = ($page < $pageMax ) ? $formNext : "";

// ----- next/prev
echo("
  <div class = 'update_nextprev'>
    <table> <tr> <td> $textPrev </td> <td> <p>$displayPage $page/$pageMax</p> </td> <td>$textNext </td> </tr> </table>
  </div>");

// --- DISPLAY UPDATES
$updatesRaw = sql_query("
  SELECT `$sqlContent`,`UpDT_Date`,`Site%Name`,`UrlImg_Site%Icon`,`Url_Site%Url`
  FROM `$SQL_DATABASE`.`$table_all_updates`,`$SQL_DATABASE`.`$table_all_minisites`
  WHERE `$table_all_updates`.`id_minisite` = `$table_all_minisites`.`ID_Minisite%ID`
  LIMIT $page,$nbItemPerPage");
	
while($update = mysql_fetch_assoc($updatesRaw)) {

  $siteName = $update['Site%Name'];

  echo("
  
  
  
  <div class = 'item'>
	
	<img src = '/Accueil/img/update_back.png' class = 'background' />
	
	<div class = 'table'>
	  <div class = 'row'>
	    <div class = 'site'>	Mini Site </div>
		<div class = 'site_url'> <a href = '".$update['Url_Site%Url']."'> $siteName </a>  </div>
	  </div>
	  <div class = 'row'>
	    <div class = 'site_icon'> 
			<a href = '".$update['Url_Site%Url']."'>
			<img src = '".$update['UrlImg_Site%Icon']."' title = '$siteName' alt = '$siteName' class = 'icon'/>
			</a>
		</div>
		<div class = 'site_update'> ".$update[$sqlContent]." </div>
	  </div>
	</div>
	
    <div class = 'update_date'> ".$update['UpDT_Date']."</div>
	
  </div> <!-- end class = item -->
  ");

}

// ----- next/prev	
echo("
  <div class = 'update_nextprev'>
    <table> <tr> <td> $textPrev </td> <td> <p>$displayPage $page/$pageMax</p> </td> <td>$textNext </td> </tr> </table>
  </div>\n");
echo("  </div>");
?>