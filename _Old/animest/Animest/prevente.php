<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>

<HEAD>
	<title>Ins�rer une pr�vente</title>
	<link rel = "stylesheet" type = "text/css" title = "Design" href = "animest_prevente.css" />
</HEAD>

<BODY>

	<table border = 1>

		<caption> Insertion d'une pr�vente </pr�vente>
	
		<tr>
			<th>Date</th>
			<th>Nom</th>
			<th>Pr�nom</th>
			<th>Nb de place</th>
			<th>Nb jour(s)</th>
			<th>Cotisant BDE</th>
			<th>Total</th>
		</tr>
	
		<tr>
			<form method = "post" action = "prevente_confirm.php">	
				<td> <?php echo date("d-m-Y");?> </td>
				<td><input type = "text" name = "Nom" size = "20" ></td>
				<td><input type = "text" name = "Prenom" size = "20" ></td>
				<td><input type = "text" name = "Nb_place" size = "10" ></td>
				<td><input type = "text" name = "Nb_jours" size = "10" ></td>
				<td><input type = "text" name = "Cotisant_BDE" size = "10" ></td>
				<td><input type = "text" name = "Total" size = "10"> </td>
			
		</tr>

	</table>
				<center><input type = "submit" value = "ins�rer!"> </center>
			</form>
			
	<?php
			include("login.php");
			$mysql	= mysql_connect($server,$user,$password);
			$select_db = mysql_select_db($database,$mysql);
			$request = "SELECT * FROM animest_prevente ORDER BY date DESC";
			$result = mysql_query($request,$mysql);
			
	?>
		<table border = 1>

		<caption> Insertion d'une pr�vente </pr�vente>
	
		<tr>
			<th>Date</th>
			<th>Nom</th>
			<th>Pr�nom</th>
			<th>Nb de place</th>
			<th>Nb jour(s)</th>
			<th>Cotisant BDE</th>
			<th>Total</th>
		</tr>
	<?php
			
			while ($data = mysql_fetch_assoc($result)){?>
			<tr>
				<td> <?php echo($data['Date']) ?> </td>
				<td> <?php echo($data['Nom']) ?> </td>
				<td> <?php echo($data['Pr�nom']) ?> </td>
				<td> <?php echo($data['Nb_place']) ?> </td>
				<td> <?php echo($data['Nb_jours']) ?> </td>
				<td> <?php echo($data['Cotisant_bde']) ?> </td>
				<td> <?php echo($data['Total']) ?> </td>
				<td><form method = "post" action = "prevente_confirm.php">
						<input type = "submit" value = "Supprimer">
						<input type = "hidden" name = "id" value = <?php echo($data['id']) ?> >
					</form></td>
			</tr>
			
			
			<?php
			}
	?>
		</table>
</BODY>

</HTML>