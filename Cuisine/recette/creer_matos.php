<?php
include('../tools/header.php');

if ($_SESSION['userlevel'] >= 1){
ListTable($table_cuisineMateriel);
}

include('../tools/footer.php');
?>







