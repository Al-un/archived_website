<?php
include("../Tools/phobida_header.php");
include("Info_settings.php");


// useful information

echo("
 <div id='Phobida_Info_Background'>
 <img src='".$urlRoot."Info/img/phobida_info_background_middle.png' alt='Phobida' class='Background_Middle'/>
 <img src='".$urlRoot."Info/img/phobida_info_background.jpg' alt='Phobida' class='Background_Full'/>
 </div>

 <div id='Phobida_Info'>



 <div id='Infos'>

  <p class='Infos_Title'> ".$textInfos['Address']." </p>
  <p class='Infos_Content'> 36-38 rue Nationale 75013 Paris </p>

  <p class='Infos_Title'> ".$textInfos['Metro']." </p>
  <p class='Infos_Content'>
    <img src='img/metro.png' title='Metro' alt='Metro' class='Metro_Pic'/>
    <img src='img/metro14.png' title='Ligne 14' alt='14' class='Metro_Pic'/>
    Olympiades
    <br />
    <img src='img/metro.png' title='Metro' alt='Metro' class='Metro_Pic'/>
    <img src='img/metro7.png' title='Ligne 7' alt='7' class='Metro_Pic'/>
    Porte d'Ivry
  </p>

  <p class='Infos_Title'> ".$textInfos['Phone']." </p>
  <p class='Infos_Content'> +33 (0)1 53 79 01 61 </p>

  <p class='Infos_Title'> ".$textInfos['OpenedTitle']." </p>
  <p class='Infos_Content'> ".$textInfos['OpenedDesc']." </p>

 </div>");

// For the moment, email is not available for Phobida restaurant.
  // <p class='Infos_Title'> ".$textInfos['Email']." </p>
  // <p class='Infos_Content'> <a href='mailto:contact@phobida.com'> contact@phobida.com </a> </p>






// Google Maps powaaa !!!
echo("
 <div id='GoogleMaps'>
  <iframe frameborder='1' scrolling='no' marginheight='0' marginwidth='0' src='https://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=pho+bida+vietnam&amp;aq=&amp;sll=48.824264,2.368034&amp;sspn=0.008632,0.022273&amp;g=38+Rue+Nationale,+Paris&amp;ie=UTF8&amp;t=m&amp;ll=48.824264,2.368034&amp;spn=0.008632,0.022273&amp;output=embed'>
  </iframe>
  <br />
  <small>
   <a href='https://maps.google.fr/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=pho+bida+vietnam&amp;aq=&amp;sll=48.824264,2.368034&amp;sspn=0.008632,0.022273&amp;g=38+Rue+Nationale,+Paris&amp;ie=UTF8&amp;t=m&amp;ll=48.824264,2.368034&amp;spn=0.008632,0.022273'
   style='color:#0000FF;text-align:left'> ".$textInfos['LargerMap']."
   </a>
  </small>
 </div>


 </div>

");





include("../Tools/phobida_footer.php");
?>









