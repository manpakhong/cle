
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
	
	require_once $currentDir.'php/vo/Type.php' ;
	require_once $currentDir.'php/vo/TypeFilter.php';
	require_once $currentDir.'php/service/TypeMgr.php';
	
	require_once $currentDir. 'php/system/SystemValues.php';
	require_once $currentDir. 'php/cmd/system/DisplayLangCmd.php';
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';

	
	$displayLangList = new ArrayList();
	$displayLangCmd = new DisplayLangCmd();
	$displayLangCmd->selectDisplayLangByObjPagePage('TypeCmd.php');
	
	$systemValues = new SystemValues();

	if ($systemValues->getSystemStorageType() == SystemParam::$SYSTEM_VALUES_TYPE_SESSION)
	{
		session_start();
	}	
	
	if (isset($_POST[SystemParam::$CMD]))
	{
			
		$type = new Type();
		$type->setSid($_POST["sid"]);
		$type->setTypeEn($_POST["typeEn"]);
		$type->setTypeTc($_POST["typeTc"]);
		$type->setRemarks($_POST["remarks"]);
		$type->setLastUpdate($_POST["lastUpdate"]);					
		
		
		$typeCmd = new TypeCmd();
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_SELECT )
		{
			$typeList = new ArrayList();
						
			$typeFilter = new TypeFilter();
						
			$orderBy = new OrderBy();
			$orderBy->setField($type->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$typeFilter->setOrderByList($orderBy);				
			
			$typeList = $typeCmd->selectType($typeFilter);
						
		} // end SELECT		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_FLEX_SELECT_ALL )
		{
			$typeList = new ArrayList();
						
			$typeFilter = new TypeFilter();
			$typeFilter->setFilterByBaseObj($type);			
			$orderBy = new OrderBy();
			$orderBy->setField($type->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$typeFilter->setOrderByList($orderBy);				
			
			// --- log
			$log = new Log();
			

			$logMessage = $type->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('TypeCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$typeList = $typeCmd->selectType($typeFilter);
			
			$return = '';
			if ($typeList->size() > 0)
			{
				$return .= '<types>';
				
				
				while ($typeList->hasNext())
				{
					$type = new Type();
					$type = $typeList->next();
					
					$return .= '<type>' .
									'<sid>' . $type->getSid() . '</sid>' .
									'<typeEn>' . $type->getTypeEn() . '</typeEn>' .
									'<typeTc>' . $type->getTypeTc() . '</typeTc>' .
									'<remarks>' . $type->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $type->getLastUpdate(). '</lastUpdate>' .
								'</type>';
				} // end while ($typeList->hasNext())
				
				$return .= '</types>';
			}
			
			// --- log
			$log = new Log();
			

			$logMessage = 'return xml: ' . $return . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('TypeCmd-SystemParam::$CMD_FLEX_SELECT-afterselect');
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
			

			$logMessage = $type->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('TypeCmd.php-SystemParam::$CMD_FLEX_SELECT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			$typeFilter = new TypeFilter();
			$typeFilter->setSid($type->getSid());
			$typeFilter->setLastUpdate($type->getLastUpdate());		

			
			$typeResult = new Type();			
			$typeResult = $typeCmd->updateType($type, $typeFilter);		

			$return = '';			
			
			if (!is_null($typeResult))
			{
				$return .= '<types>'.
					
					'<type>' .
									'<sid>' . $typeResult->getSid() . '</sid>' .
									'<typeEn>' . $typeResult->getTypeEn() . '</typeEn>' .
									'<typeTc>' . $typeResult->getTypeTc() . '</typTc>' .
									'<remarks>' . $typeResult->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $typeResult->getLastUpdate(). '</lastUpdate>' .
								'</type>';
				
				$return .= '</types>';
			} // if (!is_null($typeResult))

			// --- log
			$log = new Log();
			

			$logMessage = $return . "\n" . $typeResult->printValues() ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('TypeCmd.php-SystemParam::$CMD_FLEX_UPDATE-after post values');
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
			

			$logMessage = $type->printValues() . "\n";
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('TypeCmd.php-SystemParam::$CMD_FLEX_INSERT-get post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
						
			$typeResult = new Type();			
			$typeResult = $typeCmd->insertType($type);		

			$return = '';			
			
			if (!is_null($typeResult))
			{
				$return .= '<types>'.
					
					'<type>' .
									'<sid>' . $typeResult->getSid() . '</sid>' .
									'<typeEn>' . $typeResult->getTypeEn() . '</typeEn>' .
									'<typeTc>' . $typeResult->getTypeTc() . '</typTc>' .
									'<remarks>' . $typeResult->getRemarks() . '</remarks>' .
									'<lastUpdate>' . $typeResult->getLastUpdate(). '</lastUpdate>' .
								'</type>';
				
				$return .= '</types>';
			} // if (!is_null($typeResult))

			// --- log
			$log = new Log();
			
			$logMessage = $return . "\n" . $typeResult->printValues() ;
			
			$log->setLogDateTime(date('Y-m-d H:i:s') );
			$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
			$log->setLogModule('TypeCmd.php-SystemParam::$CMD_FLEX_INSERT-after post values');
			$log->setLogMessage($logMessage);
			
			$logHandler = new LogHandler();
			$logHandler->checkNwriteLog($log);
			
			// --- end log				
			
			print ($return);
		}
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_INSERT)
		{
			$typeCmd->insertType($type);
		} // END INSERT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_UPDATE)
		{
			$typeFilter = new TypeFilter();
			$typeFilter->setSid($type->getSid());
			$typeFilter->setLastUpdate($type->getLastUpdate());		
			
			$typeCmd->updateType($type, $typeFilter);
		} // end UPDATE
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_DELETE)
		{
			$typeFilter = new TypeFilter();
			
			$typeCmd->deleteType($typeFilter);
		} // end DELETE		
		
	} // end if (isset($_SESSION[UserParam::$USER])
	
	class TypeCmd
	{
		private $typeMgr;
		private $typeList;
		
		public function __construct()
		{
			$this->typeMgr = new TypeMgr();
			$this->typeList = new ArrayList();
		}
				
		
		public function selectType($_typeFilter)
		{			
			$typeList = new ArrayList();
			$typeList = $this->typeMgr->selectType($_typeFilter);
			
			$this->typeList = $typeList;
			
			return $this->typeList;
		}		
		public function insertType($_type)
		{
			return $this->typeMgr->insertType($_type);
		} // end insert
		public function updateType($_type, $_typeFilter)
		{
			return $this->typeMgr->updateType($_type, $_typeFilter);
		} // end update
		public function deleteType($_typeFilter)
		{
			return $this->typeMgr->deleteType($_typeFilter);
		} // end delete
				
	} // end class
?>	
