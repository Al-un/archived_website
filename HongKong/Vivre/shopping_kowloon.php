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


<h3>Tsim Sha Tsui</h3>

<h4>iSquare</h4>

<h4>the One</h4>

<h4>Miramar</h4>



<h3>Kowloon West</h3>

<h4>Elements</h4>

<h4>Gateway?</h4>




<h3>Mong Kok</h3>

<h4>Longham Place</h4>




<?php
  include('../tools/footer.php');
?>