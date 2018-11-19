<?php
include_once('../Ztools/global_footer.php');

switch($_SESSION['UserLang']){
  case "Fr" :
    break;
  case "En" :
    break;
}

$footerHTML="

<div id='Misc_Footer'>
<p>Xsylum - Misc Page</p>
</div>
";

globalFooter($footerHTML);
?>