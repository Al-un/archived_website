<?php

if (isset($_GET['TableManaged'])){
  Xsy_Sql_ManageTableData($_GET['TableManaged']);
}

if (isset($_GET['TableDesign']) AND $_GET['TableDesign']=="Admin"){
  sqlManager("phobida_");
}






if (isset($_POST['QuerySubmitted'])){
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

if (isset($_GET['SqlInput']) AND $_GET['SqlInput']=="Direct"){
  echo("
  <div style='text-align:center;border:1px solid black; background: black; color: white; margin-top: 10px; padding: 10px;'>
  <form method='post' action=''>
    <p style='margin:auto;text-align:left;'> Submit the SQL query below </p>
    <textarea name='sqlquery' rows='20' cols='120' style='background:#000509; color: #B7FFC2; font-family:'Courrier', Monospace;'>

    </textarea><br />
    <input type='submit' name='QuerySubmitted' value='Submit SQL query (no possible roll-back)' style='width:60%;height:5%;' />
  </form>
  </div>
  ");

}
?>