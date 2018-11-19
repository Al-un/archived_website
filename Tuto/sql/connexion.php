<?php
	include("../tool/header.php");
		head("Tutorial Area - SQL");
?>

	<h1>SQL </h1>
	<h2> PHP et MySQL </h2>
	
	<p>Dans mon cas, PHP fait l'interface avec MySQL. C'est &agrave; dire que c'est un script PHP qui va me permettre de me connecter &agrave; une base de donn&eacute;e et effectuer diverses actions. Mais pour ce faire, on a besoin d'un interm&eacute;diaire c'est un dire un objet qui fasse la navette entre le script PHP et la BDD.</p>
	
<pre class = "code">
	$mysql = mysql_connect("server","user","password");
</pre>
	
 	<p> Les trois arguments de la fonction <q>mysql_connect</q> prends trois arguments: </p>
	<ol>
		<li> le nom du serveur </li>
		<li> le nom de l'utilisateur </li>
		<li> un mot de passe </li>
	</ol>
	<p> Tous sont &eacute;videmment des chaines de caract&egrave;res <tt> String </tt>. On a donc cr&eacute;e une connexion SQL via un script PHP. On peut &eacute;videmment la fermer via la fonction:</p>
 
<pre class = "code">
	mysql_close($mysql);
</pre>
 	
 	<p>Entre ces deux actions, on peut &eacute;videmment formuler des requêtes SQL. Ainsi, on effectue une requête via la fonction :</p>
 	
<pre class = "code">
	mysql_query($request,$mysql);
</pre>
 	
 	<p> Les arguments sont donc un <tt> String </tt>, la requête en elle même, et un <tt> link identifier </tt> qui est la connexion SQL en question. Les requêtes SQL se pr&eacute;sentent sous diff&eacute;rentes formes: afficher un &eacute;l&eacute;ment, ajouter un &eacute;l&eacute;ment &agrave; une table, supprimer un &eacute;l&eacute;ment...Ce sont ces requêtes SQL que vous pouvez directement formuler dans une console SQL ou la console SQL de votre PHPmyAdmin où un onglet SQL vous permet d'acc&eacute;der &agrave; cette console.</p>
 	
 	
<?php
	include("../tool/footer.php");
?>