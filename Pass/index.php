<?php
include_once("pass_header.php");

if(Xsy_Glob_AuthCheck("XsyPass", $XSY_SESS_USERLEVEL)) {

  // if a pass has been added
  if (isset($_POST['PassAdded'])){
    $passEntry['Txt_Title']   = Xsy_Glob_Get('PassSiteName');
    $passEntry['Txt_SiteUrl'] = Xsy_Glob_Get('PassSiteUrl');
    $passEntry['Txt_Login']   = Xsy_Glob_Get('PassLogin');
    $passEntry['Id_PassCate'] = Xsy_Glob_Get('Id_PassCate');
    $passEntry['Id_PassLevel']= Xsy_Glob_Get('Id_PassLevel');
    $passEntry['Txt_Comment'] = Xsy_Glob_Get('PassComment');
    Xsy_Sql_Insert($SQL_DATABASE, $sqlTable_PassSite, $passEntry);
  }
  elseif (isset($_POST['PassUpdated'])){
    $passIdUpdated = Xsy_Glob_Get('siteId');
    $passEntry['Txt_Title']   = Xsy_Glob_Get('PassSiteName');
    $passEntry['Txt_SiteUrl'] = Xsy_Glob_Get('PassSiteUrl');
    $passEntry['Txt_Login']   = Xsy_Glob_Get('PassLogin');
    $passEntry['Id_PassCate'] = Xsy_Glob_Get('Id_PassCate');
    $passEntry['Id_PassLevel']= Xsy_Glob_Get('Id_PassLevel');
    $passEntry['Txt_Comment'] = Xsy_Glob_Get('PassComment');
    Xsy_Sql_Update($SQL_DATABASE, $sqlTable_PassSite, $passEntry, $passIdUpdated);
  }
  // if a pass has been deleted
  elseif (isset($_POST['SiteDeleted'])) {
    Xsy_Sql_Delete($SQL_DATABASE, $sqlTable_PassSite, 'ID_PassSite', Xsy_Glob_Get('SiteId'));
  }




  // --- for administrator only but never executed for normal users
  if(isset($_GET['sqltable'])){
    if(Xsy_Glob_AuthCheck("XsyPass", $XSY_SESS_ADMINLEVEL)) {
      Xsy_Sql_ManageTableData($_GET['sqltable']);
    }
    else{
      echo($XSY_SESS_NO_AUTH_ERRORTXT);
    }
  }

  // --- user manage categories
  elseif (isset($_GET['passaction']) AND $_GET['passaction']=="cate"){
    Xsy_Sql_ManageTableData($sqlTable_PassCate, $conditionArray, $cateSelectedField, $cateTextArray);
  }
  // --- user manage level
  elseif (isset($_GET['passaction']) AND $_GET['passaction']=="lvl"){
    Xsy_Sql_ManageTableData($sqlTable_PassLevel, $conditionArray, $lvlSelectedField, $cateTextArray);
  }

  // --- user create or update a pass
  elseif ( (isset($_GET['passaction']) AND $_GET['passaction']=="pass") OR isset($_POST['SiteUpdate']) ){
    include_once("pass_dataform.php");
/*
    $cateFilter['WHERE']['Id_User']     = $_SESSION['UserId'];
    $cateFilter['WHERE']['Bool_Active'] = 1;

    echo("<div id='Xsy_Sql_Form'>

  <p> Add a pass remember : select a category (only active categories and level are displayed). </p>

  <form method='post' action='index.php'>
    <table>
      <tr> <td> Site Name </td>  <td> <input type='text' name='PassSiteName' size='30' /> </td> </tr>
      <tr> <td> Site Url </td>  <td> <input type='text' name='PassSiteUrl' size='30' /> </td> </tr>
      <tr> <td> Login </td>  <td> <input type='text' name='PassLogin' size='30' /> </td> </tr>
      <tr> <td> Category </td>  <td> ".Xsy_Sql_DisplayFieldValue('Id_PassCate', '', 'Update', $cateFilter)." </td> </tr>
      <tr> <td> Level </td>  <td> ".Xsy_Sql_DisplayFieldValue('Id_PassLevel', '', 'Update', $cateFilter)." </td> </tr>
      <tr> <td> Comment </td>  <td> <textarea name='PassComment' cols='50' rows='6'></textarea> </td> </tr>
    </table>

    <table class='AddrFormSubmit'>
     <tr> <td colspan='2'> <input type='submit' name='PassAdded' value='Add Pass'/> </td> </tr>
    </table>
  </form>
  <p> <a href='index.php'> Cancel </a> </p>

  </div>");
  }

  // --- user update an existing pass
  elseif (isset($_POST['SiteUpdate'])){
    $passIdUpd = Xsy_Glob_Get('SiteId');
    $queryUpd  = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_PassSite` WHERE `ID_PassSite`='".$passIdUpd."'";
    $fetchUpd  = Xsy_Sql_FetchAll($queryUpd);

    $cateFilter['WHERE']['Id_User']     = $_SESSION['UserId'];
    $cateFilter['WHERE']['Bool_Active'] = 1;

    echo("<div id='Xsy_Sql_Form'>

  <p> Update existing pass :  </p>

  <form method='post' action='index.php'>
    <input type='hidden' name='siteId' value='".$passIdUpd."' />
    <table>
      <tr> <td> Site Name </td>  <td> <input type='text' name='PassSiteName' size='30' value='".$fetchUpd[0]['Txt_Title']."' /> </td> </tr>
      <tr> <td> Site Url </td>  <td> <input type='text' name='PassSiteUrl' size='30' value='".$fetchUpd[0]['Txt_SiteUrl']."' /> </td> </tr>
      <tr> <td> Login </td>  <td> <input type='text' name='PassLogin' size='30' value='".$fetchUpd[0]['Txt_Login']."' /> </td> </tr>
      <tr> <td> Category </td>  <td> ".Xsy_Sql_DisplayFieldValue('Id_PassCate', $fetchUpd[0]['Id_PassCate'], 'Update', $cateFilter)." </td> </tr>
      <tr> <td> Level </td>  <td> ".Xsy_Sql_DisplayFieldValue('Id_PassLevel', $fetchUpd[0]['Id_PassLevel'], 'Update', $cateFilter)." </td> </tr>
      <tr> <td> Comment </td>  <td> <textarea name='PassComment' cols='50' rows='6'>".$fetchUpd[0]['Txt_Comment']."</textarea> </td> </tr>
    </table>

    <table class='AddrFormSubmit'>
     <tr> <td colspan='2'> <input type='submit' name='PassUpdated' value='Update Pass'/> </td> </tr>
    </table>
  </form>
  <p> <a href='index.php'> Cancel </a> </p>

  </div>");
*/
  }
  // --- display all passes... if they exist
  else{
    $query_check  = "SELECT COUNT(*) 
                    FROM `$SQL_DATABASE`.`$sqlTable_PassSite`, `$SQL_DATABASE`.`$sqlTable_PassCate`
                    WHERE `$sqlTable_PassSite`.`Id_PassCate` = `$sqlTable_PassCate`.`ID_PassCate` 
                    AND `$sqlTable_PassCate`.`Id_User`='".$_SESSION['UserId']."'";
    $raw_check    = Xsy_Sql_FetchAll($query_check);
    $passCount    = $raw_check[0]['COUNT(*)'];
    $passExist    = ($passCount > 0);
    if ($passExist){
      include_once("pass_dataget.php");
      $txtPass = "";
      switch($_SESSION['PassSort']){
        case "Cate"   : $txtPass = Xsy_Pass_DisplayByCate(); break;
        case "Level"  : $txtPass = Xsy_Pass_DisplayByLevel(); break;
      }
      echo($txtPass);
    }
    else{
      echo($noPass);
    }

  }


}
else{
  echo $XSY_SESS_NO_AUTH_ERRORTXT;
}
include_once("pass_footer.php");
?>