<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	include_once $currentDir  . 'php/common/Connection.php';
	include_once $currentDir  . 'php/common/ArrayList.php';
	include_once $currentDir  . 'php/vo/WebRef.php';

	
	class WebRefDao
	{

		
		public static function selectWebRef($value)
		{
			try 
			{
				$select_sql = "select * from cle_webref ";
				$webRefFilter = new WebRefFilter();
				
				if (!is_null($value))
				{
					$webRefFilter = $value;	
					$select_sql = $select_sql . $webRefFilter->getWhereClause();
				}
				
				// echo "sql statement: " . $select_sql;
				// echo "sid: " . $webRef->getSid();
				
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($select_sql);
				//$statement->bind_param("i", $webRef->getSid());
				$statement->execute();

				$webRefList = new ArrayList();
				
				/* Bind results */
				$statement -> bind_result($sid, $website, $type, $learninghighlight, $lastupdate, $remarks);
				
				while ($statement->fetch())
				{
					$webRef = new WebRef();
					
					$webRef->setSid($sid);
					$webRef->setType($type);
					$webRef->setWebSite($website);
					$webRef->setLearningHighlight($learninghighlight);
					$webRef->setLastUpdate($lastupdate);
					$webRef->setRemarks($remarks);
					$webRefList->add($webRef);
				}
				
				return $webRefList;
					
			}
			catch (Exception $e)
			{
				echo ("Exception: " . $e . "\n" );
			}
		}
		
		public static function updateWebRef($value, $valueFilter)
		{
			try 
			{
				$update_sql = "update cle_webref set website = ?, type = ?, learninghighlight = ?, lastupdate = now(), remarks = ? ";
				
				$webRefFilter = new WebRefFilter();
				$webRef = new WebRef();
				
				if (!is_null($value))
				{
					$webRef = $value;
				}
				// concatnate where statement
				if (!is_null($valueFilter))
				{
					$webRefFilter = $valueFilter;
					$update_sql .= $webRefFilter->getWhereClause();
				}
				
				echo "sql statement: " . $update_sql . "<br/>";
				echo "Sid: " . $webRef->getSid() . "<br/>";
				echo "WebSite: " . $webRef->getWebSite() . "<br/>";
				echo "Type: " . $webRef->getType() . "<br/>";
				echo "Learning HighLight: " . $webRef->getLearningHighlight() . "<br/>";
				echo "Last Update: " . $webRef->getLastUpdate() . "<br/>";
				echo "Remarks: " . $webRef->getRemarks() . "<br/>";				
				
				
				$conn = Connection::getConnectionInstance();
				$statement = $conn->prepare($update_sql);
				$statement->bind_param("ssss", $webRef->getWebSite(), $webRef->getType(), $webRef->getLearningHighLight(), $webRef->getRemarks());
				$result = $statement->execute();				
				
				
				if ($result > 0)
				{
					echo $result . " record(s) update Completed!";
				}				
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e;
			}
		}
		

		public static function insertWebRef($value)
		{
			try 
			{
				$insert_sql = "insert into cle_webref (website, type, learninghighlight, remarks) values(?, ?, ?, ?)";
				
				$webRef = new WebRef();
				
				if (!is_null($value))
				{
					$webRef = $value;	
				}				
				
		
				$conn = Connection::getConnectionInstance();
				
				echo "WebSite: " . $webRef->getWebSite(). "<br/>" .
					 "Type: " . $webRef->getType(). "<br/>" .
					 "LearningHighLight: " . $webRef->getLearningHighlight() . "<br/>" .
					 "Remarks: " . $webRef->getRemarks() . "<br/>" .
					 "insert sql: " . $insert_sql . "<br/>";				
				
				$statement = $conn->prepare($insert_sql);
				$statement->bind_param("ssss", 
										$webRef->getWebSite(), 
										$webRef->getType(), 
										$webRef->getLearningHighLight(), 
										$webRef->getRemarks());

				$result = $statement->execute();
				
				if ($result > 0)
				{
					echo $result . " record(s) inserted Completed!";
				}
				
				return $result;
			}
			catch (Exception $e)
			{
				echo ("Exception: ". $e . "\n" );
			}
		}
		
	}
	
?>