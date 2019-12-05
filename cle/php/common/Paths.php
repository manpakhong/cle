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
		
			// echo 'root: ' . $this->root . '<br/>';
			$find = strpos($this->root, 'cle', 0);
			// echo 'find: ' . $find . '<br/>';
			$this->root =  substr_replace($this->root, '' , $find + 3);
			// echo $this->root;
			return $this->root;
		}
	}	
?>