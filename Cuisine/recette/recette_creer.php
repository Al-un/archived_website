<?php
include('../tools/header.php');

// ===============================================================================//
/**** gestion d'une creation de recette ***/
$addRecette 	= get('addRecette');

if ($addRecette != '' && $addRecette == "Créer Recette"){
  
  
  
  // recette en elle même
  $recette_author	= $_SESSION['username'];
  $recette_title	= get('recette_name');
  $recette			= get('recette');
  $recette_time		= get('recette_temps');
  sql_query("INSERT INTO `$SQL_DATABASE`.`$table_cuisineRecette` VALUES(NULL, '$recette_author', '$recette_title', '$recette', '$recette_time', NULL)");
  $recette_id		= mysql_insert_id();
  
  
  
  // recette catégorie
  $recette_category	= get('recetteCategory');
  sql_query("INSERT INTO `$SQL_DATABASE`.`$table_cuisineCateRecette` VALUES(NULL, '$recette_category', '$recette_id')");
  
  
  
  // ingredients
  if (isset($_POST['ingredientId'])){
    $ingredients = $_POST['ingredientId'];
    foreach($ingredients as $oneIngredientId){
      $quantity 		= get('ingredient'.$oneIngredientId);
      sql_query("INSERT INTO `$SQL_DATABASE`.`$table_cuisineRecetteIngre` VALUES(NULL, '$recette_id', '$oneIngredientId', '$quantity')");
    }
  }
  
  
  
  // materiel
  if (isset($_POST['materielId'])){
    $materiels = $_POST['materielId'];
    foreach($materiels as $oneMaterielId){
      $quantity 		= get('materiel'.$oneMaterielId);
      sql_query("INSERT INTO `$SQL_DATABASE`.`$table_cuisineRecetteMatos` VALUES(NULL, '$recette_id', '$oneMaterielId', '$quantity')");
    }
  }
  
  header("Location:recette_miam.php?recette_id=$recette_id");
}
	

	
// ============================================================================== //
// **** recette modifié
if ($addRecette != '' && $addRecette == "Modifier Recette"){
  
  // recette en elle même
  $recette_id		= get('recetteId');
  $recette_title	= get('recette_name');
  $recette			= get('recette');
  $recette_time		= get('recette_temps');
  sql_query("
		UPDATE `$SQL_DATABASE`.`$table_cuisineRecette`
		SET `Recette%Name` = '$recette_title', `Recette` = '$recette', `Temps` = '$recette_time'
		WHERE `ID_CuisineRecette`='$recette_id'");
  
  
  
  
  // recette catégorie
  $recette_category	= get('recetteCategory');
  sql_query("UPDATE `$SQL_DATABASE`.`$table_cuisineCateRecette` SET `id_CuisineCate`='$recette_category' WHERE `id_CuisineRecette`='$recette_id'");
  
  
  
  // ingredients
  if (isset($_POST['ingredientId'])){
  
	// delete all existing entries
	sql_query("DELETE FROM `$SQL_DATABASE`.`$table_cuisineRecetteIngre` WHERE `id_CuisineRecette`='$recette_id' ");
    $ingredients = $_POST['ingredientId'];
    foreach($ingredients as $oneIngredientId){
      $quantity 		= get('ingredient'.$oneIngredientId);
      sql_query("INSERT INTO `$SQL_DATABASE`.`$table_cuisineRecetteIngre` VALUES(NULL, '$recette_id', '$oneIngredientId', '$quantity')");
    }
  }
  
  
  
  // materiel
  if (isset($_POST['materielId'])){
    // delete all existing entries
	sql_query("DELETE FROM `$SQL_DATABASE`.`$table_cuisineRecetteMatos` WHERE `id_CuisineRecette`='$recette_id' ");
    $materiels = $_POST['materielId'];
    foreach($materiels as $oneMaterielId){
      $quantity 		= get('materiel'.$oneMaterielId);
      sql_query("INSERT INTO `$SQL_DATABASE`.`$table_cuisineRecetteMatos` VALUES(NULL, '$recette_id', '$oneMaterielId', '$quantity')");
    }
  }
  
  header("Location:recette_miam.php?recette_id=$recette_id");
}	

	

	
	
	
// ===============================================================================//
// **** modification de recette
$recette_id 	= "";
$recette_name	= "";
$recette_content= "";
$recette_temps	= "";
$recette_cateId	= "";
$recette_ingre	= "";
$recette_matos	= "";
$recette_creer 	= "Créer Recette";

if (isset($_POST['recetteModifId'])){

  // id de la recette à modifier
  $recette_id = $_POST['recetteModifId'];
  
  // la carte d'identité de la recette
  $temp 	= sql_assoc("
			SELECT `Recette`, `Recette%Name`, `Temps`
			FROM `$SQL_DATABASE`.`$table_cuisineRecette`
			WHERE `$table_cuisineRecette`.`ID_CuisineRecette` = '$recette_id'");
  $recette_name 	= $temp['Recette%Name'];
  $recette_content	= $temp['Recette'];
  $recette_content	= str_replace("<br />", "", $recette_content);
  $recette_temps	= $temp['Temps'];
  
  // catégorie de la recette
  $temp		= sql_assoc("SELECT `id_CuisineCate` FROM `$SQL_DATABASE`.`$table_cuisineCateRecette` WHERE `$table_cuisineCateRecette`.`id_CuisineRecette`='$recette_id'");
  $recette_cateId	= $temp['id_CuisineCate'];
  
  // ingrédients?
  $temp 	= sql_query("
			SELECT `$table_cuisineIngredient`.`ID_CuisineIngredient`, `Ingredient%Name`, `Ingredient%Quantity`
			FROM `$SQL_DATABASE`.`$table_cuisineIngredient`, `$SQL_DATABASE`.`$table_cuisineRecetteIngre`
			WHERE `$table_cuisineRecetteIngre`.`id_CuisineRecette` = '$recette_id'
			AND `$table_cuisineRecetteIngre`.`id_CuisineIngredient` = `$table_cuisineIngredient`.`ID_CuisineIngredient`");
  while($anIngre = mysql_fetch_assoc($temp)) {
    $ingredientId	= $anIngre['ID_CuisineIngredient'];
    $recette_ingre .= "   <tr id='ingredient$ingredientId'>
    <td><input type='checkbox' name='ingredientToDelete' value='$ingredientId' /></td>
    <td><input type='text'     name='ingredient$ingredientId' size='1' maxlength='15' value='".$anIngre['Ingredient%Quantity']."' /></td>
    <td>".$anIngre['Ingredient%Name']."</td>
    <input type='hidden'   name='ingredientId[]' value='$ingredientId' />
   </tr>\n";
  }
  // matos?
  $temp 	= sql_query("
			SELECT `$table_cuisineMateriel`.`ID_CuisineMateriel`, `Materiel%Name`, `Matos%Quantity`
			FROM `$SQL_DATABASE`.`$table_cuisineMateriel`, `$SQL_DATABASE`.`$table_cuisineRecetteMatos`
			WHERE `$table_cuisineRecetteMatos`.`id_CuisineRecette` = '$recette_id'
			AND `$table_cuisineRecetteMatos`.`id_CuisineMateriel` = `$table_cuisineMateriel`.`ID_CuisineMateriel`");
  while($aMatos = mysql_fetch_assoc($temp)) {
    $matosId	= $aMatos['ID_CuisineMateriel'];
    $recette_matos .= "   <tr id='materiel$matosId'>
    <td><input type='checkbox' name='materielToDelete' value='$matosId' /></td>
    <td><input type='text'     name='materiel$matosId' size='1' maxlength='15' value='".$aMatos['Matos%Quantity']."' /></td>
    <td>".$aMatos['Materiel%Name']."</td>
    <input type='hidden'   name='materielId[]' value='$matosId' />
   </tr>\n";
  }
  
  $recette_creer	= "Modifier Recette";
  
}
	
	
	
	
	
	
// ===============================================================================//
/**** sinon on propose un formulaire pour ajouter une recette ***/




// === les catégories de recette
$temp = sql_query("SELECT `ID_CuisineCate`, `Category%Name`, `Order` FROM `$SQL_DATABASE`.`$table_cuisineCate` ORDER BY `Order`");
$categoryList = "";
while ($aCate = mysql_fetch_assoc($temp)) {
  $selected		 = ($recette_cateId == $aCate['ID_CuisineCate']) ? "selected" : "";
  $categoryList .= "  <option value='".$aCate['ID_CuisineCate']."' $selected> ".$aCate['Category%Name']." </option>\n";
}
$categoryList = "  <select name='recetteCategory'>\n".$categoryList."  </select>";




// === les ingrédients
$temp = sql_query("SELECT `ID_CuisineIngreCate`, `Ingredient%Category%Name` FROM `$SQL_DATABASE`.`$table_cuisineIngreCate` ORDER BY `Ingredient%Category%Name`");
$ingredientList = "";
while ($anIngredientCate = mysql_fetch_assoc($temp)) {
  $ingredientList .="  <option value='".$anIngredientCate['ID_CuisineIngreCate']."' disabled='disabled'> &nbsp; -- ".$anIngredientCate['Ingredient%Category%Name']." -- </option>\n";
  $temp2 = sql_query("
			SELECT `$table_cuisineIngredient`.`ID_CuisineIngredient`, `Ingredient%Name` 
			FROM `$SQL_DATABASE`.`$table_cuisineIngredient`, `$SQL_DATABASE`.`$table_cuisineCateIngre`
			WHERE `$table_cuisineCateIngre`.`id_CuisineIngredient` = `$table_cuisineIngredient`.`ID_CuisineIngredient`
			AND `$table_cuisineCateIngre`.`id_CuisineIngreCate` = '".$anIngredientCate['ID_CuisineIngreCate']."'
			ORDER BY `Ingredient%Name`");
  while ($anIngredient = mysql_fetch_assoc($temp2)) {
    $ingredientList .= "  <option value='".$anIngredient['ID_CuisineIngredient']."'> ".$anIngredient['Ingredient%Name']." </option>\n";
  }
}
$ingredientList = "  <div id='IngredientListField' class='List'>
  <select id='IngredientSelect' name='ingredientList[]' multiple='multiple'>\n".$ingredientList."\n  </select>
  <p id='AddIngredient' class='creer_button'>Ajouter les Ingrédients sélectionnés</p>
  </div>\n";
$ingredientField = "  <div id='IngredientField' class='Field'>
  <table border='0'>
  <tr> <th><img src='/Cuisine/img/supprimer.png' title='Supprimer' alt='Supprimer' width='25' height='25'/></th> <th>Quantité</th> <th>Ingrédient</th>  </tr>
$recette_ingre
  </table>
  <p id='DeleteIngredient' class='creer_button'> Supprimer les Ingredients sélectionnés </p>
  </div>\n";
// --- mix le Field (à gauche) et la Liste (à droite)
$ingredientField = "  <div id='Ingre' class='ListArea'>".$ingredientField.$ingredientList."  </div>";




// === le matos
$temp = sql_query("SELECT `ID_CuisineMateriel`, `Materiel%Name` FROM `$SQL_DATABASE`.`$table_cuisineMateriel`");
$materielList = "";
while ($aMateriel = mysql_fetch_assoc($temp)) {
  $materielList .= "  <option value='".$aMateriel['ID_CuisineMateriel']."'> ".$aMateriel['Materiel%Name']." </option>\n";
}
$materielList = "  <div id='MaterielListField' class='List'>
  <select id='MaterielSelect' name='materielList[]' multiple='multiple'>\n".$materielList."\n  </select>
  <p id='AddMateriel' class='creer_button'>Ajouter le Matériel sélectionné</p>
  </div>\n";
$materielField = "  <div id='MaterielField' class='Field'>
  <table border='0'>
  <tr> <th><img src='/Cuisine/img/supprimer.png' title='Supprimer' alt='Supprimer' width='25' height='25'/></th> <th>Quantité</th> <th>Matos</th>  </tr>
$recette_matos
  </table>
  <p id='DeleteMateriel' class='creer_button'> Supprimer le Matériel sélectionné </p>
  </div>\n";
$materielField = "  <div id='Matos' class='ListArea'>".$materielField.$materielList."  </div>";



$recette_form = "
  <form method = 'post' action = 'recette_creer.php' class = 'creer'>
		
  <h2>Créer une Recette</h2>
  <table border = '6' class = 'creer'>
   <tr> <td>Nom de la recette</td>		<td><input type='text' name='recette_name' size='66' maxlength='70' value='$recette_name'/></td> </tr>
   <tr> <td>Catégorie</td>    			<td> $categoryList </td> </tr>
   <tr> <td>Temps de préparation</td> 	<td><input type='text' name='recette_temps' size='10' maxlength='15' value='$recette_temps' /></td> </tr>
   <tr> <td>Ingredients</td>          	<td> $ingredientField</td> </tr>		
   <tr> <td>Matériel</td>             	<td> $materielField</td> </tr>
   <tr> <td>Recette</td>              	<td><textarea name='recette' rows='20' cols='60'>$recette_content</textarea></td> </tr>
  </table>
			
  <center>
    <input type = 'hidden' name='recetteId' value='$recette_id' />
    <input type = 'reset' value = 'Reset' />
    <input type = 'submit' name='addRecette' value = '$recette_creer' />
  </center>
		
  </form>";
  
if ($_SESSION['userlevel'] >= 1){
  echo($recette_form);
}
else{
  echo ("Non mais les droits d'utilisateur/admin c'est pas pour le fun non plus ^^ ");
}


include('../tools/footer.php');
?>







