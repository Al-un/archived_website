<?php
include_once("otak_header.php");






/* ======= Retrieve all anime ======= */

$anime_list   = array();
$anime_id     = 0;
$sub_id       = 0;
$tag_id       = 0;
$anime_query  = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_Anime` ORDER BY `$sqlTable_Anime`.`Txt_Name`";
$anime_fetch  = Xsy_Sql_FetchAll($anime_query);

foreach($anime_fetch as $anime){
  
  // --- get all animes, only anime, not related to any fansub
  $anime_id                           = $anime['ID_OtakAnime'];
  $anime_list[$anime_id]['Name']      = $anime['Txt_Name'];
  $anime_list[$anime_id]['OrigName']  = $anime['Txt_Original%Name'];
  $anime_list[$anime_id]['DateStart'] = $anime['DT_Start%Date'];
  $anime_list[$anime_id]['DateEnd']   = $anime['DT_End%Date'];
  $anime_list[$anime_id]['File']      = $anime['Txt_File%Name'];

  // --- get tags at anime level, not at subbed level
  $tables       = "`$SQL_DATABASE`.`$sqlTable_AnimeTagVal`, `$SQL_DATABASE`.`$sqlTable_AnimeTagged`";
  $conditions   = "WHERE `$sqlTable_AnimeTagVal`.`ID_OtakAnimeTagValue` = `$sqlTable_AnimeTagged`.`Id_OtakAnimeTagValue`
    AND `$sqlTable_AnimeTagVal`.`Id_Language` = '".$_SESSION['UserLangId']."'
    AND `$sqlTable_AnimeTagged`.`Id_OtakAnimeSubbed` = '0'
    AND `$sqlTable_AnimeTagged`.`Id_OtakAnime` = '".$anime_id."'";

  if (Xsy_Sql_CheckCount($tables, $conditions)){
    $tag_fetch = Xsy_Sql_FetchAll("SELECT * FROM ".$tables." ".$conditions);
    foreach($tag_fetch as $tag){
      $tag_id                                 = $tag['Id_OtakAnimeTag'];
      $anime_list[$anime_id]['Tag'][$tag_id][]= $tag['Txt_Value'];
    }
  }





  // --- seperate fan sub from anime as different download can lead to different quality / other tag
  $tables       = "`$SQL_DATABASE`.`$sqlTable_AnimeSub`, `$SQL_DATABASE`.`$sqlTable_AnimeSubbed`";
  $conditions   = "WHERE `$sqlTable_AnimeSub`.`ID_OtakAnimeSub` = `$sqlTable_AnimeSubbed`.`Id_OtakAnimeSub`
    AND `$sqlTable_AnimeSubbed`.`Id_OtakAnime` = '".$anime_id."'";

  if (Xsy_Sql_CheckCount($tables, $conditions)){
    $sub_fetch = Xsy_Sql_FetchAll("SELECT * FROM ".$tables." ".$conditions);
    foreach($sub_fetch as $sub){

      $sub_id                                 = $sub['ID_OtakAnimeSubbed'];
      $anime_list[$anime_id]['Sub'][$sub_id]['Team'] = $sub['Txt_Team%Name'];
      $anime_list[$anime_id]['Sub'][$sub_id]['Link'] = $sub['Txt_Link'];
      $anime_list[$anime_id]['Sub'][$sub_id]['Lang'] = $sub['Txt_Language'];

      // --- get tags at subbed level, not at anime level
      $tables       = "`$SQL_DATABASE`.`$sqlTable_AnimeTagVal`, `$SQL_DATABASE`.`$sqlTable_AnimeTagged`";
      $conditions   = "WHERE `$sqlTable_AnimeTagVal`.`ID_OtakAnimeTagValue` = `$sqlTable_AnimeTagged`.`Id_OtakAnimeTagValue`
        AND `$sqlTable_AnimeTagVal`.`Id_Language` = '".$_SESSION['UserLangId']."'
        AND `$sqlTable_AnimeTagged`.`Id_OtakAnime` = '0'
        AND `$sqlTable_AnimeTagged`.`Id_OtakAnimeSubbed` = '".$sub_id."'";
      if (Xsy_Sql_CheckCount($tables, $conditions)){

        $tag_fetch = Xsy_Sql_FetchAll("SELECT * FROM ".$tables." ".$conditions);
        foreach($tag_fetch as $tag){
          $tag_id                                           = $tag['Id_OtakAnimeTag'];
          $anime_list[$anime_id]['Sub'][$sub_id]['Tag'][$tag_id][] = $tag['Txt_Value'];
        }
      }
    }
  }


}

// --- get all distinct tags
$tag_list   = array();
$tag_query  = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_AnimeTag` ORDER BY `$sqlTable_AnimeTag`.`Int_Tag%Order`";
$tag_fetch  = Xsy_Sql_FetchAll($tag_query);
foreach($tag_fetch as $tag){
  $tag_id             = $tag['ID_OtakAnimeTag'];
  $tag_list[$tag_id]  = $tag['Txt_Tag%Name'];
}



/* ======= Display all anime ======= */
$anime_text = "";
// echo("<pre>");
// print_r($anime_list);
// echo("</pre>");
foreach($anime_list as $anime){

  $anime_text .= "
    <div class='otak_anime'>
      <p class='title'> ".$anime['Name']." </p>

      <div class='charac'>
        <p>".$anime['OrigName']."</p>
        <p> ".$anime['DateStart']." - ".$anime['DateEnd']."</p>
      </div>";

  if(isset($anime['Tag'])){
    
  }

  if(isset($anime['Sub'])){
    foreach($anime['Sub'] as $sub){ 
    $anime_text .= "
      <div class='otak_anime_sub'>
        <p> ".( ($sub['Link']!=="") ? "<a href='".$sub['Link']."'>".$sub['Team']."</a>" : $sub['Team']);
    $anime_text .= " (".$sub['Lang'].") &nbsp;&nbsp;&nbsp;";

    if(isset($sub['Tag'])){
      foreach($tag_list as $tagid=>$tagname){
        if(isset($sub['Tag'][$tagid])){
          foreach($sub['Tag'][$tagid] as $tagvalue){
            $anime_text .= "[".$tagvalue."]";
          }
        }
      }
    }

    $anime_text .= "
        </p>
      </div>";
    }
  }

  $anime_text .= "
    </div>";

}

echo($anime_text);

include("otak_footer.php");
?>