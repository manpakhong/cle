<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir.'php/common/system/Connection.php';
	require_once $currentDir.'php/common/ArrayList.php';
	require_once $currentDir.'php/vo/Cm.php';
	require_once $currentDir.'php/vo/CmFilter.php';	
	require_once $currentDir.'php/common/BindParam.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';
	
	class CmDao
	{
		public function selectCm($_cmFilter)
		{
			try 
			{
				$select_sql = "select * from ecr_cmvwr ";
				$cmFilter = new CmFilter();
				
				if (!is_null($_cmFilter))
				{
					$cmFilter = $_cmFilter;	
					$select_sql .= $cmFilter->getWhereClause();
					$select_sql .= $cmFilter->getOrderByClause();
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysqli_query($conn,$statement);
	
				// echo $statement;
				
				$cmList = new ArrayList();
				
				while ($result = mysqli_fetch_array($sql))
				{
					$cm = new Cm();
					
					// Cm
					$cm->setSid($result['sid']);
					$cm->setObjPageSid($result['ObjPage_sid']);
					$cm->setContentEn($result['Content_En']);
					$cm->setContentTc($result['Content_Tc']);
					$cm->setContentHtmlEn($result['ContentHtml_En']);
					$cm->setContentHtmlTc($result['ContentHtml_Tc']);
					$cm->setRemarks($result['Remarks']);
					$cm->setLastUpdate($result['LastUpdate']);
					
					// $type->printValues();
					
					// ObjPage
					$cm->setSidO($result['sidO']);
					$cm->setPageO($result['PageO']);
					$cm->setUrlO($result['urlO']);
					$cm->setRemarksO($result['RemarksO']);
					$cm->setLastUpdateO($result['LastUpdateO']);
					
					// --- log
					$log = new Log();
					
		
					$logMessage = $cm->printValues() . "\n";
					
					$log->setLogDateTime(date('Y-m-d H:i:s') );
					$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
					$log->setLogModule('CmDao.php-selectCm()-loop');
					$log->setLogMessage($logMessage);
					
					$logHandler = new LogHandler();
					$logHandler->checkNwriteLog($log);
					
					// --- end log						
					
					$cmList->add($cm);
					
				}
				
				// --- log
				$log = new Log();
				
	
				$logMessage = $statement . "\n" . "total records: " . $cmList->size();
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('CmDao.php-selectCm()-Sql');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
				
				return $cmList;
					
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('CmDao.php-selectCm-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
			}
		} // end select
		
		public function insertCm($_cm)
		{
			try 
			{
				$insert_sql = 
				"insert into ecr_cm " . 
				"(ObjPage_sid, Content_En, Content_Tc, " .
				"ContentHtml_En, ContentHtml_Tc, Remarks " . 
				") ".
				"values(" .
				"?,?,?,".
				"?,?,?" .
				")";
				
				$cm = new Cm();

				
				if (!is_null($_cm))
				{
					$cm = $_cm;
				}

				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'isssss';
				$bindParamList = new ArrayList();
				$bindParamList->add($cm->getObjPageSid());
				$bindParamList->add($cm->getContentEn());
				$bindParamList->add($cm->getContentTc());
				$bindParamList->add($cm->getContentHtmlEn());
				$bindParamList->add($cm->getContentHtmlTc());
				$bindParamList->add($cm->getRemarks());			
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);

				// $type->printValues();
				// echo 'sql statement: ' . $statement . '<br/>';						
				$result = mysql_query($statement);

				
				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('CmDao.php-insertCm()');
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
				$log->setLogModule('CmDao.php-insertCm-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log		
			}
		} // end insert		
		
		public function updateCm($_cm, $_cmFilter)
		{
			try 
			{
				$update_sql = 
				"update ecr_cm ". 
				"set " . 
				"ObjPage_sid = ?, ".
				"Content_En = ?, " .
				"Content_Tc = ?, " .
				"ContentHtml_En = ?, " .
				"ContentHtml_Tc = ?, " .
				"Remarks = ?, " .
				"LastUpdate = now() ";
				
				$cmFilter = new cmFilter();
				$cm = new Cm();

				
				if (!is_null($_cm))
				{
					$cm = $_cm;
				}
				// concatnate where statement
				if (!is_null($_cmFilter))
				{
					$cmFilter = $_cmFilter;
					$update_sql .= $cmFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'isssss';
				$bindParamList = new ArrayList();
				$bindParamList->add($cm->getObjPageSid());
				$bindParamList->add($cm->getContentEn());
				$bindParamList->add($cm->getContentTc());		
				$bindParamList->add($cm->getContentHtmlEn());	
				$bindParamList->add($cm->getContentHtmlTc());
				$bindParamList->add($cm->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				// echo 'Statement: ' . $statement. '<br/>';
				
				$result = mysql_query($statement);				

				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('CmDao.php-updateCm()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log				
				
				
				if ($result > 0)
				{
					$result = $cm->getSid();
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
				$log->setLogModule('CmDao.php-updateCm()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log		
			}
		} // end update		
		
		public function deleteCm($_cmFilter)
		{
			try 
			{
				$delete_sql = "delete from ecr_cm ";
				
				$cmFilter = new CmFilter();
				
				// concatnate where statement
				if (!is_null($_cmFilter))
				{
					$cmFilter = $_cmFilter;
					$delete_sql .= $cmFilter->getWhereClause();
				}
				else
				{
					throw new Exception('CmDao: $_cmFilter cannot be null at function deleteCm!', 4003);
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
				$log->setLogModule('CmDao.php-deleteCm()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log		
			}			
		} // end delete
		
	} // end class


?>