<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
       		
<HTML>

	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=iso-8859-1">
			<TITLE>Flood Zone - Créer un topic</TITLE>
		<link rel = "stylesheet" type = "text/css" title = "Design" href = "design.css" />
	 </HEAD>
	  
	 <BODY>
	 	<?php
	 		include("../login.php");
	 		include("sommaire.php");
	 		
	 	?>
	 	
	 	<!-- /* Le corps de la page */ -->
	 	<div class = "corps">
	 	
	 	<center><h2> Créer un Topic </h2></center>
		 	 	
	 	<table border = 0 class = "input">
		 	<form method = "post" action = "topic_ok.php">
		 		<tr>
				 	<td class = "input">Nom du Topic : </td>
		 			<td class = "input"> <input type = "text" size = "50" name = "topic"></td>
		 		</tr>
		 		<tr>
		 			<td class = "input">Password (facultatif): </td>
		 			<td class = "input"><input type = "password" size = "50" name = "password"></td>
		 		</tr>
		 		<tr>
		 			<td class = "input"><input type = "Submit" value = "Créer"></td>
		 		</tr>
		 	</form>
	 	</table>
	 	
	 	</div>
	</BODY>
			
</HTML>	
