<?php
include("../tools/header.php");
?>
	

	<h1> CSS </h1>
	<h2> Les bordures </h2>
	
	<p>CSS d&eacute;finit les bordures d'un block par trois attributs:</p>

	<ol>
		<li>border-width : la taille de la bordure (en px g&eacute;n&eacute;ralement)</li>
		<li>border-color : la couleur en code HTML (format #AAAAAA)</li>
		<li>border-style : la forme de la bordure </li>
	</ol>
	
	<p> Les diff&eacute;rents styles recens&eacute;s par le w3c sont : </p>
	
	<div id = "border-style" class = "border">
		<p style = "border-style: dotted;">	border-style: dotted; 	</p>
		<p style = "border-style: dashed;">	border-style: dashed;	</p>	
		<p style = "border-style: solid;">	border-style: solid;	</p>	
		<p style = "border-style: double;">	border-style: double;	</p>	
		<p style = "border-style: groove;">	border-style: groove;	</p>	
		<p style = "border-style: ridge;">	border-style: ridge;	</p>	
		<p style = "border-style: inset;">	border-style: inset;	</p>	
		<p style = "border-style: outset;">	border-style: outset;	</p>
	</div>

<?php
include("../tools/footer.php");
?>