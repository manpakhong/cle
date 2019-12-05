<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';


	require_once( $currentDir.'php/command/ResourceTypeCmd.php' );
	require_once( $currentDir.'php/vo/ResourceType.php' );
	require_once( $currentDir.'php/vo/ResourceTypeFilter.php' );
	require_once( $currentDir.'php/command/ResourceCmd.php' );
	require_once( $currentDir.'php/common/HashMap.php' );
	require_once( $currentDir.'php/common/HttpPost.php' );
   

    
    $webSiteReferenceList = new WebSiteReferenceList();
    // variable for bold the current resourceType
    $currentResourceType = new ResourceType();
	$resourceTypeList = new ArrayList();


	// session should be end at webSiteReferenceList.php
	if(isset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID]))
	{
		unset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID]); 
	}
	$_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID] = (isset($_GET["sid"]) ? $_GET["sid"] : '');
	if(isset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]))
	{
		unset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]); 			
	}
	$_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID] = (isset($_GET["upLvSid"]) ? $_GET["upLvSid"] : '');                   	

	
  	if ($_SERVER['REQUEST_METHOD'] != 'POST') 
  	{
  		// get the resourceTypeList
  		// echo "POST" . "<br/>";
		if (isset($_GET["upLvSid"]))
		{
			$resourceTypeList = $webSiteReferenceList->getResourceTypeList($_GET["upLvSid"]);
		}
		// echo "records: " . $resourceTypeList->size() . "<br/>";
		/*
		while ($resourceTypeList->hasNext())
		{
			$resourceType = new ResourceType();
			$resourceType = $resourceTypeList->next();

			echo 'Lv: ' . $resourceType->getLv() . '++++++++++++++++++++++++++++++++++++++++++++++++++++++'. '<br/>';
			echo '$$resourceType' .  '<br/>' .
					"Sid: " . $resourceType->getSid() . "<br/>" .
					"Seq: " . $resourceType->getSeq() . "<br/>" .
					"LV: " . $resourceType->getLv() . "<br/>" . 
					"LV_Text: " . $resourceType->getLvText(). "<br/>" . 
					"UpLV_sid: " . $resourceType->getUpLvSid() . "<br/>" .
					"IsShown : " . $resourceType->getIsShown() . "<br/>" .
					"Url : " . $resourceType->getUrl() . "<br/>" .						
					"Remarks : " . $resourceType->getRemarks() . "<br/>" .
					"LastUpdate : " . $resourceType->getLastUpdate() . "<br/>"; 					
			echo " ------------------------------------------------------------"."<br/>";	
			
		}
		*/
		
		// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
		// +++ for floationg div side menu
		// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 		
		
		if (isset($_GET["sid"]))
		{
			$currentResourceType = $webSiteReferenceList->getCurrentResourceType($_GET["sid"]);
			
		} // end if (isset($_GET["sid"]))		
  	}	
  	
 	$resourceList = new ArrayList();
	$resourceList = $webSiteReferenceList->getResourceList();
  	
  	class WebSiteReferenceList
  	{
  		private $resourceList;
  		private $resourceTypeList;
  		private $currentResourceType;
  		
  		public function __construct()
  		{
  			$this->resourceTypeList = new ArrayList();
  			$this->resourceList = new ArrayList();
  			$this->currentResourceType = new ResourceType();
  		}	
  		public function getCurrentSelectResourcePath()
		{
			$returnPath = '';
			
			$returnPath = '<span class="topIndicatorTextB">' . $this->currentResourceType->getLvText() .  '</span>';
			
			$lv = $this->currentResourceType->getLv();
			
			$loopResourceType = new ResourceType();
			$loopResourceType =  $this->currentResourceType;
			
			while ($lv > 1)
			{
				$resourceTypeFilter = new ResourceTypeFilter();
				$resourceTypeFilter->setSid($loopResourceType->getUpLvSid());
				$resourceTypeCmd = new ResourceTypeCmd();
				$arrayList = new ArrayList();
				$arrayList = $resourceTypeCmd->selectResourceType($resourceTypeFilter);
				
				while ($arrayList->hasNext())
				{
					$resourceTypeTmp = new ResourceType();
					$resourceTypeTmp = $arrayList->next();

					$lv = $resourceTypeTmp->getLv();
					
					if ($lv == 1)
					{
						$returnPath = '<span class="topIndicatorTextA">' . $resourceTypeTmp->getLvText() . '</span>' . ' ------ ' . $returnPath;
					}
					else
					{
						$returnPath = '<span class="topIndicatorTextB">' . $resourceTypeTmp->getLvText() . '</span>' . ' ------ ' . $returnPath;
					}
					$loopResourceType = $resourceTypeTmp;
				} 
				
			}

			return $returnPath;			
		}
		
  		public function getResourceList()
  		{
  			$resourceFilter = new ResourceFilter();
			$resourceFilter->setTypeMenuSid($this->currentResourceType->getSid());
			$resourceCmd = new ResourceCmd();
			$this->resourceList = $resourceCmd->selectResource($resourceFilter);
			return $this->resourceList;
  		}
  		
  		public function getResourceTypeList($_upLvSid)
  		{
  			$resourceTypeFilter = new ResourceTypeFilter();
			$resourceTypeFilter->setUpLvSid($_upLvSid);
			$orderBy = new OrderBy();
			$orderBy->setField("seq");
			$orderBy->setIsAsc(true);
			$resourceTypeFilter->setOrderByList($orderBy);			
			$resourceTypeCmd = new ResourceTypeCmd();	
			$this->resourceTypeList = $resourceTypeCmd->selectResourceType($resourceTypeFilter);
			return $this->resourceTypeList;
  		}
		
  		public function getCurrentResourceType($_sid)
  		{
			$resourceTypeFilter = new ResourceTypeFilter();
			$resourceTypeFilter->setSid($_sid);
			$resourceTypeListTemp = new ArrayList();
			$orderBy = new OrderBy();
			$orderBy->setField("seq");
			$orderBy->setIsAsc(true);
			$resourceTypeFilter->setOrderByList($orderBy);
			$resourceTypeCmd = new ResourceTypeCmd();			
			$resourceTypeListTemp = $resourceTypeCmd->selectResourceType($resourceTypeFilter);
			
			while ($resourceTypeListTemp->hasNext())
			{
				$resourceTypeTemp = new ResourceType();
				$resourceTypeTemp = $resourceTypeListTemp->next();
	
				$this->currentResourceType = $resourceTypeTemp;				
				
				// echo $currentResourceType->getSid();
				

				/*
				echo 'Lv: ' . $currentResourceType->getLv() . '++++++++++++++++++++++++++++++++++++++++++++++++++++++'. '<br/>';
				echo '$resourceType' .  '<br/>' .
						"Sid: " . $currentResourceType->getSid() . "<br/>" .
						"Seq: " . $currentResourceType->getSeq() . "<br/>" .
						"LV: " . $currentResourceType->getLv() . "<br/>" . 
						"LV_Text: " . $currentResourceType->getLvText(). "<br/>" . 
						"UpLV_sid: " . $currentResourceType->getUpLvSid() . "<br/>" .
						"IsShown : " . $currentResourceType->getIsShown() . "<br/>" .
						"Url : " . $currentResourceType->getUrl() . "<br/>" .						
						"Remarks : " . $currentResourceType->getRemarks() . "<br/>" .
						"LastUpdate : " . $currentResourceType->getLastUpdate() . "<br/>"; 					
				echo " ------------------------------------------------------------"."<br/>";		
				*/
			}
  			
  			return $this->currentResourceType;
  		}
  		
  	} // end class
  	
?>