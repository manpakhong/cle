<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/VoBase.php';
	class EcrUser extends VoBase
	{
		protected $sid;
		protected $userId;
		protected $password;
		protected $nameEn;
		protected $nameTc;
		protected $email;
		protected $groupSid;
		protected $groupNameEn;
		protected $groupNameTc;
		protected $remarks;
		protected $lastUpdate;
		
		public static function getDbFieldName($value)
		{
			switch ($value) {
			    case "sid":
			        return "sid";
			        break;
			    case "userId":
			        return "User_id";
			        break;
			    case "password":
			    	return "Password";
			    	break;
			    case "nameEn":
			        return "Name_En";
			        break;
			    case "nameTc":
			        return "Name_Tc";
			        break;			        
			    case "email":
			        return "email";
			        break;
			    case "groupSid":
			        return "sid";
			        break;
			    case "groupNameEn":
			    	return "Name_En";
			    	break;
			    case "groupNameTc":
			    	return "Name_Tc";
			    	break;
			    case "remarks":
			        return "Remarks";
			        break;     
			    case "lastUpdate";
			    	return "LastUpdate";
			    	break;
			}
		} // end getDbFieldName

		public function getSid() { return $this->sid; } 
		public function getUserId() { return $this->userId; } 
		public function getPassword() { return $this->password; }
		public function getName($_systemLang)
		{

			switch ($_systemLang)
			{
				case SystemParam::$SYSTEM_LANGUAGE_EN:
					return $this->getNameEn();
					break;
				case SystemParam::$SYSTEM_LANGUAGE_TC:
					return $this->getNameTc();
					break;
				default:
					return $this->getNameEn();
					break;				
			}

		} 
		public function getNameEn() { return $this->nameEn; } 
		public function getNameTc() { return $this->nameTc; } 		
		public function getEmail() { return $this->email; } 
		public function getGroupSid() { return $this->groupSid; } 
		public function getGroupName($_systemLang)
		{
			switch ($_systemLang)
			{
				case SystemParam::$SYSTEM_LANGUAGE_EN:
					return $this->getGroupNameEn();
					break;
				case SystemParam::$SYSTEM_LANGUAGE_TC:
					return $this->getGroupNameTc();
					break;
				default:
					return $this->getGroupNameEn();
					break;					
			}
		}
		public function getGroupNameEn() { return $this->groupNameEn; } 
		public function getGroupNameTc() { return $this->groupNameTc; } 
		public function getRemarks() { return $this->remarks; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		public function setSid($x) { $this->sid = $x; } 
		public function setUserId($x) { $this->userId = $x; } 
		public function setPassword($x) { $this->password = $x; } 
		public function setNameEn($x) { $this->nameEn = $x; } 
		public function setNameTc($x) { $this->nameTc = $x; } 		
		public function setEmail($x) { $this->email = $x; } 
		public function setGroupSid($x) { $this->groupSid = $x; } 
		public function setGroupNameEn($x) { $this->groupNameEn = $x; } 
		public function setGroupNameTc($x) { $this->groupNameTc = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 		
		
			
		public function printValues()
		{
			return
				'sid: ' . $this->getSid() . '<br/>' .
				'User Id: ' . $this->getUserId() . '<br/>' .
				'Password: ' . $this->getPassword() . '<br/>'.
				'Name En: ' . $this->getNameEn() . '<br/>' .
				'Name Tc: ' . $this->getNameTc() . '<br/>' .
				'Email: ' . $this->getEmail() . '<br/>' .
				'Group Sid: ' . $this->getGroupSid() . '<br/>' .
				'Group Name En: ' . $this->getGroupNameEn() . '<br/>' .
				'Group Name Tc: ' . $this->getGroupNameTc() . '<br/>' .
				'Remarks: ' . $this->getRemarks() . '<br/>' .
				'Last Update: ' . $this->getLastUpdate() . '<br/>';
		}		
		
	} // end class
?>