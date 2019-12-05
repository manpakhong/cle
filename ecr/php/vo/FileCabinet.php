<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/IVoBase.php';
	require_once $currentDir. 'php/vo/VoBase.php';
	require_once $currentDir. 'php/system/SysParams.php';
	
	class FileCabinet extends VoBase implements IVoBase
	{
		// FileCabinet
		protected $sid;
		protected $seq;
		protected $activitySid;
		protected $fileNameEn;
		protected $fileNameTc;
		protected $descriptionEn;
		protected $descriptionTc;
		protected $fileTypeSid;
		protected $filePath;
		protected $isShown;
		protected $remarks;
		protected $fileDate;
		protected $lastUpdate;
		
		// Activity
		protected $sidA;
		protected $seqA;
		protected $activityNameEnA;
		protected $activityNameTcA;
		protected $contentEnA;
		protected $contentTcA;
		protected $contentHtmlEnA;
		protected $contentHtmlTcA;
		protected $speakerEnA;
		protected $speakerTcA;
		protected $isShownA;
		protected $activityDateA;
		protected $remarksA;
		protected $lastUpdateA;	
			
		// FileType
		protected $sidT;
		protected $fileTypeEnT;
		protected $fileTypeTcT;
		protected $fileTypeIconT;
		protected $remarksT;
		protected $lastUpdateT;
		
		
		public function getDbFieldName($value)
		{
			switch ($value) {
				// --- FileCabinet
			    case "sid":
			        return "sid";
			        break;
			    case "seq":
			    	return "Seq";
			    	break;
			    case "activitySid":
			    	return "Activity_sid";
			    	break;
			    case "fileNameEn":
			    	return "File_Name_En";
			    	break;
			    case "fileNameTc":
			    	return "File_Name_Tc";
			    	break;
			    case "descriptionEn":
			    	return "Description_En";
			    	break;
			    case "descriptionTc":
			    	return "Description_Tc";
			    	break;
				case "fileTypeSid":
					return "FileType_sid";
					break;
			    case "filePath":
			    	return "File_Path";
			    	break;
			    case "isShown":
			    	return "IsShown";
			    	break;
			    case "remarks":
			    	return "Remarks";
					break;		
			    case "fileDate":	
			    	return "File_Date";
			    	break;    	
			    case "lastUpdate":
			    	return "LastUpdate";
			    	break;
			    
			    // --- Activity
			    case "sidA":
			    	return "sidA";
			    	break;
			    case "seqA":
			    	return "SeqA";
			    	break;
			    case "activityNameEnA":
			    	return "Activity_Name_EnA";
			    	break;
			    case "activityNameTcA":
			    	return "Activity_Name_TcA";
			    	break;
			    case "contentEnA":
			    	return "Content_EnA";
			    	break;
			    case "contentTcA":
			    	return "Content_TcA";
			    	break;
			    case "contentHtmlEnA":
			    	return "ContentHtml_EnA";
			    	break;
			    case "contentHtmlTcA":
			    	return "ContentHtml_TcA";
			    	break;			    	
			    case "speakerEnA":
			    	return "Speaker_EnA";
			    	break;
			    case "speakerTcA":
			    	return "Speaker_TcA";
			    	break;
			    case "isShownA":
			    	return "IsShownA";
			    	break;
			    case "activityDateA":
			    	return "Activity_DateA";
			    	break;
			    case "remarksA":
			    	return "RemarksA";
			    	break;
			    case "lastUpdateA":
			    	return "LastUpdateA";
			    	break;
			    	
			    // --- FileType
			    	
			    case "sidT":
			    	return "sidT";
			    	break;
			    case "fileTypeEnT":
			    	return "File_Type_EnT";
			    	break;
			    case "fileTypeTcT":
			    	return "File_Type_TcT";
			    	break;
			    case "fileTypeIconT":
			    	return "File_Type_IconT";
			    	break;
			    case "RemarksT":
			    	return "RemarksT";
			    	break;
			    case "LastUpdateT":
			    	return "LastUpdateT";
			    	break;
			    	
			}
		} // end getDbFieldName($value)
		
		public function getSid() { 
			return $this->sid; 
		} 
		public function getSeq() { return $this->seq; } 
		public function getActivitySid() { return $this->activitySid; } 
		public function getFileName($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getFileNameEn(); 
			}
			else
			{
				return $this->getFileNameTc();
			}
		}
		public function getFileNameEn() { return $this->fileNameEn; } 
		public function getFileNameTc() { return $this->fileNameTc; }
		public function getDescription($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getDescriptionEn();
			}
			else
			{
				return $this->getDescriptionTc();
			}
		} 
		public function getDescriptionEn() { return $this->descriptionEn; } 
		public function getDescriptionTc() { return $this->descriptionTc; } 
		public function getFilePath() { return $this->filePath; } 
		public function getFileTypeSid() { return $this->fileTypeSid; }
		public function getIsShown() { return $this->isShown; }
		public function getRemarks() { return $this->remarks; } 
		public function getFileDate() { return $this->fileDate; }
		public function getLastUpdate() { return $this->lastUpdate; } 
		
		public function setSid($x) 
		{ 
			$this->sid = $this->chkNconvertFlexNaN2Null($x); 
		} 
		public function setSeq($x) 
		{ 
			$this->seq = $this->chkNconvertFlexNaN2Null($x); 
		} 
		public function setActivitySid($x) 
		{ 
			$this->activitySid = $this->chkNconvertFlexNaN2Null($x); 
		} 
		public function setFileNameEn($x) { $this->fileNameEn = $x; } 
		public function setFileNameTc($x) { $this->fileNameTc = $x; } 
		public function setDescriptionEn($x) { $this->descriptionEn = $x; } 
		public function setDescriptionTc($x) { $this->descriptionTc = $x; } 
		public function setFilePath($x) { $this->filePath = $x; }
		public function setFileTypeSid($x) { $this->fileTypeSid = $this->chkNconvertFlexNaN2Null($x); }
		public function setIsShown($x) 
		{
			$this->isShown = $this->chkNconvertTrueFalse2Bool($x); 
		} 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setFileDate($x) { $this->fileDate = $x; }
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 
		
		// --- Activity
		public function getSidA() { return $this->sidA; } 
		public function getSeqA() { return $this->seqA; } 
		public function getActivityNameEnA() { return $this->activityNameEnA; } 
		public function getActivityNameTcA() { return $this->activityNameTcA; } 
		public function getContentEnA() { return $this->contentEnA; } 
		public function getContentTcA() { return $this->contentTcA; } 
		public function getContentA($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getContentEnA();
			}
			else
			{
				return $this->getContentTcA();
			}			
		}		
		public function getContentHtmlEnA() { return $this->contentHtmlEnA; } 
		public function getContentHtmlTcA() { return $this->contentHtmlTcA; } 
		public function getContentHtmlA($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getContentHtmlEnA();
			}
			else
			{
				return $this->getContentHtmlTcA();
			}			
		}
		public function getSpeakerA($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getSpeakerEnA();
			}
			else
			{
				return $this->getSpeakerTcA();
			}
		} 
		public function getSpeakerEnA() { return $this->speakerEnA; } 
		public function getSpeakerTcA() { return $this->speakerTcA; } 
		public function getIsShownA() { return $this->isShownA; } 
		public function getActivityDateA() { return $this->activityDateA; } 
		public function getRemarksA() { return $this->remarksA; } 
		public function getLastUpdateA() { return $this->lastUpdateA; } 
		public function setSidA($x) 
		{ 
			$this->sidA = $this->chkNconvertFlexNaN2Null($x); 
		} 
		public function setSeqA($x) 
		{ 
			$this->seqA = $this->chkNconvertFlexNaN2Null($x); 
		} 
		public function setActivityNameEnA($x) { $this->activityNameEnA = $x; } 
		public function setActivityNameTcA($x) { $this->activityNameTcA = $x; } 
		public function setContentEnA($x) { $this->contentEnA = $x; } 
		public function setContentTcA($x) { $this->contentTcA = $x; } 
		public function setContentHtmlEnA($x) { $this->contentHtmlEnA = $x; } 
		public function setContentHtmlTcA($x) { $this->contentHtmlTcA = $x; } 				
		public function setSpeakerEnA($x) { $this->speakerEnA = $x; } 
		public function setSpeakerTcA($x) { $this->speakerTcA = $x; } 
		public function setIsShownA($x) 
		{ 
			$this->isShownA = $this->chkNconvertTrueFalse2Bool($x); 
		} 
		public function setActivityDateA($x) { $this->activityDateA = $x; } 
		public function setRemarksA($x) { $this->remarksA = $x; } 
		public function setLastUpdateA($x) { $this->lastUpdateA = $x; } 		
		
		// --- FileType
		public function getSidT() { return $this->sidT; } 
		public function getFileTypeEnT() { return $this->fileTypeEnT; } 
		public function getFileTypeTcT() { return $this->fileTypeTcT; } 
		public function getFileTypeT($_systemLang)
		{
			if ($_systemLang == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				return $this->getFileTypeEnT();
			}
			else
			{
				return $this->getFileTypeTcT();
			}
		}
		public function getFileTypeIconT() { return $this->fileTypeIconT; }
		public function getRemarksT() { return $this->remarksT; } 
		public function getLastUpdateT() { return $this->lastUpdateT; } 
		public function setSidT($x) 
		{ 
			$this->sidT = $this->chkNconvertFlexNaN2Null($x); 
		} 
		public function setFileTypeEnT($x) { $this->fileTypeEnT = $x; } 
		public function setFileTypeTcT($x) { $this->fileTypeTcT = $x; } 
		public function setFileTypeIconT($x) { $this->fileTypeIconT = $x; }
		public function setRemarksT($x) { $this->remarksT = $x; } 
		public function setLastUpdateT($x) { $this->lastUpdateT = $x; } 		
		
		
		public function printValues()
		{
			return
				'FileCabinet--- ' . "\n" .
				'Sid: ' . $this->getSid() ."\n".
				'Seq: ' . $this->getSeq() . "\n" .
				'Activity Sid: ' . $this->getActivitySid() . "\n".
				'File Name En: ' . $this->getFileNameEn() . "\n".
				'File Name Tc: ' . $this->getFileNameTc() . "\n" .
				'Description En: ' . $this->getDescriptionEn() . "\n" .
				'Description Tc: ' . $this->getDescriptionTc() . "\n" .
				'File Path: ' . $this->getFilePath() . "\n" .
				'File Type Sid: ' . $this->getFileTypeSid() . "\n" .
				'Is Shown: ' . $this->getIsShown() . "\n" .
				'Remarks: ' . $this->getRemarks() . "\n" .
				'File Date: ' . $this->getFileDate() . "\n" .
				'Last Update: ' . $this->getLastUpdate() . "\n" .
			
				'Activity--- ' . "\n" .
				'Sid A: ' . $this->getSidA() . "\n" .
				'Seq A: ' . $this->getSeqA() . "\n" .
				'Activity Name En A: ' . $this->getActivityNameEnA() . "\n" .
				'Activity Name Tc A: ' . $this->getActivityNameTcA() . "\n" .
				'Content En A: ' . $this->getContentEnA() . "\n" .
				'Content Tc A: ' . $this->getContentTcA() . "\n" .
				'Content Html En A: ' . $this->getContentHtmlEnA() . "\n" .
				'Content Html Tc A: ' . $this->getContentHtmlTcA() . "\n" .			
				'Speaker En A: ' . $this->getSpeakerEnA() . "\n" .
				'Speaker Tc A: ' . $this->getSpeakerTcA() . "\n" .
				'Is Shown A : ' . $this->getIsShownA() . "\n" .
				'Activity Date A : ' . $this->getActivityDateA() . "\n" .
				'Remarks A: ' . $this->getRemarksA() . "\n" .
				'LastUpdate A: ' . $this->getLastUpdateA() . "\n" .
			
				'FileType---' . "\n" .
				'Sid T: ' . $this->getSidT() . "\n" .
				'File Type En T : ' . $this->getFileTypeEnT() . "\n" .
				'File Type Tc T : ' . $this->getFileTypeTcT() . "\n" .
				'File Type Icon T: ' . $this->getFileTypeIconT() . "\n" .
				'Remarks T: ' . $this->getRemarksT() . "\n" .
				'LastUpdate T: ' . $this->getLastUpdateT() . "\n" 
				;
		} // end printValues()
		
	} // end FileCabinet

?>