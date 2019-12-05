<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Copyright for e-Learning materials/ 電子學習資源的版權事宜</title>
<!-- InstanceEndEditable -->

<!-- jquery -->
<script type="text/javascript" src="javascript/jquery-1.5.2/jquery-1.5.2.js"></script>

<!-- superfish menu -->
<link href="superfish-1.4.8/css/superfish.css" rel="stylesheet" type="text/css" />
<link href="superfish-1.4.8/css/superfish-vertical.css" rel="stylesheet" type="text/css" />
<link href="superfish-1.4.8/css/superfish-navbar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="superfish-1.4.8/js/hoverIntent.js"></script>
<script type="text/javascript" src="superfish-1.4.8/js/superfish.js"></script>
<script type="text/javascript" src="superfish-1.4.8/js/supersubs.js"></script>

<!-- jquery ui -->
<link href="jquery-ui1.8.12/css/ui-lightness/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery-ui1.8.12/js/jquery-ui-1.8.12.custom.min.js"></script>

<!-- template common -->
<script type="text/javascript" src="javascript/common.js"></script>
<link href="css/template.css" rel="stylesheet" type="text/css" />

<?php

	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/common/template/Template_Code.php' ;	
	
	$commonTemplate = new CommonTemplate();
	
?>
<!-- InstanceBeginEditable name="head" -->
<link href="css/WebRefList.css" rel="stylesheet" type="text/css" />
<?php	
	require_once $currentDir . 'pages/WebRefList_code.php';
	$webRefList = new WebRefList();	
	$systemValues = $webRefList->getSystemValues();
?>
<!-- InstanceEndEditable -->

</head>

<body>
	<div id="bodyDiv">
    	<div id="topDiv"><?php echo $commonTemplate->genBannerHeader() ?><span id="functionMenuSpan"><?php echo $commonTemplate->genFunctionMenu() ?></span></div> <!-- end topDiv -->
        <div id="menuBarDiv">
        	<?php
				echo $commonTemplate->genMainMenuRecur();
			?>
        </div> <!-- end menuBarDiv -->
        <div id="bannerDiv">Banner</div> <!-- end bannerDiv -->
        <div id="editRegDiv">
			<!-- InstanceBeginEditable name="editableRegion" -->
            <div id="currentLocationDiv">location</div>
            <div id="contentDiv">
                <div id="lSideMenu">s</div> <!-- lSideMenu -->
                <div id="rContent">
                	<table id="resourceTable" class="tableEcr">
                    
                	<?php
						$resourceListF = new ArrayList();
						$resourceListF = $webRefList->getResourceList();
						
						while ($resourceListF->hasNext())
						{
							$resourceF = new Resource();
							$resourceF = $resourceListF->next();
							
							echo 
							'<tr>'.
								'<td rowspan="2" width="30%" style="text-align: center" >'.
									'<img src="' . $resourceF->getImageUrl() . '" alt="'. $resourceF->getResourceName($systemValues->getSystemLang()) . '" />'.
								'</td>'.
								
								'<td width="70%" style="padding-left: 10px" >'.
									'<a href="' . $resourceF->getUrl() . '" target="_blank">'.$resourceF->getResourceName($systemValues->getSystemLang()) .'</a>' .
								'</td>'.
							'</tr>'.
							'<tr>'.
								'<td style="padding-left: 10px">'.
									$resourceF->getBriefingHtml($systemValues->getSystemLang()) .
								'</td>'.
							'</tr>';
						} // end while
						
					?>
                    </table>


                                        
                </div> <!-- rContent -->
            </div> <!-- contentDiv -->
			<!-- InstanceEndEditable -->
        </div> <!-- end editRegDiv -->
        <div id="bottomDiv">教育局 - 電子學習資源的版權事宜 © 2011 Education Bureau, HKSAR Government</div> <!-- end bottomDiv -->
    </div> <!-- end bodyDiv -->
</body>
<!-- InstanceEnd --></html>
