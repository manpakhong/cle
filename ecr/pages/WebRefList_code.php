<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/cmd/ResourceCmd.php';
	require_once $currentDir . 'php/common/PageCode.php';
	require_once $currentDir . 'php/system/SysParams.php';
	require_once $currentDir . 'php/vo/Resource.php';
	require_once $currentDir . 'php/vo/ResourceFilter.php';
	require_once $currentDir . 'php/vo/OrderBy.php';		
	
	class WebRefList extends PageCode
	{
		private $resourceList;

		
		public function __construct()
		{	
			parent::__construct('WebRefList.php');			
			$this->resourceList = new ArrayList();
			$this->resourceCmd = new ResourceCmd();
			
			// SystemParam::$RESOURCE_TYPE_SID = 'typeSid'
			if(isset($_GET[SystemParam::$RESOURCE_TYPE_SID]))
			{

				$resourceFilter = new ResourceFilter();
				$resourceFilter->setTypeSid($_GET[SystemParam::$RESOURCE_TYPE_SID]);
			
				$orderBy = new OrderBy();
				$orderBy->setField('Seq');
				$orderBy->setIsAsc(true);
				$resourceFilter->setOrderByList($orderBy);
				
				$resourceList = new ArrayList();
				$resourceList = $this->resourceCmd->selectResource($resourceFilter);
				
				
				$this->resourceList = $resourceList;
			}
			else 
			{

				$resourceFilter = new ResourceFilter();
				$orderBy = new OrderBy();
				$orderBy->setField('Seq');
				$orderBy->setIsAsc(true);
				$resourceFilter->setOrderByList($orderBy);
				
				$resourceList = new ArrayList();
				$resourceList = $this->resourceCmd->selectResource($resourceFilter);
				
				$this->resourceList = $resourceList;				
			}
			
		} // end constructor
			
		public function getResourceList()
		{
			return $this->resourceList;
			
		} // end getResource()
				
	} // end class

?>