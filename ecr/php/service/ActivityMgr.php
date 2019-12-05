<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/dao/ActivityDao.php';	
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	class ActivityMgr
	{
		private $activityDao;
		
		public function __construct()
		{
			$this->activityDao = new ActivityDao();
		}
		
		public function selectActivity($_activityFilter)
		{
			try
			{
				return $this->activityDao->selectActivity($_activityFilter);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ActivityMgr.php-selectActivity()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		}
		
		public function insertActivity($_activity)
		{
			try 
			{
				$result = $this->activityDao->insertActivity($_activity);
				
				$activity = new Activity();
				
				if (!is_null($result) && $result > 0)
				{
					$activityFilter = new ActivityFilter();
					$activityFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$activityFilter->setOrderByList($orderBy);
					
					$activityList = new ArrayList();
					$activityList = $this->activityDao->selectActivity($activityFilter);
					
					while($activityList->hasNext())
					{
						$activityTmp = new Activity();
						$activityTmp = $activityList->next();
					}
					
					$activity = $activityTmp;
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $activity->printValues();

				$log->setLogDateTime(date('Y-m-d H:i:s:u') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
				$log->setLogModule('ActivityMgr.php-insertActivity()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				return $activity;
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ActivityMgr.php-insertActivity()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		} // END insert
		
		public function updateActivity($_activity, $_activityFilter)
		{
			try 
			{
				$result = $this->activityDao->updateActivity($_activity, $_activityFilter);
				
				$activity = new Activity();
				
				if (!is_null($result) && $result > 0)
				{
					$activityFilter = new ActivityFilter();
					$activityFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$activityFilter->setOrderByList($orderBy);
					
					$activityList = new ArrayList();
					$activityList = $this->activityDao->selectActivity($activityFilter);
					
					while($activityList->hasNext())
					{
						$activityTmp = new Activity();
						$activityTmp = $activityList->next();
					}
					
					$activity = $activityTmp;
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $activity->printValues();

				$log->setLogDateTime(date('Y-m-d H:i:s:u') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
				$log->setLogModule('ActivityMgr.php-updateActivity()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				return $activity;				
				
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
	
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ActivityMgr.php-updateActivity()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		}
		
		public function deleteActivity($_activityFilter)
		{
			try 
			{
				return $this->activityDao->deleteActivity($_activityFilter);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
	
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ActivityMgr.php-deleteActivity()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		}
		
		
	} // end class

?>