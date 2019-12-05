<?php

	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/template/MenuBar.php';
	require_once $currentDir. 'php/common/ArrayList.php';
	require_once $currentDir. 'php/dao/template/MenuBarDao.php';
	
	class MenuBarMgr
	{
		private $menuBarDao;
		
		public function __construct()
		{
			$this->menuBarDao = new MenuBarDao();
		}
		
		public function selectMenuBar($_menuBarFilter)
		{
			try
			{								
				if (!is_null($_menuBarFilter))
				{
					$arrayList = new ArrayList();					
					$arrayList = $this->menuBarDao->selectMenuBar($_menuBarFilter);
					
					return $arrayList;
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		}
		
		public function insertMenuBar($_menuBar)
		{
			try 
			{
				$result = 0;
				if (!is_null($_menuBar))
				{
					$result = $this->menuBarDao->insertMenuBar($_menuBar);
				}
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception : " . $e . "<br/>";
			}
		}		
		
		public function updateMenuBar($_menuBar, $_menuBarFilter)
		{
			try 
			{	
				$result = 0;	
				if (!is_null($_menuBar) && !is_null($_menuBarFilter))
				{
					$result = $this->menuBarDao->updateMenuBar($_menuBar, $_menuBarFilter);
				}
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		}		
		
		public function deleteMenuBar($_menuBarFilter)
		{
			try 
			{
				$result = 0;
				if (!is_null($_menuBarFilter))
				{
					$result = $this->menuBarDao->deleteMenuBar($_menuBarFilter);
				}
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		} // end delete
		
		public function selectMaxMenuBarLv()
		{
			try 
			{
				return $this->menuBarDao->selectMaxMenuBarLv();
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";	
			}
		} // end selectMax	
	} // end class
?>