<?php
include("../tools/header.php");
?>
	
	<h1> HTML </h1>
	<h2> Les Formulaires </h2>
	
	<p> Les formulaires se forment en trois paties :</p>
	<ul>
		<li> la partie HTML/CSS sert &agrave; la pr&eacute;sentation du formulaire </li>
		<li> la partie PHP sert &agrave; la r&eacute;cup&eacute;ration des informations </li>
		<li> la partie SQL sert &agrave; enregistrer les donn&eacute;es r&eacute;cup&eacute;rer </li>
	</ul>
	
	<p> En ce qui concerne la partie HTML, l'important est de dissocier les diff&eacute;rentes formes d'informations que l'on veut noter. Un formulaire commence par l'encadrement des balises FORM: </p>
	
<pre class = "code">
&lt;FORM method = "post" action = "www.monsite.fr/monformulaire.php"&gt;
	...
&lt;/FORM&gt;
</pre>
	
	<!-- ----- INPUT -------------------------->	
	<h4> La balise INPUT <h4>
	
<pre class = "code">
&lt;input type = "text" name = "monChamp" value = "Votre texte ici" size = "40"&gt;
</pre>

	<div class = "render">
		<input type = "text" name = "monChamp" value = "Votre texte ici" size = "40">
	</div>

	<p> Le champ <tt>name</tt> est un champ obligatoire pour permettre &agrave; PHP de retrouver la valeur envoy&eacute;e. Les types de la balise INPUT peuvent être </p>
	
	<dt>
		<dt> <tt> text </tt> </dt>
		<dd> Champ de texte simple </dd>
		<dt> <tt> password </tt> </dt>
		<dd> affiche des "*" &agrave; la place des caract&egrave;res </dd>
		<dt> <tt> hidden </tt> </dt>
		<dd> pour envoyer des champs cach&eacute;s </dd>
		<dt> <tt> file </tt> </dt>
		<dd> pour l'envoi de fichier </dd>
		<dt> <tt> submit </tt> </dt>
		<dd> pour envoyer le formulaire </dd>
		<dt> <tt> reset </tt> </dt>
		<dd> pour remettre le formulaire &agrave; z&eacute;ro </dd>
		<dt> <tt> image </tt> </dt>
		<dd> même r&ocirc;le que <tt>submit</tt> mais prend un argument <tt>src=""</tt> pour afficher une image </dd>
	</dt>
	
	

	<!-- ---------- TEXTAREA --------------------->
	<h4> La balise TEXTAREA </h4>
<pre class = "code">
&lt;textarea name = "monChamp" rows = "5" cols = "50" &gt;Votre texte ici&lt;/textarea&gt;
</pre>

	<div class = "render">
		<textarea name = "monChamp" rows = "5" cols = "50">Votre texte ici</textarea>
	</div><i></i>

<?php
include("../tools/footer.php");
?>
	