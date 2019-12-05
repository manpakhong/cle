<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/vo/WebRef.php';

	class WebRefFilter extends WebRef
	{
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
			    	
			    	$returnWhereClause = $returnWhereClause . $key . "='" . $value . "'";
			    }
			}
			
			return $returnWhereClause;
			
		}

	
	}
?>