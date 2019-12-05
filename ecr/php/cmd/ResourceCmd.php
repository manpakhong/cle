
<?php

	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/common/ArrayList.php';
	include_once $currentDir . 'php/common/system/Connection.php';

	include_once $currentDir . 'php/vo/OrderBy.php';	
	include_once $currentDir . 'php/common/BindParam.php';	


	require_once $currentDir.'php/system/SysParams.php';
	require_once $currentDir.'php/common/DialogBox.php';
	
	require_once $currentDir.'php/vo/Resource.php' ;
	require_once $currentDir.'php/vo/ResourceFilter.php';
	require_once $currentDir.'php/service/ResourceMgr.php';
	
	require_once $currentDir. 'php/system/SystemValues.php';
	require_once $currentDir. 'php/cmd/system/DisplayLangCmd.php';
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';	
	
	$displayLangList = new ArrayList();
	$displayLangCmd = new DisplayLangCmd();
	$displayLangCmd->selectDisplayLangByObjPagePage('ResourceCmd.php');

	$systemValues = new SystemValues();

	if ($systemValues->getSystemStorageType() == SystemParam::$SYSTEM_VALUES_TYPE_SESSION)
	{
		session_start();
	}	
	
	
	if (isset($_POST[SystemParam::$CMD]))
	{
			
		$resource = new Resource();
		// resource
		$resource->setSid($_POST["sid"]);
		$resource->setUrl($_POST["url"]);
		$resource->setResourceNameEn($_POST["resourceNameEn"]);
		$resource->setResourceNameTc($_POST["resourceNameTc"]);
		$resource->setAuthorEn($_POST["authorEn"]);
		$resource->setAuthorTc($_POST["authorTc"]);
		$resource->setBriefingEn($_POST["briefingEn"]);
		$resource->setBriefingTc($_POST["briefingTc"]);
		$resource->setBriefingHtmlEn($_POST["briefingHtmlEn"]);
		$resource->setBriefingHtmlTc($_POST["briefingHtmlTc"]);		
		$resource->setTypeMenuSid($_POST["typeMenuSid"]);	
		$resource->setTypeSid($_POST["typeSid"]);		
		$resource->setImageUrl($_POST["imageUrl"]);
		$resource->setIsShown($_POST["isShown"]);
		$resource->setRemarks($_POST["remarks"]);
		$resource->setLastUpdate($_POST["lastUpdate"]);				
		
		// menutype
		$resource->setSidM($_POST["sidM"]);
		$resource->setSeqM($_POST["seqM"]);
		$resource->setLvM($_POST["lvM"]);
		$resource->setLvTextEnM($_POST["lvTextEnM"]);
		$resource->setLvTextTcM($_POST["lvTextTcM"]);
		$resource->setUpLvSidM($_POST["upLvSidM"]);
		$resource->setIsShownM($_POST["isShownM"]);
		$resource->setIsNetvigatedM($_POST["isNetvigatedM"]);
		$resource->setUrlM($_POST["urlM"]);
		$resource->setRemarksM($_POST["remarksM"]);
		$resource->setLastUpdateM($_POST["lastUpdateM"]);
		
		// type
		$resource->setSidT($_POST["sidT"]);
		$resource->setTypeEnT($_POST["typeEnT"]);
		$resource->setTypeTcT($_POST["typeTcT"]);
		$resource->setRemarksT($_POST["remarksT"]);
		$resource->setLastUpdateT($_POST["lastUpdateT"]);
		
		$isWildCard = $_POST["isWildCard"];			
		
		$resourceCmd = new ResourceCmd();
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_SELECT )
		{
			$resourceList = new ArrayList();
						
			$resourceFilter = new ResourceFilter();
			$resourceFilter->setFilterByBaseObj($resource);	
			$resourceFilter->setIsWildCard($isWildCard);						
			$orderBy = new OrderBy();
			$orderBy->setField($resource->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$resourceFilter->setOrderByList($orderBy);				
			
			// --- log
			$log = new Log();
			

			$logMessage = $resource->printValues() . "\n". 'isWildCard: ' . $isWildCard . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ResourceCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$resourceList = $resourceCmd->selectResource($resourceFilter);
			
			$return = '';
			if ($resourceList->size() > 0)
			{
				$return .= '<resources>';
				
				
				while ($resourceList->hasNext())
				{
					$resource = new Resource();
					$resource = $resourceList->next();
					
					$return .= '<resource>' .
									// resource
									'<sid>' . $resource->getSid() . '</sid>' .
									'<seq>' . $resource->getSeq() . '</seq>' .
									'<url>' . $resource->getUrl() . '</url>' .
									'<resourceNameEn>' . $resource->getResourceNameEn() . '</resourceNameEn>' .
									'<resourceNameTc>' . $resource->getResourceNameTc() . '</resourceNameTc>' .
									'<authorEn>' . $resource->getAuthorEn() . '</authorEn>' .
									'<authorTc>' . $resource->getAuthorTc() . '</authorTc>' .
									'<briefingEn>' . (!is_null($resource->getBriefingEn()) ? base64_encode($resource->getBriefingEn()) : '') . '</briefingEn>' .
									'<briefingTc>' . (!is_null($resource->getBriefingTc()) ? base64_encode($resource->getBriefingTc()) : ''). '</briefingTc>' .
									'<briefingHtmlEn>' . (!is_null($resource->getBriefingHtmlEn()) ? base64_encode($resource->getBriefingHtmlEn()) : '') . '</briefingHtmlEn>' .
									'<briefingHtmlTc>' . (!is_null($resource->getBriefingHtmlTc()) ? base64_encode($resource->getBriefingHtmlTc()) : '') . '</briefingHtmlTc>' .										
									'<typeMenuSid>' . $resource->getTypeMenuSid() . '</typeMenuSid>' .
									'<typeSid>' . $resource->getTypeSid() . '</typeSid>' .
									'<imageUrl>' . $resource->getImageUrl() . '</imageUrl>' .
									'<isShown>' . $resource->getIsShown() . '</isShown>' .
									'<remarks>' . $resource->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $resource->getLastUpdate(). '</lastUpdate>' .
					
									// menutype
									'<sidM>' . $resource->getSidM() . '</sidM>' .
									'<seqM>' . $resource->getSeqM() . '</seqM>' .
									'<lvM>' . $resource->getLvM() . '</lvM>' .
									'<lvTextEnM>' . $resource->getLvTextEnM() . '</lvTextEnM>' .
									'<lvTextTcM>' . $resource->getLvTextTcM() . '</lvTextTcM>' .
									'<upLvSidM>' . $resource->getUpLvSidM() . '</upLvSidM>' .
									'<isShownM>' . $resource->getIsShownM() . '</isShownM>' .
									'<isNetvigatedM>' . $resource->getIsNetvigatedM() . '</isNetvigatedM>' .
									'<urlM>' . $resource->getUrlM() . '</urlM>' .
									'<remarksM>' . $resource->getRemarksM() . '</remarksM>' .
									'<lastUpdateM>' . $resource->getLastUpdateM() . '</lastUpdateM>' .
					
									// type
									'<sidT>' . $resource->getSidT() . '</sidT>' .
									'<typeEnT>' . $resource->getTypeEnT() . '</typeEnT>' .
									'<typeTcT>' . $resource->getTypeTcT() . '</typeTcT>' .
									'<remarksT>' . $resource->getRemarksT() . '</remarksT>' .
									'<lastUpdateT>' . $resource->getLastUpdateT() . '</lastUpdateT>' .
					
								'</resource>';
				} // end while ($resourceList->hasNext())
				
				$return .= '</resources>';
			}
			
			// --- log
			$log = new Log();
			

			$logMessage = 'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ResourceCmd.php-SystemParam::$CMD_FLEX_SELECT-afterselect');
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
			

			$logMessage = $resource->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ResourceCmd.php-SystemParam::$CMD_FLEX_UPDATE-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$resourceFilter = new ResourceFilter();
			$resourceFilter->setSid($resource->getSid());
			$resourceFilter->setLastUpdate($resource->getLastUpdate());		

			
			$resourceResult = new Resource();			
			$resourceResult = $resourceCmd->updateResource($resource, $resourceFilter);		

			$return = '';			
			
			if (!is_null($resourceResult))
			{
					$return .= '<resources>' .
								'<resource>' .
									'<sid>' . $resourceResult->getSid() . '</sid>' .
									'<seq>' . $resourceResult->getSeq() . '</seq>' .
									'<url>' . $resourceResult->getUrl() . '</url>' .
									'<resourceNameEn>' . $resourceResult->getResourceNameEn() . '</resourceNameEn>' .
									'<resourceNameTc>' . $resourceResult->getResourceNameTc() . '</resourceNameTc>' .
									'<authorEn>' . $resourceResult->getAuthorEn() . '</authorEn>' .
									'<authorTc>' . $resourceResult->getAuthorTc() . '</authorTc>' .
									'<briefingEn>' . (!is_null($resourceResult->getBriefingEn()) ? base64_encode($resourceResult->getBriefingEn()) : '') . '</briefingEn>' .
									'<briefingTc>' . (!is_null($resourceResult->getBriefingTc()) ? base64_encode($resourceResult->getBriefingTc()) : ''). '</briefingTc>' .
									'<briefingHtmlEn>' . (!is_null($resourceResult->getBriefingHtmlEn()) ? base64_encode($resourceResult->getBriefingHtmlEn()) : '') . '</briefingHtmlEn>' .
									'<briefingHtmlTc>' . (!is_null($resourceResult->getBriefingHtmlTc()) ? base64_encode($resourceResult->getBriefingHtmlTc()) : '') . '</briefingHtmlTc>' .						
									'<typeMenuSid>' . $resourceResult->getTypeMenuSid() . '</typeMenuSid>' .
									'<typeSid>' . $resourceResult->getTypeSid() . '</typeSid>' .
									'<imageUrl>' . $resourceResult->getImageUrl() . '</imageUrl>' .
									'<isShown>' . $resourceResult->getIsShown() . '</isShown>' .
									'<remarks>' . $resourceResult->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $resourceResult->getLastUpdate(). '</lastUpdate>' .
								'</resource>';
				
				$return .= '</resources>';
			} // if (!is_null($resourceResult))

			// --- log
			$log = new Log();
			

			$logMessage = $return . "\n" . $resourceResult->printValues() ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ResourceCmd.php-SystemParam::$CMD_FLEX_UPDATE-after post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			
			print ($return);
		} // end FLEX_UPDATE
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_DELETE )
		{
			
			// --- log
			$log = new Log();
			

			$logMessage = $resource->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ResourceCmd.php-SystemParam::$CMD_FLEX_DELETE-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$resourceFilter = new ResourceFilter();
			$resourceFilter->setSid($resource->getSid());
			$resourceFilter->setLastUpdate($resource->getLastUpdate());		

			
			$resourceResult = new Resource();			
			$resourceResult = $resourceCmd->deleteResource($resourceFilter);		

			$return = '';			
			
			if ($resourceResult > 0)
			{
					$return .= '<resources>' .
								'<resource>' .
									'<sid>' . '</sid>' .
									'<seq>' .  '</seq>' .
									'<url>' .  '</url>' .
									'<resourceNameEn>'  . '</resourceNameEn>' .
									'<resourceNameTc>'  . '</resourceNameTc>' .
									'<authorEn>'  . '</authorEn>' .
									'<authorTc>'  . '</authorTc>' .
									'<briefingEn>'  . '</briefingEn>' .
									'<briefingTc>'  . '</briefingTc>' .
									'<briefingHtmlEn>'  . '</briefingHtmlEn>' .
									'<briefingHtmlTc>'  . '</briefingHtmlTc>' .					
									'<typeMenuSid>'  . '</typeMenuSid>' .
									'<typeSid>'  . '</typeSid>' .
									'<imageUrl>'  . '</imageUrl>' .
									'<isShown>'  . '</isShown>' .
									'<remarks>'  . '</remarks>' .
									'<lastUpdate>' . '</lastUpdate>' .
								'</resource>';
				
				$return .= '</resources>';
			} // if (!is_null($resourceResult))

			// --- log
			$log = new Log();
			

			$logMessage = $return . "\n" . "deleted record: " . $resourceResult . "\n" ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ResourceCmd.php-SystemParam::$CMD_FLEX_DELETE-after post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			
			print ($return);
		} // end FLEX_DELETE
		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_INSERT)
		{
			// --- log
			$log = new Log();
			

			$logMessage = $resource->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ResourceCmd.php-SystemParam::$CMD_FLEX_INSERT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
						
			$resourceResult = new Resource();			
			$resourceResult = $resourceCmd->insertResource($resource);		

			$return = '';			
			
			if (!is_null($resourceResult))
			{
					$return .= '<resources>' .
								'<resource>' .
									'<sid>' . $resourceResult->getSid() . '</sid>' .
									'<seq>' . $resourceResult->getSeq() . '</seq>' .
									'<url>' . $resourceResult->getUrl() . '</url>' .
									'<resourceNameEn>' . $resourceResult->getResourceNameEn() . '</resourceNameEn>' .
									'<resourceNameTc>' . $resourceResult->getResourceNameTc() . '</resourceNameTc>' .
									'<authorEn>' . $resourceResult->getAuthorEn() . '</authorEn>' .
									'<authorTc>' . $resourceResult->getAuthorTc() . '</authorTc>' .
									'<briefingEn>' . $resourceResult->getBriefingEn() . '</briefingEn>' .
									'<briefingTc>' . $resourceResult->getBriefingTc() . '</briefingTc>' .
									'<briefingHtmlEn>' . $resourceResult->getBriefingHtmlEn() . '</briefingHtmlEn>' .
									'<briefingHtmlTc>' . $resourceResult->getBriefingHtmlTc() . '</briefingHtmlTc>' .					
									'<typeMenuSid>' . $resourceResult->getTypeMenuSid() . '</typeMenuSid>' .
									'<typeSid>' . $resourceResult->getTypeSid() . '</typeSid>' .
									'<imageUrl>' . $resourceResult->getImageUrl() . '</imageUrl>' .
									'<isShown>' . $resourceResult->getIsShown() . '</isShown>' .
									'<remarks>' . $resourceResult->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $resourceResult->getLastUpdate(). '</lastUpdate>' .
								'</resource>';
				$return .= '</resources>';
			} // if (!is_null($resourceResult))

			// --- log
			$log = new Log();
			
			$logMessage = $return . "\n" . $resourceResult->printValues() ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ResourceCmd.php-SystemParam::$CMD_FLEX_INSERT-after post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			
			print ($return);
		} // end FLEX_INSERT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_SELECT )
		{
			$resourceList = new ArrayList();
						
			$resourceFilter = new ResourceFilter();
			$resourceFilter->setTypeSid($resource->getTypeSid());
			$orderBy = new OrderBy();
			$orderBy->setField($ecrUser->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$resourceFilter->setOrderByList($orderBy);				
			
			$resourceList = $resourceCmd->selectResource($resourceFilter);
						
		} // end SELECT		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_INSERT)
		{
			$resourceCmd->insertResource($resource);	

		} // END INSERT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_UPDATE)
		{
			$resourceFilter = new ResourceFilter();
			$resourceFilter->setSid($resource->getSid());
			$resourceFilter->setLastUpdate($resource->getLastUpdate());		
			
			$resourceCmd->updateResource($resource, $resourceFilter);
		} // end UPDATE
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_DELETE)
		{
			$resourceFilter = new ResourceFilter();
			$resourceFilter->setTypeSid($resource->getTypeSid());
			
			$resourceCmd->deleteResource($resourceFilter);
		} // end DELETE		
		
	} // end if (isset($_SESSION[UserParam::$USER])
	
	class ResourceCmd
	{
		private $resourceMgr;
		private $resourceList;
		
		public function __construct()
		{
			$this->resourceMgr = new ResourceMgr();
			$this->resourceList = new ArrayList();
		}
				
		
		public function selectResource($_resourceFilter)
		{			
			$resourceList = new ArrayList();
			$resourceList = $this->resourceMgr->selectResource($_resourceFilter);
			
			$this->resourceList = $resourceList;
			
			return $this->resourceList;
		}		
		public function insertResource($_resource)
		{
			return $this->resourceMgr->insertResource($_resource);
		} // end insert
		public function updateResource($_resource, $_resourceFilter)
		{
			return $this->resourceMgr->updateResource($_resource, $_resourceFilter);
		} // end update
		public function deleteResource($_resourceFilter)
		{
			return $this->resourceMgr->deleteResource($_resourceFilter);
		} // end delete
				
	} // end class
?>	
