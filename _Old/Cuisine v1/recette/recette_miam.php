<?php
  include('recette_function.php');
  include('../tools/header.php');

		
	recette_sommaire();
		
	
		if (isset($_GET['id'])){
			recette_affiche($_GET['id']);
		}
		else{
		 	echo("<div class = 'recette'>Ben alors petit(e) gourmand(e), qu'est ce que tu attends pour choisir une recette?</div>");
		 }
		
  include('../tools/footer.php');
?>