<?php
  include('../tools/header.php');
  include('shopping_header.php');
?>

<?php
// ----------------- FUNNY PIC --------------- //
$indice = rand(1, 5);
echo("
<div style = 'text-align:center;'>
  <img src = '/HongKong/resources/todo$indice.jpg' title = 'todo' alt = 'todo' />
</div>
");
?>



<h3>Causeway Bay</h3>

<h4>Time Square</h4>




<h3>Admiralty</h3>

<h4>Pacific Place</h4>




<?php
  include('../tools/footer.php');
?>