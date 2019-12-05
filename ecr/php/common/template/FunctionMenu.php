<?php
if(!isset($_SESSION))
{
    session_start();
}
	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/common/ArrayList.php';
	require_once $currentDir . 'php/system/SysParams.php';	
	require_once $currentDir . 'php/system/SystemValues.php';
	require_once $currentDir. 'php/vo/system/DisplayLang.php';
	require_once $currentDir. 'php/vo/system/DisplayLangFilter.php';
	
	require_once $currentDir . 'php/common/PageCode.php';
		
	class FunctionMenu extends PageCode
	{
		private $embeddedPageFileName;
		public function __construct($_embeddedPageFileName)
		{
			$this->embeddedPageFileName = $_embeddedPageFileName;
			parent::__construct('FunctionMenu.php');
		
		}
		
		public function genBannerHeader($_systemValues)
		{
			return $this->getDisplayLang('functionMenu_edb_banner_text');
		}
		
		public function genFunctionMenu($_systemValues, $_id='functionMenu')
		{
			$findPagesDir = strpos($_SERVER['PHP_SELF'], 'pages', 0);
			$findSystemDir = strpos($_SERVER['PHP_SELF'], 'system', 0);
			
			$systemPageLocation = '';
			
			if ($findSystemDir)
			{
				$systemPageLocation = SystemParam::$SYSTEM_PAGE_LOCATION_SYSTEM;
			}
			else
			{
				if ($findPagesDir)
				{
					$systemPageLocation = SystemParam::$SYSTEM_PAGE_LOCATION_PAGES;
				}
				else
				{
					$systemPageLocation = SystemParam::$SYSTEM_PAGE_LOCATION_ROOT;
				}
			}
			
			
			$userCmdRelativePath = $this->systemValues->getRelativeDocRoot() . '/php/cmd/system/EcrUserCmd.php';	
			$return = '';
			
			$displayLangCmdUrlEn = '';
			$displayLangCmdUrlTc = '';
			$systemPanelLocation = '';

			
			switch ($systemPageLocation)
			{
				case SystemParam::$SYSTEM_PAGE_LOCATION_SYSTEM:
					$displayLangCmdUrlEn = '../../php/cmd/system/DisplayLangCmd.php?' . 
					SystemParam::$SYSTEM_LANGUAGE . '=' . SystemParam::$SYSTEM_LANGUAGE_EN . 
					'&' . SystemParam::$RETURN_URL . '=' . '../../../pages/system/' . $this->embeddedPageFileName;
					
					$displayLangCmdUrlTc = '../../php/cmd/system/DisplayLangCmd.php?' . 
					SystemParam::$SYSTEM_LANGUAGE . '=' . SystemParam::$SYSTEM_LANGUAGE_TC . 
					'&' . SystemParam::$RETURN_URL . '=' . '../../../pages/system/' . $this->embeddedPageFileName;
					
					// $systemPanelLocation = 'SystemPanel.php';
					$systemPanelLocation = '../../flex-bin/ecr.html';					
					break;
				case SystemParam::$SYSTEM_PAGE_LOCATION_PAGES:
					$displayLangCmdUrlEn = '../php/cmd/system/DisplayLangCmd.php?' . 
					SystemParam::$SYSTEM_LANGUAGE . '=' . SystemParam::$SYSTEM_LANGUAGE_EN . 
					'&' . SystemParam::$RETURN_URL . '=' . '../../../pages/' . $this->embeddedPageFileName;
					
					$displayLangCmdUrlTc = '../php/cmd/system/DisplayLangCmd.php?' . 
					SystemParam::$SYSTEM_LANGUAGE . '=' . SystemParam::$SYSTEM_LANGUAGE_TC . 
					'&' . SystemParam::$RETURN_URL . '=' . '../../../pages/' . $this->embeddedPageFileName;	

					// $systemPanelLocation = 'system/SystemPanel.php';
					$systemPanelLocation = '../flex-bin/ecr.html';
					break;
				case SystemParam::$SYSTEM_PAGE_LOCATION_ROOT:
					$displayLangCmdUrlEn = 'php/cmd/system/DisplayLangCmd.php?' . 
					SystemParam::$SYSTEM_LANGUAGE . '=' . SystemParam::$SYSTEM_LANGUAGE_EN . 
					'&' . SystemParam::$RETURN_URL . '=' . '../../../' . $this->embeddedPageFileName;
					
					$displayLangCmdUrlTc = 'php/cmd/system/DisplayLangCmd.php?' . 
					SystemParam::$SYSTEM_LANGUAGE . '=' . SystemParam::$SYSTEM_LANGUAGE_TC . 
					'&' . SystemParam::$RETURN_URL . '=' . '../../../' . $this->embeddedPageFileName;	

					// $systemPanelLocation = 'pages/system/SystemPanel.php';
					$systemPanelLocation = 'flex-bin/ecr.html';
					break;
			}

			$styleEn = '';
			$styleTc = '';
			
			if ($this->systemValues->getSystemLang() == SystemParam::$SYSTEM_LANGUAGE_EN)
			{
				$styleEn = 'style="background-color: #d7fdfd"';
				$styleTc = '';
			}
			if ($this->systemValues->getSystemLang() == SystemParam::$SYSTEM_LANGUAGE_TC)
			{
				$styleEn = '';
				$styleTc = 'style="background-color: #d7fdfd"';
			}


			if ($this->systemValues->isLogin())
			{
				$return = 
					'<ul id="'. $_id.'">'.
						'<li>' .
							'<a href="' . $displayLangCmdUrlEn . '" ' . $styleEn. '>' . 'English' .
							'</a>&nbsp;' .
							'<a href="' .  $displayLangCmdUrlTc . '" '. $styleTc. '>' . '中文' .
							'</a>&nbsp;' .							
						'</li>' .
						'<li>&nbsp;|&nbsp;</li>' .
						'<li>'. $this->genLogin() . '</li>'.
						'<li>&nbsp;|&nbsp;</li>' .
						'<li>'.
							'<a href="' . $systemPanelLocation . '" target="_new">' .
								$this->getDisplayLang('functionMenu_system_panel') .
							'</a>' .  
						'</li>'.
						'<li>&nbsp;|&nbsp;</li>' .
						'<li>'.
							'<a href="#" onclick="logout(\'' . $userCmdRelativePath . '\',\'' . $this->getDisplayLang('functionMenu_logout_success') . '\');">' . $this->getDisplayLang('functionMenu_logout') . '</a>'.
						'</li>'.
		            '</ul>' 
					;
				
			}
			else
			{
				$return =
					'<ul id="' . $_id. '">'.
						'<li>' .
							'<a href="' . $displayLangCmdUrlEn . '" '. $styleEn. '>' . 'English' .
							'</a>&nbsp;' .
							'<a href="' .  $displayLangCmdUrlTc . '" '. $styleTc. '>' . '中文' .
							'</a>&nbsp;' .							
						'</li>' .
						'<li>&nbsp;|&nbsp;</li>' .
						'<li>' . $this->genLogin() . '</li>' .
					'</ul>'
					;
			} // ed if ... else

			// echo $return;
			return $return;
				
		} // end genFunctionMenu

		private function genLogin()
		{			
			if (!is_null($this->authenticatedUser) && 
				!is_null($this->authenticatedUser->getName($this->systemValues->getSystemLang())))
			{

				return $this->authenticatedUser->getName($this->systemValues->getSystemLang());
			}
			else
			{
				$return = '';
			
				if (!$this->systemValues->isLogin())
				{

					$return .= '<a href="'. $this->systemValues->getRelativeDocRoot() .'/pages/Login.php">'. 
					$this->getDisplayLang('functionMenu_login')
					. '</a>';
				}
				else
				{

					$return .= $this->authenticatedUser->getName($this->systemValues->getSystemLang());
				}
				
				return $return;
			
			} // end if ... else
		} // end genLogin()			
		
	} // end class
?>