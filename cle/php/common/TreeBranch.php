<?php 
    if(!isset($_SESSION)) 
    { 
		session_start();
	}
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	
	require_once( $currentDir.'php/common/IncludeFiles.php' );
	require_once( $currentDir.'php/command/ResourceTypeCmd.php' );
	require_once( $currentDir.'php/vo/ResourceType.php' );
	require_once( $currentDir.'php/vo/ResourceTypeFilter.php' );
	require_once( $currentDir.'php/vo/ResourceTypeNode.php' );
	require_once( $currentDir.'php/vo/OrderBy.php' );
	require_once( $currentDir.'php/vo/CleUser.php' );
	require_once( $currentDir.'php/common/LoginSession.php' );   
	
	class TreeBranch
	{
		private $authenticatedUser;
	
		public function __construct()
		{
			$this->authenticatedUser = new CleUser();
		}
		
		public function getBranchNodesByRootName($_lvText = null)
		{

			try
			{
				
				$loginSession = new LoginSession();
				$this->authenticatedUser = new CleUser();
				$this->authenticatedUser = $loginSession->getUser();				
				
				
				$resourceTypeCmd = new ResourceTypeCmd();
				
				// --- max lv
				$maxLV = $resourceTypeCmd->selectMaxResourceTypeLv();
	
				// echo 'Max LV: ' . $maxLV;
							
				/*
				while ($entireArray->hasNext())
				{
					$resourceTypeEntire = new ResourceType();
					$resourceTypeEntire = $entireArray->next();
					
					echo 'Lv: ' . $resourceTypeEntire->getLv() . '++++++++++++++++++++++++++++++++++++++++++++++++++++++'. '<br/>';
					echo '$resourceTypeEntire' .  '<br/>' .
							"Sid: " . $resourceTypeEntire->getSid() . "<br/>" .
							"Seq: " . $resourceTypeEntire->getSeq() . "<br/>" .
							"LV: " . $resourceTypeEntire->getLv() . "<br/>" . 
							"LV_Text: " . $resourceTypeEntire->getLvText(). "<br/>" . 
							"UpLV_sid: " . $resourceTypeEntire->getUpLvSid() . "<br/>" .
							"IsShown : " . $resourceTypeEntire->getIsShown() . "<br/>" .
							"Url : " . $resourceTypeEntire->getUrl() . "<br/>" .						
							"Remarks : " . $resourceTypeEntire->getRemarks() . "<br/>" .
							"LastUpdate : " . $resourceTypeEntire->getLastUpdate() . "<br/>"; 					
					echo " ------------------------------------------------------------"."<br/>";					
					
					
				}
				*/
				// --- root node
				$rootArray = new ArrayList(); 
				$resourceTypeFilterRoot = new ResourceTypeFilter();
				$resourceTypeFilterRoot->setLv(1); 
				
				if (!is_null($_lvText))
				{
					$resourceTypeFilterRoot->setLvText($_lvText);
				}
				
				$orderBy = new OrderBy();
				$orderBy->setField('Seq');
				$orderBy->setIsAsc(true);
				
				$resourceTypeFilterRoot->setOrderByList($orderBy);
				
				$rootArray = $resourceTypeCmd->selectResourceType($resourceTypeFilterRoot);
				$rootNode = new ResourceType();
				$rootNode = $rootArray->next();
				
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
				echo " ------------------------------------------------------------"."<br/>";					
				*/
				
				// --- _nextArray
				$nextRootNextLvArray = new ArrayList();
				$resourceTypeFilterNext = new ResourceTypeFilter();
				$resourceTypeFilterNext->setLv(($rootNode->getLv() + 1));
				
				$orderByNext = new OrderBy();
				$orderByNext->setField('Seq');
				$orderByNext->setIsAsc(true);
				
				$resourceTypeFilterNext->setOrderByList($orderByNext);			
				
				$nextRootNextLvArray = $resourceTypeCmd->selectResourceType($resourceTypeFilterNext);
				
				/*
				while ($nextArray->hasNext())
				{
					$resourceTypeNext = new ResourceType();
					$resourceTypeNext = $nextArray->next();
					
					echo 'Lv: ' . $resourceTypeNext->getLv() . '++++++++++++++++++++++++++++++++++++++++++++++++++++++'. '<br/>';
					echo '$resourceTypeNext' .  '<br/>' .
							"Sid: " . $resourceTypeNext->getSid() . "<br/>" .
							"Seq: " . $resourceTypeNext->getSeq() . "<br/>" .
							"LV: " . $resourceTypeNext->getLv() . "<br/>" . 
							"LV_Text: " . $resourceTypeNext->getLvText(). "<br/>" . 
							"UpLV_sid: " . $resourceTypeNext->getUpLvSid() . "<br/>" .
							"IsShown : " . $resourceTypeNext->getIsShown() . "<br/>" .
							"Url : " . $resourceTypeNext->getUrl() . "<br/>" .						
							"Remarks : " . $resourceTypeNext->getRemarks() . "<br/>" .
							"LastUpdate : " . $resourceTypeNext->getLastUpdate() . "<br/>"; 					
					echo " ------------------------------------------------------------"."<br/>";						
					
				}
				*/
			
				// --- Menu
				$rootArray->goToTheBegin();
	
				
				//$superFishMenuGenerator = new SuperFishMenuGenerator();
				// loopNextLv($_rootNode, $_nextRootNextLvArray, $_maxLV)
				$this->loopNextLv($rootNode, $rootArray, $maxLV);
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}
		}
				
		private function loopNextLv($_rootNode, $_rootArray, $_maxLV)
		{
			$rootNode = new ResourceType();
			$rootNode = $_rootNode;

			$rootArray = new ArrayList();
			$rootArray = $_rootArray;
			// $rootArray->goToTheBegin();
			
			$nextRootNextLvArray = new ArrayList();
// 			$nextRootNextLvArray = $_nextRootNextLvArray;
			
			if ($rootNode->getLv() == $_maxLV)
			{
				// echo "reach max: " . $rootNode->getLv() . " of ". $_maxLV. "<br/>";
				
				while ($rootArray->hasNext())
				{
					$rootNode = new ResourceType();
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
						// echo '<a href="#">';	
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
								// echo '<a href="#">';
							}
						}
					}
					
					echo $rootNode->getLvText();					
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

					if (is_null($rootNode->getUrl()) || strlen($rootNode->getUrl()) == 0)
					{
						// echo '<a href="#">';	
					}
					else 
					{
						if (strlen($this->authenticatedUser->getUserId()) > 0)
						{
							echo '</a>';
						}
						else 
						{
							if ($rootNode->getIsNetvigated())
							{					
								echo '</a>';							
							}	
							else
							{	
								// echo '<a href="#">';
							}
						}
					}					
					

					echo '</li>';
					// echo '</ul>';
				}			
				
			} // end if
			else
			{
				
				// --------------------- inner menu part
				while ($rootArray->hasNext())
				{
					$rootNode = new ResourceType();
					$rootNode = $rootArray->next();
					
					if ($rootNode->getLv() == 1 && $rootArray->getCurrentIndex() == 1)
					{
						echo '<ul class="overallIndexUl" >';
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
							echo '<li class="overallIndexLi">';
		
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
								echo '<li class="overallIndexLi">';
			
							}
							else
							{
								echo '<li>';
							}	
						}			
						else // IsShown = false
						{
							if ($rootNode->getLv() == 1  && $rootArray->getCurrentIndex() == 1)
							{					
								echo '<li class="overallIndexLi" style="display: none">';
			
							}
							else
							{
								echo '<li style="display: none">';
							}								
						}			
					}	
						
					if (is_null($rootNode->getUrl()) || strlen($rootNode->getUrl()) == 0)
					{
						// echo '<a href="#">';	
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
								// echo '<a href="#">';
							}
						}
					}	
								
					echo $rootNode->getLvText();
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
				
					if (is_null($rootNode->getUrl()) || strlen($rootNode->getUrl()) == 0)
					{
						// echo '<a href="#">';	
					}
					else 
					{					

						if (strlen($this->authenticatedUser->getUserId()) > 0)
						{
							echo '</a>';						
						}
						else 
						{
							if ($rootNode->getIsNetvigated())
							{					
								echo '</a>';							
							}	
							else
							{	
								// echo '<a href="#">';
							}
						}
					}						
					

	
					$nextRoot = $rootNode;
					
					$nextRootNextLvArray = new ArrayList();
					$resourceTypeCmd = new ResourceTypeCmd();
					$nextRootNextLvArrayFilter = new ResourceTypeFilter();
					$nextRootNextLvArrayFilter->setLv(($rootNode->getLv()+1));
					$nextRootNextLvArrayFilter->setUpLvSid($rootNode->getSid());
					
					
					$orderByNextLv = new OrderBy();
					$orderByNextLv->setField('Seq');
					$orderByNextLv->setIsAsc(true);
					
					$nextRootNextLvArrayFilter->setOrderByList($orderByNextLv);							
					
					
					$nextRootNextLvArray = $resourceTypeCmd->selectResourceType($nextRootNextLvArrayFilter);
					
					
					if ($nextRootNextLvArray->size() > 0)
					{
						//$superFishMenuGenerator = new SuperFishMenuGenerator();
						// loopNextLv($_rootNode, $_rootArray, $_maxLV)

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