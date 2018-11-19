<?php
include_once(__DIR__.'/../Ztools/global_footer.php');
// <img src='Accueil/img/Home_Footer_Back.png' style='position:absolute;z-index:-1; height:100%;'/>

switch($_SESSION['UserLang']){
  case "Fr" :
    $Footer     = "<p>Testée et compatible avec: </p>\n";
    $Footer    .= "<p>Dernière mise à jour: Septembre 2013</p>\n";
}

$plop="

</div> <!-- HomeContent -->

<div id='Home_Footer'>
<br />
<p>Xsylum - Home Page</p>
<br />
<p>$Footer</p>
<br />
</div>
";

globalFooter($plop);

?>