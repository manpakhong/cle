<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/dao/FileCabinetDao.php';
	require_once $currentDir.'php/vo/FileCabinetFilter.php';
	require_once $currentDir.'php/vo/FileCabinet.php';	
	require_once $currentDir.'php/common/ArrayList.php';

	class FileCabinetMgr
	{
		private $fileCabinetDao;
		
		public function __construct()
		{
			$this->fileCabinetDao = new FileCabinetDao();
		}
		
		public function selectFileCabinet($_fileCabinetFilter)
		{
			try
			{
				return $this->fileCabinetDao->selectFileCabinet($_fileCabinetFilter);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('FileCabinetMgr.php-selectFileCabinet()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log
			}
		}
		
		public function insertFileCabinet($_fileCabinet)
		{
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
				$log->setLogModule('FileCabinetMgr.php-insertFileCabinet()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log
			}
		}
		
		public function updateFileCabinet($_fileCabinet, $_fileCabinetFilter)
		{
			try 
			{
				$result = $this->fileCabinetDao->updateFileCabinet($_fileCabinet, $_fileCabinetFilter);
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
				$log->setLogModule('FileCabinetMgr.php-upateFileCabinet()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log
			}			
		}
		
		public function deleteFileCabinet($_fileCabinetFilter)
		{
			try 
			{
				return $this->fileCabinetDao->deleteFileCabinet($_fileCabinetFilter);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('FileCabinetMgr.php-deleteFileCabinet()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log
			}			
		}
		
		
	} // end class

?>