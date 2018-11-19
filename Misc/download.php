<?php
/*
 * download solved with http://stackoverflow.com/questions/16984132/phpexcel-file-format-or-extension-is-not-valid
 */

if(isset($_POST['excelFiles'])){
$pathParts  = pathinfo($_POST['excelFiles']);
$fileName   = $pathParts['basename'];
$fileExt    = $pathParts['extension'];
$filePath   = "Excel/".$fileName;
$appli      = "application/octet-stream";
// switch($fileExt){
  // case "txt"  : $appli = "text/plain";
// }
  header('Content-Type: '.$appli);
  header('Content-Disposition: attachment; filename="'.$fileName.'"');
  header('Content-Lengt(h)h: ' . filesize($filePath));
  readfile($filePath);
}
else{
  header("Location: index.php");
}
?>