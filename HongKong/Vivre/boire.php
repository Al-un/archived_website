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

<p>Il fait chaud l'�t� par ici, enfin pas que l'�t�. Donc faut se d�shydrater, enfin, boire quelque chose quoi. Mais ici les boissons sont vari�es. Le th� pour les chinois, la bi�re pour les europ�ens? Bref J'essaierai ici de pr�senter tout ce qu'on peut trouver. Du th� � la taiwanaise, avec les perles noires, ou une bi�re au 25�me �tage d'un immeuble, tout est trouvable m�me l'introuvable. C'est une r�gle qu'on commence � comprendre vite une fois sur place.</p>


<?php
  include('../tools/footer.php');
?>