<?php
	class System
	{
		public static function getDocumentRoot()
		{
			$array = array();
			$array = explode('/', $_SERVER['PHP_SELF']);
			echo 'Current Document: '. $array[1] . '<br/>';			
		}
		public static function returnNegIfNumNull($_number)
		{
			if (is_null($_number))
			{
				return -1;
			}
			else
			{
				return $_number;
			}
		}
		public static function getRealIpAddr()
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
			{
			  $ip=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
			{
			  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
			  $ip=$_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		}			
		public static function isLocalHost()
		{
			$return = false;
			if (System::getRealIpAddr() != '127.0.0.1')
			{
				$return = true;
			}	
			return $return;
		}
		
	}
?>