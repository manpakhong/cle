<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/VoBase.php';
	
	class MenuBar extends VoBase
	{
		protected $sid;
		protected $seq;
		protected $lv;
		protected $lvTextEn;
		protected $lvTextTc;
		protected $upLvSid;
		protected $isShown;
		protected $isNetvigated;
		protected $url;
		protected $remarks;
		protected $lastUpdate;
		
		public function __construct()
		{
			
		}
		
		public static function getDbFieldName($value)
		{
			switch ($value) {
			    case "sid":
			        return "sid";
			        break;
			    case "seq":
			        return "Seq";
			        break;
			    case "lv":
			        return "LV";
			        break;
			    case "lvTextEn":
			        return "LV_Text_En";
			        break;
			    case "lvTextTc":
			        return "LV_Text_Tc";
			        break;
			    case "upLvSid":
			        return "UpLV_sid";
			        break;   
			    case "isShown":
			    	return "IsShown";
			    	break;
			    case "isNetvigated":
			    	return "IsNetvigated";
			    	break;  
			    case "url";
			    	return "url";
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
		public function getSeq() { return $this->seq; } 
		public function getLv() { return $this->lv; } 
		public function getLvText($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getLvTextEn();
			}
			else
			{
				return $this->getLvTextTc();
			}
		}
		public function getLvTextEn() { return $this->lvTextEn; } 
		public function getLvTextTc() { return $this->lvTextTc; } 
		public function getUpLvSid() { return $this->upLvSid; } 
		public function getIsShown() { return $this->isShown; } 
		public function getIsNetvigated() { return $this->isNetvigated; } 
		public function getUrl() { return $this->url; } 
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		public function setSid($x) { $this->sid = $x; } 
		public function setSeq($x) { $this->seq = $x; } 
		public function setLv($x) { $this->lv = $x; } 
		public function setLvTextEn($x) { $this->lvTextEn = $x; } 
		public function setLvTextTc($x) { $this->lvTextTc = $x; } 
		public function setUpLvSid($x) { $this->upLvSid = $x; } 
		public function setIsShown($x) { $this->isShown = $x; } 
		public function setIsNetvigated($x) { $this->isNetvigated = $x; } 
		public function setUrl($x) { $this->url = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 		
		
		public function printValues()
		{
			return 
			'Sid: ' . $this->sid . '<br/>' .
			'Seq: ' . $this->seq . '<br/>' .
			'Lv: ' . $this->lv . '<br/>' .
			'Lv Text En: ' . $this->lvTextEn . '<br/>' .
			'Lv Text Chi: ' . $this->lvTextTc . '<br/>' .
			'Up Lv Sid: ' . $this->upLvSid . '<br/>' .
			'Is Shown: ' . $this->isShown . '<br/>' .
			'Is Netvigated: ' . $this->isNetvigated . '<br/>' .
			'Url: ' . $this->url . '<br/>' .
			'Remarks: ' . $this->remarks . '<br/>';
		}
	}
?>