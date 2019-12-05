<?php
	/*
	define("DATABASE_SERVER", "localhost");
	define("DATABASE_USERNAME", "root");
	define("DATABASE_PASSWORD", "edb");
	define("DATABASE_NAME", "ecopyright");
	*/
	
	define("DATABASE_SERVER", "chinesestudent.db.edb.hkedcity.net");
	define("DATABASE_USERNAME", "ecopyright");
	define("DATABASE_PASSWORD", "T6e@pnq");
	define("DATABASE_NAME", "ecopyright");	
	
	
	// connect to the database
	$con = mysql_connect(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD) or die(mysql_error());
	mysql_select_db(DATABASE_NAME, $con) or die(mysql_error());
	mysql_set_charset('utf8',$con); 
	selectAllActivity();
	
	if (isset($_POST["sid"]))
	{
		echo 'ok';
	}
	
	function quote_smart($value)
	{
		if (get_magic_quotes_gpc())
		{
			$value = stripslashes($values);
		}
		
		if (!is_numeric($value))
		{
			$value = "'" . mysql_real_escape_string($value) . "'";
		}
		return $value;
	}
	
	function selectAllActivity()
	{

		
		$query = "select * from ecr_activity";
		$sql = mysql_query($query);
		

		
		$return = "<activities>";
		
		
		while ($activity =  mysql_fetch_object($sql))
		{
			$return .= "<activity>" .
							"<sid>" . $activity->sid . "</sid>" .
							"<seq>" . $activity->Seq . "</seq>" .
							"<activityNameEn>" . $activity->Activity_Name_En . "</activityNameEn>".
						"</activity>";
		}
		
		$return .= "</activities>";
		
		mysql_free_result($sql);
		
		print ($return);
	}
?>