<?php
include_once('../Ztools/global_footer.php');

switch($_SESSION['UserLang']){
  case "Fr" :
    $Footer     = "<p>Testée et compatible avec: </p>\n";
    $Footer    .= "<p>Dernière mise à jour: Septembre 2013</p>\n";
  case "En" :
    $Footer     = "<p></p>\n";
    $Footer    .= "<p></p>\n";
}

$footerHTML="

</div> <!-- HomeContent -->

<div id='Home_Footer'>
<br />
<p>Xsylum - Home Page</p>
<br />
<p>$Footer</p>
<br />
</div>
";

globalFooter($footerHTML);
?>