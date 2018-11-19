<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
       		
<HTML>

	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=iso-8859-1">
			<TITLE>Flood Zone - Post confirmé</TITLE>
		<link rel = "stylesheet" type = "text/css" title = "Design" href = "design.css" />
	 </HEAD>
	  
	 <BODY>
	 	
	 	<?php
	 			include("../login.php");
	 			include("sommaire.php");
	 	?>
	 	
	 	<!-- /* Le corps de la page */ -->
	 	<div class = "corps">	
	 		
	 	<?php
	 	//	if (isset($_POST['Pseudo']){
	 		 	$pseudo = $_POST['pseudo'];				
	 		 	$pseudo = str_replace("'","''",$pseudo);
	 	//	}
	 	//	if (isset($_POST['Message'])){
	 		 	$message = nl2br($_POST['message']);			// pour esquiver les retours chariots
	 		 	$message = str_replace("'","''",$message);		// pour esquiver le pb des apostrophes
	 	//	}
	 			date_default_timezone_set('Europe/Paris');
		 		$date = date("Y-m-d-G-i-s");
		 		$idTopic = $_POST['idTopic'];
		 		$topicName = $_POST['topicName'];
	 		
			 	$mysql = mysql_connect($server,$user,$password) 
				 	OR DIE ("Warning connection to SQL Server failed");
			 	mysql_select_db($database,$mysql)
			 		OR DIE ("Warning connection to database failed");
			 		
				$request = "INSERT INTO $topicName VALUES ( NULL, '$date', '$pseudo', '$message')";
				mysql_query($request,$mysql)
					OR DIE ("mysql_query failed : <br /> $request <br />");
				
				echo("Votre message a été posté.<br />");
			
	 	?>
	 		<br />
	 		<a href = <?php echo("topic_affiche.php?topic=".$idTopic."&page=1"); ?> > Retour au Topic </a>
	 	
	 	</div>
	</BODY>
			
</HTML>	