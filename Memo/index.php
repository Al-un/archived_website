<?php
include_once("memo_header.php");

if(Xsy_Glob_AuthCheck("XsyMemo", $XSY_SESS_NORMALLEVEL)) {

  // PHP process first and define some variables 
  // in case of error in forms and so on.
  include_once("memo_dataprocess.php");
  
  // pop up form if necessary
  if (isset($_GET['AddMemo']) OR isset($_POST['XsyMemoModify']) OR isset($_POST['XsyMemoShare'])){
    if(Xsy_Glob_AuthCheck("XsyMemo", $XSY_SESS_USERLEVEL))  { include_once("memo_dataform.php"); }
    else{ echo ("<div class='MemoNoAuth'>".$XSY_SESS_NO_AUTH_ERRORTXT."</div>"); }
  }
  // manage table ?
  elseif (isset($_GET['memoaction'])){
    if(Xsy_Glob_AuthCheck("XsyMemo", $XSY_SESS_USERLEVEL))  { include_once("memo_manageCateStatus.php");  }
    else{ echo ("<div class='MemoNoAuth'>".$XSY_SESS_NO_AUTH_ERRORTXT."</div>");  }
  }
  // then display memos
  else{
    include_once("memo_dataget.php");
    include_once("memo_datadisplay.php");
  }

}
// no authorization ^^
else{
  echo ("<div>".$XSY_SESS_NO_AUTH_ERRORTXT."</div>");
}

include_once("memo_footer.php");
?>