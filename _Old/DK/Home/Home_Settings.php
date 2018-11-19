<?php
switch($_SESSION['userlang']){

  case "En": 
    $imgTitle   = "";
    $desc[]     = "<p> Welcome on the Pho Bida Vietnam website. Website is currently under construction. A menu and access map is already available.</p>";
  break;

  case "Tw":
    $imgTitle   = "";
    $desc[]     = "<p> ....</p>";
  break;

  case "Vn":
    $imgTitle   = "";
    $desc[]     = "<p> Bienvenue</p>";
  break;

  default:
    $imgTitle   = "";
    $desc[]     = "<p> Bienvenue sur le site web du restaurant Pho Bida Vietnam. Le site est actuellement en cours de construction. Un menu et les informations pratiques sont déjà disponibles.</p>";
}
?>