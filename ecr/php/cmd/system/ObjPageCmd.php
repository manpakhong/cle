<?php

	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/common/ArrayList.php';
	require_once $currentDir . 'php/common/system/Connection.php';

	require_once $currentDir . 'php/vo/OrderBy.php';	
	require_once $currentDir . 'php/common/BindParam.php';	

	require_once $currentDir.'php/system/SysParams.php';
	require_once $currentDir.'php/common/DialogBox.php';
	
	require_once $currentDir.'php/vo/system/ObjPage.php' ;
	require_once $currentDir.'php/vo/system/ObjPageFilter.php';
	require_once $currentDir.'php/service/system/ObjPageMgr.php';
	
	require_once $currentDir. 'php/system/SystemValues.php';
	require_once $currentDir. 'php/cmd/system/DisplayLangCmd.php';
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';

	$displayLangList = new ArrayList();
	$displayLangCmd = new DisplayLangCmd();
	$displayLangCmd->selectDisplayLangByObjPagePage('ObjPageCmd');
	
	$systemValues = new SystemValues();

	if ($systemValues->getSystemStorageType() == SystemParam::$SYSTEM_VALUES_TYPE_SESSION)
	{
		session_start();
	}
	
	
	if (isset($_POST[SystemParam::$CMD]))
	{		
		$objPage = new ObjPage();
		
		$objPage->setSid($_POST["sid"]);
		$objPage->setPage($_POST["page"]);
		$objPage->setUrl($_POST["url"]);
		$objPage->setRemarks($_POST["remarks"]);
		$objPage->setLastUpdate($_POST["lastUpdate"]);		
				
		$objPageCmd = new ObjPageCmd();
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_SELECT )
		{
			$objPageFilter = new ObjPageFilter();
			$objPageFilter->setSid($objPage->getSid());
			$orderBy = new OrderBy();
			$orderBy->setField($objPage->getDbFieldName('sid'));
			$objPageFilter->setOrderByList($orderBy);
			
			$result = $objPageCmd->selectObjPage($objPageFilter);
			
			if ($result > 0)
			{
				// doing something!
			}
			
		} // end SELECT		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_SELECT_ALL )
		{
			$objPageList = new ArrayList();
						
			$objPageFilter = new ObjPageFilter();
			$objPageFilter->setFilterByBaseObj($objPage);			
			$orderBy = new OrderBy();
			$orderBy->setField($objPage->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$objPageFilter->setOrderByList($orderBy);				
			
			// --- log
			$log = new Log();
			

			$logMessage = $objPage->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ObjPageCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$objPageList = $objPageCmd->selectObjPage($objPageFilter);
			
			$return = '';
			if ($objPageList->size() > 0)
			{
				$return .= '<objPages>';
				
				
				while ($objPageList->hasNext())
				{
					$objPage = new ObjPage();
					$objPage = $objPageList->next();
					
					$return .= '<objPage>' .
									'<sid>' . $objPage->getSid() . '</sid>' .
									'<page>' . $objPage->getPage() . '</page>' .
									'<url>' . $objPage->getUrl() . '</url>' .
									'<remarks>' . $objPage->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $objPage->getLastUpdate() . '</lastUpdate>' .
								'</objPage>';
				} // end while ($objPageList->hasNext())
				
				$return .= '</objPages>';
			}
			
			// --- log
			$log = new Log();
			
			$logMessage = 'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ObjPageCmd-SystemParam::$CMD_FLEX_SELECT-afterselect');
			$log->setLogMessage($logMessage);

			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			// --- end log				
			print ($return);
		} // end FLEX_SELECT			
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_SELECT )
		{
			$objPageList = new ArrayList();
						
			$objPageFilter = new ObjPageFilter();
			$objPageFilter->setFilterByBaseObj($objPage);			
			$orderBy = new OrderBy();
			$orderBy->setField($objPage->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$objPageFilter->setOrderByList($orderBy);				
			
			// --- log
			$log = new Log();
			

			$logMessage = $objPage->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ObjPageCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$objPageList = $objPageCmd->selectObjPage($objPageFilter);
			
			$return = '';
			if ($objPageList->size() > 0)
			{
				$return .= '<objPages>';
				
				
				while ($objPageList->hasNext())
				{
					$objPage = new ObjPage();
					$objPage = $objPageList->next();
					
					$return .= '<objPage>' .
									'<sid>' . $objPage->getSid() . '</sid>' .
									'<page>' . $objPage->getPage() . '</page>' .
									'<url>' . $objPage->getUrl() . '</url>' .
									'<remarks>' . $objPage->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $objPage->getLastUpdate() . '</lastUpdate>' .
								'</objPage>';
				} // end while ($objPageList->hasNext())
				
				$return .= '</objPages>';
			}
			
			// --- log
			$log = new Log();
			
			$logMessage = 'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ObjPageCmd-SystemParam::$CMD_FLEX_SELECT-afterselect');
			$log->setLogMessage($logMessage);

			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			// --- end log				
			print ($return);
		} // end FLEX_SELECT			
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_UPDATE )
		{
			// --- log
			$log = new Log();

			$logMessage = $cm->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ObjPageCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$objPageFilter = new ObjPageFilter();
			$objPageFilter->setSid($objPage->getSid());
			$objPageFilter->setLastUpdate($objPage->getLastUpdate());		

			
			$objPageResult = new ObjPage();			
			$objPageResult = $objPageCmd->updateObjPage($objPage, $objPageFilter);		

			$return = '';			
			
			if (!is_null($objPageResult))
			{
					
					$return .= '<objPages>' .
									'<objPage>' .
										'<sid>' . $objPageResult->getSid() . '</sid>' .
										'<page>' . $objPageResult->getPage() . '</page>' .
										'<url>' . $objPageResult->getUrl() . '</url>' .
										'<remarks>' . $objPageResult->getRemarks() . '</remarks>' .
										'<lastUpdate>' . $objPageResult->getLastUpdate() . '</lastUpdate>' .
									'</objPage>' . 
								'<objPages>';
			} // if (!is_null($objPageResult))

			// --- log
			$log = new Log();
			

			$logMessage = $return . "\n" . $objPageResult->printValues() ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ObjPageCmd.php-SystemParam::$CMD_FLEX_UPDATE-after post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			
			print ($return);
		} // end $CMD_FLEX_UPDATE		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_INSERT)
		{
			// --- log
			$log = new Log();
			

			$logMessage = $objPage->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ObjPageCmd.php-SystemParam::$CMD_FLEX_INSERT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
						
			$objPageResult = new ObjPage();			
			$objPageResult = $objPageCmd->insertCm($objPage);		

			$return = '';			
			
			if (!is_null($objPageResult))
			{
					$return .= '<objPages>' .
									'<objPage>' .
										'<sid>' . $objPageResult->getSid() . '</sid>' .
										'<page>' . $objPageResult->getPage() . '</page>' .
										'<url>' . $objPageResult->getUrl() . '</url>' .
										'<remarks>' . $objPageResult->getRemarks() . '</remarks>' .
										'<lastUpdate>' . $objPageResult->getLastUpdate() . '</lastUpdate>' .
									'</objPage>' . 
								'<objPages>';
			} // if (!is_null($objPageResult))

			// --- log
			$log = new Log();
			
			$logMessage = $return . "\n" . $objPageResult->printValues() ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ObjPageCmd.php-SystemParam::$CMD_FLEX_INSERT-after post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			print ($return);
		} // end $CMD_FLEX_INSERT
		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_INSERT)
		{
			$objPageCmd->insertObjPage($objPage);	

		} // END INSERT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_UPDATE)
		{
			$objPageFilter = new ObjPageFilter();
			$objPageFilter->setSid($objPage->getSid());
			$objPageFilter->setLastUpdate($objPage->getLastUpdate());
			$orderBy = new OrderBy();
			$orderBy->setField($objPage->getDbFieldName('sid'));
			$objPageFilter->setOrderByList($orderBy);
			
			
			$objPageCmd->updateObjPage($objPage, $objPageFilter);
		} // end UPDATE
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_DELETE)
		{
			$objPageFilter = new ObjPageFilter(); 
			$objPageFilter->setSid($objPage->getSid());
			
			$objPageCmd->deleteObjPage($objPageFilter);
		} // end DELETE			
		
	} // end if (isset($_SESSION[UserParam::$USER])
	
	class ObjPageCmd
	{
		private $objPageMgr;
		private $objPage;
		private $objPageList;
		private $systemValues;
		
		public function __construct()
		{
			$this->objPageMgr = new ObjPageMgr();
			$this->systemValues = new SystemValues();
		}
		
		public function selectObjPage($_objPageFilter)
		{			
			$objPageList = new ArrayList();
			$objPageList = $this->objPageMgr->selectObjPage($_objPageFilter);
			
			$this->objPageList = $objPageList;
			
			return $this->objPageList;
		} // end select
		public function insertObjPage($_objPage)
		{
			return $this->objPageMgr->insertObjPage($_objPage);
		} // end insert
		public function updateObjPage($_objPage, $_objPageFilter)
		{
			return $this->objPageMgr->updateObjPage($_objPage, $_objPageFilter);
		} // end update
		public function deleteObjPage($_objPageFilter)
		{
			return $this->objPageMgr->deleteObjPage($_objPageFilter);
		} // end delete
				
	} // end class
?>