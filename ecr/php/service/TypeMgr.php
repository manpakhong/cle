<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/dao/TypeDao.php';	
	require_once $currentDir.'php/vo/system/Log.php';
	
	require_once $currentDir.'php/log/LogHandler.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	class TypeMgr
	{
		private $typeDao;
		
		public function __construct()
		{
			$this->typeDao = new TypeDao();
		}
		
		public function selectType($_typeFilter)
		{
			try
			{
				return $this->typeDao->selectType($_typeFilter);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('TypeMgr.php-selectType()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				// --- end log	
			}
		}
		
		public function insertType($_type)
		{
			try 
			{
				$result = $this->typeDao->insertType($_type);
				
				$type = new Type();
				
				if (!is_null($result) && $result > 0)
				{
					$typeFilter = new TypeFilter();
					$typeFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$typeFilter->setOrderByList($orderBy);
					
					$typeList = new ArrayList();
					$typeList = $this->typeDao->selectType($typeFilter);
					
					while($typeList->hasNext())
					{
						$typeTmp = new Type();
						$typeTmp = $typeList->next();
					}
					
					$type = $typeTmp;
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $type->printValues();

				$log->setLogDateTime(date('Y-m-d H:i:s:u') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
				$log->setLogModule('TypeMgr.php-insertType()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				return $type;
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ActivityMgr.php-insertType()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		} // END insert
		
		public function updateType($_type, $_typeFilter)
		{
			try 
			{
				$result = $this->typeDao->updateType($_type, $_typeFilter);
				
				$type = new Type();
				
				if (!is_null($result) && $result > 0)
				{
					$typeFilter = new TypeFilter();
					$typeFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$typeFilter->setOrderByList($orderBy);
					
					$typeFilter = new ArrayList();
					$typeFilter = $this->typeDao->selectType($typeFilter);
					
					while($typeList->hasNext())
					{
						$typeTmp = new Type();
						$typeTmp = $typeList->next();
					}
					
					$type = $typeTmp;
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $type->printValues();

				$log->setLogDateTime(date('Y-m-d H:i:s:u') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
				$log->setLogModule('TypeMgr.php-updateType()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				return $type;				
				
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
	
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('TypeMgr.php-updateType()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		} // end update
		
		public function deleteType($_typeFilter)
		{
			try 
			{
				return $this->typeDao->deleteType($_typeFilter);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
	
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('TypeMgr.php-deleteType()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		} // end delete
		
		
	} // end class

?>