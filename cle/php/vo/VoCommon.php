<?php

	class VoCommon
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
	}

?>