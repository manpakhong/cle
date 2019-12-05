<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';

	require_once( $currentDir.'php/common/system/System.php' );	
	
	class Connection {
	
	  // Connection for mySql
	  private static $con;
	
	  public function __construct() 
	  { 
	  }
	
	  // getInstance method
// 	  public static function getConnectionInstance() {
	
// 	      if(!is_null(Connection::$con)) {
// 	          return Connection::$con;
// 		}
	
// 		try 
// 		{
// 			if (System::getRealIpAddr() != '127.0.0.1')
// 			{
// 				$con = mysql_connect("chinesestudent.db.edb.hkedcity.net", "ecopyright", "T6e@pnq") or die(mysql_error());
// 				// $con = mysql_connect("localhost:3306", "root", "edb") or die(mysql_error());
// 			}
// 			else
// 			{
// 				$con = mysql_connect("localhost:3306", "root", "PeppaPig0513") or die(mysql_error());
// 			}
// 			// echo "Connected to MySQL<br />";
// 			mysql_select_db("ecopyright", $con) or die(mysql_error());
// 			// echo "Connected to Database"; 	
// 			mysql_set_charset('utf8',$con); 
// 			return $con;
// 		}
// 		catch (Exception $e)
// 		{
// 			echo 'Exception: ', $e->getMessage(), "\n";
// 		}
	
// 	  }
	
	  public static function getMysqliConnectionInstance() {
	      if(!is_null(Connection::$con)) {
	          return Connection::$con;
		}
	
		try 
		{
			// $db = "chilangedu.localhost";
			
			//$con = new mysqli("mysqlc.hkedcity.net", "chinese_student", "8p#g9px", "chinese_student", "3406")
			
			$con = new mysqli("localhost", "root", "PeppaPig0513", "ecopyright", "3306")
			or die('Could not connect: ' . mysql_error());
			
			/* change character set to utf8 */
			if (!$con->set_charset("utf8")) {
				printf("Error loading character set utf8: %s\n", $con->error);
			} else {
				// printf("Current character set: %s\n", $con->character_set_name());
			}    	
			
			return $con;
		}
		catch (Exception $e)
		{
			echo 'Exception: ', $e->getMessage(), "\n";
		}  	
	  }
	  //...
	
	} 

?>