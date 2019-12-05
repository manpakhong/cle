<?php
	echo dirname(__FILE__)." in a.php"."</br>";
    include_once $_SERVER['DOCUMENT_ROOT'] . '/cle/test/c.php';	
	require_once("b.php");
?>