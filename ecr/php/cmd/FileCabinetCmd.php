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
	
	require_once $currentDir.'php/vo/FileCabinet.php' ;
	require_once $currentDir.'php/vo/FileCabinetFilter.php';
	require_once $currentDir.'php/service/FileCabinetMgr.php';
	
	require_once $currentDir. 'php/system/SystemValues.php';
	require_once $currentDir. 'php/cmd/system/DisplayLangCmd.php';
	
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';	
	
	$displayLangList = new ArrayList();
	$displayLangCmd = new DisplayLangCmd();
	$displayLangCmd->selectDisplayLangByObjPagePage('FileCabinetCmd.php');

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
			
		$fileCabinet = new FileCabinet();
		$fileCabinet->setSid($_POST["sid"]);
		$fileCabinet->setSeq($_POST["seq"]);
		$fileCabinet->setActivitySid($_POST["activitySid"]);
		$fileCabinet->setFileNameEn($_POST["fileNameEn"]);
		$fileCabinet->setFileNameTc($_POST["fileNameTc"]);
		$fileCabinet->setDescriptionEn($_POST["descriptionEn"]);
		$fileCabinet->setDescriptionTc($_POST["descriptionTc"]);
		$fileCabinet->setFileTypeSid($_POST["fileTypeSid"]);
		$fileCabinet->setFilePath($_POST["filePath"]);
		$fileCabinet->setIsShown($_POST["isShown"]);
		$fileCabinet->setRemarks($_POST["remarks"]);
		$fileCabinet->setFileDate($_POST["fileDate"]);
		$fileCabinet->setLastUpdate($_POST["lastUpdate"]);					
		
		// Activity
		
		$fileCabinet->setSidA($_POST['sidA']);
		$fileCabinet->setSeqA($_POST['seqA']);
		$fileCabinet->setActivityNameEnA($_POST['activityNameEnA']);
		$fileCabinet->setActivityNameTcA($_POST['activityNameTcA']);
		$fileCabinet->setContentEnA($_POST['contentEnA']);
		$fileCabinet->setContentTcA($_POST['contentTcA']);
		$fileCabinet->setContentHtmlEnA($_POST['contentHtmlEnA']);
		$fileCabinet->setContentHtmlTcA($_POST['contentHtmlTcA']);		
		$fileCabinet->setSpeakerEnA($_POST['speakerEnA']);
		$fileCabinet->setSpeakerTcA($_POST['speakerTcA']);
		$fileCabinet->setIsShownA($_POST['isShownA']);
		$fileCabinet->setActivityDateA($_POST['activityDateA']);
		$fileCabinet->setRemarksA($_POST['remarksA']);
		$fileCabinet->setLastUpdateA($_POST['lastUpdateA']);
		
		// FileType
		$fileCabinet->setSidT($_POST['sidT']);
		$fileCabinet->setFileTypeEnT($_POST['fileTypeEnT']);
		$fileCabinet->setFileTypeTcT($_POST['fileTypeTcT']);
		$fileCabinet->setRemarksT($_POST['remarksT']);
		$fileCabinet->setLastUpdateT($_POST['lastUpdateT']);		
		
		$isWildCard = $_POST["isWildCard"];			
		
		$fileCabinetCmd = new FileCabinetCmd();
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_SELECT)
		{
			// echo 'SystemParam::$CMD: ' . SystemParam::$CMD . '/' . 'SystemParam::$CMD_FLEX_SELECT_ALL: ' . SystemParam::$CMD_FLEX_SELECT_ALL. '<br/>' ;
			$fileCabinetList = new ArrayList();
			
			$fileCabinetFilter = new FileCabinetFilter();
			$fileCabinetFilter->setFilterByBaseObj($fileCabinet);
			$fileCabinetFilter->setIsWildCard($isWildCard);	
			
			$orderBy = new OrderBy();
			$orderBy->setField($fileCabinet->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$fileCabinetFilter->setOrderByList($orderBy);	
			
			// --- log
			$log = new Log();
			

			$logMessage = $fileCabinet->printValues() . "\n" . 'isWildCard: ' . $isWildCard . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('FileCabinetCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log					
			
			$fileCabinetList = $fileCabinetCmd->selectFileCabinet($fileCabinetFilter);
			
			$return = '';
			if ($fileCabinetList->size() > 0)
			{
				$return .= '<filecabinets>';
				
				
				while ($fileCabinetList->hasNext())
				{
					$fileCabinet = new FileCabinet();
					$fileCabinet = $fileCabinetList->next();
					
					$return .= '<filecabinet>' .
									'<sid>' . $fileCabinet->getSid() . '</sid>' .
									'<seq>' . $fileCabinet->getSeq() . '</seq>' .
									'<activitySid>' . $fileCabinet->getActivitySid() . '</activitySid>' .
									'<fileNameEn>' . $fileCabinet->getFileNameEn() . '</fileNameEn>' .
									'<fileNameTc>' . $fileCabinet->getFileNameTc() . '</fileNameTc>' .
									'<descriptionEn>' . $fileCabinet->getDescriptionEn() . '</descriptionEn>' .
									'<descriptionTc>' . $fileCabinet->getDescriptionTc() . '</descriptionTc>' .
									'<fileTypeSid>' . $fileCabinet->getFileTypeSid() . '</fileTypeSid>' .
									'<filePath>' . $fileCabinet->getfilePath() . '</filePath>' .
									'<isShown>' . $fileCabinet->getIsShown() . '</isShown>' .
									'<remarks>' . $fileCabinet->getRemarks() . '</remarks>' .
									'<fileDate>' . $fileCabinet->getFileDate() . '</fileDate>' .
									'<lastUpdate>' . $fileCabinet->getLastUpdate() . '</lastUpdate>' .
					
									
									'<sidA>' . $fileCabinet->getSidA() . '</sidA>' .
									'<seqA>' . $fileCabinet->getSeqA() . '</seqA>' .
									'<activityNameEnA>' . $fileCabinet->getActivityNameEnA() . '</activityNameEnA>' .
									'<activityNameTcA>' . $fileCabinet->getActivityNameTcA() . '</activityNameTcA>' .
									'<contentEnA>' . (!is_null($fileCabinet->getContentEnA()) ? base64_encode($fileCabinet->getContentEnA()) : '') . '</contentEnA>' .
									'<contentTcA>' . (!is_null($fileCabinet->getContentTcA()) ? base64_encode($fileCabinet->getContentTcA()) : '') . '</contentTcA>' .
									'<contentHtmlEnA>' . (!is_null($fileCabinet->getContentHtmlEnA()) ? base64_encode($fileCabinet->getContentHtmlEnA()) : '') . '</contentHtmlEnA>' .
									'<contentHtmlTcA>' . (!is_null($fileCabinet->getContentHtmlTcA()) ? base64_encode($fileCabinet->getContentHtmlTcA()) : '') . '</contentHtmlTcA>' .					
									'<speakerEnA>' . $fileCabinet->getSpeakerEnA() . '</speakerEnA>' .
									'<speakerTcA>' . $fileCabinet->getSpeakerTcA() . '</speakerTcA>' .
									'<isShownA>' . $fileCabinet->getIsShownA() . '</isShownA>' .
									'<activityDateA>' . $fileCabinet->getActivityDateA() . '</activityDateA>' .
									'<remarksA>' . $fileCabinet->getRemarksA() . '</remarksA>' .
									'<lastUpdateA>' . $fileCabinet->getLastUpdateA(). '</lastUpdateA>' .
									
									'<sidT>' . $fileCabinet->getSidT() . '</sidT>' .
									'<fileTypeEnT>' . $fileCabinet->getFileTypeEnT() . '</fileTypeEnT>' .
									'<fileTypeTcT>' . $fileCabinet->getFileTypeTcT() . '</fileTypeTcT>' .
									'<fileTypeIconT>' . $fileCabinet->getFileTypeIconT() . '</fileTypeIconT>' .
									'<remarksT>' . $fileCabinet->getRemarksT() . '</remarksT>' .
									'<lastUpdateT>' . $fileCabinet->getLastUpdateT() . '</lastUpdateT>' .
									
									
								'</filecabinet>';
				} // end while ($fileCabinetList->hasNext())
				
				$return .= '</filecabinets>';
			}
			
			// --- log
			$log = new Log();
			

			$logMessage = 'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('FileCabinetCmd.php-SystemParam::$CMD_FLEX_SELECT-afterselect');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			print ($return);
		} // end SELECT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_INSERT)
		{

			// --- log
			$log = new Log();
			
			$logMessage = $fileCabinet->printValues() . "\n";
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('FileCabinetCmd.php-SystemParam::$CMD_FLEX_INSERT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log	
			
			$fileCabinetFilter = new FileCabinetFilter();
			$fileCabinetFilter->setSid($fileCabinet->getSid());
			$fileCabinetFilter->setLastUpdate($fileCabinet->getLastUpdate());		
			
			$fileCabinetResult = new $fileCabinet();
			
			$fileCabinetResult = $fileCabinetCmd->insertFileCabinet($fileCabinet);
						
			$return = '<filecabinets>';
			
			if (!is_null($fileCabinetResult))
			{
				$return .= 	'<filecabinet>' .
								'<sid>' . $fileCabinetResult->getSid() . '</sid>' .
								'<seq>' . $fileCabinetResult->getSeq() . '</seq>' .
								'<activitySid>' . $fileCabinetResult->getActivitySid() . '</activitySid>' .
								'<fileNameEn>' . $fileCabinetResult->getFileNameEn() . '</fileNameEn>' .
								'<fileNameTc>' . $fileCabinetResult->getFileNameTc() . '</fileNameTc>' .
								'<descriptionEn>' . $fileCabinetResult->getDescriptionEn() . '</descriptionEn>' .
								'<descriptionTc>' . $fileCabinetResult->getDescriptionTc() . '</descriptionTc>' .
								'<fileTypeSid>' . $fileCabinetResult->getFileTypeSid() . '</fileTypeSid>' .
								'<filePath>' . $fileCabinetResult->getfilePath() . '</filePath>' .
								'<isShown>' . $fileCabinetResult->getIsShown() . '</isShown>' .
								'<remarks>' . $fileCabinetResult->getRemarks() . '</remarks>' .
								'<fileDate>' . $fileCabinetResult->getFileDate() . '</fileDate>' .
								'<lastUpdate>' . $fileCabinetResult->getLastUpdate() . '</lastUpdate>' .				
							'</filecabinet>';
			}
			$return .= '</filecabinets>';
			
			// --- log
			$log = new Log();
			

			$logMessage = $fileCabinetResult->printValues() . "\n" .
							'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('FileCabinetCmd.php-SystemParam::$CMD_FLEX_INSERT-afterinsert');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log			
			
			print($return);
		} // end CMD_FLEX_INSERT			
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_UPDATE)
		{

			// --- log
			$log = new Log();
			

			$logMessage = $fileCabinet->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('FileCabinetCmd.php-SystemParam::$CMD_FLEX_UPDATE-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log	
			
			$fileCabinetFilter = new FileCabinetFilter();
			$fileCabinetFilter->setSid($fileCabinet->getSid());
			$fileCabinetFilter->setLastUpdate($fileCabinet->getLastUpdate());		
			
			$fileCabinetResult = new $fileCabinet();
			
			$fileCabinetResult = $fileCabinetCmd->updateFileCabinet($fileCabinet, $fileCabinetFilter);
						
			$return = '<filecabinets>';
			
			if (!is_null($fileCabinetResult))
			{
				$return .= 	'<filecabinet>' .
								'<sid>' . $fileCabinetResult->getSid() . '</sid>' .
								'<seq>' . $fileCabinetResult->getSeq() . '</seq>' .
								'<activitySid>' . $fileCabinetResult->getActivitySid() . '</activitySid>' .
								'<fileNameEn>' . $fileCabinetResult->getFileNameEn() . '</fileNameEn>' .
								'<fileNameTc>' . $fileCabinetResult->getFileNameTc() . '</fileNameTc>' .
								'<descriptionEn>' . $fileCabinetResult->getDescriptionEn() . '</descriptionEn>' .
								'<descriptionTc>' . $fileCabinetResult->getDescriptionTc() . '</descriptionTc>' .
								'<fileTypeSid>' . $fileCabinetResult->getFileTypeSid() . '</fileTypeSid>' .
								'<filePath>' . $fileCabinetResult->getfilePath() . '</filePath>' .
								'<isShown>' . $fileCabinetResult->getIsShown() . '</isShown>' .
								'<remarks>' . $fileCabinetResult->getRemarks() . '</remarks>' .
								'<fileDate>' . $fileCabinetResult->getFileDate() . '</fileDate>' .
								'<lastUpdate>' . $fileCabinetResult->getLastUpdate() . '</lastUpdate>' .				
							'</filecabinet>';
			}
			$return .= '</filecabinets>';
			
			// --- log
			$log = new Log();
			

			$logMessage = $fileCabinetResult->printValues() . "\n" .
							'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('FileCabinetCmd.php-SystemParam::$CMD_FLEX_UPDATE-afterupdate');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log			
			
			print($return);
		} // end UPDATE		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_DELETE)
		{
			// --- log
			$log = new Log();
			

			$logMessage = $fileCabinet->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('FileCabinetCmd.php-SystemParam::$CMD_FLEX_DELETE-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log
			
			$fileCabinetFilter = new FileCabinetFilter();
			$fileCabinetFilter->setSid($fileCabinet->getSid());
			$fileCabinetFilter->setLastUpdate($fileCabinet->getLastUpdate());		
			
			$fileCabinetResult = new $fileCabinet();
			
			$fileCabinetResult = $fileCabinetCmd->deleteFileCabinet($fileCabinetFilter);

			
			if ($fileCabinetResult > 0)
			{
				$return .= 	'<filecabinets>' .
							'<filecabinet>' .
								'<sid>' . '</sid>' .
								'<seq>' . '</seq>' .
								'<activitySid>' . '</activitySid>' .
								'<fileNameEn>'  . '</fileNameEn>' .
								'<fileNameTc>' . '</fileNameTc>' .
								'<descriptionEn>'  . '</descriptionEn>' .
								'<descriptionTc>'  . '</descriptionTc>' .
								'<fileTypeSid>'  . '</fileTypeSid>' .
								'<filePath>'  . '</filePath>' .
								'<isShown>'  . '</isShown>' .
								'<remarks>'  . '</remarks>' .
								'<fileDate>'  . '</fileDate>' .
								'<lastUpdate>'  . '</lastUpdate>' .				
							'</filecabinet>' .
							'</filecabinets>';
			}			
			// --- log
			$log = new Log();
			

			$logMessage = 'delete record(s): ' . $fileCabinetResult . "\n" .
							'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('FileCabinetCmd.php-SystemParam::$CMD_FLEX_DELETE-afterupdate');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log			
			
			print($return);
		}
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_SELECT )
		{
			$fileCabinetList = new ArrayList();
						
			$fileCabinetFilter = new FileCabinetFilter();
			$orderBy = new OrderBy();
			$orderBy->setField($fileCabinet->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$fileCabinetFilter->setOrderByList($orderBy);				
			
			$fileCabinetList = $fileCabinetCmd->selectFileCabinet($fileCabinetFilter);
						
		} // end SELECT		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_INSERT)
		{
			$fileCabinetCmd->insertFileCabinet($fileCabinet);
		} // END INSERT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_UPDATE)
		{
			$fileCabinetFilter = new FileCabinetFilter();
			$filtCabinetFilter->setSid($fileCabinet->getSid());
			$filtCabinetFilter->setLastUpdate($fileCabinet->getLastUpdate());		
			
			$fileCabinetCmd->updateFileCabinet($fileCabinet, $fileCabinetFilter);
		} // end UPDATE
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_DELETE)
		{
			$fileCabinetFilter = new FileCabinetFilter();
			
			$fileCabinetCmd->deleteFileCabinet($fileCabinetFilter);
		} // end DELETE		
		
	} // end if (isset($_SESSION[UserParam::$USER])
	
	class FileCabinetCmd
	{
		private $fileCabinetMgr;
		private $fileCabinetList;
		
		public function __construct()
		{
			$this->fileCabinetMgr = new FileCabinetMgr();
			$this->fileCabinetList = new ArrayList();
		}
				
		public function selectAllFileCabinet($_fileCabinetfilter)
		{
			$fileCabinetList = new ArrayList();
			$fileCabinetList = $this->fileCabinetMgr->selectFileCabinet($_fileCabinetFilter);
			
			$this->fileCabinetList = $fileCabinetList;
			
			return $this->fileCabinetList;			
		}
		public function selectFileCabinet($_fileCabinetFilter)
		{			
			$fileCabinetList = new ArrayList();
			$fileCabinetList = $this->fileCabinetMgr->selectFileCabinet($_fileCabinetFilter);
			
			$this->fileCabinetList = $fileCabinetList;
			
			return $this->fileCabinetList;
		}		
		public function insertFileCabinet($_fileCabinet)
		{
			return $this->fileCabinetMgr->insertFileCabinet($_fileCabinet);
		} // end insert
		public function updateFileCabinet($_fileCabinet, $_fileCabinetFilter)
		{
			return $this->fileCabinetMgr->updateFileCabinet($_fileCabinet, $_fileCabinetFilter);
		} // end update
		public function deleteFileCabinet($_fileCabinetFilter)
		{
			return $this->fileCabinetMgr->deleteFileCabinet($_fileCabinetFilter);
		} // end delete
				
	} // end class
?>	
