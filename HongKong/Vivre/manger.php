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

<p>Ici on adore manger (j'adooôoore les sushis....===>[] *je sors*) et surtout tout le temps. Enfin tout le temps va "juste" de 4h du matin a minuit...</p>



<?php
  include('../tools/footer.php');
?>