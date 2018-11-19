<?php
  include('../tools/header.php');
	
	$table_cate = 'cuisine_categorie';
	$table_item = 'cuisine_recette';

	/**** gestion d'une creation de recette ***/
	$categorie 	= get('categorie');
	$nom 				= get('nom');
	$ingredients= get('ingredients');
	$ustensiles = get('ustensiles');
	$temps 			= get('temps');
	$recette 		= get('recette');
	
	if ($nom != "" && $recette != ""){
		$date		= date("Y-m-d-G-i-s");
		sql_query("	INSERT INTO $table_item 
			 					VALUES ( NULL,'$categorie','$nom','$ingredients','$ustensiles','$temps','$recette','$date','$user')");
		header("Location:miam.php");
		DIE();
	}
	

	/**** sinon on propose un formulaire pour ajouter une recette ***/
	$result= sql_query('SELECT id,Categorie	FROM '.$table_cate);

	if ($logged) {
?>
		
		<form method = "post" action = "recette_creer.php" class = "creer">
		
		<h2>Créer une Recette</h2>
		<table border = "6">
			<tr>
				<td>Nom de la recette</td>
				<td><input type = "text" name = "nom" size = "66"></td>
			</tr>
			<tr>
				<td>Catégorie</td>
				<td>
					<select name = 'categorie'>
				<?php
					while ($data = mysql_fetch_assoc($result)){
					 	$cate = $data['Categorie'];
						echo("<option value = '$cate'> $cate </option>");
					}
				?>
					</select>
				</td>
			</tr>	
			<tr>	
				<td>Ingredients</td>
				<td><textarea name = "ingredients" rows = "3" cols = "50"></textarea></td>
			</tr>		
			<tr>
				<td>Ustensiles</td>
				<td><textarea name = "ustensiles" rows = "3" cols = "50"></textarea></td>
			</tr>
			<tr>		
				<td>Temps de préparation</td>
				<td><input type = "text" name = "temps" size = "10"></td>
			</tr>
			<tr>		
				<td>Recette</td>
				<td><textarea name = "recette" rows = "10" cols = "50"></textarea></td>
			</tr>
			
		</table>
			
			<center>
				<input type = "reset" value = "Reset">
				<input type = "submit" value = "Envoyer">
			</center>
		
		</form>

<?php
		} // end if
		
	else{
	 	echo ("Non mais les droits d'utilisateur/admin c'est pas pour le fun non plus ^^ ");
	 }


  include('../tools/footer.php');
?>







