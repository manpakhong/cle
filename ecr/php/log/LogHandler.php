<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'ecr', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';

	require_once $currentDir. 'php/common/ArrayList.php';	
	require_once $currentDir. 'php/vo/system/Log.php';
	require_once $currentDir. 'php/system/SysParams.php';
	require_once $currentDir. 'php/system/SystemValues.php';		
	
	class LogHandler
	{	
		private $currentDir;
		private $logLevel;
		private $systemValues;
		
		public function __construct()
		{
			$currentDir = getcwd();
			$findRootDirPos = strpos($currentDir, 'ecr', 0);
			$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);
		
			$this->currentDir = $currentDir . '/';

			$this->systemValues = new SystemValues();
			$this->logLevel = $this->systemValues->getLogLevel();
			
		}

		public function checkNwriteLog($_log)
		{
			$log = new Log();
			$log = $_log;
			
			
			$writeIt = false;
			
			if ($this->logLevel->getEnableLogTypeMessageVO())
			{
				if ($log->getLogType() == SystemParam::$LOG_TYPE_MESSAGE_VO)
				{
					$writeIt = true;
				}	
			}
			
			if ($this->logLevel->getEnableLogTypeMessageSQL())
			{
				if ($log->getLogType() == SystemParam::$LOG_TYPE_MESSAGE_SQL)
				{
					$writeIt = true;
				}	
			}
			
			if ($this->logLevel->getEnableLogTypeMessageResult())
			{
				if ($log->getLogType() == SystemParam::$LOG_TYPE_MESSAGE_RESULT)
				{
					$writeIt = true;
				}	
			}			
			
			if ($this->logLevel->getEnableLogTypeEcrError())
			{
				if ($log->getLogType() == SystemParam::$LOG_TYPE_ECR_ERROR)
				{
					$writeIt = true;
				}	
			}		
				
			
			if ($this->logLevel->getEnableLogTypeEcrWarning())
			{
				if ($log->getLogType() == SystemParam::$LOG_TYPE_ECR_WARNING)
				{
					$writeIt = true;
				}	
			}
			
			if ($this->logLevel->getEnableLogTypeSystemException())
			{
				if ($log->getLogType() == SystemParam::$LOG_TYPE_SYSTEM_EXCEPTION)
				{
					$writeIt = true;
				}
			}
					
			if ($writeIt)
			{
				$this->writeLog($log);
			}
		}
		
		
		private function writeLog($_log)
		{
			$log = new Log();
			$log = $_log;
			
			$myFile = $this->currentDir . SystemParam::$LOG_FILE;
			$fh = fopen($myFile, 'a+') or die("can't open file");
			
			$stringData = '';
			$stringData .= $log->getLogDateTime() . "***" . $log->getLogType() . "***" .$log->getLogModule() .
						"\n" . $log->getLogMessage() . "\n\n" . 
						"-----------------------------------------------------------------------------------------\n";
			
			//place pointer at the beginning of the file.
			rewind($fh);			
			
			fwrite($fh, $stringData);
			fclose($fh);				
		}
		
		
	} // end class Log
?>