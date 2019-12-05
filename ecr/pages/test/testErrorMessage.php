<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Error Message</title>
</head>

<body>
	<?php
		$currentDir = getcwd();
		$rootDir = 'ecr';
		$findRootDirPos = strpos($currentDir, $rootDir, 0);
		$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
		$currentDir = $currentDir . '/';
		
		require_once $currentDir . 'php/error/ErrorMessageHandler.php';		
		require_once $currentDir . 'php/log/LogHandler.php';	
		require_once $currentDir . 'php/vo/Log.php';				
				
		$errorMessageHandler = new ErrorMessageHandler();
		echo $errorMessageHandler->getErrorMessage('4001') . '<br/>';
		
		$log = new Log();
		
		$logHandler = new LogHandler();
		$logHandler->writeLog($log);
		
		    if (getenv(HTTP_X_FORWARDED_FOR)) 
		    {
        		$pipaddress = getenv(HTTP_X_FORWARDED_FOR);
        		$ipaddress = getenv(REMOTE_ADDR);
				echo "Your Proxy IPaddress is : ".$pipaddress. "(via $ipaddress)" ;
		    } 
		    else 
		    {
		        $ipaddress = getenv(REMOTE_ADDR);
		        echo "Your IP address is : $ipaddress";
		    }			
		
	?>
</body>
</html>