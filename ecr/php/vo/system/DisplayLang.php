<?php
	
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/VoBase.php';

	class DisplayLang extends VoBase
	{
		protected $sid;
		protected $labelId;
		protected $objPageSid;
		protected $page;
		protected $url;
		protected $objTypeSid;
		protected $type;
		protected $contentEn;
		protected $contentTc;
		protected $remarks;
		protected $lastUpdate;
		
		public function getSid() { return $this->sid; } 
		public function getLabelId() { return $this->labelId; } 
		public function getObjPageSid() { return $this->objPageSid; } 
		public function getPage() { return $this->page; } 
		public function getUrl() { return $this->url; } 
		public function getObjTypeSid() { return $this->objTypeSid; } 
		public function getType() { return $this->type; } 
		public function getContentEn() { return $this->contentEn; } 
		public function getContentTc() { return $this->contentTc; } 
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		public function setSid($x) { $this->sid = $x; } 
		public function setLabelId($x) { $this->labelId = $x; } 
		public function setObjPageSid($x) { $this->objPageSid = $x; } 
		public function setPage($x) { $this->page = $x; } 
		public function setUrl($x) { $this->url = $x; } 
		public function setObjTypeSid($x) { $this->objTypeSid = $x; } 
		public function setType($x) { $this->type = $x; } 
		public function setContentEn($x) { $this->contentEn = $x; } 
		public function setContentTc($x) { $this->contentTc = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 		
		
		public function getDbFieldName($value)
		{
			switch ($value) {
			    case 'sid':
			        return 'sid';
			        break;
			    case 'labelId':
			    	return 'Label_id';
			    	break;
		    	case 'objPageSid':
			    	return 'ObjPage_sid';
			    	break;
		    	case 'page':
			    	return 'Page';
			    	break;
		    	case 'url':
			    	return 'url';
			    	break;
		    	case 'objTypeSid':
			    	return 'ObjType_sid';
			    	break;
		    	case 'type':
			    	return 'Type';
			    	break;
		    	case 'contentEn':
			    	return 'Content_En';
			    	break;
		    	case 'contentTc':
			    	return 'Content_Tc';
			    	break;
		    	case 'remarks':
			    	return 'Remarks';
			    	break;
	    		case 'lastUpdate':
			    	return 'LastUpdate';
			    	break;
			}
		} // end getDbFieldName()
		
		public function getContent($_systemLang)
		{
			$return = '';
			switch($_systemLang)
			{
				case SystemParam::$SYSTEM_LANGUAGE_EN:
					$return = $this->getContentEn();
					break;
				case SystemParam::$SYSTEM_LANGUAGE_TC:
					$return = $this->getContentTc();
					break;
				default:
					$return = $this->getContentEn();
					break;
			}
			return $return;
		}
		
		public function printValues()
		{
			return
				'Sid: ' . $this->getSid() . "\n" .
				'Label Id: ' . $this->getLabelId() . "\n" .
				'Obj Page Sid: ' . $this->getObjPageSid() . "\n" .
				'Page: ' . $this->getPage() . "\n" .
				'url: ' . $this->getUrl() . "\n" .
				'Obj Type Sid: ' . $this->getObjTypeSid() . "\n" .
				'Type: ' . $this->getType() . "\n" .			
				'Content En: ' . $this->getContentEn() . "\n" .
				'Content Tc: ' . $this->getContentTc() . "\n" .
				'Remarks: ' . $this->getRemarks() . "\n" .
				'LastUpdate: ' . $this->getLastUpdate() . "\n"
				;
		}			
		
	} // end class
?>