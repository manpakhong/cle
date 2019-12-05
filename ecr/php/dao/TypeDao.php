<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir.'php/common/system/Connection.php';
	require_once $currentDir.'php/common/ArrayList.php';
	require_once $currentDir.'php/vo/Type.php';
	require_once $currentDir.'php/vo/TypeFilter.php';	
	require_once $currentDir.'php/common/BindParam.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';
	
	class TypeDao
	{
		
		public function selectType($_typeFilter)
		{
			try 
			{
				$select_sql = "select * from ecr_type ";
				$typeFilter = new TypeFilter();
				
				if (!is_null($_typeFilter))
				{
					$typeFilter = $_typeFilter;	
					$select_sql .= $typeFilter->getWhereClause();
					$select_sql .= $typeFilter->getOrderByClause();
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysql_query($statement);
	
				// echo $statement;
				
				$typeList = new ArrayList();
				
				while ($result = mysql_fetch_array($sql))
				{
					$type = new type();
					
					$type->setSid($result['sid']);
					$type->setTypeEn($result['Type_En']);
					$type->setTypeTc($result['Type_Tc']);		
					$type->setRemarks($result['Remarks']);
					$type->setLastUpdate($result['LastUpdate']);
					
					// $type->printValues();
					
					// --- log
					$log = new Log();
					
		
					$logMessage = $type->printValues() . "\n";
					
					$log->setLogDateTime(date('Y-m-d H:i:s') );
					$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
					$log->setLogModule('TypeDao.php-selectType()-loop');
					$log->setLogMessage($logMessage);
					
					$logHandler = new LogHandler();
					$logHandler->checkNwriteLog($log);
					
					// --- end log						
					
					$typeList->add($type);
					
				}
				
				// --- log
				$log = new Log();
				
	
				$logMessage = $statement . "\n" . "total records: " . $typeList->size();
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('TypeDao.php-selectType()-Sql');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
				
				return $typeList;
					
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('TypeDao.php-selectType-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
			}
		} // end select
		
		public function insertType($_type)
		{
			try 
			{
				$insert_sql = 
				"insert into ecr_type " . 
				"(Type_En, Type_Tc, Remarks " . 
				") ".
				"values(" .
				"?,?,?,".
				")";
				
				$type = new type();

				
				if (!is_null($_type))
				{
					$type = $_type;
				}

				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'sss';
				$bindParamList = new ArrayList();
				$bindParamList->add($type->getTypeEn());
				$bindParamList->add($type->getTypeTc());
				$bindParamList->add($type->getRemarks());				
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);

				// $type->printValues();
				// echo 'sql statement: ' . $statement . '<br/>';						
				$result = mysql_query($statement);

				
				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('TypeDao.php-insertType()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				$lastInsertSid = 0;
				
				if ($result > 0)
				{
					$lastInsertSid = mysql_insert_id($conn);
				}
				return $lastInsertSid;				
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('TypeDao.php-insertType-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log		
			}
		} // end insert		
		
		public function updateType($_type, $_typeFilter)
		{
			try 
			{
				$update_sql = 
				"update ecr_type ". 
				"set " . 
				"Type_En = ?, ".
				"Type_Tc = ?, ".
				"Remarks = ?, " .
				"LastUpdate = now() ";
				
				$typeFilter = new TypeFilter();
				$type = new Type();

				
				if (!is_null($_type))
				{
					$type = $_type;
				}
				// concatnate where statement
				if (!is_null($_typeFilter))
				{
					$typeFilter = $_typeFilter;
					$update_sql .= $typeFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'sss';
				$bindParamList = new ArrayList();
				$bindParamList->add($type->getTypeEn());
				$bindParamList->add($type->getTypeTc());
				$bindParamList->add($type->getRemarks());		
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				// echo 'Statement: ' . $statement. '<br/>';
				
				$result = mysql_query($statement);				

				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('TypeDao.php-updateType()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log				
				
				
				if ($result > 0)
				{
					$result = $type->getSid();
				}
				
				return $result;
			}
			catch (Exception $e)
			{
				// --- log
				
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('TypeDao.php-updateType()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log		
			}
		} // end update		
		
		public function deleteType($_typeFilter)
		{
			try 
			{
				$delete_sql = "delete from ecr_type ";
				
				$typeFilter = new TypeFilter();
				
				// concatnate where statement
				if (!is_null($_typeFilter))
				{
					$typeFilter = $_typeFilter;
					$delete_sql .= $typeFilter->getWhereClause();
				}
				else
				{
					throw new Exception('typeDao: $_typeFilter cannot be null at function deleteType!', 4003);
				}

				// echo "sql statement: " . $delete_sql . "<br/>";
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $delete_sql);
				
				$result = mysql_query($statement);				
				
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e;
			}			
		} // end delete
		
	} // end class


?>