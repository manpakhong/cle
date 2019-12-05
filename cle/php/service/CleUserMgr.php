<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/vo/CleUserFilter.php';
	require_once $currentDir . 'php/vo/CleUser.php';	
	require_once $currentDir . 'php/dao/CleUserDao.php';
	require_once $currentDir . 'php/common/ArrayList.php';

	class CleUserMgr
	{
		public function selectUser($_cleUserFilter)
		{
			try
			{								
				if (!is_null($_cleUserFilter))
				{
					$arrayList = new ArrayList();

					$cleUserDao = new CleUserDao();
					
					$arrayList = $cleUserDao->selectUser($_cleUserFilter);
					
					return $arrayList;
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		}
		
		public function insertUser($_cleUser)
		{
			try 
			{
				$result = 0;
				
				if (!is_null($_cleUser))
				{
					$cleUserDao = new CleUserDao();
					$result = $cleUserDao->insertUser($_cleUser);
				}
				
				return $result;
				
			}
			catch (Exception $e)
			{
				echo "Exception : " . $e;
			}
		}		
		
		public function updateUser($_cleUser, $_cleUserFilter)
		{
			try {
				
				$result = 0;
				
				if (!is_null($_cleUser) && !is_null($_cleUserFilter))
				{
					$cleUserDao = new CleUserDao();
					$result = $cleUserDao->updateUser($_cleUser, $_cleUserFilter);
				}
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		}		
		
		public function deleteUser($_cleUserFilter)
		{
			try 
			{
				$result = 0;
				
				if (!is_null($_cleUserFilter))
				{
					$cleUserDao = new CleUserDao();
					$result = $cleUserDao->deleteUser($_cleUserFilter);
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