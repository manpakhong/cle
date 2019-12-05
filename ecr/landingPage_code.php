<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/common/template/Template_Code.php' ;	
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/vo/OrderBy.php';
	require_once $currentDir . 'php/system/SysParams.php';	
	require_once $currentDir . 'php/cmd/ActivityCmd.php';	
	require_once $currentDir . 'php/vo/Activity.php';
	require_once $currentDir . 'php/vo/ActivityFilter.php';
	require_once $currentDir . 'php/common/PageCode.php';	

	
	
	class LandingPage extends PageCode
	{
		private $activityCmd;
		private $activityList;
		
		public function __construct()
		{	
			parent::__construct('LandingPage.php');
			$this->activityCmd = new ActivityCmd();
			$this->activityList = new ArrayList();
			
			$this->selectActivityList();
			
		}		
		
		private function selectActivityList()
		{
			$activityFilter = new ActivityFilter();
			$orderBy = new OrderBy();
			$orderBy->setField('Activity_Date');
			$orderBy->setIsAsc(false);
			$activityFilter->setOrderByList($orderBy);
			
			$this->activityList = $this->activityCmd->selectActivity($activityFilter);
		}
		
		public function getActivityList()
		{
			return $this->activityList;
		}
		
	} // end class
	
?>