<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/Activity.php';
	
	class ActivityFilter extends Activity
	{
		private $orderByList;
		private $isWildCard;
		
		public function __construct () {
			$this->orderByList = new ArrayList();
			$this->isWildCard = false;
		}
		
		public function setIsWildCard($_x)
		{
			$this->isWildCard = $this->chkNconvertTrueFalse2Bool($_x);
		}
		public function getIsWildCard()
		{
			return $this->isWildCard;
		}
		
		public function setFilterByBaseObj($_activity)
		{
			$activity = new Activity();
			$activity = $_activity;
			
			$this->setSid($this->chkBlankNSetNull($activity->getSid()));
			$this->setSeq($this->chkBlankNSetNull($activity->getSeq()));
			$this->setActivityNameEn($this->chkBlankNSetNull($activity->getActivityNameEn()));
			$this->setActivityNameTc($this->chkBlankNSetNull($activity->getActivityNameTc()));
			$this->setContentEn($this->chkBlankNSetNull($activity->getContentEn()));
			$this->setContentTc($this->chkBlankNSetNull($activity->getContentTc()));
			$this->setContentHtmlEn($this->chkBlankNSetNull($activity->getContentHtmlEn()));
			$this->setContentHtmlTc($this->chkBlankNSetNull($activity->getContentHtmlTc()));			
			$this->setSpeakerEn($this->chkBlankNSetNull($activity->getSpeakerEn()));
			$this->setSpeakerTc($this->chkBlankNSetNull($activity->getSpeakerTc()));
			$this->setIsShown($this->chkBlankNSetNull($activity->getIsShown()));
			$this->setActivityDate($this->chkBlankNSetNull($activity->getActivityDate()));
			$this->setActivityDateFrom($this->chkBlankNSetNull($activity->getActivityDateFrom()));
			$this->setActivityDateTo($this->chkBlankNSetNull($activity->getActivityDateTo()));
			$this->setRemarks($this->chkBlankNSetNull($activity->getRemarks()));
			$this->setLastUpdate($this->chkBlankNSetNull($activity->getLastUpdate()));
			
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
			    if (!is_null($value) && $key != 'activityDateFrom' && $key != 'activityDateTo')
			    {

		    		$count += 1;

			    	
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
			    	else if ($key == 'activityDateFrom' || $key == 'activityDateTo')
			    	{
			    		// do nothing
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
					    		if ($this->isWildCard)
					    		{
					    			$returnWhereClause .= $this->getDbFieldName($key) . " like '" . $value . "' ";
					    		}
					    		else 
					    		{
					    			$returnWhereClause .= $this->getDbFieldName($key) . "='" . $value . "'" ;
					    		}
					    	}
					    	else
					    	{
					    		if ($this->isWildCard)
					    		{
					    			$returnWhereClause .= $_alias. '.'. $this->getDbFieldName($key) . " like '" . $value . "' ";	
					    		}
					    		else 
					    		{
					    			$returnWhereClause .= $_alias. '.'. $this->getDbFieldName($key) . "='" . $value . "' ";		
					    		}	    		
					    	}
						} // end if (strtolower($value) == 'is not null' || strtolower($value) == 'is null')
			    	} // end if ($key == 'lastUpdate') ... else
			    } // end if (!is_null($value))
			} // end foreach

			
			
			if (!is_null($this->getActivityDateFrom()) && !is_null($this->getActivityDateTo()))
			{
		    	if ($count == 0)
		    	{
					// echo 'Count:' . $count . "\n";
		    		$returnWhereClause .=  " where ";
					// echo 'returnWhereClause: ' . $returnWhereClause . "\n";
		    	}
				
		    	if ($count > 0)
		    	{
		    		$returnWhereClause .= " and ";
		    	}					
				
				if ($_alias == '')
				{
					$returnWhereClause .= "date_format(" . $this->getDbFieldName('activityDate') . ", '%Y-%m-%d %H:%i:%S') " . 
					" between '" . $this->getActivityDateFrom() . 
					"' and '" . $this->getActivityDateTo() . "' ";
				}
				else
				{
					$returnWhereClause .= "date_format(" . $_alias. '.'.  $this->getDbFieldName('activityDate') . ", '%Y-%m-%d %H:%i:%S') " . 
					" between '" . $this->getActivityDateFrom() . 
					"' and '" . $this->getActivityDateTo() . "' ";
				}
			}
			
			
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