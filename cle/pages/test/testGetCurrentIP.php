<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>get current ip</title>
</head>

<body>
	<?php
		$currentDir = getcwd();
		$findRootDirPos = strpos($currentDir, 'cle', 0);
		$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);
	
		$currentDir = $currentDir . '/';
	
		require_once( $currentDir.'php/common/System.php' );	
	
		echo 'current ip: ' . System::getRealIpAddr() . '<br/>';
			
	?>
</body>
</html>