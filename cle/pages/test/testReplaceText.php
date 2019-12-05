<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	/*
	//string that needs to be customized
	$rawstring = "Welcome Birmingham parents. Your replaceme is a pleasure to have! ";
	
	//male string
	$malestr = str_replace("replaceme", "son", $rawstring);
	
	//female string
	$femalestr = str_replace("replaceme", "daughter", $rawstring);
	
	echo "Son: ". $malestr . "<br />";
	echo "Daughter: ". $femalestr;
	*/
	include_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/common/ArrayList.php';
		
	$paramList = new ArrayList();
	$paramList->add(1);
	$paramList->add('http://www.yahoo.com.hk');
	$paramList->add('雅虎');
	$paramList->add(null);
	
	try
	{
		$bindTypes = 'isss';
		
		$bindTypesList = new ArrayList();
		for ($i = 0; $i < strlen($bindTypes); $i++)
		{
			$eachBindType = substr($bindTypes, $i, 1);
			/*
			echo $i . ':';
			echo 'substr: ' . $eachBindType . '<br/>';
			*/
			if (!($eachBindType == 'i' || $eachBindType == 'd' || $eachBindType == 's' || $eachBindType == 'b'))
			{
				throw new Exception ('Bind Type should be "i" - integer, "d" - double, "s" - string or "b" - blob!');
			}
			
			
			$bindTypesList->add($eachBindType);
		}
		
		// sql statement
		$sql = 'select * from cle_resource where sid = ? and URL = ? and ResourceName = ? and LastUpdate = ?';
		
		$result = true;
		$offset = 0;
		$findCount = 0;
		
		while (!is_bool(strpos($sql, '?', $offset)))
		{
			$find = strpos($sql, '?', $offset);
			
			$eachBindType = '';
			
			// bind type parameters
			if ($bindTypesList->hasNext())
			{
				$eachBindType = $bindTypesList->next();
			}
			else
			{
				throw new Exception('$bindTypesList overflow!');
			}
			
			// bind parameters
			if ($paramList->hasNext())
			{
				echo 'bind type: ' . $eachBindType;
				$param = $paramList->next();
				switch ($eachBindType)
				{
					case 'i':
						if (!is_null($param))
						{
							$sql = substr_replace($sql, $param , $find, 1);
						}
						else
						{
							$sql = substr_replace($sql, 'null' , $find, 1);							
						}
					break;
					case 'd':
						if (!is_null($param))
						{
							$sql = substr_replace($sql, $param , $find, 1);
						}
						else
						{
							$sql = substr_replace($sql, 'null' , $find, 1);							
						}		
					break;
					case 's':
						if (!is_null($param))
						{
							$sql = substr_replace($sql, "'" . $param . "'" , $find, 1);		
						}
						else
						{
							$sql = substr_replace($sql, 'null' , $find, 1);									
						}		
					break;
					case 'b':
						if (!is_null($param))
						{
							$sql = substr_replace($sql, "'" . $param . "'" , $find, 1);		
						}
						else
						{
							$sql = substr_replace($sql, 'null' , $find, 1);									
						}					
					break;
				}				
			}
			else
			{
				throw new Exception('$paramList overflow!');
			}
			
			if (!is_bool($find) && $find > 0)
			{
				echo ' ,pos: ' . $find . ', ';
				$findCount++;
			}
			
			$offset = $find + 1;

		}
		
		echo '<br/>' . 'findCount: ' . $findCount . '<br/>';
		echo 'replaced sql: ' . $sql . '<br/>';
		if ($findCount != strlen($bindTypes))
		{
			throw new Exception("Number of binding types do not match the number of input paramters!");
		}
		
	}
	catch (Exception $e)
	{
		echo 'Exception: ' . $e . '<br/>';
	}
	
//	echo 'strlen: '. strlen($sql) . '<br/>';
//	echo 'first position:' .  strpos($sql, '?', 73) . '<br/>';
//	echo 'is_int: ' . is_int(strpos($sql, '?', 73)) . '<br/>';
//	echo 'is_bool: ' . is_bool(strpos($sql, '?', 73)). '<br/>';
//	echo 'is_string: ' . is_string(strpos($sql, '?', 73)). '<br/>';
	
//	$var = 'ABCDEFGH:/MNRPQR/';
//	echo "Original: $var<hr />\n";
//	
//	/* These two examples replace all of $var with 'bob'. */
//	echo substr_replace($var, 'bob', 0) . "<br />\n";
//	echo substr_replace($var, 'bob', 0, strlen($var)) . "<br />\n";
//	
//	/* Insert 'bob' right at the beginning of $var. */
//	echo substr_replace($var, 'bob', 0, 0) . "<br />\n";
//	
//	/* These next two replace 'MNRPQR' in $var with 'bob'. */
//	echo substr_replace($var, 'bob', -10, -3) . "<br />\n";
//	echo substr_replace($var, 'bob', -7, -2) . "<br />\n";
//	
//	$foo = "0123456789a123456789b123456789c";
//	
//	var_dump(strrpos($foo, '7', -5));  // Starts looking backwards five positions
//									   // from the end. Result: int(17)
//	
//	var_dump(strrpos($foo, '7', 20));  // Starts searching 20 positions into the
//									   // string. Result: int(27)
//	
//	var_dump(strrpos($foo, '7', 28));  // Result: bool(false)
	
	
?>


</body>
</html>