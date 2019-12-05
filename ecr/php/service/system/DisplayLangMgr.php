<?php
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	include_once $currentDir . 'php/vo/system/DisplayLang.php';
	include_once $currentDir . 'php/vo/system/DisplayLangFilter.php';
	include_once $currentDir . 'php/dao/system/DisplayLangDao.php';
	
	include_once $currentDir . 'php/vo/system/ObjPage.php';
	include_once $currentDir . 'php/vo/system/ObjPageFilter.php';
	include_once $currentDir . 'php/dao/system/ObjPageDao.php';
	
	include_once $currentDir . 'php/vo/OrderBy.php';
	
	include_once $currentDir . 'php/common/ArrayList.php';
	
	class DisplayLangMgr
	{
		private $displayLangDao;
		private $objPageDao;
		
		public function __construct()
		{
			$this->displayLangDao = new DisplayLangDao();
			$this->objPageDao = new ObjPageDao();			
		}
		
		public function selectDisplayLangByObjPagePage($_objPagePage)
		{

			if (!is_null($_objPagePage) && (strlen($_objPagePage) > 0))
			{

				$objPageFilter = new ObjPageFilter();
				$objPageFilter->setPage($_objPagePage);
				$orderBy = new OrderBy();
				$orderBy->setField('sid');
				$objPageFilter->setOrderByList($orderBy);
				

				$objPageList = new ArrayList();
				$objPageList = $this->objPageDao->selectObjPage($objPageFilter);
				
				$returnDisplayLangList = new ArrayList();
				
				if ($objPageList->hasNext())
				{
					$objPage = new ObjPage();
					$objPage = $objPageList->next();	
										
					$displayLangFilter = new DisplayLangFilter();
					$displayLangFilter->setObjPageSid($objPage->getSid());
					
					$displayLangList = new ArrayList();
					$displayLangList = $this->selectDisplayLang($displayLangFilter);
					
					$returnDisplayLangList = $displayLangList;
					
				}
				// echo 'size: ' . $returnDisplayLangList->size();
				
				return $returnDisplayLangList;
				
			}
		}
		
		public function selectDisplayLang($_displayLangFilter)
		{
			try
			{								
				$displayLangList = new ArrayList();
				if (!is_null($_displayLangFilter))
				{
					$displayLangList = $this->displayLangDao->selectDisplayLang($_displayLangFilter);
				}
				
				return $displayLangList;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		}
		
		public function insertDisplayLang($_displayLang)
		{
			try 
			{
				$result = 0;
				if (!is_null($_displayLang))
				{
					$result = $this->displayLangDao->insertDisplayLang($_displayLang);
				}
				return $result;
				
			}
			catch (Exception $e)
			{
				echo "Exception : " . $e . "\n";
			}
		}		
		
		public function updateDisplayLang($_displayLang, $_displayLangFilter)
		{
			try 
			{	
				$result = 0;
				if (!is_null($_displayLang) && !is_null($_displayLangFilter))
				{
					$result = $this->displayLangDao->updateDisplayLang($_displayLang, $_displayLangFilter);
				}
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		}		
		
		public function deleteDisplayLang($_displayLangFilter)
		{
			try 
			{
				$result = 0;
				
				if (!is_null($_displayLangFilter))
				{
					$result = $this->displayLangDao->deleteDisplayLang($_displayLangFilter);
				}
				
				return $result;
			}
			catch (Exception $e)
			{
				echo "Exception: " . $e . "\n";
			}
		}		
	} // end class

?>