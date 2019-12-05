<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/dao/ResourceDao.php';	
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	class ResourceMgr
	{
		private $resourceDao;
		public function __construct()
		{
			$this->resourceDao = new ResourceDao();
		}
		
		public function selectResource($_resourceFilter)
		{
			try
			{
				return $this->resourceDao->selectResource($_resourceFilter);
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}
		}
		
		public function insertResource($_resource)
		{
			try 
			{
				$result = $this->resourceDao->insertResource($_resource);
				
				$resource = new Resource();
				
				if (!is_null($result) && $result > 0)
				{
					$resourceFilter = new ResourceFilter();
					$resourceFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$resourceFilter->setOrderByList($orderBy);
					
					$resourceList = new ArrayList();
					$resourceList = $this->resourceDao->selectResource($resourceFilter);
					
					while($resourceList->hasNext())
					{
						$resourceTmp = new Resource();
						$resourceTmp = $resourceList->next();
					}
					
					$resource = $resourceTmp;
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $resource->printValues();

				$log->setLogDateTime(date('Y-m-d H:i:s:u') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
				$log->setLogModule('ResourceMgr.php-insertResource()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				return $resource;				
				
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ResourceMgr-insertResource()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		}
		
		public function deleteResource($_resourceFilter)
		{
			try 
			{
				return $this->resourceDao->deleteResource($_resourceFilter);
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e. '<br/>';
			}			
		}
		
		public function updateResource($_resource, $_resourceFilter)
		{
			try 
			{
				$result = $this->resourceDao->updateResource($_resource, $_resourceFilter);
				$resource = new Resource();
				
				if (!is_null($result) && $result > 0)
				{
					$resourceFilter = new ResourceFilter();
					$resourceFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$resourceFilter->setOrderByList($orderBy);
					
					$resourceList = new ArrayList();
					$resourceList = $this->resourceDao->selectResource($resourceFilter);
					
					while($resourceList->hasNext())
					{
						$resourceTmp = new Resource();
						$resourceTmp = $resourceList->next();
					}
					
					$resource = $resourceTmp;
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $resource->printValues();

				$log->setLogDateTime(date('Y-m-d H:i:s:u') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
				$log->setLogModule('ResourceMgr.php-updateResource()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				return $resource;					
				
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
	
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ResourceMgr.php-updateResource()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		}
		
		
	} // end ResourceMgr

?>