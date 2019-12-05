<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/VoBase.php';

	class SystemMsg extends VoBase
	{
		private $sid;
		private $msgCode;		
		private $sysMsgEn;
		private $sysMsgTc;
		private $msgLv;
		private $type;
		private $remarks;
		private $lastUpdate;
		
		public function getSid() { return $this->sid; } 
		public function getMsgCode() { return $this->msgCode; } 
		public function getSysMsgEn() { return $this->sysMsgEn; } 
		public function getSysMsgTc() { return $this->sysMsgTc; } 
		public function getMsgLv() { return $this->msgLv; } 
		public function getType() { return $this->type; } 
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		public function setSid($x) { $this->sid = $x; } 
		public function setMsgCode($x) { $this->msgCode = $x; } 
		public function setSysMsgEn($x) { $this->sysMsgEn = $x; } 
		public function setSysMsgTc($x) { $this->sysMsgTc = $x; } 
		public function setMsgLv($x) { $this->msgLv = $x; } 
		public function setType($x) { $this->type = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 
	
		public function getDbFieldName($value)
		{
			switch ($value) 
			{
			    case "sid":
			        return "sid";
			        break;
			    case "msgCode":
			        return "Msg_Code";
			        break;
			    case "sysMsgEn":
			        return "Sys_Msg_En";
			        break;
			    case "sysMsgTc":
			        return "Sys_Msg_Tc";
			        break;
			    case "msgLv":
			        return "Msg_Lv";
			        break;
			    case "type":
			        return "Type";
			        break;
			    case "remarks":
			        return "Remarks";
			        break;
			    case "lastUpdate":
			        return "LastUpdate";
			        break;                        
			}
		} // end getDbFieldName		
		
		public function printValues()
		{
			return
				'Sid: ' . $this->getSid() . '<br/>' .
				'Msg Code: ' . $this->getMsgCode() . '<br/>' .
				'Sys Msg En: ' . $this->getSysMsgEn() . '<br/>' .
				'Sys Msg Tc: ' . $this->getSysMsgTc() . '<br/>' .
				'Msg Lv: ' . $this->getMsgLv() . '<br/>' .
				'Type : ' . $this->getType() . '<br/>' .
				'Remarks: ' . $this->getRemarks() . '<br/>' .
				'Last Update: ' . $this->getLastUpdate() . '<br/>'
				;
		}			
	}
?>