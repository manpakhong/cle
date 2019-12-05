<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/dao/CmDao.php';
	require_once $currentDir . 'php/vo/CmFilter.php';
	require_once $currentDir . 'php/vo/Cm.php';
		
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	class CmMgr
	{
		private $cmDao;
		
		public function __construct()
		{
			$this->cmDao = new CmDao();
		}
		
		public function selectCm($_cmFilter)
		{
			try
			{
				return $this->cmDao->selectCm($_cmFilter);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('CmDao.php-selectCm()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		}
		
		public function insertCm($_cm)
		{
			try 
			{
				$result = $this->cmDao->insertCm($_cm);
				
				$cm = new Cm();
				
				if (!is_null($result) && $result > 0)
				{
					$cmFilter = new CmFilter();
					$cmFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$cmFilter->setOrderByList($orderBy);
					
					$cmList = new ArrayList();
					$cmList = $this->cmDao->selectCm($cmFilter);
					
					while($cmList->hasNext())
					{
						$cmTmp = new Cm();
						$cmTmp = $cmList->next();
					}
					
					$cm = $cmTmp;
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $cm->printValues();

				$log->setLogDateTime(date('Y-m-d H:i:s:u') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
				$log->setLogModule('CmMgr.php-insertCm()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				return $cm;
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('CmMgr.php-insertCm()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		} // END insert
		
		public function updateCm($_cm, $_cmFilter)
		{
			try 
			{
				$result = $this->cmDao->updateCm($_cm, $_cmFilter);
				
				$cm = new Cm();
				
				if (!is_null($result) && $result > 0)
				{
					$cmFilter = new CmFilter();
					$cmFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$cmFilter->setOrderByList($orderBy);
					
					$cmList = new ArrayList();
					$cmList = $this->cmDao->selectCm($cmFilter);
					
					while($cmList->hasNext())
					{
						$cmTmp = new Cm();
						$cmTmp = $cmList->next();
					}
					
					$cm = $cmTmp;
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $cm->printValues();

				$log->setLogDateTime(date('Y-m-d H:i:s:u') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
				$log->setLogModule('CmMgr.php-updateCm()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				return $cm;				
				
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
	
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('CmMgr.php-updateCm()-Exception');
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
				return $this->cmDao->deleteCm($_cmFilter);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
	
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('CmMgr.php-deleteCm()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		} // end delete
		
		
	} // end class

?>