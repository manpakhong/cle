<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once $currentDir . 'php/command/ResourceCmd.php';
	require_once $currentDir . 'php/vo/ResourceFilter.php';
	require_once $currentDir . 'php/vo/Resource.php';	
	require_once $currentDir . 'php/dao/ResourceDao.php';
	require_once $currentDir . 'php/common/ArrayList.php';

	class ResourceMgr
	{
		public function selectResourceMgr($_resourceFilter)
		{
			try
			{								
				if (!is_null($_resourceFilter))
				{
					$arrayList = new ArrayList();

					$resourceDao = new ResourceDao();
					
					$arrayList = $resourceDao->selectResource($_resourceFilter);
					
					return $arrayList;
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		}
		
		public function insertResourceMgr($_resource)
		{
			try 
			{
				$result = 0;
				
				if (!is_null($_resource))
				{
					$resourceDao = new ResourceDao();
					$result = $resourceDao->insertResource($_resource);
				}
				
				return $result;
				
			}
			catch (Exception $e)
			{
				echo "Exception : " . $e;
			}
		}		
		
		public function updateResourceMgr($value, $valueFilter)
		{
			try {
				
				$result = 0;
				
				if (!is_null($value) && !is_null($valueFilter))
				{
					$resourceDao = new ResourceDao();
					$result = $resourceDao->updateResource($value, $valueFilter);
				}
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		}		
		
		public function deleteResourceMgr($valueFilter)
		{
			try 
			{
				$result = 0;
				
				if (!is_null($valueFilter))
				{
					$resourceDao = new ResourceDao();
					$result = $resourceDao->deleteResource($valueFilter);
				}
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		}
	} // end class
	
?>