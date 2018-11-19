<?php
	include("../tools/header.php");
?>
 	
 	<h1> SQL </h1>
 	
 	
 	<p>Il existe de nombreuses structures de base de donn&eacute;es. Parmi elles, on retrouve le MySQL, la BDD que j'utilise personnellement pour ce site comme tant d'autres. MySQL, la c&eacute;l&egrave;bre base de donn&eacute;es (BDD) dont on peut en entendre souvent parler. Mais c'est quoi exactement?</p>
	
		<center>
		<img src = "logo_mysql.png" width = 200 height = 100 title = "MySql logo" alt = "MySQL logo" />
		</center>
		
	<p>Une base de donn&eacute;e, c'est une structure physique qui enregistre...des donn&eacute;es, surprenant hein? MySql est le SGBD le plus r&eacute;pandu. On ordonne les actions &agrave; faire via une console SQL. Comme tout syst&egrave;me il faut s'y connecter. Ainsi le protocole de base est :</p>
	
	<ol>
		<li>On se connecte &agrave; la base de donn&eacute;es</li>
		<li>On donne les instructions</li>
		<li>Une fois les instructions termin&eacute;es, on se d&eacute;connecte de la BDD</li>
	</ol>
	
	<p>Mais concr&egrave;tement on voit quoi? Une bonne interface de MySQL est PHPmyAdmin. Ecrite en PHP, c'est interface vous permet d'enregistrer des donn&eacute;es et de les manipuler. PHPmyAdmin est inclus dans <a href = "http://www.wampserver.com/download.php" target = blank>WampServer </a> (Voir le <a href = "../php/index.php">tuto PHP</a> pour savoir de quoi il s'agit). Mais PHPMyAdmin ne vous permet qu'une manipulation brute, c'est &agrave; dire par exemple si dans mon carnet d'adresse, je souhaite ajouter un nom et bien PHPmyAdmin vous donne une interface pour &ccedil;a. Mais si vous voulez l'ajouter &agrave; deux carnets diff&eacute;rents alors il faudra faire deux fois la même action. Vous vous doutez bien que sur les pages web, &ccedil;a ne marche pas comme &ccedil;a.</p>
	
	<p>Il faut savoir que l'arboresence d'une BDD SQL est:</p>
	
	<ul>
		<li>une base de donn&eacute;es : Mon carnet d'adresse
			<ol>
				<li> une table : mes amis </li>
				<li> une table : ma famille </li>
			</ol>
		</li>
		<li> une base de donn&eacute;es : mes rendez vous
			<ol> 
				<li> une table : mon boulot </li>
				<li> une table : ma vie priv&eacute;e </li>
			</ol>
		</ol>
	</ul>
	
	<p> Une base de donn&eacute;es est donc un ensemble de tables. Une table se d&eacute;finit par une structure. Par exemple si on d&eacute;finit la table amis par :</p>
	
	<ul>
		<li> Nom : VARCHAR(50) </li>
		<li> Prenom : VARCHAR(50) </li>
		<li> Age : int </li>
	</ul>
	
	<p> On voit qu'il y a un nom de champ (par exemple "Nom") et un type de champ ( VARCHAR(50) ). Varchar signifie "chaine de caract&egrave;re". 50 est la taille maximale de la chaine de caract&egrave;re. Donc si quelqu'un a un nom qui d&eacute;passe les 50 caract&egrave;res, il verra son nom tronqu&eacute; dans la BDD. De même, le champ "Age" est de type "int" ie un entier.</p>
	<p> MySQL enregistre donc des donn&eacute;es dans des tables en respectant les champs et leur typages. Mais PHPMyAdmin vous permet de voir tout &ccedil;a, la structure des tables, la structure de votre base de donn&eacute;es. Conctr&egrave;tement, apr&egrave;s avoir install&eacute; WampServer (ou autre plate-forme mais celle-ci me convient tr&egrave;s bien), vous pouvez acc&eacute;der &agrave; votre page PHPMyAdmin via votre navigateur Web avec l'URL <a href = "http://localhost/phpmyadmin/"><i>http://localhost/phpmyadmin</i></a>. C'est l&agrave; que vous pourrez cr&eacute;er vos premi&egrave;res base de donn&eacute;es</p>
	
	
 	
 

<?php
	include("../tools/footer.php");
?>