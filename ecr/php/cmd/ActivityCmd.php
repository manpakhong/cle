
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
	
	require_once $currentDir.'php/vo/Activity.php' ;
	require_once $currentDir.'php/vo/ActivityFilter.php';
	require_once $currentDir.'php/service/ActivityMgr.php';
	
	require_once $currentDir. 'php/system/SystemValues.php';
	require_once $currentDir. 'php/cmd/system/DisplayLangCmd.php';
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';

	
	$displayLangList = new ArrayList();
	$displayLangCmd = new DisplayLangCmd();
	$displayLangCmd->selectDisplayLangByObjPagePage('ActivityCmd.php');

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
			
		$activity = new Activity();
		$activity->setSid($_POST["sid"]);
		$activity->setSeq($_POST["seq"]);
		$activity->setActivityNameEn($_POST["activityNameEn"]);
		$activity->setActivityNameTc($_POST["activityNameTc"]);
		$activity->setContentEn($_POST["contentEn"]);
		$activity->setContentTc($_POST["contentTc"]);
		$activity->setContentHtmlEn($_POST["contentHtmlEn"]);
		$activity->setContentHtmlTc($_POST["contentHtmlTc"]);		
		$activity->setSpeakerEn($_POST["speakerEn"]);
		$activity->setSpeakerTc($_POST["speakerTc"]);
		$activity->setIsShown($_POST["isShown"]);
		$activity->setActivityDate($_POST["activityDate"]);
		$activity->setActivityDateFrom($_POST["activityDateFrom"]);
		$activity->setActivityDateTo($_POST["activityDateTo"]);
		$activity->setRemarks($_POST["remarks"]);
		$activity->setLastUpdate($_POST["lastUpdate"]);					
		
		$isWildCard = $_POST["isWildCard"];		
		
		$activityCmd = new ActivityCmd();
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_SELECT )
		{
			$activityList = new ArrayList();
						
			$activityFilter = new ActivityFilter();
			
			$orderBy = new OrderBy();
			$orderBy->setField($activity->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$activityFilter->setOrderByList($orderBy);				
			
			$activityList = $activityCmd->selectActivity($activityFilter);
						
		} // end SELECT		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_SELECT )
		{
			$activityList = new ArrayList();
			$activityFilter = new ActivityFilter();
			$activityFilter->setFilterByBaseObj($activity);
			$activityFilter->setIsWildCard($isWildCard);			
			$orderBy = new OrderBy();
			$orderBy->setField($activity->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$activityFilter->setOrderByList($orderBy);				
			
			// --- log
			$log = new Log();
			

			$logMessage = $activity->printValues() . "\n" . 'isWildCard: ' . $isWildCard . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ActivityCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$activityList = $activityCmd->selectActivity($activityFilter);
			
			$return = '';
			if ($activityList->size() > 0)
			{
				$return .= '<activities>';
				
				
				while ($activityList->hasNext())
				{
					$activity = new Activity();
					$activity = $activityList->next();
					
					$return .= '<activity>' .
									'<sid>' . $activity->getSid() . '</sid>' .
									'<seq>' . $activity->getSeq() . '</seq>' .
									'<activityNameEn>' . $activity->getActivityNameEn() . '</activityNameEn>' .
									'<activityNameTc>' . $activity->getActivityNameTc() . '</activityNameTc>' .
									'<contentEn>' . (!is_null($activity->getContentEn()) ? base64_encode($activity->getContentEn()) : '') . '</contentEn>' .
									'<contentTc>' . (!is_null($activity->getContentTc()) ? base64_encode($activity->getContentTc()) : '') . '</contentTc>' .
					
									'<contentHtmlEn>' . (!is_null($activity->getContentHtmlEn()) ? base64_encode($activity->getContentHtmlEn()) : '') . '</contentHtmlEn>' .
									'<contentHtmlTc>' . (!is_null($activity->getContentHtmlTc()) ? base64_encode($activity->getContentHtmlTc()) : '') . '</contentHtmlTc>' .
									
									'<speakerEn>' . $activity->getSpeakerEn() . '</speakerEn>' .
									'<speakerTc>' . $activity->getSpeakerTc() . '</speakerTc>' .
									'<isShown>' . $activity->getIsShown() . '</isShown>' .
									'<activityDate>' . $activity->getActivityDate() . '</activityDate>' .
									'<remarks>' . $activity->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $activity->getLastUpdate(). '</lastUpdate>' .
								'</activity>';
				} // end while ($activityList->hasNext())
				
				$return .= '</activities>';
			}
			
			// --- log
			$log = new Log();
			

			$logMessage = 'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ActivityCmd.php-SystemParam::$CMD_FLEX_SELECT-afterselect');
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
			

			$logMessage = $activity->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ActivityCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$activityFilter = new ActivityFilter();
			$activityFilter->setSid($activity->getSid());
			$activityFilter->setLastUpdate($activity->getLastUpdate());		

			
			$activityResult = new Activity();			
			$activityResult = $activityCmd->updateActivity($activity, $activityFilter);		

			$return = '';			
			
			if (!is_null($activityResult))
			{
				$return .= '<activities>'.
					
					'<activity>' .
									'<sid>' . $activityResult->getSid() . '</sid>' .
									'<seq>' . $activityResult->getSeq() . '</seq>' .
									'<activityNameEn>' . $activityResult->getActivityNameEn() . '</activityNameEn>' .
									'<activityNameTc>' . $activityResult->getActivityNameTc() . '</activityNameTc>' .
									'<contentEn>' . base64_encode($activityResult->getContentEn()) . '</contentEn>' .
									'<contentTc>' . base64_encode($activityResult->getContentTc()) . '</contentTc>' .
									'<speakerEn>' . $activityResult->getSpeakerEn() . '</speakerEn>' .
									'<speakerTc>' . $activityResult->getSpeakerTc() . '</speakerTc>' .
									'<isShown>' . $activityResult->getIsShown() . '</isShown>' .
									'<activityDate>' . $activityResult->getActivityDate() . '</activityDate>' .
									'<remarks>' . $activityResult->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $activityResult->getLastUpdate(). '</lastUpdate>' .
								'</activity>';
				
				$return .= '</activities>';
			} // if (!is_null($activityResult))

			// --- log
			$log = new Log();
			

			$logMessage = $return . "\n" . $activityResult->printValues() ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ActivityCmd.php-SystemParam::$CMD_FLEX_UPDATE-after post values');
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
			

			$logMessage = $activity->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ActivityCmd.php-SystemParam::$CMD_FLEX_INSERT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
						
			$activityResult = new Activity();			
			$activityResult = $activityCmd->insertActivity($activity);		

			$return = '';			
			
			if (!is_null($activityResult))
			{
				$return .= '<activities>'.
					
					'<activity>' .
									'<sid>' . $activityResult->getSid() . '</sid>' .
									'<seq>' . $activityResult->getSeq() . '</seq>' .
									'<activityNameEn>' . $activityResult->getActivityNameEn() . '</activityNameEn>' .
									'<activityNameTc>' . $activityResult->getActivityNameTc() . '</activityNameTc>' .
									'<contentEn>' . base64_encode($activityResult->getContentEn()) . '</contentEn>' .
									'<contentTc>' . base64_encode($activityResult->getContentTc()) . '</contentTc>' .
									'<speakerEn>' . $activityResult->getSpeakerEn() . '</speakerEn>' .
									'<speakerTc>' . $activityResult->getSpeakerTc() . '</speakerTc>' .
									'<isShown>' . $activityResult->getIsShown() . '</isShown>' .
									'<activityDate>' . $activityResult->getActivityDate() . '</activityDate>' .
									'<remarks>' . $activityResult->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $activityResult->getLastUpdate(). '</lastUpdate>' .
								'</activity>';
				
				$return .= '</activities>';
			} // if (!is_null($activityList) > 0)

			// --- log
			$log = new Log();
			
			$logMessage = $return . "\n" . $activityResult->printValues() ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ActivityCmd.php-SystemParam::$CMD_FLEX_INSERT-after post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			
			print ($return);
		}
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_DELETE)
		{
			// --- log
			$log = new Log();
			

			$logMessage = $activity->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ActivityCmd.php-SystemParam::$CMD_FLEX_DELETE-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$activityFilter = new ActivityFilter();
			$activityFilter->setSid($activity->getSid());
			$activityFilter->setLastUpdate($activity->getLastUpdate());		

			
			$activityResult = new Activity();			
			$activityResult = $activityCmd->deleteActivity($activityFilter);		

			$return = '';			
			
			if ($activityResult > 0)
			{
				$return .= '<activities>'.
					
					'<activity>' .
									'<sid>'. '</sid>' .
									'<seq>' . '</seq>' .
									'<activityNameEn>' .  '</activityNameEn>' .
									'<activityNameTc>' .  '</activityNameTc>' .
									'<contentEn>'  . '</contentEn>' .
									'<contentTc>'  . '</contentTc>' .
									'<speakerEn>'  . '</speakerEn>' .
									'<speakerTc>'  . '</speakerTc>' .
									'<isShown>' . '</isShown>' .
									'<activityDate>' . '</activityDate>' .
									'<remarks>'  . '</remarks>' .
									'<lastUpdate>' . '</lastUpdate>' .
								'</activity>';
				
				$return .= '</activities>';
			} // if (!is_null($activityResult))

			// --- log
			$log = new Log();
			

			$logMessage = $return . "\n" . "deleted record: " . $activityResult . "\n" ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('ActivityCmd.php-SystemParam::$CMD_FLEX_DELETE-after post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			print ($return);			
		}
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_INSERT)
		{
			$activityCmd->insertActivity($activity);
		} // END INSERT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_UPDATE)
		{
			$activityFilter = new ActivityFilter();
			$activityFilter->setSid($activity->getSid());
			$activityFilter->setLastUpdate($activity->getLastUpdate());		
			
			$activityCmd->updateActivity($activity, $activityFilter);
		} // end UPDATE
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_DELETE)
		{
			$activityFilter = new ActivityFilter();
			
			$activityCmd->deleteActivity($activityFilter);
		} // end DELETE		
		
	} // end if (isset($_SESSION[UserParam::$USER])
	
	class ActivityCmd
	{
		private $activityMgr;
		private $activityList;
		
		public function __construct()
		{
			$this->activityMgr = new ActivityMgr();
			$this->activityList = new ArrayList();
		}
				
		
		public function selectActivity($_activityFilter)
		{			
			$activityList = new ArrayList();
			$activityList = $this->activityMgr->selectActivity($_activityFilter);
			
			$this->activityList = $activityList;
			
			return $this->activityList;
		}		
		public function insertActivity($_activity)
		{
			return $this->activityMgr->insertActivity($_activity);
		} // end insert
		public function updateActivity($_activity, $_activityFilter)
		{
			return $this->activityMgr->updateActivity($_activity, $_activityFilter);
		} // end update
		public function deleteActivity($_activityFilter)
		{
			return $this->activityMgr->deleteActivity($_activityFilter);
		} // end delete
				
	} // end class
?>	
