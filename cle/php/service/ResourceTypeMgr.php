<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once $currentDir . 'php/command/ResourceTypeCmd.php';
	require_once $currentDir . 'php/vo/ResourceTypeFilter.php';
	require_once $currentDir . 'php/vo/ResourceType.php';	
	require_once $currentDir . 'php/dao/ResourceTypeDao.php';
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/parameter/Param.php';
	require_once $currentDir . 'php/common/System.php';
	
	class ResourceTypeMgr
	{

		public function selectMaxSeqOfTheLv($_resourceTypeFilter)
		{
			try 
			{		
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
				
				$resourceTypeDao = new ResourceTypeDao();
				return $resourceTypeDao->selectMaxSeqOfTheLv($_resourceTypeFilter);
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";	
			}			
		}
		
		// $value is ResourceTypeFilter
		public function selectResourceTypeMgr($value)
		{
			try
			{								
				if (!is_null($value))
				{
					$arrayList = new ArrayList();

					$resourceTypeDao = new ResourceTypeDao();
					
					$arrayList = $resourceTypeDao->selectResourceType($value);
					
					return $arrayList;
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		} // end selectResourceTypeMgr
		public function insertResourceTypeMgr($_resourceType)
		{
			try 
			{
				if (!is_null($_resourceType))
				{
					$result = 0;
					
					$resourceTypeDao = new ResourceTypeDao();
					
					$lastUpdateSid = $resourceTypeDao->insertResourceType($_resourceType);
					
					if (!is_null($lastUpdateSid) && $lastUpdateSid > 0)
					{
						$resourceTypeList = new ArrayList();
						
						$resourceTypeFilter = new ResourceTypeFilter();
						$resourceTypeFilter->setSid($lastUpdateSid);
						
						
						// select the latest object
						$newResourceType = new ResourceType();
						
						$resourceTypeList = $this->selectResourceTypeMgr($resourceTypeFilter);
						
						while ($resourceTypeList->hasNext())
						{
							$resourceType = new ResourceType();
							$resourceType = $resourceTypeList->next();
							$newResourceType = $resourceType;
						}
						
						
						$url = '';
						// update the latest object with url
						
						if (System::getRealIpAddr() == '127.0.0.1')
						{
							$url = SystemParam::$LIST_URL_LOCALHOST . '?sid=' . 
									$newResourceType->getSid() . '&upLvSid=' .
									$newResourceType->getUpLvSid();
						}
						else
						{
							$url = SystemParam::$LIST_URL . '?sid=' . 
									$newResourceType->getSid() . '&upLvSid=' .
									$newResourceType->getUpLvSid();						
						}						
						
						
						$resourceTypeUpdateFilter = new ResourceTypeFilter();
						$resourceTypeUpdateFilter->setSid($newResourceType->getSid());
						$resourceTypeUpdateFilter->setLastUpdate($newResourceType->getLastUpdate());
						
						$newResourceType->setUrl($url);
						
						$result = $resourceTypeDao->updateResourceType($newResourceType, $resourceTypeUpdateFilter);
						
					}
					
					
					return $result;
					
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		} // end insertResourceTypeMgr
		public function updateResourceTypeMgr($_resourceType, $_resourceTypeFilter)
		{
			try 
			{
				if (!is_null($_resourceType && !is_null($_resourceTypeFilter)))
				{
					$resourceTypeDao = new ResourceTypeDao();
					$result = $resourceTypeDao->updateResourceType($_resourceType, $_resourceTypeFilter);
					return $result;
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		} // end updateResourceTypeMgr
		public function deleteResourceTypeMgr($_resourceTypeFilter)
		{
			try {
				if (!is_null($_resourceTypeFilter))
				{
					$resourceTypeDao = new ResourceTypeDao();
					$result = $resourceTypeDao->deleteResourceType($_resourceTypeFilter);
					return $result;
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		}
		
		public function selectMaxResourceTypeLv()
		{
			try 
			{
				$resourceTypeDao = new ResourceTypeDao();
				return $resourceTypeDao->selectMaxResourceTypeLv();
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";	
			}
		} // end selectMaxResourceTypeLv
		
		public function selectNextSeqOfSid()
		{
			try 
			{
				$resourceTypeDao = new ResourceTypeDao();
				return $resourceTypeDao->selectNextSeqOfSid();
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";	
			}
		} // end selectMaxResourceTypeLv		
		
	} // end class
	
?>