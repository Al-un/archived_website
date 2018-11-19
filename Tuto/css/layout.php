<?php
	include("../tools/header.php");
		// head("Tutorial Area - CSS");
?>
	

	<h1> CSS </h1>
	<h2> La mise en page </h2>
	
	<h3> Hauteur et Largeur </h3>
	<p>Pour une balise donn&eacute;e, on peut d&eacute;finir la taille et la hauteur si la balise concern&eacute; est de type "block". Ce sont les attribut <i>width</i> et <i>height</i>:</p>
	
	<pre> 
		width 	: 900px; 
		height	: 1200px;
	</pre>
	
	
	<h3> Les marges externes et internes </h3>
	<p>margin & padding</p>
	
	<p>La gestion des marges passent par deux fonctions: <tt>margin</tt> pour les marges externes et <tt>padding</tt> pour les marges internes. Chacun se d&eacute;cline sur les quatre c&ocirc;tes:</p>
	
	<pre>
		margin		: auto;	<font color = "grey">// permet de "centrer" le bloc</font>
		margin-top	: 100px;<font color = "grey">// marge ext&eacute;rieur haute</font>
		margin-bottom	: 50px;	<font color = "grey">// marge ext&eacute;rieur basse</font>
		margin-left	: 1em;	<font color = "grey">// marge ext&eacute;rieur gauche</font>
		margin-right	: 2em;	<font color = "grey">//marge ext&eacute;rieur droite</font>
		<br />
		padding		: 5px;	<font color = "grey">// g&egrave;re les marges internes</font>
		padding-top	: 10px;
		padding-bottom	: 10px;
		padding-left	: 10px;
		padding-right	: 10px;
	</pre>
	
	<h3> Les float </h3>
	
	<p> le <tt>float</tt> permet de basculer les bloc sur la gauche ou sur la droite. Ainsi, une balise de type bloc attribu&eacute; de <tt>float: left;</tt> se verra &agrave; la gauche du bloc suivant:</p>
	
	<pre>
		float	: left;
		float	: right;
	</pre> 

	
<?php
	include("../tool/footer.php");
?>