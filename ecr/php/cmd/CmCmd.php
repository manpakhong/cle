
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
	
	require_once $currentDir.'php/vo/Cm.php' ;
	require_once $currentDir.'php/vo/CmFilter.php';
	require_once $currentDir.'php/service/CmMgr.php';
	
	require_once $currentDir. 'php/system/SystemValues.php';
	require_once $currentDir. 'php/cmd/system/DisplayLangCmd.php';
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';

	
	$displayLangList = new ArrayList();
	$displayLangCmd = new DisplayLangCmd();
	$displayLangCmd->selectDisplayLangByObjPagePage('CmCmd.php');
	
	$systemValues = new SystemValues();

	if ($systemValues->getSystemStorageType() == SystemParam::$SYSTEM_VALUES_TYPE_SESSION)
	{
	    if(!isset($_SESSION))
	    {
	        session_start();
	    }
	}
	
	if (isset($_POST[SystemParam::$CMD]))
	{
		$cm = new Cm();
		
		$cm->setSid($_POST["sid"]);
		$cm->setObjPageSid($_POST["objPageSid"]);
		$cm->setContentEn($_POST["contentEn"]);
		$cm->setContentTc($_POST["contentTc"]);
		$cm->setContentHtmlEn($_POST["contentHtmlEn"]);
		$cm->setContentHtmlTc($_POST["contentHtmlTc"]);
		$cm->setRemarks($_POST["remarks"]);
		$cm->setLastUpdate($_POST["lastUpdate"]);
		$cm->setSidO($_POST["sidO"]);
		$cm->setPageO($_POST["pageO"]);
		$cm->setUrlO($_POST["urlO"]);
		$cm->setRemarksO($_POST["remarksO"]);
		$cm->setLastUpdateO($_POST["lastUpdateO"]);
		
		$isWildCard = $_POST["isWildCard"];
		
		$cmCmd = new CmCmd();
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_SELECT )
		{
			$cmList = new ArrayList();
						
			$cmFilter = new CmFilter();
						
			$orderBy = new OrderBy();
			$orderBy->setField($cm->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$cmFilter->setOrderByList($orderBy);				
			
			$cmList = $cmCmd->selectCm($cmFilter);
			
		} // end SELECT		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_SELECT )
		{
			$cmList = new ArrayList();
						
			$cmFilter = new CmFilter();
			$cmFilter->setIsWildCard($isWildCard);
			$cmFilter->setFilterByBaseObj($cm);			
			$orderBy = new OrderBy();
			$orderBy->setField($cm->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$cmFilter->setOrderByList($orderBy);				
			
			// --- log
			$log = new Log();
			

			$logMessage = $cm->printValues() . "\n" . 'isWildCard: ' . $isWildCard . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('CmCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$cmList = $cmCmd->selectCm($cmFilter);
			
			$return = '';
			if ($cmList->size() > 0)
			{
				$return .= '<cms>';
				
				
				while ($cmList->hasNext())
				{
					$cm = new Cm();
					$cm = $cmList->next();
					
					$return .= '<cm>' .
									'<sid>' . $cm->getSid() . '</sid>' .
									'<objPageSid>' . $cm->getObjPageSid() . '</objPageSid>' .
									'<contentEn>' . (!is_null($cm->getContentEn()) ? base64_encode($cm->getContentEn()): '') . '</contentEn>' .
									'<contentTc>' . (!is_null($cm->getContentTc()) ? base64_encode($cm->getContentTc()): '') . '</contentTc>' .
									'<contentHtmlEn>' . (!is_null($cm->getContentHtmlEn()) ? base64_encode($cm->getContentHtmlEn()) : '') . '</contentHtmlEn>' .
									'<contentHtmlTc>' . (!is_null($cm->getContentHtmlTc()) ? base64_encode($cm->getContentHtmlTc()) : '') . '</contentHtmlTc>' .
									'<remarks>' . $cm->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $cm->getLastUpdate(). '</lastUpdate>' .
									'<sidO>' . $cm->getSidO() . '</sidO>' .
									'<pageO>' . $cm->getPageO() . '</pageO>' .
									'<urlO>' . $cm->getUrlO() . '</urlO>' .
									'<remarksO>' . $cm->getRemarksO() . '</remarksO>' .
									'<lastUpdateO>' . $cm->getLastUpdateO() . '</lastUpdateO>' .
								'</cm>';
				} // end while ($cmList->hasNext())
				
				$return .= '</cms>';
			}
			
			// --- log
			$log = new Log();
			
			$logMessage = 'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('CmCmd-SystemParam::$CMD_FLEX_SELECT-afterselect');
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
			$log->setLogModule('CmCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$cmFilter = new CmFilter();
			$cmFilter->setSid($cm->getSid());
			$cmFilter->setLastUpdate($cm->getLastUpdate());		

			
			$cmResult = new Cm();			
			$cmResult = $cmCmd->updateCm($cm, $cmFilter);		

			$return = '';			
			
			if (!is_null($cmResult))
			{
					
				$return .= '<cms>' .
								'<cm>' .
									'<sid>' . $cmResult->getSid() . '</sid>' .
									'<objPageSid>' . $cmResult->getObjPageSid() . '</objPageSid>' .
									'<contentEn>' . (!is_null($cmResult->getContentEn()) ? base64_encode($cmResult->getContentEn()): '') . '</contentEn>' .
									'<contentTc>' . (!is_null($cmResult->getContentTc()) ? base64_encode($cmResult->getContentTc()): '') . '</contentTc>' .
									'<contentHtmlEn>' . (!is_null($cmResult->getContentHtmlEn()) ? base64_encode($cmResult->getContentHtmlEn()) : '') . '</contentHtmlEn>' .
									'<contentHtmlTc>' . (!is_null($cmResult->getContentHtmlTc()) ? base64_encode($cmResult->getContentHtmlTc()) : '') . '</contentHtmlTc>' .
									'<remarks>' . $cmResult->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $cmResult->getLastUpdate(). '</lastUpdate>' .
									'<sidO>' . $cmResult->getSidO() . '</sidO>' .
									'<pageO>' . $cmResult->getPageO() . '</pageO>' .
									'<urlO>' . $cmResult->getUrlO() . '</urlO>' .
									'<remarksO>' . $cmResult->getRemarksO() . '</remarksO>' .
									'<lastUpdateO>' . $cmResult->getLastUpdateO() . '</lastUpdateO>' .
								'</cm>' .
							'</cms>';
			} // if (!is_null($cmResult))

			// --- log
			$log = new Log();
			

			$logMessage = $return . "\n" . $cmResult->printValues() ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('CmCmd.php-SystemParam::$CMD_FLEX_UPDATE-after post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			
			print ($return);
		}		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_INSERT)
		{
			// --- log
			$log = new Log();
			

			$logMessage = $cm->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('CmCmd.php-SystemParam::$CMD_FLEX_INSERT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
						
			$cmResult = new Cm();			
			$cmResult = $cmCmd->insertCm($cm);		

			$return = '';			
			
			if (!is_null($cmResult))
			{
				$return .= '<cms>' .
								'<cm>' .
									'<sid>' . $cmResult->getSid() . '</sid>' .
									'<objPageSid>' . $cmResult->getObjPageSid() . '</objPageSid>' .
									'<contentEn>' . (!is_null($cmResult->getContentEn()) ? base64_encode($cmResult->getContentEn()): '') . '</contentEn>' .
									'<contentTc>' . (!is_null($cmResult->getContentTc()) ? base64_encode($cmResult->getContentTc()): '') . '</contentTc>' .
									'<contentHtmlEn>' . (!is_null($cmResult->getContentHtmlEn()) ? base64_encode($cmResult->getContentHtmlEn()) : '') . '</contentHtmlEn>' .
									'<contentHtmlTc>' . (!is_null($cmResult->getContentHtmlTc()) ? base64_encode($cmResult->getContentHtmlTc()) : '') . '</contentHtmlTc>' .
									'<remarks>' . $cmResult->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $cmResult->getLastUpdate(). '</lastUpdate>' .
									'<sidO>' . $cmResult->getSidO() . '</sidO>' .
									'<pageO>' . $cmResult->getPageO() . '</pageO>' .
									'<urlO>' . $cmResult->getUrlO() . '</urlO>' .
									'<remarksO>' . $cmResult->getRemarksO() . '</remarksO>' .
									'<lastUpdateO>' . $cmResult->getLastUpdateO() . '</lastUpdateO>' .
								'</cm>' .
							'</cms>';
			} // if (!is_null($typeResult))

			// --- log
			$log = new Log();
			
			$logMessage = $return . "\n" . $cmResult->printValues() ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('CmCmd.php-SystemParam::$CMD_FLEX_INSERT-after post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			print ($return);
		}
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_INSERT)
		{
			$cmCmd->insertCm($cm);
		} // END INSERT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_UPDATE)
		{
			$cmFilter = new CmFilter();
			$cmFilter->setSid($cm->getSid());
			$cmFilter->setLastUpdate($cm->getLastUpdate());		
			
			$cmCmd->updateCm($cm, $cmFilter);
		} // end UPDATE
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_DELETE)
		{
			$cmFilter = new CmFilter();
			
			$cmCmd->deleteCm($cmFilter);
		} // end DELETE
		
	} // end if (isset($_SESSION[UserParam::$USER])
	
	class CmCmd
	{
		private $cmMgr;
		private $cmList;
		
		public function __construct()
		{
			$this->cmMgr = new CmMgr();
			$this->cmList = new ArrayList();
		}
				
		
		public function selectCm($_cmFilter)
		{			
			$cmList = new ArrayList();
			$cmList = $this->cmMgr->selectCm($_cmFilter);
			
			$this->cmList = $cmList;
			
			return $this->cmList;
		}		
		public function insertCm($_cm)
		{
			return $this->cmMgr->insertCm($_cm);
		} // end insert
		public function updateCm($_cm, $_cmFilter)
		{
			return $this->cmMgr->updateCm($_cm, $_cmFilter);
		} // end update
		public function deleteCm($_cmFilter)
		{
			return $this->cmMgr->deleteCm($_cmFilter);
		} // end delete
				
	} // end class
?>	
