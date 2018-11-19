<?php
include("../tools/header.php");
?>

<h1> HTML </h1>
<h2> Les Hyperliens </h2>
	
<p>Les Hyperliens servent principalement a se promener a travers les divers pages d'un site web. On navigue alors dans le site. Cliquer dessus nous am&egrave;ne alors a un certain endroit. La syntaxe est :</p>

<pre class = 'code'>
&lt;a href = '<?php echo($_SERVER['PHP_SELF']); ?>'&gt;
  Mon lien
&lt;/a&gt;
</pre>

<p>Le rendu sera:</p>

<div class = 'render'>
  <a href = '<?php echo($_SERVER['PHP_SELF']); ?>'>Mon lien </a>
</div>

<p>Comme on se saute de page en page, on peut faire des liens absolus (comme "http://www.monsite.com/mapage.htm") ou bien des liens relatifs (comme "/mondossier/mapage.htm"). On a alors des liens du type:</p>

<table border = '1' style = 'padding = 4px;'>

  <tr>
    <th>Type de lien</th>
    <th>Syntaxe</th>
    <th>Destination</th>
    <th>Commentaire</th>
  </tr>

  <tr>
    <td>Absolu</td>
    <td>http://monurl/mapage.htm</td>
    <td>va &agrave; "monurl" et acc&eacute;de &agrave; la page "mapage.htm".</td>
    <td>Syntaxe basique, utile pour les liens externes</td>
  </tr>

  <tr>
    <td>Relatif</td>
    <td>/mondossier/mapage.htm</td>
    <td>a partir de la location du fichier actuelle, va dans le dossier "mondossier" et acc&eacute;de &agrave; la page "mapage.htm"</td>
    <td>Pratique pour les fichiers a la base d'une arborescence</td>
  </tr>

  <tr>
    <td>Relatif</td>
    <td>../mondossier/mapage.htm</td>
    <td>a partir de la location du fichier actuelle, remonte d'un niveau puis va dans le dossier "mondossier" et acc&eacute;de &agrave; la page "mapage.htm"</td>
    <td>Pratique pour naviguer entre dossier</td>
  </tr>

  <tr>
    <td>Absolu/Relatif</td>
    <td>/mondossier/mapage.htm</td>
    <td>A la racine du site, va &agrave; "mondossier" et acc&eacute;de &agrave; la page "mapage.htm".</td>
    <td>equivalent a "urldusite/mondossier/mapage.htm"</td>
  </tr>

</table>

<?php
include("../tools/footer.php");
?>