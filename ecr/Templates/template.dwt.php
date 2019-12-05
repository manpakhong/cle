<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Copyright for e-Learning materials/ 電子學習資源的版權事宜</title>
<!-- TemplateEndEditable -->

<!-- jquery -->
<script type="text/javascript" src="../pages/javascript/jquery-1.5.2/jquery-1.5.2.js"></script>

<!-- superfish menu -->
<link href="../pages/superfish-1.4.8/css/superfish.css" rel="stylesheet" type="text/css" />
<link href="../pages/superfish-1.4.8/css/superfish-vertical.css" rel="stylesheet" type="text/css" />
<link href="../pages/superfish-1.4.8/css/superfish-navbar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../pages/superfish-1.4.8/js/hoverIntent.js"></script>
<script type="text/javascript" src="../pages/superfish-1.4.8/js/superfish.js"></script>
<script type="text/javascript" src="../pages/superfish-1.4.8/js/supersubs.js"></script>

<!-- jquery ui -->
<link href="../pages/jquery-ui1.8.12/css/ui-lightness/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../pages/jquery-ui1.8.12/js/jquery-ui-1.8.12.custom.min.js"></script>

<!-- template common -->
<script type="text/javascript" src="../pages/javascript/common.js"></script>
<link href="../pages/css/template.css" rel="stylesheet" type="text/css" />

<?php

	$currentDir = getcwd();
	$rootDir = 'ecr';
	$findRootDirPos = strpos($currentDir, $rootDir, 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + strlen($rootDir));
	$currentDir = $currentDir . '/';
	
	require_once $currentDir . 'php/common/template/Template_Code.php' ;	
	
	$commonTemplate = new CommonTemplate();
	
?>
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->

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
			<!-- TemplateBeginEditable name="editableRegion" -->
			<!-- TemplateEndEditable -->
        </div> <!-- end editRegDiv -->
        <div id="bottomDiv">教育局 - 電子學習資源的版權事宜 © 2011 Education Bureau, HKSAR Government</div> <!-- end bottomDiv -->
    </div> <!-- end bodyDiv -->
</body>
</html>
