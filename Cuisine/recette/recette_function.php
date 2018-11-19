<?php
// **************************************************
// Affiche le sommaire de toutes les recettes
// **************************************************
function recette_sommaire(){

  global $SQL_DATABASE, $table_cuisineCateRecette, $table_cuisineCate, $table_cuisineRecette;
  $sommaire = "";

  $category = sql_query("SELECT `ID_CuisineCate`, `Category%Name`, `Order` FROM `$SQL_DATABASE`.`$table_cuisineCate` ORDER BY `Order`");
  while ( $aCategory = mysql_fetch_assoc($category) ){
    
	$sommaire .= "  <div>\n   <p>".$aCategory['Category%Name']."</p>\n   <ul>";
	
	$recette = sql_query("
	  SELECT `$table_cuisineRecette`.`ID_CuisineRecette`, `Recette%Name`
	  FROM `$SQL_DATABASE`.`$table_cuisineRecette`, `$SQL_DATABASE`.`$table_cuisineCateRecette`
	  WHERE `$table_cuisineCateRecette`.`id_CuisineCate` = '".$aCategory['ID_CuisineCate']."'
	  AND `$table_cuisineCateRecette`.`id_CuisineRecette` = `$table_cuisineRecette`.`ID_CuisineRecette`
	  ORDER BY `Recette%Name`");
    
	while( $aRecette = mysql_fetch_assoc($recette) ){
	  $sommaire .= "    <li><a href='".$_SERVER['PHP_SELF']."?recette_id=".$aRecette['ID_CuisineRecette']."'> ".$aRecette['Recette%Name']." </a></li>";
	}
	$sommaire .= "   </ul>\n  </div>\n";
  }	 	

  $sommaire = " <div id='recette_sommaire'>\n  $sommaire </div>";
  echo($sommaire);
}



// **************************************************
// Affiche une recette en particulier
// **************************************************
function recette_affiche($id){
	 
  global $SQL_DATABASE, $table_cuisineIngredient, $table_cuisineRecetteIngre, $table_cuisineMateriel, $table_cuisineRecetteMatos, $table_cuisineRecette, $table_cuisineRecette, $table_cuisineComm, $table_cuisinePhoto;
  
  // ingredients
  $ingredients = sql_query("
	SELECT `Ingredient%Name`, `Ingredient%Quantity`
	FROM `$SQL_DATABASE`.`$table_cuisineIngredient`, `$SQL_DATABASE`.`$table_cuisineRecetteIngre`
	WHERE `$table_cuisineRecetteIngre`.`id_CuisineRecette` = '$id'
	AND `$table_cuisineRecetteIngre`.`id_CuisineIngredient` = `$table_cuisineIngredient`.`ID_CuisineIngredient`");
  $ingredient_display = "";
  while ($anIngredient = mysql_fetch_assoc($ingredients)){
    $ingredient_display .= "   <li>".$anIngredient['Ingredient%Quantity']." ".$anIngredient['Ingredient%Name']."</li>\n";
  }
  $ingredient_display = "  <ul>\n".$ingredient_display."  </ul>\n";
	
  // required materiel
  $materiel = sql_query("
	SELECT `Materiel%Name`, `Matos%Quantity`
	FROM `$SQL_DATABASE`.`$table_cuisineMateriel`, `$SQL_DATABASE`.`$table_cuisineRecetteMatos`
	WHERE `$table_cuisineRecetteMatos`.`id_CuisineRecette` = '$id'
	AND `$table_cuisineRecetteMatos`.`id_CuisineMateriel` = `$table_cuisineMateriel`.`ID_CuisineMateriel`");
  $materiel_display = "";
  while ($aMateriel = mysql_fetch_assoc($materiel)){
    $materiel_display .= "   <li>".$aMateriel['Matos%Quantity']." ".$aMateriel['Materiel%Name']."</li>\n";
  }
  $materiel_display = "  <ul>\n".$materiel_display."  </ul>\n";
  
  
  // la recette
  $recette = sql_assoc("
	SELECT `Author`, `Recette`, `Recette%Name`, `Temps`, `UpDT_datetime`
	FROM `$SQL_DATABASE`.`$table_cuisineRecette`
	WHERE `$table_cuisineRecette`.`ID_CuisineRecette` = '$id'");

  $recette_display = "
  <p class='author'> par <i>".$recette['Author']."</i> - dernière modification le ".$recette['UpDT_datetime']."</p>
  <table border = '1' class='recette'>
   <tr> <td> Temps de préparation </td> <td>".$recette['Temps']."</td> </tr>
   <tr> <td> Ingrédients </td> <td>".$ingredient_display."</td> </tr>
   <tr> <td> Matériel </td> <td>".$materiel_display."</td> </tr>
  </table>
  
  <div class='recette_content'>\n".$recette['Recette']."\n  </div>";
  
  
  // title and modify button.
  $recette_title = " <p class='recette_title'>".$recette['Recette%Name']."</p>";
  if ($_SESSION['userlevel'] > 1 || $_SESSION['username'] == $recette['Author']){
    $recette_title .= "  <form method = 'post' action = 'recette_creer.php'>
   <input type = 'hidden' value = '$id' name = 'recetteModifId'>
   <input type = 'image' alt = 'Modifier' src = '/Cuisine/img/modif.png'>
  </form>";
  }
  // les photos
  
  // les commentaires
  
  $recette = " <div id='recette'>
$recette_title
$recette_display
 </div>";
  echo($recette);
}//end function recette_affiche

?>