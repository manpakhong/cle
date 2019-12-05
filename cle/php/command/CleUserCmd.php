<?php
if(!isset($_SESSION))
{
    session_start();
}
	// echo 'CleUserCmd.php' . '<br/>';
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);
	$currentDir = $currentDir . '/';


	require_once( $currentDir.'php/parameter/Param.php' );
	require_once( $currentDir.'php/common/DialogBox.php' );
	
	// echo 'After Php CleUserCmd.php' . '<br/>';
	require_once( $currentDir.'php/vo/CleUser.php' );
	require_once( $currentDir.'php/vo/CleUserFilter.php' );
	require_once( $currentDir.'php/service/CleUserMgr.php' );
	// echo 'After RequireOnce CleUserCmd.php' . '<br/>';	

	
	if (isset($_POST[PostParam::$POST_PARAM]))
	{
		$cleUser = new CleUser();
		if (isset($_POST["sid"])){
		    $cleUser->setSid($_POST["sid"]);
		}
		if (isset($_POST["userId"])){
		  $cleUser->setUserId($_POST["userId"]);
		}
		if (isset($_POST["password"])){
		  $cleUser->setPassword($_POST["password"]);
		}
		if (isset($_POST["name"])){
		  $cleUser->setName($_POST["name"]);
		}
		if (isset($_POST["email"])){
		  $cleUser->setEmail($_POST["email"]);
		}
		if (isset($_POST["group"])){
		  $cleUser->setGroup($_POST["group"]);
		}
		if (isset($_POST["remarks"])){
		  $cleUser->setRemarks($_POST["remarks"]);
		}
		if (isset($_POST["lastUpdate"])){
		  $cleUser->setLastUpdate($_POST["lastUpdate"]);	
		}
		
		if ($_POST[PostParam::$POST_PARAM] == Param::$INSERT)
		{
			// echo "Method: " . $_POST["param"] . "<br/>";	

		}	
		
		if ($_POST[PostParam::$POST_PARAM] == Param::$UPDATE)
		{
			// echo "Method: " . $_POST["param"] . "<br/>";		
			$cleUserCmd = new CleUserCmd();	
			$cleUCmd->updateUser();
		}		
		
		if ($_POST[PostParam::$POST_PARAM] == Param::$SELECT )
		{
			$cleUserCmd = new CleUserCmd();
			$authenticatedUser = new CleUser();
			$authenticatedUser = $cleUserCmd->authenticateUser($cleUser->getUserId(), $cleUser->getPassword());
			
			if (!is_null($authenticatedUser->getSid()))
			{

				$dialogBox = new DialogBox();
				$dialogBox->genAlertBox('登入成功!', '../../index.php');	
				
				// echo $authenticatedUser->getSid();
				$_SESSION[CleUserParam::$CLE_USER] = serialize($authenticatedUser);

				// echo 'alert("登入成功!");window.location="../../index.php"';	
				/*echo '<script type="text/javascript">setTimeout(window.location="../../landingPage.php",10000);</script>';	
*/
			}
			else
			{				
				
				$dialogBox = new DialogBox();				
				$dialogBox->genAlertBox('用戶或密碼不正確!','../../pages/userLogin.php');
				/* echo '<script type="text/javascript">setTimeout(window.location="../../pages/userLogin.php",10000);</script>';				
				*/
			}
			
		} // end SELECT
	} // end if (isset($_SESSION[UserParam::$USER])
	
	class CleUserCmd
	{
		private $cleUser;
		private $cleUserList;
		private $authenticatedUser;
		
		public function authenticateUser($_userId, $_password)
		{
			
			$cleUserFilter = new CleUserFilter();
			$cleUserFilter->setUserId($_userId);
			// echo 'user id: ' . $_userId . '<br/>';
			$cleUserList = new ArrayList();
			$cleUserList = $this->selectUser($cleUserFilter);
			
			$authenticatedUser = new CleUser();
			
			while ($cleUserList->hasNext())
			{
				$cleUser = new CleUser();
				$cleUser = $cleUserList->next();
								
				if ($_userId == $cleUser->getUserId())
				{
					if ($_password == $cleUser->getPassword())
					{
						$authenticatedUser = $cleUser;
					}
				}
			}
				
			$this->authenticatedUser = $authenticatedUser;
			
			return $this->authenticatedUser;			
		}
		
		
		public function selectUser($_cleUserFilter)
		{			
			$cleUserMgr = new CleUserMgr();			
			$cleUserList = new ArrayList();
			$cleUserList = $cleUserMgr->selectUser($_cleUserFilter);
			
			$this->cleUserList = $cleUserList;
			
			return $this->cleUserList;
		}		
		public function insertUser()
		{
			$cleUser = new CleUser();
			/*
			$resourceType->setSeq($_POST["seq"]);
			$resourceType->setLv($_POST["lv"]);
			$resourceType->setLvText($_POST["lvText"]);
			$resourceType->setUpLvSid($_POST["upLvSid"]);
			$resourceType->setIsShown($_POST["isShown"]);
			$resourceType->setUrl($_POST["url"]);
			$resourceType->setRemarks($_POST["remarks"]);
			
			$resourceTypeMgr = new ResourceTypeMgr();
			$result = $resourceTypeMgr->insertResourceTypeMgr($resourceType);
			*/
			
		} // end insertResourceType
		public function updateResourceType()
		{
			/*
			$resourceType = new ResourceType();
			$resourceType->setSid($_POST["sid"]);
			$resourceType->setSeq($_POST["seq"]);
			$resourceType->setLv($_POST["lv"]);
			$resourceType->setLvText($_POST["lvText"]);
			$resourceType->setUpLvSid($_POST["upLvSid"]);
			$resourceType->setIsShown($_POST["isShown"]);
			$resourceType->setUrl($_POST["url"]);
			$resourceType->setRemarks($_POST["remarks"]);
			
			$resourceTypeFilter = new ResourceTypeFilter();
			$resourceTypeFilter->setSid($_POST["sid"]);
			$resourceTypeFilter->setLastUpdate($_POST["lastUpdate"]);
			
			$resourceTypeMgr = new ResourceTypeMgr();
			$result = $resourceTypeMgr->updateResourceTypeMgr($resourceType, $resourceTypeFilter);
			*/
		} // end updateResourceType
		public function deleteResourceType()
		{
			/*
			$resourceTypeFilter = new ResourceTypeFilter();
			$resourceTypeFilter->setSid($_POST["sid"]);
			
			$resourceTypeMgr = new ResourceTypeMgr();
			$result = $resourceTypeMgr->deleteResourceTypeMgr($resourceTypeFilter);
			*/
		} // end deleteResourceType()
		
		
		public function __construct()
		{
			$this->cleUser = new CleUser();
			$this->authenticatedUser = new CleUser();
			$this->cleUserList = new ArrayList();	
		}
		
		
	}
?>