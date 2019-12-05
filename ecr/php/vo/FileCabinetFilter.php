<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/FileCabinet.php';
	
	class FileCabinetFilter extends FileCabinet
	{
		private $orderByList;
		private $isWildCard;		
		
		public function setIsWildCard($_x)
		{
			$this->isWildCard = $this->chkNconvertTrueFalse2Bool($_x);
		}
		public function getIsWildCard()
		{
			return $this->isWildCard;
		}			
		
		public function __construct () {
			$this->orderByList = new ArrayList();
			$this->isWildCard = false;	
		}
		
		public function setFilterByBaseObj($_fileCabinet)
		{
			$fileCabinet = new FileCabinet();
			$fileCabinet = $_fileCabinet;
			
			// File Cabinet
			$this->setSid($this->chkBlankNSetNull($fileCabinet->getSid()));
			$this->setSeq($this->chkBlankNSetNull($fileCabinet->getSeq()));;
			$this->setActivitySid($this->chkBlankNSetNull($fileCabinet->getActivitySid()));
			$this->setFileNameEn($this->chkBlankNSetNull($fileCabinet->getFileNameEn()));
			$this->setFileNameTc($this->chkBlankNSetNull($fileCabinet->getFileNameTc()));
			$this->setDescriptionEn($this->chkBlankNSetNull($fileCabinet->getDescriptionEn()));
			$this->setDescriptionTc($this->chkBlankNSetNull($fileCabinet->getDescriptionTc()));
			$this->setFileTypeSid($this->chkBlankNSetNull($fileCabinet->getFileTypeSid()));
			$this->setFilePath($this->chkBlankNSetNull($fileCabinet->getFilePath()));
			$this->setIsShown($this->chkBlankNSetNull($fileCabinet->getIsShown()));
			$this->setRemarks($this->chkBlankNSetNull($fileCabinet->getRemarks()));
			$this->setFileDate($this->chkBlankNSetNull($fileCabinet->getFileDate()));
			$this->setLastUpdate($this->chkBlankNSetNull($fileCabinet->getLastUpdate()));
						
			// Activity
			$this->setSidA($this->chkBlankNSetNull($fileCabinet->getSidA()));
			$this->setSeqA($this->chkBlankNSetNull($fileCabinet->getSeqA()));
			$this->setActivityNameEnA($this->chkBlankNSetNull($fileCabinet->getActivityNameEnA()));
			$this->setActivityNameTcA($this->chkBlankNSetNull($fileCabinet->getActivityNameTcA()));
			$this->setContentEnA($this->chkBlankNSetNull($fileCabinet->getContentEnA()));
			$this->setContentTcA($this->chkBlankNSetNull($fileCabinet->getContentTcA()));
			$this->setSpeakerEnA($this->chkBlankNSetNull($fileCabinet->getSpeakerEnA()));
			$this->setSpeakerTcA($this->chkBlankNSetNull($fileCabinet->getSpeakerTcA()));
			$this->setIsShownA($this->chkBlankNSetNull($fileCabinet->getIsShownA()));
			$this->setActivityDateA($this->chkBlankNSetNull($fileCabinet->getActivityDateA()));
			$this->setRemarksA($this->chkBlankNSetNull($fileCabinet->getRemarksA()));
			$this->setLastUpdateA($this->chkBlankNSetNull($fileCabinet->getLastUpdateA()));
			
			// FileType
			$this->setSidT($this->chkBlankNSetNull($fileCabinet->getSidT()));
			$this->setFileTypeEnT($this->chkBlankNSetNull($fileCabinet->getFileTypeEnT()));
			$this->setFileTypeTcT($this->chkBlankNSetNull($fileCabinet->getFileTypeTcT()));
			$this->setFileTypeIconT($this->chkBlankNSetNull($fileCabinet->getFileTypeIconT()));
			$this->setRemarksT($this->chkBlankNSetNull($fileCabinet->getRemarksT()));
			$this->setLastUpdateT($this->chkBlankNSetNull($fileCabinet->getLastUpdateT()));
			
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
