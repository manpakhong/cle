<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once $currentDir.'/php/common/Connection.php';
	require_once $currentDir.'/php/common/ArrayList.php';
	require_once $currentDir.'/php/vo/Type.php';
	require_once $currentDir.'/php/vo/TypeFilter.php';	
	require_once $currentDir.'/php/common/BindParam.php';	
	
	class TypeDao
	{
		
		// ===============================================================================
		// === old connection method
		// ===============================================================================		
		public function selectType($_typeFilter)
		{
			try {
				$select_sql = "select * from cle_type ";
				$typeFilter = new TypeFilter();
				
				if (!is_null($_typeFilter))
				{
					$typeFilter = $_typeFilter;	
					$select_sql = $select_sql . $typeFilter->getWhereClause();
					$select_sql .= $typeFilter->getOrderByClause();
				}
				
				
				echo "sql statement: " . $select_sql;
				// echo "sid: " . $resourceFilter->getSid();
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysql_query($statement);
	
				$typeList = new ArrayList();
								
				while ($result = mysql_fetch_array($sql))
				{
					$type = new Type();
					
					$type->setSid($result['sid']);
					$type->setType($result['Type']);
					$type->setRemarks($result['Remarks']);
					$type->setLastUpdate($result['LastUpdate']);

					/*
					echo "From Dao: <br/>" .
							"Sid: " . $type->getSid() . "<br/>" .
							"Type: " . $type->getType() . "<br/>" .
							"Remarks: " . $type->getRemarks() . "<br/>" . 
							"LastUpdate : " . $type->getLastUpdate() . "<br/>"; 
					*/
					$typeList->add($type);
					
				}
				
				return $typeList;			
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}
		} // end select
		
		public function insertType($_type)
		{
			try 
			{
				$insert_sql = "insert into cle_type(Type, Remarks) ".
								"values(?,?)";
	
				$type = new Type();

				
				if (!is_null($_type))
				{
					$type = $_type;
				}

				
				echo 'sql statement: ' . $insert_sql . '<br/>';
				

				echo 'Sid: ' . $type->getSid() . '<br/>'.
			    'Type: ' . $type->getType() . '<br/>'.
				'Remarks: ' . $type->getRemarks() . '<br/>'.
				'LastUpdate: ' . $type->getLastUpdate() . '<br/>';


				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'ss';
				$bindParamList = new ArrayList();
				$bindParamList->add($type->getType());
				$bindParamList->add($type->getRemarks());
				
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
		
		public function updateType($_type, $_typeFilter)
		{
			try 
			{
				$update_sql = "update cle_type set Type = ?, Remarks = ?, lastupdate = now() ";
				
				$typeFilter = new TypeFilter();
				$type = new Type();

				
				if (!is_null($_type))
				{
					$type = $_type;
				}
				// concatnate where statement
				if (!is_null($_typeFilter))
				{
					$typeFilter = $_typeFilter;
					$update_sql .= $typeFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";
				
				/*
				echo "From Dao: <br/>" .
						"Sid: " . $type->getSid() . "<br/>" .
						"Type: " . $type->getType() . "<br/>" .
						"Remarks: " . $type->getReamrks() . "<br/>" . 
						"LastUpdate : " . $type->getLastUpdate() . "<br/>"; 
				*/

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'ss';
				$bindParamList = new ArrayList();
				$bindParamList->add($type->getType());
				$bindParamList->add($type->getRemarks());
				
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
		
		public function deleteType($_typeFilter)
		{
			try 
			{
				$delete_sql = "delete from cle_type ";
				
				$typeFilter = new TypeFilter();
				
				// concatnate where statement
				if (!is_null($_typeFilter))
				{
					$typeFilter = $_typeFilter;
					$delete_sql .= $typeFilter->getWhereClause();
				}

				
				// echo "sql statement: " . $delete_sql . "<br/>";
				
				/*
				echo "From Dao: <br/>" .
						"Sid: " . $type->getSid() . "<br/>" .
						"Type: " . $type->getType() . "<br/>" .
						"Remarks: " . $type->getReamrks() . "<br/>" . 
						"LastUpdate : " . $type->getLastUpdate() . "<br/>"; 
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
			public function selectTypeMysqli($_typeFilter)
		{
			try {
				$select_sql = "select * from cle_type ";
				$typeFilter = new TypeFilter();
				
				if (!is_null($_typeFilter))
				{
					$typeFilter = $_typeFilter;	
					$select_sql = $select_sql . $typeFilter->getWhereClause();
					$select_sql .= $typeFilter->getOrderByClause();
				}
				
				
				echo "sql statement: " . $select_sql;
				// echo "sid: " . $resourceFilter->getSid();
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($select_sql);
				//$statement->bind_param("i", $webRef->getSid());
				$statement->execute();
	
				$typeList = new ArrayList();
				
				/* Bind results */
				$statement -> bind_result($sid, $typef, $remarks, $lastUpdate );
				
				while ($statement->fetch())
				{
					$type = new Type();
					
					$type->setSid($sid);
					$type->setType($typef);
					$type->setRemarks($remarks);
					$type->setLastUpdate($lastUpdate);

					/*
					echo "From Dao: <br/>" .
							"Sid: " . $type->getSid() . "<br/>" .
							"Type: " . $type->getType() . "<br/>" .
							"Remarks: " . $type->getRemarks() . "<br/>" . 
							"LastUpdate : " . $type->getLastUpdate() . "<br/>"; 
					*/
					$typeList->add($type);
					
				}
				
				return $typeList;			
			}
			catch (Exception $e)
			{
				echo 'Exception: ' . $e . '<br/>';
			}
		} // end select
		
		public function insertTypeMysqli($_type)
		{
			try 
			{
				$insert_sql = "insert into cle_type(Type, Remarks) ".
								"values(?,?)";
	
				$type = new Type();

				
				if (!is_null($_type))
				{
					$type = $_type;
				}

				
				echo 'sql statement: ' . $insert_sql . '<br/>';
				

				echo 'Sid: ' . $type->getSid() . '<br/>'.
			    'Type: ' . $type->getType() . '<br/>'.
				'Remarks: ' . $type->getRemarks() . '<br/>'.
				'LastUpdate: ' . $type->getLastUpdate() . '<br/>';


				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($insert_sql);
				$statement->bind_param("ss", $type->getType(), $type->getRemarks());
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
		
		public function updateTypeMysqli($_type, $_typeFilter)
		{
			try 
			{
				$update_sql = "update cle_type set Type = ?, Remarks = ?, lastupdate = now() ";
				
				$typeFilter = new TypeFilter();
				$type = new Type();

				
				if (!is_null($_type))
				{
					$type = $_type;
				}
				// concatnate where statement
				if (!is_null($_typeFilter))
				{
					$typeFilter = $_typeFilter;
					$update_sql .= $typeFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";
				
				/*
				echo "From Dao: <br/>" .
						"Sid: " . $type->getSid() . "<br/>" .
						"Type: " . $type->getType() . "<br/>" .
						"Remarks: " . $type->getReamrks() . "<br/>" . 
						"LastUpdate : " . $type->getLastUpdate() . "<br/>"; 
				*/

				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($update_sql);
				$statement->bind_param("ss", $type->getType(), $type->getRemarks());
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
		
		public function deleteTypeMysqli($_typeFilter)
		{
			try 
			{
				$delete_sql = "delete from cle_type ";
				
				$typeFilter = new TypeFilter();
				
				// concatnate where statement
				if (!is_null($_typeFilter))
				{
					$typeFilter = $_typeFilter;
					$delete_sql .= $typeFilter->getWhereClause();
				}

				
				// echo "sql statement: " . $delete_sql . "<br/>";
				
				/*
				echo "From Dao: <br/>" .
						"Sid: " . $type->getSid() . "<br/>" .
						"Type: " . $type->getType() . "<br/>" .
						"Remarks: " . $type->getReamrks() . "<br/>" . 
						"LastUpdate : " . $type->getLastUpdate() . "<br/>"; 
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
		
	} // end class

?>