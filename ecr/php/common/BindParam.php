<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	require_once( $currentDir.'php/common/ArrayList.php' );

	
	class BindParam 
	{
		public function __construct()
		{
			
		}
		
		public function preparedStatement($_bindTypes, $_bindParamList, $_sqlStatement)
		{
						
			try
			{
				if (!is_null($_bindTypes))
				{
					$bindTypes = $_bindTypes;
				}
				else
				{
					throw new Exception('$bindTypes must not be null!');
				}
				
				if (!is_null($_bindParamList))
				{
					$paramList = $_bindParamList;						
				}	
				else 
				{
					throw new Exception('$paramList must not be null!');					
				}			
				
				if (!is_null($_sqlStatement))
				{
					$sql = $_sqlStatement;				
				}	
				else 
				{
					throw new Exception('$_sqlStatement must not be null!');					
				}					
				


					
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
								
				$result = true;
				$offset = 0;
				$findCount = 0;
				
				$concateSql = $sql;
				
				while (!is_bool(strpos($concateSql, '?', $offset)))
				{
					$find = strpos($concateSql, '?', $offset);
					
					$eachBindType = '';
					
					// bind type parameters
					if ($bindTypesList->hasNext())
					{

						$eachBindType = $bindTypesList->next();
						// echo '$eachBindType: ' . $eachBindType . '<br/>';						
					}
					else
					{
						throw new Exception('$bindTypesList overflow!');
					}
					
					// bind parameters
					if ($paramList->hasNext())
					{

						//echo 'bind type: ' . $eachBindType;
						$param = $paramList->next();
						// echo '$param: ' . $param . '<br/>';
						// echo 'concateSql: ' . $concateSql. '<br/>';
						
						switch ($eachBindType)
						{
							case 'i':
								if (!is_null($param))
								{
									$concateSql = substr_replace($concateSql, $param , $find, 1);
								}
								else
								{
									$concateSql = substr_replace($concateSql, 'null' , $find, 1);							
								}
							break;
							case 'd':
								if (!is_null($param))
								{
									$concateSql = substr_replace($concateSql, $param , $find, 1);
								}
								else
								{
									$concateSql = substr_replace($concateSql, 'null' , $find, 1);							
								}		
							break;
							case 's':
								if (!is_null($param))
								{
									$concateSql = substr_replace($concateSql, "'" . $param . "'" , $find, 1);		
								}
								else
								{
									$concateSql = substr_replace($concateSql, 'null' , $find, 1);									
								}		
							break;
							case 'b':
								if (!is_null($param))
								{
									$concateSql = substr_replace($concateSql, "'" . $param . "'" , $find, 1);		
								}
								else
								{
									$concateSql = substr_replace($concateSql, 'null' , $find, 1);									
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
						// echo ' ,pos: ' . $find . ', ';
						$findCount++;
					}
					
					if (strpos($param, '?', 0) > 0)
					{
						$offset = $find + strlen($param) + 1;
					}					
					else 
					{
						$offset = $find + 1;
					}
				}
				
				//echo '<br/>' . 'findCount: ' . $findCount . '<br/>';
				//echo 'replaced sql: ' . $sql . '<br/>';
				if ($findCount != strlen($bindTypes))
				{
					throw new Exception("Number of binding types do not match the number of input paramters!");
				}
				
				
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}			

			return $concateSql;
		}
		
	}

?>