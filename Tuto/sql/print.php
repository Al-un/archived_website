<?php
	include("../tool/header.php");
		head("Tutorial Area - SQL");
?>

	<h1> SQL </h1>
	<h2> Requête SQL : affichage </h2>
 	
 	<h4> Requête simple </h4>
 	<p> La commande <q> SELECT </q> r&eacute;cup&egrave;re les entr&eacute;es d'une table.</p>
	 
<pre class = "code">
	$ma_requete	= "SELECT * FROM mon_carnet_dadresse";
	$le_resultat= mysql_query($ma_requete,$mysql);
	$donnees	= mysql_fetch_assoc($le_resultat);
	echo($donnes['nom']);
	echo($donnes['prenom']);
</pre> 

	<p> Pour d&eacute;cortiquer toutes ces lignes, s&eacute;parons les &eacute;tapes: </p>

	<ol>
		<li> la variable <b>$requete</b> est une requête de type SELECT. L'&eacute;toile signifie qu'on selectionne tous les champs de la table. La table concern&eacute;e est <q>mon_carnet_dadresse</q>.</li>
		<li> <b>$le_result</b> contient alors le resultat brut de la requête &agrave; travers la variable <b>$mysql</b> d&eacute;finie auparavent.</li>
		<li> <tt>mysql_fetch_assoc</tt> convertit le resultat brut inexploitable par PHP en un tableau PHP dont les cl&eacute;s correspondent aux noms des champs. Ainsi, si le carnet d'adresse contient les champs nom, prenom, age, adresse, le tableau associ&eacute; aura les cl&eacute;s <q>nom</q>,<q>prenom</q>,<q>age</q>,<q>adresse</q>.</li>
		<li> on affiche ensuite le resultat <li>  
 	</ol>
 	
 	<p> Si le tableau comporte plusieurs entr&eacute;es, comme c'est souvent le cas, il faut parcourir toute la requête. Dans ce cas, une m&eacute;thode tr&egrave;s efficace est : </p>
	 
<pre class = "code">
	while( $data = mysql_fetch_assoc($leresult)){
		echo($data['nom']);
		echo($data['prenom']);
	}
</pre>	
 	
 	<h4> Requête avec crit&egrave;re </h4>
	 
<pre class = "code">
	$ma_requete = "SELECT * FROM mes_amis WHERE pseudo = 'Xsylum'";
</pre>

	<p> Cette requete permet justement de rechercher une entr&eacute;e en particulier dans la base de donn&eacute;es. Il es ainsi possible d'&eacute;tablir plusieurs crit&egrave;res via le mot-cl&eacute; AND </p>
	
<pre class = "code">
	$ma_requete = "	SELECT nom,adresse FROM les_entreprises
					WHEHRE `lieu` = 'Paris'
					AND `secteur` = 'Banque'
					AND `nb_salaries` > 500";
</pre>	 
 	
 	<p> La requête pr&eacute;c&eacute;dente montre que l'on peut avoir plusieur crit&egrave;res de recherche, et l'&eacute;toile est remplac&eacute;e par les champs dont on a besoin. Il est alors possible de ne retenir que les champs utiles.</p>
 	
 	<h4> Requêtes crois&eacute;es </h4>
 	
 	<p> On peut faire des requêtes qui font intervenir plusieurs tables en même temps. </p>
 	
<pre class = "code">
	$ma_requete = "	SELECT * FROM mesamis,mesecoles
					WHERE `mesamis`.`ecole` = `mesecoles`.`lieu`
					AND `mesecoles`.`epoque`= 'college'";
</pre>

	<p> Voil&agrave; comment MySQL retrouve vos amis du coll&egrave;ges...</p>
 	
 	
<?php
	include("../tool/footer.php");
?>