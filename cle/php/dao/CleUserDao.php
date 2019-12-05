<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	include_once $currentDir . 'php/common/Connection.php';
	include_once $currentDir . 'php/common/ArrayList.php';
	include_once $currentDir . 'php/vo/CleUser.php';
	include_once $currentDir . 'php/vo/CleUserFilter.php';	
	include_once $currentDir . 'php/common/BindParam.php';	
	class CleUserDao
	{

		
		// ===============================================================================
		// === old connection method
		// ===============================================================================				
		public function selectUser($_cleUserFilter)
		{
			try 
			{
				$select_sql = "select * from cle_user ";
				$cleUserFilter = new CleUserFilter();
				
				if (!is_null($_cleUserFilter))
				{
					$cleUserFilter = $_cleUserFilter;	
					$select_sql = $select_sql . $cleUserFilter->getWhereClause();
					$select_sql .= $cleUserFilter->getOrderByClause();
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysqli_query($conn, $statement);
	
				$cleUserList = new ArrayList();
								
				while ($result = mysqli_fetch_array($sql))
				{
					$cleUser = new CleUser();
					
					$cleUser->setSid($result['sid']);
					$cleUser->setUserId($result['User_id']);
					$cleUser->setPassword($result['Password']);
					$cleUser->setName($result['Name']);
					$cleUser->setEmail($result['email']);
					$cleUser->setGroup($result['Group']);
					$cleUser->setRemarks($result['Remarks']);
					$cleUser->setLastUpdate($result['LastUpdate']);
					
					/*
					echo "From Dao: <br/>" .
							"Sid: " . $user->getSid() . "<br/>" .
							"User Id: " . $user->getUserId() . "<br/>" .
							"Password: " . $user->getPassword() . "<br/>" .
							"Name: " . $user->getName() . "<br/>" . 
							"Group: " . $user->getGroup(). "<br/>" . 
							"Remarks : " . $user->getRemarks() . "<br/>" .
							"LastUpdate : " . $user->getLastUpdate() . "<br/>"; 
					*/
					
					
					$cleUserList->add($cleUser);
					
				}
				
				return $cleUserList;
					
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "\n" );
			}
		} // end select
		
		public function insertUser($_cleUser)
		{
			try 
			{
				$insert_sql = "insert into cle_user(User_id, Password, Name, Group, Remarks) ".
								"values(?,?,?,?,?)";
				
				$cleUser = new CleUser();

				
				if (!is_null($_cleUser))
				{
					$cleUser = $_cleUser;
				}

				
				echo 'sql statement: ' . $insert_sql . '<br/>';
				

				echo 	"Sid: " . $cleUser->getSid() . "<br/>" .
						"User Id: " . $cleUser->getUserId() . "<br/>" .
						"Password: " . $cleUser->getPassword() . "<br/>" .
						"Name: " . $cleUser->getName() . "<br/>" . 
						"Group: " . $cleUser->getGroup(). "<br/>" . 
						"Remarks : " . $cleUser->getRemarks() . "<br/>" .
						"LastUpdate : " . $cleUser->getLastUpdate() . "<br/>"; 			
				


				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'sssss';
				$bindParamList = new ArrayList();
				$bindParamList->add($cleUser->getUserId());
				$bindParamList->add($cleUser->getPassword());
				$bindParamList->add($cleUser->getName());
				$bindParamList->add($cleUser->getGroup());
				$bindParamList->add($cleUser->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);
				
				$result = mysql_query($statement);				
				
				
				if ($result > 0)
				{
					echo $result . " record(s) inserted Completely!";
				}				
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e;
			}
		} // end insert		
		
		public function updateUser($_cleUser, $_cleUserFilter)
		{
			try 
			{
				$update_sql = "update cle_user set User_id = ?, Password = ?,  Name = ?, Group = ?, Remarks = ? , lastupdate = now() ";
				
				$cleUserFilter = new CleUserFilter();
				$cleUser = new CleUser();

				
				if (!is_null($_cleUser))
				{
					$cleUser = $_cleUser;
				}
				// concatnate where statement
				if (!is_null($_cleUserFilter))
				{
					$cleUserFilter = $_cleUserFilter;
					$update_sql .= $cleUserFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";
				
				/*
				echo 	"Sid: " . $user->getSid() . "<br/>" .
						"User Id: " . $user->getUserId() . "<br/>" .
						"Password: " . $user->getPassword() . "<br/>" .
						"Name: " . $user->getName() . "<br/>" . 
						"Group: " . $user->getGroup(). "<br/>" . 
						"Remarks : " . $resource->getRemarks() . "<br/>" .
						"LastUpdate : " . $resource->getLastUpdate() . "<br/>"; 
				*/
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'sssss';
				$bindParamList = new ArrayList();
				$bindParamList->add($cleUser->getUserId());
				$bindParamList->add($cleUser->getPassword());
				$bindParamList->add($cleUser->getName());
				$bindParamList->add($cleUser->getGroup());
				$bindParamList->add($cleUser->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				$result = mysql_query($statement);					
				
				
				if ($result > 0)
				{
					echo $result . " record(s) updated Completely!";
				}				
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e;
			}
		} // end update		
		
		public function deleteUser($_cleUserFilter)
		{
			try 
			{
				$delete_sql = "delete from cle_user ";
				
				$cleUserFilter = new CleUserFilter();
				
				// concatnate where statement
				if (!is_null($_cleUserFilter))
				{
					$cleUserFilter = $_cleUserFilter;
					$delete_sql .= $cleUserFilter->getWhereClause();
				}

				
				// echo "sql statement: " . $delete_sql . "<br/>";
				
				/*
				echo 	"Sid: " . $cleUser->getSid() . "<br/>" .
						"User Id: " . $cleUser->getUserId() . "<br/>" .
						"Password: " . $cleUser->getPassword() . "<br/>".
						"Name: " . $cleUser->getName() . "<br/>" . 
						"Group: " . $cleUser->getGroup(). "<br/>" . 
						"Remarks : " . $cleUser->getRemarks() . "<br/>" .
						"LastUpdate : " . $cleUser->getLastUpdate() . "<br/>"; 
				*/

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $delete_sql);
				
				$result = mysql_query($statement);				
				
				
				if ($result > 0)
				{
					echo $result . " record deleted Completely!";
				}				
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e;
			}
		}		
		// ===============================================================================
		// === mysqli
		// ===============================================================================		
		public function selectUserMysqli($_cleUserFilter)
		{
			try 
			{
				$select_sql = "select * from cle_user ";
				$cleUserFilter = new CleUserFilter();
				
				if (!is_null($_cleUserFilter))
				{
					$cleUserFilter = $_cleUserFilter;	
					$select_sql = $select_sql . $cleUserFilter->getWhereClause();
					$select_sql .= $cleUserFilter->getOrderByClause();
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($select_sql);
				//$statement->bind_param("i", $webRef->getSid());
				$statement->execute();
	
				$cleUserList = new ArrayList();
				
				/* Bind results */
				$statement -> bind_result($sid, $userId, $password, $name, $email, $group, $remarks, $lastUpdate);
				
				while ($statement->fetch())
				{
					$cleUser = new CleUser();
					
					$cleUser->setSid($sid);
					$cleUser->setUserId($userId);
					$cleUser->setPassword($password);
					$cleUser->setName($name);
					$cleUser->setEmail($email);
					$cleUser->setGroup($Group);
					$cleUser->setRemarks($remarks);
					$cleUser->setLastUpdate($lastUpdate);
					
					/*
					echo "From Dao: <br/>" .
							"Sid: " . $user->getSid() . "<br/>" .
							"User Id: " . $user->getUserId() . "<br/>" .
							"Password: " . $user->getPassword() . "<br/>" .
							"Name: " . $user->getName() . "<br/>" . 
							"Group: " . $user->getGroup(). "<br/>" . 
							"Remarks : " . $user->getRemarks() . "<br/>" .
							"LastUpdate : " . $user->getLastUpdate() . "<br/>"; 
					*/
					
					
					$cleUserList->add($cleUser);
					
				}
				
				return $cleUserList;
					
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "\n" );
			}
		} // end select
		
		public function insertUserMysqli($_cleUser)
		{
			try 
			{
				$insert_sql = "insert into cle_user(User_id, Password, Name, Group, Remarks) ".
								"values(?,?,?,?,?)";
				
				$cleUser = new CleUser();

				
				if (!is_null($_cleUser))
				{
					$cleUser = $_cleUser;
				}

				
				echo 'sql statement: ' . $insert_sql . '<br/>';
				

				echo 	"Sid: " . $cleUser->getSid() . "<br/>" .
						"User Id: " . $cleUser->getUserId() . "<br/>" .
						"Password: " . $cleUser->getPassword() . "<br/>" .
						"Name: " . $cleUser->getName() . "<br/>" . 
						"Group: " . $cleUser->getGroup(). "<br/>" . 
						"Remarks : " . $cleUser->getRemarks() . "<br/>" .
						"LastUpdate : " . $cleUser->getLastUpdate() . "<br/>"; 			
				


				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($insert_sql);
				$statement->bind_param("sssss", $cleUser->getUserId(), $cleUser->getPassword(), $cleUser->getName(), $cleUser->getGroup(), $cleUser->getRemarks());
				$result = $statement->execute();				
				
				
				if ($result > 0)
				{
					echo $result . " record(s) inserted Completely!";
				}				
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e;
			}
		} // end insert		
		
		public function updateUserMysqli($_cleUser, $_cleUserFilter)
		{
			try 
			{
				$update_sql = "update cle_user set User_id = ?, Password = ?,  Name = ?, Group = ?, Remarks = ? , lastupdate = now() ";
				
				$cleUserFilter = new CleUserFilter();
				$cleUser = new CleUser();

				
				if (!is_null($_cleUser))
				{
					$cleUser = $_cleUser;
				}
				// concatnate where statement
				if (!is_null($_cleUserFilter))
				{
					$cleUserFilter = $_cleUserFilter;
					$update_sql .= $cleUserFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";
				
				/*
				echo 	"Sid: " . $cleUser->getSid() . "<br/>" .
						"User Id: " . $cleUser->getUserId() . "<br/>" .
						"Password: " . $cleUser->getPassword() . "<br/>" .
						"Name: " . $cleUser->getName() . "<br/>" . 
						"Group: " . $cleUser->getGroup(). "<br/>" . 
						"Remarks : " . $cleUser->getRemarks() . "<br/>" .
						"LastUpdate : " . $cleUser->getLastUpdate() . "<br/>"; 
				*/
				
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($update_sql);
				$statement->bind_param("sssss", $cleUser->getUserId(), $cleUser->getPassword(), $cleUser->getName(), $cleUser->getGroup(), $cleUser->getRemarks());
				$result = $statement->execute();				
				
				
				if ($result > 0)
				{
					echo $result . " record(s) updated Completely!";
				}				
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e;
			}
		} // end update		
		
		public function deleteUserMysqli($_cleUserFilter)
		{
			try 
			{
				$delete_sql = "delete from cle_user ";
				
				$cleUserFilter = new CleUserFilter();
				
				// concatnate where statement
				if (!is_null($_cleUserFilter))
				{
					$cleUserFilter = $_cleUserFilter;
					$delete_sql .= $cleUserFilter->getWhereClause();
				}

				
				// echo "sql statement: " . $delete_sql . "<br/>";
				
				/*
				echo 	"Sid: " . $cleUser->getSid() . "<br/>" .
						"User Id: " . $cleUser->getUserId() . "<br/>" .
						"Password: " . $cleUser->getPassword() . "<br/>".
						"Name: " . $cleUser->getName() . "<br/>" . 
						"Group: " . $cleUser->getGroup(). "<br/>" . 
						"Remarks : " . $cleUser->getRemarks() . "<br/>" .
						"LastUpdate : " . $cleUser->getLastUpdate() . "<br/>"; 
				*/

				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($delete_sql);
				// $statement->bind_param("ssssss", $resource->getUrl(), $resource->getResourceName(), $resource->getAuthor(), $resource->getTeachingAims(), $resource->getTypeSid(), $resource->getRemarks());
				$result = $statement->execute();				
				
				
				if ($result > 0)
				{
					echo $result . " record deleted Completely!";
				}				
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e;
			}
		}		
		
		
		
		public function __construct()
		{
			
		}
	} // end class
	

?>