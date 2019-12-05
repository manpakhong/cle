<?php

	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';

	require_once( $currentDir.'php/vo/ResourceType.php' );
	require_once( $currentDir.'php/vo/OrderBy.php' );
	require_once( $currentDir.'php/vo/ResourceTypeFilter.php' );
	require_once( $currentDir.'php/command/ResourceTypeCmd.php' );
	require_once( $currentDir.'php/common/ResourceTypeDropDownList.php' );
	require_once( $currentDir.'php/common/ResourceTypeDropDownListJScript.php' );	
	require_once( $currentDir.'php/common/ExpandableTreeResourceType.php' );
	require_once( $currentDir.'php/parameter/Param.php' );
	
	$resourceTypeEdit = new ResourceTypeEdit();
	
	if (is_null($authenticatedUser))
	{
		echo '<script type="text/javascript">notAuthorized("'.$template->getRelativePathOfLogin().'");</script>';			
	}
	else
	{
		if (!(strlen($authenticatedUser->getUserId()) > 0))
		{
			echo '<script type="text/javascript">notAuthorized("'.$template->getRelativePathOfLogin().'");</script>';	
		}
	}

	class ResourceTypeEdit
	{
		private $resourceType;
		private $accordionSelect;
		private $currentSelectNode;
		
		public function __construct()
		{
			$resourceType = new ResourceType();
			if (isset($_GET[ResourceTypeEditParam::$ACCORDION_SELECT]))
			{
				$this->accordionSelect = $_GET[ResourceTypeEditParam::$ACCORDION_SELECT];
			}
			if (isset($_GET[ResourceTypeEditParam::$CURRENT_SELECT_NODE]))
			{
				$this->currentSelectNode = $_GET[ResourceTypeEditParam::$CURRENT_SELECT_NODE];
			}
		} // end __construct()
		
		public function getAccordionSelect()
		{
			return $this->accordionSelect;
		}
		public function getCurrentSelectNode()
		{
			return $this->currentSelectNode;
		}
	
		
		public function genResourceTypeDropDownListJScript()
		{
			$resourceTypeDropDownListJScript = new ResourceTypeDropDownListJScript();
			$resourceTypeCmd = new ResourceTypeCmd();
			$resourceTypeList = new ArrayList();
			
			$resourceTypeFilter = new ResourceTypeFilter();
			$resourceTypeFilter->setSid(0);
			
			$resourceTypeList = $resourceTypeCmd->selectResourceType($resourceTypeFilter);
			
			$resourceTypeTmp = new ResourceType();
			
			while ($resourceTypeList->hasNext())
			{
				$resourceTypeTmp = $resourceTypeList->next();
			}
			
			return $resourceTypeDropDownListJScript->getMenu('resourceTypeTree', 'resourceTypeTree', $resourceTypeTmp); 			
		}
		public function genResourceTypeDropDownList()
		{
			$resourceTypeDropDownList = new ResourceTypeDropDownList();
			$resourceTypeCmd = new ResourceTypeCmd();
			$resourceTypeList = new ArrayList();
			
			$resourceTypeFilter = new ResourceTypeFilter();
			$resourceTypeFilter->setSid(0);
			
			$resourceTypeList = $resourceTypeCmd->selectResourceType($resourceTypeFilter);
			
			$resourceTypeTmp = new ResourceType();
			
			while ($resourceTypeList->hasNext())
			{
				$resourceTypeTmp = $resourceTypeList->next();
			}
			
			return $resourceTypeDropDownList->getMenu('resourceTypeTree', 'resourceTypeTree', $resourceTypeTmp); 
		}
		
		public function getCurrentResourceType($sid)
		{
			$resourceTypeCmd = new ResourceTypeCmd();
			
			$resourceTypeFilter = new ResourceTypeFilter();
			$resourceTypeFilter->setSid($sid);
			
			$resourceTypeList = new ArrayList();
			
			$resourceTypeList = $resourceTypeCmd->selectResourceType($resourceTypeFilter);
			
			while ($resourceTypeList->hasNext())
			{
				$this->resourceType = $resourceTypeList->next();	
			}
			
			return $this->resourceType;			
		}
		
	}
?>