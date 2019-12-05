<?php

	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/common/ArrayList.php';
	require_once $currentDir . 'php/common/system/Connection.php';

	require_once $currentDir . 'php/vo/OrderBy.php';	
	require_once $currentDir . 'php/common/BindParam.php';	

	require_once $currentDir.'php/system/SysParams.php';
	require_once $currentDir.'php/common/DialogBox.php';
	
	require_once $currentDir.'php/vo/system/EcrUser.php';
	require_once $currentDir.'php/vo/system/EcrUserFilter.php';
	require_once $currentDir.'php/service/system/EcrUserMgr.php';
	
	require_once $currentDir. 'php/system/SystemValues.php';
	require_once $currentDir. 'php/cmd/system/DisplayLangCmd.php';
	
	$displayLangList = new ArrayList();
	$displayLangCmd = new DisplayLangCmd();
	$displayLangCmd->selectDisplayLangByObjPagePage('EcrUserCmd.php');

	$systemValues = new SystemValues();
	
	if (isset($_GET[SystemParam::$SYSTEM_LOGOUT]))
	{
		try {
			$systemValues = new SystemValues();
			$systemValues->setLogoutValueByKillinSessionOrCookieObj();
			
			$authenticatedUser = new EcrUser();
			$authenticatedUser = $systemValues->getAuthenticatedUser();
			
			if (is_null($authenticatedUser->getUserId()))
			{
				echo '<script type="text/javascript">window.location="../../../landingPage.php"</script>';
			}
			else
			{
				throw new Exception ('Cannot logout, please check!', 3005);
			}
		}
		catch (Exception $e)
		{
			echo 'Exception: ' . $e . '<br/>';
		} // end try ... catch
		
	} // end if (isset($_GET[SystemParam::$SYSTEM_LOGOUT]))
	
	
	if (isset($_POST[SystemParam::$CMD]))
	{
		$ecrUser = new EcrUser();
		$ecrUser->setSid($_POST["sid"]);
		$ecrUser->setUserId($_POST["userId"]);
		$ecrUser->setPassword($_POST["password"]);
		$ecrUser->setNameEn($_POST["nameEn"]);
		$ecrUser->setNameTc($_POST["nameTc"]);
		$ecrUser->setEmail($_POST["email"]);
		$ecrUser->setGroupSid($_POST["groupSid"]);
		$ecrUser->setGroupNameEn($_POST["groupNameEn"]);
		$ecrUser->setGroupNameTc($_POST["groupNameTc"]);			
		$ecrUser->setRemarks($_POST["remarks"]);
		$ecrUser->setLastUpdate($_POST["lastUpdate"]);		
		
		$ecrUserCmd = new EcrUserCmd();
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_SELECT )
		{
			$authenticatedUser = new EcrUser();
						
			$ecrUserFilter = new EcrUserFilter();
			$ecrUserFilter->setUserId($ecrUser->getUserId());
			$ecrUserFilter->setPassword($ecrUser->getPassword());
			$orderBy = new OrderBy();
			$orderBy->setField($ecrUser->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$ecrUserFilter->setOrderByList($orderBy);				
			
			$authenticatedUser = $ecrUserCmd->authenticateUser($ecrUserFilter);
			
			// echo $authenticatedUser->printValues();
			
			
			if (!is_null($authenticatedUser->getSid()))
			{
				/*
				$dialogBox = new DialogBox();
				$dialogBox->genAlertBoxB('登入成功', '../../index.php');	
				*/
				// echo for java ajax action
				echo SystemParam::$LOGIN_MESSAGE_SUCCESS . '|' . $displayLangCmd->getDisplayLang('ecrUserCmd_login_success') . '|' . '../pages/system/SystemPanel.php';

				$systemValues->setAuthenticatedUser2SessionOrCookie($authenticatedUser);
			}
			else
			{
				/*
				$dialogBox = new DialogBox();				
				$dialogBox->genAlertBoxB('登入失敗','../../pages/userLogin.php');
				*/
				
				// echo for java ajax action
				echo SystemParam::$LOGIN_MESSAGE_FAILED . '|' . $displayLangCmd->getDisplayLang('ecrUserCmd_login_failed')  . '|' . '../pages/Login.php';
			} // end if 

		} // end SELECT		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_INSERT)
		{
			$ecrUserCmd->insertUser($ecrUser);	

		} // END INSERT
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_UPDATE)
		{
			$ecrUserFilter = new EcrUserFilter(); 
			$ecrUserFilter->setSid($ecrUser->getSid());
			$ecrUserFilter->setLastUpdate($ecrUser->getLastUpdate());
			$orderBy = new OrderBy();
			$orderBy->setField($ecrUser->getDbFieldName('sid'));
			$orderBy->setIsAsc(true);
			$ecrUserFilter->setOrderByList($orderBy);
			
			$ecrUserCmd->updateUser($ecrUser, $ecrUserFilter);
		} // end UPDATE
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_DELETE)
		{
			$ecrUserFilter = new EcrUserFilter(); 
			$ecrUserFilter->setSid($ecrUser->getSid());
			
			$ecrUserCmd->deleteUser($ecrUserFilter);
		} // end DELETE		
		
	} // end if (isset($_SESSION[UserParam::$USER])
	
	class EcrUserCmd
	{
		private $ecrUserMgr;
		private $ecrUserList;
		
		public function __construct()
		{
			$this->ecrUserMgr = new EcrUserMgr();
			$this->ecrUserList = new ArrayList();
		}
		
		public function authenticateUser($_ecrUserFilter)
		{
					
			$ecrUserList = new ArrayList();
			$ecrUserList = $this->selectUser($_ecrUserFilter);
			
			$authenticatedUser = new EcrUser();
						
			while ($ecrUserList->hasNext())
			{
				$ecrUser = new EcrUser();
				$ecrUser = $ecrUserList->next();
												
				$authenticatedUser = $ecrUser;
		
			} // end while
				
			$this->authenticatedUser = $authenticatedUser;
						
			
			return $this->authenticatedUser;			
		} // end authenticateUser
		
		
		public function selectUser($_ecrUserFilter)
		{			
			$ecrUserList = new ArrayList();
			$ecrUserList = $this->ecrUserMgr->selectUser($_ecrUserFilter);
			
			$this->ecrUserList = $ecrUserList;
			
			return $this->ecrUserList;
		}		
		public function insertUser($_ecrUser)
		{
			return $this->ecrUserMgr->insertUser($_ecrUser);
		} // end insertResourceType
		public function updateUser($_ecrUser, $_ecrUserFilter)
		{
			return $this->ecrUserMgr->updateUser($_ecrUser, $_ecrUserFilter);
		} // end updateResourceType
		public function deleteUser($_ecrUserFilter)
		{
			return $this->ecrUserMgr->deleteUser($_ecrUserFilter);
		} // end deleteResourceType()
				
	} // end class
?>