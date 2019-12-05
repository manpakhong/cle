<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/IVoBase.php';
	require_once $currentDir. 'php/vo/VoBase.php';
	require_once $currentDir. 'php/system/SysParams.php';
	
	class Cm extends VoBase implements IVoBase
	{
		// Cm
		protected $sid;
		protected $objPageSid;
		protected $contentEn;
		protected $contentTc;
		protected $contentHtmlEn;
		protected $contentHtmlTc;
		protected $remarks;
		protected $lastUpdate;
		
		// ObjPage
		protected $sidO;
		protected $pageO;
		protected $urlO;
		protected $remarksO;
		protected $lastUpdateO;
		
		public function getDbFieldName($value)
		{
			switch ($value) {
				// Cm
			    case "sid":
			        return "sid";
			        break;
			    case "objPageSid":
			    	return "ObjPage_sid";
			    	break;
			    case "contentEn":
			    	return "Content_En";
			    	break;
			    case "contentTc":
			    	return "Content_Tc";
			    	break;		
			    case "contentHtmlEn":
			    	return "ContentHtml_En";
			    	break;
			    case "contentHtmlTc":
			    	return "ContentHtml_Tc";
			    	break;    				    	
			    case "remarks":
			    	return "Remarks";
					break;			    	
			    case "lastUpdate":
			    	return "LastUpdate";
			    	break;
			    	
			    // ObjPage
			    case "sidO":
			    	return "sidO";
			    	break;
			    case "pageO":
			    	return "PageO";
			    	break;
			    case "urlO":
			    	return "urlO";
			    	break;
			    case "remarksO":
			    	return "remarksO";
			    	break;
			    case "lastUpdateO":
			    	return "LastUpdateO";
			    	break;
			}
		} // end getDbFieldName($value)

			
		
		public function getSid() { return $this->sid; } 
		public function getObjPageSid() { return $this->objPageSid; }
		public function getContentEn() { return $this->contentEn; } 
		public function getContentTc() { return $this->contentTc; } 
		public function getContent($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getContentEn();
			}
			else
			{
				return $this->getContentTc();
			}			
		}	
		public function getContentHtmlEn() { return $this->contentHtmlEn; } 
		public function getContentHtmlTc() { return $this->contentHtmlTc; } 
		public function getContentHtml($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getContentHtmlEn();
			}
			else
			{
				return $this->getContentHtmlTc();
			}			
		}
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		
		public function setSid($x) { $this->sid = $x; } 
		public function setObjPageSid($x) { $this->objPageSid = $x; }
		public function setContentEn($x) { $this->contentEn = $x; } 
		public function setContentTc($x) { $this->contentTc = $x; } 
		public function setContentHtmlEn($x) { $this->contentHtmlEn = $x; } 
		public function setContentHtmlTc($x) { $this->contentHtmlTc = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 
		
		// ObjPage
		public function getSidO() { return $this->sidO; } 
		public function getPageO() { return $this->pageO; } 
		public function getUrlO() { return $this->urlO; } 
		public function getRemarksO() { return $this->remarksO; } 
		public function getLastUpdateO() { return $this->lastUpdateO; } 
		public function setSidO($x) { $this->sidO = $x; } 
		public function setPageO($x) { $this->pageO = $x; } 
		public function setUrlO($x) { $this->urlO = $x; } 
		public function setRemarksO($x) { $this->remarksO = $x; } 
		public function setLastUpdateO($x) { $this->lastUpdateO = $x; }		
		
		public function printValues()
		{
			return
				// Cm
				'--- Cm --- ' . "\n" .
				'Sid: ' . $this->getSid() ."\n".
				'Object Page Sid: ' . $this->getObjPageSid() . "\n" .
				'Content En: ' . $this->getContentEn() . "\n" .
				'Content Tc: ' . $this->getContentTc() . "\n" .
				'Content Html En: ' . $this->getContentHtmlEn() . "\n" .
				'Content Html Tc: ' . $this->getContentHtmlTc() . "\n" .
				'Remarks: ' . $this->getRemarks() . "\n" .
				'Last Update: ' . $this->getLastUpdate() . "\n" .
				
				// ObjPage
				'--- ObjPage --- ' . "\n" .
				'Sid O: ' . $this->getSidO() ."\n".
				'Page O: ' . $this->getPageO() . "\n" .
				'URL O: ' . $this->getUrlO() . "\n" .
				'Remarks O: ' . $this->getRemarksO() . "\n" .
				'Last Update O: ' . $this->getLastUpdateO() . "\n"

				;
		} // end printValues()
		
	} // end class

?>