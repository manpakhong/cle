<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once( $currentDir.'php/service/ResourceMgr.php' );
	require_once( $currentDir.'php/vo/Resource.php' );
	require_once( $currentDir.'php/command/ResourceCmd.php' );
	require_once( $currentDir.'php/vo/ResourceFilter.php' );
	require_once( $currentDir.'php/common/ArrayList.php' );
	require_once( $currentDir.'php/parameter/Param.php' );
	require_once( $currentDir.'php/common/DialogBox.php' );

    if(!isset($_SESSION)) 
    { 
		session_start();
	}
	
	// echo "Method: " . $_POST["param"] . "<br/>";	
	if (isset($_POST["param"]))	
	{
		if ($_POST["param"] == Param::$INSERT)
		{
			$result = 0;
			// echo "Method: " . $_POST["param"] . "<br/>";	
			$resourceCmd = new ResourceCmd();	
			$result = $resourceCmd->insertResource();
			
			// echo 'Cmd result: '. $result;
			
			if ($result > 0)
			{
				
				// echo '<script type="text/javascript">setTimeout(window.location="../../pages/webSiteReferenceList.php?sid='. $_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID] . '&upLvSid='.$_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]  .'",10000);</script>';				
                
				$dialogBox = new DialogBox();
				$dialogBox->genAlertBox('新增成功!', '../../pages/webSiteReferenceList.php?sid='. $_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID] . '&upLvSid='.$_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]);				
				
				
				// session should be started at webSiteReferenceList.php
				if(isset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID]))
				{
				    unset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID]); 
				}
				if(isset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]))
				{
					unset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]); 			
				}	
			}
		}	
		
		if ($_POST["param"] == Param::$UPDATE)
		{
			$result = 0;
			$resourceCmd = new ResourceCmd();			
			$result = $resourceCmd->updateResource();
			if ($result > 0)
			{
				// echo '<script type="text/javascript">setTimeout(window.location="../../pages/webSiteReferenceList.php?sid='. $_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID] . '&upLvSid='.$_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]  .'",10000);</script>';				

				$dialogBox = new DialogBox();
				$dialogBox->genAlertBox('更新成功!', '../../pages/webSiteReferenceList.php?sid='. $_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID] . '&upLvSid='.$_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]);				
				
				
				// session should be started at webSiteReferenceList.php
				if(isset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID]))
				{
				    unset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID]); 
				}
				if(isset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]))
				{
					unset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]); 			
				}	
			}					
			
		}		
		
		if ($_POST["param"] == Param::$DELETE)
		{
			// echo "Method: " . $_POST["param"] ."<br/>";
			
			 

			// echo '<script>alert("'. $_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID] .'");</script>';
			// echo '<script>alert("'. $_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID] .'");</script>';			
			
			
			
			$result = 0;
			$resourceCmd = new ResourceCmd();
			$result = $resourceCmd->deleteResource();
			
			if ($result > 0)
			{
				
			  // echo '<script>alert("'. $_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID] .'");</script>';
			  // echo '<script>alert("'. $_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID] .'");</script>';			
				
				// echo '<script type="text/javascript">setTimeout(window.location="../../pages/webSiteReferenceList.php?sid='. $_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID] . '&upLvSid='.$_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]  .'",10000);</script>';				

				$dialogBox = new DialogBox();
				$dialogBox->genAlertBox('刪除成功!', '../../pages/webSiteReferenceList.php?sid='. $_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID] . '&upLvSid='.$_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]);				
				
				
				// session should be started at webSiteReferenceList.php
				if(isset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID]))
				{
				    unset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID]); 
				}
				if(isset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]))
				{
					unset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_UPLVSID]); 			
				}
				/*
				header('Location:  webSiteReferenceList.php');
				exit();		
				*/		
			}		

			/*
			$result = 0;
			$resourceCmd = new ResourceCmd();
			$result = $resourceCmd->deleteResource();
			*/

		}
	} // end if (isset($_POST["param"]))
	
	class ResourceCmd
	{
		public static $BACK_RESOURCE_TYPE_SID = "BACK_RESOURCE_TYPE_SID";
		public static $BACK_RESOURCE_TYPE_UPLVSID = "BACK_RESOURCE_TYPE_UPLVSID";
					
		public function selectResource($value)
		{			
			$resourceMgr = new ResourceMgr();
			
			$arrayList = new ArrayList();
			$arrayList = $resourceMgr->selectResourceMgr($value);
			
			return $arrayList;
		}
		public function insertResource()
		{			
			$resourceMgr = new ResourceMgr();
			
			$resource = new Resource();
			$resource->setSid($_POST["sid"]);
			$resource->setUrl($_POST["url"]);
			$resource->setResourceName($_POST["resourceName"]);
			$resource->setAuthor($_POST["author"]);
			$resource->setTeachingAims($_POST["teachingAims"]);
			$resource->setTypeMenuSid($_POST["typeMenuSid"]);
			$resource->setTypeSid($_POST["typeSid"]);
			$resource->setRemarks($_POST["remarks"]);
			$resource->setPic($_POST["pic"]);
			$resource->setImageUrl($_POST["imageUrl"]);
			$resource->setLastUpdate($_POST["lastUpdate"]);					
			
			/*
			echo "Sid: " . $resource->getSid() . "<br/>".
		    "URL: " . $resource->getUrl() . "<br/>".
			"Resource Name: " . $resource->getResourceName() . "<br/>".
			"Author: " . $resource->getAuthor() . "<br/>".
			"Teaching Aims: " . $resource->getTeachingAims() . "<br/>".
			"Type Sid: " . $resource->getTypeSid() . "<br/>".
			"Remarks: " . $resource->getRemarks() . "<br/>".
			"LastUpdate: " . $resource->getLastUpdate() . "<br/>";			
			*/
			
			$result = $resourceMgr->insertResourceMgr($resource);
			
			return $result;
		}	
		public function updateResource()
		{			
			$resourceMgr = new ResourceMgr();
			
			$resource = new Resource();
			$resource->setSid($_POST["sid"]);
			$resource->setUrl($_POST["url"]);
			$resource->setResourceName($_POST["resourceName"]);
			$resource->setAuthor($_POST["author"]);
			$resource->setTeachingAims($_POST["teachingAims"]);
			$resource->setTypeMenuSid($_POST["typeMenuSid"]);
			$resource->setTypeSid($_POST["typeSid"]);
			$resource->setRemarks($_POST["remarks"]);
			$resource->setPic($_POST["pic"]);		
			$resource->setImageUrl($_POST["imageUrl"]);				
			$resource->setLastUpdate($_POST["lastUpdate"]);			

			/*
			echo "Sid: " . $resource->getSid() . "<br/>".
		    "URL: " . $resource->getUrl() . "<br/>".
			"Resource Name: " . $resource->getResourceName() . "<br/>".
			"Author: " . $resource->getAuthor() . "<br/>".
			"Teaching Aims: " . $resource->getTeachingAims() . "<br/>".
			"Type Menu Sid: " . $resource->getTypeMenuSid() . "<br/>".
			"Type Sid: " . $resource->getTypeSid() . "<br/>".
			"Remarks: " . $resource->getRemarks() . "<br/>".
			"Pic: " . $resource->getPic() . "<br/>".
			"Image Url: " . $resource->getImageUrl() . '<br/>'.
			"LastUpdate: " . $resource->getLastUpdate() . "<br/>";			
			*/
			
			$resourceFilter = new ResourceFilter();
			$resourceFilter->setSid($resource->getSid());
			$resourceFilter->setLastUpdate($resource->getLastUpdate());			
			

			$result = $resourceMgr->updateResourceMgr($resource, $resourceFilter);

			return $result;
		} // end updateResource()
									
		public function deleteResource()
		{
			$result = 0;
			if (isset($_POST["deleteResourceSid"]))
			{
				$resourceMgr = new ResourceMgr();
				
				$resourceFilter = new ResourceFilter();
				$resourceFilter->setSid($_POST["deleteResourceSid"]);
				
				$result = $resourceMgr->deleteResourceMgr($resourceFilter);
			}
			return $result;
			
			
		}
		
	} // end class ResourceCmd


?>
