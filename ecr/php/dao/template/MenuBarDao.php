<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/template/MenuBar.php';
	require_once $currentDir. 'php/vo/template/MenuBarFilter.php';	
	require_once $currentDir. 'php/common/system/Connection.php';		
	require_once $currentDir. 'php/common/BindParam.php';			
	
	class MenuBarDao
	{

		// ===============================================================================
		// === old connection method
		// ===============================================================================		
		
		public function selectMenuBar($_menuBarFilter)
		{
			try 
			{
				$select_sql = "select * from ecr_menubar ";
				$menuBarFilter = new MenuBarFilter();
				
				if (!is_null($_menuBarFilter))
				{
					$menuBarFilter = $_menuBarFilter;	
					$select_sql = $select_sql . $menuBarFilter->getWhereClause();
					$select_sql .= $menuBarFilter->getOrderByClause();
				}
				
				// echo 'select statement: ' . $select_sql . '<br/>';
				
				
				$conn = Connection::getMysqliConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindParamList = new ArrayList();
				
				$statement = $bindParam->preparedStatement($bindTypes, $bindParamList, $select_sql);
				
				$sql = mysqli_query($conn, $statement);
	
				$menuBarList = new ArrayList();
				
				while ($result = mysqli_fetch_array($sql))
				{
					$menuBar = new MenuBar();
					
					$menuBar->setSid($result['sid']);
					$menuBar->setSeq($result['Seq']);
					$menuBar->setLv($result['LV']);
					$menuBar->setLvTextEn($result['LV_Text_En']);
					$menuBar->setLvTextTc($result['LV_Text_Tc']);
					$menuBar->setUpLvSid($result['UpLV_sid']);
					$menuBar->setIsShown($result['IsShown']);
					$menuBar->setIsNetvigated($result['IsNetvigated']);
					$menuBar->setUrl($result['url']);
					$menuBar->setRemarks($result['Remarks']);
					$menuBar->setLastUpdate($result['LastUpdate']);										
					

					// echo $menuBar->printValues();
					
					$menuBarList->add($menuBar);
					
				}
								
				return $menuBarList;
					
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "<br/>" );
			}
		} // end select
		
		public function insertMenuBar($_menuBar)
		{
			try 
			{
				$insert_sql = 
				"insert into ecr_menubar". 
				"(Seq, LV, LV_Text_En, LV_Text_Tc, UpLV_sid, ".
				"IsShown, IsNetvigated, url, Remarks, LastUpdate) ".
				"values(?,?,?,?,?,".
						"?,?,?,?,?)";
				
				$menuBar = new MenuBar();

				if (!is_null($_menuBar))
				{
					$menuBar = $_menuBar;
				}

				// echo $menuBar->printValues();
				
				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'iissiiisss';
				$bindParamList = new ArrayList();
				$bindParamList->add($menuBar->getSeq());
				$bindParamList->add($menuBar->getLv());
				$bindParamList->add($menuBar->getLvTextEn());
				$bindParamList->add($menuBar->getLvTextTc());
				$bindParamList->add($menuBar->getUpLvSid());
				$bindParamList->add($menuBar->getIsShown());
				$bindParamList->add($menuBar->getIsNetvigated());
				$bindParamList->add($menuBar->getUrl());
				$bindParamList->add($menuBar->getRemarks());
				$bindParamList->add($menuBar->getLastUpdate());
								
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
				echo "Exception: " . $e . "<br/>";
			}
		} // end insert		
		
		public function updateMenuBar($_menuBar, $_menuBarFilter)
		{
			try 
			{
				$update_sql = 
				"update ecr_menubar " .
				"set Seq = ?, LV = ?, LV_Text_En = ?, LV_Text_Tc = ?, UpLV_sid = ?, " . 
				"IsShown = ?, IsNetvigated = ?, url = ?, Remarks = ?, LastUpdate = now() ";
				
				$menuBarFilter = new MenuBarFilter();
				$menuBar = new MenuBar();

				
				if (!is_null($_menuBar))
				{
					$menuBar = $_menuBar;
				}
				// concatnate where statement
				if (!is_null($_menuBarFilter))
				{
					$menuBarFilter = $_menuBarFilter;
					$update_sql .= $menuBarFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $update_sql . "<br/>";
				


				$conn = Connection::getConnectionInstance();
				$bindParam = new BindParam();
				
				$bindTypes = '';
				$bindTypes = 'iissiiiss';
				$bindParamList = new ArrayList();
				$bindParamList->add($menuBar->getSeq());
				$bindParamList->add($menuBar->getLv());
				$bindParamList->add($menuBar->getLvTextEn());
				$bindParamList->add($menuBar->getLvTextTc());
				$bindParamList->add($menuBar->getUpLvSid());
				$bindParamList->add($menuBar->getIsShown());
				$bindParamList->add($menuBar->getIsNetvigated());
				$bindParamList->add($menuBar->getUrl());
				$bindParamList->add($menuBar->getRemarks());

				
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
				echo "Exception: " . $e . '<br/>';
			}
		} // end update		
		
		public function deleteMenuBar($_menuBarFilter)
		{
			try 
			{
				$delete_sql = "delete from ecr_menubar ";
				
				$menuBarFilter = new MenuBarFilter();
				
				// concatnate where statement
				if (!is_null($_menuBarFilter))
				{
					$menuBarFilter = $_menuBarFilter;
					$delete_sql .= $menuBarFilter->getWhereClause();
				}

				
				// echo "sql statement: " . $delete_sql . "<br/>";
				
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
				echo "Exception: " . $e . "<br/>";
			}			
		} // end delete
		
		public function selectMaxMenuBarLv()
		{
			try 
			{
				$select_sql = "select max(LV) as MaxLv from ecr_menubar ";
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
		} // end selectMax	
		
	} // end class
?>