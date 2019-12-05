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
	
	
	require_once $currentDir.'php/vo/system/EcrUserFilter.php';
	
	require_once $currentDir.'php/service/system/DisplayLangMgr.php';
	
	require_once $currentDir.'php/system/SystemValues.php';

	$systemValues = new SystemValues();

	if (isset($_GET[SystemParam::$SYSTEM_LANGUAGE]) && isset($_GET[SystemParam::$RETURN_URL]))
	{		
		/*
		if ($systemValues->getSystemStorageType()== SystemParam::$SYSTEM_VALUES_TYPE_SESSION)
		{
			session_start();
			$_SESSION[SystemParam::$SYSTEM_LANGUAGE] = $_GET[SystemParam::$SYSTEM_LANGUAGE];
		}
		else
		{
			$_COOKIE[SystemParam::$SYSTEM_LANGUAGE] = $_GET[SystemParam::$SYSTEM_LANGUAGE];
		}
		*/
		
		$systemValues->setSystemLang2SessionOrCookie($_GET[SystemParam::$SYSTEM_LANGUAGE]);
		echo '<script type="text/javascript">window.location="' . $_GET[SystemParam::$RETURN_URL] .'"</script>';

			// Print_r($_SESSION);		
		// echo $_GET[SystemParam::$RETURN_URL];

	}	
	
	if (isset($_POST[SystemParam::$CMD]))
	{
		$displayLang = new DisplayLang();
		
		$displayLang->setSid($_POST["sid"]);
		$displayLang->setLabelId($_POST["labelId"]);
		$displayLang->setObjPageSid($_POST["objPageSid"]);
		$displayLang->setObjTypeSid($_POST["objTypeSid"]);
		$displayLang->setContentEn($_POST["contentEn"]);
		$displayLang->setContentTc($_POST["contentTc"]);
		$displayLang->setRemarks($_POST["remarks"]);
		$displayLang->setLastUpdate($_POST["lastUpdate"]);
		
		$displayLang->setPage($_POST["page"]);	
		$displayLang->setType($_POST["type"]);	
		$displayLang->setUrl($_POST["url"]);	
		
		$displayLangCmd = new DisplayLangCmd();
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_SELECT )
		{
			$displayLangFilter = new DisplayLangFilter();
			$displayLangFilter->setSid($displayLang->getSid());
			$orderBy = new OrderBy();
			$orderBy->setField($displayLang->getDbFieldName('sid'));
			$displayLangFilter->setOrderByList($orderBy);
			
			$result = $displayLangCmd->selectDisplayLang($displayLangFilter);
			
			if ($result > 0)
			{
				// doing something!
			}
			
		} // end SELECT		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_INSERT)
		{
			$displayLangCmd->insertDisplayLang($displayLang);	

		} // END INSERT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_UPDATE)
		{
			$displayLangFilter = new DisplayLangFilter();
			$displayLangFilter->setSid($displayLang->getSid());
			$displayLangFilter->setLastUpdate($displayLang->getLastUpdate());
			$orderBy = new OrderBy();
			$orderBy->setField($displayLang->getDbFieldName('sid'));
			$displayLangFilter->setOrderByList($orderBy);
			
			
			$displayLangCmd->updateDisplayLang($displayLang, $displayLangFilter);
		} // end UPDATE
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_DELETE)
		{
			$displayLangFilter = new DisplayLangFilter(); 
			$displayLangFilter->setSid($displayLang->getSid());
			
			$displayLangCmd->deleteDisplayLang($displayLangFilter);
		} // end DELETE			
		
	} // end if (isset($_SESSION[UserParam::$USER])
	
	class DisplayLangCmd
	{
		private $displayLangMgr;
		private $displayLang;
		private $displayLangList;
		private $systemValues;
		
		public function __construct()
		{
			$this->displayLangMgr = new DisplayLangMgr();
			$this->systemValues = new SystemValues();
		}

		public function selectDisplayLangByObjPagePage($_objPagePage)
		{
			$displayLangList = new ArrayList();
			$displayLangList = $this->displayLangMgr->selectDisplayLangByObjPagePage($_objPagePage);
			$this->displayLangList = $displayLangList;			
			return $this->displayLangList;
		}
		
		public function getDisplayLang($_labelId)
		{
			$return = '';
			
			while ($this->displayLangList->hasNext())
			{
				$displayLang = new DisplayLang();
				$displayLang = $this->displayLangList->next();
				
				if ($displayLang->getLabelId() == $_labelId)
				{
					$return = $displayLang->getContent($this->systemValues->getSystemLang());
					break;
				}
				
			}		

			return $return;
		} // end getDisplayLang()		
		
		public function selectDisplayLang($_displayLangFilter)
		{			
			$displayLangList = new ArrayList();
			$displayLangList = $this->displayLangMgr->selectDisplayLang($_displayLangFilter);
			
			$this->displayLangList = $displayLangList;
			
			return $this->displayLangList;
		} // end select
		public function insertDisplayLang($_displayLang)
		{
			return $this->displayLangMgr->insertDisplayLang($_displayLang);
		} // end insert
		public function updateDisplayLang($_displayLang, $_displayLangFilter)
		{
			return $this->displayLangMgr->updateDisplayLang($_displayLang, $_displayLangFilter);
		} // end update
		public function deleteDisplayLang($_displayLangFilter)
		{
			return $this->displayLangMgr->deleteDisplayLang($_displayLangFilter);
		} // end delete
				
	} // end class
?>