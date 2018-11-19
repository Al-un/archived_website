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


<h3>Tsuen Wan</h3>


<h4>CityWalk I</h4>

<h4>Cityzalk II</h4>

<h4>Tsuen Wan Plaza</h4>

<h4>Skyline Plaza</h4>

<h4>Landmark I</h4>

<h4>Landmark II</h4>

<h4>Luk Yeung Galleries</h4>







<h3>Kwai chung</h3>

<h4>Metroplaza</h4>


<?php
  include('../tools/footer.php');
?>