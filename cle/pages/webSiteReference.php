<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

    <script type="text/javascript" src="javascript/jquery-1.5.1.js"></script>
    <script type="text/javascript" src="../superfish-1.4.8/js/hoverIntent.js"></script>
	<script type="text/javascript" src="../superfish-1.4.8/js/superfish.js"></script>
    <script type="text/javascript" src="javascript/common.js"></script>
    <script type="text/javascript" src="javascript/jqueryUI/js/jquery-ui-1.8.11.custom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/template.css" />
	<link rel="stylesheet" type="text/css" href="css/superfish.css" media="screen" />         

	<?php 

		$currentDir = getcwd();
		$findRootDirPos = strpos($currentDir, 'cle', 0);
		$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

		$currentDir = $currentDir . '/';
		
		$findPagesDir = strpos($_SERVER['PHP_SELF'], 'pages', 0);

		// echo 'currentRoot: ' . $currentDir . '<br/>';
		require_once( $currentDir.'php/common/IncludeFiles.php' );
		require_once( $currentDir.'php/common/SuperFishMenuGenerator.php' );
        require_once($currentDir . 'php/common/LoginSession.php');		
        require_once($currentDir . 'pages/Template_code.php');					
    ?>
	<!-- #BeginEditable "headedit" -->
    <link rel="stylesheet" type="text/css" href="css/webSiteReference.css" />
	<?php 
        require_once 'pages/webSiteReference_code.php';
    ?>
    <script type="text/javascript" src="javascript/webSiteReference.js"></script>

    <!-- #EndEditable -->    
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>學生自學網</title> 
</head>
  	<body>            
    	<div id="outerDiv">
            <div id="bodyArea" >
                <div id="paperBgTopDiv">
    
                    <div id="login">
                        <ul>

                            <li><?php echo $authenticatedUser->getName(); ?></li>
                            <li><?php echo (strlen($authenticatedUser->getUserId()) > 0 ? '|' : '');  ?></li>
                            <li><?php echo (strlen($authenticatedUser->getUserId()) == 0 ? '<a href="'. ($findPagesDir ? 'userLogin.php' : 'pages/userLogin.php') .'">管理登入</a>': '<a href="#" onclick="logout(\''. $template->getRelativePath() .'\')">登出</a>') ?></li>
                            <li><?php echo (strlen($authenticatedUser->getUserId()) > 0 ? '|' :''); ?></li>
                            <li><?php echo (strlen($authenticatedUser->getUserId()) > 0 ? '<a href="' . ($findPagesDir ? 'adminControlPanel.php' : 'pages/adminControlPanel.php') . '">管理面版</a>' : '') ?></li>                     
                        </ul>
                    </div> <!-- login -->
                    
                    <!-- menuDiv -->            
                    <div id="menuDiv">
                        <?php
                            $superFishMenuGenerator = new SuperFishMenuGenerator();
                            $superFishMenuGenerator->getMenu();
                        ?>
                    </div>
                    <!-- menuDiv -->                
                </div> <!-- paperBgTopDiv -->    
                <div id="editDiv" class="EditDiv">
                    <!-- InstanceBeginEditable name="editRegion" -->
                <div style="height:auto;">
                    <table id="headerfields" class="FreezeHeaderTable">
                        <thead id="headerbar" > 
                          <tr>
                            <th id="sid" style="width: 5%">#</th>
                            <th id="website" style="width: 30%">網站</th>
                            <th id="type" style="width: 10%">分類</th>
                            <th id="learninghighlight" style="width: 50%">學習重點</th>
                          </tr>
                        </thead>
                    </table>
                </div>
                <div id="tableDiv">
                    <table id="webRef" class="FreezeHeaderTable">
                    	<tbody>
                          <?php
						  	$webRefFilter = new WebRefFilter();
                            $arrayList = new ArrayList();
                            $arrayList = WebRefCmd::selectWebRefCmd($webRefFilter);
                            
                            if ($arrayList->size() > 0)
                            {
                                $webRef = new WebRef();
                                
                                while ($arrayList->hasNext())
                                {
                                    $webRef = $arrayList->next();
                                    echo 	'<tr><td style="width: 5%">' . $webRef->getSid() . '</td>' .
                                            '<td style="width: 30%">' . $webRef->getWebSite() . '</td>' .
                                            '<td style="width: 10%">' . $webRef->getType() . '</td>' .
                                            '<td style="width: 50%">' . $webRef->getLearningHighlight() . '</td></tr>';
                                }
                            }
                          ?>
						</tbody>
                    </table>
				</div>
				
				<!--  				
					<div id="divHover" style="position:absolute; background-color:#0CF; height:30px; visibility: visible" >Button</div>
				-->
				
				<!-- InstanceEndEditable -->
                </div>
 
                <div id="copyrightDiv" class="CopyrightDiv">中國語文教育-學生自學網 &copy; 2011 Education Bureau, HKSAR Government</div>
            </div> <!-- bodyArea -->
        </div> <!-- outerDiv -->
		<script type="text/javascript">
        /*
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-22804241-1']);
          _gaq.push(['_trackPageview']);
        
          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();*/
        </script>        
	</body>
<!-- InstanceEnd --></html>