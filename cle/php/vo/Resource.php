<?php
	class Resource
	{
		protected $sid;
		protected $url;
		protected $resourceName;
		protected $author;
		protected $teachingAims;
		protected $typeMenuSid;
		protected $typeSid;
		protected $type;
		protected $remarks;
		protected $pic;
		protected $imageUrl;
		protected $lastUpdate;

		
		public static function getDbFieldName($value)
		{
			switch ($value) {
			    case "sid":
			        return "sid";
			        break;
			    case "url":
			        return "URL";
			        break;
			    case "resourceName":
			        return "ResourceName";
			        break;
			    case "author":
			        return "Author";
			        break;
			    case "teachinAims":
			        return "TeachingAims";
			        break;
			    case "typeMenuSid":
			        return "TypeMenu_sid";
			        break;   
			    case "typeSid":
			    	return "Type_sid";
			    	break;
			    case "type":
			    	return "Type";
			    	break;  
			    case "remarks";
			    	return "Remarks";
			    	break;
			    case "pic":
			    	return "Pic";
			    	break;
				case "imageUrl":
					return "Image_URL";
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
		public function setImageUrl($value)
		{
			$this->imageUrl = strtolower($value);
		}
		public function getImageUrl()
		{
			return strtolower($this->imageUrl);
		}		
		public function setPic($value)
		{
			$this->imageUrl = $value;
		}
		public function getPic()
		{
			return $this->pic;
		}
		public function setRemarks($value)
		{
			$this->remarks = $value;
		}
		public function getRemarks()
		{
			return $this->remarks;
		}						
		public function setType($value)
		{
			$this->type = $value;
		}
		public function getType()
		{
			return $this->type;
		}
		public function setTypeSid($value)
		{
			$this->typeSid = $value;
		}
		public function getTypeSid()
		{
			return $this->typeSid;
		}
		public function setTypeMenuSid($value)
		{
			$this->typeMenuSid = $value;
		}
		public function getTypeMenuSid()
		{
			return $this->typeMenuSid;
		}		
		public function setTeachingAims($value)
		{
			$this->teachingAims = $value;
		}
		public function getTeachingAims()
		{
			return stripslashes($this->teachingAims);
		}
		public function setAuthor($value)
		{
			$this->author = $value;
		}
		public function getAuthor()
		{
			return $this->author;
		}
		public function setResourceName($value)
		{
			$this->resourceName = $value;
		}
		public function getResourceName()
		{
			return $this->resourceName;
		}
		public function setUrl($value)
		{
			$this->url = $value;
		}
		public function getUrl()
		{
			return $this->url;
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