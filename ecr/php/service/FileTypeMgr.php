<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/dao/FileTypeDao.php';	

	class FileTypeMgr
	{
		private $fileTypeDao;
		
		public function __construct()
		{
			$this->fileTypeDao = new FileTypeDao();
		}
		
		public function selectFileType($_fileTypeFilter)
		{
			try
			{
				return $this->fileTypeDao->selectFileType($_fileTypeFilter);
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}
		}
		
		public function insertFileType($_fileType)
		{
			try 
			{
				return $this->fileTypeDao->insertFileType($_fileType);
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e. '<br/>';
			}
		}
		
		public function updateFileType($_fileType, $_fileTypeFilter)
		{
			try 
			{
				return $this->fileTypeDao->updateFileType($_fileType, $_fileTypeFilter);
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e. '<br/>';
			}			
		}
		
		public function deletefileType($_fileTypeFilter)
		{
			try 
			{
				return $this->fileTypeDao->deleteFileType($_fileTypeFilter);
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e. '<br/>';
			}			
		}
		
		
	} // end class

?>