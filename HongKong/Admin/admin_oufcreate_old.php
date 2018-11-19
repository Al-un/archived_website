<?php
  include('../tools/header.php');
?>

<h2> Anecdotes - Cr&eacute;er </h2>

<!-- // ===================================== A NEW STORY IS ADDED ============================= // -->  

<?php
  if (isset($_POST['submit'])) {
    
    $title = get('title');
    $content = get('content');
    $categories = $_POST['category'];
   
    // add the story 
    sql_query("INSERT INTO `$SQL_DATABASE`.`$table_OufItem` VALUES ( NULL, '$title', '$content', NULL)");
   
    // get his id
    $idSearchRaw = sql_assoc("SELECT id_oufitem FROM `$SQL_DATABASE`.`$table_OufItem` WHERE `title`='$title'");
    $idSearch = $idSearchRaw['id_oufitem'];
    
    // link with tabs
    foreach($categories as $zecategory_id) {
        sql_query("INSERT INTO `$SQL_DATABASE`.`$table_OufItemCate` VALUES (NULL, '$idSearch', '$zecategory_id')");
    }
    
    echo('<p>Story successfully added</p>');     
  }
?>



<!-- // ===================================== ADD A STORY... =================================== // -->

<form method = 'post' action = <?php echo($_SERVER['PHP_SELF']); ?>>

  <dl>
  
    <dt>Title (maxlength = 75)</dt>
	  <dd><input type = 'text' name = 'title' size = '85' maxlength='75' /></dd>
	  
	  <dt>Content (maxlength = 1000)</dt>
	  <dd><textarea name = 'content' rows = '20' cols = '65' maxlength='1000' ></textarea></dd>
	  
	  <dt>Tags (Categories) </dt>
	  <dd><?php 
      $allCategoriesRaw = sql_query('SELECT id_oufcategorie,name FROM '.$table_OufItem);
      while ($oneCategorie = mysql_fetch_assoc($allCategoriesRaw)){
        $cate_id = $oneCategorie['id_oufcategorie'];
        $cate_name = $oneCategorie['name'];
        echo("<input type='checkbox' name='category[]' value='$cate_id'/> $cate_name <br />");
      }
    ?></dd>
    
    <dt>Pictures </dt>
    <dd>
    </dd>
	  
	</dl>
	
	<input type = 'submit' name = 'submit' value = 'Add a new story' />

</form>

<?php
  include('../tools/footer.php');
?>