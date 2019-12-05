<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir.'php/common/system/Connection.php';
	require_once $currentDir.'php/common/ArrayList.php';
	require_once $currentDir.'php/vo/FileType.php';
	require_once $currentDir.'php/vo/FileTypeFilter.php';
	require_once $currentDir.'php/common/BindParam.php';

	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';	
	
	class FileTypeDao
	{
		
		public function selectFileType($_fileTypeFilter)
		{
			try 
			{
				$select_sql = "select * from ecr_filetype ";
				$_fileTypeFilter = new FileTypeFilter();
				
				if (!is_null($_fileTypeFilter))
				{
					$fileTypeFilter = $_fileTypeFilter;	
					$select_sql = $select_sql . $_fileTypeFilter->getWhereClause();
					$select_sql .= $_fileTypeFilter->getOrderByClause();
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysql_query($statement);
	
				$fileTypeList = new ArrayList();
				
				while ($result = mysql_fetch_array($sql))
				{
					$fileType = new FileType();
					
					$fileType->setSid($result['sid']);
					$fileType->setFileTypeEn($result['File_Type_En']);
					$fileType->setFileTypeTc($result['File_Type_Tc']);
					$fileType->setRemarks($result['Remarks']);
					$fileType->setLastUpdate($result['LastUpdate']);
					// $resource->printValues();
					
					// --- log
					$log = new Log();
					
		
					$logMessage = $fileType->printValues() . "\n";
					
					$log->setLogDateTime(date('Y-m-d H:i:s') );
					$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
					$log->setLogModule('FileTypeDao.php-selectFileType()-loop');
					$log->setLogMessage($logMessage);
					
					$logHandler = new LogHandler();
					$logHandler->checkNwriteLog($log);
					
					// --- end log							
					
					$fileTypeList->add($fileType);
					
				}
				
				// --- log
				$log = new Log();
				
	
				$logMessage = $statement . "\n" . "total records: " . $fileTypeList->size();
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('FileTypeDao.php-selectActivity()-Sql');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
				
				return $fileTypeList;
					
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('FileTypeDao.php-selectFileType()-Exception');
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
				"File_Path, IsShown, Remarks ". 
				") ".
				"values(" .
				"?,?,?,?,?,?,".
				"?,?,?".
				")";
				
				$fileCabinet = new FileCabinet();

				
				if (!is_null($_fileCabinet))
				{
					$fileCabinet = $_fileCabinet;
				}

				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'iissssis';
				$bindParamList = new ArrayList();
				$bindParamList->add($fileCabinet->getSeq());
				$bindParamList->add($fileCabinet->getActivitySid());
				$bindParamList->add($fileCabinet->getFileNameEn());
				$bindParamList->add($fileCabinet->getFileNameTc());
				$bindParamList->add($fileCabinet->getDescriptionEn());
				$bindParamList->add($fileCabinet->getDescriptionTc());
				$bindParamList->add($fileCabinet->getFilePath());
				$bindParamList->add($fileCabinet->getIsShown());
				$bindParamList->add($fileCabinet->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);

				$fileCabinet->printValues();
				// echo 'sql statement: ' . $statement . '<br/>';						
				$result = mysql_query($statement);			

				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('FileTypeDao.php-insertFileType()');
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
				$log->setLogModule('FileTypeDao.php-insertFileType()-Exception');
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
				"IsShown = ?, " .
				"Remarks = ?, " .
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
				$bindTypes = 'iissssis';
				$bindParamList = new ArrayList();
				$bindParamList->add($fileCabinet->getSeq());
				$bindParamList->add($fileCabinet->getActivitySid());
				$bindParamList->add($fileCabinet->getFileNameEn());
				$bindParamList->add($fileCabinet->getFileNameTc());
				$bindParamList->add($fileCabinet->getDescriptionEn());
				$bindParamList->add($fileCabinet->getDescriptionTc());
				$bindParamList->add($fileCabinet->getFilePath());
				$bindParamList->add($fileCabinet->getIsShown());
				$bindParamList->add($fileCabinet->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				// echo 'Statement: ' . $statement. '<br/>';
				
				$result = mysql_query($statement);				

				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('FileTypeDao.php-updateFileType()');
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
				$log->setLogModule('FileTypeDao.php-updateFileType()-Exception');
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
				$log->setLogModule('FileTypeDao.php-deleteFileType()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		} // end delete
		
	} // end class


?>