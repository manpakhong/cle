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
<script type="text/javascript" src="javascript/login.js"></script>
<link href="css/Login.css" rel="stylesheet" type="text/css" />
<!-- JQueryValidator -->
<script type="text/javascript" src="jQueryValidator/js/languages/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="jQueryValidator/js/jquery.validationEngine.js"></script>
<link href="jQueryValidator/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
<link href="jQueryValidator/css/template.css" rel="stylesheet" type="text/css" />


<?php
	include_once $currentDir . 'pages/Login_code.php';
	$login = new Login();
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
			<div id="ajaxLoginDiv">
            	<form id="loginForm" class="formular" method="post">
                    <fieldset>
                        <legend><?php echo $login->getDisplayLang('login_legend_login') ?></legend>
                        <table  border="0">
                          <tr>
                            <td ><?php echo $login->getDisplayLang('login_user_id') ?></td>
                            <td ><input id="userId" name="userId" type="text" size="30" class="validate[required]" /></td>
                          </tr>
                          <tr>
                            <td><?php echo $login->getDisplayLang('login_password') ?></td>
                            <td><input id="password" name="password" type="password" size="30" /></td>
                          </tr>
                          <tr>
                            <td colspan="2">
                            <input type="button" name="submit" id="login" value="<?php echo $login->getDisplayLang('login_button_submit') ?>" onclick="ajaxLoginPost()" /></td>
                          </tr>
                        </table>
                        <input id="param" name="<?php echo SystemParam::$CMD ?>" type="hidden" value="<?php echo SystemParam::$CMD_SELECT ?>" />

                    </fieldset>                	
                </form>
                <?php 
                	/*
	                Print_r($_SESSION) . '<br/>';
                	$systemValues = new SystemValues();
	                echo 'SystemValue: ' . $systemValues->getSystemLang() . '<br/>';
	                echo 'Type: ' . $systemValues->getSystemStorageType() . '<br/>';
					*/
                ?>
            </div>
			<!-- InstanceEndEditable -->
        </div> <!-- end editRegDiv -->
        <div id="bottomDiv">教育局 - 電子學習資源的版權事宜 © 2011 Education Bureau, HKSAR Government</div> <!-- end bottomDiv -->
    </div> <!-- end bodyDiv -->
</body>
<!-- InstanceEnd --></html>
