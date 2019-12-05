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
    	require_once 'pages/webSiteReferenceList_code.php';
	  
	?> 
    <link rel="stylesheet" type="text/css" href="css/table.css" />
    <script type="text/javascript" src="javascript/webSiteReferenceList.js"></script>

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
                <form id="frmResourceList" action="../php/command/ResourceCmd.php" method="post">            
                    <?php
                        
                        echo '<table class="FreezeHeaderTable">';
                        /*
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>'. '學習重點' . '</th>'.
                                '<th>'. '資源名稱' . '</th>'.
                                '<th>'. '出處'. '</th>'.
                                '<th>'. '連結'. '</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';*/
                        
                        echo '<a href="webSiteReferenceEdit.php">'. 
                            '<img src="icons/add.gif" width="20" height="20" alt="add" />'.
                            '</a>';
                        while ($resourceList->hasNext())
                        {
                            $resource = new Resource();
                            $resource = $resourceList->next();
    
                            // menu bar
                            echo '<tr>' .
                                 '<td  colspan="2" style="height: 5px; background-color: #999999; ">' .
								 '<a href="webSiteReferenceEdit.php?sid='. $resource->getSid() . '">'.
								 '<img src="icons/edit.gif" width="20" height="20" alt="edit" />'.
								 '</a>'. '&nbsp;'. '&nbsp;'.							  				
                                 '<a href="#">'.
                                 '<img src="icons/delete.gif" width="20" height="20" alt="delete" onclick="changeDeleteResourceSidNSubmit(\''. $resource->getSid() .'\')" />' .
                                 '</a>'. '&nbsp;'. '&nbsp;'.							 
                                 '</td>'.
                                 '</tr>';						
                            
                            echo '<tr>';
                            echo '<td style="width:40%;">' . '學習重點' . '</td>';
                            echo '<td style="width:60%;">' . $resource->getTeachingAims() . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>' . '資源名稱' . '</td>';
                            echo '<td>' . $resource->getResourceName() . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>' . '出處' . '</td>';
                            echo '<td>' . $resource->getAuthor() . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td>' . '連結' . '</td>';
                            echo '<td><a href="' . $resource->getUrl() . '" target="_new" >'.$resource->getUrl().'</a></td>';
                            echo '</tr>';

    
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
                        }    
                        echo '</tbody>';
                        echo '</table>';
                 
                    ?>
                    
                    <input id="deleteResourceSid" name="deleteResourceSid" type="hidden" value="" />
                    <input id="backResourceTypeSid" name="backResourceTypeSid" type="hidden" value="<?php (isset($_GET["sid"]) ? $_GET["sid"] : '')?>" /> 
                    <input id="backResourceTypeUpLvSid" name="backResourceTypeUpLvSid" type="hidden" value="<?php (isset($_GET["upLvSid"]) ? $_GET["upLvSid"] : '')?>" />              		
                    <input id="param" name="param" type="hidden" value="<?php echo Param::$DELETE; ?>" />
                    
                    
                    <div id="floatingMenu" style="width:140px; font-size:14px" >
                        <?php 
                            echo '<ul>';
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
                                    echo '<li>';
                                    echo '<a href="' . $resourceType->getUrl() . '">' . $resourceType->getLvText() . '</a>';
                                    echo '</li>';
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
                    </div>
                                  
                    <script type="text/javascript">
                        floatParams = new Object;
                        floatParams.x = 0;
                        floatParams.y = 300;
                        floatParams.speed = 'fast';
                        $("#floatingMenu").makeFloat(floatParams);
                    </script>	
                </form>			
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