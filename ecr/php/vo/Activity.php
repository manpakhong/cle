<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/IVoBase.php';
	require_once $currentDir. 'php/vo/VoBase.php';
	require_once $currentDir. 'php/system/SysParams.php';
	
	class Activity extends VoBase implements IVoBase
	{
		protected $sid;
		protected $seq;
		protected $activityNameEn;
		protected $activityNameTc;
		protected $contentEn;
		protected $contentTc;
		protected $contentHtmlEn;
		protected $contentHtmlTc;
		protected $speakerEn;
		protected $speakerTc;
		protected $isShown;
		protected $activityDate;
		protected $activityDateFrom;
		protected $activityDateTo;
		protected $remarks;
		protected $lastUpdate;
		
		public function getDbFieldName($value)
		{
			switch ($value) {
			    case "sid":
			        return "sid";
			        break;
			    case "seq":
			    	return "Seq";
			    	break;
			    case "activityNameEn":
			    	return "Activity_Name_En";
			    	break;
			    case "activityNameTc":
			    	return "Activity_Name_Tc";
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
			    case "speakerEn":
			    	return "Speaker_En";
			    	break;
			    case "speakerTc":
			    	return "Speaker_Tc";
			    	break;
			    case "isShown":
			    	return "IsShown";
			    	break;
			    case "activityDateFrom":
			    	return "Activity_Date_From";
			    	break;
			    case "activityDateTo":
			    	return "Activity_Date_To";
			    	break;
			    case "activityDate":
			    	return "Activity_Date";
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
		public function getActivityName($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getActivityNameEn();
			}
			else
			{
				return $this->getActivityNameTc();
			}
		}
		public function getActivityNameEn() { return $this->activityNameEn; } 
		public function getActivityNameTc() { return $this->activityNameTc; }
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
		public function getSpeaker($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getSpeakerEn();
			}
			else
			{
				return $this->getSpeakerTc();
			}
		} 
		public function getSpeakerEn() { return $this->speakerEn; } 
		public function getSpeakerTc() { return $this->speakerTc; }
		public function getIsShown() { return $this->isShown; }  
		public function getActivityDate() { return $this->activityDate; } 
		public function getActivityDateD()
		{
			$d = substr($this->activityDate,0, 10);
			$dr = explode('-', $d);
			
			$dt = new DateTime();
			$dt->setDate($dr[0], $dr[1], $dr[2]);
			return $dt;

		}
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; }
		 
		public function setSid($x) { $this->sid = $x; } 
		public function setSeq($x) { $this->seq = $x; } 
		public function setActivityNameEn($x) { $this->activityNameEn = $x; } 
		public function setActivityNameTc($x) { $this->activityNameTc = $x; } 
		public function setContentEn($x) { $this->contentEn = $x; } 
		public function setContentTc($x) { $this->contentTc = $x; } 
		public function setContentHtmlEn($x) { $this->contentHtmlEn = $x; } 
		public function setContentHtmlTc($x) { $this->contentHtmlTc = $x; } 
		public function setSpeakerEn($x) { $this->speakerEn = $x; } 
		public function setSpeakerTc($x) { $this->speakerTc = $x; } 
		public function setIsShown($x) { $this->isShown = $x; } 
		public function setActivityDate($x) { $this->activityDate = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 
		
		public function getActivityDateFrom() { return $this->activityDateFrom; } 
		public function getActivityDateTo() { return $this->activityDateTo; } 
		public function setActivityDateFrom($x) { $this->activityDateFrom = $x; } 
		public function setActivityDateTo($x) { $this->activityDateTo = $x; } 		
		

		
		
		public function printValues()
		{
			return
				'Sid: ' . $this->getSid() ."\n".
				'Seq: ' . $this->getSeq() . "\n" .
				'Activity Name En: ' . $this->getActivityNameEn() . "\n" .
				'Activity Name Tc: ' . $this->getActivityNameTc() . "\n" .
				'Content En: ' . $this->getContentEn() . "\n" .
				'Content Tc: ' . $this->getContentTc() . "\n" .
				'Content Html En: ' . $this->getContentHtmlEn() . "\n" .
				'Content Html Tc: ' . $this->getContentHtmlTc() . "\n" .
				'Speaker En: ' . $this->getSpeakerEn() . "\n" .
				'Speaker Tc: ' . $this->getSpeakerTc() . "\n" .
				'Is Shown: ' . $this->getIsShown() . "\n" .
				'Activity Date: ' . $this->getActivityDate() . "\n" .
				'Activity Date From: ' . $this->getActivityDateFrom() . "\n" .
				'Activity Date To: ' . $this->getActivityDateTo() . "\n" .
				'Remarks: ' . $this->getRemarks() . "\n" .
				'Last Update: ' . $this->getLastUpdate() . "\n"
				;
		} // end printValues()
		
	} // end FileCabinet

?>