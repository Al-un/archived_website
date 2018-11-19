<?php
	include("../tool/header.php");
?>

	<h1> Javascript </h1>
	<h2> Les formulaires </h2>
	
	<p> Javascript permet la v&eacute;rification de formulation avant leur envoi. Ainsi, lorsqu'un client saisit un formulaire, le c&ocirc;t&eacute; client s'ex&eacute;cute d'abord (logique vous me direz) et si le c&ocirc;t&eacute; client valide, l'information peut alors commencer &agrave; être trait&eacute;e c&ocirc;t&eacute; serveur. </p>
	
	<p> La hi&eacute;rarchie objet est la suivante: </p>
	<ol>
		<li> document </li>
		<li> forms[index du formulaire] </li>
		<li> elements[index de l'&eacute;l&eacute;ments] </li>
		<li> value, style ... </li>
	</ol>

	<p> le document est pour rappel le m&eacute;ga objet qui occupe tout l'&eacute;cran. En HTML on peut appeler un objet par son nom (attribut '<i>name</i>') mais depuis le xHTML 1.0, on ne peut plus r&eacute;f&eacute;rencer des formulaires par le nom, on les num&eacute;rotes, <i> les indices d&eacute;butent &agrave; 0 comme en programmation en g&eacute;n&eacute;ral</i>. De même, les &eacute;l&eacute;ments sont indic&eacute;s &agrave; partir de 0. Ce sont les ordres d'apparition dans le code HTML qui est repris. Un element est un objet, ce n'est pas le <i>input</i> tel quel. Enfin si, je m'explique: le <i>input</i> poss&egrave;de des attributs. En javascript, c'est pareil. Un element poss&egrave;de l'attribut "<i>value</i>", "<i>name</i>", "<i>type</i>",etc...</p>

<pre class = "code">
<span class = "identifer">var</span> formulaire = <span class = "reserved">document</span>.<span class = "reserved">forms[1]</span>;
<span class = "identifer">var</span> item1 = formulaire.<span class = "reserved">elements[0]</span>;
<span class = "identifer">var</span> item2 = formulaire.<span class = "reserved">elements[1]</span>;
<span class = "reserved">alert</span>(item1.value);
<span class = "reserved">alert</span>(item2.value);
</pre>

<?php
	include("../tool/footer.php");
?>