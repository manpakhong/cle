<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once $currentDir . 'php/vo/Type.php';
	
	class TypeFilter extends Type
	{
			private $orderByList;
		
		public function __construct () {
			$this->orderByList = new ArrayList();
		}
		
		public function getWhereClause()
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
			    	$returnWhereClause = $returnWhereClause . Resource::getDbFieldName($key) . "='" . $value . "'";
			    }
			}
			
			return $returnWhereClause;
			
		}

		public function setOrderByList($value)
		{
			$this->orderByList->add($value);
		}		
		
		public function getOrderByClause()
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
					$orderByClause .= $orderBy->getField(). " ";
					$orderByClause .= $orderBy->getIsAsc() ? "asc" : "dec";
				}
				if ($count > 1)
				{
					$orderByClause .= ", ";
					$orderByClause .= $orderBy->getField(). " ";
					$orderByClause .= $orderBy->getIsAsc() ? "asc" : "dec";
				}
			}
			
			return $orderByClause;
			
		}		
	}

?>