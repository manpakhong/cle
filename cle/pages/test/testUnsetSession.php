<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
		session_start();
		echo 'now unset it';
		unset($_SESSION["USER"]);
?>

<a href="testUnsetSession.php"> unset session </a> <br/>
<a href="testSession.php"> go to test sesssion 1 </a> <br/>
<a href="testSession2.php"> go to test sesssion 2 </a> <br/>
</body>
</html>