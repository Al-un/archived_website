<?php
  include('../tools/header.php');

  $pageNumber = (get('storyPage')) ? get('storyPage') : 0;

  $nbStoryPerPage = 10;
  $firstStory = $pageNumber*$nbStoryPerPage;
  
?>

<h2> Les Anecdotes </h2>

<!-- // ===================================== DISPLAY ALL STORIES =========================== // -->

<?php
  $allStoriesRaw = sql_query("
      SELECT `Id_StoryItem`, `Name_Title`, `Txt_content`, `Update_date`, `Cate%Name`
      FROM `$SQL_DATABASE`.`$table_HK_StoryItem`,`$SQL_DATABASE`.`$table_HK_StoryCate`
      WHERE `$table_HK_StoryItem`.`id_StoryCate` = `$table_HK_StoryCate`.`Id_StoryCate`
      ORDER BY `$table_HK_StoryItem`.`Update_date` DESC
      LIMIT $firstStory, $nbStoryPerPage");
  
  /*
  echo("
      SELECT `Id_StoryItem`, `Name_Title`, `Txt_content`, `Update_date`, `Cate%Name`
      FROM `$SQL_DATABASE`.`$table_HK_StoryItem`,`$SQL_DATABASE`.`$table_HK_StoryCate`
      WHERE `$table_HK_StoryItem`.`id_StoryCate` = `$table_HK_StoryCate`.`Id_StoryCate`
      ORDER BY `$table_HK_StoryItem`.`Update_date` DESC
      LIMIT $firstStory, $nbStoryPerPage");
  */
  
  while ($aStory = mysql_fetch_assoc($allStoriesRaw)) {
      
      $storyID = $aStory['Id_StoryItem'];
      
      
      // ------------------- any comment? ----------------- //
      $commentCountRaw = sql_assoc("
        SELECT COUNT(id_StoryItem) FROM `$SQL_DATABASE`.`$table_HK_StoryComm` WHERE `id_StoryItem`='$storyID' 
      ");
      $commentCount = $commentCountRaw['COUNT(id_StoryItem)'];
    
      // ------------------- any photo with the story ? ---- //
      $allPhotoRaw = sql_query("
        SELECT `UrlImgHK_Photo`,`Title` FROM `$SQL_DATABASE`.`$table_HK_StoryPhoto` WHERE `id_StoryItem`='$storyID' 
      ");
      
      
      // ----------------- the result --------------------//
      echo("
      <div class = 'story'>
      <p class = 'title'>
        <a href = 'ouf_detail.php?story=$storyID'>".$aStory['Name_Title']."</a>
      </p>
      
        <p class = 'content'>".$aStory['Txt_content']."</p>
        
        <ul style = 'list-style-type:none;'>");
        
      while ($photo = mysql_fetch_assoc($allPhotoRaw)){
        $photo_url = $photo['UrlImgHK_Photo'];
        echo("
        <li style = 'vertical-align:center;'>
          <a href = '$photo_url'><img src = '$photo_url' width = '50' /></a> ".$photo['Title']."
        </li>
        ");
      }
        
      echo("
        </ul>
      
        <p class = 'tag'> (no tag) in ".$aStory['Cate%Name']." </p>
        <p class = 'datecomment'>".
            $aStory['Update_date']." - 
            <a href = 'ouf_detail.php?story=$storyID#comments'> $commentCount commentaire(s) </a> - 
            <a href = 'ouf_detail.php?story=$storyID&action=addcomment'>ajouter un commentaire</a>
        </p>
      </div>    
      ");
      
  }
?>

<!-- // ===================================== FOOTER =========================================== // -->
<?php
  include('../tools/footer.php');
?>