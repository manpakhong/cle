<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
    require_once $currentDir .'php/common/IncludeFiles.php';
    require_once $currentDir .'php/command/ResourceTypeCmd.php';
	require_once $currentDir .'php/vo/ResourceType.php';
	require_once $currentDir .'php/vo/ResourceTypeFilter.php';    
	require_once $currentDir .'php/vo/ResourceTypeNode.php';      
	require_once $currentDir .'php/vo/OrderBy.php';  
	require_once $currentDir . 'php/common/System.php';	
	class ExpandableTreeResourceType
	{
		private $dropDownListId;

		public function __construct()
		{
			$this->dropDownListId = 'resourceTypeTree';
		}
		
		public function getMenu()
		{

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
			$resourceTypeFilterRoot->setLv(0); 
			
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

			
			$expandableTreeResourceType = new ExpandableTreeResourceType();
			// loopNextLv($_rootNode, $_nextRootNextLvArray, $_maxLV)
			$expandableTreeResourceType->loopNextLv($rootNode, $rootArray, $maxLV);

		}
				
		private function loopNextLv($_rootNode, $_rootArray, $_maxLV)
		{
			$rootNode = new ResourceType();
			$rootNode = $_rootNode;

			$rootArray = new ArrayList();
			$rootArray = $_rootArray;
			// $rootArray->goToTheBegin();
			
			$nextRootNextLvArray = new ArrayList();
			$nextRootNextLvArray = $_nextRootNextLvArray;
			
			if ($rootNode->getLv() == $_maxLV)
			{
				// echo "reach max: " . $rootNode->getLv() . " of ". $_maxLV. "<br/>";
				
				while ($rootArray->hasNext())
				{
					$rootNode = new ResourceType();
					$rootNode = $rootArray->next();
					// echo '<li>';
					
					// block of code to prepare front-end user interface, when user select the dropdown, nextSeq of the lv
					// and upLvSid will be typed into the input boxes
					$resourceTypeMaxSeqFilter = new ResourceTypeFilter();
					$resourceTypeMaxSeqFilter->setUpLvSid($rootNode->getSid());
					$uiNextSeq = 0;
					$resourceTypeMaxSeqCmd = new ResourceTypeCmd();
					// echo 'resourceTypeMaxSeqFilter: ' . $resourceTypeMaxSeqFilter->getUpLvSid() . '<br/>';
					$uiNextSeq = $resourceTypeMaxSeqCmd->selectMaxSeqOfTheLv($resourceTypeMaxSeqFilter);					

					$resourceTypeNextSidCmd = new ResourceTypeCmd();
					$nextSid = $resourceTypeNextSidCmd->selectNextSeqOfSid();					
					
					echo 	'<script type="text/javascript">' .

							'obj' . $rootNode->getSid() . '= new Object;' .
							'obj' . $rootNode->getSid() . '.sid = ' . System::returnNegIfNumNull($rootNode->getSid()) . ';' .
							
							'obj' . $rootNode->getSid() . '.seq = ' . System::returnNegIfNumNull($rootNode->getSeq()) . ';' .
							'obj' . $rootNode->getSid() . '.lv = ' . System::returnNegIfNumNull($rootNode->getLv()) . ';' .
							
							'obj' . $rootNode->getSid() . '.lvText = "' . $rootNode->getLvText() . '";' .
							'obj' . $rootNode->getSid() . '.upLvSid = ' . System::returnNegIfNumNull($rootNode->getUpLvSid()) . ';' .
							
							'obj' . $rootNode->getSid() . '.isShown = ' . System::returnNegIfNumNull($rootNode->getIsShown()) . ';' .
							'obj' . $rootNode->getSid() . '.isNetvigated = ' . System::returnNegIfNumNull($rootNode->getIsNetvigated()) . ';' .
							
							'obj' . $rootNode->getSid() . '.url = "' . $rootNode->getUrl() . '";' .
							
							'obj' . $rootNode->getSid() . '.remarks = "' . $rootNode->getRemarks() . '";' .
							
							'obj' . $rootNode->getSid() . '.lastUpdate = "' . System::returnNegIfNumNull($rootNode->getLastUpdate()) . '";' . 
							
							'obj' . $rootNode->getSid() . '.uiNextSeq = ' . System::returnNegIfNumNull($uiNextSeq) . ';' .	
							'obj' . $rootNode->getSid() . '.nextSid = ' . System::returnNegIfNumNull($nextSid) . ';'.				
							'</script>';						
					
					echo '<li id="li' . 
					$rootNode->getSid()
					. '">';					
					if (is_null($rootNode->getUrl()) || strlen($rootNode->getUrl()) == 0)
					{
						// echo '<a href="#">';
						echo '<a href="#" onclick="'. 
						'treeNodeClick('.
						'\'li'. $rootNode->getSid() . '\','.
						'\'' . $rootNode->getSid() . '\',' . 
						'\'' . $this->dropDownListId . '\','.
						'obj' . $rootNode->getSid()  .'' .							
						 ');"'
					
						. '>';		
					}
					else 
					{
						//echo '<a href="'.$rootNode->getUrl().'">';
						echo '<a href="#" onclick="'. 
						'treeNodeClick('.
						'\'li'. $rootNode->getSid() . '\','.
						'\'' . $rootNode->getSid() . '\',' . 
						'\'' . $this->dropDownListId . '\','.
						'obj' . $rootNode->getSid()  .'' .							
						 ');"'

						. '>';							
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

					echo '</a>';
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
					
					// block of code to prepare front-end user interface, when user select the dropdown, nextSeq of the lv
					// and upLvSid will be typed into the input boxes
					$resourceTypeMaxSeqFilter = new ResourceTypeFilter();
					$resourceTypeMaxSeqFilter->setUpLvSid($rootNode->getSid());
					$uiNextSeq = 0;
					$resourceTypeMaxSeqCmd = new ResourceTypeCmd();
					// echo 'resourceTypeMaxSeqFilter: ' . $resourceTypeMaxSeqFilter->getUpLvSid() . '<br/>';
					$uiNextSeq = $resourceTypeMaxSeqCmd->selectMaxSeqOfTheLv($resourceTypeMaxSeqFilter);					

					$resourceTypeNextSidCmd = new ResourceTypeCmd();
					$nextSid = $resourceTypeNextSidCmd->selectNextSeqOfSid();
					
					echo 	'<script type="text/javascript">' .

							'obj' . $rootNode->getSid() . '= new Object;' .
							'obj' . $rootNode->getSid() . '.sid = ' . System::returnNegIfNumNull($rootNode->getSid()) . ';' .
							
							'obj' . $rootNode->getSid() . '.seq = ' . System::returnNegIfNumNull($rootNode->getSeq()) . ';' .
							'obj' . $rootNode->getSid() . '.lv = ' . System::returnNegIfNumNull($rootNode->getLv()) . ';' .
							
							'obj' . $rootNode->getSid() . '.lvText = "' . $rootNode->getLvText() . '";' .
							'obj' . $rootNode->getSid() . '.upLvSid = ' . System::returnNegIfNumNull($rootNode->getUpLvSid()) . ';' .
							
							'obj' . $rootNode->getSid() . '.isShown = ' . System::returnNegIfNumNull($rootNode->getIsShown()) . ';' .
							'obj' . $rootNode->getSid() . '.isNetvigated = ' . System::returnNegIfNumNull($rootNode->getIsNetvigated()) . ';' .
							
							'obj' . $rootNode->getSid() . '.url = "' . $rootNode->getUrl() . '";' .
							
							'obj' . $rootNode->getSid() . '.remarks = "' . $rootNode->getRemarks() . '";' .
							
							'obj' . $rootNode->getSid() . '.lastUpdate = "' . System::returnNegIfNumNull($rootNode->getLastUpdate()) . '";' . 
							
							'obj' . $rootNode->getSid() . '.uiNextSeq = ' . System::returnNegIfNumNull($uiNextSeq) . ';' .	
							'obj' . $rootNode->getSid() . '.nextSid = ' . System::returnNegIfNumNull($nextSid) . ';'.				
							'</script>';						
					
					if ($rootNode->getLv() == 0 && $rootArray->getCurrentIndex() == 1)
					{
						// echo '<ul class="sf-menu">';
						echo '<ul class="mktree" id="tree">';
					}
					else 
					{
						if ($rootArray->getCurrentIndex() == 1)
						{
							echo '<ul>';
						}
					}
					if ($rootNode->getLv() == 0  && $rootArray->getCurrentIndex() == 1)
					{					
						// echo '<li class="current">';
						echo '<li id="li' . 
						$rootNode->getSid()
						. '">';
	
					}
					else
					{
						/* echo '<li>'; */
						echo '<li id="li' . 
						$rootNode->getSid()
						. '">';						
					}			
						
					if (is_null($rootNode->getUrl()) || strlen($rootNode->getUrl()) == 0)
					{
						// echo '<a href="#">';
						echo '<a href="#" onclick="'. 
						'treeNodeClick('.
						'\'li'. $rootNode->getSid() . '\','.
						'\'' . $rootNode->getSid() . '\',' . 
						'\'' . $this->dropDownListId . '\','.
						'obj' . $rootNode->getSid()  .'' .		
						 ');"'

						. '>';	
					}
					else 
					{					
						// echo '<a href="'.$rootNode->getUrl().'">';
						echo '<a href="#" onclick="'. 
						'treeNodeClick('.
						'\'li'. $rootNode->getSid() . '\','.
						'\'' . $rootNode->getSid() . '\',' . 
						'\'' . $this->dropDownListId . '\','.
						'obj' . $rootNode->getSid()  .'' .		
						 ');"'

						. '>';								
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
				
					echo '</a>';
	
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
						$expandableTreeResourceType = new ExpandableTreeResourceType();
						// loopNextLv($_rootNode, $_rootArray, $_maxLV)

						$expandableTreeResourceType->loopNextLv($nextRoot, $nextRootNextLvArray, $_maxLV);	
						echo '</li>';
					}
					else
					{
						echo '</li>';						
					}
					
					if ($rootArray->getCurrentIndex() == $rootArray->size())
					{
						echo '</ul>';
					}
					
				} // while ($rootArray->hasNext())

			} // end if ... else
		} // end method		
		
		
	} // end class
		

		
		
		
	
?>