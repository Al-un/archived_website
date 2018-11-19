<?php
  // ###############################################################
  // Some methods to provide a simplified code?
  //  - Xsy_Glob_AuthCheck($minisiteName, $userRequiredAuth)
  //  - Xsy_Glob_LangPanel($minisiteName)
  //  - Xsy_Glob_AddLinkToUrl($text)
  //  - Xsy_Glob_Mail()
  //  - Xsy_Glob_Get($champ)
  //  - Xsy_Glob_EditFilesContent($folderPath)
  //  - Xsy_Glob_EditMultipleFolder($folderArray)
  //  - Xsy_Glob_EscapeString($string, $escapeArray=NULL)
  // ###############################################################




/* *****************************************************************************************************
 * check if user is authorized to display webpage
 * TEST CASES:
 *  1. Global Admin has all access (online and offline)
 *  2. Default user is restricted (online only)
 *  3. Normal users are restricted to their allowed site (online only)
 *  4. Normal users can access offline site if direct assignment is admin level
 *  5. 
 * ****************************************************************************************************/
function Xsy_Glob_AuthCheck($minisiteName, $userRequiredAuth){

  $wrongSite = "";
  switch($_SESSION['UserLang']){
    case "Fr"   : $wrongSite = "Ce site n'est plus disponible. Vous n'y avez donc plus acc&egrave;s. Le nouvel site se trouve par l&agrave; : <a href='http://xsylum.fr'> xsylum.fr </a>. &Agrave; tout de suite !"; break;
    case "En"   : $wrongSite = "This website is not available anymore. Hence missing authorization. The new website is over there : <a href='http://xsylum.fr'> xsylum.fr </a>. See you soon then !"; break;
    case "ZhTr" : $wrongSite = ""; break;
    case "Jp"   : $wrongSite = ""; break;
  }

  if($_SERVER['HTTP_HOST']=="xsylum.free-h" AND !$_SESSION['UserAdmin']){
    echo("  <div style='background:rgba(0, 0, 0, 0.8); width:100%; height: 100%; position: fixed;'>
    <div style='background:#999999; color:darkred; border:4px outset darkred; width:80%; margin:auto; position: fixed; top: 40%; left: 10%;'>
      <p> ".$wrongSite." </p>
    </div>
  </div>");
  }


  GLOBAL $SQL_DATABASE, $sqlTable_all_siteuser, $sqlTable_all_users, $sqlTable_all_minisites, $XSY_GLOB_DEFAULTUSERID, $XSY_SESS_NO_AUTH_ERRORTXT, $XSY_SESS_NORMALLEVEL, $XSY_SESS_ADMINLEVEL;
  $userGlobalAuth = 0;
  $userDirectAuth = 0;

  // Retrieve minisite Id
  $queryMinisite = "SELECT COUNT(*),`ID_Minisite`,`Bool_Visible` FROM `$SQL_DATABASE`.`$sqlTable_all_minisites` WHERE `Txt_Site%Name`='$minisiteName'";
  $fetchMinisite = Xsy_Sql_FetchAll($queryMinisite);
  $hasResult     = $fetchMinisite[0]['COUNT(*)'] > 0;
  $minisiteId    = $fetchMinisite[0]['ID_Minisite'];
  $minisiteVisib = $fetchMinisite[0]['Bool_Visible'];   // visibility == 0 or 1
  if(!$hasResult){
    echo("<p> Site name (".$minisiteName.")is not found ! </p>");
    return FALSE;
  }

  // Retrieve global user auth
  $queryAuth = "SELECT `Id_Auth` FROM `$SQL_DATABASE`.`$sqlTable_all_users` WHERE `ID_User`='".$_SESSION['UserId']."'";
  $fetchAuth = Xsy_Sql_FetchAll($queryAuth);
  $userGlobalAuth = $fetchAuth[0]['Id_Auth'];
 
  // Retrieve direct assignment for this user/minisite
  $queryCheckAuth = "SELECT COUNT(*), `Id_Auth` FROM `$SQL_DATABASE`.`$sqlTable_all_siteuser` WHERE (`Id_Minisite`='$minisiteId' AND `Id_User`='".$_SESSION['UserId']."') OR (`Id_Minisite`='$minisiteId' AND `Id_User`='$XSY_GLOB_DEFAULTUSERID') ";
  $stmt_checkAuth = Xsy_Sql_Query($queryCheckAuth);
  $fetchedCheck   = Xsy_Sql_FetchAll($queryCheckAuth);
  if($fetchedCheck[0]['COUNT(*)'] > 0){
    // take the highest level
    foreach($fetchedCheck as $checkId => $checkLevel){
      $userDirectAuth = ($checkLevel['Id_Auth'] > $userDirectAuth) ? $checkLevel['Id_Auth'] : $userDirectAuth;
    }
  }



  // check if site is online or offline. If site is offline, only admin (global or direct assignment) can access to it.
  if($minisiteVisib == 0){
    // global admin
    if ( ($userGlobalAuth == $XSY_SESS_ADMINLEVEL)){
      $_SESSION['UserLevel'] = $userGlobalAuth;
      return TRUE;
    }
    // direct assignment
    elseif( ($userDirectAuth == $XSY_SESS_ADMINLEVEL)){
      $_SESSION['UserLevel'] = $userDirectAuth;
      return TRUE;
    }
    else{
      echo("<p> Site is offline. Please come back when it will turn online. Sorry for the inconvenience. </p>");
      return FALSE;
    }
  }
  
  // global user auth is enough
  if ($userGlobalAuth >= $userRequiredAuth){
    return TRUE;
  }

  // check if direct assignment is given or if default user is authorized to access it
  elseif ($userDirectAuth >= $userRequiredAuth){
    return TRUE;
  }
  else{
     $_SESSION['UserLevel'] = $XSY_SESS_NORMALLEVEL;
     return FALSE;
  }

  // defaultuser is authorized?


}



/* *****************************************************************************************************
 * return as String the language panel according to the available 
 * kanguages for each site.
 * Cases:
 *  - 0 Language => change nothing
 *  - 1 Language => force $_SESSION['UserLang'] to this language if not already set to this one
 *  - 1+ Language => change $_SESSION['UserLang'] if current one is not available and propose lang panel.
 * ****************************************************************************************************/
function Xsy_Glob_LangPanel($minisiteName){


  GLOBAL $SQL_DATABASE, $XSY_LANG, $sqlTable_all_minisites, $sqlTable_all_sitelang, $zToolsRoot;
  $langPanel = "";

  // querying
  $query    = "SELECT COUNT(*), `Id_Language` FROM `$SQL_DATABASE`.`$sqlTable_all_minisites`, `$SQL_DATABASE`.`$sqlTable_all_sitelang` WHERE `$sqlTable_all_minisites`.`ID_Minisite` = `$sqlTable_all_sitelang`.`Id_Minisite` AND `$sqlTable_all_minisites`.`Txt_Site%Name`='$minisiteName'";

  $raw      = Xsy_Sql_Query($query);
  $nb_lang  = 0;
  $allLang;

  // retrieving number of languages
  while($aResult = Xsy_Sql_Fetch($raw)){
    $nb_lang    = ( $nb_lang > $aResult['COUNT(*)'] ) ? $nb_lang : $aResult['COUNT(*)'];
    $allLang[]  = $aResult['Id_Language'];
  }
  
  // switch according to languages
  // no languages ???
  if ($nb_lang == 0){
    $langPanel = ($_SESSION['UserAdmin']) ? "  <p class='Xsy_Admin_CheckLanguage'><i>(no language)</i></p>\n" : "";
    return $langPanel;
  }
  
  // only one Language. Two cases : session lang is already set or not yet.
  elseif ($nb_lang == 1){
    // compare current session language with the only result
    if ( $_SESSION['UserLang']==$XSY_LANG[$allLang[0]]['Tag'] ){
      $langPanel =($_SESSION['UserAdmin']) ? "  <p class='Xsy_Admin_CheckLanguage'>(1 lang: already on it)</p>\n" : "";
      return $langPanel;
    }
    else{
      $_SESSION['UserLang'] = $XSY_LANG[$allLang[0]]['Tag'];
      $langPanel =($_SESSION['UserAdmin']) ? "  <p class='Xsy_Admin_CheckLanguage'>(Force change lang to ".$_SESSION['UserLang'].")</p>\n" : "";
      return $langPanel;
    }
  }
  
  // more than one language
  else{
  
    $query    = "SELECT `Id_Language` FROM `$SQL_DATABASE`.`$sqlTable_all_minisites`, `$SQL_DATABASE`.`$sqlTable_all_sitelang` WHERE `$sqlTable_all_minisites`.`ID_Minisite` = `$sqlTable_all_sitelang`.`Id_Minisite` AND `$sqlTable_all_minisites`.`Txt_Site%Name`='$minisiteName'";
    $allLang      = Xsy_Sql_FetchAll($query);
    $langIsActive = FALSE;
    $langPanel .= "   <form method='post' action=''>\n";

    foreach($allLang as $key=>$lang){
      // if current language is selected, no need to show it in the bar
      $langId = $lang['Id_Language'];
      if ( $_SESSION['UserLang'] == $XSY_LANG[$langId]['Tag'] ){
        $langIsActive = TRUE; // at least, one of languages is the current one.
      }
      else{
        // $langPanel .= "  <input name='UserLang' value='".$XSY_LANG[$langId]['Tag']."' type='image' src='".$zToolsRoot."/Ztools/pic/lang/".$XSY_LANG[$langId]['Flag']."' style='height:18px; width:30px' title='".$XSY_LANG[$langId]['Name']."' alt='".$XSY_LANG[$langId]['Name']."' />\n";
        // $langPanel .= "    <input name='UserLang' value='".$XSY_LANG[$langId]['Tag']."' type='submit' style='
        $langPanel .= "    <input name='UserLangId' value='".$langId."' type='submit' style='
            border    : none;
            width     : 30px;
            height    : 18px;
            font-size : 1px;
            margin    : 1px;
            background-image:url(".$zToolsRoot."/Ztools/pic/lang/".$XSY_LANG[$langId]['Flag'].");
            background-repeat:no-repeat;'/>\n";
      }
    }
    
    // if among all languages, the session language is not active, 
    // session language has to be forced to user default language. 
    // if still not available, it switch back to the first active language
    if (!$langIsActive){
      $_SESSION['UserLang']   = $XSY_LANG[$allLang[0]['Id_Language']]['Tag'];
      // $_SESSION['UserLangId'] = $XSY_LANG[$allLang[0]['Id_Language']];
    }
    
    $langPanel .= "   </form>\n";
    return $langPanel;
  }
}


/* *****************************************************************************************************
 * Given a text, all URL will be added a <a href=''> </a> tag. To
 * check if it is an URL, regex are used. only url starting with :
 *  - http://
 *  - https://
 *  - ftp://
 *  - ftp://
 *  - www.
 * will be recognized.
 *
 * -- taken from http://css-tricks.com/snippets/php/find-urls-in-text-make-links/
 * -- help found http://www.lephpfacile.com/manuel-php/reference.pcre.pattern.syntax.php
 * ****************************************************************************************************/
function Xsy_Glob_AddLinkToUrl($text){


  // $reg_exUrl  = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?/i";
  $reg_exUrl  = "/((http\:\/\/|https\:\/\/|ftp\:\/\/|ftps\:\/\/|www\.))[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?/i";
  $textLinked = "";
  $url        = array();
  $urlLinked  = array();
  // special characters found on comments http://php.net/manual/fr/function.preg-replace.php
  $specChar   = array("\\", "/", "^", ".", "$", "|", "(", ")", "[", "]", "*", "+", "?", "{", "}");
  $replChar   = array("\\\\", "\/", "\^", "\.", "\$", "\|", "\(", "\)", "\[", "\]", "\*", "\+", "\?", "\{", "\}");
  $urlCount   = 0;
  $urlLimit   = -1;
  // PREG_PATTERN_ORDER instead of PREG_SET_ORDER
  $offset     = 0;

  preg_match_all($reg_exUrl, $text, $url, PREG_PATTERN_ORDER, $offset);
  $urlCount   = count($url);

  if($urlCount > 0){
    // three index : [0]=>the full url array [1]=>the protocol array [2]=>any relevant argument array
    foreach($url[0] as $urlIndex=>$urlFound){
      // check if http:// is forgotten for a link. If yes, add a "http://"
      $urlValue = (substr($urlFound,0,3)=="www") ? "<a href='http://".$urlFound."'>".$urlFound."</a>" : "<a href='".$urlFound."'>".$urlFound."</a>" ;
      $urlLinked[$urlIndex] = $urlValue;
      $url[0][$urlIndex]    = "/".str_replace($specChar, $replChar, $url[0][$urlIndex])."/";
    }
    $textLinked =  preg_replace($url[0], $urlLinked, $text, $urlLimit, $count);
    return $textLinked;
  }
  else{
    // if no urls in the text just return the text
    return $text;
  }

}










/* *****************************************************************************************************
 * send an email to admin
 * ****************************************************************************************************/
function Xsy_Glob_Mail($subject, $message, $title, $dest = "", $from = "", $bcc = "", $replyTo = "") {

  $headers  = '';

  // Mail in HTML Format
  // $headers .= 'MIME-Version: 1.0' . "\r\n";
  // $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

  // Additionnal data
  $headers .= 'From: '.( ($from == "") ? $_SERVER['HTTP_HOST'] : $from )."\r\n";
  $headers .= ($bcc !== "") ? 'Bcc : '.$bcc.'\r\n' : "";
  $headers .= 'Reply_To: '.(( $replyTo == "") ? "" : $replyTo )."\r\n";
  $headers .= 'X-Mailer: PHP/'.phpversion()."\r\n";

  $dest    = ($dest == "") ? $_SESSION['adminmail'] : $dest;

  return mail($dest,'['.$title.'] '.$subject,$message,$headers);
}








/* *****************************************************************************************************
 * get function which receives data from a get method or post 
 * method in a form. moreover, only some special html char are
 * accepted. Other tags are deleted to prevent from php/html injection
 * but there is no anti sql injections methods.
 * @return the field data or "" if isset is false
 * ****************************************************************************************************/
function Xsy_Glob_Get($champ){
  
  // POST or GET method?
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $result = (isset($_POST[$champ])) ? $_POST[$champ] : "";
  }
  else if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $result = (isset($_GET[$champ])) ? $_GET[$champ] : "";
  }
  else{
    DIE('<b> Wrong Server Requst method for '.$champ.' : '.$_SERVER['REQUEST_METHOD'].'</b>');
  }

  $result = str_replace("'","''",$result);                    // pour enregistrer les apostrophes en SQL
  $result = strip_tags($result,"<b><u><i><a><br />");         // supprimer les tags HTML/PHP sauf les balises indiquées
  $result = htmlspecialchars($result);                        // pour encadrer les balises HTML par des doubles quotes
  $result = nl2br($result);                                   // pour marquer les retours à la ligne
  $result = str_replace("<br />","  <br />",$result);         // pour éviter que les balises soient collés au texte
  // $result = str_replace("<br /><br />","<br />",$result);     // pour éviter les doubles retours à la ligne
  
  return $result;
}









/* *****************************************************************************************************
 * manage file content by opening content into a text box
 * and update it.
 * $folderPath must finish with a "/" or a "\\"
 * ****************************************************************************************************/
function Xsy_Glob_EditFilesContent($folderPath){


  // PROCESSING :: file is renamed
  if (isset($_POST['XsyFilesRenamed'])){
    $oldName = Xsy_Glob_Get('fileOldName');
    $newName = Xsy_Glob_Get('fileNewName');
    rename($folderPath.$oldName, $folderPath.$newName);
  }

  // PROCESSING :: file is added : check if file already exists or not
  elseif (isset($_POST['XsyFilesAdded'])){
    $fileName = Xsy_Glob_Get('fileName');
    $fileCont = $_POST['fileContent'];                // keep everything
    // $fileCont = htmlentities($fileCont);  // keep html tags
    $fileCont = stripslashes($fileCont);  // removes slashes
    // $fileCont = nl2br($fileCont);  // new line

    // if file exists, re-popup the form: file name must be unique in SQL table !
    if (file_exists($folderPath.$fileName)){
      echo("  <div id='Xsy_Sql_Form'>
  <p> Add file </p>
  <p style='color:red;'> File name already exists, please choose another one. </p>
  <form method='post' action=''>
  <table>
    <tr> <td> File Name </td> <td> <input type='text' name='fileName' value='".$fileName."' style='width:100%' /> </td> </tr>
    <tr> <td> File Content </td> <td> <textarea name='fileContent' rows='25' cols='120'> ".str_replace("<br />", "", $fileCont)." </textarea> </td> </tr>
    <tr> <td colspan='2'> <input type='submit' name='XsyFilesAdded' value='Create File'/> </td> </tr>
  </table>
  </form>
  <p> <a href=''> Cancel </a> </p>
  </div>");
    }
    // othewise create file with 'w' option (write from beginning)
    else{
      $newFile = fopen($folderPath.$fileName, 'w');
      // if file is successsfully created, try to write in it
      if($newFile!==FALSE){
        $writing = fwrite($newFile, $fileCont);
        // if writing was successful, show it. Also show the error
        $msg = ($writing!==FALSE) ? "<p style='color:green;'> $writing bytes written in $fileName </p>" : "<p style='color:red;'> Error when wrinting in file $fileName </p>" ;

        echo($msg);
      }
      // WTF ? couldn't create the file
      else{
        echo(" <p style='color:red;'> Error when creating file $fileName with content : <br /> $fileCont </p>");
      }
      fclose($newFile);
    }
  }
  // PROCESSING :: File is uploaded
  elseif (isset($_POST['XsyFilesUploaded'])){

    $temp = explode(".", $_FILES["fileSelected"]["name"]);
    $extension = end($temp);

    if ($_FILES["fileSelected"]["error"] > 0) {
      echo "Return Code: " . $_FILES["fileSelected"]["error"] . "<br />";
    }
    else {
      echo (" ----------------------------------------------- <br />
    <table>
    <tr> <td> Upload </td> <td>: " . $_FILES["fileSelected"]["name"] . "</td> </tr>
    <tr> <td> Type </td> <td>: " . $_FILES["fileSelected"]["type"] . "</td> </tr>
    <tr> <td> Size </td> <td>: " . ($_FILES["fileSelected"]["size"] / 1024) . " kB</td> </tr>
    <tr> <td> Temp file </td> <td>; " . $_FILES["fileSelected"]["tmp_name"] . "</td> </tr>
    </table>");
      if (file_exists($folderPath.$_FILES["fileSelected"]["name"])) {
        echo " <p style='color:red;margin:0;'>!!! >>> ".$_FILES["fileSelected"]["name"] . " already exists. </p>";
      }
      else {
        move_uploaded_file($_FILES["fileSelected"]["tmp_name"], $folderPath.$_FILES["fileSelected"]["name"]);
        echo " <p style='color:green;margin:0;'> >>>Stored in: ".$folderPath.$_FILES["fileSelected"]["name"]." </p>";
      }
    }
 


  }
  // PROCESSING :: file is modified
  elseif (isset($_POST['XsyFilesModified'])){
    $fileName = Xsy_Glob_Get('fileName');
    $fileCont = $_POST['fileContent'];
    $fileCont = stripslashes($fileCont);  // removes slashes
    // $fileCont = nl2br($fileCont);  // new line

    $updFile = fopen($folderPath.$fileName, 'w');
    // if file is successsfully opened, try to write in it
    if($updFile!==FALSE){
      $writing = fwrite($updFile, $fileCont);
      // if writing was successful, show it. Also show the error
      $msg = ($writing!==FALSE) ? "<p style='color:green;'> $writing bytes written in $fileName </p>" : "<p style='color:red;'> Error when wrinting in file $fileName </p>" ;
      echo($msg);
    }
    // WTF ? couldn't open the file
    else{
      echo(" <p style='color:red;'> Error when open file $fileName for writing content : <br /> $fileCont </p>");
    }
    fclose($updFile);

  }
  // PROCESSING :: file is deleted forever !!!
  elseif (isset($_POST['XsyFilesDeleted'])){
    $fileName = Xsy_Glob_Get('fileName');
    unlink($folderPath.$fileName);
  }





  // FORM :: rename file
  if (isset($_POST['XsyFilesRename'])){
    $fileName = Xsy_Glob_Get('fileName');
    echo("  <div id='Xsy_Sql_Form'>
  <p> Rename file </p>
  <form method='post' action=''>
  <table>
    <tr> <td> Old Name </td> <td> ".$fileName." <input type='hidden' name='fileOldName' value='".$fileName."' readonly /> </td> </tr>
    <tr> <td> New Name </td> <td> <input type='text' name='fileNewName' value='".$fileName."' /> </td> </tr>
    <tr> <td colspan='2'> <input type='submit' name='XsyFilesRenamed' value='Rename'/> </td> </tr>
  </table>
  </form>
  <p> <a href=''> Cancel </a> </p>
  </div>");
  }
  // FORM :: create a new file
  elseif (isset($_POST['XsyFilesAdd'])){
    echo("  <div id='Xsy_Sql_Form'>
  <p> Add file </p>
  <form method='post' action=''>
  <table>
    <tr> <td> File Name </td> <td> <input type='text' name='fileName' value='' style='width:100%' /> </td> </tr>
    <tr> <td> File Content </td> <td> <textarea name='fileContent' rows='25' cols='120'>  </textarea> </td> </tr>
    <tr> <td colspan='2'> <input type='submit' name='XsyFilesAdded' value='Create File'/> </td> </tr>
  </table>
  </form>
  <p> <a href=''> Cancel </a> </p>
  </div>");
  }
  // FORM :: upload a new file
  elseif (isset($_POST['XsyFilesUpload'])){
    echo("  <div id='Xsy_Sql_Form'>
  <p> Upload a file </p>
  <form method='post' action='' enctype='multipart/form-data'>
  <table>
    <tr> <td> Choose file </td> <td> <input type='file' name='fileSelected' style='width:100%' /> </td> </tr>
    <tr> <td colspan='2'> <input type='submit' name='XsyFilesUploaded' value='Upload File'/> </td> </tr>
  </table>
  </form>
  <p> <a href=''> Cancel </a> </p>
  </div>");
  }
  // FORM :: modify existing content
  elseif (isset($_POST['XsyFilesModify'])){
    $fileName = Xsy_Glob_Get('fileName');
    $fileCont = file_get_contents($folderPath.$fileName);
    $fileCont = Xsy_Glob_EscapeString($fileCont, array("<br />"=>""));

    // $fileCont = str_replace("<br />", "", $fileCont);
    echo("  <div id='Xsy_Sql_Form'>
  <p> Modify file >> ".$fileName." </p>
  <form method='post' action=''>
  <table>
    <input type='hidden' name='fileName' value='".$fileName."' />
    <tr> <td> File Content </td> <td> <textarea name='fileContent' rows='25' cols='120'> ".$fileCont." </textarea> </td> </tr>
    <tr> <td colspan='2'> <input type='submit' name='XsyFilesModified' value='Modify File'/> </td> </tr>
  </table>
  </form>
  <p> <a href=''> Cancel </a> </p>
  </div>");
  }





  // DISPLAY :: display all files except '.' and '..'
  $txtFilesList = "
  <p> File contained in folder ".$folderPath." : </p>
  <table border='1' style='margin:20px auto;'>
  <tr>\n    <td colspan='4'> <form method='post' action=''> <input type='submit' name='XsyFilesAdd' value='Create a New File'/> <input type='submit' name='XsyFilesUpload' value='Upload a New File'/> </form> </td>\n  </tr>\n";

  foreach(scandir($folderPath) as $fileIndex=>$fileName){
    if ($fileName!=="." and $fileName!==".."){

    $txtFilesList .= "  <tr>\n    <td> <a href='".$folderPath.$fileName."'> ".$fileName." </a> </td>\n";

    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    if($extension!=="" AND stristr("htm php css js", $extension)){
      $txtFilesList .= "    <td> <form method='post' action=''>
    <input type='hidden' name='fileName' value='".$fileName."' />
    <input type='submit' name='XsyFilesRename' value='Rename'/>
    <input type='submit' name='XsyFilesModify' value='Modify'/>
    <input type='submit' name='XsyFilesDeleted' value='Delete'/>
    </form> </td>\n  </tr>";
    }
    else{
      $txtFilesList .= "    <td> <form method='post' action=''>
    <input type='hidden' name='fileName' value='".$fileName."' />
    <input type='submit' name='XsyFilesRename' value='Rename'/>
    (file not editable)
    <input type='submit' name='XsyFilesDeleted' value='Delete'/>
    </form> </td>\n  </tr>";
    }

    }
  }
  $txtFilesList .= "  </table>\n";

  echo $txtFilesList;
}






/* *****************************************************************************************************
 * use a session variable to switch between several folders :)
 * ****************************************************************************************************/

function Xsy_Glob_EditMultipleFolder($folderArray){

  $_SESSION['XsyGlobFolderEdit'] = isset($_SESSION['XsyGlobFolderEdit']) ? $_SESSION['XsyGlobFolderEdit'] : $folderArray[0];
  if(!in_array($_SESSION['XsyGlobFolderEdit'], $folderArray)){
    $_SESSION['XsyGlobFolderEdit'] = $folderArray[0];
  }
  if(isset($_POST['FolderChanged'])){
    $_SESSION['XsyGlobFolderEdit'] = $folderArray[Xsy_Glob_Get('FolderName')];
  }

  $optionForm = "  <div style='width:70%;margin:auto;border:1px solid white; background:black;'>
  <form method='post' action=''>
    <select name='FolderName' style='width:60%;'>\n";

  foreach($folderArray as $index=>$folderPath){
    $selected   = ($_SESSION['XsyGlobFolderEdit']==$folderPath) ? "selected" : "";
    $optionForm .= "      <option value='".$index."' ".$selected."> ".$folderPath."</option> \n";
  }

  $optionForm .= "    </select>
    <input type='submit' name='FolderChanged' value='Change Folder' style='width:38%;' />
  </form>
  </div>\n";


  echo($optionForm);
   Xsy_Glob_EditFilesContent($_SESSION['XsyGlobFolderEdit']);
}



/* *****************************************************************************************************
 * escape single quote by replacing it by &#39;
 * ****************************************************************************************************/
function Xsy_Glob_EscapeString($string, $escapeArray=NULL){

  $newString = isset($escapeArray["'"]) ? str_replace("'", $escapeArray["'"], $string) : str_replace("'", "&#39;", $string);
  if($escapeArray!==NULL){
    foreach($escapeArray as $needle=>$replace){
      $newString = str_replace($needle, $replace, $newString);
    }
  }
  return $newString;
}


?>