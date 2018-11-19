<?php
	include("../tool/header.php");
		head("Tutorial Area - SQL");
?>

	<h1> SQL </h1>
	<h2> Requête SQL : Modifier une table </h2>
	
	
	
	<h4> Ajouter une entr&eacute;e </h4>
	
	<p> Les requêtes suivantes sont les requêtes brutes, je ne mettrais plus "$requete = ..." pour des raisons de simplicit&eacute; </p>
 	
 	<p> La commande <q> INSERT </q> permet d'ins&eacute;rer des donn&eacute;es. Par exemple, dans la table Adresse caract&eacute;ris&eacute;e par un ID, un champ nom, un champ prenom, un champ âge, je peux ins&eacute;rer DUPONT Jean, 42 ans:</p>
	 
<pre class = "code">
	INSERT INTO Adresse VALUES ( NULL, 'DUPONT', 'Jean', '42'); 
</pre>   
 	
 	<p> J'ai cit&eacute; le champ ID. Un ID est un entier (<i> int </i>). Ce nombre permet d'identifier de mani&egrave;re unique un &eacute;l&eacute;ment de la table. Il s'autoincr&eacute;mente par d&eacute;faut, c'est &agrave; dire que l'ID d'un nouvel &eacute;l&eacute;ment ins&eacute;r&eacute; sera automatiquement l'ID le plus grand incr&eacute;ment&eacute; de 1, d'où le NULL. Cette caract&eacute;ristique se d&eacute;finit au moment de la cr&eacute;ation de la table (option &agrave; cocher lors de la cr&eacute;ation de la table). 
 	
 	
 	
 	
 	<h4> Supprimer une entr&eacute;e </h4>
 	
<pre class = "code">
	DELETE FROM matable WHERE `id` = '3';
</pre> 	
 	
 	
 	<h4> Modifier une entr&eacute;e </h4>
 	
<pre class = "code">
	UPDATE carnet_adresse
	SET `nom` = 'Lol', `prenom` = 'blague'
	WHERE `id` = '3';
</pre> 
 	
<?php
	include("../tool/footer.php");
?>