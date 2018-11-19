<?php

switch($_SESSION['userlang']) {

  case "Fr" :
    $title		= "Valeera Sanguinar";
	$infos['Date']	= "Février 2008";
	$infos['Jeux']	= "World of Warcraft";
	$infos['Source']= "<a href='http://www.deviantart.com/download/56595090/Valeera_Saguinar_by_Shiramune.jpg' class='fancybox'>Valeera Sanguinar</a> de <a href='http://shiramune.deviantart.com/'><i>Shiramune</i></a>";

    $description[] = "<p> Une jolie Elfe de sang ... ouais enfin faut pas la chercher des crosses non plus la petite elfe car elle est d'un tempérament plutôt violent. Dans la BD World of Warcraft, dont les graphismes sont à couper le souffle (mais c'est tout je trouve), elle se retrouve dans une drôle d'équipe composée d'un druide elfe et d'un étrange humain (nan mais spoiler ça c'est un crime!). La petite elfe va alors devoir survivre dans son nouvel environnement  </p>
	
	<p> Niveau dessin, j'ai vraiment adoré le dessin de Shiramune. Valeera y est super classe. D'une beauté mortelle et d'une froideur sans pareille, la Valeera de Shiramune illustre assez bien la Valeera adulte. On y ressent une vie marquée par les combats. Par contre, je ne me sentais pas capable de reproduire un dessin pareil. Alors j'ai juste retroussé mes manches et puis advienne que pourra. J'ai dû faire un scaling 2:1 sur ce dessin (l'orginal est en A4, mon carnet est en A5). Bon autant dire que j'ai pédalé dans la semoule pour arriver à ce résultat. A la différence de la chasseresse, j'ai préféré lui donner une tête, quitte à ce qu'elle soit mal faite. T_T . Mais je ne suis pas si mécontent du résultat.</p>";
	break;
	
  case "En" : 
    $title		= "Valeera Sanguinar";
	$infos['Date']	= "February 2008";
	$infos['Game']	= "World of Warcraft";
	$infos['Source']= "<a href='http://www.deviantart.com/download/56595090/Valeera_Saguinar_by_Shiramune.jpg' class='fancybox'>Valeera Sanguinar</a> by <a href='http://shiramune.deviantart.com/'><i>Shiramune</i></a>";
	
    $description[] = "<p>Valeera, a deadly beauty. She is a pretty Blood Elf but you should be careful with her. She is quite aggressive. In the comic World of Warcraft (in France at least, dunno elsewhere), she belongs to a strange team made of an Elf Druid and a strange human (I can't spoil this point!). The little elf will have to survive in her new environment and maybe trust someone for the first time.</p>

<p>For the drawing, I really like the Shiramune's version. Valeera is so awesome. Deadly beauty, she depicts quite well the adult Valeera: a life full of fight and anger. However, I didn't feel able to do such an artwork so I tried and wait and see then. I did a 2:1 scaling as the original is in A4 format when printed and my zap book is A5 format. Unlike the Elf Huntress, I tried to give her a face, even if I failed it, i would have finished her. Finally, I am not that disappointed of the result.</p>";
    break;
	
  case "ZhTr" : 
	$infos['When']	= "";
	
    $description[] = "<p>...</p>";
	$img_title		= "";
    break;
	
  default : $description = "Art, invalid lang:".$_SESSION['userlang'];
  
}

?>