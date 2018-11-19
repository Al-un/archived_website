<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
       		
<HTML>

	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=iso-8859-1">
			<TITLE>Flood Zone - Topic</TITLE>
		<link rel = "stylesheet" type = "text/css" title = "Design" href = "design.css" />
	 </HEAD>
	  
	 <BODY>
	 	
	 	<!-- petit menu à gauche -->
	 	<?php
	 		include("../login.php");
	 		include("sommaire.php");
		?>

		<!-- /* Le corps de la page */ -->
		<div class = "corps">
	 	
			<?php
				
				/* on suppose que tout se passe bien pour obtenir le topic
				   il faut avoir dans le GET :
				   -- le topic
				   -- la page en cours */	 
					$idTopic = "";
					if (isset($_GET['topic'])){
					 $idTopic = $_GET['topic'];
					}
					$page = $_GET['page'];
				
				// si le topic n'est pas nul
					if ($idTopic != ""){
					 	$mysql = mysql_connect($server,$user,$password) 
						 	OR DIE ("Warning connection to SQL Server failed");
					 	mysql_select_db($database,$mysql)
					 		OR DIE ("Warning connection to database failed");
				 	
				 	
				 	// on recherche le nom du topic à partir de l'id
					 	$request = 'SELECT * FROM flood_topic WHERE id = '.$idTopic;
					 	$result = mysql_query($request,$mysql)	OR DIE ("mysql_query failed : <br /> $request <br />");
					 	$data = mysql_fetch_assoc($result);
				 	
				 	// on cherche le nombre de page
					 	$topic_name	= $data['topic'];
				 		$request 	= "SELECT * FROM ".$topic_name;
				 		$result		= mysql_query($request,$mysql) OR DIE ("mysql_query failed : <br /> $request <br />");
				 		$nb_page	= mysql_num_rows($result);
				 		$nb_page 	= ceil($nb_page/10);
				 	// on affiche le topic
				 		$page_up	= $page*10;
					 	$page_down	= ($page-1)*10;
					 	$request 	= ('SELECT * FROM '.$topic_name.' ORDER BY id DESC LIMIT '.$page_down.','.$page_up);
						$result 	= mysql_query($request,$mysql) OR DIE ("mysql_query failed : <br /> $request <br />");
						
							// on n'oublie pas de couper le "flood_"
							$topic_name_cut = substr($topic_name,6);
							$topic_name_cut	= str_replace("_"," ",$topic_name_cut);
					 		echo('<h2>'.$topic_name_cut.'</h2>');
					 		
					 		// on affiche les pages du flood
					 		echo('<center>');
					 		for ($i = 1; $i <= $nb_page; $i++){
					 		 	if ($i != $nb_page){
					 				echo("<a href = \"topic_affiche.php?topic=".$idTopic."&page=".$i."\"> $i - </a>");
					 			}
					 			else{
					 			 	echo("<a href = \"topic_affiche.php?topic=".$idTopic."&page=".$i."\"> $i </a>");
					 			}
					 		 }
					 		echo('</center>');
					 		
					 		// on peut poster des messages (en haut)
					 		?>
					 			<form method = "post" action = "topic_post.php">
					 				<input type = "hidden" name = "idTopic" value = <?php echo($idTopic); ?> >
					 				<input type = "hidden" name = "topicName" value = <?php echo($topic_name); ?> >
			 						<input type = "submit" value = "Poster un message">
			 					</form>
					 		<?php
						
							while( $data = mysql_fetch_assoc($result) ){
							 	?>
							 	<table border = "0">
							 		<tr>
									 	<td class = "pseudo"> <?php echo($data['Pseudo']); 			?> </td>
									 	<td class = "date"> <?php echo("posté le: ".$data['Date']);	?> </td>
									<tr>
									<tr>
										<td></td>	
									 	<td class = "post"> <?php echo($data['Texte']);				?> </td>
									</tr>
								</table>
								<br />
								<?php
							 }
					
						// on affiche les pages du flood
					 		echo('<center>');
					 		for ($i = 1; $i <= $nb_page; $i++){
					 		 	if ($i != $nb_page){
					 				echo("<a href = \"topic_affiche.php?topic=".$idTopic."&page=".$i."\"> $i - </a>");
					 			}
					 			else{
					 			 	echo("<a href = \"topic_affiche.php?topic=".$idTopic."&page=".$i."\"> $i </a>");
					 			}
					 		 }
					 		echo('</center>');
					 		
					 	// on peut poster
					 	?>
							<form method = "post" action = "topic_post.php">
								<input type = "hidden" name = "idTopic" value = <?php echo($idTopic); ?>>
								<input type = "hidden" name = "topicName" value = <?php echo($topic_name); ?> >
							 	<input type = "submit" value = "Poster un message">
							</form>
						<?php
				}
				else{
				 	echo("NooB, Il est où le Topic???");
				}			
			?>
		
		</div>

	
	</BODY>
			
</HTML>	