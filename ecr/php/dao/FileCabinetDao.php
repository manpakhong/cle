<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir.'php/common/system/Connection.php';
	require_once $currentDir.'php/common/ArrayList.php';
	require_once $currentDir.'php/vo/FileCabinet.php';
	require_once $currentDir.'php/vo/FileCabinetFilter.php';
	require_once $currentDir.'php/common/BindParam.php';
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';
	require_once $currentDir.'php/system/SysParams.php';

	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';	
	
	class FileCabinetDao
	{

		public function selectFileCabinet($_fileCabinetFilter)
		{
			try 
			{
				$select_sql = "select * from ecr_filecabinetvwr ";
				$fileCabinetFilter = new FileCabinetFilter();
				
				
				if (!is_null($_fileCabinetFilter))
				{
					$fileCabinetFilter = $_fileCabinetFilter;	
					$select_sql = $select_sql . $_fileCabinetFilter->getWhereClause();
					$select_sql .= $_fileCabinetFilter->getOrderByClause();
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysqli_query($conn, $statement);
	
				$fileCabinetList = new ArrayList();
				
				
				
				while ($result = mysqli_fetch_array($sql))
				{
					$fileCabinet = new FileCabinet();
					
					// FileCabinet
					$fileCabinet->setSid($result['sid']);
					$fileCabinet->setSeq($result['Seq']);
					$fileCabinet->setActivitySid($result['Activity_sid']);
					$fileCabinet->setFileNameEn($result['File_Name_En']);
					$fileCabinet->setFileNameTc($result['File_Name_Tc']);
					$fileCabinet->setDescriptionEn($result['Description_En']);
					$fileCabinet->setDescriptionTc($result['Description_Tc']);					
					$fileCabinet->setFilePath($result['File_Path']);
					$fileCabinet->setFileTypeSid($result['FileType_sid']);
					$fileCabinet->setIsShown($result['IsShown']);
					$fileCabinet->setRemarks($result['Remarks']);
					$fileCabinet->setFileDate($result['File_Date']);
					$fileCabinet->setLastUpdate($result['LastUpdate']);
					
					
					// Activity
					
// 					$fileCabinet->setSidA($result['sidA']);
// 					$fileCabinet->setSeqA($result['seqA']);
					$fileCabinet->setActivityNameEnA($result['Activity_Name_EnA']);
					$fileCabinet->setActivityNameTcA($result['Activity_Name_TcA']);
					$fileCabinet->setContentEnA($result['Content_EnA']);
					$fileCabinet->setContentTcA($result['Content_TcA']);
					$fileCabinet->setContentHtmlEnA($result['ContentHtml_EnA']);
					$fileCabinet->setContentHtmlTcA($result['ContentHtml_TcA']);					
					$fileCabinet->setSpeakerEnA($result['Speaker_EnA']);
					$fileCabinet->setSpeakerTcA($result['Speaker_TcA']);
					$fileCabinet->setIsShownA($result['IsShownA']);
					$fileCabinet->setActivityDateA($result['Activity_DateA']);
					$fileCabinet->setRemarksA($result['RemarksA']);
					$fileCabinet->setLastUpdateA($result['LastUpdateA']);
					
					// FileType
					$fileCabinet->setSidT($result['sidT']);
					$fileCabinet->setFileTypeEnT($result['File_Type_EnT']);
					$fileCabinet->setFileTypeTcT($result['File_Type_TcT']);
					$fileCabinet->setRemarksT($result['RemarksT']);
					$fileCabinet->setLastUpdateT($result['LastUpdateT']);
					
					// --- log
					$log = new Log();
					
					$logMessage = $fileCabinet->printValues();
	
					$log->setLogDateTime(date('Y-m-d H:i:s') );
					$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
					$log->setLogModule('FileCabinetDao.php-selectFileCabinet() - individual vo from list');
					$log->setLogMessage($logMessage);
					
					$logHandler = new LogHandler();
					$logHandler->checkNwriteLog($log);					
	
					// --- end log							
					
					
					// $resource->printValues();
															
					$fileCabinetList->add($fileCabinet);
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nreturn rows: " . $fileCabinetList->size();

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('FileCabinetDao.php-selectFileCabinet()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log							
			
				
				return $fileCabinetList;
					
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('FileCabinetDao.php-selectFileCabinet()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		} // end select
		
		public function insertFileCabinet($_fileCabinet)
		{
			try 
			{
				$insert_sql = 
				"insert into ecr_filecabinet" . 
				"(Seq, Activity_sid, File_Name_En, File_Name_Tc, Description_En, Description_Tc, " .
				"FileType_sid, File_Path, IsShown, Remarks, File_Date ". 
				") ".
				"values(" .
				"?,?,?,?,?,?,".
				"?,?,?,?,?".
				")";
				
				$fileCabinet = new FileCabinet();
				
				
				if (!is_null($_fileCabinet))
				{
					$fileCabinet = $_fileCabinet;
				}

				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'iissssisiss';
				$bindParamList = new ArrayList();
				$bindParamList->add($fileCabinet->getSeq());
				$bindParamList->add($fileCabinet->getActivitySid());
				$bindParamList->add($fileCabinet->getFileNameEn());
				$bindParamList->add($fileCabinet->getFileNameTc());
				$bindParamList->add($fileCabinet->getDescriptionEn());
				$bindParamList->add($fileCabinet->getDescriptionTc());
				$bindParamList->add($fileCabinet->getFileTypeSid());
				$bindParamList->add($fileCabinet->getFilePath());				
				$bindParamList->add($fileCabinet->getIsShown());
				$bindParamList->add($fileCabinet->getRemarks());
				$bindParamList->add($fileCabinet->getFileDate());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);

				// echo 'sql statement: ' . $statement . '<br/>';						

									
				$result = mysql_query($statement);			

				$lastInsertSid = 0;
				
				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nresult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('FileCabinetDao.php-insertFileCabinet()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log					
				
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
				$log->setLogModule('FileCabinetDao.php-insertFileCabinet()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		} // end insert		
		
		public function updateFileCabinet($_fileCabinet, $_fileCabinetFilter)
		{
			try 
			{
				$update_sql = 
				"update ecr_filecabinet ".
				"set Seq = ?, " .
				"Activity_sid = ?, ".
				"File_Name_En = ?, " .
				"File_Name_Tc = ?, " .
				"Description_En = ?, " .
				"Description_Tc = ?, " .
				"File_Path = ?, " .
				"FileType_sid = ?, " .
				"IsShown = ?, " .
				"Remarks = ?, " .
				"File_Date = ? , " .
				"LastUpdate = now() ";
								
				$fileCabinetFilter = new FileCabinetFilter();
				$fileCabinet = new FileCabinet();

				
				if (!is_null($_fileCabinet))
				{
					$fileCabinet = $_fileCabinet;
				}
				// concatnate where statement
				if (!is_null($_fileCabinetFilter))
				{
					$fileCabinetFilter = $_fileCabinetFilter;
					$update_sql .= $fileCabinetFilter->getWhereClause();
				}
								
				// echo "sql statement: " . $update_sql . "<br/>";

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'iisssssiiss';
				$bindParamList = new ArrayList();
				$bindParamList->add($fileCabinet->getSeq());
				$bindParamList->add($fileCabinet->getActivitySid());
				$bindParamList->add($fileCabinet->getFileNameEn());
				$bindParamList->add($fileCabinet->getFileNameTc());
				$bindParamList->add($fileCabinet->getDescriptionEn());
				$bindParamList->add($fileCabinet->getDescriptionTc());
				$bindParamList->add($fileCabinet->getFilePath());
				$bindParamList->add($fileCabinet->getFileTypeSid());
				$bindParamList->add($fileCabinet->getIsShown());
				$bindParamList->add($fileCabinet->getRemarks());
				$bindParamList->add($fileCabinet->getFileDate());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
								
				// echo 'Statement: ' . $statement. '<br/>';
				
				$result = mysql_query($statement);				
				
				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('FileCabinetDao.php-updateFileCabinet()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log
				if ($result > 0)
				{
					$result = $fileCabinet->getSid();
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
				$log->setLogModule('FileCabinetDao.php-updateFileCabinet()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		} // end update		
		
		public function deleteFileCabinet($_fileCabinetFilter)
		{
			try 
			{
				$delete_sql = "delete from ecr_filecabinet ";
				
				$fileCabinetFilter = new FileCabinetFilter();
				
				// concatnate where statement
				if (!is_null($_fileCabinetFilter))
				{
					$fileCabinetFilter = $_fileCabinetFilter;
					$delete_sql .= $fileCabinetFilter->getWhereClause();
				}
				else
				{
					throw new Exception('FileCabinetDao: $_fileCabinetFilter cannot be null at function deleteFiltCabinet!', 4002);
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
				$log->setLogModule('FileCabinetDao.php-deleteFileCabinet()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		} // end delete
		
	} // end class


?>