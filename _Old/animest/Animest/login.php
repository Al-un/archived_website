		<?php
			 $server = "localhost";
			 $user = "root";
			 $password = "";
			
				$database = "freeh_taetili";
	/*
				$server		= "sql1.free-h.org";
				$user		= "taetili_sql75";
				$password	= "ac5710e27c8e";
			
	*/		
				function init(){
				 	$mysql 	= mysql_connect($server,$user,$password);
				 	$select	= mysql_select_db($database,$mysql);
				 
				 	$request = "CREATE 
				 }	
		?>