<?php
include('../tools/header.php');

if ($_SESSION['userlevel'] >= 1){
ListTable($table_cuisineIngredient);
}

include('../tools/footer.php');
?>







