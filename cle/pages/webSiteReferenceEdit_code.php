<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';


	
	require_once $currentDir.'php/common/ArrayList.php';
	require_once $currentDir.'php/vo/Resource.php';
	require_once $currentDir.'php/vo/ResourceFilter.php';
	require_once $currentDir.'php/command/ResourceCmd.php';
	require_once $currentDir.'php/vo/ResourceType.php';
	require_once $currentDir.'php/vo/ResourceTypeFilter.php';	
	require_once $currentDir.'php/command/ResourceTypeCmd.php';
	require_once $currentDir.'php/command/TypeCmd.php';
	require_once $currentDir.'php/common/ResourceTypeDropDownList.php';
	require_once $currentDir.'php/vo/TypeFilter.php';	
	require_once $currentDir.'php/vo/Type.php';
	
	$webSiteReferenceEdit = new WebSiteReferenceEdit();
	$webSiteReferenceEdit->onPageLoad();	
	

	
	
	class WebSiteReferenceEdit
	{
		private $resource;
		private $resourceList;
		private $resourceType;
		private $resourceTypeList;
		private $typeList;
		
		public function __construct () {
			$this->resource = new Resource();
			$this->resourceType = new ResourceType();
			$this->resourceList = new ArrayList();
			$this->resourceTypeList = new ArrayList();
			$this->typeList = new ArrayList();
		}
		
		
		public function onPageLoad()
		{

		}
		
		public function selectResourceTypeBySid($_resourceTypeSid)
		{
			try 
			{
				$resourceTypeCmd = new ResourceTypeCmd();
				$resourceTypeFilter = new ResourceTypeFilter();
				$resourceTypeFilter->setSid($_resourceTypeSid);
				$this->resourceTypeList = $resourceTypeCmd->selectResourceType($resourceTypeFilter);
				
				while ($this->resourceTypeList->hasNext())
				{
					$this->resourceType = $this->resourceTypeList->next();
				}
				
				return $this->resourceType;				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "\n" );	
			}
		}
		public function selectResourceType()
		{
			try 
			{
				$resourceTypeCmd = new ResourceTypeCmd();
				$resourceTypeFilter = new ResourceTypeFilter();
				$resourceTypeFilter->setSid($this->resource->getTypeMenuSid());
				$this->resourceTypeList = $resourceTypeCmd->selectResourceType($resourceTypeFilter);
				
				while ($this->resourceTypeList->hasNext())
				{
					$this->resourceType = $this->resourceTypeList->next();
				}
				
				return $this->resourceType;
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "\n" );				
			}
		}
		
		public function genResourceTypeDropDownList($_dropDownMenuSid, $_dropDownMenuName)
		{
			// echo $this->resourceType->getSid();
			$resourceTypeDropDownList = new ResourceTypeDropDownList();
			$resourceTypeDropDownList->getMenu($_dropDownMenuSid, $_dropDownMenuName, $this->resourceType); 
		}
		public function getTypeList()
		{
			$typeCmd = new TypeCmd();
			$typeFilter = new TypeFilter();
			$typeList = new ArrayList();
			$typeList = $typeCmd->selectType($typeFilter);
			
			/*
			while ($typeList->hasNext())
			{
				$type = new Type();
				$type = $typeList->next();
				
				
				echo "Sid: " . $type->getSid() . "<br/>" .
				"Type: " . $type->getType() . "<br/>" .
				"Remarks: " . $type->getRemarks() . "<br/>" . 
				"LastUpdate : " . $type->getLastUpdate() . "<br/>"; 
				
			
			}			
			*/
			
			$this->typeList = $typeList;
			return $this->typeList;
		}
		
		
		public function selectResourceBySid($value)
		{
			$resourceFilter = new ResourceFilter();
			$resourceFilter->setSid($value);
			$resourceCmd = new ResourceCmd();
			
			$this->resourceList = $resourceCmd->selectResource($resourceFilter);	
			
			while ($this->resourceList->hasNext())
			{
				$this->resource = $this->resourceList->next();
			}

			
			return $this->resource;
		}
		
		public function getResource()
		{
			return $this->resource;
		}
		
		public function setResource($value)
		{
			$this->resource = $value;
		}
				
	}
?>