<?php
include('../tools/header.php');

echo("
  <ul class='menu_creer'>
    <li><a href='/Cuisine/recette/creer_ingreCate.php'>		Gérer les Catégories d'ingrédient</a></li>
    <li><a href='/Cuisine/recette/creer_ingredient.php'>	Gérer les Ingrédients</a></li>
    <li><a href='/Cuisine/recette/creer_matos.php'>			Gérer le matériel</a></li>
    <li><a href='/Cuisine/recette/creer_relationIngreCate.php'>Gérer la relation Categorie d'ingrédient/Ingrédient</a></li>
    <li><a href='/Cuisine/recette/creer_recetteCate.php'>	Gérer les catégorie de recette</a></li>
    <li><a href='/Cuisine/recette/recette_creer.php'>		Créer une recette</a></li>
  </ul>
");

include('../tools/footer.php');
?>







