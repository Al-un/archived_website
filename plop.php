<?php
include('Accueil/home_header.php');

$value = "";
if(isset($_POST['Update'])){
  $value = Xsy_Glob_Get('plop');
}

echo("
  <form method='post' action=''>
    <textarea name='plop' cols='50' rows='10'> ".str_replace("<br />", "", $value)." </textarea>
    <input type='submit' name='Update' value='Envoyer' />
  </form>
");

echo("<p> following has been sent : </p> <div> $value </div>");

$grr="mon memo tralala ave un petit lien http://99-bottles-of-beer.net/ <br />
<br />
et un autre par ici http://doujinstyle.com/wp-content/uploads/2014/07/Ichigeki-Nyuukon-Panda-Ball.jpg<br />
<br />
blabla <br />
<br />
<br />
www.google.fr<br />
<br />
<br />
";
echo("<br /><br /><br /><br />");
echo(str_replace("<br />", "\n", $grr));
echo("<br /><br /><br /><br />");
echo(Xsy_Glob_AddLinkToUrl($grr));

include('Accueil/home_footer.php');
?>