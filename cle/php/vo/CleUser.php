<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once $currentDir . 'php/vo/VoCommon.php';
	class CleUser extends VoCommon
	{
		protected $sid;
		protected $userId;
		protected $password;
		protected $name;
		protected $email;
		protected $group;
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
			    case "name":
			        return "Name";
			        break;
			    case "email":
			        return "email";
			        break;
			    case "group":
			        return "Group";
			        break;
			    case "remarks":
			        return "Remarks";
			        break;     
			    case "lastUpdate";
			    	return "LastUpdate";
			    	break;
			}
		}		
		
		public function getSid() { return $this->sid; } 
		public function getUserId() { return $this->userId; } 
		public function getPassword() { return $this->password; }
		public function getName() { return $this->name; } 
		public function getEmail() { return $this->email; } 
		public function getGroup() { return $this->group; } 
		public function getLastUpdate() { return $this->lastUpdate; } 
		public function getRemarks() { return $this->remarks; } 
		public function setSid($x) { $this->sid = $x; } 
		public function setUserId($x) { $this->userId = $x; } 
		public function setPassword($x) { $this->password = $x; }
		public function setName($x) { $this->name = $x; } 
		public function setEmail($x) { $this->email = $x; } 
		public function setGroup($x) { $this->group = $x; } 
		public function setRemarks($x) { $this->remarks = $x; } 	
		public function setLastUpdate($x) { $this->lastUpdate = $x; } 
	
	}

?>