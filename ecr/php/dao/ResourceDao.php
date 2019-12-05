<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir.'php/common/system/Connection.php';
	require_once $currentDir.'php/common/ArrayList.php';
	require_once $currentDir.'php/vo/Resource.php';
	require_once $currentDir.'php/common/BindParam.php';
	require_once $currentDir.'php/system/SysParams.php';	
	
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';	
	
	class ResourceDao
	{
		
		public function selectResource($_resourceFilter)
		{
			try 
			{
				$select_sql = "select * from ecr_resourcevwr ";
				$resourceFilter = new ResourceFilter();
				
				if (!is_null($_resourceFilter))
				{
					$resourceFilter = $_resourceFilter;	
					$select_sql = $select_sql . $resourceFilter->getWhereClause();
					$select_sql .= $resourceFilter->getOrderByClause();
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysql_query($statement);
	
				$resourceList = new ArrayList();
				
				while ($result = mysql_fetch_array($sql))
				{
					$resource = new Resource();
					
					// resource
					$resource->setSid($result['sid']);
					$resource->setSeq($result['Seq']);					
					$resource->setUrl($result['url']);
					$resource->setResourceNameEn($result['ResourceName_En']);
					$resource->setResourceNameTc($result['ResourceName_Tc']);
					$resource->setAuthorEn($result['Author_En']);
					$resource->setAuthorTc($result['Author_Tc']);
					$resource->setBriefingEn($result['Briefing_En']);
					$resource->setBriefingTc($result['Briefing_Tc']);
					$resource->setBriefingHtmlEn($result['BriefingHtml_En']);
					$resource->setBriefingHtmlTc($result['BriefingHtml_Tc']);					
					$resource->setTypeMenuSid($result['TypeMenu_sid']);
					$resource->setTypeSid($result['Type_sid']);
					$resource->setImageUrl($result['Image_url']);	
					$resource->setIsShown($result['IsShown']);				
					$resource->setRemarks($result['Remarks']);
					$resource->setLastUpdate($result['LastUpdate']);
					
					// menubar
					$resource->setSidM($result['sidM']);
					$resource->setSeqM($result['SeqM']);
					$resource->setLvM($result['LVM']);
					$resource->setLvTextEnM($result['LV_Text_EnM']);
					$resource->setLvTextTcM($result['LV_Text_TcM']);
					$resource->setUpLvSidM($result['UpLV_sidM']);
					$resource->setIsShownM($result['IsShownM']);
					$resource->setIsNetvigatedM($result['IsNetvigatedM']);
					$resource->setUrlM($result['urlM']);
					$resource->setRemarksM($result['RemarksM']);
					$resource->setLastUpdateM($result['LastUpdateM']);
					
					// type
					$resource->setSidT($result['sidT']);
					$resource->setTypeEnT($result['Type_EnT']);
					$resource->setTypeTcT($result['Type_TcT']);
					$resource->setRemarksT($result['RemarksT']);
					$resource->setLastUpdateT($result['LastUpdateT']);
					
					// $resource->printValues();
					// --- log
					$log = new Log();
					
		
					$logMessage = $resource->printValues() . "\n";
					
					$log->setLogDateTime(date('Y-m-d H:i:s') );
					$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
					$log->setLogModule('ResourceDao.php-selectResource()-loop');
					$log->setLogMessage($logMessage);
					
					$logHandler = new LogHandler();
					$logHandler->checkNwriteLog($log);
					
					// --- end log						
					
					
					$resourceList->add($resource);
					
				}
				// --- log
				$log = new Log();
				
	
				$logMessage = $statement . "\n" . "total records: " . $resourceList->size();
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('ResourceDao.php-selectResource()-Sql');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
				
				
				return $resourceList;
					
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
					
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ResourceDao.php-insertResource()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log		
			}
		} // end select
		
		public function insertResource($_resource)
		{
			try 
			{
				$insert_sql = 
				"insert into ecr_resource" . 
				"(url, Seq, ResourceName_En, ResourceName_Tc, Author_En, Author_Tc, " .
				"Briefing_En, Briefing_Tc, BriefingHtml_En, BriefingHtml_Tc, TypeMenu_sid, ". 
				"Type_sid, Image_url, IsShown, Remarks) ".
				"values(" .
				"?,?,?,?,?,?,".
				"?,?,?,?,?,".
				"?,?,?,?".
				")";
				
				$resource = new Resource();

				
				if (!is_null($_resource))
				{
					$resource = $_resource;
				}

				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'sissssssssiisis';
				$bindParamList = new ArrayList();
				$bindParamList->add($resource->getUrl());
				$bindParamList->add($resource->getSeq());
				$bindParamList->add($resource->getResourceNameEn());
				$bindParamList->add($resource->getResourceNameTc());
				$bindParamList->add($resource->getAuthorEn());
				$bindParamList->add($resource->getAuthorTc());
				$bindParamList->add($resource->getBriefingEn());
				$bindParamList->add($resource->getBriefingTc());
				$bindParamList->add($resource->getBriefingHtmlEn());
				$bindParamList->add($resource->getBriefingHtmlTc());				
				$bindParamList->add($resource->getTypeMenuSid());
				$bindParamList->add($resource->getTypeSid());
				$bindParamList->add($resource->getImageUrl());
				$bindParamList->add($resource->getIsShown());
				$bindParamList->add($resource->getRemarks());				
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);

				$resource->printValues();
				// echo 'sql statement: ' . $statement . '<br/>';						
				$result = mysql_query($statement);			

				
				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('ResourceDao.php-insertResource()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				$lastInsertSid = 0;
				
				if ($result > 0)
				{
					$lastInsertSid = mysql_insert_id($conn);
				}
				
				return $lastInsertSid;
			}
			catch (Exception $e)
			{
				// --- log
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";
					
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ResourceDao.php-insertResource()-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log	
			}
		} // end insert		
		
		public function updateResource($_resource, $_resourceFilter)
		{
			try 
			{
				$update_sql = 
				"update ecr_resource set url = ?, ".
				"Seq = ?, " .
				"ResourceName_En = ?, ResourceName_Tc = ?, ". 
				"Author_En = ?, Author_Tc = ?, " . 
				"Briefing_En = ?, Briefing_Tc = ?, " . 
				"BriefingHtml_En = ?, BriefingHtml_Tc = ?, " . 				
				"TypeMenu_sid = ?, Type_sid = ?, ". 
				"Image_url = ?, IsShown = ?, Remarks = ?, LastUpdate = now() ";
				
				$resourceFilter = new ResourceFilter();
				$resource = new Resource();

				
				if (!is_null($_resource))
				{
					$resource = $_resource;
				}
				// concatnate where statement
				if (!is_null($_resourceFilter))
				{
					$resourceFilter = $_resourceFilter;
					$update_sql .= $resourceFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'sissssssssiisis';
				$bindParamList = new ArrayList();
				$bindParamList->add($resource->getUrl());
				$bindParamList->add($resource->getSeq());
				$bindParamList->add($resource->getResourceNameEn());
				$bindParamList->add($resource->getResourceNameTc());
				$bindParamList->add($resource->getAuthorEn());
				$bindParamList->add($resource->getAuthorTc());
				$bindParamList->add($resource->getBriefingEn());
				$bindParamList->add($resource->getBriefingTc());
				$bindParamList->add($resource->getBriefingHtmlEn());
				$bindParamList->add($resource->getBriefingHtmlTc());				
				$bindParamList->add($resource->getTypeMenuSid());
				$bindParamList->add($resource->getTypeSid());
				$bindParamList->add($resource->getImageUrl());
				$bindParamList->add($resource->getIsShown());
				$bindParamList->add($resource->getRemarks());	
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				// echo 'Statement: ' . $statement. '<br/>';
				
				$result = mysql_query($statement);				

				
				// --- log
				$log = new Log();
				
				$logMessage = $statement . "\nResult: " . $result;

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('ResourceDao.php-updateResource()');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);					

				// --- end log						
				
				if ($result > 0)
				{
					$result = $resource->getSid();
				}
				
				return $result;
			}
			catch (Exception $e)
			{
				// --- log
				
				$log = new Log();
				
				$logMessage .= "Exception: " . $e . "\n";

				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_ECR_ERROR);
				$log->setLogModule('ResourceDao.php-SystemParam::$CMD_UPDATE-Exception');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
			}
		} // end update		
		
		public function deleteResource($_resourceFilter)
		{
			try 
			{
				$delete_sql = "delete from ecr_resource ";
				
				$resourceFilter = new ResourceFilter();
				
				// concatnate where statement
				if (!is_null($_resourceFilter))
				{
					$resourceFilter = $_resourceFilter;
					$delete_sql .= $resourceFilter->getWhereClause();
				}
				else
				{
					throw new Exception('ResourceDao: $_resourceFilter cannot be null at function deleteResource!', 4001);
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
				echo "Exception: " . $e;
			}			
		} // end delete
		
	} // end class


?>