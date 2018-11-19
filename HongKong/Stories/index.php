<?php
  include('../tools/header.php');
?>

<h2>Anecdotes - Index</h2>

<p>Voil&agrave; ma page des anecdotes, celle que je vais "essayer" de plus tenir &agrave; jour. Parmi ces anecdotes, ce sont des faits que me font dire "oh lala! Truc de ouf !!!!" ou bien alors "Y sont vraiment cingl&eacute;s par ici..." et des autres r&eacute;actions diverses et vari&eacute;es...parfois tr&egrave;s surprenants quoi!</p> 

<!-- // ===================================== DISPLAY ALL STORIES =========================== // -->

<!--<p> Les 5 derniers posts: </p> -->

<?php
/*
  $allStoriesRaw = sql_query("
      SELECT id_oufitem, title
      FROM `$SQL_DATABASE`.`$$talbe_HK_StoryItem` 
      ORDER BY datetime DESC
      LIMIT 0, 5");
  
  while ($aStory = mysql_fetch_assoc($allStoriesRaw)) {
      
      $storyID = $aStory['id_oufitem'];
      
      $alltagsRaw = sql_query("
      SELECT name 
      FROM `$SQL_DATABASE`.`$table_OufItemCate`,`$SQL_DATABASE`.`$table_OufCate`
      WHERE `id_oufitem`='".$aStory['id_oufitem']."'
      AND `$table_OufCate`.`id_oufcategorie`=`$table_OufItemCate`.`id_oufcategorie`");
      
      $alltags = "Tags: -";
      while($tag = mysql_fetch_assoc($alltagsRaw)) {
          $zetag = $tag['name'];
          $alltags .= "<a href = 'ouf_display.php?tag=$zetag'> $zetag </a>-";
      }
      
      echo("
  <div class = 'story'>
    <p class = 'title'>
      <a href = 'ouf_detail.php?storyid=$storyID'>".$aStory['title']."</a>");
      
      if ($_SESSION['userlevel'] >= 3) { echo("
      <a href = 'ouf_display.php?deleteid=$storyID'>
        <img src = '/HongKong/resources/delete.png' title = 'delete' alt = 'delete' width ='15' height = '15' />
      </a>
      ");}
      
      echo("
    </p>
    <p class = 'tag'>
      $alltags
    </p>
  </div>    
      ");
      
  }
*/
?>


<?php
  include('../tools/footer.php');
?>