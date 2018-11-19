<?php
include("Tools/phobida_header.php");
include("Home/Home_".$_SESSION['userlang'].".php");

echo(" <div id='Phobida_Home'>
  <img class='Home_Background' src='Home/img/phobida_home_background_top.png' alt='Phobida Home' />

  <div id='Phobida_Home_Desc'>
    <img class='Home_Text_Background' src='Home/img/phobida_home_background_middle.png' alt='Phobida Home' />
    <p> bla bla bla </p>
  </div>
  <img class='Home_Background' src='Home/img/phobida_home_background_bottom.png' alt='Phobida Home' />
");


foreach($desc as $key=>$value){
  // echo $value;
}

echo(" </div>");


include("Tools/phobida_footer.php");
?>