<?php
include("header.php");
// ---------- TO GET THE SUMMARY ---------------- //
// ---------------------------------------------- //

function summary($lang,$page){
 	
 	
 		header($lang);
 
 	// >>> FRENCH summary <<<
 	if ($lang == "fr"){
 	 	
		$page = $page.'?lang=en';
?>		<!-- /* Choose your language */-->
	 	<p class = "sommaire">
	 		<a href = "<?php echo($page); ?>"  class = "sommaire">
	 		<img src = "img/en.gif" title = "English Version" alt = "Eng"/>
	 		</a>
	 	</p>
	 	<!-- /* Summary */ -->
		<table border = "0" class = "sommaire">
		<tr>
			<td class = "sommaire"><a class = "sommaire" href = "index.php?lang=fr"> 	Accueil 			</a></td>
			<td class = "sommaire"><a class = "sommaire" href = "cv.php?lang=fr">		mon CV				</a></td>
			<td class = "sommaire"><a class = "sommaire" href = "contact.php?lang=fr">	Contact				</a></td>
		</tr>
		</table>
<?php		
	}	// end if == fr
	
	// >>> ENGLISH summary <<<
	else if ($lang == "en"){
		
		$page = $page.'?lang=fr';
?>		<!-- /* Choose your language */-->
	 	<p class = "sommaire">
	 		<a href = "<?php echo($page); ?>"  class = "sommaire">
	 		<img src = "img/fr.jpg" title = "Version Française" alt = "Fr"/>
	 		</a>
	 	</p>
	 	<!-- /* Summary */ -->
 	 	<p class = "sommaire">
		</p>
		<table border = "0" class = "sommaire">
		<tr>
			<td class = "sommaire"><a class = "sommaire" href = "index.php?lang=en"> 	Home page 			</a></td>
			<td class = "sommaire"><a class = "sommaire" href = "cv.php?lang=en">		Résumé				</a></td>
			<td class = "sommaire"><a class = "sommaire" href = "contact.php?lang=en">	Contact				</a></td>
		</tr>
		</table>
<?php
	}	// end if == en
	
}// end function summary
?>
