<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
       		
<HTML>

	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=iso-8859-1">
			<TITLE>Flood Zone - Création de Topic</TITLE>
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
	 		
	 		 	
	 	
	 		$topicNull = true;
		 		if (isset($_POST['topic']) && ($_POST['topic'] != "")){
		 		 	$topic = $_POST['topic'];
		 		 	$topic = str_replace(" ","_",$topic);		// pour accepter les topics avec espaces
		 		 	$topic = "flood_".$topic;
		 		 	$topicNull = false;
		 		 	
		 		}
		 		// init un password par défaut
				 	$password_topic = "";
				 	if (isset($_POST['password'])){
				 		$password_topic = $_POST['password'];
				 	}
	 		
	 		
	 		
	 		if (!$topicNull){
	 		 $mysql = mysql_connect($server,$user,$password);
	 		 	mysql_select_db($database,$mysql) OR DIE ("mysql_select_db failed");
	 		 	$request = "CREATE TABLE ".$topic."(
							  id INT NOT NULL AUTO_INCREMENT,
							  Date DATETIME,
							  Pseudo VARCHAR (20),
							  Texte VARCHAR (1000),
							  PRIMARY KEY (id))";
	 		 	mysql_query($request,$mysql) OR DIE ("mysql_query failed: <br /> $request <br />");
	 		 	
	 		 	$request = "INSERT INTO flood_topic VALUES ( NULL, '".$topic."','".$password_topic."')";
	 		 	mysql_query($request,$mysql) OR DIE ("mysql_query failed :<br/> $request <br />");
	 		 	
	 		 	echo("<p> Votre topic a bien été crée </p><br />");
	 		}
	 		else{
	 		 	echo(" Le topic doit comporter un nom !<br />");
	 		 	echo("<a href = \"topic_creer.php\"> Retour à la création d'un topic </a><br />");
	 		}
	 	?>
	 	
	 		</div>
	</BODY>
			
</HTML>	