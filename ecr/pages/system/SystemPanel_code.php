<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/cmd/FileCabinetCmd.php';
	require_once $currentDir . 'php/common/PageCode.php';
	require_once $currentDir . 'php/system/SysParams.php';
	require_once $currentDir . 'php/vo/FileCabinet.php';
	require_once $currentDir . 'php/vo/FileCabinetFilter.php';
	require_once $currentDir . 'php/vo/OrderBy.php';	

	class SystemPanel extends PageCode
	{
		
		public function __construct()
		{	
			parent::__construct('SystemPanel.php');	
		} // end constructor
		
		public function selectAllFileCabinet()
		{
			
		}
		
		
	} // end SystemPanel
?>