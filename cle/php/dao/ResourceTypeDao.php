<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';

	require_once( $currentDir.'php/common/Connection.php' );
	require_once( $currentDir.'php/common/ArrayList.php' );
	require_once( $currentDir.'php/vo/ResourceType.php' );
	require_once( $currentDir.'php/common/BindParam.php' );
		
	class ResourceTypeDao
	{
		
		// ===============================================================================
		// === old connection method
		// ===============================================================================
		public function selectNextSeqOfSid()
		{
			try 
			{
				$select_sql = "select coalesce(max(sid),0)+1 as Next_Sid from cle_resourcetype ";
				
				$conn = Connection::getMysqliConnectionInstance();
				// echo "sql statement: " . $select_sql;				
				
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysql_query($statement);
				
				$returnNextSid = 0;
				
				while($result = mysql_fetch_array($sql)) 
				{
					$returnNextSid = $result['Next_Sid'];
				}
				
				if (is_null($returnNextSid))
				{
					$returnNextSid= 0;
				}
				
				// echo 'NextSid: ' . $nextSid . '<br/>';
				
				return $returnNextSid;				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "<br/>" );				
			}
		}
		
		public function selectMaxSeqOfTheLv($_resourceTypeFilter)
		{
			try 
			{
				$select_sql = "select max(Seq) as MaxSeqLv from cle_resourcetype ";

				/*
				echo 'From Dao: '.
					'sid: ' . $_resourceTypeFilter->getSid() . '</br>' .
					'seq: ' . $_resourceTypeFilter->getSeq() . '</br>' .
					'lv: ' . $_resourceTypeFilter->getLv() . '</br>' .
					'lvText: ' . $_resourceTypeFilter->getLvText() . '</br>'.
					'upLvSid: ' . $_resourceTypeFilter->getUpLvSid() . '</br>' .
					'isShown: ' . $_resourceTypeFilter->getIsShown() . '</br>' .
					'isNetvigated: ' . $_resourceTypeFilter->getIsNetvigated() . '</br>' .
					'url: ' . $_resourceTypeFilter->getUrl() . '</br>' .
					'remarks: ' . $_resourceTypeFilter->getRemarks() . '</br>' .
					'lastUpdate: ' . $_resourceTypeFilter->getLastUpdate() . '</br>';
				*/
				
				$resourceTypeFilter = new ResourceTypeFilter();

				if (!is_null($_resourceTypeFilter))
				{
					$resourceTypeFilter = $_resourceTypeFilter;	
					$select_sql = $select_sql . $resourceTypeFilter->getWhereClause();
					$select_sql .= $resourceTypeFilter->getOrderByClause();
				}				
				
				$conn = Connection::getMysqliConnectionInstance();
				// echo "sql statement: " . $select_sql;				
				
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysql_query($statement);
				
				$returnMaxSeqLv = 0;
				
				while($result = mysql_fetch_array($sql)) 
				{
					$returnMaxSeqLv = $result['MaxSeqLv'];
				}
				
				if (is_null($returnMaxSeqLv))
				{
					$returnMaxSeqLv= 0;
				}
				return $returnMaxSeqLv;
				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "<br/>" );
			}			
		}
		
		public function selectMaxResourceTypeLv()
		{
			try 
			{
				$select_sql = "select max(LV) as MaxLv from cle_resourcetype ";
				$conn = Connection::getMysqliConnectionInstance();
				
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysqli_query($conn, $statement);

				$returnMaxLv = 0;				
				
				while($result = mysqli_fetch_array($sql)) 
				{
					$returnMaxLv = $result['MaxLv'];
				}
				
				return $returnMaxLv;
				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "<br/>" );
			}
		}
		
		public function selectResourceType($value)
		{
			try 
			{
				$select_sql = "select * from cle_resourcetype ";
				$resourceTypeFilter = new ResourceTypeFilter();
				
				if (!is_null($value))
				{
					$resourceTypeFilter = $value;	
					$select_sql = $select_sql . $resourceTypeFilter->getWhereClause();
					$select_sql .= $resourceTypeFilter->getOrderByClause();
				}
				
				
				// echo "sql statement: " . $select_sql;
				// echo "sid: " . $resourceTypeFilter->getSid();
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();				
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysqli_query($conn, $statement);
					
				$resourceTypeList = new ArrayList();
								
				while ($result = mysqli_fetch_array($sql))
				{
					$resourceType = new ResourceType();
					
					$resourceType->setSid($result['sid']);
					$resourceType->setSeq($result['Seq']);
					$resourceType->setLv($result['LV']);
					$resourceType->setLvText($result['LV_Text']);
					$resourceType->setUpLvSid($result['UpLV_sid']);
					$resourceType->setIsShown($result['IsShown']);
					$resourceType->setIsNetvigated($result['IsNetvigated']);					
					$resourceType->setUrl($result['url']);
					$resourceType->setRemarks($result['Remarks']);
					$resourceType->setLastUpdate($result['LastUpdate']);
					
					/*
					if ($isNetvigated != 1)
					{
						echo 'isNetvigated: ' . $isNetvigated . '<br/>';
						echo 'isString? ' . is_string($isNetvigated) . '<br/>' .
							'isBoolean? ' . is_bool($isNetvigated) . '<br/>' .
							'isNumeric? ' . is_numeric($isNetvigated) . '<br/>';
					}
					*/
					
					/*
					echo "From Dao: <br/>" .
							"Sid: " . $resourceType->getSid() . "<br/>" .
							"Seq: " . $resourceType->getSeq() . "<br/>" .
							"LV: " . $resourceType->getLv() . "<br/>" . 
							"LV_Text: " . $resourceType->getLvText(). "<br/>" . 
							"UpLV_sid: " . $resourceType->getUpLvSid() . "<br/>" .
							"IsShown : " . $resourceType->getIsShown() . "<br/>" .
							"Remarks : " . $resourceType->getRemarks() . "<br/>" .
							"LastUpdate : " . $resourceType->getLastUpdate() . "<br/>"; 
					*/
					
					
					$resourceTypeList->add($resourceType);
					
				}
				
				return $resourceTypeList;
					
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "<br/>" );
			}
		} // end select
		public function insertResourceType($_resourceType)
		{
			try
			{
				
				$insert_sql = "insert into cle_resourcetype (Seq, LV, LV_Text, UpLV_sid, IsShown, IsNetvigated, url, Remarks) " .
								"values (?,?,?,?,?,?,?,?)";

				$resourceType = new ResourceType();
				if (!is_null($_resourceType))
				{
					$resourceType = $_resourceType;
				}				
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'iisiiiss';
				$bindParamList = new ArrayList();
				$bindParamList->add($resourceType->getSeq());
				$bindParamList->add($resourceType->getLv());
				$bindParamList->add($resourceType->getLvText());
				$bindParamList->add($resourceType->getUpLvSid());
				$bindParamList->add($resourceType->getIsShown());
				$bindParamList->add($resourceType->getIsNetvigated());
				$bindParamList->add($resourceType->getUrl());
				$bindParamList->add($resourceType->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);
				
				// echo 'sql statement: ' . $statement . '<br/>';
				$result = mysql_query($statement);
								
				/*
				echo '---- ResourceTypeDao ----' . '<br/>' .
				'PostParam: ' . $_POST[PostParam::$POST_PARAM] . '<br/>'.
				'Sid: ' . $resourceType->getSid() . '<br/>' .
				'Seq: '. $resourceType->getSeq() . '<br/>' .
				'Lv: '. $resourceType->getLv() . '<br/>' .
				'Lv Text: '. $resourceType->getLvText() . '<br/>' .
				'Up Lv Sid: '. $resourceType->getUpLvSid() . '<br/>' .
				'Is Shown: ' . $resourceType->getIsShown() . 'int: ' . intval($resourceType->getIsShown()) . '<br/>' .
				'Is Netvigated: ' . $resourceType->getIsNetvigated() . 'int: ' . intval($resourceType->getIsNetvigated()) . '<br/>' .
				'Url: ' . $resourceType->getUrl() . '<br/>' .
				'Remarks: ' . $resourceType->getRemarks() . '<br/>';					
				*/
		
				/*
				if ($result > 0)
				{
					echo $result . ' record inserted successfully!';
				}
				*/
				
				$lastInsertSid = 0;
				
				if ($result > 0)
				{
					$lastInsertSid = mysql_insert_id($conn);
				}
				
				return $lastInsertSid;
				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e. "\n");
			}
		} // end insert
		public function updateResourceType($_resourceType, $_resourceTypeFilter)
		{
			try
			{
				$update_sql = "update cle_resourcetype set Seq = ?, LV = ?, LV_Text = ?, UpLV_sid = ?, IsShown = ?, IsNetvigated = ?, url = ?, Remarks = ? ,LastUpdate = now() ";
								
				$resourceType = new ResourceType();
				$resourceTypeFilter = new ResourceTypeFilter();
				
				if (!is_null($_resourceType))
				{
					$resourceType = $_resourceType;
				}
				if (!is_null($_resourceTypeFilter))
				{
					$resourceTypeFilter = $_resourceTypeFilter;
					$update_sql .= $resourceTypeFilter->getWhereClause();

				}
				
				/*
				echo '---- ResourceTypeDao ----' . '<br/>' .
				'PostParam: ' . $_POST[PostParam::$POST_PARAM] . '<br/>'.
				'Sid: ' . $resourceType->getSid() . '<br/>' .
				'Seq: '. $resourceType->getSeq() . '<br/>' .
				'Lv: '. $resourceType->getLv() . '<br/>' .
				'Lv Text: '. $resourceType->getLvText() . '<br/>' .
				'Up Lv Sid: '. $resourceType->getUpLvSid() . '<br/>' .
				'Is Shown: ' . $resourceType->getIsShown() . ',int: ' . is_bool($resourceType->getIsShown()) . '<br/>' .
				'Is Netvigated: ' . $resourceType->getIsNetvigated() . ',int: ' . is_bool($resourceType->getIsNetvigated()) . '<br/>' .
				'Url: ' . $resourceType->getUrl() . '<br/>' .
				'Remarks: ' . $resourceType->getRemarks() . '<br/>';	
				*/
				/*
				echo 'isstring: '. is_string($resourceType->getIsShown()) .'<br/>' .
					'isbool: ' . is_bool($resourceType->getIsShown()) .'<br/>'.
					'isnumeric: ' . is_numeric($resourceType->getIsShown()) .'<br/>';
				*/
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'iisiiiss';
				$bindParamList = new ArrayList();
				$bindParamList->add($resourceType->getSeq());
				$bindParamList->add($resourceType->getLv());
				$bindParamList->add($resourceType->getLvText());
				$bindParamList->add($resourceType->getUpLvSid());
				$bindParamList->add($resourceType->getIsShown());
				$bindParamList->add($resourceType->getIsNetvigated());
				$bindParamList->add($resourceType->getUrl());
				$bindParamList->add($resourceType->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				$result = mysql_query($statement);
				

				if ($result > 0)
				{
					$result = $_resourceType->getSid();
				}
				
				return $result;
				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e. "<br/>");
			}			
		} // end update
		public function deleteResourceType($_resourceTypeFilter)
		{
			try 
			{
				$delete_sql = "delete from cle_resourcetype ";
				
				$resourceTypeFilter = new ResourceTypeFilter();
				
				if (!is_null($_resourceTypeFilter))
				{
					$resourceTypeFilter = $_resourceTypeFilter;
					$delete_sql .= $resourceTypeFilter->getWhereClause();
				}				
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $delete_sql);
				
				$result = mysql_query($statement);				
				
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
				echo ("Exception: " . $e. "<br/>");				
			}
		}		
		
		
		
		// ===============================================================================
		// === mysqli
		// ===============================================================================
		
		public function selectNextSeqOfSidMysqli()
		{
			try 
			{
				$select_sql = "select coalesce(max(sid),0)+1 as Next_Sid from cle_resourcetype ";
				
				$conn = Connection::getConnectionInstance();
				// echo "sql statement: " . $select_sql;				
				
				$statement = $conn->prepare($select_sql);
				//$statement->bind_param("i", $webRef->getSid());
				$statement->execute();
				$statement -> bind_result($nextSid);
				
				$returnNextSid = 0;
				
				while ($statement->fetch())
				{
					$returnNextSid = $nextSid;
				}
				
				if (is_null($returnNextSid))
				{
					$returnNextSid= 0;
				}
				
				// echo 'NextSid: ' . $nextSid . '<br/>';
				
				return $returnNextSid;				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "<br/>" );				
			}
		}
		
		public function selectMaxSeqOfTheLvMysqli($_resourceTypeFilter)
		{
			try 
			{
				$select_sql = "select max(Seq) as MaxSeqLv from cle_resourcetype ";

				/*
				echo 'From Dao: '.
					'sid: ' . $_resourceTypeFilter->getSid() . '</br>' .
					'seq: ' . $_resourceTypeFilter->getSeq() . '</br>' .
					'lv: ' . $_resourceTypeFilter->getLv() . '</br>' .
					'lvText: ' . $_resourceTypeFilter->getLvText() . '</br>'.
					'upLvSid: ' . $_resourceTypeFilter->getUpLvSid() . '</br>' .
					'isShown: ' . $_resourceTypeFilter->getIsShown() . '</br>' .
					'isNetvigated: ' . $_resourceTypeFilter->getIsNetvigated() . '</br>' .
					'url: ' . $_resourceTypeFilter->getUrl() . '</br>' .
					'remarks: ' . $_resourceTypeFilter->getRemarks() . '</br>' .
					'lastUpdate: ' . $_resourceTypeFilter->getLastUpdate() . '</br>';
				*/
				
				$resourceTypeFilter = new ResourceTypeFilter();

				if (!is_null($_resourceTypeFilter))
				{
					$resourceTypeFilter = $_resourceTypeFilter;	
					$select_sql = $select_sql . $resourceTypeFilter->getWhereClause();
					$select_sql .= $resourceTypeFilter->getOrderByClause();
				}				
				
				$conn = Connection::getConnectionInstance();
				// echo "sql statement: " . $select_sql;				
				
				$statement = $conn->prepare($select_sql);
				//$statement->bind_param("i", $webRef->getSid());
				$statement->execute();
				$statement -> bind_result($maxSeqLv);
				
				$returnMaxSeqLv = 0;
				
				while ($statement->fetch())
				{
					$returnMaxSeqLv = $maxSeqLv;
				}
				
				if (is_null($returnMaxSeqLv))
				{
					$returnMaxSeqLv= 0;
				}
				return $returnMaxSeqLv;
				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "<br/>" );
			}			
		}
		
		public function selectMaxResourceTypeLvMysqli()
		{
			try 
			{
				$select_sql = "select max(LV) as MaxLv from cle_resourcetype ";
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($select_sql);
				//$statement->bind_param("i", $webRef->getSid());
				$statement->execute();
				$statement -> bind_result($maxLv);
				
				$returnMaxLv = 0;
				
				while ($statement->fetch())
				{
					$returnMaxLv = $maxLv;
				}
				
				return $returnMaxLv;
				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "<br/>" );
			}
		}
		
		public function selectResourceTypeMysqli($value)
		{
			try 
			{
				$select_sql = "select * from cle_resourcetype ";
				$resourceTypeFilter = new ResourceTypeFilter();
				
				if (!is_null($value))
				{
					$resourceTypeFilter = $value;	
					$select_sql = $select_sql . $resourceTypeFilter->getWhereClause();
					$select_sql .= $resourceTypeFilter->getOrderByClause();
				}
				
				
				// echo "sql statement: " . $select_sql;
				// echo "sid: " . $resourceTypeFilter->getSid();
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($select_sql);
				//$statement->bind_param("i", $webRef->getSid());
				$statement->execute();
	
				$resourceTypeList = new ArrayList();
				
				/* Bind results */
				$statement -> bind_result($sid, $seq, $lv, $lvText, $upLvSid, $isShown, $isNetvigated, $url, $remarks, $lastUpdate);
				
				while ($statement->fetch())
				{
					$resourceType = new ResourceType();
					
					$resourceType->setSid($sid);
					$resourceType->setSeq($seq);
					$resourceType->setLv($lv);
					$resourceType->setLvText($lvText);
					$resourceType->setUpLvSid($upLvSid);
					$resourceType->setIsShown($isShown);
					$resourceType->setIsNetvigated($isNetvigated);					
					$resourceType->setUrl($url);
					$resourceType->setRemarks($remarks);
					$resourceType->setLastUpdate($lastUpdate);
					
					/*
					if ($isNetvigated != 1)
					{
						echo 'isNetvigated: ' . $isNetvigated . '<br/>';
						echo 'isString? ' . is_string($isNetvigated) . '<br/>' .
							'isBoolean? ' . is_bool($isNetvigated) . '<br/>' .
							'isNumeric? ' . is_numeric($isNetvigated) . '<br/>';
					}
					*/
					
					/*
					echo "From Dao: <br/>" .
							"Sid: " . $resourceType->getSid() . "<br/>" .
							"Seq: " . $resourceType->getSeq() . "<br/>" .
							"LV: " . $resourceType->getLv() . "<br/>" . 
							"LV_Text: " . $resourceType->getLvText(). "<br/>" . 
							"UpLV_sid: " . $resourceType->getUpLvSid() . "<br/>" .
							"IsShown : " . $resourceType->getIsShown() . "<br/>" .
							"Remarks : " . $resourceType->getRemarks() . "<br/>" .
							"LastUpdate : " . $resourceType->getLastUpdate() . "<br/>"; 
					*/
					
					
					$resourceTypeList->add($resourceType);
					
				}
				
				return $resourceTypeList;
					
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "<br/>" );
			}
		} // end select
		public function insertResourceTypeMysqli($_resourceType)
		{
			try
			{
				
				$insert_sql = "insert into cle_resourcetype (Seq, LV, LV_Text, UpLV_sid, IsShown, IsNetvigated, url, Remarks) " .
								"values (?,?,?,?,?,?,?,?)";

				$resourceType = new ResourceType();
				if (!is_null($_resourceType))
				{
					$resourceType = $_resourceType;
				}				
				
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($insert_sql);
				$statement->bind_param("iisissss", $resourceType->getSeq(), $resourceType->getLv(), 
										$resourceType->getLvText(), $resourceType->getUpLvSid(), 
										$resourceType->getIsShown(), $resourceType->getIsNetvigated(), 
										$resourceType->getUrl(), $resourceType->getRemarks());
				$result = $statement->execute();
								
				/*
				echo '---- ResourceTypeDao ----' . '<br/>' .
				'PostParam: ' . $_POST[PostParam::$POST_PARAM] . '<br/>'.
				'Sid: ' . $resourceType->getSid() . '<br/>' .
				'Seq: '. $resourceType->getSeq() . '<br/>' .
				'Lv: '. $resourceType->getLv() . '<br/>' .
				'Lv Text: '. $resourceType->getLvText() . '<br/>' .
				'Up Lv Sid: '. $resourceType->getUpLvSid() . '<br/>' .
				'Is Shown: ' . $resourceType->getIsShown() . 'int: ' . intval($resourceType->getIsShown()) . '<br/>' .
				'Is Netvigated: ' . $resourceType->getIsNetvigated() . 'int: ' . intval($resourceType->getIsNetvigated()) . '<br/>' .
				'Url: ' . $resourceType->getUrl() . '<br/>' .
				'Remarks: ' . $resourceType->getRemarks() . '<br/>';					
				*/
		
				/*
				if ($result > 0)
				{
					echo $result . ' record inserted successfully!';
				}
				*/
				
				$lastInsertSid = 0;
				
				if ($result > 0)
				{
					$lastInsertSid = mysqli_insert_id($conn);
				}
				
				return $lastInsertSid;
				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e. "\n");
			}
		} // end insert
		public function updateResourceTypeMysqli($_resourceType, $_resourceTypeFilter)
		{
			try
			{
				$update_sql = "update cle_resourcetype set Seq = ?, LV = ?, LV_Text = ?, UpLV_sid = ?, IsShown = ?, IsNetvigated = ?, url = ?, Remarks = ? ,LastUpdate = now() ";
								
				$resourceType = new ResourceType();
				$resourceTypeFilter = new ResourceTypeFilter();
				
				if (!is_null($_resourceType))
				{
					$resourceType = $_resourceType;
				}
				if (!is_null($_resourceTypeFilter))
				{
					$resourceTypeFilter = $_resourceTypeFilter;
					$update_sql .= $resourceTypeFilter->getWhereClause();

				}
				
				/*
				echo '---- ResourceTypeDao ----' . '<br/>' .
				'PostParam: ' . $_POST[PostParam::$POST_PARAM] . '<br/>'.
				'Sid: ' . $resourceType->getSid() . '<br/>' .
				'Seq: '. $resourceType->getSeq() . '<br/>' .
				'Lv: '. $resourceType->getLv() . '<br/>' .
				'Lv Text: '. $resourceType->getLvText() . '<br/>' .
				'Up Lv Sid: '. $resourceType->getUpLvSid() . '<br/>' .
				'Is Shown: ' . $resourceType->getIsShown() . ',int: ' . is_bool($resourceType->getIsShown()) . '<br/>' .
				'Is Netvigated: ' . $resourceType->getIsNetvigated() . ',int: ' . is_bool($resourceType->getIsNetvigated()) . '<br/>' .
				'Url: ' . $resourceType->getUrl() . '<br/>' .
				'Remarks: ' . $resourceType->getRemarks() . '<br/>';	
				*/
				/*
				echo 'isstring: '. is_string($resourceType->getIsShown()) .'<br/>' .
					'isbool: ' . is_bool($resourceType->getIsShown()) .'<br/>'.
					'isnumeric: ' . is_numeric($resourceType->getIsShown()) .'<br/>';
				*/
				
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($update_sql);
				$statement->bind_param("iisiiiss", $resourceType->getSeq(), $resourceType->getLv(), 
										$resourceType->getLvText(), $resourceType->getUpLvSid(), 
										$resourceType->getIsShown(), $resourceType->getIsNetvigated(), 
										$resourceType->getUrl(), $resourceType->getRemarks());
				$result = $statement->execute();
				
				/*
				if ($result > 0)
				{
					echo $result . ' record(s) updated successfully!';
				}
				*/
				
				return $result;
				
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e. "<br/>");
			}			
		} // end update
		public function deleteResourceTypeMysqli($_resourceTypeFilter)
		{
			try 
			{
				$delete_sql = "delete from cle_resourcetype ";
				
				$resourceTypeFilter = new ResourceTypeFilter();
				
				if (!is_null($_resourceTypeFilter))
				{
					$resourceTypeFilter = $_resourceTypeFilter;
					$delete_sql .= $resourceTypeFilter->getWhereClause();
				}				
				
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($delete_sql);
				// $statement->bind_param("ssssss", $resource->getUrl(), $resource->getResourceName(), $resource->getAuthor(), $resource->getTeachingAims(), $resource->getTypeSid(), $resource->getRemarks());
				$result = $statement->execute();				
				
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
				echo ("Exception: " . $e. "<br/>");				
			}
		}
		
	}// end class
?>