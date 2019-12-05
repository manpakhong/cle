<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/common/template/FunctionMenu.php';	
	require_once $currentDir . 'php/common/template/MainMenu.php';
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/system/SysParams.php';	
	require_once $currentDir . 'php/system/SystemValues.php';
	require_once $currentDir . 'php/cmd/system/DisplayLangCmd.php';
	require_once $currentDir . 'php/common/PageCode.php';	
	require_once $currentDir.'php/vo/system/EcrUser.php';
				
	class CommonTemplate extends PageCode
	{
		private $mainMenu;
		private $functionMenu;
		
		
		public function __construct()
		{
			parent::__construct('Template_Code.php');
			$this->mainMenu = new MainMenu();
			$this->systemValues = new SystemValues();
			
			$this->functionMenu = new FunctionMenu($this->getCurrentFileName());
				
		} // end __construct()
		public function getCurrentFileName()
		{
			$currentPath = explode("/", $_SERVER['PHP_SELF']);
			$this->currentFileName = $currentPath[count($currentPath) - 1];
			return $this->currentFileName;
		}
		public function genFunctionMenu()
		{
			return $this->functionMenu->genFunctionMenu($this->systemValues);
		}
		
		public function genBannerHeader()
		{
			return $this->functionMenu->genBannerHeader($this->systemValues);
		}
		public function genMainMenuRecur()
		{
			return $this->mainMenu->genMainMenuRecur();
		}
		public function genMainMenuStatic()
		{
			return $this->mainMenu->genMainMenuStatic();
		}		

		public function getLabelContent($_labelId)
		{
			return $this->displayLangCmd->getContent($_labelId);
		}
		
	} // end class CommonTemplate
?>