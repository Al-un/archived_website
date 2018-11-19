<?php
  include('../tools/header.php');  
  $storyID = get('story');
?>

<h2> Anecdotes - Une en d&eacute;tail </h2>

<!-- // ===================================== ANY COMMENT SUBMITTED? ============================ // -->

<?php
  if (isset($_POST['submit_comment'])) {
      
      $author = get('author');
      $comment = get('comment');
      $storyID = get('storyidcomm');
      sql_query("INSERT INTO `$SQL_DATABASE`.`$table_HK_StoryComm` VALUES (NULL, '$storyID', '$author', '$comment', NULL)");
      
      
      $message = "
$author a posté : 

---------------------------------------------    
$comment
---------------------------------------------";
      
      
      sendMail(" Hong Kong - Stories Comment", $message, "[Xsylum.free-h.net]");
      
  }
?>

<!-- // ===================================== ONLY ONE STORY =================================== // -->

<?php 
  // ------------------- THE SO-CALLED STORY -------------------- //
  $zeStoryRaw = sql_assoc("
      SELECT `Id_StoryItem`, `Name_Title`, `Txt_content`, `Update_date`, `Cate%Name`
      FROM `$SQL_DATABASE`.`$table_HK_StoryItem`,`$SQL_DATABASE`.`$table_HK_StoryCate`
      WHERE `$table_HK_StoryItem`.`id_StoryCate` = `$table_HK_StoryCate`.`Id_StoryCate`
      AND `Id_StoryItem`='$storyID'");
      
  $storyTitle     = $zeStoryRaw['Name_Title'];
  $storyContent   = $zeStoryRaw['Txt_content'];
  $storyDateTime  = $zeStoryRaw['Update_date'];    
  
  // ------------------- any photo with the story ? ---- //
  $allPhotoRaw = sql_query("
      SELECT `UrlImgHK_Photo`,`Title` FROM `$SQL_DATABASE`.`$table_HK_StoryPhoto` WHERE `id_StoryItem`='$storyID' 
  ");
  
  
  
  // ----------------------- RELATED COMMENTS? ------------------ //
  $allCommentsRaw = sql_query("
      SELECT `Author`, `Txt_Comment`, `Update_Date` 
      FROM `$SQL_DATABASE`.`$table_HK_StoryComm`
      WHERE `id_StoryItem`='$storyID'");
  
  $allComments = "";
  
  while ($aComment = mysql_fetch_assoc($allCommentsRaw)) {
    $allComments .= 
      "<div class = 'comment'>
        <p class = 'author'>By : -- ".$aComment['Author']." --</p>
        <p class = 'comment'>".$aComment['Txt_Comment']."</p>
        <p class = 'date'>written on ".$aComment['Update_Date']."</p>
      </div>";
  }
  
  // ---------------------- POSTING A COMMENT ??? ---------------- //
  $commentForm = "";
  
  if (isset($_GET['action']) && $_GET['action'] == "addcomment") {
    $commentForm = "
  <div class = 'form'>
  <form method = 'post' action = 'ouf_detail.php?storyid=$storyID' > 
    
      <input type = 'hidden' name = 'storyidcomm' value = '$storyID' />
    
    <table>
      <tr>
        <td>Pseudo </td>
        <td> <input type = 'text' name = 'author' size = '50' maxlength = '50' /> </td>
      </tr>
      <tr> 
        <td> Commentaire </td>
        <td> <textarea name = 'comment' rows = '10' cols = '50' maxlength = '500'></textarea> </td>
      </tr>
      <tr>
        <td></td>
        <td> <input type = 'submit' name = 'submit_comment' value = 'Ajouter un commentaire' /> </td>
      </tr>
    </table>
  </form> 
  </div> 
    ";
  }
  
  // ------------------------- DISPLAY IT ! ---------------------- //    
  echo("
  <div class = 'story'>  
    <p class = 'title'> $storyTitle </p>
    <p class = 'content'> $storyContent </p>
    <p class = 'datecomment'> $storyDateTime </p>
    
    <ul style = 'list-style-type:none;'>");
        
  while ($photo = mysql_fetch_assoc($allPhotoRaw)){
    $photo_url = $photo['UrlImgHK_Photo'];
    echo("
      <li style = 'vertical-align:center;'>
        <a href = '$photo_url'><img src = '$photo_url' width = '50' /></a> ".$photo['Title']."
      </li>");
  }
        
  echo("
    </ul>
    
    
    
    <div id = 'comments'>
    <p> Commentaire(s): </p>
    
    $commentForm
    
    <a href='ouf_detail.php?story=$storyID&action=addcomment' class = 'comment'>Ajouter un commentaire</a><br />
    
    $allComments
    
    <a href='ouf_detail.php?story=$storyID&action=addcomment' class = 'comment'>Ajouter un commentaire</a>
     
     </div>
        
  </div>
  ");
  
?>

<!-- // ===================================== FOOTER =========================================== // -->
<?php
  include('../tools/footer.php');
?>