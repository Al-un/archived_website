<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
       		
<HTML>

	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=iso-8859-1">
			<TITLE>Flood Zone - Enter Password</TITLE>
		<link rel = "stylesheet" type = "text/css" title = "Design" href = "design.css" />
	 </HEAD>
	  
	 <BODY>
	 	
	 	<?php
	 			include("../login.php");
	 			include("sommaire.php");
	 			// pour le login
	 				$topic 	= $_GET['topic'];
	 				
	 				$id		= $_GET['id'];
	 				$password_topic = "";
	 				if (isset($_POST['password'])){
	 				 	$password_topic = $_POST['password'];
	 				}
		 ?>
	 	
	 	<!-- /* Le corps de la page */ -->
	 	<div class = "corps">	
	 		
	 	<center>
	 		<form method = "post" action = <?php echo("topic_login.php?topic=".$topic."&id=".$id); ?> >
	 			Enter password : <br />
			 	<input type = "text" name = "password" size = "20"><br />
			 	<input type = "hidden" name = "topic" value = <?php echo($topic); ?> >
			 	<input type = "hidden" name = "id" value = <?php echo($id); ?> >
				<input type = "submit" value = "Submit">	
			</form>	
	 	</center>
	 	
	 	<?php
	 		if ($password_topic != ""){
		 		$mysql = mysql_connect($server,$user,$password);
		 		mysql_select_db($database,$mysql) OR DIE ("mysql_select_db failed");
		 		
		 		$request 	= "SELECT * FROM flood_topic WHERE topic = '$topic'";
		 		$result		= mysql_query($request,$mysql) OR DIE ("topic non trouvé");;
		 		$data		= mysql_fetch_assoc($result);
		 		$id_topic 	= $data['id'];
		 		
		 		$request 	= "SELECT * FROM flood_topic WHERE password = '$password_topic'";
		 		$result		= mysql_query($request,$mysql) OR DIE ("password non trouvé");
		 		$data		= mysql_fetch_assoc($result);
		 		$id_password= $data['id'];
		 		
		 		if ($id_password == $id_topic){
		 		 	header("Location:topic_affiche.php?topic=".$id_topic."&page=1");
		 		 }
		 		 else{
		 		  	echo("Try Again !");
		 		}
		 	}
		 	?>
	 	
	 	</div>
	</BODY>
			
</HTML>	