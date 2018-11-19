<?php
include("../tools/header.php");
?>
 	
<h1> PHP </h1>
 	
  <p>PHP? C'est le langage qui g&eacute;n&egrave;re dynamiquement du HTML. Bon ok c'est pas trop parlant. Une page HTML, c'est du code qu'un navigateur web traduit pour g&eacute;n&egrave;rer la page web que vous lisez. Or, le PHP g&eacute;n&egrave;re du HTML. C'est &agrave; dire que c&ocirc;t&eagrave; du serveur, ca bosse dur pour fournir ce code HTML qui d&eacute;pend de certaines donn&eacute;es et de certaines variables. Ce code HTML est ensuite envoy&eacute; au client que vous &ecirc;, en l'occurence votre pc, pour afficher la magnifique page que vous &ecirc;tes en train de lire.</p>
 	
  <div style = 'text-align:center;'>
    <img src = "logo_php.jpg" height = "100" width = 150 title = "L'embl&egrave;me de la communaut&eacute; PHP : l'&eacute;l&eacute;PHPant" />
  </div>
	 
	 <p>De ce fait, pour tester une page PHP, Firefox ne vous suffit pas (car j'esp&egrave;re que vous êtes au moins sous Mozilla hein?). Il faut un logiciel qui simule un serveur. En l'occurence, il faut une simulation d'un serveur sur lequel tourne Apache, un logiciel qui traduit le PHP. Apache tourne donc en permanence sur les vrais serveurs. Le simulateur que j'utilise est <a href ="http://www.wampserver.com/download.php"> WampServer2 </a>. Cette plate-forme de d&eacute;veloppement vous permet ainsi de tester vos pages HTML mais aussi de g&eacute;rer des donn&eacute;es SQL. Pour les bases de donn&eacute;es, allez jeter un oeil du c&ocirc;t&eacute; du <a href = "tuto_sql.htm"> Tuto SQL </a>.</p>
	 
	 <p> Apr&egrave;s avoir tout en main pour cr&eacute;er du PHP et le tester (tr&egrave;s important le test), on peut commencer .</p>
	 
	 	<b> Les premiers pas en PHP </b> <!-- partie I -->
	 
	 <p> Du c&ocirc;t&eacute; d&eacute;veloppement Web, PHP g&eacute;n&egrave;re du HTML. La premi&egrave;re &agrave; savoir est qu'il n'est pas impossible de mixer HTML et PHP. Ainsi on doit alors pr&eacute;ciser qu'on rentre dans la code PHP afin de ne pas confondre les balises. C'est le r&ocirc;le des balises <i> &lt;?php </i> et </>  ?&gt; </i> Ainsi si on veut afficher le message "Hello world", on utilise la commande <i> echo </i>: </p>
	 
	 <pre>   
	&lt;?php
		echo("Hello World"); 
	?&gt;
	</pre>
	 
	 <p> Tout d'abord que remarque-t-on? Il y a la fonction <i>echo</i> qui prend en argument le message <i> "Hello World" </i>. Les guillemets permettent de dire &agrave; PHP qu'il s'agit d'une donn&eacute;e de type <i> String </i> c'est &agrave; dire une chaine de caract&egrave;re. On dit alors que <u> la fonction echo prend en argument une variable de type String </u>. Vous noterez le point-virgule &agrave; la fin de la ligne. Le point virgule indique la fin d'une <i> instruction </i>. PHP ressemble alors un peu plus &agrave; la programmation pourrait-on dire. D'ailleurs PHP peut aller tr&egrave;s loin dans cette voie l&agrave; (si programmation orient&eacute;e objet parle pour le lecteur ou la lectrice...)</p>
	 
	 	<b> Variables et fonction </b> <!-- partie II -->
	 	
	<p> Une variable est compos&eacute; d'un nom et d'une valeur. Le nom de chaque variable commence par le signe dollar "$". Cela permet &agrave; PHP de reconnaitre une variable. Une variable se d&eacute;clare dans un premier temps pour pouvoir ensuite être exploit&eacute;e. Pour d&eacute;clarer une variable, il suffit d'&eacute;crire que la variable existe et de lui donner une valeur initiale:</p>
	
		<pre> $ma_variable = "helloworld"; </pre>
		
	<p> Vous remarquerez que le point-virgule est toujours l&agrave;. Ainsi j'ai une variable qui s'appelle $ma_variable et qui a pour valeur la chaine de caract&egrave;re "Hello world". PHP n'est pas fortement typ&eacute;, c'est &agrave; dire que vous n'avez pas &agrave; dire que $ma_variable est de type String et elle restera de type String. Cette souplesse est utile &agrave; PHP mais mieux vaut ne pas m&eacute;langer les types. En utilisant cette variable, on peut l'afficher :</p>
	
		<pre> echo($ma_variable) </pre>
		
	<p>Ce qui renvoit le même r&eacute;sultat que l'appel de la fonction "echo" pr&eacute;c&eacute;dent. Vous commencez &agrave; saisir la puissance de PHP? non? ben c'est normal, vous ne connaissez que deux choses: la fonction echo et les variables. Mais cela permet d'aller loin : imaginez que l'on puisse changer la variable $ma_variable. On pourrait afficher un tas de textes diff&eacute;rents grâce &agrave; la fonction echo. Tenez, un truc utilse, c'est la concat&eacute;nation. On concat&egrave;ne (mettre bout &agrave; bout) deux chaines String via un point.</p>
	
	<pre>
	$hello 		= "hello"; 
	$world		= "world";
	$message	= $hello.$world;
	echo($message);
		</pre>
	
	<p>On a encore le même renvoi &agrave; ceci pr&egrave;s qu'on manipule mieux ce qu'on affiche. En effet, il suffirait de modifier la variable <i>$world</i> pour pouvoir changer le message.</p>
	
	<p>Mais PHP permet trois type de variable :</p>
	
	<ul>
		<li type = "circle"> <i>String</i>, les chaînes de caract&egrave;res </li>
		<li type = "circle"> <i>int</i>, les entiers </li>
		<li type = "circle"> <i>boolean</i> les bool&eacute;ens qui sont les valeurs <i> True </i> (vrai) et <i>False</i> (faux).
	</ul>
	
	<p> Nous travaillerons sur les booleens plus tard. Le type <i>int</i> va au-del&agrave;
 	
<?php
include("../tools/footer.php");
?>