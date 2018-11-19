<?php
	include("../tool/header.php");
?>

	<h1> Javascript </h1>
	<h2> Les timers </h2>
	
	<p> Les timers permettent de rappeler une fonction apr&egrave;s un temps donn&eacute;. </p>
	
<pre class = "code">
	<span class = "identifer">var</span> <span class = "variable">timer</span>;
	<span class = "identifer">function</span>  uneFonction(){
		<span class = "reserved">alert</span>('helloworld with some lag');
	}
	<span class = "variable">timer</span> = setTimeout(uneFonction, 10000);
</pre>
	
	<p> Ce code affiche une alerte avec 10 secondes de retard. Remarquez que la fonction n'a plus ses parenth&egrave;ses pour indiquer l'argument: on r&eacute;f&eacute;rence la fonction c'est tout. le temps (ici 10000) du Timer est ici en millisecondes. Pour ex&eacute;cuter une fonction poss&eacute;dant des arguments, il faut alors passer par une liste d'arguments:</p>
	
	<pre class = "code">
	<span class = "identifer">var</span>  <span class = "variable">timer</span>;
	<span class = "identifer">function</span>  uneFonction( message, user){
		<span class = "reserved">alert</span>('Hello ' + user + ' the message is ' + message);
	}
	<span class = "variable">timer</span> = <span class = "reserved">setTimeout</span>(uneFonction, 10000, message, user);
	</pre>
	
	<p> On peut alors appeler une fonction en boucle: </p>
	
	<pre class = "code">
	<span class = "identifer">var</span>  <span class = "variable">timer</span>;
	<span class = "identifer">function</span>  uneFonction(){
		<span class = "reserved">alert</span>('hello');
		<span class = "variable">timer</span> = <span class = "reserved">setTimeout</span>(uneFonction,10000);
	}
	</pre>
	
	<p> Ce qui donne des <span class = "reserved">alert</span>es un brin intempestives. De fait, il faut alors pouvoir arrêter le timer. C'est le r&ocirc;le de lafonction <i>clearTimeout</i> qui prends en argument un Timer. </p>
	
<pre class = "code">
	<span class = "identifer">var</span> <span class = "variable">timer</span>;
	<span class = "identifer">function</span>  initFonction(){
		<span class = "variable">timer</span> = <span class = "reserved">setTimeout</span>(uneFonction,100);
	} 
	<span class = "identifer">function</span>  clearFonction(){
		<span class = "reserved">clearTimeout</span>(timer);
	}
</pre>
<?php
	include("../tool/footer.php");
?>