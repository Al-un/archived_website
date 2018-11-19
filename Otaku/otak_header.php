<?php
// $root = $_SERVER['DOCUMENT_ROOT'];
// include_once($root.'/Ztools/global_header.php');
include_once('../Ztools/global_header.php');
include_once("otak_settings.php");




// ==================================  LANGUAGES  ================================ //
$siteName         = "XsyOtak";
$css_array[]      = "otak_css.css";
$js_array[]       = "";
$optionalCss      = "";
$optionalJs       = "";
$body             = "";
$leftside[]       = "  <ul>";
$leftside[]      .= "    <li> <a href='otak_anime.php'>Anime</a> </li>";
$leftside[]      .= "  </ul>";
$leftside[]      .= ($_SESSION['UserAdmin']) ? "
  <div>
    <p> <a href = 'index_admin.php'> Admin Panel </a> </p>
  </div>\n" : "";
$rightside[]      = "";
$beforePage       = "";
$metaOther        = "";
$headerMisc       = "";

globalHeader($siteName, $css_array, $js_array, $body, $leftside, $rightside, $beforePage, $metaOther, $headerMisc);

// Contents

/*
echo("
<a href='/Japanimation/index.php'>  Accueil     </a>

<a href='/Japanimation/Otak/'>  Otak       </a>
<a href='/Japanimation/Otak/anime.php'>  Anime       </a>
<a href='/Japanimation/Otak/manga.php'>  Manga       </a>
<a href='/Japanimation/Otak/film.php'>  Film         </a>
<a href='/Japanimation/Otak/vocaloid.php'> Vocaloid  </a>
<a href='/Japanimation/Otak/musique.php'>  J-Music   </a>

<a href='/Japanimation/'>  la Japanimation           </a>
<a href='/Japanimation/'>  Les types des Mangas      </a>
<a href='/Japanimation/'>  Les archétypes            </a>
<a href='/Japanimation/'>  Les <i>~Dere</i>          </a>
<a href='/Japanimation/'>  Le moe                    </a>
<a href='/Japanimation/'>  Les lolitas               </a>

<a href='/Japanimation/'>  Culture                   </a>
<a href='/Japanimation/'>  A l'école                 </a>
<a href='/Japanimation/'>  Le train                  </a>
<a href='/Japanimation/'>  La Mythologie             </a>
<a href='/Japanimation/'>  Le Cosplay                </a>

");
*/
?>







