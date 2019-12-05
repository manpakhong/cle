<?php

	class Encryption
	{
		private $prefix;
		
		public function __construct()
		{
			$this->prefix = 'pre';
		}
		
		public function md5Encord($_string)
		{
			return md5($this->prefix . $_string);
		}
	}

?>