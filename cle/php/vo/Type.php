<?php
	class Type
	{
		protected $sid;
		protected $type;
		protected $remarks;
		protected $lastUpdate;
		
		public function getSid() { return $this->sid; } 
		public function getType() { return $this->type; } 
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		public function setSid($x) { $this->sid = $x; } 
		public function setType($x) { $this->type = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 		
		
		public static function getDbFieldName($value)
		{
			switch ($value) {
			    case "sid":
			        return "sid";
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
		
		
	} // end class Type
?>