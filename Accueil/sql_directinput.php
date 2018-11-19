<?php

echo("
<div style='text-align:center;'>
<form method='post' action=''>
  <p style='margin:auto;text-align:left;'> Submit the SQL query below </p>
  <textarea name='sqlquery' cols='90' rows='15'>
  </textarea><br />
  <input type='submit' name='XsySqlQuerySubmitted' value='Submit SQL query (no possible roll-back)' style='width:60%;height:5%;' />
</form>
</div>
");

if (isset($_POST['XsySqlQuerySubmitted'])){
  $query_input  = $_POST['sqlquery'];
  $query_all    = explode(";", $query_input);

  foreach ($query_all as $key=>$query){
    if ($query != ""){
      $query_status = Xsy_Sql_Query($query);
      if($query_status){
        echo("<p style='margin:auto;color:darkgreen;'>Query correctly processed: <br /> ".$query."</p>");
      }
      else{
        echo("<p style='margin:auto;color:darkred;'>Error when submitted query: <br /> ".$query."</p>");
      }
    }
  }

}


?>