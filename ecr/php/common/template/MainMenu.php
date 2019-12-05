<?php
	
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/service/template/MenuBarMgr.php';
	require_once $currentDir. 'php/common/DialogBox.php';
	require_once $currentDir. 'php/vo/system/EcrUser.php';	
	require_once $currentDir. 'php/vo/OrderBy.php';
	require_once $currentDir. 'php/cmd/template/MenuBarCmd.php';	
	require_once $currentDir. 'php/system/SystemValues.php';
	require_once $currentDir. 'php/common/ArrayList.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	class MainMenu
	{
		
		private $authenticatedUser;
		private $menuBarCmd;
		private $systemLang;
		private $netvigatedCount;
		private $ulId;
		
		public function __construct()
		{
			$this->authenticatedUser = new EcrUser();
			$this->netvigatedCount = 0;
			$this->menuBarCmd = new MenuBarCmd();
			$this->ulId = 'mainMenuUl';
		}
		
		public function genMainMenuRecur()
		{
			try
			{

				
				$systemValues = new SystemValues();
				if (!is_null($systemValues->getAuthenticatedUser()))
				{
					$this->authenticatedUser = $systemValues->getAuthenticatedUser();
				}			
								
				$this->systemLang = $systemValues->getSystemLang();
								
				// --- max lv
				$maxLV = $this->menuBarCmd->selectMaxMenuBarLv();
	
				// echo 'Max LV: ' . $maxLV;
							
				// --- root node
				$rootArray = new ArrayList(); 
				
				$menuBarFilterRoot = new MenuBarFilter();
				$menuBarFilterRoot->setLv(1); 
				
				$orderBy = new OrderBy();
				$orderBy->setField('Seq');
				$orderBy->setIsAsc(true);
				
				$menuBarFilterRoot->setOrderByList($orderBy);
				
				$rootArray = $this->menuBarCmd->selectMenuBar($menuBarFilterRoot);
				$rootNode = new MenuBar();
				
				
				
				
				if ($rootArray->hasNext())
				{
					$rootNode = $rootArray->next();
				}				
				// echo $rootNode->printValues();

				
				// --- _nextArray
				$nextRootNextLvArray = new ArrayList();
				$menuBarFilterNext = new MenuBarFilter();

				
				$menuBarFilterNext->setLv(($rootNode->getLv() + 1));
	
				
				$orderByNext = new OrderBy();
				$orderByNext->setField('Seq');
				$orderByNext->setIsAsc(true);

				
				$menuBarFilterNext->setOrderByList($orderByNext);			
				
				$nextRootNextLvArray = $this->menuBarCmd->selectMenuBar($menuBarFilterNext);
							
		
				// --- Menu
				$rootArray->goToTheBegin();
	
				// loopNextLv($_rootNode, $_nextRootNextLvArray, $_maxLV)
				$this->loopNextLv($rootNode, $rootArray, $maxLV);
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}
		} // end getMenu()
				
		private function loopNextLv($_rootNode, $_rootArray, $_maxLV)
		{
			$rootNode = new MenuBar();
			$rootNode = $_rootNode;

			$rootArray = new ArrayList();
			$rootArray = $_rootArray;
			
			$nextRootNextLvArray = new ArrayList();
// 			$nextRootNextLvArray = $_nextRootNextLvArray;
			
			if ($rootNode->getLv() == $_maxLV)
			{
				// echo "reach max: " . $rootNode->getLv() . " of ". $_maxLV. "<br/>";
				
				if ($this->netvigatedCount == 0)
				{
					echo '<ul class="sf-menu" id="' . $this->ulId .'">';
				}
				
				while ($rootArray->hasNext())
				{
					$this->netvigatedCount++;
					
					$rootNode = new MenuBar();
					$rootNode = $rootArray->next();
					
					if (strlen($this->authenticatedUser->getUserId()) > 0)
					{					
						echo '<li>';
					}
					else
					{
						if ($rootNode->getIsShown())
						{
							echo '<li>';
						}
						else
						{
							echo '<li style="display: none">';
						}
					}
					
					if (is_null($rootNode->getUrl()) || strlen($rootNode->getUrl()) == 0)
					{
						echo '<a href="#">';	
					}
					else 
					{
						if (strlen($this->authenticatedUser->getUserId()) > 0)
						{
							echo '<a href="'.$rootNode->getUrl().'">';
						}
						else 
						{
							if ($rootNode->getIsNetvigated())
							{					
								echo '<a href="'.$rootNode->getUrl().'">';
							}	
							else
							{	
								echo '<a href="#">';
							}
						}
					}

					echo $rootNode->getLvText($this->systemLang);						
					/*
					echo 'Lv: ' . $rootNode->getLv() . '++++++++++++++++++++++++++++++++++++++++++++++++++++++'. '<br/>';
					echo '$rootNode: ' . '<br/>' .
							"Sid: " . $rootNode->getSid() . "<br/>" .
							"Seq: " . $rootNode->getSeq() . "<br/>" .
							"LV: " . $rootNode->getLv() . "<br/>" . 
							"LV_Text: " . $rootNode->getLvText(). "<br/>" . 
							"UpLV_sid: " . $rootNode->getUpLvSid() . "<br/>" .
							"IsShown : " . $rootNode->getIsShown() . "<br/>" .
							"Url : " . $rootNode->getUrl() . "<br/>" .								
							"Remarks : " . $rootNode->getRemarks() . "<br/>" .
							"LastUpdate : " . $rootNode->getLastUpdate() . "<br/>"; 					
					echo " ++++++++++++++++++++++++++++++++++++++++++++++++++++++"."<br/>";					
					*/

					echo '</a>';
					echo '</li>';
					// echo '</ul>';
				} // end while
				
				if ($this->netvigatedCount == 0)
				{
					echo '</ul>';
				}				
				
			} // end if
			else
			{
				
				// --------------------- inner menu part
				while ($rootArray->hasNext())
				{
					$this->netvigatedCount++;
					
					$rootNode = new MenuBar();
					$rootNode = $rootArray->next();
					
					if ($rootNode->getLv() == 1 && $rootArray->getCurrentIndex() == 1)
					{
						echo '<ul class="sf-menu" id="' . $this->ulId .'">';
					}
					else 
					{
						if ($rootArray->getCurrentIndex() == 1)
						{
							echo '<ul>';
						}
					}
					// ==============================================================					
					// --- li 
					if (strlen($this->authenticatedUser->getUserId()) > 0)
					{
						if ($rootNode->getLv() == 1  && $rootArray->getCurrentIndex() == 1)
						{					
							echo '<li class="current">';
		
						}
						else
						{
							echo '<li>';
						}		
					}
					else
					{
						if ($rootNode->getIsShown())
						{
							if ($rootNode->getLv() == 1  && $rootArray->getCurrentIndex() == 1)
							{					
								echo '<li class="current">';
			
							}
							else
							{
								echo '<li>';
							}	
						}			
						else 
						{
							if ($rootNode->getLv() == 1  && $rootArray->getCurrentIndex() == 1)
							{					
								echo '<li class="current" style="display: none">';
			
							}
							else
							{
								echo '<li style="display: none">';
							}								
						}			
					}	
						
					if (is_null($rootNode->getUrl()) || strlen($rootNode->getUrl()) == 0)
					{
						echo '<a href="#">';	
					}
					else 
					{					

						if (strlen($this->authenticatedUser->getUserId()) > 0)
						{
							echo '<a href="'.$rootNode->getUrl().'">';
						}
						else 
						{
							if ($rootNode->getIsNetvigated())
							{					
								echo '<a href="'.$rootNode->getUrl().'">';
							}	
							else
							{	
								echo '<a href="#">';
							}
						}
					}	
								
					echo $rootNode->getLvText($this->systemLang);						

					/*
					echo 'Lv: ' . $rootNode->getLv() . '++++++++++++++++++++++++++++++++++++++++++++++++++++++'. '<br/>';
					echo '$rootNode: ' . '<br/>' .
							"Sid: " . $rootNode->getSid() . "<br/>" .
							"Seq: " . $rootNode->getSeq() . "<br/>" .
							"LV: " . $rootNode->getLv() . "<br/>" . 
							"LV_Text: " . $rootNode->getLvText(). "<br/>" . 
							"UpLV_sid: " . $rootNode->getUpLvSid() . "<br/>" .
							"IsShown : " . $rootNode->getIsShown() . "<br/>" .
							"Url : " . $rootNode->getUrl() . "<br/>" .								
							"Remarks : " . $rootNode->getRemarks() . "<br/>" .
							"LastUpdate : " . $rootNode->getLastUpdate() . "<br/>"; 					
					echo " ++++++++++++++++++++++++++++++++++++++++++++++++++++++"."<br/>";					
					*/
				
					echo '</a>';
	
					$nextRoot = $rootNode;
					
					$nextRootNextLvArray = new ArrayList();

					$nextRootNextLvArrayFilter = new MenuBarFilter();
					$nextRootNextLvArrayFilter->setLv(($rootNode->getLv()+1));
					$nextRootNextLvArrayFilter->setUpLvSid($rootNode->getSid());
					
					
					$orderByNextLv = new OrderBy();
					$orderByNextLv->setField('Seq');
					$orderByNextLv->setIsAsc(true);
					
					$nextRootNextLvArrayFilter->setOrderByList($orderByNextLv);							
					
					
					$nextRootNextLvArray = $this->menuBarCmd->selectMenuBar($nextRootNextLvArrayFilter);
					
					if ($nextRootNextLvArray->size() > 0)
					{

						$this->loopNextLv($nextRoot, $nextRootNextLvArray, $_maxLV);	
						echo '</li>';
					}
					else
					{
						echo '</li>';
					}
					
					// --- end li
					// ==============================================================
					if ($rootArray->getCurrentIndex() == $rootArray->size())
					{
						echo '</ul>';
					}
					
				} // while ($rootArray->hasNext())

			} // end if ... else
		} // end method				
		
	} // end class
?>