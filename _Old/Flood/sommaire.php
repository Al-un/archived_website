	<?php
	include('../sql_login.php');
	include('../sal_function.php');	


	$request = "SELECT * FROM flood_topic";
	$result = mysql_query($request,$mysql) OR DIE (" mysql_query failed : <br /> $request <br />");
	
	?>
	
	<div class = "header">
		<a href = "../index.php">
			<img src = "flood.png" alt = "Une bannière homemade" title = "Cliquez pour revenir à l'accueil principal" />
		</a>
	</div>
	
	<div class = "sommaire"
		<a href = "accueil.php"> 		Accueil du forum 	</a> <br />
		<a href = "topic_creer.php">	Créer un topic 		</a> 
		<h3> Liste des topics </h3>
		
		<ul>
	<?php	
	while ($data = mysql_fetch_assoc($result)){
	 	$name_cut = substr($data['topic'],6);
	 	$name_cut = str_replace("_"," ",$name_cut);
	 	$password_topic = $data['password'];
	 	if ($password_topic == ""){
	 		echo("<li><a href = \"topic_affiche.php?topic=". $data['id'] ."&page=1\">".  $name_cut ."</a></li>");
	 	}
	 	else{
	 		echo("<li><a href = \"topic_login.php?topic=". $data['topic'] ."&id=".$data['id']."\">".  $name_cut ." <img src = 'lock.gif'></a></li>");	 
		  }
	 }
	?>
		</ul>
	</div>