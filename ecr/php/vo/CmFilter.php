<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/Cm.php';
	
	class CmFilter extends Cm
	{
		private $orderByList;
		private $isWildCard;
		
		public function __construct () 
		{
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
		public function setFilterByBaseObj($_cm)
		{
			$cm = new Cm();
			$cm = $_cm;
			
			// Cm
			$this->setSid($this->chkBlankNSetNull($cm->getSid()));
			$this->setObjPageSid($this->chkBlankNSetNull($cm->getObjPageSid()));
			$this->setContentEn($this->chkBlankNSetNull($cm->getContentEn()));
			$this->setContentTc($this->chkBlankNSetNull($cm->getContentTc()));
			$this->setContentHtmlEn($this->chkBlankNSetNull($cm->getContentHtmlEn()));
			$this->setContentHtmlTc($this->chkBlankNSetNull($cm->getContentHtmlTc()));
			$this->setRemarks($this->chkBlankNSetNull($cm->getRemarks()));
			$this->setLastUpdate($this->chkBlankNSetNull($cm->getLastUpdate()));
			
			// ObjPage
			$this->setSidO($this->chkBlankNSetNull($cm->getSidO()));
			$this->setPageO($this->chkBlankNSetNull($cm->getPageO()));
			$this->setUrlO($this->chkBlankNSetNull($cm->getUrlO()));
			$this->setRemarksO($this->chkBlankNSetNull($cm->getRemarksO()));
			$this->setLastUpdateO($this->chkBlankNSetNull($cm->getLastUpdateO()));
			
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
					    		if ($this->isWildCard)
					    		{
					    			$returnWhereClause .= $this->getDbFieldName($key) . " like '" . $value . "'";
					    		}
					    		else 
					    		{
					    			$returnWhereClause .= $this->getDbFieldName($key) . "='" . $value . "'";
					    		}
					    	}
					    	else
					    	{
					    		if ($this->isWildCard)
					    		{
					    			$returnWhereClause .= $_alias. '.'. $this->getDbFieldName($key) . " like '" . $value . "'";	
					    		}
					    		else 
					    		{
					    			$returnWhereClause .= $_alias. '.'. $this->getDbFieldName($key) . "='" . $value . "'";		
					    		}	    		
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
