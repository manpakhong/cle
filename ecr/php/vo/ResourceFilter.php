<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/Resource.php';
	
	class ResourceFilter extends Resource
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
		
		public function setFilterByBaseObj($_resource)
		{
			$resource = new Resource();
			$resource = $_resource;
			
			// resource
			$this->setSid($this->chkBlankNSetNull($resource->getSid()));
			$this->setSeq($this->chkBlankNSetNull($resource->getSeq()));
			$this->setUrl($this->chkBlankNSetNull($resource->getUrl()));
			$this->setResourceNameEn($this->chkBlankNSetNull($resource->getResourceNameEn()));
			$this->setResourceNameTc($this->chkBlankNSetNull($resource->getResourceNameTc()));
			$this->setAuthorEn($this->chkBlankNSetNull($resource->getAuthorEn()));
			$this->setAuthorTc($this->chkBlankNSetNull($resource->getAuthorTc()));
			$this->setBriefingEn($this->chkBlankNSetNull($resource->getBriefingEn()));
			$this->setBriefingTc($this->chkBlankNSetNull($resource->getBriefingTc()));
			$this->setBriefingHtmlEn($this->chkBlankNSetNull($resource->getBriefingHtmlEn()));
			$this->setBriefingHtmlTc($this->chkBlankNSetNull($resource->getBriefingHtmlTc()));			
			$this->setTypeMenuSid($this->chkBlankNSetNull($resource->getTypeMenuSid()));
			$this->setTypeSid($this->chkBlankNSetNull($resource->getTypeSid()));
			$this->setImageUrl($this->chkBlankNSetNull($resource->getImageUrl()));
			$this->setIsShown($this->chkBlankNSetNull($resource->getIsShown()));
			$this->setRemarks($this->chkBlankNSetNull($resource->getRemarks()));
			$this->setLastUpdate($this->chkBlankNSetNull($resource->getLastUpdate()));
			
			// menubar
			$this->setSidM($this->chkBlankNSetNull($resource->getSidM()));
			$this->setSeqM($this->chkBlankNSetNull($resource->getSeqM()));
			$this->setLvM($this->chkBlankNSetNull($resource->getLvM()));
			$this->setLvTextEnM($this->chkBlankNSetNull($resource->getLvTextEnM()));
			$this->setLvTextTcM($this->chkBlankNSetNull($resource->getLvTextTcM()));
			$this->setUpLvSidM($this->chkBlankNSetNull($resource->getUpLvSidM()));
			$this->setIsShownM($this->chkBlankNSetNull($resource->getIsShownM()));
			$this->setIsNetvigatedM($this->chkBlankNSetNull($resource->getIsNetvigatedM()));
			$this->setUrlM($this->chkBlankNSetNull($resource->getUrlM()));
			$this->setRemarksM($this->chkBlankNSetNull($resource->getRemarks()));
			$this->setLastUpdateM($this->chkBlankNSetNull($resource->getLastUpdateM()));
			
			// type
			$this->setSidT($this->chkBlankNSetNull($resource->getSidT()));
			$this->setTypeEnT($this->chkBlankNSetNull($resource->getTypeEnT()));
			$this->setTypeTcT($this->chkBlankNSetNull($resource->getTypeTcT()));
			$this->setRemarksT($this->chkBlankNSetNull($resource->getRemarksT()));
			$this->setLastUpdateT($this->chkBlankNSetNull($resource->getLastUpdateT()));
			// type
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
			    } // end if (!is_null())
			} // end foreach
			return $returnWhereClause;
			
		}

		public function setOrderByList($value)
		{
			$this->orderByList->add($value);
		}		
		
		public function getOrderByClause($_alias='')
		{
			
			$count = 0;
			
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