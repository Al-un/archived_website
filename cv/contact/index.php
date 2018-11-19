<?php
include("../tools/cv_header.php");
if(Xsy_Glob_AuthCheck("XsyCV", $XSY_SESS_USERLEVEL)) {


  echo("   <div id='Contact'>");
  // --------- Toutes mes coordonnées ----------------- //
  switch($_SESSION['UserLang']) {
    case "Fr" : 
    echo("<p>Si vous souhaitez me contacter, les moyens ne manquent pas. N'h&eacute;sitez pas &agrave; me contacter via un des moyens suivants: </p>");
    $phone    = 'T&eacute;l&eacute;phone';
    $email1   = 'Email Mines de Nancy (email &agrave; vie)';
    $email2   = 'Adresse Gmail';
    $address  = 'Adresse Parentale';
    break;
    case "En" : 
    echo("<p>Please feel free to contact me if you have any question or comments. You may use the following contacts:</p>");
    $phone    = 'Phone Number';
    $email1   = 'School Email';
    $email2   = 'Gmail';
    $address  = 'Address (familial)';
    break;
    case "ZhTr" : 
    echo('');
    $phone    = '電話';
    $email1   = '電郵 (學校)';
    $email2   = '電郵 (Gmail)';
    $address  = '地址 (家里)';
    break;
    default : $title = "Contact, invalid lang:".$_SESSION['UserLang'];
  }
      

  echo("
   <div class = 'someData'>
    <table border = '0'>
      <tr> <td> $phone </td> <td> +33 (0)6 25 27 65 11 </td> </tr>
    <tr> <td> $email1 </td> <td> <a href = 'mailto:Alain.Seng@mines-nancy.org'>Alain.Seng@mines-nancy.org</a> </td> </tr>
    <tr> <td> $email2 </td> <td> <a href = 'mailto:seng.alain@gmail.com'>Seng.Alain@gmail.com</a> </td> </tr>
    <tr> <td> $address </td> <td> 3 rue Lucien Piron <br /> 93110 Rosny-sous-Bois <br /> FRANCE </td> </tr>
    </table>
   </div>
  ");  
      
  // -------- Présent sur le net !!!!! ------------- //
  switch($_SESSION['UserLang']) {
    case "Fr" : 
    echo("<p>Mais je suis &eacute;galement pr&eacute;sent sur le net, pour un c&ocirc;t&eacute; plus ou moins formel. Concernant les r&eacute;seaux sociaux professionnels, j'ai une pr&eacute;f&eacute;rence pour LinkedIn par rapport &agrave; Viadeo. <br /> Quand &agrave; DeviantArt, il s'agit d'un site de partage de dessin.</p>");

    break;
    case "En" : 
    echo("<p>There also other ways to join me via Internet in a more or less formal way. Concerning professional social networks, for some reasons, I prefer LinkedIn compared to Viadeo. <br /> DeviantArt is a sharing artwork website which I try to update as much as possible.");

    break;
    case "ZhTr" : 
    echo('');

    break;
    default : $title = "Contact, invalid lang:".$_SESSION['UserLang'];
  }

  echo("
   <div class = 'someData'>
    <table border = '0'>
      <tr> <td> LinkedIn </td> <td> <img src='linkedin.png' width='15' alt='LinkedIn' /> <a href = 'http://www.linkedin.com/in/alainseng'> http://www.linkedin.com/in/alainseng</a> </td> </tr>
      <tr> <td> DeviantArt </td> <td><img src='../cv/img/logo_deviantart.png' width='15' alt='DeviantArt' /> <a href = 'http://xsylum.deviantart.com/'> http://xsylum.deviantart.com/</a> </td> </tr>
    </table>
   </div>
   
   
  </div> <!-- end id='Contact' -->

  ");


}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}
include("../tools/cv_footer.php");
?>