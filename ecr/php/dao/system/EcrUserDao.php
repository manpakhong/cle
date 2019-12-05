<?php

	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/common/ArrayList.php';
	include_once $currentDir . 'php/common/system/Connection.php';
	include_once $currentDir . 'php/vo/system/EcrUser.php';
	include_once $currentDir . 'php/vo/system/EcrUserFilter.php';
	include_once $currentDir . 'php/vo/OrderBy.php';	
	include_once $currentDir . 'php/common/BindParam.php';	
		
	class EcrUserDao
	{
		
		public function __construct()
		{
			
		}
		public function selectUser($_ecrUserFilter)
		{
			try 
			{
				$select_sql = "select u.*, g.Name_En as GroupName_En, g.Name_Tc as GroupName_Tc from ecr_user u left join ecr_usergroup g on u.Group_sid = g.sid ";
				$ecrUserFilter = new EcrUserFilter();
				
				if (!is_null($_ecrUserFilter))
				{
					$ecrUserFilter = $_ecrUserFilter;	
					$select_sql = $select_sql . $ecrUserFilter->getWhereClause('u');					
					$select_sql .= $ecrUserFilter->getOrderByClause('u');
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysql_query($statement);
	
				$ecrUserList = new ArrayList();
								
				while ($result = mysql_fetch_array($sql))
				{
					$ecrUser = new EcrUser();
					
					$ecrUser->setSid($result['sid']);
					$ecrUser->setUserId($result['User_id']);
					$ecrUser->setPassword($result['Password']);
					$ecrUser->setNameEn($result['Name_En']);
					$ecrUser->setNameTc($result['Name_Tc']);
					$ecrUser->setEmail($result['email']);
					$ecrUser->setGroupSid($result['Group_sid']);
					$ecrUser->setGroupNameEn($result['GroupName_En']);
					$ecrUser->setGroupNameTc($result['GroupName_Tc']);					
					$ecrUser->setRemarks($result['Reamrks']);
					$ecrUser->setLastUpdate($result['LastUpdate']);
										
					$ecrUserList->add($ecrUser);
					
				}
				// echo $ecrUserList->size();
				return $ecrUserList;
					
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "</n>" );
			}
		} // end select
		
		public function insertUser($_ecrUser)
		{
			try 
			{
				$insert_sql = 
				"insert into ecr_user(" .
				"User_id, Password, Name_En, Name_Tc, email, ". 
				"Group_sid, Remarks) ".
				"values(" . 
				"?,?,?,?,?,". 
				"?,?".
				")";
				
				$ecrUser = new EcrUser();

				
				if (!is_null($_ecrUser))
				{
					$ecrUser = $_ecrUser;
				}

				
				// echo 'sql statement: ' . $insert_sql . '<br/>';
						

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'sssssis';
				$bindParamList = new ArrayList();
				$bindParamList->add($ecrUser->getUserId());
				$bindParamList->add($ecrUser->getPassword());
				$bindParamList->add($ecrUser->getNameEn());
				$bindParamList->add($ecrUser->getNameTc());
				$bindParamList->add($ecrUser->getEmail());
				$bindParamList->add($ecrUser->getGroupSid());
				$bindParamList->add($ecrUser->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);
				
				$result = mysql_query($statement);				
								
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		} // end insert		
		
		public function updateUser($_ecrUser, $_ecrUserFilter)
		{
			try 
			{
				$update_sql = 
				"update ecr_user set " . 
				"User_id = ?, Password = ?,  Name_En = ?, Name_Tc = ?, email = ?, ".
				"Group_sid = ?, Remarks = ? , " .
				"LastUpdate = now() ";
				
				$ecrUserFilter = new EcrUserFilter();
				$ecrUser = new EcrUser();

				
				if (!is_null($_ecrUser))
				{
					$ecrUser = $_ecrUser;
				}
				// concatnate where statement
				if (!is_null($_ecrUserFilter))
				{
					$ecrUserFilter = $_ecrUserFilter;
					$update_sql .= $ecrUserFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";
				
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'sssssis';
				$bindParamList = new ArrayList();
				$bindParamList->add($ecrUser->getUserId());
				$bindParamList->add($ecrUser->getPassword());
				$bindParamList->add($ecrUser->getNameEn());
				$bindParamList->add($ecrUser->getNameTc());
				$bindParamList->add($ecrUser->getEmail());
				$bindParamList->add($ecrUser->getGroupSid());
				$bindParamList->add($ecrUser->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				$result = mysql_query($statement);					
								
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		} // end update		
		
		public function deleteUser($_ecrUserFilter)
		{
			try 
			{
				$delete_sql = "delete from ecr_user ";
				
				$ecrUserFilter = new EcrUserFilter();
				
				// concatnate where statement
				if (!is_null($_ecrUserFilter))
				{
					$ecrUserFilter = $_ecrUserFilter;
					$delete_sql .= $ecrUserFilter->getWhereClause();
				}

				
				// echo "sql statement: " . $delete_sql . "<br/>";
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $delete_sql);
				
				$result = mysql_query($statement);				
			
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		} // end delete	
		
	} // end class
?>