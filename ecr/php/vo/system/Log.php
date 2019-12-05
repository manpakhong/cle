<?php
	class Log extends VoBase
	{

		protected $logDateTime;
		protected $logType;
		protected $logModule;
		protected $logMessage;

		public function getLogDateTime() { return $this->logDateTime; } 
		public function getLogType() { return $this->logType; } 
		public function getLogModule() { return $this->logModule; } 
		public function getLogMessage() { return $this->logMessage; } 
		public function setLogDateTime($x) { $this->logDateTime = $x; } 
		public function setLogType($x) { $this->logType = $x; } 
		public function setLogModule($x) { $this->logModule = $x; } 
		public function setLogMessage($x) { $this->logMessage = $x; } 	
		
		public function printValues()
		{
			return
				'Log Date Time: ' . $this->logDateTime . "\n" .
				'Log Type: ' . $this->logType . "\n" .
				'Log Module: ' . $this->logModule . "\n" .
				'Log Message: ' . $this->logMessage . "\n"
				;
		}		
		
		
	} // end class Log
?>