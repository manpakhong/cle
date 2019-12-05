<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>test arraylist null problem</title>
<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';


	
	require_once $currentDir.'php/common/ArrayList.php';
?>
</head>

<body>
<?php


	$arrayList = new ArrayList();
	$arrayList->add('item 1');
	$arrayList->add(3);
	$arrayList->add(4);
	$arrayList->add(5);
	$arrayList->add(null);
	$arrayList->add('item 5');

	
	$i = 1;
	
	// echo 'arrayList count: ' . $arrayList->size() . '<br/>';
	
	while ($arrayList->hasNext())
	{

		$item = $arrayList->next();
		
		if (!is_null($item))
		{
			echo 'item ' . $i . ':' . $item . '<br/>';
		}
		else
		{
			echo 'item ' . $i . ':' . 'null' . '<br/>';			
		}
		$i++;
	}

	/*
	$array = array();
	array_push($array, 1);
	$array[] = 1;
	$array[] = 2;
	$array[] = null;
	array_push($array, null);	
	$array[] = 3;
	$array[] = 4;			
	for ($i = 0; $i < count($array); $i++)
	{
		echo $array[$i] . '<br/>';
	}
	*/
?>
</body>
</html>