<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once( $currentDir.'php/parameter/Param.php' );
	require_once( $currentDir.'php/vo/CleUser.php' );
    if(!isset($_SESSION)) 
    { 
		session_start();
	}	
	try
	{
		$loginSession = new LoginSession();
		$authenticatedUser = new CleUser();
		$authenticatedUser = $loginSession->getUser();
		
/*
		$logFile = "../../logFile.txt";
		$fh = fopen($logFile, 'w') or die("can't open file");
		$stringData = 'get user successfully' . '\n';
		fwrite($fh, $stringData);
		fclose($fh);	
*/
		
	}
	catch (Exception $e)
	{
		echo 'Exception: ' . $e;
/*
		$logFile = "../../logFile.txt";
		$fh = fopen($logFile, 'w') or die("can't open file");
		$stringData = $e . '\n';
		fwrite($fh, $stringData);
		fclose($fh);
*/
	}
	
	if (isset($_GET["logoff"]))
	{
		if ($_GET["logoff"] == "true")
		{
			$loginSession->unsetLoginSession();
		}
	}

		
	class LoginSession
	{
		private $cleUser;
		
		public function __construct()
		{
			$this->cleUser = new CleUser();
			$this->setLoginSession();
		}
		public function getUser()
		{
			return $this->cleUser;
		}
		public function setUser($_cleUser)
		{
			$this->cleUser = $_cleUser;
		}
		
		private function setLoginSession()
		{
			
			if (isset($_SESSION[CleUserParam::$CLE_USER]))
			{
				$this->cleUser=unserialize($_SESSION[CleUserParam::$CLE_USER]);
				// echo 'session set' . '<br/>';
			}			
			else
			{
				// echo 'session not set' . '<br/>';
			}
		}
		public function unsetLoginSession()
		{
			if (isset($_SESSION[CleUserParam::$CLE_USER]))
			{
				unset($_SESSION[CleUserParam::$CLE_USER]);
				
				echo '<script type="text/javascript">setTimeout(window.location="'. $_SERVER['PHP_SELF']  .'",10000);</script>';	
			}
		}
		
	} // end class LoginSession
?>