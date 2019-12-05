<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/IVoBase.php';
	require_once $currentDir. 'php/vo/VoBase.php';
	require_once $currentDir. 'php/system/SysParams.php';
	
	class ObjPage extends VoBase implements IVoBase
	{
		
		// ObjPage
		protected $sid;
		protected $page;
		protected $url;
		protected $remarks;
		protected $lastUpdate;
		
		public function getDbFieldName($value)
		{
			switch ($value) 
			{    	
			    // ObjPage
			    case "sid":
			    	return "sid";
			    	break;
			    case "page":
			    	return "Page";
			    	break;
			    case "url":
			    	return "url";
			    	break;
			    case "remarks":
			    	return "remarks";
			    	break;
			    case "lastUpdate":
			    	return "LastUpdate";
			    	break;
			}
		} // end getDbFieldName($value)
		
		public function getSid() { return $this->sid; } 
		public function getPage() { return $this->page; } 
		public function getUrl() { return $this->url; } 
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		public function setSid($x) { $this->sid = $x; } 
		public function setPage($x) { $this->page = $x; } 
		public function setUrl($x) { $this->url = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 
		
		public function printValues()
		{
			return
				// ObjPage
				'Sid : ' . $this->getSid() ."\n".
				'Page : ' . $this->getPage() . "\n" .
				'URL : ' . $this->getUrl() . "\n" .
				'Remarks : ' . $this->getRemarks() . "\n" .
				'Last Update : ' . $this->getLastUpdate() . "\n"
				;
		} // end printValues()
		
	} // end class

?>