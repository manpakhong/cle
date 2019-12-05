<?php

	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/cmd/FileCabinetCmd.php';
	require_once $currentDir . 'php/common/PageCode.php';
	require_once $currentDir . 'php/system/SysParams.php';
	require_once $currentDir . 'php/cmd/ActivityCmd.php';
	require_once $currentDir . 'php/vo/Activity.php';
	require_once $currentDir . 'php/vo/ActivityFilter.php';
	require_once $currentDir . 'php/vo/FileCabinet.php';
	require_once $currentDir . 'php/vo/FileCabinetFilter.php';
	require_once $currentDir . 'php/vo/OrderBy.php';		
	
	
	
	class FileDownload extends PageCode
	{

		private $fileCabinetListWoActivity;
		private $activityList;
		
		private $fileCabinetCmd;
		private $activityCmd;
		
		public function __construct()
		{	
			parent::__construct('FileDownload.php');

			// --- fileCabinet
			$this->fileCabinetListWoActivity = new ArrayList();
			$this->fileCabinetCmd = new FileCabinetCmd();
			
			$fileCabinetFilter = new FileCabinetFilter();
			$fileCabinetFilter->setActivitySid('is null');
			
			$orderBy = new OrderBy();
			$orderBy->setField('Seq');
			$orderBy->setIsAsc(true);
			$fileCabinetFilter->setOrderByList($orderBy);
							
			$this->fileCabinetListWoActivity = $this->fileCabinetCmd->selectFileCabinet($fileCabinetFilter);
					
			// echo 'size: ' . $this->fileCabinetListWoActivity->size();
			
			// --- activity
			$this->activityList = new ArrayList();
			$this->activityCmd = new ActivityCmd();
			
			$activityFilter = new ActivityFilter();
			
			$orderBy1 = new OrderBy();
			$orderBy1->setField('Seq');
			$orderBy1->setIsAsc(true);
			$activityFilter->setOrderByList($orderBy1);
			
			$this->activityList = new ArrayList();
			$this->activityList = $this->activityCmd->selectActivity($activityFilter);
			
		} // end constructor

		public function genFileCabinetListWoActivity()
		{
			if ($this->fileCabinetListWoActivity->size() > 0)
			{
				echo '<ul>';
			}
			
			while ($this->fileCabinetListWoActivity->hasNext())
			{
				$fileCabinet = new FileCabinet();
				$fileCabinet = $this->fileCabinetListWoActivity->next();
				                            
				echo 	
					'<li>' .
						$fileCabinet->getDescription($this->systemValues->getSystemLang()) . ' - ' .
						$fileCabinet->getFileDate() . ' - ' .
						'<a href="' . $fileCabinet->getFilePath() . '">' .  
							$fileCabinet->getFileName($this->systemValues->getSystemLang()) .
						'</a>' . 
					'</li>';
			}
                       
			if ($this->fileCabinetListWoActivity->size() > 0)
			{
				echo '</ul>';
			}
			
			$this->fileCabinetListWoActivity->goToTheBegin();
			
		}
		
		public function genFileCabinetListWActivity()
		{
			
			echo '<ul>';
			
			while ($this->activityList->hasNext())
			{
				$activity = new Activity();
				$activity = $this->activityList->next();
				                            
				echo	'<li>' .
						 	$activity->getActivityName($this->systemValues->getSystemLang()) . ' - ' .
							$activity->getSpeaker($this->systemValues->getSystemLang()) . ' - ' .
							$activity->getActivityDate() . 
						'</li>';
				
				$fileCabinetList = new ArrayList();
				$fileCabinetFilter = new FileCabinetFilter();
				
				$fileCabinetFilter->setActivitySid($activity->getSid());
				$orderBy = new OrderBy();
				$orderBy->setField('Seq');
				$orderBy->setIsAsc(true);
				$fileCabinetFilter->setOrderByList($orderBy);
				
				$fileCabinetList = $this->fileCabinetCmd->selectFileCabinet($fileCabinetFilter);
				
				if ($fileCabinetList->size() > 0)
				{
					echo '<ul>';
				}
				
				while ($fileCabinetList->hasNext())
				{
					$fileCabinet = new FileCabinet();
					$fileCabinet = $fileCabinetList->next();
					
					echo 
					'<li>' .
						$fileCabinet->getDescription($this->systemValues->getSystemLang()) . ' - ' .
						$fileCabinet->getFileDate() . ' - ' .
						'<a href="' . $fileCabinet->getFilePath() . '">' .  
							$fileCabinet->getFileName($this->systemValues->getSystemLang()) .
						'</a>' . 
					'</li>';
				}
				
				if ($fileCabinetList->size() > 0)
				{
					echo '</ul>';
				}
				
			}			

			echo '</url>';
		}
		
		public function getFileCabinetListWoActivity()
		{
			return $this->fileCabinetListWoActivity;
		}
		
		public function getActivityList()
		{
			return $this->activityList;
		}
		
		public function genFileDownloadList($_ulId = 'fileDownloadUl')
		{
			if ($this->fileCabinetListWoActivity->size() > 0)
			{
				echo '<ul>';
					while ($this->fileCabinetListWoActivity->hasNext())
					{
						$fileCabinet = new FileCabinet();
						$fileCabinet = $this->fileCabinetListWoActivity->next();

						echo 
						'<table>' .
							'<tr>' .
								'<td>' . '�ɮצW�� '. '</td>'.
								'<td>' . $fileCabinet->getFileName($this->systemValues->getSystemLang()) .'</td>' .
							'</tr>' .
							'<tr>' .
								'<td>' . '�ɮ׺���' . '</td>'.
								
							'</tr>' .
						'</table>';
					}
				echo '</ul>';
			} // end if ($this->fileCabinetList->size() > 0)
		} // end genFileDownloadList()
		
		
	} // end class

?>