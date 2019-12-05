<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/VoBase.php';
	require_once $currentDir. 'php/system/SysParams.php';
	require_once $currentDir. 'php/vo/IVoBase.php';	
	
	class Type extends VoBase implements IVoBase
	{
		protected $sid;
		protected $typeEn;
		protected $typeTc;
		protected $remarks;
		protected $lastUpdate;
		
		public function getDbFieldName($value)
		{
			switch ($value) 
			{
				// resource
			    case "sid":
			        return "sid";
			        break;
			    case "typeEn":
			        return "Type_En";
			        break;	
			    case "typeTc":
			    	return "Type_Tc";
			    	break;
			    case "remarks":
			    	return "Remarks";
			    	break;
			    case "lastUpdate":
			    	return "LastUpdate";
			    	break;
			} // end switch ($value)
		} // end getDbFieldName($value)
		
		public function getSid() { return $this->sid; } 
		public function getTypeEn() { return $this->typeEn; } 
		public function getTypeTc() { return $this->typeTc; } 
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		public function setSid($x) { $this->sid = $x; } 
		public function setTypeEn($x) { $this->typeEn = $x; } 
		public function setTypeTc($x) { $this->typeTc = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 		
		
		public function printValues()
		{
			return
				'Sid: ' . $this->getSid() . "\n" .
				'Type (En): ' . $this->getTypeEn() . "\n" .
				'Type (Tc): ' . $this->getTypeTc() . "\n" .
				'Remarks: ' . $this->getRemarks() . "\n" .
				'LastUpdate: ' . $this->getLastUpdate() . "\n"
				;
		}		
		
	} // end class
?>