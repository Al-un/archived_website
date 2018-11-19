<?php
$table		= "cuisine_recette";

	// **************************************************
	// Affiche le sommaire de toutes les recettes
	// **************************************************
	function recette_sommaire(){
	 
	 	global $mysql;
	 	$miam_query = sql_query("SELECT Categorie,Ordre FROM cuisine_categorie ORDER BY Ordre");
		
	 	echo("<div class = 'miam_menu'> ");
	 	echo('<p class = "title">Menu</p>');
	 	
	 	// -- On affiche les categories -- //
	 	while ( $data = mysql_fetch_assoc($miam_query) ){
	 	 	$cate_nom	= $data['Categorie'];
	 	 	$one_cate	= sql_query("SELECT id,Nom FROM cuisine_recette WHERE Categorie = '$cate_nom'");
	 	 	$cate_nb	= mysql_num_rows($one_cate);
	 	 	echo("<p>$cate_nom ($cate_nb)</p>");
	 	 	
	 	 	// -- Pour chaque catégorie, on affiche les recette associées -- //
			echo ('<ul class = "nom_recette">');
	 	 	while ( $cate_data = mysql_fetch_assoc($one_cate) ){
	 	 	 	$recette_nom = $cate_data['Nom'];
			 	$url	= 'recette_miam.php?id='.$cate_data['id'];
			 	echo("<li><a href = $url> $recette_nom </a></li>");
	 	 	 }
	 	 	 echo('</ul>');
	 	 	 
	 	 }
	 	 echo('</div>');
	 }



	// **************************************************
	// Affiche une recette en particulier
	// **************************************************
	function recette_affiche($id){
	 
		global $mysql,$table,$level;

	 	$recette = sql_assoc("SELECT id,Categorie,Nom,Ingredients,Ustensiles,Temps,Recette,Date,Auteur FROM $table WHERE id = '$id'");
	 		 
	 	?>	

			<div class = "recette">
			
				<!-- // only the admins can modify a recipe -->
				<?php if ($level >= 2){ ?>
				<form method = "post" action = "recette_modif.php">
					<input type = "hidden" value = <?php echo($recette['id']); ?> name = "id">
					<input type = "image" alt = "Modifier" src = "img/modif.png">
				</form>
				<?php } ?>

		 	 	<p> <?php echo($recette['Nom']); ?> </p>
		 	 	
		 	 	<table border = "0">
		 	 		<tr>
		 	 			<td> Auteur </td>
		 	 			<td> <?php echo($recette['Auteur']); ?></td>
		 	 		</tr>
		 	 		<tr>
		 	 			<td> Posté le </td>
		 	 			<td> <?php echo($recette['Date']); ?></td>
		 	 		</tr>
		 	 	</table>
		 	 	
		 		<dl>
		 			<dt>Ingredients</dt>
		 			<dd> 	<?php echo($recette['Ingredients']); ?>	</dd>
		 			<dt>Ustensiles</dt>
		 			<dd>	<?php echo($recette['Ustensiles']); ?>	</dd>
		 			<dt>Temps de préparation</dt>
		 			<dd>	<?php echo($recette['Temps']); ?>		</dd>
		 			<dt>Recette</dt>
		 			<dd>	<?php echo($recette['Recette']); ?>		</dd>
		 		</dl>
		 		
		 	</div>

	 	<?php	 
	 		 
	 }//end function recette_affiche

?>