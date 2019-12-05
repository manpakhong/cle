<?php
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/system/SysParams.php';	
	require_once $currentDir . 'php/system/SystemValues.php';
	require_once $currentDir. 'php/vo/system/DisplayLang.php';
	require_once $currentDir. 'php/vo/system/DisplayLangFilter.php';
	require_once $currentDir. 'php/cmd/system/DisplayLangCmd.php';
	require_once $currentDir . 'php/vo/Cm.php';
	require_once $currentDir . 'php/vo/CmFilter.php';
	require_once $currentDir . 'php/cmd/CmCmd.php';

		
	class PageCode
	{
		protected $systemValues;
		protected $authenticatedUser;
		protected $displayLangCmd;
		protected $displayLangList;
		protected $currentFileName;
		protected $isAuthenticated;
		
		protected $cmCmd;
		protected $cmList;
		
		public function __construct($_currentFileName)
		{
			$this->currentFileName = $_currentFileName;			
			$this->systemValues = new SystemValues();
			
			$authenticatedUser = new EcrUser();
			$authenticatedUser = $this->systemValues->getAuthenticatedUser();
			$this->authenticatedUser = $authenticatedUser;
			
			$this->displayLangCmd = new DisplayLangCmd();
			$this->displayLangList = new ArrayList();	
			$this->displayLangList = $this->displayLangCmd->selectDisplayLangByObjPagePage($this->currentFileName);						
			
			$this->isAuthenticated = $this->checkIsAuthenticated();
			
			$this->cmCmd = new CmCmd();
			
			$this->retrieveCmList();
		} // end constructor
		
		
		private function retrieveCmList()
		{
			$cmFilter = new CmFilter();
			$cmFilter->setPageO($this->currentFileName);
			$orderBy = new OrderBy();
			$orderBy->setField('sid');
			$orderBy->setIsAsc(false);
			$cmFilter->setOrderByList($orderBy);			
			$this->cmList = $this->cmCmd->selectCm($cmFilter);
		}
		public function getCmList()
		{
			return $this->cmList;
		}
		public function getCm()
		{
			$returnCm = new Cm();
			while ($this->cmList->hasNext())
			{
				$cm = new Cm();
				$cm = $this->cmList->next();
				
				$returnCm = $cm;
				break;
			}
			return $returnCm;
		}
		
		public function getSystemLang()
		{
			return $this->systemValues->getSystemLang();
		}
		
		public function getAuthenticatedUser()
		{
			return $this->authenticatedUser;
		}
		public function getSystemValues()
		{
			return $this->systemValues;
		}
		
		public function getDisplayLang($_labelId)
		{
			$this->displayLangList->goToTheBegin();
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
			} // end while	
			
			

			return $return;
		} // end getDisplayLang()	

		private function checkIsAuthenticated()
		{
			$result = false;
			
			if (!is_null($this->systemValues->getAuthenticatedUser()))
			{
				$result = true;
			}
			
			return $result;
		}
		public function isAuthenticated()
		{
			return $this->isAuthenticated;
		}	
		
	} // end class
?>