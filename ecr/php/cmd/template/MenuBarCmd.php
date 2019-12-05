<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/service/template/MenuBarMgr.php';
	require_once $currentDir. 'php/common/DialogBox.php';
	
	if(!isset($_SESSION))
	{
	    session_start();
	}



	
	if (isset($_POST[SystemParam::$CMD]))	
	{
	    echo $_POST[SystemParam::$CMD];
	    
		$menuBar = new MenuBar();
		
		$menuBar->setSid($_POST["sid"]);
		$menuBar->setSeq($_POST["seq"]);
		$menuBar->setLv($_POST["lv"]);
		$menuBar->setLvTextEn($_POST["lvTextEn"]);
		$menuBar->setLvTextTc($_POST["lvTextTc"]);		
		$menuBar->setUpLvSid($_POST["upLvSid"]);
		$menuBar->setIsShown(($_POST["isShown"] == 'true' ? 1 : 0));
		$menuBar->setIsNetvigated(($_POST["isNetvigated"] == 'true' ? 1 : 0));
		$menuBar->setUrl($_POST["url"]);
		$menuBar->setRemarks($_POST["remarks"]);		
		$menuBar->setLastUpdate($_POST["lastUpdate"]);
		
		$menuBarCmd = new MenuBarCmd();
		$dialogBox = new DialogBox();
		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_INSERT)
		{

			$result = 0;

			//echo 'inserting';
			$result = $menuBarCmd->insertMenuBar($menuBar);
			
			if ($result > 0)
			{
				$dialogBox->genAlertBox('加入成功!',  '../../landingPage.php');				
				// echo '<script type="text/javascript">setTimeout(window.location="../../pages/resourceTypeEdit.php",10000);</script>';					
			}
			
		}	
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_SELECT)
		{
			$result = 0;		
			$result = $menuBarCmd->updateMenuBar($menuBar);

			// echo 'result: ' . $result;
			
			if ($result > 0)
			{
				$dialogBox->genAlertBox('更新成功!','../../landingPage.php');
				
				// echo '<script type="text/javascript">setTimeout(window.location="../../pages/resourceTypeEdit.php",10000);</script>';											
			}			
		}		
		
		if ($_POST[SystemParam::$CMD] == SystemParam::$CMD_DELETE)
		{
			// echo "Method: " . $_POST["param"] ."<br/>";
			
			$result = 0;
			$result = $menuBarCmd->deleteMenuBar($menuBarFilter);

			if ($result > 0)
			{
				$dialogBox->genAlertBox('刪除成功!', '../../landingPage.php');				
				// echo '<script type="text/javascript">setTimeout(window.location="../../pages/resourceTypeEdit.php",10000);</script>';					
			}
		}
	} // end if (isset($_POST["param"]))		
	
	class MenuBarCmd
	{
		private $menuBarMgr;

		public function __construct()
		{
			$this->menuBarMgr = new MenuBarMgr();
		}
		
		public function selectMenuBar($_menuBarFilter)
		{			
			$arrayList = new ArrayList();
			$arrayList = $this->menuBarMgr->selectMenuBar($_menuBarFilter);
			return $arrayList;
		} // end select
		
		public function insertMenuBar($_menuBar)
		{			
			$result = $this->menuBarMgr->insertMenuBar($_menuBar);
			return $result;
		} // end insert
		public function updateMenuBar($_menuBar)
		{						
			$menuBar = new MenuBar();
			
			$menuBar = $_menuBar;
			
			$menuBarFilter = new MenuBarFilter();
			$menuBarFilter->setSid($menuBar->getSid());
			$menuBarFilter->setLastUpdate($menuBar->getLastUpdate());			
			
			$result = $this->menuBarMgr->updateMenuBar($menuBar, $menuBarFilter);

			return $result;
		} // end update
									
		public function deleteMenuBar($_menuBarFilter)
		{
			$result = 0;
			
			$result = $this->menuBarMgr->deleteMenuBar($_menuBarFilter);
			return $result;			
		} // end delete
		
		public function selectMaxMenuBarLv()
		{					
			return $this->menuBarMgr->selectMaxMenuBarLv();
		}		
	} // end class ResourceCmd

?>