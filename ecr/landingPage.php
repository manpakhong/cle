<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Copyright for e-Learning materials/ 電子學習資源的版權事宜</title>
<!-- InstanceEndEditable -->

<!-- jquery -->
<script type="text/javascript" src="pages/javascript/jquery-1.5.2/jquery-1.5.2.js"></script>

<!-- superfish menu -->
<link href="pages/superfish-1.4.8/css/superfish.css" rel="stylesheet" type="text/css" />
<link href="pages/superfish-1.4.8/css/superfish-vertical.css" rel="stylesheet" type="text/css" />
<link href="pages/superfish-1.4.8/css/superfish-navbar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="pages/superfish-1.4.8/js/hoverIntent.js"></script>
<script type="text/javascript" src="pages/superfish-1.4.8/js/superfish.js"></script>
<script type="text/javascript" src="pages/superfish-1.4.8/js/supersubs.js"></script>

<!-- jquery ui -->
<link href="pages/jquery-ui1.8.12/css/ui-lightness/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="pages/jquery-ui1.8.12/js/jquery-ui-1.8.12.custom.min.js"></script>

<!-- template common -->
<script type="text/javascript" src="pages/javascript/common.js"></script>
<link href="pages/css/template.css" rel="stylesheet" type="text/css" />

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
<link href="pages/css/landingPage.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="pages/javascript/landingPage.js"></script>
<?php 
	require_once $currentDir . 'php/system/SystemValues.php'; 
	require_once $currentDir . 'landingPage_code.php';
	require_once $currentDir . 'php/common/Misc.php';
	
	$landingPage = new LandingPage();
	
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
            	<div id="introLDiv">
					<span style="font-weight:bold"><?php echo $landingPage->getDisplayLang('landingPage_intro'); ?></span><br/>
					<?php 
						$cm = new Cm();
						$cm = $landingPage->getCm();
						echo $cm->getContentHtml($landingPage->getSystemLang());
					
					?>               
                </div>
                <div id="newsRDiv"><span style="font-weight:bold"><?php echo $landingPage->getDisplayLang('landingPage_latest_news'); ?> </span><br/>
                	<table>
                    	<tr>
                        	<td style="text-align:left" >
                        		<?php 
                            		echo $landingPage->getDisplayLang('landingPage_activity_date');
                            	?>
                            </td>
                            <td style="text-align:left">
                            	<?php 
                            		echo $landingPage->getDisplayLang('landingPage_activity_name');
                            	?>
                            </td>
                            <td style="text-align:left">
                            	<?php 
                            		echo $landingPage->getDisplayLang('landingPage_activity_content');
                            	?>
                            </td>
                        </tr>
					<?php 
						$activityList = new ArrayList(); 
						$activityList = $landingPage->getActivityList();
						
						while ($activityList->hasNext())
						{
							$activity = new Activity();
							$activity = $activityList->next();
							
							echo '<tr>';
								echo '<td>';
									// echo $activity->getActivityDate() . '<br/>';
									echo $activity->getActivityDateD()->format('d/m/Y');
								echo '</td>';							
								echo '<td>';
									echo $activity->getActivityName($landingPage->getSystemLang());
								echo '</td>';
								echo '<td>';
									echo $activity->getContentHtml($landingPage->getSystemLang());
								echo '</td>';
							echo '</tr>';
						}
						
                    ?>   
                    </table>    
                </div>			
			<!-- InstanceEndEditable -->
        </div> <!-- end editRegDiv -->
        <div id="bottomDiv">教育局 - 電子學習資源的版權事宜 © 2011 Education Bureau, HKSAR Government</div> <!-- end bottomDiv -->
    </div> <!-- end bodyDiv -->
</body>
<!-- InstanceEnd --></html>
