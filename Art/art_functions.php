<?php
/* FUNCTION LIST :
function Xsy_Art_GetAllDrawings()
function Xsy_Art_DisplayAllDrawings()
*/

// ====================================================================================
//          MANAGE item with and without properties
// ====================================================================================
function Xsy_Art_ManageItemProperties(){

  if(isset($_POST['Xsy_ArtProp_Added'])){
    Xsy_Sql_AddItemProperties();
  }

  Xsy_Art_GetAllItemProperties();
}




// ====================================================================================
//          Add properties to a or several art items
// ====================================================================================
function Xsy_Sql_AddItemProperties(){

  GLOBAL
    $SQL_DATABASE,
    $sqlTable_ArtItem,
    $sqlTable_ArtProp;

  $propAddArray = $_POST['artPropAdd'];
  foreach($propAddArray as $key=>$index){
 
    $entryAdded = array();
    $entryText  = "";

    $entryAdded['Id_ArtItem'] = $_POST['artId'][$index];
    $entryAdded['Id_Auth']    = $_POST['artAuth'][$index];
    $entryAdded['Txt_Size']   = Xsy_Glob_EscapeString($_POST['artSize'][$index], array("'"=>"''"));
    $entryAdded['Txt_Tools']  = Xsy_Glob_EscapeString($_POST['artTool'][$index], array("'"=>"''"));
    $entryText .= "ArtID ".$_POST['artId'][$index]." <br /> Auth : ".$_POST['artAuth'][$index]."<br /> Size : ".$_POST['artSize'][$index]."<br /> Tools ".$_POST['artTool'][$index]."<br />";
    $inserted = Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_ArtProp, $entryAdded);

    $updQuery = "UPDATE `$SQL_DATABASE`.`$sqlTable_ArtItem` SET `UpDT_Last%Update`=CURRENT_TIMESTAMP WHERE `ID_ArtItem`='".$_POST['artId'][$index]."'";
    $updstmp  = Xsy_Sql_Query($updQuery);
    if ($inserted){
      echo("<p style='color:green;'> Following entry is successfully inserted: <br /> $entryText ------------------------ </p>");

    }
    else{
      echo("<p style='color:red;'> Error when inserting following entry : <br /> $entryText </p>");

    }

  }
}



// ====================================================================================
//          GET ALL item with and without properties
// ====================================================================================
function Xsy_Art_GetAllItemProperties(){

  GLOBAL
    $SQL_DATABASE,
    $sqlTable_ArtItem,
    $sqlTable_ArtProp,
    $sqlTable_all_siteupd,
    $path_DrawingArt,
    $path_DrawingDesc,
    $path_DrawingOrig;

  // ------ Get data -------------------------------------
  $hasProp    = array();
  $noProp     = array();

  $query = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_ArtItem` ORDER BY `Dat_Date` DESC";
  $fetch = Xsy_Sql_FetchAll($query);

  // for each artitem
  foreach($fetch as $index=>$artArray){

    $itemId = $artArray['ID_ArtItem'];
    $check_query = "SELECT COUNT(*) FROM `$SQL_DATABASE`.`$sqlTable_ArtProp` WHERE `Id_ArtItem`='$itemId'";
    $check_fetch = Xsy_Sql_FetchAll($check_query);
    // item has properties
    if( $check_fetch[0]['COUNT(*)'] > 0){
      $prop_query = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_ArtProp` WHERE `Id_ArtItem`='$itemId'";
      $prop_fetch = Xsy_Sql_FetchAll($prop_query);
      $hasProp[$index]['ID']   = $artArray['ID_ArtItem'];
      $hasProp[$index]['Name'] = $artArray['Txt_Art%Name'];
      $hasProp[$index]['File'] = $artArray['Txt_File%Art'];
      $hasProp[$index]['Desc'] = $artArray['Txt_File%Desc'];
      $hasProp[$index]['Orig'] = $artArray['Txt_File%Orig'];
      $hasProp[$index]['Date'] = $artArray['Dat_Date'];
      $hasProp[$index]['Upd']  = $artArray['UpDT_Last%Update'];
      $hasProp[$index]['Size'] = $prop_fetch[0]['Txt_Size'];
      $hasProp[$index]['Tool'] = $prop_fetch[0]['Txt_Tools'];
      $hasProp[$index]['Auth'] = $prop_fetch[0]['Id_Auth'];
    }
    // no properties inserted
    else{
      $noProp[$index]['ID']   = $artArray['ID_ArtItem'];
      $noProp[$index]['Name'] = $artArray['Txt_Art%Name'];
      $noProp[$index]['File'] = $artArray['Txt_File%Art'];
      $noProp[$index]['Desc'] = $artArray['Txt_File%Desc'];
      $noProp[$index]['Orig'] = $artArray['Txt_File%Orig'];
      $noProp[$index]['Date'] = $artArray['Dat_Date'];
      $noProp[$index]['Upd']  = $artArray['UpDT_Last%Update'];
    }
  }

  // ------ Prepare data for display ----------------------
  $imgHeight    = "120px";
  $txtHasProp   = "  <table style='margin:2% auto; width:98%; border:2px solid cyan;background: black;'>
   <tr style='color: cyan;background: navy;'>
    <th> </th>
    <th> ID </th>
    <th> Art Name </th>
    <th> Art File </th>
    <th> Art Desc </th>
    <th> Art Orig </th>
    <th> Art Date </th>
    <th> Auth </th>
    <th> Size </th>
    <th> Tools </th>
    <th> Last Update </th>
   </tr>";
  $txtNoProp    = "  <form method='post' action=''>\n  <table style='margin:2% auto; width:98%; border:2px solid cyan;background: black;'>
   <tr style='color: cyan;background: navy;'>
    <th> </th>
    <th> ID </th>
    <th> Art Name </th>
    <th> Art File </th>
    <th> Art Desc </th>
    <th> Art Orig </th>
    <th> Art Date </th>
    <th> Auth </th>
    <th> Size </th>
    <th> Tools </th>
    <th> Last Update </th>
   </tr>";

  foreach($hasProp as $index=>$artArray){

    $artImg  = $artArray['File']!=="" ? "<a href='".$path_DrawingArt.$artArray['File']."' style='display:block; text-align:center;'> <img src='".$path_DrawingArt.$artArray['File']."' title='".$artArray['Name']."' style='height:".$imgHeight."'/></a>" : "";
    $origImg = $artArray['Orig']!=="" ? "<a href='".$path_DrawingOrig.$artArray['Orig']."' style='display:block; text-align:center;'> <img src='".$path_DrawingOrig.$artArray['Orig']."' title='".$artArray['Name']." - original' style='height:".$imgHeight."'/></a>" : "";

    $txtHasProp .= "   <tr style=''>
    <td> </td>
    <td> ".$artArray['ID']." </td>
    <td> ".$artArray['Name']." </td>
    <td> ".$artImg." </td>
    <td> <a href='".$path_DrawingDesc.$artArray['Desc']."'> ".$artArray['Desc']." </a> </td>
    <td> ".$origImg." </td>
    <td> ".$artArray['Date']." </td>
    <td> ".$artArray['Auth']." </td>
    <td> ".$artArray['Size']." </td>
    <td> ".$artArray['Tool']." </td>
    <td> ".$artArray['Upd']." </td>
   </tr>\n";
  }

  $artCount = 0;
  foreach($noProp as $index=>$artArray){

    $artImg  = $artArray['File']!=="" ? "<a href='".$path_DrawingArt.$artArray['File']."' style='display:block; text-align:center;'> <img src='".$path_DrawingArt.$artArray['File']."' title='".$artArray['Name']."' style='height:".$imgHeight."' /></a>" : "";
    $origImg = $artArray['Orig']!=="" ? "<a href='".$path_DrawingOrig.$artArray['Orig']."' style='display:block; text-align:center;'> <img src='".$path_DrawingOrig.$artArray['Orig']."' title='".$artArray['Name']." - original' style='height:".$imgHeight."' /></a>" : "";

    $txtNoProp .= "   <tr style=''>
    <td> <input type='checkbox' name='artPropAdd[]' value='".$artCount."' class='fileCheckbox' />  </td>
    <td style='width:1%;'> <input type='text' name='artId[]' value='".$artArray['ID']."' style='width:100%;' readonly /> </td>
    <td> ".$artArray['Name']." </td>
    <td> ".$artImg." </td>
    <td> <a href='".$path_DrawingDesc.$artArray['Desc']."'> ".$artArray['Desc']." </a> </td>
    <td> ".$origImg." </td>
    <td> ".$artArray['Date']." </td>
    <td> <input type='number' name='artAuth[]' value='1' /> </td>
    <td> <input type='text' name='artSize[]' value='A4' /> </td>
    <td> <input type='text' name='artTool[]' value='' /> </td>
    <td> ".$artArray['Upd']." </td>
   </tr>\n";
    $artCount++;
  }

  $txtNoProp .= "  <tr> <td colspan='11' style='text-align:center;padding:15px 0px;'> <input type='submit' name='Xsy_ArtProp_Added' value='Add Art Properties and send it to newsletters' style='width:80%;background:navy;color:cyan;border:2px outset cyan;' /> </td> </tr>
  </table>
  </form>";
  $txtHasProp .= "  </table>";
  echo($txtNoProp);
  echo($txtHasProp);
// !!!!!!!!!!!!!!!!!!!!!! NEWSLETTER

}
// ------------------------------------------------------------------------------------







// ====================================================================================
//          GET ALL DRAWINGS
// ====================================================================================
function Xsy_Art_GetAllDrawings(){

  GLOBAL
    $SQL_DATABASE,
    $sqlTable_ArtItem,
    $sqlTable_ArtTag,
    $sqlTable_ArtItemTag,
    $sqlTable_ArtTranslate,
    $sqlTable_ArtComment,
    $sqlTable_ArtProp,
    $sqlTable_all_users;

  $artData  = array();

  // -- check if any art exists
  $check_query  = "    SELECT COUNT(*)
    FROM `$SQL_DATABASE`.`$sqlTable_ArtItem`, `$SQL_DATABASE`.`$sqlTable_ArtProp`
    WHERE `$sqlTable_ArtProp`.`Id_Auth` <= ".$_SESSION['UserLevel']." 
    AND `$sqlTable_ArtProp`.`Id_ArtItem` = `$sqlTable_ArtItem`.`ID_ArtItem`";
  $check_fetch  = Xsy_Sql_FetchAll($check_query);
  $check_count  = $check_fetch[0]['COUNT(*)'];


  // yes there is at least an art. If there isn't any art, the artData array 
  // will be empty : count($artData) = 0;
  if ($check_count > 0){

    $art_query  = "
    SELECT
      `$sqlTable_ArtItem`.`ID_ArtItem`,
      `$sqlTable_ArtItem`.`Txt_Art%Name`,
      `$sqlTable_ArtItem`.`Txt_File%Art`,
      `$sqlTable_ArtItem`.`Txt_File%Desc`,
      `$sqlTable_ArtItem`.`Txt_File%Orig`,
      `$sqlTable_ArtItem`.`Dat_Date`,
      `$sqlTable_ArtItem`.`UpDT_Last%Update`,
      `$sqlTable_ArtProp`.`Txt_Size`,
      `$sqlTable_ArtProp`.`Txt_Tools`
    FROM
      `$SQL_DATABASE`.`$sqlTable_ArtItem`,
      `$SQL_DATABASE`.`$sqlTable_ArtProp`
    WHERE
      `$sqlTable_ArtProp`.`Id_Auth` <= ".$_SESSION['UserLevel']." AND
      `$sqlTable_ArtProp`.`Id_ArtItem` = `$sqlTable_ArtItem`.`ID_ArtItem`
    ORDER BY `Dat_Date` DESC";
    $art_fetch  = Xsy_Sql_FetchAll($art_query);

    // foreach art
    foreach($art_fetch as $key=>$itemArray){

      // art properties
      $itemId                       = $itemArray['ID_ArtItem'];
      $artData[$itemId]['Name']     = $itemArray['Txt_Art%Name'];
      $artData[$itemId]['FileArt']  = $itemArray['Txt_File%Art'];
      $artData[$itemId]['FileDesc'] = $itemArray['Txt_File%Desc'];
      $artData[$itemId]['FileOrig'] = $itemArray['Txt_File%Orig'];
      $artData[$itemId]['Date']     = $itemArray['Dat_Date'];
      $artData[$itemId]['Update']   = $itemArray['UpDT_Last%Update'];
      $artData[$itemId]['Size']     = $itemArray['Txt_Size'];
      $artData[$itemId]['Tools']    = $itemArray['Txt_Tools'];

      // art tags
      $tag_query = "SELECT COUNT(*) FROM `$SQL_DATABASE`.`$sqlTable_ArtItemTag`, `$SQL_DATABASE`.`$sqlTable_ArtTag`
                    WHERE `$sqlTable_ArtItemTag`.`Id_ArtTag` = `$sqlTable_ArtTag`.`ID_ArtTag` AND `$sqlTable_ArtItemTag`.`Id_ArtItem` = '".$itemId."'";
      $tag_check = Xsy_Sql_FetchAll($tag_query);
      // if, of course, there is any tag, look for them
      if ($tag_check[0]['COUNT(*)'] > 0){
        $tag_query = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_ArtItemTag`, `$SQL_DATABASE`.`$sqlTable_ArtTag`
                      WHERE `$sqlTable_ArtItemTag`.`Id_ArtTag` = `$sqlTable_ArtTag`.`ID_ArtTag` AND `$sqlTable_ArtItemTag`.`Id_ArtItem` = '".$itemId."'";
        $tag_fetch = Xsy_Sql_FetchAll($tag_query);
        foreach($tag_fetch as $key=>$tagArray){
          $artData[$itemId]['Tag'][$tagArray['ID_ArtItemTag']]['Name'] = $tagArray['Txt_Tag%Name'];
          $artData[$itemId]['Tag'][$tagArray['ID_ArtItemTag']]['Cate'] = $tagArray['Txt_Tag%Category'];
        }
      }

      // art comment
      $comm_query = "SELECT COUNT(*) FROM `$SQL_DATABASE`.`$sqlTable_ArtComment`, `$SQL_DATABASE`.`$sqlTable_all_users`
                    WHERE `$sqlTable_all_users`.`ID_User` = `$sqlTable_ArtComment`.`Id_user` AND `$sqlTable_ArtComment`.`Id_ArtItem` = '".$itemId."'";
      $comm_check = Xsy_Sql_FetchAll($comm_query);
      // if, of course, there is any comment, look for them
      if ($comm_check[0]['COUNT(*)'] > 0){
        $comm_query = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_ArtComment`, `$SQL_DATABASE`.`$sqlTable_all_users`
                      WHERE `$sqlTable_all_users`.`ID_User` = `$sqlTable_ArtComment`.`Id_user` AND `$sqlTable_ArtComment`.`Id_ArtItem` = '".$itemId."'";
        $comm_fetch = Xsy_Sql_FetchAll($comm_query);
        foreach($comm_fetch as $key=>$commArray){
          $artData[$itemId]['Comm'][$commArray['ID_ArtComm']]['UserName'] = $commArray['Txt_User%Name'];
          $artData[$itemId]['Comm'][$commArray['ID_ArtComm']]['Title']    = $commArray['Txt_Comm%Name'];
          $artData[$itemId]['Comm'][$commArray['ID_ArtComm']]['Comment']  = $commArray['Text_Comment'];
          $artData[$itemId]['Comm'][$commArray['ID_ArtComm']]['DateTime'] = $commArray['UpDT_Comm%Date'];
        }
      }

    }
  }

  return $artData;
}
// ------------------------------------------------------------------------------------






// ====================================================================================
//          DISPLAY ALL DRAWINGS
// ====================================================================================
function Xsy_Art_DisplayAllDrawings(){

  GLOBAL
    $SQL_DATABASE,
    $sqlTable_ArtItem,
    $path_DrawingArt,
    $path_DrawingDesc,
    $path_DrawingOrig,
    $nb_img_row;

  $artData = Xsy_Art_GetAllDrawings();

  // check if there is any art
  if (count($artData)>0){

    $rightDiv     = " <div id='GoToRight'>\n";
    $leftDiv      = " <div id='GoToLeft'>\n";
    $centralDiv   = "";

    $artProp      = "  <div id='ArtProp' class='ArtContainer'>\n    <p id='ArtProp_Title' class='ContainerTitle'> Some infos </p>
    <div id='ArtPropArea-1' class='ArtPropArea'>
      <div> <p class='ArtPropTitle'> Art Status : </p> <p style='color:green'> Loaded </p> </div>
    </div>\n";
    $artList      = "  <div id='ArtList' class='ArtContainer'>\n   <p id='ArtList_Title' class='ContainerTitle'> All arts sorted by date </p>\n   <div id='ArtList_ForScroll'>\n";
    $artArea      = "  <div id='ArtArea' class='ArtContainer'>\n  <p id='ArtArea_Title' class='ContainerTitle'> Artwork </p>
    <div id='ArtArea-1' class='ArtArea'>
      <p> <i style='color:green;'> Art loading is finished. Select an artwork to display tags.</i> </p>
    </div>\n";
    $artDesc      = "  <div id='ArtDesc' class='ArtContainer'>\n  <p id='ArtDesc_Title' class='ContainerTitle'> Description </p>
    <div id='ArtDescArea-1' class='ArtDescArea'>
      <p> <i style='color:green;'> Description are ready !</i> </p>
    </div>\n";
    $artTag       = "  <div id='ArtTag' class='ArtContainer'>\n  <p id='ArtTag_Title' class='ContainerTitle'> Art tags </p>
    <div id='ArtTagArea-1' class='ArtTagArea'>
      <p> <i style='color:green;'>Tag loading is finished.</i> </p>
    </div>\n";
    $artSocMedia  = "   <div id='ArtSocMedia' class='ArtContainer'>\n    <p id='ArtSocMedia_Title' class='ContainerTitle'> Social Media </p>
    <div id='ArtSocMedia-1' class='ArtSocMedia'>
      <p> <i style='color:green;'> Select an art to like it.</i> </p>
    </div>\n";
    $art_count    = 0;
    $art_row_ind  = 0; // count from 0 so values are 0, 1, 2 ... $nb_img_row-1
    $current_year = 0;
    $current_date = NULL;
    $last_update  = NULL;
    $year_changed = FALSE;
    $permaId      = -1;

    // direct link to picture
    if(isset($_GET['Art_PermaLink'])){
      $permaName  = Xsy_Glob_Get('Art_PermaLink');
      $permaQuery = "SELECT COUNT(*),`ID_ArtItem` FROM `$SQL_DATABASE`.`$sqlTable_ArtItem` WHERE SHA1(`Txt_Art%Name`)='".$permaName."'";
      $permaFetch = Xsy_Sql_FetchAll($permaQuery);
      $permaId    = ($permaFetch[0]['COUNT(*)'] > 0) ? $permaFetch[0]['ID_ArtItem'] : (-1);
    }
    echo("<div id='Art_PermaLink' style='display:none;'>$permaId</div>\n");

    // list all art
    foreach($artData as $artId=>$artArray){

      $current_date = new DateTime($artArray['Date']);
      $last_update  = new DateTime($artArray['Update']);
      $permaLink    = $_SERVER['PHP_SELF']."?Art_PermaLink=".sha1($artArray['Name']);
      list($width, $height) = getimagesize($path_DrawingArt.$artArray['FileArt']);

      // art properties go to the right
      $artProp .= "   <div id='ArtPropArea".$artId."' class='ArtPropArea'>
      <div> <p class='ArtPropTitle'> Art Name : </p> <p>".$artArray['Name']." </p> </div>
      <div> <p class='ArtPropTitle'> Art Date : </p> <p>".$current_date->format("d M Y")." </p> </div>
      <div> <p class='ArtPropTitle'> Last Modification : </p> <p>".$last_update->format("d M Y")." </p> </div>
      <div> <p class='ArtPropTitle'> Size : </p> <p>".$artArray['Size']." </p> </div>
      <div> <p class='ArtPropTitle'> Used tools : </p>  <p>".$artArray['Tools']." </p> </div>
      <div> <p class='ArtPropTitle'> PermaLink : </p> <p><a href='".$permaLink."'> Permanent Link </a> </p> </div>
   </div>\n";

      // get the summary on the left
      if($current_date->format("Y")!==$current_year){

        $current_year = $current_date->format("Y");
        // previous row is not finished yet but this isn't the first item, and this
        // is not a first item of a new row
        // $artList     .= ( ($art_count > 0) AND ($art_count % $nb_img_row!==($nb_img_row-1)) ) ? "    </div>\n" : "";
        $artList     .= ( ($art_count > 0) AND ($art_row_ind !== 0) ) ? "    </div>\n" : "";
        $artList     .= "    <p class='ArtList_Year'> - ".$current_year." - </p>\n";
        $artList     .= "    <div class='ArtList_Row'>\n";
        $year_changed = TRUE;
        $art_row_ind = 0;
      }
      // elseif( $art_row_ind % $nb_img_row== 0 ){
      elseif( $art_row_ind == 0 ){
        $artList .= "\n    <div class='ArtList_Row'>\n";
      }
      
      $artList .= "      <div class='ArtList_Container' id='ArtList_Container".$artId."'>
          <img src='".Xsy_Glob_EscapeString($path_DrawingArt.$artArray['FileArt'], array("'"=>"&#39;"))."'
              title='Art List - ".Xsy_Glob_EscapeString($artArray['Name'], array("'"=>"&#39;"))."'
              alt='".Xsy_Glob_EscapeString($artArray['Name'], array("'"=>"&#39;"))."'
              style='width:".$width."px;height:".$height."px;'
              id='OpenArt".$artId."' />
      </div>\n";
      // if( $art_row_ind % $nb_img_row==($nb_img_row-1) ){
      if( $art_row_ind ==($nb_img_row-1) ){
        $artList .= "\n    </div> <!-- end of ArtList_Row -->\n";
      }


      // any comment in it ?
      // if (isset($artArray['Comm'])){
        // $leftDiv .= "  <div id='ArtCommArea".$artId."' class='ArtCommArea'>\n";
        // foreach($artArray['Comm'] as $commId=>$commArray){
          // $leftDiv .= "    <div id='ArtComm".$commId."'>\n      <p> ".$commArray['Title']." </p>\n      <p> ".$commArray['DateTime']." </p>\n      <div> ".$commArray['Comment']." </div>\n    </div>";
        // }
        // $leftDiv .= "  </div>";
      // }


      // any tag in it ?
      $artTag .= "  <div id='ArtTagArea".$artId."' class='ArtTagArea'>\n";
      if (isset($artArray['Tag'])){
        foreach($artArray['Tag'] as $tagId=>$tagArray){
          $artTag .= "    <p id='ArtTag".$tagId."' style='margin:5px;'> ".$tagArray['Cate']." > ".$tagArray['Name']." </p>\n";
        }
      }
      else{
        $artTag .= "    <div>\n      <p> There is no tag for this artwork </p>\n    </div>";
      }
      $artTag .= "\n  </div>\n";


      // add Social Medial button
      $artSocMedia .= "  <div id='ArtSocMedia".$artId."' class='ArtSocMedia'>
    <div class='fb-share-button' data-href='$permaLink' data-layout='button'></div>
  </div>\n";


      // some description ?
      $artDesc .= "  <div id='ArtDescArea".$artId."' class='ArtDescArea'>\n";
      if (isset($artArray['FileDesc']) AND $artArray['FileDesc']!==""){
        $path_parts     = pathinfo($path_DrawingDesc.$artArray['FileDesc']);
        switch($path_parts['extension']){
          case "txt"  : 
          case "htm"  : 
          case "html" : $artDesc .= file_get_contents($path_DrawingDesc.$artArray['FileDesc']); break;
          case "php"  : include($path_DrawingDesc.$artArray['FileDesc']); $artDesc .= (isset($description)) ? $description : "" ; break;
          default     : 
        }
        
      }
      else{
        $artDesc .= "    <p> There is no description for this artwork </p>\n";
      }
      $artDesc .= "\n  </div>\n";


      // now art pic
      $artArea .= "  <div id='ArtArea".$artId."' class='ArtArea'>
      <img
      src='".Xsy_Glob_EscapeString($path_DrawingArt.$artArray['FileArt'], array("'"=>"&#39;"))."'
      title='".Xsy_Glob_EscapeString($artArray['Name'], array("'"=>"&#39;"))."'
      alt='".Xsy_Glob_EscapeString($artArray['Name'], array("'"=>"&#39;"))."'
      style='width:".$width."px;height:".$height."px;'
      id='ArtArea_Image".$artId."'
      class='ArtArea_Image' />\n";
      // insert original if any
      if(isset($artArray['FileOrig']) AND $artArray['FileOrig']!==""){
        $artArea .= "
      <img
      src='".Xsy_Glob_EscapeString($path_DrawingOrig.$artArray['FileOrig'], array("'"=>"&#39;"))."' 
      title='".Xsy_Glob_EscapeString($artArray['Name'], array("'"=>"&#39;"))." - Original'
      alt='[Original Artwork]'
      class='ArtArea_Hidden'/>\n";
      }
      $artArea .= "\n  </div>\n";


      $art_count++;
      $art_row_ind = ($art_row_ind+1) % $nb_img_row;
    }


    // finish, ensure that div are properly close
    // if($art_count % $nb_img_row!==($nb_img_row-1) ){
    if($art_count !==($nb_img_row-1) ){
      $artList .= "    </div> <!-- Last ArtList_Container -->\n"; // last ArtList_Container
    }

    $artProp    .= "  </div>\n";
    $artList    .= "    </div>\n   </div> <!-- Close id='ArtList'-->\n"; // close id='ArtList'
    $artArea    .= "    </div>\n";
    $artDesc    .= "    </div>\n";
    $artTag     .= "    </div>\n";

    $leftDiv    .= $artProp;
    $leftDiv    .= "<br />".$artTag;
    // $leftDiv    .= "  <br />".$artSocMedia."\n  </div>\n";
    $leftDiv    .= "  </div>\n";
    $rightDiv   .= $artList."  </div>\n";
    $centralDiv .= $artArea;
    $centralDiv .= $artDesc;
    echo($centralDiv);
    echo($leftDiv);
    echo($rightDiv);
  }

  else{
    echo("<p> no art </p>");
  }
}
// ------------------------------------------------------------------------------------






// ====================================================================================
//          DISPLAY ALL MISCELLANEOUS 
// ====================================================================================
function Xsy_Art_DisplayDivers(){

  // about panel
  $artAbout = "  <div id='ArtAbout'> 

  </div>\n";

  // newsletter to move to left side ?
  $artNewsletter = "  <div id='ArtNewsletter'> 

  </div>\n";

  // Contact panel
  $artContact = "  <div id='ArtContact'> 

  </div>\n";

  // external Link
  $artLink = "  <div id='ArtLink'> 

  </div>\n";


}
?>