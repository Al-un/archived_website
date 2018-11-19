<?php
include("../tools/header.php");
?>

<h1> HTML </h1>
<h2> Le Head </h2>

       
       
<p> En HTML, comme dans beaucoup de langage de "programmation", il existe des conventions. Le W3C (<i>World Wide Web Consortium</i>) veille au grain. Mais voici le code minimal. Pratique pour un copier-coller.</p>
      
<pre class = "code">
&lt;!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"&gt;
       		
&lt;html&gt;

&lt;head&gt;
&lt;meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"&gt;
&lt;title&gt;Mon titre&lt;/title&gt;
&lt;/head&gt;
	  
&lt;body&gt;
Mon corps de texte...
&lt;/body&gt;
			
&lt;/html&gt;
</pre>

<p>Ce charabia se d&eacute;cortique bien avec <b>l'indentation</b> (l'art de d&eacute;caler des balises selon une certaine arboresence). La premi&egrave;re ligne ne concerne que le W3C. C'est en gros pour dire qu'on &eacute;crit en HTML. Mais la vrai annonce du html est marqu&eacute;e par les balises: <xmp> <html></html> </xmp>Tout ce qui est contenu entre ces deux balises est du code HTML. De m&ecirc;me <xmp> <head></head> </xmp> C'est la t&ecirc;te du document. On y indique le titre de la page et divers informations que l'on verra plus ult&eacute;rieurement: c'est principalement pour importer des fichiers css ou javascript. La balise meta concerne ici le "type de caract&egravere" utilis&eacute; sur ce site. ISO8859-1 signifie que l'on &eacute;crit dans une &eacute;criture latine qui comporte des accents. Pratique pour &eacute;crire en Fran&ccedil;ais.<xmp> <body></body> </xmp> C'est le corps du texte: ce que l'internaute verra.</p>
   
<p>Du point de vue fichier, les fichiers html ont pour extension ".html" mais il est conseill&eacute; d'utiliser les extensions ".htm". Les extensions ont en g&eacute;n&eacute;ral trois lettres.    			
       
<?php
	include("../tools/footer.php");
?>