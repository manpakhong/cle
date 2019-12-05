<html>
<head>
</head>
<body>
<?php

	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/system/SysParams.php';	
	require_once $currentDir . 'php/system/SystemValues.php';

	
	session_start();
	echo $_SESSION[SystemParam::$SYSTEM_LANGUAGE];
	session_destroy();
?>
</body>
</html>