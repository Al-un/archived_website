<?php
  include('../tools/header.php');
  include('manger_header.php');
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

<?php
  include('../tools/footer.php');
?>