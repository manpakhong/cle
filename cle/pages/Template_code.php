<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';


	require_once( $currentDir.'php/common/System.php' );
	
	$template = new Template();
	class Template
	{
		private $isLocalHost;
		private $relativePath;
		private $relativePathOfLoginIn;
		
		public function __construct()
		{
			$this->isLocalHost = System::isLocalHost();
			if ($this->isLocalHost)
			{
				$this->relativePath = '/cle/landingPage.php';
				$this->relativePathOfLoginIn = '/cle/pages/userLogin.php';				
			}
			else
			{
				$this->relativePath = '/cle/landingPage.php';
				$this->relativePathOfLoginIn = '/cle/pages/userLogin.php';					
			}
		}
		public function getRelativePath()
		{
			return $this->relativePath;
		}
		public function getRelativePathOfLogin()
		{
			return $this->relativePathOfLoginIn;
		}
		
	}
?>