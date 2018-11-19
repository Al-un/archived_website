	<?php
		include("../login.php");
		include("tool/header.php");
		include("tool/fonction.php");
		head("Miam Zone - Modifier une recette");
		
		$id = (-1);
		$id = $_POST['id'];
		
		$query = "SELECT * FROM cuisine_recette WHERE id = ".mysql_real_escape_string($id);;
		$result = mysql_query($query,$mysql) OR DIE ('mysql_query error: '.$query);
		$data = mysql_fetch_assoc($result);
		$categorie = $data['Categorie'];
		
		$query = "SELECT * FROM cuisine_categorie";
		$result= mysql_query($query,$mysql) OR DIE ('mysql_query error: '.$query);
		
	?>
	
		<form method = "post" action = "recette_modif_ok.php" class = "creer">
		
			<h2>Modifier une Recette</h2>
			<input type = "hidden" value = <?php echo($id); ?> name = "id">
		
		<table border = "6">
			<tr>
				<td>Nom de la recette</td>
				<td><input type = "text" name = "Nom" size = "66" value = <?php echo($data['Nom']);?> ></td>
			</tr>
			<tr>
				<td>Catégorie</td>
				<td>
					<select name = 'categorie'>
				<?php
				while ($data_cate = mysql_fetch_assoc($result)){
					$cate = $data_cate['Categorie'];
					if ($cate == $categorie){
					 	echo("<option selected value = '".$data_cate['Categorie']."'> ".$data_cate['Categorie']."</option>");
					 	}
					else{
						echo("<option value = '".$data_cate['Categorie']."'> ".$data_cate['Categorie']."</option>");
					}
				}
				?>
					</select>
				</td>
			</tr>	
			<tr>	
				<td>Ingredients</td>
				<td><textarea name = "Ingredients" rows = "3" cols = "50"><?php echo($data['Ingredients']);?></textarea></td>
			</tr>		
			<tr>
				<td>Ustensiles</td>
				<td><textarea name = "Ustensiles" rows = "3" cols = "50"><?php echo($data['Ustensiles']);?></textarea></td>
			</tr>
			<tr>		
				<td>Temps de préparation</td>
				<td><input type = "text" name = "Temps" size = "10" value = <?php echo($data['Temps']);?> ></td>
			</tr>
			<tr>		
				<td>Recette</td>
				<td><textarea name = "Recette" rows = "10" cols = "50"><?php echo($data['Recette']);?></textarea></td>
			</tr>
			
		</table>
			
			<center>
				<input type = "reset" value = "Reset">
				<input type = "submit" value = "Envoyer">
			</center>
		
		</form>
	
		
	<?php	
		include("tool/footer.php");
	?>