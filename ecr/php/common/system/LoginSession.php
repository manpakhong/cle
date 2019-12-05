<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	require_once( $currentDir.'php/system/SysParams.php' );
	require_once( $currentDir.'php/vo/EcrUser.php' );
	
	session_start();
	
	try
	{
		$loginSession = new LoginSession();
		$authenticatedUser = new EcrUser();
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
		private $ecrUser;
		
		public function __construct()
		{
			$this->ecrUser = new EcrUser();
			$this->setLoginSession();
		}
		public function getUser()
		{
			return $this->ecrUser;
		}
		public function setUser($_ecrUser)
		{
			$this->ecrUser = $_ecrUser;
		}
		
		private function setLoginSession()
		{
			
			if (isset($_SESSION[EcrUserParam::$ECR_USER_SESSION]))
			{
				$this->ecrUser=unserialize($_SESSION[EcrUserParam::$ECR_USER_SESSION]);
				// echo 'session set' . '<br/>';
			}			
			else
			{
				// echo 'session not set' . '<br/>';
			}
		}
		public function unsetLoginSession()
		{
			if (isset($_SESSION[EcrUserParam::$ECR_USER_SESSION]))
			{
				unset($_SESSION[EcrUserParam::$ECR_USER_SESSION]);
				
				echo '<script type="text/javascript">setTimeout(window.location="'. $_SERVER['PHP_SELF']  .'",10000);</script>';	
			}
		}
		
	} // end class LoginSession
?>