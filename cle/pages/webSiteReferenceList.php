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
	<script type="text/javascript" src="javascript/jquery_floatobject-1_4.js"></script>
    <?php
	
    	require_once $currentDir.'pages/webSiteReferenceList_code.php';
	  
	?> 
    <link rel="stylesheet" type="text/css" href="css/table.css" />
    <script type="text/javascript" src="javascript/webSiteReferenceList.js"></script>

    <link href="css/webSiteReferenceList.css" rel="stylesheet" type="text/css" />
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
                    <div style="height: 5px"></div>
                    <div id="topIndicatorDiv" class="topIndicatorDiv"> 
                    	<?php
                        	echo $webSiteReferenceList->getCurrentSelectResourcePath();
                        	
						?>
                    </div>
                    <div class="EditSubDiv">
                    	<div id="sideDiv" class="sideMenuDiv">
                        	<!-- 
                            <div id="sideUpperLogoDiv" class="sideUpperLogoDiv">
                                <img src="img/source/images/sideUpperIcon_03.png" width="244" height="203" />
                            </div>
                            -->
                            <div id="floatingMenu" class="floatingMenuDiv"  >
                            	<div id="floatingMenuUpDiv" class="floatingMenuUpDiv">
                                <br/>
                                
                                <?php 
                                    echo '<ul id="ulFloatingMenu" class="ulFloatingMenu">';
                                    while ($resourceTypeList->hasNext())
                                    {
                                        $resourceType = new ResourceType();
                                        $resourceType = $resourceTypeList->next();
                            
                                        
                                        if ($resourceType->getSid() == $currentResourceType->getSid())
                                        {
                                            echo '<li>';
                                            echo '<strong>' . $resourceType->getLvText() . '</strong>';
                                            echo '</li>';
                                        }
                                        else
                                        {
                                        	if ($resourceType->getIsShown())
                                        	{
	                                            echo '<li>';
	                                            echo '<a href="' . $resourceType->getUrl() . '">' . $resourceType->getLvText() . '</a>';
	                                            echo '</li>';
                                        	}
                                        	else 
                                        	{
	                                            echo '<li style="display: none">';
	                                            echo '<a href="' . $resourceType->getUrl() . '">' . $resourceType->getLvText() . '</a>';
	                                            echo '</li>';                                        		
                                        	}
                                        }
                                        /*
                                        echo 'Lv: ' . $resourceType->getLv() . '++++++++++++++++++++++++++++++++++++++++++++++++++++++'. '<br/>';
                                        echo '$resourceType' .  '<br/>' .
                                                "Sid: " . $resourceType->getSid() . "<br/>" .
                                                "Seq: " . $resourceType->getSeq() . "<br/>" .
                                                "LV: " . $resourceType->getLv() . "<br/>" . 
                                                "LV_Text: " . $resourceType->getLvText(). "<br/>" . 
                                                "UpLV_sid: " . $resourceType->getUpLvSid() . "<br/>" .
                                                "IsShown : " . $resourceType->getIsShown() . "<br/>" .
                                                "Url : " . $resourceType->getUrl() . "<br/>" .						
                                                "Remarks : " . $resourceType->getRemarks() . "<br/>" .
                                                "LastUpdate : " . $resourceType->getLastUpdate() . "<br/>"; 					
                                        echo " ------------------------------------------------------------"."<br/>";	
                                        */
                                    }           
                            
                                    echo '</ul>';
                                ?>  
                                </div> <!-- floatingMenuUpDiv -->
                                <div id="floatingMenuDownDiv" class="floatingMenuDownDiv">
                                </div>
                            </div> <!-- floatingMenu -->
                        </div> <!-- sideDiv -->              
						<script type="text/javascript">
                            floatParams = new Object;
                            floatParams.x = 0;
                            floatParams.y = 300;
                            floatParams.speed = 'fast';
                            // $("#floatingMenu").makeFloat(floatParams);
                        </script>	
                        <div id="rightTableDiv" class="rightTableDiv">
                            <form id="frmResourceList" action="../php/command/ResourceCmd.php" method="post">            
							<table></table>

								<?php
                                    
                                    echo '<table class="FreezeHeaderTableContent">';                   
                                        echo '<thead>';	
                                        echo '<tr>' .
                                                '<td style="width:5%;" nowrap="nowrap">'. '#' .
                                                '</td>'.
                                                '<td style="width:15%">'. '資源圖標' .
                                                '</td>'.                                        
                                                '<td style="width:28%">'. '學習重點' .
                                                '</td>'.
                                                '<td style="width:28%">'. '資源名稱' .
                                                '</td>'.
                                                '<td style="width:20%">'. '出處/作者' .
                                                '</td>' .
                                                '<td style="width:10%">'. '類型' .
                                                '</td>'.
                                            '</tr>';
                                        echo '</thead>';
                                    echo '</table>';
                                    if (strlen($authenticatedUser->getUserId()) > 0)
                                    {
                                        echo '<a href="webSiteReferenceEdit.php">'. 
                                            '<img src="icons/add.gif" width="20" height="20" alt="add" />'.
                                            '</a>';							
                                    }
                                    echo '<table class="FreezeHeaderTable">';	
                                
                                    echo '<tbody>';
                                    
                                    $i = 1;
                                    
                                    while ($resourceList->hasNext())
                                    {
                                        $resource = new Resource();
                                        $resource = $resourceList->next();
                                
                                        // menu bar
                                        if (strlen($authenticatedUser->getUserId()) > 0)
                                        {
                                        echo 	'<tr>' .
                                                    '<td colspan="6" style="height: 5px; background-color: #999999;">' .
                                                         '<a href="webSiteReferenceEdit.php?sid='. $resource->getSid() . '">'.
                                                         '<img src="icons/edit.gif" width="20" height="20" alt="edit" />'.
                                                         '</a>'. '&nbsp;'. '&nbsp;'.							  				
                                                         '<a href="#">'.
                                                         '<img src="icons/delete.gif" width="20" height="20" alt="delete" onclick="changeDeleteResourceSidNSubmit(\''. $resource->getSid() .'\')" />' .
                                                         '</a>'. '&nbsp;'. '&nbsp;'.											
                                                    '</td>' .
                                
                                                '</tr>';
                                        }
                                        echo 	'<tr>' .
                                                    '<td style="width:5%; " nowrap="nowrap">' . $i .
                                                    '</td>' .
                                                    '<td style="width:15%">' . ((is_null($resource->getImageUrl()) || strlen($resource->getImageUrl()) == 0) ? '<img src="img/defaultIcon100x100.png" style="width: 80px" alt="'. $resource->getResourceName().'" />'
													: 
													'<img src="'. $resource->getImageUrl() .'" style="width: 100px" alt="'. $resource->getResourceName().'" />')
													.													
                                                    '</td>' .                                        
                                                    '<td style="width:28%">' . $resource->getTeachingAims() .
                                                    '</td>' .
                                                    '<td style="width:28%">' . '<a href="' . $resource->getUrl() . '" target="_new" >'.$resource->getResourceName() .'</a>' .
                                                    '</td>' .
                                                    '<td style="width:20%">' . $resource->getAuthor() .
                                                    '</td>' .
                                                    '<td style="width:10%">' . $resource->getType() .
                                                    '</td>' .
                                                '</tr>';									
                                
                                        
                                
                                
                                
                                        /*
                                        echo "sid : " . $resource->getSid() . "<br/>" .
                                                "URL : " . $resource->getUrl() . "<br/>" .
                                                "ResourceName : " . $resource->getResourceName(). "<br/>" .
                                                "Author : " . $resource->getAuthor() . "<br/>". 
                                                "TeachingAims : " . $resource->getTeachingAims() . "<br/>" .
                                                "TypeSid : " . $resource->getTypeSid() . "<br/>" . 
                                                "Remarks : " . $resource->getRemarks(). "<br/>" .
                                                "LastUpdate : " . $resource->getLastUpdate(). "<br/>";
                                                */
                                        $i++;
                                    }    
                                    echo '</tbody>';
                                    echo '</table>';
                                
                                ?>
                                
                                <input id="deleteResourceSid" name="deleteResourceSid" type="hidden" value="" />
                                <input id="backResourceTypeSid" name="backResourceTypeSid" type="hidden" value="<?php (isset($_GET["sid"]) ? $_GET["sid"] : '')?>" /> 
                                <input id="backResourceTypeUpLvSid" name="backResourceTypeUpLvSid" type="hidden" value="<?php (isset($_GET["upLvSid"]) ? $_GET["upLvSid"] : '')?>" />              		
                                <input id="param" name="param" type="hidden" value="<?php echo Param::$DELETE; ?>" />
                            
                            
                            </form>		
                        
                        </div> <!-- rightTableDiv -->          
                  </div> <!-- EditSubDiv -->

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