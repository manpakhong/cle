<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Copyright for e-Learning materials/ 電子學習資源的版權事宜</title>
<!-- InstanceEndEditable -->

<!-- jquery -->
<script type="text/javascript" src="../javascript/jquery-1.5.2/jquery-1.5.2.js"></script>

<!-- superfish menu -->
<link href="../superfish-1.4.8/css/superfish.css" rel="stylesheet" type="text/css" />
<link href="../superfish-1.4.8/css/superfish-vertical.css" rel="stylesheet" type="text/css" />
<link href="../superfish-1.4.8/css/superfish-navbar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../superfish-1.4.8/js/hoverIntent.js"></script>
<script type="text/javascript" src="../superfish-1.4.8/js/superfish.js"></script>
<script type="text/javascript" src="../superfish-1.4.8/js/supersubs.js"></script>

<!-- jquery ui -->
<link href="../jquery-ui1.8.12/css/ui-lightness/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery-ui1.8.12/js/jquery-ui-1.8.12.custom.min.js"></script>

<!-- template common -->
<script type="text/javascript" src="../javascript/common.js"></script>
<link href="../css/template.css" rel="stylesheet" type="text/css" />

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
<?php
	require_once $currentDir . 'pages/system/SystemPanel_code.php';
	
	$systemPanel = new SystemPanel();
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
            <ul>
            	<li>
                	<a href="../../flex-bin/ecr.html" target="_new"><?php echo $systemPanel->getDisplayLang('systemPanel_control_panel') ?></a>
                	<!-- <a href="FileUpload.php"><?php // echo $systemPanel->getDisplayLang('systemPanel_file_upload') ?></a> -->
                </li>
            </ul>
            <!-- 
            <div>testing purpose only <br/>
            <form id="webSiteReferenceEditForm" method="post" action="../../php/cmd/FileCabinetCmd.php" >
            	<input name="submit" type="submit" value="提交" />
            	<input name="CMD" type="hidden" value="FLEX_SELECT_ALL" >
            </form>
            </div>
           -->
			<!-- InstanceEndEditable -->
        </div> <!-- end editRegDiv -->
        <div id="bottomDiv">教育局 - 電子學習資源的版權事宜 © 2011 Education Bureau, HKSAR Government</div> <!-- end bottomDiv -->
    </div> <!-- end bodyDiv -->
</body>
<!-- InstanceEnd --></html>
