<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/system/ObjPage.php';
	
	class ObjPageFilter extends ObjPage
	{
		private $orderByList;
		
		public function __construct () 
		{
			$this->orderByList = new ArrayList();
		}
		
		public function setFilterByBaseObj($_objPage)
		{
			$objPage = new ObjPage();
			$objPage = $_objPage;
						
			// ObjPage
			$this->setSid($this->chkBlankNSetNull($objPage->getSid()));
			$this->setPage($this->chkBlankNSetNull($objPage->getPage()));
			$this->setUrl($this->chkBlankNSetNull($objPage->getUrl()));
			$this->setRemarks($this->chkBlankNSetNull($objPage->getRemarks()));
			$this->setLastUpdate($this->chkBlankNSetNull($objPage->getLastUpdate()));
			
		}		
		
		public function getWhereClause($_alias = '')
		{
			$returnWhereClause = "";
			
			$arr = array();
			$arr = parent::outputVarsList();
			
			$count = 0;
			foreach ($arr as $key => $value) 
			{
			    // echo "Key: $key; Value: $value<br />\n";
			    if (!is_null($value))
			    {
			    	$count = $count + 1;

			    	if ($count == 1)
			    	{
						// echo 'Count:' . $count . "\n";

			    		$returnWhereClause = $returnWhereClause .  " where ";
						// echo 'returnWhereClause: ' . $returnWhereClause . "\n";
			    	}
			    	
			    	if ($count > 1)
			    	{
			    		$returnWhereClause .= " and ";
			    	}			    	
			    	
			    	if ($key == 'lastUpdate')
			    	{
			    		$returnWhereClause .= "date_format(" . $this->getDbFieldName($key) . ", '%Y-%m-%d %H:%i:%S') ". "='" . $value . "'";
			    	}
			    	else 
			    	{
						if (strtolower($value) == 'is not null' || strtolower($value) == 'is null')
						{
					    	if ($_alias == '')
					    	{
					    		$returnWhereClause .= $this->getDbFieldName($key) . " " . $value . " ";
					    	}
					    	else
					    	{
					    		$returnWhereClause .=  $_alias. '.'. $this->getDbFieldName($key) . " " . $value . " ";			    		
					    	}						
						}
						else
						{
					    	if ($_alias == '')
					    	{
					    		$returnWhereClause .= $this->getDbFieldName($key) . "='" . $value . "'";
					    	}
					    	else
					    	{
					    		$returnWhereClause .= $_alias. '.'. $this->getDbFieldName($key) . "='" . $value . "'";			    		
					    	}
						} // end if (strtolower($value) == 'is not null' || strtolower($value) == 'is null')
			    	} // end if ($key == 'lastUpdate') ... else
			    } // end if (!is_null($value))
			} // end foreach

			return $returnWhereClause;
		}

		public function setOrderByList($value)
		{
			$this->orderByList->add($value);
		}		
		
		public function getOrderByClause($_alias = '')
		{
			
			$count = 0;
			$orderByClause = '';
			while ($this->orderByList->hasNext())
			{
				$count++;
				$orderBy = new OrderBy();
				$orderBy = $this->orderByList->next();
				
				if ($count == 1)
				{
					$orderByClause .= " order by ";
					
					if ($_alias == '')
					{
						$orderByClause .= $orderBy->getField(). " ";
						$orderByClause .= $orderBy->getIsAsc() ? "asc" : "desc";
					}
					else 
					{
						$orderByClause .= $_alias . '.' . $orderBy->getField(). " ";
						$orderByClause .= $orderBy->getIsAsc() ? "asc" : "desc";						
					}
				}
				if ($count > 1)
				{
					$orderByClause .= ", ";
					
					if ($_alias == '')
					{
						$orderByClause .= $orderBy->getField(). " ";
						$orderByClause .= $orderBy->getIsAsc() ? "asc" : "desc";
					}
					else
					{
						$orderByClause .= $_alias . '.' . $orderBy->getField(). " ";
						$orderByClause .= $orderBy->getIsAsc() ? "asc" : "desc";						
					}
				}
			}
			
			return $orderByClause;
			
		}		
	} // end class
?>	
