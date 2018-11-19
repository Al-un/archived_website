<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
       		
<HTML>

	<HEAD>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=iso-8859-1">
			<TITLE>Prévente confirmée</TITLE>
		<link rel = "stylesheet" type = "text/css" title = "Design" href = "animest_prevente.css" />
	 </HEAD>
	  
	 <BODY>
	 
		<?php
			include("login.php");
		?>
	 
		<center>
			<a href = "prevente.php"> Retour aux préventes </a>
		</center>
		
		<?php
		
			$trou_nom = false;
			$trou_prenom = false;
		echo($trou_nom."<br />".$trou_prenom."<br />");
			$Date = date("Y-m-d");
			if (isset($_POST['Nom'])){
				$Nom = $_POST['Nom'];
				$trou_nom = true;
			}
			else{
				$Nom = "";
				$trou_nom = false;
			}
			if (isset($_POST['Prenom'])){
				$Prenom = $_POST['Prenom'];
				$trou_prenom = true;
			}
			else{
				$Prenom = "";
				$trou_prenom = false;
			}
			
			if (isset($_POST['Nb_place'])){
				$Nb_place = $_POST['Nb_place'];
			}
			else{
				$Nb_place = "";
			}
			if (isset($_POST['Nb_jours'])){
				$Nb_jours = $_POST['Nb_jours'];
			}
			else{
				$Nb_jours = "";
			}
			if (isset($_POST['Cotisant_BDE'])){
				$cotisant_bde = $_POST['Cotisant_BDE'];
			}
			else{
				$cotisant_bde = "";
			}
			if (isset($_POST['Total'])){
				$Total = $_POST['Total'];
			}
			else{
				$Total = "";
			}
			
			//pour la suppression :
			
			$mysql	= mysql_connect($server,$user,$password);
			$select_db = mysql_select_db($database,$mysql);
			
			if ($trou_nom && $trou_prenom){
				echo($trou_nom."<br />".$trou_prenom."<br />");
				$value = "( NULL, '$Date','$Nom','$Prenom','$Nb_place','$Nb_jours','$cotisant_bde','$Total')";
				$request = 'INSERT INTO animest_prevente VALUES '.$value;
				echo($request);
				mysql_query($request,$mysql) OR DIE ("problème insertion prévente");
			}
			
			if (isset($_POST['id'])){
				$id = $_POST['id'];
				mysql_query("Delete from animest_prevente where id = '".$id.'\'',$mysql) OR DIE ("problème suppresion");
				echo("Delete from animest_prevente where id = '".$id.'\'');
			}
			
		?>
		
	</BODY>
			
</HTML>	
