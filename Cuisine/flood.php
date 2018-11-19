<?php
  include('tools/header.php');

		$table_flood = "cuisine_flood";
		
		
		
		// -- On affiche le tout
			$query = "SELECT * FROM `cuisine_flood` ORDER BY id DESC";
			$flood = mysql_query($query,$mysql) OR DIE ('failed :'.$query);
			
			// Seuls les users enregistrés peuvent poster
			if (isset($_SESSION['user'])) {
				echo("<p class = 'post'><a href = 'post.php'> Poster un message </a></p>");
			}
			
			while ( $data = mysql_fetch_assoc($flood) ){
?>
			 	<table border = "0" class = "post">
					<tr>
						<td class = "pseudo"> <?php echo($data['pseudo']); 			?> </td>
						<td class = "date"> <?php echo("posté le: ".$data['date']);	?> </td>
					</tr>
					<tr>
						<td></td>	
						<td class = "post"> <?php echo($data['message']);				?> </td>
					</tr>
				</table>
<?php
			 }
				 
		
		

  include("tools/footer.php");
?>