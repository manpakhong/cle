<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/common/ArrayList.php';
	
	class VoBase
	{

		public function __construct()
		{
		}

		protected function outputVarsList() 
		{
			$arrayList = new ArrayList();
			
			$arrayoutput = array();
					
			foreach($this as $var => $value) 
			{
				// echo "$var is $value\n";
				$arrayoutput[$var] = $value;
			}
					
			return $arrayoutput;
		}	
		protected function chkNconvertFlexNaN2Null($_input)
		{
			if ($_input == 'NaN')
			{
				return null;
			}
			else
			{
				return $_input;
			}
		}	
		protected function chkBlankNSetNull($_input)
		{
			if (strlen($_input) > 0)
			{
				return $_input;
			}
			else
			{
				return null;
			}
		}
		
		protected function chkNconvertTrueFalse2Bool($_input)
		{
			if (strtolower($_input) == 'true' || strtolower($_input) == 'false')
			{
				return (strtolower($_input) == 'true' ? 1 :0);
			}
			else
			{
				return $_input;
			}
			
		}
		
	}

?>
