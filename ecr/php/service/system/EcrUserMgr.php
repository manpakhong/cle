<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	include_once $currentDir . 'php/vo/system/EcrUser.php';
	include_once $currentDir . 'php/vo/system/EcrUserFilter.php';
	include_once $currentDir . 'php/dao/system/EcrUserDao.php';
	
	class EcrUserMgr
	{
		private $ecrUserDao;
		
		public function __construct()
		{
			$this->ecrUserDao = new EcrUserDao();
		}
		
		public function selectUser($_ecrUserFilter)
		{
			try
			{								
				$userList = new ArrayList();
				if (!is_null($_ecrUserFilter))
				{
					$userList = $this->ecrUserDao->selectUser($_ecrUserFilter);
				}
				
				return $userList;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		}
		
		public function insertUser($_ecrUser)
		{
			try 
			{
				$result = 0;
				if (!is_null($_ecrUser))
				{
					$result = $this->cleUserDao->insertUser($_ecrUser);
				}
				return $result;
				
			}
			catch (Exception $e)
			{
				echo "Exception : " . $e . "\n";
			}
		}		
		
		public function updateUser($_ecrUser, $_ecrUserFilter)
		{
			try 
			{	
				$result = 0;
				if (!is_null($_ecrUser) && !is_null($_ecrUserFilter))
				{
					$result = $this->ecrUserDao->updateUser($_ecrUser, $_ecrUserFilter);
				}
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		}		
		
		public function deleteUser($_ecrUserFilter)
		{
			try 
			{
				$result = 0;
				
				if (!is_null($_ecrUserFilter))
				{
					$result = $this->ecrUserDao->deleteUser($_ecrUserFilter);
				}
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		}		
	} // end class

?>