<?php
	include('../tools/header.php');
?>
  <a href='admin_index.php'>Retour Admin Index</a><br />
<?php		
	// ***** seuls les admin peuvent accéder au panneau catégorie *********
	if ($level >= 2){	
		
		// ****** Traitement categorie: ajout d'une nouvelle categorie ********* -->
		$cate = get('new_cate');
		if ($cate != ""){
		 	$data = sql_query('SELECT id FROM cuisine_categorie');
		 	$ordre = mysql_num_rows($data) + 1;
			sql_query("INSERT INTO cuisine_categorie VALUE ( NULL, '$cate', '$ordre')");
		}
	
		// ****** Traitement categorie: suppresion categorie ********* -->
		if (isset($_POST['delete']) && ($_POST['delete'] != "")){
		 	$delete = get('delete');
		 	$id = get('id');
		 	$id = mysql_real_escape_string($id);
		 	
		 	// on choppe sa place :
			 	$result = sql_assoc("SELECT Ordre FROM cuisine_categorie WHERE `id` = ".$id);
			 	$ordre = $result['Ordre'];
		 
		 	// on delete
		 	if ($delete == "true"){
		 	 	sql_query("DELETE FROM cuisine_categorie WHERE `id` = ".$id);

				// faut mettre à jour l'ordre: 
				$result_ordre = sql_query('SELECT id,Ordre FROM cuisine_categorie ORDER BY Ordre');
				
				// pour chaque entrée SQL, on regarde si need update ou non
				while ( $data = mysql_fetch_assoc($result_ordre) ){
				 	$id_du_data 		= $data['id'];
				 	$ordre_du_data 	= $data['Ordre'];
				 	// si c'était un ordre plus grand, il gagne une place dans le classment: -1
				 	if ($ordre_du_data > $ordre){
				 		$new_ordre = $ordre_du_data - 1;
						$result = sql_query("UPDATE cuisine_categorie SET `Ordre` = '$new_ordre' WHERE `id`= $id_du_data");
				 	 }
				 	// sinon il était devant et rien ne change
				 }
		 	}
		}
		 	 
		
		// -- On vérifie s'il n'y pas eu de modification
			$ordre = (isset($_POST['ordre'])) ? get('ordre') : (-1);
			$decalage = 0;
			
		// Il y a une action ie qqun avec qui échanger? si oui qui?
			if (isset($_POST['action'])){
				$action = get('action');
				if ($action == 'up'){		$decalage = (-1);}
				else if ($action == 'down'){	$decalage = 1;	}
				else{echo(' Wrong action entered : '.$action.' !!! '); }
			}
			
			if ($ordre != (-1) && $decalage != 0){
			 	$other_ordre = $ordre + $decalage;
			 	sql_query("UPDATE cuisine_categorie SET `Ordre` = '0' WHERE `Ordre` = '$other_ordre'");
				sql_query("UPDATE cuisine_categorie SET `Ordre` = '$other_ordre' WHERE `Ordre` = '$ordre'");
				sql_query("UPDATE cuisine_categorie SET `Ordre` = '$ordre' WHERE `Ordre` = '0'");
			 }
		
			
		// -- On affiche enfin toutes les categories
			$result = sql_query('SELECT id,Categorie,Ordre FROM cuisine_categorie ORDER BY Ordre');
			$nb_entry = mysql_num_rows($result);

?>
		<div  class = "creer">
			<table border = "1">
				<tr>
					<th> Ordre </th>
					<th> Monter </th>
					<th> Descendre </th>
					<th> Categorie </th>
					<th> Supprimer </th>
				</tr>	
			
<?php
			while ( $data = mysql_fetch_assoc($result) ){
			 	$id		= $data['id'];
			 	$ordre= $data['Ordre'];
			 	$cate	= $data['Categorie'];
?>	 
			 	<tr>
			 		<!-- // ordre -->
			 			<td> <?php echo($ordre); ?> </td>
			 			
			 		<!-- // up -->
						<td> <?php if ($ordre > 1){
						 		echo("
								  <form method = 'post' action = 'categorie.php'>
						 		 	<input type = 'hidden' name = 'ordre' value = '$ordre'>
						 		 	<input type = 'hidden' name = 'action' value = 'up'>
						 		 	<input type = 'submit' value = 'up'>
						 		  </form>
						 		");
							  }?>
						</td>
						
					<!-- // down -->
						<td> <?php if ($ordre < $nb_entry){
						 		echo("
								  <form method = 'post' action = 'categorie.php'>
						 		 	<input type = 'hidden' name = 'ordre' value = '$ordre'>
						 		 	<input type = 'hidden' name = 'action' value = 'down'>
						 		 	<input type = 'submit' value = 'down'>
						 		  </form>
						 		");
							  }?>
						 </td>
						 
					 <!-- // cateogorie -->
						<td> <?php echo($cate); ?> </td>
					
					<!-- // Suppression de categorie -->
						<td> <?php
						 		echo("
								  <form method = 'post' action = 'categorie.php'>
						 		 	<input type = 'hidden' name = 'id' value = '$id'>
						 		 	<input type = 'hidden' name = 'delete' value = 'true'>
						 		 	<input type = 'submit' value = 'Delete'>
						 		  </form>
						 		");
							  ?>
						</td>
			 	</tr>
		<?php
			}	
		?>
			</table>
		</div>
	
	
		<!-- // Pour pouvoir créer une catégorie -->
	
		<form method = 'post' action = "categorie.php" class = "creer">
		<h2>	Créer une catégorie </h2>
		<table border = "6">
			<tr>
				<td> Catégorie </td>
				<td> <input type = "text" name = "new_cate" size = "66"> </td>
			</tr>
				
		<table>
			<input type = "reset" value = "Reset">
				<input type = "submit" value = "Envoyer">
		</form>
	
	<?php
		} // end if admin
	else{
	 	echo ("Non mais les droits d'admin c'est pas pour le fun non plus ^^ ");
	 }
	
		
		
	include("../tools/footer.php");
?>