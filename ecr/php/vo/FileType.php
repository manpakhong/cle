<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/IVoBase.php';
	require_once $currentDir. 'php/vo/VoBase.php';
	require_once $currentDir. 'php/system/SysParams.php';
	
	class FileType extends VoBase implements IVoBase
	{
		protected $sid;
		protected $fileTypeEn;
		protected $fileTypeTc;
		protected $fileTypeIcon;
		protected $remarks;
		protected $lastUpdate;
		
		public function getDbFieldName($value)
		{
			switch ($value) {
			    case "sid":
			        return "sid";
			        break;
			    case "fileTypeEn":
			    	return "File_Type_En";
			    	break;
			    case "fileTypeTc":
			    	return "File_Type_Tc";
			    	break;
			    case "fileTypeIcon":
					return "File_Type_Icon";
					break;
			    case "remarks":
			    	return "Remarks";
					break;			    	
			    case "lastUpdate":
			    	return "LastUpdate";
			    	break;
			}
		} // end getDbFieldName($value)
		
		public function getSid() { return $this->sid; } 
		public function getFileType($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getFileTypeEn();
			}
			else
			{
				return $this->getFileTypeTc();
			}
		}
		public function getFileTypeEn() { return $this->fileTypeEn; } 
		public function getFileTypeTc() { return $this->fileTypeTc; } 
		public function getFileTypeIcon() { return $this->fileTypeIcon; }
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		public function setSid($x) { $this->sid = $x; } 
		public function setFileTypeEn($x) { $this->fileTypeEn = $x; } 
		public function setFileTypeTc($x) { $this->fileTypeTc = $x; }
		public function setFileTypeIcon() { $this->fileTypeIcon = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 
		
		public function printValues()
		{
			return
				'Sid: ' . $this->getSid() .'<br/>'.
				'File Type En: ' . $this->getFileTypeEn() . '<br/>'.
				'File Type Tc: ' . $this->getFileTypeTc() . '<br/>' .
				'File Type Icon: ' . $this->getFileTypeIcon() . '<br/>' .
				'Remarks: ' . $this->getRemarks() . '<br/>' .
				'Last Update: ' . $this->getLastUpdate() . '<br/>'
				;
		} // end printValues()
		
	} // end FileCabinet

?>