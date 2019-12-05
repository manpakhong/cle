<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/dao/system/ObjPageDao.php';
	require_once $currentDir . 'php/vo/system/ObjPageFilter.php';
	require_once $currentDir . 'php/vo/system/ObjPage.php';
		
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	class ObjPageMgr
	{
		private $objPageDao;
		
		public function __construct()
		{
			$this->objPageDao = new ObjPageDao();
		}
		
		public function selectObjPage($_objPageFilter)
		{
			try
			{
				return $this->objPageDao->selectObjPage($_objPageFilter);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ObjPageDao.php-selectObjPage()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		}
		
		public function insertObjPage($_objPage)
		{
			try 
			{
				$result = $this->objPageDao->insertObjPage($_objPage);
				
				$objPage = new ObjPage();
				
				if (!is_null($result) && $result > 0)
				{
					$objPageFilter = new ObjPageFilter();
					$objPageFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$objPageFilter->setOrderByList($orderBy);
					
					$objPageList = new ArrayList();
					$objPageList = $this->objPageDao->selectObjPage($objPageFilter);
					
					while($objPageList->hasNext())
					{
						$objPageTmp = new ObjPage();
						$objPageTmp = $objPageList->next();
					}
					
					$objPage = $objPageTmp;
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $objPage->printValues();

				$log->setLogDateTime(date('Y-m-d H:i:s:u') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
				$log->setLogModule('ObjPageMgr.php-insertObjPage()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				return $objPage;
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ObjPageMgr.php-insertObjPage()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		} // END insert
		
		public function updateObjPage($_objPage, $_objPageFilter)
		{
			try 
			{
				$result = $this->objPageDao->updateObjPage($_objPage, $_objPageFilter);
				
				$cm = new Cm();
				
				if (!is_null($result) && $result > 0)
				{
					$objPageFilter = new ObjPageFilter();
					$objPageFilter->setSid($result);
					$orderBy = new OrderBy();
					$orderBy->setField('sid');
					$orderBy->setIsAsc(true);					
					$objPageFilter->setOrderByList($orderBy);
					
					$objPageList = new ArrayList();
					$objPageList = $this->objPageDao->selectObjPage($objPageFilter);
					
					while($objPageList->hasNext())
					{
						$objPageTmp = new ObjPage();
						$objPageTmp = $objPageList->next();
					}
					
					$objPage = $objPageTmp;
					
				}
				
				// --- log
				$log = new Log();
				
				$logMessage = $objPage->printValues();

				$log->setLogDateTime(date('Y-m-d H:i:s:u') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
				$log->setLogModule('ObjPageMgr.php-updateObjPage()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				return $objPage;				
				
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
	
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ObjPageMgr.php-updateObjPage()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		} // end update
		
		public function deleteObjPage($_objPageFilter)
		{
			try 
			{
				return $this->objPageDao->deleteObjPage($_objPageFilter);
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
	
				$logMessage = "Exception: " . $e . "\n";
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ObjPageMgr.php-deleteObjPage()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}			
		} // end delete
		
		
	} // end class

?>