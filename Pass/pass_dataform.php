<?php


// ----------------------------------------------------------------------------
// ---- Add pass form
// ----------------------------------------------------------------------------
if (isset($_GET['passaction']) AND $_GET['passaction']=="pass"){

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


// ----------------------------------------------------------------------------
// ---- Update pass form
// ----------------------------------------------------------------------------
if (isset($_POST['SiteUpdate'])){

    $actionDest = "index.php";
    switch($_SESSION['PassSort']){
      case "Cate"   : $actionDest="index.php#Cate".Xsy_Glob_Get("CateId"); break;
      case "Level"  : $actionDest="index.php#Level".Xsy_Glob_Get("LevelId"); break;
    }

    $passIdUpd = Xsy_Glob_Get('SiteId');
    $queryUpd  = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_PassSite` WHERE `ID_PassSite`='".$passIdUpd."'";
    $fetchUpd  = Xsy_Sql_FetchAll($queryUpd);

    $cateFilter['WHERE']['Id_User']     = $_SESSION['UserId'];
    $cateFilter['WHERE']['Bool_Active'] = 1;

    echo("<div id='Xsy_Sql_Form'>

  <p> Update existing pass :  </p>

  <form method='post' action='".$actionDest."'>
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
}
?>