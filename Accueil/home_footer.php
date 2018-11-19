<?php
include_once(__DIR__.'/../Ztools/global_footer.php');
// <img src='Accueil/img/Home_Footer_Back.png' style='position:absolute;z-index:-1; height:100%;'/>
$footer = "";
switch($_SESSION['UserLang']){
  case "Fr" :
    // $footer     = "<p>Testée et compatible avec: </p>\n";
    $footer    = "<p>Dernière mise à jour: Septembre 2013</p>\n";
  case "En" :
    $footer    = "<p>Last Update: September 2013</p>\n";
}

$footerHTML="

</div> <!-- HomeContent -->

<div id='Home_Footer'>
<img src='Accueil/img/Home_Footer_SeparatorHor.png' width='100%'; />
<br />
<p>Xsylum - Home Page</p>
<br />
<p>$footer</p>
<br />
</div>
";

globalFooter($footerHTML);

?>