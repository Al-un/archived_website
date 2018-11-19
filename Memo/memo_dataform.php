<?php

// ============================================================================================== //
// =========================== Add Memo and Share form                 ========================== //
// ============================================================================================== //

// --- add memo
if(isset($_GET['AddMemo'])){
  $memoFilter['WHERE']['Id_User'] = $_SESSION['UserId'];

  $formMemo = "
   <div id='Xsy_Sql_Form'>

    <p> Add memo which belongs to an active category and has an active status </p>
      <form method='post' action='index.php'>
      $formerError
      <table>
      <input type='hidden' name='XsyMemoId' value='0' />
      <tr> <td> Title </td> <td> ".Xsy_Sql_DisplayFieldValue('Txt_Memo%Name', '', "Update")." </td> </tr>
      <tr> <td> Memo </td> <td> ".Xsy_Sql_DisplayFieldValue('Text_Memo%Content', '', "Update")." </td> </tr>
      <tr> <td> Category </td> <td> ".Xsy_Sql_DisplayFieldValue('Id_MemoCate', '', "Update", $memoFilter)." </td> </tr>
      <tr> <td> Status </td> <td> ".Xsy_Sql_DisplayFieldValue('Id_MemoStatus', '', "Update", $memoFilter)." </td> </tr>
      <tr> <td colspan=2> <input type='submit' name='XsyMemoSubmit' value='Add' style='width:100%;' /> </td> </tr>
      </table>
      </form>
    <p> <a href='index.php'> Cancel </a> </p>

   </div>\n";
}


// --- update memo
elseif (isset($_POST['XsyMemoModify'])) {

  $query  = "SELECT * FROM `$SQL_DATABASE`.`$sqlTable_memocontent`, `$SQL_DATABASE`.`$sqlTable_memocate`, `$SQL_DATABASE`.`$sqlTable_memostatus`
        WHERE `$sqlTable_memocontent`.`Id_MemoCate` = `$sqlTable_memocate`.`ID_MemoCate`
        AND `$sqlTable_memocontent`.`Id_MemoStatus` = `$sqlTable_memostatus`.`ID_MemoStatus`
        AND `$sqlTable_memocontent`.`ID_MemoContent` = '".$_POST['XsyMemoID']."'";
  $fetchedAll = Xsy_Sql_FetchAll($query);
  $memoFilter['WHERE']['Id_User'] = $_SESSION['UserId'];
  $formMemo = "
    <div id='Xsy_Sql_Form'>
      <p> Modify Memo </p>
      <form method='post' action='index.php'>
      $formerError
      <table>
      <input type='hidden' name='XsyMemoId' value='".$_POST['XsyMemoID']."' />
      <tr> <td> Title </td> <td> ".Xsy_Sql_DisplayFieldValue('Txt_Memo%Name', $fetchedAll[0]['Txt_Memo%Name'], "Update")." </td> </tr>
      <tr> <td> Memo </td> <td> ".str_replace("  <br />", "", Xsy_Sql_DisplayFieldValue('Text_Memo%Content', $fetchedAll[0]['Text_Memo%Content'], "Update"))." </td> </tr>
      <tr> <td> Category </td> <td> ".Xsy_Sql_DisplayFieldValue('Id_MemoCate', $fetchedAll[0]['Id_MemoCate'], "Update", $memoFilter)." </td> </tr>
      <tr> <td> Status </td> <td> ".Xsy_Sql_DisplayFieldValue('Id_MemoStatus', $fetchedAll[0]['Id_MemoStatus'], "Update", $memoFilter)." </td> </tr>
      <tr> <td colspan=2> <input type='submit' name='XsyMemoSubmit' value='Modify' style='width:100%;' /> </td> </tr>
      </table>
      </form>
    <p> <a href='index.php'> Cancel </a> </p>

   </div>\n";
}


// --- update memo
elseif (isset($_POST['XsyMemoShare'])) {

  $formMemo = "
   <div id='Xsy_Sql_Form'>

    <p> Select an user to share this memo with </p>
      <form method='post' action='index.php'>
      $formerError
      <table>
      <input type='hidden' name='XsyMemoID' value='".Xsy_Glob_Get('XsyMemoID')."' />
      <tr> <td> User </td> <td> ".Xsy_Sql_DisplayFieldValue('Id_User', '', "Update")." </td> </tr>
      <tr> <td> Can modify </td> <td> ".Xsy_Sql_DisplayFieldValue('Bool_Can%Modify', '', "Update")." </td> </tr>
      <tr> <td colspan=2> <input type='submit' name='XsyMemoShared' value='Add' style='width:100%;' /> </td> </tr>
      </table>
      </form>
    <p> <a href='index.php'> Cancel </a> </p>

   </div>\n";
}

// ---- finally echo the proper form
echo($formMemo);

?>