<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>test curl</title>
</head>

<body>
<?php


 
 $Curl_Session = curl_init('http://www.google.com');
 curl_setopt ($Curl_Session, CURLOPT_POST, 1);
 curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "Name=Rabbit&Email=rabbit@hotmail.com&Message=rabbitrabbit");
 curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
 $stringCurl = curl_exec ($Curl_Session);
 curl_close ($Curl_Session);
 
 echo $stringCurl;

 
?>

</body>
</html>