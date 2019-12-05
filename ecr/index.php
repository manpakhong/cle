<?php 
	/*
	header('Location:  landingPage.php');
	exit();
	*/
	session_destroy();
	session_start();	
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/system/SysParams.php';	
	require_once $currentDir . 'php/system/SystemValues.php';	
	

	$_SESSION[SystemParam::$SYSTEM_LANGUAGE] = SystemParam::$SYSTEM_LANGUAGE_TC;	
	echo '<script type="text/javascript">window.location="landingPage.php"</script>';
?>
