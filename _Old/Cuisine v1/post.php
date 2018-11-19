<?php
		include("../login.php");
		include("tool/header.php");
		head("Miam Zone - Post");
		$table_flood = "cuisine_flood";
		
		if (isset($_SESSION['user'])){
		
		// --- Y a-t-il eu un post?
			$pseudo = "";
			$message= "";
			if (isset($_POST['pseudo']) && $_POST['pseudo'] != ""){
			 	$pseudo = get('pseudo');
			}
			if (isset($_POST['message']) && $_POST['message'] != ""){
			 	$message = get('message');
			}
		
		// -- Postons s'il y a eu post...
			if ($pseudo != "" && $message != ""){
			 	$pseudo = mysql_real_escape_string($pseudo);
			 	$message= mysql_real_escape_string($message);
			 	$date   = date("Y-m-d-G-i-s");
				$query_flood = "INSERT INTO `$table_flood` VALUES (NULL,'$pseudo','$message','$date')";
				mysql_query($query_flood,$mysql) OR DIE ('failed : '.$query_flood);
				header("location:flood.php");
			}
?>

		<!-- // et un tout piti formulaire pour compléter ce flood -->
			<form method = "post" action = "post.php" class = "creer">
				<table>
					<tr>
						<td>Pseudo </td>
						<td><input type = "text" name = "pseudo" value = "<?php echo($_SESSION['user']); ?>" > </td>
					</tr>
					<tr>
						<td>Message </td>
						<td><textarea name = "message" cols = "60" rows = "5"></textarea>
					</tr>
				</table>
				<input type = "submit" value = "Poster">
			</form>
			
<?php

		}
		else{
		 	echo(" Les droits d'utilisateur ou d'admin c'est pas pour le fun non plus ^^");
		}

		include("tool/footer.php");
?>