<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'ecr', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';

	require_once $currentDir. 'php/vo/system/SystemMessage.php';	
	require_once $currentDir. 'php/common/ArrayList.php';
	require_once $currentDir. 'php/system/SysParams.php';		
	
	class ErrorMessageHandler
	{
		private $currentDir;
		private $errorMessageList;
		
		public function __construct()
		{
			$currentDir = getcwd();
			$findRootDirPos = strpos($currentDir, 'ecr', 0);
			$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);
		
			$this->currentDir = $currentDir . '/';	
			
			$this->errorMessageList = new ArrayList();
			$this->readErrorMessage();
		}
		private function readErrorMessage()
		{
			$fh = fopen($this->currentDir . SystemParam::$ERROR_MSG_FILE, "r");
			
			$errorMessageList = new ArrayList();
			
			while(true)
			{
				$line = fgets($fh);
				if($line == null)
				
				break;
				
				$arr = array();
				$arr = explode('|', $line);

				$errorMessage = new ErrorMessage();
				$errorMessage->setErrMsgCode($arr[0]);
				$errorMessage->setLogLv($arr[1]);
				$errorMessage->setErrMsg($arr[2]);

				$errorMessageList->add($errorMessage);
				
				// print_r($arr);
				// echo $line . '<br/>';
			}
			
			fclose($fh);

			$this->errorMessageList = $errorMessageList;
		}
		
		public function getErrorMessage($_ErrorCode)
		{
			$returnErrorMessage = new ErrorMessage();
			
			while ($this->errorMessageList->hasNext())
			{
				$errorMessage = new ErrorMessage();
				$errorMessage = $this->errorMessageList->next();
				

				
				if ($_ErrorCode == $errorMessage->getErrMsgCode())
				{
					$returnErrorMessage = $errorMessage;
					// echo $errorMessage->getErrMsgCode() . '<br/>';					
				}
			}
			
			$this->errorMessageList->goToTheBegin();
			
			return $returnErrorMessage->getErrMsg();
		} // end getErrorMessage
		
	}
?>