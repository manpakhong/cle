<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once $currentDir .'php/service/TypeMgr.php';
	require_once $currentDir .'php/vo/Type.php';
	require_once $currentDir .'php/command/TypeCmd.php';
	require_once $currentDir .'php/vo/TypeFilter.php';
	require_once $currentDir .'php/common/ArrayList.php';
	require_once $currentDir .'php/parameter/Param.php';
	
	class TypeCmd
	{
						
		public function selectType($_typeFilter)
		{			
			$typeMgr = new TypeMgr();
			
			$arrayList = new ArrayList();
			$arrayList = $typeMgr->selectType($_typeFilter);
			
			return $arrayList;
		}
		public function insertType()
		{			
			$typeMgr = new TypeMgr();
			
			$type = new Type();
			$type->setSid($_POST["sid"]);
			$type->setType($_POST["type"]);
			$type->setRemarks($_POST["remarks"]);
			$type->setLastUpdate($_POST["lastUpdate"]);					
			
			/*
			echo "From Cmd: <br/>" .
					"Sid: " . $type->getSid() . "<br/>" .
					"Type: " . $type->getType() . "<br/>" .
					"Remarks: " . $type->getReamrks() . "<br/>" . 
					"LastUpdate : " . $type->getLastUpdate() . "<br/>"; 
			*/
			
			$result = $typeMgr->insertType($type);
			
			return $result;
		}	
		public function updateType()
		{			
			$type = new Type();
			$type->setSid($_POST["sid"]);
			$type->setType($_POST["type"]);
			$type->setRemarks($_POST["remarks"]);
			$type->setLastUpdate($_POST["lastUpdate"]);					
			
			/*
			echo "From Cmd: <br/>" .
					"Sid: " . $type->getSid() . "<br/>" .
					"Type: " . $type->getType() . "<br/>" .
					"Remarks: " . $type->getReamrks() . "<br/>" . 
					"LastUpdate : " . $type->getLastUpdate() . "<br/>"; 
			*/
			$typeFilter = new TypeFilter();
			$typeFilter->setSid($_POST["sid"]);
			$typeFilter->setLastUpdate($_POST["lastUpdate"]);		
			
			$result = $typeMgr->updateType($type, $typeFilter);
			
			return $result;
		} // end updateResource()
									
		public function deleteResource()
		{
			$result = 0;
			if (isset($_POST["deleteTypeSid"]))
			{
				$typeMgr = new TypeMgr();
				
				$typeFilter = new TypeFilter();
				$typeFilter->setSid($_POST["deleteTypeSid"]);
				
				$result = $typeMgr->deleteType($typeFilter);
			}
			return $result;
			
			
		}	
	}
?>