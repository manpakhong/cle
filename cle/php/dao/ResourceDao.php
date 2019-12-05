<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once( $currentDir.'php/common/Connection.php' );
	require_once( $currentDir.'php/common/ArrayList.php' );
	require_once( $currentDir.'php/vo/Resource.php' );
	require_once( $currentDir.'php/common/BindParam.php' );

	class ResourceDao
	{

		// ===============================================================================
		// === old connection method
		// ===============================================================================		
		
		public function selectResource($value)
		{
			try 
			{
				$select_sql = "select r.*, t.Type from cle_resource r left join cle_type t on r.Type_sid = t.sid ";
				$resourceFilter = new ResourceFilter();
				
				if (!is_null($value))
				{
					$resourceFilter = $value;	
					$select_sql = $select_sql . $resourceFilter->getWhereClause('r');
					$select_sql .= $resourceFilter->getOrderByClause('r');
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysqli_query($conn, $statement);
	
				$resourceList = new ArrayList();
				
				while ($result = mysqli_fetch_array($sql))
				{
					$resource = new Resource();
					
					$resource->setSid($result['sid']);
					$resource->setUrl($result['URL']);
					$resource->setResourceName($result['ResourceName']);
					$resource->setAuthor($result['Author']);
					$resource->setTeachingAims($result['TeachingAims']);
					$resource->setTypeMenuSid($result['TypeMenu_sid']);
					$resource->setTypeSid($result['Type_sid']);
					$resource->setType($result['Type']);
					$resource->setRemarks($result['Remarks']);
					$resource->setPic($result['Pic']);
					$resource->setImageUrl($result['Image_URL']);
					$resource->setLastUpdate($result['LastUpdate']);
					
					/*
					echo "From Dao: <br/>" .
							"Sid: " . $resource->getSid() . "<br/>" .
							"Url: " . $resource->getUrl() . "<br/>" .
							"ResourceName: " . $resource->getResourceName() . "<br/>" . 
							"Author: " . $resource->getAuthor(). "<br/>" . 
							"TeachingAims: " . $resource->getTeachingAims() . "<br/>" .
							"Type Sid : " . $resource->getTypeSid() . "<br/>" .
							"Remarks : " . $resource->getRemarks() . "<br/>" .
							"LastUpdate : " . $resource->getLastUpdate() . "<br/>"; 
					*/
					
					
					$resourceList->add($resource);
					
				}
				
				return $resourceList;
					
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "\n" );
			}
		} // end select
		
		public function insertResource($_resource)
		{
			try 
			{
				$insert_sql = "insert into cle_resource(URL, ResourceName, Author, TeachingAims, TypeMenu_sid, Type_sid, Remarks, Image_URL, Pic) ".
								"values(?,?,?,?,?,?,?,?,?)";
				
				$resource = new Resource();

				
				if (!is_null($_resource))
				{
					$resource = $_resource;
				}

				
				/*

				
				echo 'Sid: ' . $resource->getSid() . '<br/>'.
			    'URL: ' . $resource->getUrl() . '<br/>'.
				'Resource Name: ' . $resource->getResourceName() . '<br/>'.
				'Author: ' . $resource->getAuthor() . '<br/>'.
				'Teaching Aims: ' . $resource->getTeachingAims() . '<br/>'.
				'TypeMenu Sid: ' . $resource->getTypeMenuSid() . '<br/>'.
				'Type Sid: ' . $resource->getTypeSid() . '<br/>'.				
				'Remarks: ' . $resource->getRemarks() . '<br/>'.
				'Pic: ' . '<img src="'. $resource->getPic() .'"/>' . '<br/>'.
				'LastUpdate: ' . $resource->getLastUpdate() . '<br/>'. 
				'Type: '. $resource->getType() . '<br/>'				
				;
				*/

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'ssssiisss';
				$bindParamList = new ArrayList();
				$bindParamList->add($resource->getUrl());
				$bindParamList->add($resource->getResourceName());
				$bindParamList->add($resource->getAuthor());
				$bindParamList->add($resource->getTeachingAims());
				$bindParamList->add($resource->getTypeMenuSid());
				$bindParamList->add($resource->getTypeSid());
				$bindParamList->add($resource->getRemarks());
				$bindParamList->add($resource->getImageUrl());
				$bindParamList->add($resource->getPic());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);

				// echo 'sql statement: ' . $statement . '<br/>';						
				$result = mysql_query($statement);			


				
				/*
				if ($result > 0)
				{
					echo $result . " record(s) inserted Completely!";
				}				
				*/
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e;
			}
		} // end insert		
		
		public function updateResource($value, $valueFilter)
		{
			try 
			{
				$update_sql = "update cle_resource set URL = ?, ResourceName = ?, Author = ?, TeachingAims= ?, TypeMenu_sid = ?, Type_sid = ?, Remarks = ?, Image_URL = ?, Pic = ?, lastupdate = now() ";
				
				$resourceFilter = new ResourceFilter();
				$resource = new Resource();

				
				if (!is_null($value))
				{
					$resource = $value;
				}
				// concatnate where statement
				if (!is_null($valueFilter))
				{
					$resourceFilter = $valueFilter;
					$update_sql .= $resourceFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";
				
				/*
				echo "Sid: " . $resource->getSid() . "<br/>".
			    "URL: " . $resource->getUrl() . "<br/>".
				"Resource Name: " . $resource->getResourceName() . "<br/>".
				"Author: " . $resource->getAuthor() . "<br/>".
				"Teaching Aims: " . $resource->getTeachingAims() . "<br/>".
				"TypeMenu Sid: " . $resource->getTypeMenuSid() . "<br/>".				
				"Type Sid: " . $resource->getTypeSid() . "<br/>".
				"Remarks: " . $resource->getRemarks() . "<br/>".
				'Pic: ' . '<img src="'. $resource->getPic() .'"/>' . '<br/>'.
				'Image Url: '. $resource->getImageUrl(). '<br/>'.
				'Type: '. $resource->getType() . '<br/>'.				
				"LastUpdate: " . $resource->getLastUpdate() . "<br/>";
				*/

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'ssssiisss';
				$bindParamList = new ArrayList();
				$bindParamList->add($resource->getUrl());
				$bindParamList->add($resource->getResourceName());
				$bindParamList->add($resource->getAuthor());
				$bindParamList->add($resource->getTeachingAims());
				$bindParamList->add($resource->getTypeMenuSid());				
				$bindParamList->add($resource->getTypeSid());
				$bindParamList->add($resource->getRemarks());
				$bindParamList->add($resource->getImageUrl());
				$bindParamList->add($resource->getPic());
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				// echo 'Statement: ' . $statement. '<br/>';
				
				$result = mysql_query($statement);				

				/*
				if ($result > 0)
				{
					echo $result . " record(s) updated Completely!";
				}
				*/				
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e;
			}
		} // end update		
		
		public function deleteResource($_resourceFilter)
		{
			try 
			{
				$delete_sql = "delete from cle_resource ";
				
				$resourceFilter = new ResourceFilter();
				
				// concatnate where statement
				if (!is_null($_resourceFilter))
				{
					$resourceFilter = $_resourceFilter;
					$delete_sql .= $resourceFilter->getWhereClause();
				}

				
				// echo "sql statement: " . $delete_sql . "<br/>";
				
				/*
				echo "Sid: " . $resource->getSid() . "<br/>".
			    "URL: " . $resource->getUrl() . "<br/>".
				"Resource Name: " . $resource->getResourceName() . "<br/>".
				"Author: " . $resource->getAuthor() . "<br/>".
				"Teaching Aims: " . $resource->getTeachingAims() . "<br/>".
				"Type Sid: " . $resource->getTypeSid() . "<br/>".
				"Remarks: " . $resource->getRemarks() . "<br/>".
				"LastUpdate: " . $resource->getLastUpdate() . "<br/>";
				*/

				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $delete_sql);
				
				$result = mysqli_query($conn, $statement);				
				
				/*
				if ($result > 0)
				{
					echo $result . " record deleted Completely!";
				}
				*/				
				
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
			public function selectResourceMysqli($value)
		{
			try 
			{
				$select_sql = "select r.*, t.type from cle_resource r left join cle_type t on r.Type_sid = t.sid ";
				$resourceFilter = new ResourceFilter();
				
				if (!is_null($value))
				{
					$resourceFilter = $value;	
					$select_sql = $select_sql . $resourceFilter->getWhereClause('r');
					$select_sql .= $resourceFilter->getOrderByClause('r');
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($select_sql);
				//$statement->bind_param("i", $webRef->getSid());
				$statement->execute();
	
				$resourceList = new ArrayList();
				
				/* Bind results */
				$statement -> bind_result($sid, $url, $resourceName, $author, $teachingAims,  $typeMenuSid, $typeSid, $remarks, $pic, $lastUpdate, $type );
				
				while ($statement->fetch())
				{
					$resource = new Resource();
					
					$resource->setSid($sid);
					$resource->setUrl($url);
					$resource->setResourceName($resourceName);
					$resource->setAuthor($author);
					$resource->setTeachingAims($teachingAims);
					$resource->setTypeMenuSid($typeMenuSid);
					$resource->setTypeSid($typeSid);
					$resource->setRemarks($remarks);
					$resource->setPic($pic);
					$resource->setLastUpdate($lastUpdate);
					$resource->setType($type);
					
					/*
					echo "From Dao: <br/>" .
							"Sid: " . $resource->getSid() . "<br/>" .
							"Url: " . $resource->getUrl() . "<br/>" .
							"ResourceName: " . $resource->getResourceName() . "<br/>" . 
							"Author: " . $resource->getAuthor(). "<br/>" . 
							"TeachingAims: " . $resource->getTeachingAims() . "<br/>" .
							"Type Sid : " . $resource->getTypeSid() . "<br/>" .
							"Remarks : " . $resource->getRemarks() . "<br/>" .
							"LastUpdate : " . $resource->getLastUpdate() . "<br/>"; 
					*/
					
					
					$resourceList->add($resource);
					
				}
				
				return $resourceList;
					
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "\n" );
			}
		} // end select
		
		public function insertResourceMysqli($_resource)
		{
			try 
			{
				$insert_sql = "insert into cle_resource(URL, ResourceName, Author, TeachingAims, TypeMenu_sid, Type_sid, Remarks, Pic) ".
								"values(?,?,?,?,?,?,?,?)";
				
				$resource = new Resource();

				
				if (!is_null($_resource))
				{
					$resource = $_resource;
				}

				
				echo 'sql statement: ' . $insert_sql . '<br/>';
				

				echo 'Sid: ' . $resource->getSid() . '<br/>'.
			    'URL: ' . $resource->getUrl() . '<br/>'.
				'Resource Name: ' . $resource->getResourceName() . '<br/>'.
				'Author: ' . $resource->getAuthor() . '<br/>'.
				'Teaching Aims: ' . $resource->getTeachingAims() . '<br/>'.
				'TypeMenu Sid: ' . $resource->getTypeMenuSid() . '<br/>'.
				'Type Sid: ' . $resource->getTypeSid() . '<br/>'.				
				'Remarks: ' . $resource->getRemarks() . '<br/>'.
				'Pic: ' . '<img src="'. $resource->getPic() .'"/>' . '<br/>'.
				'LastUpdate: ' . $resource->getLastUpdate() . '<br/>'. 
				'Type: '. $resource->getType() . '<br/>'				
				;


				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($insert_sql);
				$statement->bind_param("ssssssss", $resource->getUrl(), $resource->getResourceName(), $resource->getAuthor(), $resource->getTeachingAims(), $resource->getTypeMenuSid(), $resource->getTypeSid(), $resource->getRemarks(),
				$resource->getPic());
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
		
		public function updateResourceMysqli($value, $valueFilter)
		{
			try 
			{
				$update_sql = "update cle_resource set URL = ?, ResourceName = ?, Author = ?, TeachingAims= ?, TypeMenu_sid = ?, Type_sid = ?, Remarks = ?, Pic = ?, lastupdate = now() ";
				
				$resourceFilter = new ResourceFilter();
				$resource = new Resource();

				
				if (!is_null($value))
				{
					$resource = $value;
				}
				// concatnate where statement
				if (!is_null($valueFilter))
				{
					$resourceFilter = $valueFilter;
					$update_sql .= $resourceFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";
				
				/*
				echo "Sid: " . $resource->getSid() . "<br/>".
			    "URL: " . $resource->getUrl() . "<br/>".
				"Resource Name: " . $resource->getResourceName() . "<br/>".
				"Author: " . $resource->getAuthor() . "<br/>".
				"Teaching Aims: " . $resource->getTeachingAims() . "<br/>".
				"Type Sid: " . $resource->getTypeSid() . "<br/>".
				"Remarks: " . $resource->getRemarks() . "<br/>".
				'Pic: ' . '<img src="'. $resource->getPic() .'"/>' . '<br/>'.
				'Type: '. $resource->getType() . '<br/>'.				
				"LastUpdate: " . $resource->getLastUpdate() . "<br/>";
				*/

				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($update_sql);
				$statement->bind_param("ssssssss", $resource->getUrl(), $resource->getResourceName(), $resource->getAuthor(), $resource->getTeachingAims(), $resource->getTypeMenuSid(), $resource->getTypeSid(), $resource->getRemarks(),
				$resource->getPic());
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
		
		public function deleteResourceMysqli($_resourceFilter)
		{
			try 
			{
				$delete_sql = "delete from cle_resource ";
				
				$resourceFilter = new ResourceFilter();
				
				// concatnate where statement
				if (!is_null($_resourceFilter))
				{
					$resourceFilter = $_resourceFilter;
					$delete_sql .= $resourceFilter->getWhereClause();
				}

				
				// echo "sql statement: " . $delete_sql . "<br/>";
				
				/*
				echo "Sid: " . $resource->getSid() . "<br/>".
			    "URL: " . $resource->getUrl() . "<br/>".
				"Resource Name: " . $resource->getResourceName() . "<br/>".
				"Author: " . $resource->getAuthor() . "<br/>".
				"Teaching Aims: " . $resource->getTeachingAims() . "<br/>".
				"Type Sid: " . $resource->getTypeSid() . "<br/>".
				"Remarks: " . $resource->getRemarks() . "<br/>".
				"LastUpdate: " . $resource->getLastUpdate() . "<br/>";
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