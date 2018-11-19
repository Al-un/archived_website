<?php
	include("../tool/header.php");
?>

	<h1> Javascript </h1>
	<h2> Les bases </h2>
	
	<p> La commande de base est la m&eacute;thode <i>alert()</i> qui cr&eacute;e un popup avec un message dedans. Cette commande ne se d&eacute;clenche qu'&agrave; partir d'un certain &eacute;v&eacute;nement. Cela se d&eacute;finit par un attribut dans une balise HTML. On peut alors d&eacute;terminer une certaine action au clic d'un lien ou au survol de la souris.</p>
	
	<p> Quelques &eacute;v&eacute;nements sont: </p>
	
	<table border = '1'>
		<tr><td> onclick </td><td> lorsqu'on on clique dessus </td> </tr>
		<tr><td> onload </td><td> au chargement de la page </td> </tr>
		<tr><td> onsubmit </td><td> lorsqu'on valide un formulaire, attribut de la balise form </td> </tr>
		<tr><td> onmouseover </td><td> au survol de la souris </td> </tr>
		<tr><td> onmouseout </td><td> lorsque la souris n'est plus sur l'objet</td> </tr>
		<tr><td> onfocus </td><td> au focus</td> </tr>
	</table>
	
	<p> Les &eacute;v&eacute;nements sont des opportunit&eacute;s pour appeler des m&eacute;thodes javascript dont la m&eacute;thode <i>alert()</i> </p>
	
	<pre class = "code">
	&lt;p onclick = "alert('Vous avez cliqu&eacute; le lien!!!');"&gt; 
		Cliquez ici 
	&lt;/p&gt;
	</pre>
	
	<div class = "render">
	<p onclick = "alert('Vous avez cliqu&eacute; le lien!!!');"> Cliquez ici </p>
	</div>
	
	<p> D'autre &eacute;v&eacute;nements peuvent alors donner: </p>
	
	<pre class = "code">
	&lt;p onmouseover = "alert('Vous avez survol&eacute; le lien!!!');"&gt; 
		Passez la souris par ici 
	&lt;/p&gt;
	</pre>
	
	<div class = "render">
	<p onmouseover = "alert('Vous avez survol&eacute; le lien!!!');"> Passez la souris par ici </p>
	</div>
	
<?php
	include("../tool/footer.php");
?>