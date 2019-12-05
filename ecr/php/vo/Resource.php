<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/VoBase.php';
	require_once $currentDir. 'php/system/SysParams.php';
	require_once $currentDir. 'php/vo/IVoBase.php';	
	
	class Resource extends VoBase implements IVoBase
	{
		// resource
		protected $sid;
		protected $seq;
		protected $url;
		protected $resourceNameEn;
		protected $resourceNameTc;
		protected $authorEn;
		protected $authorTc;
		protected $briefingEn;
		protected $briefingTc;
		protected $briefingHtmlEn;
		protected $briefingHtmlTc;
		protected $typeMenuSid;
		protected $typeSid;
		protected $imageUrl;
		protected $isShown;
		protected $remarks;
		protected $lastUpdate;

		// menubar
		protected $sidM;
		protected $seqM;
		protected $lvM;
		protected $lvTextEnM;
		protected $lvTextTcM;
		protected $upLvSidM;
		protected $isShownM;
		protected $isNetvigatedM;
		protected $urlM;
		protected $remarksM;
		protected $lastUpdateM;
		
		// type
		protected $sidT;
		protected $typeEnT;
		protected $typeTcT;
		protected $remarksT;
		protected $lastUpdateT;
		
		public function getDbFieldName($value)
		{
			switch ($value) {
				// resource
			    case "sid":
			        return "sid";
			        break;
			    case "seq":
			        return "Seq";
			        break;			        
			    case "url":
			        return "url";
			        break;
			    case "resourceNameEn":
			        return "ResourceName_En";
			        break;
			    case "resourceNameTc":
			        return "ResourceName_Tc";
			        break;			        
			    case "authorEn":
			        return "Author_En";
			        break;
			    case "authorTc":
			        return "Author_Tc";
			        break;	
			    case "briefingEn":
			        return "Briefing_En";
			        break;		
			    case "briefingTc":
			        return "Briefing_Tc";
			        break;		
			    case "briefingHtmlEn":
			    	return "BriefingHtml_En";
			    	break;
			    case "briefingHtmlTc":
			    	return "BriefingHtml_Tc";
			    	break;			        			        		        
			    case "typeMenuSid":
			        return "TypeMenu_sid";
			        break;
			    case "typeSid":
			        return "Type_sid";
			        break;			    				           
			    case "imageUrl":
			    	return "Image_url";
			    	break; 
			    case "isShown" :
			    	return "IsShown";
			    	break;
			    case "remarks";
			    	return "Remarks";
			    	break;
			    case "lastUpdate":
			        return "LastUpdate";
			        break;

		        // menubar
			    case "sidM":
			    	return "sidM";
			    	break;
			    case "seqM":
			    	return "SeqM";
			    	break;
			    case "lvM":
			    	return "LVM";
			    	break;
			    case "lvTextEnM":
			    	return "LV_Text_EnM";
			    	break;
			    case "lvTextTcM":
			    	return "LV_Text_TcM";
			    	break;
			    case "upLvSidM":
			    	return "UpLV_sidM";
			    	break;
			    case "isShownM":
			    	return "IsShownM";
			    	break;
			    case "isNetvigatedM":
			    	return "IsNetvigatedM";
			    	break;
			    case "urlM":
			    	return "urlM";
			    	break;
			    case "remarksM":
			    	return "RemarksM";
			    	break;
			    case "lastUpdateM":
			    	return "LastUpdateM";
			    	break;
			    	
			    // type
			    case "sidT":
			    	return "sidT";
			    	break;
			    case "typeEnT":
			    	return "Type_EnT";
			    	break;
			    case "typeTcT":
			    	return "Type_TcT";
			    	break;
			    case "remarksT":
			    	return "RemarksT";
			    	break;
			    case "lastUpdateT":
			    	return "LastUpdateT";
			    	break;
			} // end switch
		} // end getDbFieldName		
		
		// resource
		public function getSid() { return $this->sid; } 
		public function getSeq() { return $this->seq; }
		public function getUrl() { return $this->url; } 
		public function getResourceName($_systemLang)
		{
			switch ($_systemLang)
			{
				case SystemParam::$SYSTEM_LANGUAGE_EN:
					return $this->getResourceNameEn();
					break;
				case SystemParam::$SYSTEM_LANGUAGE_TC:
					return $this->getResourceNameTc();
					break;
				default:
					return $this->getResourceNameEn();
					break;
			}
		}
		public function getResourceNameEn() { return $this->resourceNameEn; } 
		public function getResourceNameTc() { return $this->resourceNameTc; } 
		public function getAuthorEn() { return $this->authorEn; } 
		public function getAuthorTc() { return $this->authorTc; } 
		public function getAuthor($_systemLang)
		{
			switch ($_systemLang)
			{
				case SystemParam::$SYSTEM_LANGUAGE_EN:
					return $this->getAuthorEn();
					break;
				case SystemParam::$SYSTEM_LANGUAGE_TC:
					return $this->getAuthorTc();
					break;
				default:
					return $this->getAuthorEn();
					break;
			}
		}		
		public function getBriefingEn() { return $this->briefingEn; } 
		public function getBriefingTc() { return $this->briefingTc; } 
		public function getBriefing($_systemLang)
		{
			switch ($_systemLang)
			{
				case SystemParam::$SYSTEM_LANGUAGE_EN:
					return $this->getBriefingEn();
					break;
				case SystemParam::$SYSTEM_LANGUAGE_TC:
					return $this->getBriefingTc();
					break;
				default:
					return $this->getBriefingEn();
					break;
			}			
		}		
		
		public function getBriefingHtmlEn() { return $this->briefingHtmlEn; } 
		public function getBriefingHtmlTc() { return $this->briefingHtmlTc; } 
		public function getBriefingHtml($_systemLang)
		{
			switch ($_systemLang)
			{
				case SystemParam::$SYSTEM_LANGUAGE_EN:
					return $this->getBriefingHtmlEn();
					break;
				case SystemParam::$SYSTEM_LANGUAGE_TC:
					return $this->getBriefingHtmlTc();
					break;
				default:
					return $this->getBriefingHtmlEn();
					break;
			}			
		}	
		
		
		
		public function getTypeMenuSid() { return $this->typeMenuSid; } 
		public function getTypeSid() { return $this->typeSid; } 
		public function getType($_systemLang)
		{
			switch ($_systemLang)
			{
				case SystemParam::$SYSTEM_LANGUAGE_EN:
					return $this->getTypeEn();
					break;
				case SystemParam::$SYSTEM_LANGUAGE_TC:
					return $this->getTypeTc();
					break;
				default:
					return $this->getTypeEn();
					break;
			}			
		}
		public function getImageUrl() { return $this->imageUrl; } 
		public function getIsShown() { return $this->isShown; }
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		public function setSid($x) { $this->sid = $x; } 
		public function setSeq($x) { $this->seq = $x; }
		public function setUrl($x) { $this->url = $x; } 
		public function setResourceNameEn($x) { $this->resourceNameEn = $x; } 
		public function setResourceNameTc($x) { $this->resourceNameTc = $x; } 
		public function setAuthorEn($x) { $this->authorEn = $x; } 
		public function setAuthorTc($x) { $this->authorTc = $x; } 
		public function setBriefingEn($x) { $this->briefingEn = $x; } 
		public function setBriefingTc($x) { $this->briefingTc = $x; } 
		public function setBriefingHtmlEn($x) { $this->briefingHtmlEn = $x; } 
		public function setBriefingHtmlTc($x) { $this->briefingHtmlTc = $x; } 			
		public function setTypeMenuSid($x) { $this->typeMenuSid = $x; } 
		public function setTypeSid($x) { $this->typeSid = $x; } 
		public function setImageUrl($x) { $this->imageUrl = $x; } 
		public function setIsShown($x) { $this->isShown = $x; }
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 

		// menutype
		
		public function getSidM() { return $this->sidM; } 
		public function getSeqM() { return $this->seqM; } 
		public function getLvM() { return $this->lvM; } 
		public function getLvTextEnM() { return $this->lvTextEnM; } 
		public function getLvTextTcM() { return $this->lvTextTcM; }
		public function getLvTextM($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getLvTextEnM();
			}
			else
			{
				return $this->getLvTextTcM();
			}
		}
		public function getUpLvSidM() { return $this->upLvSidM; } 
		public function getIsShownM() { return $this->isShownM; } 
		public function getIsNetvigatedM() { return $this->isNetvigatedM; } 
		public function getUrlM() { return $this->urlM; } 
		public function getRemarksM() { return $this->remarksM; } 
		public function getLastUpdateM() { return $this->lastUpdateM; }
		 
		public function setSidM($x) { $this->sidM = $x; } 
		public function setSeqM($x) { $this->seqM = $x; } 
		public function setLvM($x) { $this->lvM = $x; } 
		public function setLvTextEnM($x) { $this->lvTextEnM = $x; } 
		public function setLvTextTcM($x) { $this->lvTextTcM = $x; } 
		public function setUpLvSidM($x) { $this->upLvSidM = $x; } 
		public function setIsShownM($x) { $this->isShownM = $x; } 
		public function setIsNetvigatedM($x) { $this->isNetvigatedM = $x; } 
		public function setUrlM($x) { $this->urlM = $x; } 
		public function setRemarksM($x) { $this->remarksM = $x; } 
		public function setLastUpdateM($x) { $this->lastUpdateM = $x; } 		
		
		// type
		public function getSidT() { return $this->sidT; } 
		public function getTypeEnT() { return $this->typeEnT; } 
		public function getTypeTcT() { return $this->typeTcT; } 
		public function getTypeT($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getTypeEnT();
			}
			else
			{
				return $this->getTypeTcT();
			}			
		}
		public function getRemarksT() { return $this->remarksT; } 
		public function getLastUpdateT() { return $this->lastUpdateT; } 
		public function setSidT($x) { $this->sidT = $x; } 
		public function setTypeEnT($x) { $this->typeEnT = $x; } 
		public function setTypeTcT($x) { $this->typeTcT = $x; } 
		public function setRemarksT($x) { $this->remarksT = $x; } 
		public function setLastUpdateT($x) { $this->lastUpdateT = $x; } 
				
		public function printValues()
		{
			return
				'--- resource ---' . "\n" .
				'Sid: ' . $this->sid . "\n" .
				'Seq: ' . $this->seq . "\n" .
				'Url: ' . $this->url . "\n" .
				'Resource Name En: ' . $this->resourceNameEn . "\n" .
				'Resource Name Tc: ' . $this->resourceNameTc . "\n" .
				'Author En: ' . $this->authorEn . "\n" .
				'Author Tc: ' . $this->authorTc . "\n" .
				'Briefing En: ' . $this->briefingEn . "\n" .
				'Briefing Tc: ' . $this->briefingTc . "\n" .
				'Briefing Html En: ' . $this->briefingHtmlEn . "\n" .
				'Briefing Html Tc: ' . $this->briefingHtmlTc . "\n" .
				'TypeMenu Sid: ' . $this->typeMenuSid . "\n" .
				'Type Sid: ' . $this->typeSid . "\n" .
				'Type En: ' . $this->typeEn . "\n" .
				'Type Tc: ' . $this->typeTc . "\n" .
				'Image Url: ' . $this->imageUrl . "\n" .
				'Is Shown: ' . $this->isShown . "\n" .
				'Remarks: ' . $this->remarks . "\n" .
				'Last Update: ' . $this->lastUpdate . "\n" .
				'--- menutype ---' . "\n" .
				'Sid M: ' . $this->getSidM() . "\n" .
				'Seq M: ' . $this->getSeqM() . "\n" .
				'Lv M: ' . $this->getLvM() . "\n" .
				'Lv Text En M: ' . $this->getLvTextEnM() . "\n" .
				'Lv Text Tc M: ' . $this->getLvTextTcM() . "\n" .
				'UpLvSid M: ' . $this->getUpLvSidM() . "\n" .
				'Is Shown M: ' . $this->getIsShownM() . "\n" .
				'Is Netvigated M: ' . $this->getIsNetvigatedM() . "\n" .
				'URL M: ' . $this->getUrlM() . "\n" .
				'Remarks M: ' . $this->getRemarksM() . "\n" .
				'LastUpdate M: ' . $this->getLastUpdateM() . "\n" .
				'--- type ---' . "\n" .
				'Sid T: ' . $this->getSidT() . "\n" .
				'Type En T: ' . $this->getTypeEnT() . "\n" .
				'Type Tc T: ' . $this->getTypeTcT() . "\n" .
				'Remarks T: ' . $this->getRemarksT() . "\n" .
				'LastUpdate T: ' . $this->getLastUpdateT() . "\n"
				;
		}
		
	}// end class


?>