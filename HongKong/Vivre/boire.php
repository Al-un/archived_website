<?php
  include('../tools/header.php');
  include('boire_header.php');
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

<p>Il fait chaud l'été par ici, enfin pas que l'été. Donc faut se déshydrater, enfin, boire quelque chose quoi. Mais ici les boissons sont variées. Le thé pour les chinois, la bière pour les européens? Bref J'essaierai ici de présenter tout ce qu'on peut trouver. Du thé à la taiwanaise, avec les perles noires, ou une bière au 25ème étage d'un immeuble, tout est trouvable même l'introuvable. C'est une règle qu'on commence à comprendre vite une fois sur place.</p>


<?php
  include('../tools/footer.php');
?>