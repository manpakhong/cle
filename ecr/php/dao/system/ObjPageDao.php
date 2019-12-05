<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/common/ArrayList.php';
	require_once $currentDir . 'php/common/system/Connection.php';
	require_once $currentDir . 'php/vo/system/ObjPage.php';
	require_once $currentDir . 'php/vo/system/ObjPageFilter.php';
	require_once $currentDir . 'php/vo/OrderBy.php';	
	require_once $currentDir . 'php/common/BindParam.php';	

	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';	
	
	class ObjPageDao
	{
		public function selectObjPage($_objPageFilter)
		{
			try 
			{
				$select_sql = "select * from ecr_objpage ";
				$objPageFilter = new ObjPageFilter();
				
				if (!is_null($_objPageFilter))
				{
					$objPageFilter = $_objPageFilter;	
					$select_sql .= $objPageFilter->getWhereClause();
					$select_sql .= $objPageFilter->getOrderByClause();
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysqli_query($conn,$statement);
	
				// echo $statement;
				
				$objPageList = new ArrayList();
				
				while ($result = mysqli_fetch_array($sql))
				{
					$objPage = new ObjPage();
										
					// ObjPage
					$objPage->setSid($result['sid']);
					$objPage->setPage($result['Page']);
					$objPage->setUrl($result['url']);
					$objPage->setRemarks($result['Remarks']);
					$objPage->setLastUpdate($result['LastUpdate']);
					
					// --- log
					$log = new Log();
					
		
					$logMessage = $objPage->printValues() . "\n";
					
					$log->setLogDateTime(date('Y-m-d H:i:s') );
					$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
					$log->setLogModule('ObjPageDao.php-selectObjPage()-loop');
					$log->setLogMessage($logMessage);
					
					$logHandler = new LogHandler();
					$logHandler->checkNwriteLog($log);
					
					// --- end log						
					
					$objPageList->add($objPage);
					
				}
				
				// --- log
				$log = new Log();
				
	
				$logMessage = $statement . "\n" . "total records: " . $objPageList->size();
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('ObjPageDao.php-selectObjPage()-Sql');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
				
				return $objPageList;
					
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ObjPageDao.php-selectObjPage-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
			}
		} // end select
		
		public function insertObjPage($_objPage)
		{
			try 
			{
				$insert_sql = 
				"insert into ecr_objpage " . 
				"(Page, url, Remarks " .
				") ".
				"values(" .
				"?,?,? ".
				")";
				
				$objPage = new ObjPge();

				
				if (!is_null($_objPage))
				{
					$objPage = $_objPage;
				}

				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'sss';
				$bindParamList = new ArrayList();
				$bindParamList->add($objPage->getPage());
				$bindParamList->add($objPage->getUrl());
				$bindParamList->add($objPage->getRemarks());			
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);

				// $type->printValues();
				// echo 'sql statement: ' . $statement . '<br/>';						
				$result = mysql_query($statement);

				
				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('ObjPageDao.php-insertObjPage()');
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
				$log->setLogModule('ObjPageDao.php-insertObjPage-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log		
			}
		} // end insert		
		
		public function updateObjPage($_objPage, $_objPageFilter)
		{
			try 
			{
				$update_sql = 
				"update ecr_objpage ". 
				"set " . 
				"Page = ?, ".
				"url = ?, " .
				"Remarks = ?, " .
				"LastUpdate = now() ";
				
				$objPageFilter = new objPageFilter();
				$objPage = new ObjPage();

				
				if (!is_null($_objPage))
				{
					$objPage = $_objPage;
				}
				// concatnate where statement
				if (!is_null($_objPageFilter))
				{
					$objPageFilter = $_objPageFilter;
					$update_sql .= $objPageFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'sss';
				$bindParamList = new ArrayList();
				$bindParamList->add($objPage->getPage());
				$bindParamList->add($objPage->getUrl());
				$bindParamList->add($objPage->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				// echo 'Statement: ' . $statement. '<br/>';
				
				$result = mysql_query($statement);				

				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('ObjPageDao.php-updateObjPage()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log				
				
				
				if ($result > 0)
				{
					$result = $objPage->getSid();
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
				$log->setLogModule('ObjPageDao.php-updateObjPage()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log		
			}
		} // end update		
		
		public function deleteObjPage($_objPageFilter)
		{
			try 
			{
				$delete_sql = "delete from ecr_objpage ";
				
				$objPageFilter = new ObjPageFilter();
				
				// concatnate where statement
				if (!is_null($_objPageFilter))
				{
					$objPageFilter = $_objPageFilter;
					$delete_sql .= $objPageFilter->getWhereClause();
				}
				else
				{
					throw new Exception('ObjPageDao: $_objPageFilter cannot be null at function deleteObjPage!', 4003);
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
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ObjPageDao.php-deleteObjPage()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log		
			}			
		} // end delete
		
	} // end class


?>