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
	
	require_once $currentDir.'php/vo/FileType.php' ;
	require_once $currentDir.'php/vo/FileTypeFilter.php';
	require_once $currentDir.'php/service/FileTypeMgr.php';
	
	require_once $currentDir. 'php/system/SystemValues.php';
	require_once $currentDir. 'php/cmd/system/DisplayLangCmd.php';
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';	
	
	$displayLangList = new ArrayList();
	$displayLangCmd = new DisplayLangCmd();
	$displayLangCmd->selectDisplayLangByObjPagePage('FileTypeCmd.php');

	$systemValues = new SystemValues();

	if ($systemValues->getSystemStorageType() == SystemParam::$SYSTEM_VALUES_TYPE_SESSION)
	{
		session_start();
	}	
		
	if (isset($_POST[SystemParam::$CMD]))
	{
			
		$fileType = new FileType();
		$fileType->setSid($_POST["sid"]);
		$fileType->setFileTypeEn($_POST["fileTypeEn"]);
		$fileType->setFileTypeTc($_POST["fileTypeTc"]);
		$fileType->setFileTypeIcon($_POST["fileTypeIcon"]);
		$fileType->setRemarks($_POST["remarks"]);
		$fileType->setLastUpdate($_POST["lastUpdate"]);
		
		$fileTypeCmd = new FileTypeCmd();
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_SELECT)
		{
			// echo 'SystemParam::$CMD: ' . SystemParam::$CMD . '/' . 'SystemParam::$CMD_FLEX_SELECT_ALL: ' . SystemParam::$CMD_FLEX_SELECT_ALL. '<br/>' ;
			$fileTypeList = new ArrayList();
			
			$fileTypeFilter = new FileTypeFilter();
			$fileTypeFilter->setFilterByBaseObj($fileType);
			$orderBy = new OrderBy();
			$orderBy->setField($fileTypeFilter->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$fileTypeFilter->setOrderByList($orderBy);	
			
			// --- log
			$log = new Log();
			

			$logMessage = $fileType->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('FileTypeCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log					
			
			$fileTypeList = $fileTypeCmd->selectFileType($fileTypeFilter);
			
			$return = '';
			if ($fileTypeList->size() > 0)
			{
				$return .= '<filetypes>';
				
				
				while ($fileTypeList->hasNext())
				{
					$fileType = new FileType();
					$fileType = $fileTypeList->next();
					
					$return .= '<filetype>' .
									'<sid>' . $fileType->getSid() . '</sid>' .
									'<fileTypeEn>' . $fileType->getFileTypeEn() . '</fileTypeEn>' .
									'<fileTypeTc>' . $fileType->getFileTypeTc() . '</fileTypeTc>' .
									'<fileTypeIcon>' . $fileType->getFileTypeIcon() . '</fileTypeIcon>' .
									'<remarks>' . $fileType->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $fileType->getLastUpdate() . '</lastUpdate>' .
								'</filetype>';
				} // end while ($fileTypeList->hasNext())
				
				$return .= '</filetypes>';
			}
			
			// --- log
			$log = new Log();
			

			$logMessage = 'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('FileTypeCmd.php-SystemParam::$CMD_FLEX_SELECT-afterselect');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			print ($return);
		} // end FLEX_SELECT_ALL		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_SELECT )
		{
			$fileTypeList = new ArrayList();
						
			$fileTypeFilter = new FileTypeFilter();
			$orderBy = new OrderBy();
			$orderBy->setField($activity->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$fileTypeFilter->setOrderByList($orderBy);				
			
			$fileTypeList = $fileTypeCmd->selectFileType($fileTypeFilter);
						
		} // end SELECT		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_INSERT)
		{
			$fileTypeCmd->insertFileType($fileType);
		} // END INSERT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_UPDATE)
		{
			$fileTypeFilter = new FileTypeFilter();
			$fileTypeFilter->setSid($fileType->getSid());
			$fileTypeFilter->setLastUpdate($fileType->getLastUpdate());		
			
			$fileTypeCmd->updateFileType($fileType, $fileTypeFilter);
		} // end UPDATE
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_DELETE)
		{
			$fileTypeFilter = new FileTypeFilter();
			
			$fileTypeCmd->deleteFileType($fileTypeFilter);
		} // end DELETE		
		
	} // end if (isset($_SESSION[UserParam::$USER])
	
	class FileTypeCmd
	{
		private $fileTypeMgr;
		private $fileTypeList;
		
		public function __construct()
		{
			$this->fileTypeMgr = new FileTypeMgr();
			$this->fileTypeList = new ArrayList();
		}
				
		
		public function selectFileType($_fileTypeFilter)
		{			
			$fileTypeList = new ArrayList();
			$fileTypeList = $this->fileTypeMgr->selectFileType($_fileTypeFilter);
			
			$this->fileTypeList = $fileTypeList;
			
			return $this->fileTypeList;
		}		
		public function insertFileType($_fileType)
		{
			return $this->fileTypeMgr->insertFileType($_fileType);
		} // end insert
		public function updateFileType($_fileType, $_fileTypeFilter)
		{
			return $this->fileTypeMgr->updateFileType($_fileType, $_fileTypeFilter);
		} // end update
		public function deleteFileType($_fileTypeFilter)
		{
			return $this->fileTypeMgr->deleteFileType($_fileTypeFilter);
		} // end delete
				
	} // end class

?>