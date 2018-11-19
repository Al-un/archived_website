<?php










// =================================================================
//    display all Excel retrieved
// =================================================================
function displayAllExcels($excel_array){

  GLOBAL $XSY_AUTH, $path_ExcelFiles, $noExcel, $xlSelect, $xlIntro, $xlDl;

  echo("
  <div id='ExcelBlock' style='display:none' class='plop'>
  <div id='ExcelIntro'>
".$xlIntro."
  </div>
");


  if(count($excel_array)==0){
    echo("<p> $noExcel </p>");
  }
  else{
    $excel_text = "  <div id='ExcelFileContainer'>\n  <form method='post' action='download.php'>\n";
    $excel_desc = "  <div id='ExcelDescContainer'>\n    <div id='ExcelDesc-1' class='ExcelDesc'> <p> ".$xlSelect." </p> </div>\n";

    foreach($excel_array as $typeName=>$allExcels){
      $excel_text .= "    <div class='Excel_Type'> <p> $typeName </p>\n      <table>";
      foreach($allExcels as $index=>$excel){
        $excel_text .= "        <tr> <td> <input type='radio' name='excelFiles' value='".$excel['File']."' id='Excel".$index."'/> </td>\n";
        $excel_text .= ($_SESSION['UserAdmin']) ? "<td class='ExcelAdded'> [".$XSY_AUTH[$excel['Auth']]['Name']."] </td>" : "";
        $excel_text .= "<td class='ExcelUpdate'> [".date( "d/m/Y h:m:s", filemtime($path_ExcelFiles.$excel['File']))."] </td> \n";
        $excel_text .= "<td> ".$excel['Name']."</td> \n";
        $excel_text .= ($_SESSION['UserAdmin']) ? "<td class='ExcelAdded'> Added : ".$excel['Upd']." </td>" : "";
        $excel_text .= " </tr>\n";
        $excel_desc .= "    <div id='ExcelDesc".$index."' class='ExcelDesc'>\n     <p> ".(($excel['Desc']=="") ? "(no description)" : $excel['Desc'])." </p>\n    </div>\n ";
      }
      $excel_text .= "      </table>\n    </div>\n";
    }

    $excel_text .= "<input type='submit' name='Xsy_Misc_Download' value='".$xlDl."' /></form>
    <div id='EmptyForDownload'> </div>\n  </div>";
    $excel_desc .= "  </div>\n";

    echo($excel_text);
    echo($excel_desc);
  }
  echo("</div> <!-- End of Excel Block -->");
}


/* display all */
$excel_array = getAllExcels();
displayAllExcels($excel_array);
?>