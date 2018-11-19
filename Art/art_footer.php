<?php
include_once('../Ztools/global_footer.php');

$footerHTML="
  <!-- </div> HomeContent -->

  <div id='Art_Footer'>

    <div class='FootBlock' id='ArtHome'>
      <p class='header'> Home </p>
    </div>

    <div class='FootBlock' id='ArtAbout'>
      <p class='header'> About </p>
      <p> This website is manually done thanks to PHP, a mySQL database, CSS 3.0 and above all, the jQuery library ! </p>
      <p> I tried the w3c compatibility. As-of June 2015, the website is compliant w3C for XHTML 1.0 Transitional and CSS3: </p>
      <p style='text-align:center;'> <a href='http://validator.w3.org/check?uri=referer'><img src='http://www.w3.org/Icons/valid-xhtml10' alt='Valid XHTML 1.0 Transitional' height='31' width='88' /></a> <a href='http://jigsaw.w3.org/css-validator/check/referer'>
        <img style='border:0;width:88px;height:31px'
            src='http://jigsaw.w3.org/css-validator/images/vcss'
            alt='Valid CSS!' />
    </a></p>
    </div>

    <div class='FootBlock' id='ArtContact'>
      <p class='header'> Contact </p>
      Under construction. :(
      <!--
      <p> $textContactFormIntro </p>
      <form method='post' action='' >
        <p> $textContactFormName </p>
        <input type='text' name='ContactName' />
        <p> $textContactFormEmail </p>
        <input type='text' name='ContactEmail' />
        <p> $textContactFormText </p>
        <textarea name='ContactText'></textarea>
      </form>
      -->
    </div>

    <div class='FootBlock' id='ArtLink'>
      <p class='header'> Links </p>
      <p> Feel free to have a look on my DeviantArt: <a href='http://xsylum.deviantart.com'>xsylum.deviantart.com</a> </p>
    </div>

  </div>
";

globalFooter($footerHTML);
?>