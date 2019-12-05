<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir. 'php/vo/EcrUser.php';
	
	class SystemMsgFilter extends SystemMsg
	{
		private $orderByList;
		
		public function __construct () {
			$this->orderByList = new ArrayList();
		}
		
		public function getWhereClause($_alias = '')
		{
			$returnWhereClause = "";
			
			$arr = array();
			$arr = parent::outputVarsList();
			
			$count = 0;
			
			foreach ($arr as $key => $value) {
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
			    	
			    	if ($_alias == '')
			    	{
			    		$returnWhereClause = $returnWhereClause . $this->getDbFieldName($key) . "='" . $value . "'";
			    	}
			    	else
			    	{
			    		$returnWhereClause = $returnWhereClause . $_alias. '.'. $this->getDbFieldName($key) . "='" . $value . "'";			    		
			    	}
			    }
			}
			
			return $returnWhereClause;
			
		}

		public function setOrderByList($_orderBy)
		{
			$this->orderByList->add($_orderBy);
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
