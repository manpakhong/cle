<?php
	require_once 'php/service/WebRefMgr.php';
	require_once 'php/vo/WebRef.php';
	require_once 'php/vo/WebRefFilter.php';
	require_once 'php/common/ArrayList.php';
	require_once 'php/parameter/Param.php';
	
	if ($_POST["param"] == Param::$INSERT)
	{
		// echo "Method: " . $_POST["param"] . "<br/>";		
		WebRefCmd::insertWebRefCmd();
	}	
	
	if ($_POST["param"] == Param::$UPDATE)
	{
		// echo "Method: " . $_POST["param"] . "<br/>";		
		WebRefCmd::updateWebRefCmd();
	}	

	class WebRefCmd
	{
		
		public static function insertWebRefCmd()
		{
			$webRef = new WebRef();
			$webRef->setWebSite($_POST["website"]);
			$webRef->setType($_POST["type"]);
			$webRef->setLearningHighlight($_POST["learningHighLight"]);
			$webRef->setRemarks($_POST["remarks"]);
						
			return WebRefMgr::insertWebRefMgr($webRef);
		}
		
		public static function updateWebRefCmd()
		{
			$webRef = new WebRef();
			$webRef->setSid($_POST["sid"]);
			$webRef->setWebSite($_POST["website"]);
			$webRef->setType($_POST["type"]);
			$webRef->setLearningHighlight($_POST["learningHighLight"]);
			$webRef->setLastUpdate($_POST["lastUpdate"]);
			$webRef->setRemarks($_POST["remarks"]);
			
			$webRefFilter = new WebRefFilter();
			$webRefFilter->setSid($webRef->getSid());
			$webRefFilter->setLastUpdate($webRef->getLastUpdate());
			
			/*
			echo "Sid: " . $_POST["sid"] . "<br/>";
			echo "WebSite: " . $_POST["website"] . "<br/>";
			echo "Type: " . $_POST["type"] . "<br/>";
			echo "Learning HighLight: ". $_POST["learningHighLight"] . "<br/>";
			echo "Remarks: " . $_POST["remarks"] . "<br/>";
			*/ 
			
			return WebRefMgr::updateWebRefMgr($webRef, $webRefFilter);
		}
		
		public static function selectWebRefCmd($value)
		{
			$webRefFilter = new WebRefFilter();
			$webRefFilter = $value;
			
			$arrayList = new ArrayList();
			$arrayList = WebRefMgr::selectWebRefMgr($webRefFilter);
			
			return $arrayList;
		}
	}
?>