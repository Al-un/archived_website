	<?php
		include("../login.php");
		include("tool/header.php");
		include("tool/fonction.php");
		head("Miam Zone - Modifier une recette");
		
		// ------------ Recette
		
			$id = $_POST['id'];
		 	$Categorie = get('categorie');
		 	$Nom = get('Nom');
		 	$Ingredients = get('Ingredients');
		 	$Ustensiles = get('Ustensiles');
		 	$Temps = get('Temps');	
		 	$Recette = get('Recette');	
		 	$Date = date("Y-m-d-G-i-s");
		 	$Auteur = $_SESSION['user'];
		 	
		 	$query = "	UPDATE cuisine_recette SET
		 				`Categorie`= '$Categorie',
		 				`Nom`= '$Nom',
		 				`Ingredients`= '$Ingredients',
		 				`Ustensiles`= '$Ustensiles',
		 				`Temps`= '$Temps',
		 				`Recette`= '$Recette',
		 				`Date`= '$Date',
		 				`Auteur`= '$Auteur'
		 				WHERE `id` = $id";
		 				
		 	mysql_query($query,$mysql) OR DIE ("Query failed: ".$query);
		 	
		 	header("Location:miam.php?id=".$id);
		 	
		include("tool/footer.php");
	?>