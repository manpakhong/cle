<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir.'php/common/system/Connection.php';
	require_once $currentDir.'php/common/ArrayList.php';
	require_once $currentDir.'php/vo/Activity.php';
	require_once $currentDir.'php/vo/ActivityFilter.php';	
	require_once $currentDir.'php/common/BindParam.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';
	
	class ActivityDao
	{
		
		public function selectActivity($_activityFilter)
		{
			try 
			{
				$select_sql = "select * from ecr_activity ";
				$activityFilter = new ActivityFilter();
				
				if (!is_null($_activityFilter))
				{
					$activityFilter = $_activityFilter;	
					$select_sql .= $activityFilter->getWhereClause();
					$select_sql .= $activityFilter->getOrderByClause();
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysqli_query($conn, $statement);
	
				// echo $statement;
				
				$activityList = new ArrayList();
				
				while ($result = mysqli_fetch_array($sql))
				{
					$activity = new Activity();
					
					$activity->setSid($result['sid']);
					$activity->setSeq($result['Seq']);
					$activity->setActivityNameEn($result['Activity_Name_En']);					
					$activity->setActivityNameTc($result['Activity_Name_Tc']);
					$activity->setContentEn($result['Content_En']);					
					$activity->setContentTc($result['Content_Tc']);		
					$activity->setContentHtmlEn($result['ContentHtml_En']);
					$activity->setContentHtmlTc($result['ContentHtml_Tc']);			
					$activity->setSpeakerEn($result['Speaker_En']);
					$activity->setSpeakerTc($result['Speaker_Tc']);	
					$activity->setIsShown($result['IsShown']);
					$activity->setActivityDate($result['Activity_Date']);			
					$activity->setRemarks($result['Remarks']);
					$activity->setLastUpdate($result['LastUpdate']);
					
					// $activity->printValues();
					
					// --- log
					$log = new Log();
					
		
					$logMessage = $activity->printValues() . "\n";
					
					$log->setLogDateTime(date('Y-m-d H:i:s') );
					$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
					$log->setLogModule('ActivityDao.php-selectActivity()-loop');
					$log->setLogMessage($logMessage);
					
					$logHandler = new LogHandler();
					$logHandler->checkNwriteLog($log);
					
					// --- end log						
					
					$activityList->add($activity);
					
				}
				
				// --- log
				$log = new Log();
				
	
				$logMessage = $statement . "\n" . "total records: " . $activityList->size();
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('ActivityDao.php-selectActivity()-Sql');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
				
				return $activityList;
					
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ActivityDao.php-selectActivity()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
			}
		} // end select
		
		public function insertActivity($_activity)
		{
			try 
			{
				$insert_sql = 
				"insert into ecr_activity " . 
				"(Seq, Activity_Name_En, Activity_Name_Tc, Content_En, Content_Tc, " . 
				"ContentHtml_En, ContentHtml_Tc, Speaker_En, Speaker_Tc, IsShown, " .
				"Activity_Date, Remarks ". 
				") ".
				"values(" .
				"?,?,?,?,?,".
				"?,?,?,?,?,".
				"?,?".
				")";
				
				$activity = new Activity();

				
				if (!is_null($_activity))
				{
					$activity = $_activity;
				}

				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'issssssssiss';
				$bindParamList = new ArrayList();
				$bindParamList->add($activity->getSeq());
				$bindParamList->add($activity->getActivityNameEn());
				$bindParamList->add($activity->getActivityNameTc());
				$bindParamList->add($activity->getContentEn());
				$bindParamList->add($activity->getContentTc());
				$bindParamList->add($activity->getContentHtmlEn());
				$bindParamList->add($activity->getContentHtmlTc());				
				$bindParamList->add($activity->getSpeakerEn());
				$bindParamList->add($activity->getSpeakerTc());
				$bindParamList->add($activity->getIsShown());
				$bindParamList->add($activity->getActivityDate());
				$bindParamList->add($activity->getRemarks());				
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);

				// $activity->printValues();
				// echo 'sql statement: ' . $statement . '<br/>';						
				$result = mysql_query($statement);

				
				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('ActivityDao.php-insertActivity()');
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
				$log->setLogModule('ActivityDao.php-insertActivity()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		} // end insert		
		
		public function updateActivity($_activity, $_activityFilter)
		{
			try 
			{
				$update_sql = 
				"update ecr_activity ". 
				"set " . 
				"Seq = ?, ".
				"Activity_Name_En = ?, ".
				"Activity_Name_Tc = ?, " .
				"Content_En = ?, " .
				"Content_Tc = ?, " .
				"ContentHtml_En = ?, " .
				"ContentHtml_Tc = ?, " .
				"Speaker_En = ?, Speaker_Tc = ?, ". 
				"IsShown = ?, " .
				"Activity_Date = ?, Remarks = ?, " . 
				"LastUpdate = now() ";
				
				$activityFilter = new ActivityFilter();
				$activity = new Activity();

				
				if (!is_null($_activity))
				{
					$activity = $_activity;
				}
				// concatnate where statement
				if (!is_null($_activityFilter))
				{
					$activityFilter = $_activityFilter;
					$update_sql .= $activityFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'issssssssiss';
				$bindParamList = new ArrayList();
				$bindParamList->add($activity->getSeq());
				$bindParamList->add($activity->getActivityNameEn());
				$bindParamList->add($activity->getActivityNameTc());
				$bindParamList->add($activity->getContentEn());
				$bindParamList->add($activity->getContentTc());
				$bindParamList->add($activity->getContentHtmlEn());
				$bindParamList->add($activity->getContentHtmlTc());					
				$bindParamList->add($activity->getSpeakerEn());
				$bindParamList->add($activity->getSpeakerTc());
				$bindParamList->add($activity->getIsShown());
				$bindParamList->add($activity->getActivityDate());
				$bindParamList->add($activity->getRemarks());		
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				// echo 'Statement: ' . $statement. '<br/>';
				
				$result = mysql_query($statement);				

				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('ActivityDao.php-updateActivity()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log				
				
				
				if ($result > 0)
				{
					$result = $activity->getSid();
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
				$log->setLogModule('ActivityDao.php-updateActivity()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log		
			}
		} // end update		
		
		public function deleteActivity($_activityFilter)
		{
			try 
			{
				$delete_sql = "delete from ecr_activity ";
				
				$activityFilter = new ActivityFilter();
				
				// concatnate where statement
				if (!is_null($_activityFilter))
				{
					$activityFilter = $_activityFilter;
					$delete_sql .= $activityFilter->getWhereClause();
				}
				else
				{
					throw new Exception('ActivityDao: $_activityFilter cannot be null at function deleteActivity!', 4003);
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
				$log->setLogModule('ActivityDao.php-deleteActivity()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		} // end delete
		
	} // end class


?>