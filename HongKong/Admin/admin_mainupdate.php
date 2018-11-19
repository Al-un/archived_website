<?php
  include('../tools/header.php');
  
  if (isset($_POST['submit'])) {
   
    $id_hk_minisite_raw = sql_assoc("
                          SELECT `Id_minisite` FROM `$SQL_DATABASE`.`$table_minisite`
                          WHERE `Url_Site%Url`='/HongKong/index.php'");
    $id_hk_minisite = $id_hk_minisite_raw['Id_minisite'];
    
    $updateFr = get('updateFr');
    $updateEn = get('updateEn');
      
    sql_query("
      INSERT INTO `$SQL_DATABASE`.`$table_update`
      VALUES ( NULL, '$id_hk_minisite', '$updateFr', '$updateEn', NULL);
    ");
      
  }
?>


<form method = 'post' action = 'admin_mainupdate.php'>
  <dl>
      
    <dt>Update Fr</dt>
    <dd><textarea name = 'updateFr' maxlength = '150' rows = '6' cols = '50'></textarea></dd>

    <dt>Update En</dt>
    <dd><textarea name = 'updateEn' maxlength = '150' rows = '6' cols = '50'></textarea></dd>

    <dt></dt>
    <dd><input type = 'submit' name = 'submit' value = 'Update' /></dd>
  </dl>
</form>

<?php
  include('../tools/footer.php');
?>