
<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	require_once $currentDir.'php/system/SysParams.php';
	require_once $currentDir.'php/vo/system/EcrUser.php';
	require_once $currentDir.'php/vo/system/LogLevel.php';
	
	class SystemValues
	{
		private $storageType; // determine the System param store in Session or Cookie
		private $authenticatedUser;
		private $systemLang;
		private $logLevel;
		private $visitorIpAddress;
		private $relativeDocRoot;
		private $uploadFolderName;
		
		
		public function __construct()
		{

			$this->systemLang = SystemParam::$SYSTEM_LANGUAGE_EN;
			$this->authenticatedUser = new EcrUser();
			$this->storageType = SystemParam::$SYSTEM_VALUES_TYPE_SESSION;	
			
			$this->uploadFolderName = SystemParam::$UPLOAD_FILE_FOLDER;
			
			/*
	        severe:1;
	        warning:2);
	        info:4;
	        config:8;
	        fine:16;
	        finer:32;
	        finest:64;			
			*/			
			
			if ($this->storageType = SystemParam::$SYSTEM_VALUES_TYPE_SESSION)
			{
			    if(!isset($_SESSION))
			    {
			        session_start();
			    }
			}
			
			
			$this->logLevel = new LogLevel();
			$this->logLevel->setEnableLogTypeMessageVO(true);
			$this->logLevel->setEnableLogTypeMessageSQL(true);
			$this->logLevel->setEnableLogTypeMessageResult(true);
			$this->logLevel->setEnableLogTypeEcrError(true);
			$this->logLevel->setEnableLogTypeEcrWarning(true);
			$this->logLevel->setEnableLogTypeSystemException(true);
			
			
			$this->getLangFromSessionOrCookie();
			$this->getLoginValueFromSessionOrCookie();
		}
		public function getUploadFolderName()
		{
			return $this->uploadFolderName;
		}
		public function setAuthenticatedUser2SessionOrCookie($_authenticatedUser)
		{
			try 
			{
				if ($this->storageType == SystemParam::$SYSTEM_VALUES_TYPE_SESSION) // session way
				{
					$_SESSION[SystemParam::$ECR_USER] = serialize($_authenticatedUser);
				}
				else // cookie way
				{
					$_COOKIE[SystemParam::$ECR_USER] = serialize($_authenticatedUser);
				}
							
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}				
		}
	
		public function setSystemLang2SessionOrCookie($_systemLang)
		{
			try 
			{
				if ($this->storageType == SystemParam::$SYSTEM_VALUES_TYPE_SESSION) // session way
				{
					$this->systemLang = $_systemLang;
					$_SESSION[SystemParam::$SYSTEM_LANGUAGE] = $this->systemLang;

				}
				else // cookie way
				{
					$this->systemLang = $_systemLang;
					$_COOKIE[SystemParam::$SYSTEM_LANGUAGE] = $this->systemLang;

				}
							
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}				
		} 
		public function getSystemLang()
		{
			return $this->systemLang;							
		}		
		
		private function getLoginValueFromSessionOrCookie()
		{
			try 
			{
				if ($this->storageType == SystemParam::$SYSTEM_VALUES_TYPE_SESSION) // session way
				{
					if (isset($_SESSION[SystemParam::$ECR_USER]))
					{
						$this->authenticatedUser=unserialize($_SESSION[SystemParam::$ECR_USER]);
						// echo 'ecrUser session set!' . '<br/>';
					}
					else
					{
						if (is_null($this->authenticatedUser))
						{
						}
						// echo '$authenticatedUser session does not set!' . '<br/>';
						// throw new Exception('Session for $_SESSION[EcrUserParam::$ECR_USER_SESSION] not set!', 3001);
					}

				}
				else // cookie way
				{
					if (isset($_COOKIE[SystemParam::$ECR_USER]))
					{
						$this->authenticatedUser=unserialize($_COOKIE[SystemParam::$ECR_USER]);
					}
					else 
					{
						// throw new Exception('Cookie for $_COOKIE[EcrUserParam::$ECR_USER_SESSION] not set!', 3002);
					}
				}
							
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}			
		}		
		
		private function getLangFromSessionOrCookie()
		{
			try 
			{
				if ($this->storageType == SystemParam::$SYSTEM_VALUES_TYPE_SESSION) // session way
				{
					if(isset($_SESSION[SystemParam::$SYSTEM_LANGUAGE]))
					{
						$this->systemLang = $_SESSION[SystemParam::$SYSTEM_LANGUAGE];

						
					}
				}
				else // cookie way
				{
					if(isset($_COOKIE[SystemParam::$SYSTEM_LANGUAGE]))
					{
						$this->systemLang = $_COOKIE[SystemParam::$SYSTEM_LANGUAGE];
					}

				}
				
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}			
		}
		
		public function setStorageType2SessionOrCookie($_storageType)
		{
			try 
			{
				if ($this->storageType == SystemParam::$SYSTEM_VALUES_TYPE_SESSION) // session way
				{
					$_SESSION[SystemParam::$SYSTEM_LANGUAGE] = serialize($_storageType);
					$this->systemLang = $_systemLang;
				}
				else // cookie way
				{
					$_COOKIE[SystemParam::$SYSTEM_LANGUAGE] = serialize($_storageType);
					$this->systemLang = $_systemLang;
				}
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}
		} // end getStorageTypeFromSessionOrCookie()
		
		public function getRelativeDocRoot()
		{
			if ($this->isLocalHost())
			{
				return SystemParam::$SYSTEM_RELATIVE_DOC_ROOT_LOCAL;
			}
			else
			{
				return SystemParam::$SYSTEM_RELATIVE_DOC_ROOT_REMOTE;
			}
		}
		public function getSystemStorageType()
		{
			return $this->storageType;
		}
				
		public function getLogLevel()
		{
			return $this->logLevel;
		}
				
		public function setLogoutValueByKillinSessionOrCookieObj()
		{
			try 
			{
				if ($this->getSystemStorageType() == SystemParam::$SYSTEM_VALUES_TYPE_SESSION)
				{
					$ecrUser = new EcrUser();
					$_SESSION[SystemParam::$ECR_USER] = serialize($ecrUser);		
				}
				else
				{		
					$ecrUser = new EcrUser();
					$_COOKIE[SystemParam::$ECR_USER] = serialize($ecrUser);		
				}

				$this->getLoginValueFromSessionOrCookie();
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}

		}
		

		
		public function isLogin()
		{
			$return = false;
			if (!is_null($this->authenticatedUser))
			{
				if (!is_null($this->authenticatedUser->getUserId()))
				{
					if (strlen($this->authenticatedUser->getUserId()) > 0)
					{
						$return = true;
					}
					
				}
			} // end if (!is_null($this->authenticatedUser->getUserId()))
			return $return;
		}
		
		public function getAuthenticatedUser()
		{
			
			return $this->authenticatedUser;				
			
		} // end getAuthenticatedUser()
		
		public function getRealIpAddr()
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
			{
			  $ip=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
			{
			  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else
			{
			  $ip=$_SERVER['REMOTE_ADDR'];
			}
			return $ip;
		} // end getRealIpAddr()		
		public function isLocalHost()
		{
			
			$return = false;
			if ($this->getRealIpAddr() == '127.0.0.1')
			{
				$return = true;
			}	
			return $return;
		} // end isLocalHost()
		private function checkVisitorIpAddress()
		{
		    if (getenv(HTTP_X_FORWARDED_FOR)) 
		    {
        		$pipaddress = getenv(HTTP_X_FORWARDED_FOR);
        		$ipaddress = getenv(REMOTE_ADDR);
				echo "Your Proxy IPaddress is : ".$pipaddress. "(via $ipaddress)" ;
		    } 
		    else 
		    {
		        $ipaddress = getenv(REMOTE_ADDR);
		        echo "Your IP address is : $ipaddress";
		    }			
		} // end checkVisitorIpAddress()
		
	} // end class

?>
