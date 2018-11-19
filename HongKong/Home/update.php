<?php
  include('../tools/header.php');

  // ========================================= MODIFYING AN UPDATE? ============================================= //
  
  
  
  // ========================================= DELETING AN UPDATE? ============================================== //
  
  
  // ========================================== DISPLAY ALL THE UPDATES ========================================= //
  $allUpdateRaw = sql_query("SELECT `id_hkupdate`,`title`,`update`,`datetime` FROM `$SQL_DATABASE`.`$table_HkUpdate`");
  
  while ($update = mysql_fetch_assoc($allUpdateRaw)) {
    
    $updateId      = $update['id_hkupdate'];
    $updateTitle   = $update['title'];
    $updateContent = $update['update'];
    $updateDate    = $update['datetime'];
	
    $option        = "";
    if ($SESSION_USERLEVEL >= 3) {
      $option = "
      <p>
        <a href = 'update.php?action=modify&id=$updateId'> Modify </a>
        <a href = 'update.php?action=delete&id=$updateId'> Delete </a>
      </p>";
    }
	
    echo("
    <div class = 'update'>
	    <p class = 'title'>$updateTitle <span class = 'datetime'>at $updateDate</span></p>
	    <p class = 'update'>$updateContent</p>
	    $option
    </div>
	");
  }
  ?>


<?php
  include('../tools/footer.php');
?>