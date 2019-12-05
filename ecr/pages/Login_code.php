<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/common/PageCode.php';
		
	class Login extends PageCode
	{
		public function __construct()
		{
			parent::__construct('Login.php');
		}
	} // end Login
?>