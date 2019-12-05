<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/dao/FileUploadDao.php';
	require_once $currentDir.'php/vo/FileCabinetFilter.php';
	require_once $currentDir.'php/vo/FileCabinet.php';	
	require_once $currentDir.'php/common/ArrayList.php';

	class FileUploadMgr
	{
		private $fileUploadDao;
		
		public function __construct()
		{
			$this->fileUploadDao = new FileUploadDao();
		}
		
		public function uploadFile($_fileCabinet, $_fileBit)
		{
			try
			{
				return $this->fileUploadDao->uploadFile($_fileCabinet, $_fileBit);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('FileUploadMgr.php-uploadFile()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log
			}
		} // end uploadFile
		
		public function downloadFile($_fileCabinetFilter)
		{/*
			try 
			{
				$result = $this->fileCabinetDao->insertFileCabinet($_fileCabinet);
				$fileCabinet = new FileCabinet();
				
				if (!is_null($result) && $result > 0)
				{
					$fileCabinetFilter = new FileCabinetFilter();
					$fileCabinetFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$fileCabinetFilter->setOrderByList($orderBy);
					
					$fileCabinetList = new ArrayList();
					$fileCabinetList = $this->fileCabinetDao->selectFileCabinet($fileCabinetFilter);
					
					while($fileCabinetList->hasNext())
					{
						$fileCabinetTemp = new FileCabinet();
						$fileCabinetTemp = $fileCabinetList->next();
					}
					
					$fileCabinet = $fileCabinetTemp;
					
				}
				
					// --- log
					$log = new Log();
					
					$logMessage = $fileCabinet->printValues();
	
					$log->setLogDateTime(date('Y-m-d H:i:s:u') );
					$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
					$log->setLogModule('FileCabinetMgr.php-updateFileCabinet()');
					$log->setLogMessage($logMessage);
					
					$logHandler = new LogHandler();
					$logHandler->checkNwriteLog($log);					
	
					// --- end log						
				
				return $fileCabinet;				
				
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('FileUploadMgr.php-downloadFile()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log
			}
			*/
		} // end downloadFile
	} // end class

?>