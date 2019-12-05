<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once( $currentDir.'php/service/ResourceTypeMgr.php' );
	require_once( $currentDir.'php/vo/ResourceType.php' );
	require_once( $currentDir.'php/vo/ResourceTypeFilter.php' );
	require_once( $currentDir.'php/common/ArrayList.php' );
	require_once( $currentDir.'php/parameter/Param.php' );
	require_once( $currentDir.'php/common/DialogBox.php' );

	
	// echo "Method: " . $_POST["param"] . "<br/>";	
	if (isset($_POST[PostParam::$POST_PARAM]))	
	{
			$resourceType = new ResourceType();
			$resourceType->setSid($_POST["sid"]);
			$resourceType->setSeq($_POST["seq"]);
			$resourceType->setLv($_POST["lv"]);
			$resourceType->setLvText($_POST["lvText"]);
			$resourceType->setUpLvSid($_POST["upLvSid"]);
			$resourceType->setIsShown(($_POST["isShown"] == 'true' ? 1 : 0));
			$resourceType->setIsNetvigated(($_POST["isNetvigated"] == 'true' ? 1 : 0));
			$resourceType->setUrl($_POST["url"]);
			$resourceType->setRemarks($_POST["remarks"]);		
		
			if (isset($_SERVER['QUERY_STRING']))
			{
				$queryString = $_SERVER['QUERY_STRING'];
			}
			
			/*
			echo 
				'isShown: ' . $resourceType->getIsShown() . '<br/>'. 
				'isstring: '. is_string($resourceType->getIsShown()) .'<br/>' .
				'isbool: ' . is_bool($resourceType->getIsShown()) .'<br/>'.
				'isnumeric: ' . is_numeric($resourceType->getIsShown()) .'<br/>';
			*/	
			
			/*
			echo '---- ResourceTypeCmd ----' . '<br/>' .
			'PostParam: ' . $_POST[PostParam::$POST_PARAM] . '<br/>'.
			'Sid: ' . $resourceType->getSid() . '<br/>' .
			'Seq: '. $resourceType->getSeq() . '<br/>' .
			'Lv: '. $resourceType->getLv() . '<br/>' .
			'Lv Text: '. $resourceType->getLvText() . '<br/>' .
			'Up Lv Sid: '. $resourceType->getUpLvSid() . '<br/>' .
			'Is Shown: ' . $resourceType->getIsShown() . '<br/>' .
			'Is Netvigated: ' . $resourceType->getIsNetvigated() . '<br/>' .
			'Url: ' . $resourceType->getUrl() . '<br/>' .
			'Remarks: ' . $resourceType->getRemarks() . '<br/>';			 
			*/
			
		if ($_POST[PostParam::$POST_PARAM] == Param::$INSERT)
		{

			// echo "Method: " . $_POST["param"] . "<br/>";	
			$returnSid = $resourceTypeCmd = new ResourceTypeCmd();	

			//echo 'inserting';
			$returnSid = $resourceTypeCmd->insertResourceType($resourceType);
			
			if ($returnSid > 0)
			{				
				$feedBackString ='../../pages/resourceTypeEdit.php';
				
				if (!is_null($queryString))
				{
					$feedBackString .= '?' . $queryString . '&' . ResourceTypeEditParam::$CURRENT_SELECT_NODE . '=' . $returnSid;
					
				}
				$dialogBox = new DialogBox();				
				$dialogBox->genAlertBox('新增成功!',  $feedBackString );				
				/* echo '<script type="text/javascript">setTimeout(window.location="../../pages/resourceTypeEdit.php",10000);</script>';	*/				
			}
			
		}	
		
        if ($_POST[PostParam::$POST_PARAM] == Param::$UPDATE)
		{
			$resourceTypeCmd = new ResourceTypeCmd();			
			$returnSid = $resourceTypeCmd->updateResourceType($resourceType);
			
			// echo 'result: ' . $result;
			
			if ($returnSid > 0)
			{
				$feedBackString ='../../pages/resourceTypeEdit.php';
				
				if (!is_null($queryString))
				{
					$feedBackString .= '?' . $queryString . '&' . ResourceTypeEditParam::$CURRENT_SELECT_NODE . '=' . $returnSid;
					
				}				
				
				
				$dialogBox = new DialogBox();
				$dialogBox->genAlertBox('更新成功!',$feedBackString);
				
				/* echo '<script type="text/javascript">setTimeout(window.location="../../pages/resourceTypeEdit.php",10000);</script>';	*/										
			}			
		}		
		
		if ($_POST[PostParam::$POST_PARAM] == Param::$DELETE)
		{
			// echo "Method: " . $_POST["param"] ."<br/>";
			

			$result = 0;
			$resourceTypeCmd = new ResourceTypeCmd();
			$result = $resourceTypeCmd->deleteResourceType($resourceType);
			
			/*
			$result = 0;
			$resourceCmd = new ResourceCmd();
			$result = $resourceCmd->deleteResource();
			*/
			if ($result > 0)
			{
				$dialogBox = new DialogBox();
				$dialogBox->genAlertBox('刪除成功!', '../../pages/resourceTypeEdit.php');				
				/* echo '<script type="text/javascript">setTimeout(window.location="../../pages/resourceTypeEdit.php",10000);</script>';	*/				
			}
		}
	} // end if (isset($_POST["param"]))	
	
	class ResourceTypeCmd
	{
		public function selectMaxSeqOfTheLv($_resourceTypeFilter)
		{
			$resourceTypeMgr = new ResourceTypeMgr();			
			$resourceTypeFilter = new ResourceTypeFilter();
			/*
				echo 
				'sid: ' . $_resourceTypeFilter->getSid() . '</br>' .
				'seq: ' . $_resourceTypeFilter->getSeq() . '</br>' .
				'lv: ' . $_resourceTypeFilter->getLv() . '</br>' .
				'lvText: ' . $_resourceTypeFilter->getLvText() . '</br>'.
				'upLvSid: ' . $_resourceTypeFilter->getUpLvSid() . '</br>' .
				'isShown: ' . $_resourceTypeFilter->getIsShown() . '</br>' .
				'isNetvigated: ' . $_resourceTypeFilter->getIsNetvigated() . '</br>' .
				'url: ' . $_resourceTypeFilter->getUrl() . '</br>' .
				'remarks: ' . $_resourceTypeFilter->getRemarks() . '</br>' .
				'lastUpdate: ' . $_resourceTypeFilter->getLastUpdate() . '</br>';				
			*/
			if (!is_null($_resourceTypeFilter))
			{
				$resourceTypeFilter = $_resourceTypeFilter;
				/*
				echo 
				'sid: ' . $resourceTypeFilter->getSid() . '</br>' .
				'seq: ' . $resourceTypeFilter->getSeq() . '</br>' .
				'lv: ' . $resourceTypeFilter->getLv() . '</br>' .
				'lvText: ' . $resourceTypeFilter->getLvText() . '</br>'.
				'upLvSid: ' . $resourceTypeFilter->getUpLvSid() . '</br>' .
				'isShown: ' . $resourceTypeFilter->getIsShown() . '</br>' .
				'isNetvigated: ' . $resourceTypeFilter->getIsNetvigated() . '</br>' .
				'url: ' . $resourceTypeFilter->getUrl() . '</br>' .
				'remarks: ' . $resourceTypeFilter->getRemarks() . '</br>' .
				'lastUpdate: ' . $resourceTypeFilter->getLastUpdate() . '</br>';	
				*/			
			}
			return $resourceTypeMgr->selectMaxSeqOfTheLv($resourceTypeFilter);			
		}
		
		public function selectNextSeqOfSid()
		{		
			$resourceTypeMgr = new ResourceTypeMgr();			
			
			return $resourceTypeMgr->selectNextSeqOfSid();
		}				
		public function selectMaxResourceTypeLv()
		{		
			$resourceTypeMgr = new ResourceTypeMgr();			
			
			return $resourceTypeMgr->selectMaxResourceTypeLv();
		}			
		public function selectResourceType($_resourceTypeFilter)
		{			
			$resourceTypeFilter = new ResourceTypeFilter();
			$resourceTypeFilter = $_resourceTypeFilter;
			
			$resourceTypeMgr = new ResourceTypeMgr();
			
			$arrayList = new ArrayList();
			$arrayList = $resourceTypeMgr->selectResourceTypeMgr($resourceTypeFilter);
			
			return $arrayList;
		}		
		public function insertResourceType($_resourceType)
		{			
			$resourceType = new ResourceType();
			$resourceType = $_resourceType;
			
			$resourceTypeMgr = new ResourceTypeMgr();
			$result = $resourceTypeMgr->insertResourceTypeMgr($resourceType);
			
			return $result;
		} // end insertResourceType
		public function updateResourceType($_resourceType)
		{
			$resourceType = new ResourceType();
			$resourceType = $_resourceType;
			
			$resourceTypeFilter = new ResourceTypeFilter();
			$resourceTypeFilter->setSid($_POST["sid"]);
			$resourceTypeFilter->setLastUpdate($_POST["lastUpdate"]);
			
			$resourceTypeMgr = new ResourceTypeMgr();
			

			$result = $resourceTypeMgr->updateResourceTypeMgr($resourceType, $resourceTypeFilter);
			//echo 'result from update Resource Cmd: ' . $result;
			return $result;
		} // end updateResourceType
		public function deleteResourceType($_resourceType)
		{
			$resourceType = new ResourceType();
			$resourceType = $_resourceType;
			$resourceTypeFilter = new ResourceTypeFilter();
			
			$resourceTypeFilter->setSid($resourceType->getSid());
			$resourceTypeFilter->setLastUpdate($_POST["lastUpdate"]);			
			
			
			$resourceTypeMgr = new ResourceTypeMgr();
			$result = $resourceTypeMgr->deleteResourceTypeMgr($resourceTypeFilter);
			
			return $result;
		} // end deleteResourceType()
	} // end class


?>