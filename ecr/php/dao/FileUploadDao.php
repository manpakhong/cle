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
	
	class FileUploadDao
	{

		public function uploadFile($_fileCabinet, $_fileBit)
		{
			try 
			{

				$fileCabinet = new FileCabinet();
				$fileCabinet = $_fileCabinet;
				
				$target_path = "../../pages/data/";
		
				// $target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
				$target_path .= 'test.dll'; //$fileCabinet->getFilePath();
				
				// echo 'target path: ' . $target_path . '<br/>';
				$result = 0;
				
				if(move_uploaded_file($_fileBit['tmp_name'], $target_path)) 
				{
				    echo "The file ".  basename($_fileBit['name']). 
				    " has been uploaded to " . $target_path;
				    $result = 1;
				} 
				else
				{
				    echo "There was an error uploading the file, please try again!";
				    $result = 0;
				}					

				
				// --- log
				$log = new Log();
				
				$logMessage = "file upload result: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_RESULT);
				$log->setLogModule('FileUploadDao.php-uploadFile()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log							
			
				
				return $result;
					
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('FileUploadDao.php-uploadFile()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		} // end uploadFile
		
		public function downloadfile($_fileCabinetFilter)
		{/*
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
			*/
		} // end downloadFile		
		
		
	} // end class


?>