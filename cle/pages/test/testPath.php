<?php
	class Paths
	{
		private $root;
		public function __construct()
		{
			$this->root = getcwd();
		}
		
		public function getRoot()
		{
		
			echo 'root: ' . $this->root . '<br/>';
			$find = strpos($this->root, 'cle', 0);
			echo 'find: ' . $find . '<br/>';
			$this->root =  substr_replace($this->root, '' , $find + 3);
			echo 'final root: ' . $this->root . '<br/>';
			return $this->root;
		}
	}
	
	$path = new Paths();
	$path->getRoot();
	
	echo 'check file exists: ' . file_exists($path->getRoot() . '/php/command/ResourceCmd.php') ;
	
?>