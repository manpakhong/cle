<?php

	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/common/ArrayList.php';
	require_once $currentDir . 'php/common/system/Connection.php';
	require_once $currentDir . 'php/vo/system/DisplayLang.php';
	require_once $currentDir . 'php/vo/system/DisplayLangFilter.php';
	require_once $currentDir . 'php/vo/OrderBy.php';	
	require_once $currentDir . 'php/common/BindParam.php';	
		
	// --- Log
	require_once $currentDir.'php/vo/system/Log.php';
	require_once $currentDir.'php/log/LogHandler.php';	
	
	class DisplayLangDao
	{
		public function __construct()
		{
			
		}
		public function selectDisplayLang($_displayLangFilter)
		{
			try 
			{
				$select_sql = 
				"select d.*, o.Page, o.url, t.Type ".
				"from ecr_displaylang d ".
				"left join ecr_objpage o on d.ObjPage_sid = o.sid ".
				"left join ecr_objtype t on d.ObjType_sid = t.sid"
				;
				$displayLangFilter = new DisplayLangFilter();
				
				if (!is_null($_displayLangFilter))
				{
					$displayLangFilter = $_displayLangFilter;	
					$select_sql = $select_sql . $displayLangFilter->getWhereClause('d');					
					$select_sql .= $displayLangFilter->getOrderByClause('d');
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysqli_query($conn, $statement);
	
				$displayLangList = new ArrayList();
								
				while ($result = mysqli_fetch_array($sql))
				{
					$displayLang = new DisplayLang();
					
					$displayLang->setSid($result['sid']);
					$displayLang->setLabelId($result['Label_id']);
					$displayLang->setObjPageSid($result['ObjPage_sid']);
					$displayLang->setObjTypeSid($result['ObjType_sid']);
					$displayLang->setContentEn($result['Content_En']);
					$displayLang->setContentTc($result['Content_Tc']);
					$displayLang->setRemarks($result['Remarks']);
					$displayLang->setLastUpdate($result['LastUpdate']);
					$displayLang->setPage($result['Page']);
					$displayLang->setUrl($result['url']);
					$displayLang->setSid($result['Type']);
										
					// echo $displayLang->printValues();
					
					// --- log
					$log = new Log();
					
		
					$logMessage = $displayLang->printValues() . "\n";
					
					$log->setLogDateTime(date('Y-m-d H:i:s') );
					$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_VO);
					$log->setLogModule('DisplayLangDao.php-selectDisplayLang()-loop');
					$log->setLogMessage($logMessage);
					
					$logHandler = new LogHandler();
					$logHandler->checkNwriteLog($log);
					
					// --- end log						
					
					$displayLangList->add($displayLang);
					
				}
				
				// --- log
				$log = new Log();
				
	
				$logMessage = $statement . "\n" . "total records: " . $displayLangList->size();
				
				$log->setLogDateTime(date('Y-m-d H:i:s') );
				$log->setLogType(SystemParam::$LOG_TYPE_MESSAGE_SQL);
				$log->setLogModule('DisplayLangDao.php-selectDisplayLang()-Sql');
				$log->setLogMessage($logMessage);
				
				$logHandler = new LogHandler();
				$logHandler->checkNwriteLog($log);
				
				// --- end log					
				
				return $displayLangList;
					
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "\n" );
			}
		} // end select
		
		public function insertDisplayLang($_displayLang)
		{
			try 
			{
				$insert_sql = 
				"insert into ecr_displaylang(" .
				"Label_id, ObjPage_sid, ObjType_sid, Content_En, Content_Tc, ". 
				"Remarks) ".
				"values(" . 
				"?,?,?,?,?,". 
				"?".
				")";
				
				$displayLang = new DisplayLang();

				
				if (!is_null($_displayLang))
				{
					$displayLang = $_displayLang;
				}
				
				// echo 'sql statement: ' . $insert_sql . '<br/>';
						

				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'siisss';
				$bindParamList = new ArrayList();
				$bindParamList->add($displayLang->getLabelId());
				$bindParamList->add($displayLang->getObjPageSid());
				$bindParamList->add($displayLang->getObjTypeSid());
				$bindParamList->add($displayLang->getContentEn());
				$bindParamList->add($displayLang->getContentTc());
				$bindParamList->add($displayLang->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $insert_sql);
				
				$result = mysql_query($statement);				
								
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		} // end insert		
		
		public function updateDisplayLang($_displayLang, $_displayLangFilter)
		{
			try 
			{
				$update_sql = 
				"update ecr_displaylang set " . 
				"Label_id = ?, ObjPage_sid = ?,  ObjType_sid = ?, Content_En = ?, Content_Tc = ?, ".
				"Remarks = ? " .
				"LastUpdate = now() ";
				
				$displayLangFilter = new DisplayLangFilter();
				$displayLang = new DisplayLang();

				
				if (!is_null($_displayLang))
				{
					$displayLang = $_displayLang;
				}
				// concatnate where statement
				if (!is_null($_displayLangFilter))
				{
					$displayLangFilter = $_displayLangFilter;
					$update_sql .= $displayLangFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";
				
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = 'siisss';
				$bindParamList = new ArrayList();
				$bindParamList->add($displayLang->getLabelId());
				$bindParamList->add($displayLang->getObjPageSid());
				$bindParamList->add($displayLang->getObjTypeSid());
				$bindParamList->add($displayLang->getContentEn());
				$bindParamList->add($displayLang->getContentTc());
				$bindParamList->add($displayLang->getRemarks());
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $update_sql);
				
				$result = mysql_query($statement);					
								
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		} // end update		
		
		public function deleteDisplayLang($_displayLangFilter)
		{
			try 
			{
				$delete_sql = "delete from ecr_displaylang ";
				
				$displayLangFilter = new DisplayLangFilter();
				
				// concatnate where statement
				if (!is_null($_displayLangFilter))
				{
					$displayLangFilter = $_displayLangFilter;
					$delete_sql .= $displayLangFilter->getWhereClause();
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
			} // end try ... catch
		} // end delete	
		
	} // end class
	
?>