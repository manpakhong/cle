<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<?php
		echo 'Document Root: '. $_SERVER['DOCUMENT_ROOT'] . '<br/>';
		
		$systemArray = array();
		$systemArray = explode('/', $_SERVER['PHP_SELF']);
		echo 'Current Document: '. $systemArray[1] . '<br/>';	
		
		include_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/common/ArrayList.php';		
		/*
		include_once '/'. $systemArray[1] . '/php/common/System.php';
		echo 'Document Root: '. System::getDocumentRoot();
		*/
		
	?>
</body>
</html>