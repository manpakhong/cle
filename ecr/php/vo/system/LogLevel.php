<?php
	class LogLevel extends VoBase
	{

		/*
		public static $LOG = 'LOG';
		public static $LOG_TYPE_MESSAGE_VO = 'LOG_TYPE_MESSAGE_VO';
		public static $LOG_TYPE_MESSAGE_SQL = 'LOG_TYPE_MESSAGE_SQL';
		public static $LOG_TYPE_ECR_ERROR = 'LOG_TYPE_ECR_ERROR';
		public static $LOG_TYPE_ECR_WARNING = 'LOG_TYPE_ECR_WARNING';		
		*/
		public $enableLogTypeMessageVO;
		public $enableLogTypeMessageSQL; 
		public $enableLogTypeMessageResult;
		public $enableLogTypeEcrError;
		public $enableLogTypeEcrWarning;
		public $enableLogTypeSystemException;
		
		
		public function __construct()
		{
			$this->enableLogTypeMessageVO = false;
			$this->enableLogTypeMessageSQL = false;
			$this->enableLogTypeMessageResult = false;
			$this->enableLogTypeEcrError = false;
			$this->enableLogTypeEcrWarning = false;
			$this->enableLogTypeSystemException = false;
		}
		
		public function getEnableLogTypeMessageVO() { return $this->enableLogTypeMessageVO; } 
		public function getEnableLogTypeMessageSQL() { return $this->enableLogTypeMessageSQL; }
		public function getEnableLogTypeMessageResult() { return $this->enableLogTypeMessageResult; } 
		public function getEnableLogTypeEcrError() { return $this->enableLogTypeEcrError; } 
		public function getEnableLogTypeEcrWarning() { return $this->enableLogTypeEcrWarning; } 
		public function getEnableLogTypeSystemException() { return $this->enableLogTypeSystemException; }
		
		public function setEnableLogTypeMessageVO($x) { $this->enableLogTypeMessageVO = $x; } 
		public function setEnableLogTypeMessageSQL($x) { $this->enableLogTypeMessageSQL = $x; } 
		public function setEnableLogTypeMessageResult($x) { $this->enableLogTypeMessageResult = $x; }
		public function setEnableLogTypeEcrError($x) { $this->enableLogTypeEcrError = $x; } 
		public function setEnableLogTypeEcrWarning($x) { $this->enableLogTypeEcrWarning = $x; } 
		public function setEnableLogTypeSystemException($x) { $this->enableLogTypeSystemException = $x; }		
		
	}
?>