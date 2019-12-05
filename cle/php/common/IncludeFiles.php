<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';

	require_once( $currentDir.'php/common/ArrayList.php' );
	require_once( $currentDir.'php/parameter/Param.php' );
	
	// session_start();
	/*
	session_start();
	$_SESSION['sessid'] = 0;
	var_dump($_SESSION);
	*/
?>