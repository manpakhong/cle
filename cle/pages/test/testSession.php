<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>testSession</title>
</head>

<body>
<?php

	session_start();
	if (isset($_SESSION["USER"]))
	{	
		echo '$_SESSION["USER"]: is set.' . '<br/>';
		echo '$_SESSION["USER"]: value is :' . $_SESSION["USER"] . '<br/>';

	}
	else
	{
		echo '$_SESSION["USER"]: is not set.' . '<br/>';
		echo 'set it now' . '<br/>';
		$_SESSION["USER"] = 'Administrator';
	}
?>
<a href="testUnsetSession.php"> unset session </a> <br/>
<a href="testSession.php"> go to test sesssion 1 </a> <br/>
<a href="testSession2.php"> go to test sesssion 2 </a> <br/>

</body>
</html>