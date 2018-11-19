<?php
include('../tools/header.php');
include('recette_function.php');

recette_sommaire();
		
	
if (isset($_GET['recette_id'])){
  recette_affiche($_GET['recette_id']);
}
else{
  echo("<div class = 'recette'>Ben alors petit(e) gourmand(e), qu'est ce que tu attends pour choisir une recette?</div>");
}
		
include('../tools/footer.php');
?>