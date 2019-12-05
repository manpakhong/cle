<?php
	class ResourceType
	{
		protected $sid;
		protected $seq;
		protected $lv;
		protected $lvText;
		protected $upLvSid;
		protected $isShown;
		protected $isNetvigated;
		protected $url;
		protected $remarks;
		protected $lastUpdate;
		
		public function __construct()
		{
			$upLvSid = null;
			$this->isNetvigated = true;
			$this->isShown = true;
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
			        return "Lv";
			        break;
			    case "lvText":
			        return "LV_Text";
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
		}
		
		public function setLastUpdate($value)
		{
			$this->lastUpdate = $value;
		}
		public function getLastUpdate()
		{
			return $this->lastUpdate;
		}
		public function setUrl($value)
		{
			$this->url = $value;
		}
		public function getUrl()
		{
			return $this->url;
		}
		public function setRemarks($value)
		{
			$this->remarks = $value;
		}
		public function getRemarks()
		{
			return $this->remarks;
		}
		public function setUpLvSid($value)
		{
			$this->upLvSid = $value;
		}
		public function getUpLvSid()
		{
			return $this->upLvSid;
		}
		public function setIsNetvigated($value)
		{
			$this->isNetvigated = $value;	

		}
		public function getIsNetvigated()
		{
			return $this->isNetvigated;
		}
		public function setIsShown($value)
		{
			$this->isShown = $value;
		}
		public function getIsShown()
		{
			return $this->isShown;
		}
		public function setLvText($value)
		{
			$this->lvText = $value;
		}
		public function getLvText()
		{
			return $this->lvText;
		}
		public function setLv($value)
		{
			$this->lv = $value;
		}
		public function getLv()
		{
			return $this->lv;
		}
		public function setSeq($value)
		{
			$this->seq = $value;
		}
		public function getSeq()
		{
			return $this->seq;
		}
		public function setSid($value)
		{
			$this->sid = $value;
		}
		public function getSid()
		{
			return $this->sid;
		}

		protected function outputVarsList() 
		{
			$arrayList = new ArrayList();
			
			$arrayoutput = array();
					
			foreach($this as $var => $value) 
			{
				// echo "$var is $value\n";
				$arrayoutput[$var] = $value;
			}
					
			return $arrayoutput;
		}		
		
	}
?>