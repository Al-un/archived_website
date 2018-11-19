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

<p>Envie de shopping? ben si c'est le cas, ce n'est pas l'ennui qui pèsera pour vous à Hong Kong. Avec une densité incroyable de centres commerciaux, Hong Kong est une des villes les plus commercantes que je n'ai jamais vues !!! Et surtout bon ben dans les nouveaux territoires, ce sont des centres normaux mais quand le standard passe à Calvin Klein, Hugo Bosss et Levis, ben le portefeuille se cache et on fait que regarder, pour le plaisir des yeux uniquement ! </p>

<?php
  include('../tools/footer.php');
?>