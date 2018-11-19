<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
       		
<HTML>

	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=iso-8859-1">
			<TITLE>Flood Zone - Post</TITLE>
		<link rel = "stylesheet" type = "text/css" title = "Design" href = "design.css" />
	 </HEAD>
	  
	 <BODY>
	 
	 	<?php
	 		include("../login.php");
	 		include("sommaire.php");
	 	?>
	 	
	 	<!-- /* Le corps de la page */ -->
	 	<div class = "corps">
	 	
	 	<form method = "post" action = "topic_post_ok.php">
	 		
	 		<input type = "hidden" name = "idTopic" value = <?php echo($_POST['idTopic']); ?> >
	 		<input type = "hidden" name = "topicName" value = <?php echo($_POST['topicName']); ?> >
	 		
	 		Pseudo : <br/>
	 		<input type = "text" name = "pseudo" size = "30">
	 		<br />
	 		Message :<br />
	 		<textarea rows = "6" cols = "80" name = "message"></textarea> 
			 <br/>
			<input type = "submit" value = "Poster"> 
	 		
	 		
	 	</form>
	 	
	 	</div>
	 	
	</BODY>
			
</HTML>	