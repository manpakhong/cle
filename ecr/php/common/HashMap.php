<?php

	class HashMap
	{
		private $array;
		
		public function __construct()
		{
			$this->array = array();
		}
		
		public function getHashValue($_name)
		{
			return $this->array[$_name];
		}
		
		public function setHashValue($_name, $_value)
		{
			$this->array[$_name] = $_value;	
		}
		
		public function resetHash()
		{
			unset($this->array);
		}
		public function resetHashElement($_name)
		{
			unset($this->array[$name]);
		}
		public function getWholeArray()
		{
			return $this->array;
		}
	} // end class

?>