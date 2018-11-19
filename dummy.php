<?php
include('Accueil/home_header.php');

// =========================================================== //
// test POST content for text field
// =========================================================== //
$plop = "";
if(isset($_POST['mysubmit'])){
  echo("<div style='color: cyan;background:black;'> ----- Raw ----- <br />");
  echo($_POST['mytext']);
  echo(" <br /> ----- htmlentities ----- <br />");
  echo(Xsy_Glob_EscapeString(htmlentities($_POST['mytext']), array("\\'"=>"##")));
  echo(" <br /> ----- stripslashes + htmlentities ----- <br />");
  echo(stripslashes($_POST['mytext']));
  echo(" <br /> ----- html_entity_decode ----- <br />");
  echo(nl2br(htmlentities(stripslashes($_POST['mytext']))));
  $plop = Xsy_Glob_EscapeString(nl2br(htmlentities(stripslashes($_POST['mytext']))), array("<br />"=>""));
  echo(" <br /> ----- stripslashes  ----- <br />");
  echo(html_entity_decode($_POST['mytext']));
  echo("</div>\n");
}

echo("
<form method='post' action=''>
<p> Text </p>
<textarea name='mytext' rows='10' cols='60'>".$plop."</textarea> <br />
<input type='submit' name='mysubmit' value='Send it !!' />
</form>
");


include('Accueil/home_footer.php');
?>