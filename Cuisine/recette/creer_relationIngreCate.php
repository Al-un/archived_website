<?php
include('../tools/header.php');

if ($_SESSION['userlevel'] >= 1){
  $exclusive = true;
  displayCateItem($table_cuisineIngreCate, $table_cuisineIngredient, $table_cuisineCateIngre, $exclusive);
}

include('../tools/footer.php');
?>







