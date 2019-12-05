<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once $currentDir . 'php/command/TypeCmd.php';
	require_once $currentDir . 'php/vo/TypeFilter.php';
	require_once $currentDir . 'php/vo/Type.php';	
	require_once $currentDir . 'php/dao/TypeDao.php';
	require_once $currentDir . 'php/common/ArrayList.php';

	class TypeMgr
	{
		public function selectType($_type)
		{
			try
			{								
				if (!is_null($_type))
				{
					$arrayList = new ArrayList();

					$typeDao = new TypeDao();
					
					$arrayList = $typeDao->selectType($_type);
					
					return $arrayList;
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		} // end select
		public function insertType($_type)
		{
			try 
			{
				if (!is_null($_type))
				{
					$typeDao = new TypeDao();
					
					$result = $typeDao->insertType($_type);
					return $result;
					
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		} // end insert
		public function updateType($_type, $_typeFilter)
		{
			try 
			{
				if (!is_null($_type && !is_null($_typeFilter)))
				{
					$typeDao = new TypeDao();
					$result = $typeDao->updateType($_type, $_typeFilter);
					return $result;
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		} // end update
		public function deleteType($_typeFilter)
		{
			try {
				if (!is_null($_typeFilter))
				{
					$typeDao = new TypeDao();
					$result = $typeDao->deleteType($_typeFilter);
					return $result;
				}
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "<br/>";
			}
		}
		
	}
?>