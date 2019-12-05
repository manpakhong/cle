<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/command/WebRefCmd.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/vo/WebRefFilter.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/vo/WebRef.php';	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/dao/WebRefDao.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/common/ArrayList.php';
	
	class WebRefMgr
	{
		public static function selectWebRefMgr($value)
		{
			try
			{
				$webRefFilter = new WebRefFilter();
				$webRefFilter = $value;
								
				if (!is_null($webRefFilter))
				{
					$arrayList = new ArrayList();
					$arrayList = WebRefDao::selectWebRef($webRefFilter);
					
					return $arrayList;
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		}
		
		public static function updateWebRefMgr($value, $valueFilter)
		{
			try {
				
				$result = 0;
				
				if (!is_null($value) && !is_null($valueFilter))
				{
					$result = WebRefDao::updateWebRef($value, $valueFilter);
				}
				
				
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		}
		
		public static function insertWebRefMgr($value)
		{
			try 
			{
				$result = 0;
				$webRef = new WebRef();
				$webRef = $value;
				
				if (!is_null($value))
				{
					$result = WebRefDao::insertWebRef($value);
				}
				
				return $result;
				
			}
			catch (Exception $e)
			{
				echo "Exception : " . $e;
			}
		}
	}
?>