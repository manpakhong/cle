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
	<!-- <script type="text/javascript" src="../textAreaCountMeter/textAreaCounterMeter.js"></script> -->
    <link href="css/webSiteReferenceEdit.css" rel="stylesheet" type="text/css" />
	<?php 
        require_once $currentDir. 'pages/webSiteReferenceEdit_code.php';
    ?>   
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script> 
	<script type="text/javascript" src="javascript/webSiteReferenceEdit.js"></script>
	<script type="text/javascript" src="../jQueryValidator/js/languages/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="../jQueryValidator/js/jquery.validationEngine.js"></script>
    <link href="../jQueryValidator/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
	<link href="../jQueryValidator/css/template.css" rel="stylesheet" type="text/css" />

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
                    <div class="EditSubDiv2">
						<?php
                            $resource = new Resource();				
                            
                            $resourceType = new ResourceType();
                            
                            if ($_SERVER['REQUEST_METHOD'] != 'POST') 
                            {
                                // echo "POST" . "<br/>";
                                if (!is_null($_REQUEST["sid"]))
                                {
                                    $resource = $webSiteReferenceEdit->selectResourceBySid($_REQUEST["sid"]);
                                }
                                
                                if (!is_null($resource->getTypeSid()))
                                {
                                    $resourceType = $webSiteReferenceEdit->selectResourceType();	
                                }
                                else
                                {	// sid for dropdownlist
                                    if(isset($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID]))
                                    {
                                        $resourceType = $webSiteReferenceEdit->selectResourceTypeBySid($_SESSION[ResourceCmd::$BACK_RESOURCE_TYPE_SID]); 
                                    }
                                }
                            }					
                        ?>
                        <form id="webSiteReferenceEditForm" method="post" action="../php/command/ResourceCmd.php" >
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 30%"></th>
                                        <th style="width: 70%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>sid</td>
                                        <td>
                                            <input name="sid" readonly="readonly" type="text" value="<?php echo $resource->getSid(); ?>" style="width:300px"/>
                                        </td>
                                    </tr>    
                                    <tr>
                                        <td>學習重點</td>
                                        <td>
                                        	<!-- 
                                            <div style="visibility:hidden" >
                                                <div id="teachingAimsLiveCount">15</div>
                                                <div id="teachingAimsLiveBarBox">
                                                    <div id="teachingAimsLiveBar"></div>
                                                </div>
                                            </div>
                                            -->
                                            <textarea id="txtaTeachingAims" name="teachingAims"  >
                                                <?php echo $resource->getTeachingAims(); ?>
                                            </textarea>
                                            
                                            <script type="text/javascript">
                                                CKEDITOR.replace( 'txtaTeachingAims',
                                                        {
                                                            customConfig : '../pages/javascript/ckeditor_config.js'
                                                        });
                                                    
                                            </script>    
                                                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>資源名稱</td>
                                        <td>
                                            <input id="resourceName" name="resourceName" type="text" value="<?php echo $resource->getResourceName(); ?>" style="width:300px" class="validate[required]" />
                                        </td>
                                    </tr>     
                                    <tr>
                                        <td>出處</td>
                                        <td>
                                            <input name="author" type="text" value="<?php echo $resource->getAuthor(); ?>" style="width:300px"/>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td>連結</td>
                                        <td>
                                            <input name="url" type="text" value="<?php echo $resource->getUrl(); ?>" style="width:300px"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>功能列分類</td>
                                        <td>                    
                                            <?php 
                                                $postName = 'typeMenuSid';
                                                $menuSid = 'ddlTypeMenuSid';
                                                $webSiteReferenceEdit->genResourceTypeDropDownList($menuSid,$postName); 
                                            ?>
                                            <!-- 
                                            <script type="text/javascript">
                                                $('#resourceTypeDropDownList').click(
                                                    function() 
                                                    {
                                                        $('#typeSid').attr("value", $('#resourceTypeDropDownList').attr("value");
                                                        alert($('#resourceTypeDropDownList').attr("value"));
                                                    }
                                                )
                                            </script>
                                            -->
        
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>分類</td>
                                        <td>
                                            <?php 
                                                /*
                                                echo 'TypeSid: ' .$resource->getTypeSid() . '<br/>';
                                                echo 'Type: ' .$resource->getType() . '<br/>'; 
                                                */
                                            ?>
                                            <select name="typeSid" id="typeSid">
                                                <?php 
                                                    $typeList = new ArrayList();	
                                                    $typeList = $webSiteReferenceEdit->getTypeList();
                                                    
                                                    while ($typeList->hasNext())
                                                    {
                                                        $type = new Type();
                                                        $type = $typeList->next();
                                                    
                                                        
                                                        if ($type->getSid() == $resource->getTypeSid())
                                                        {
                                                            echo '<option value="'. $type->getSid() . '" selected>'.$type->getType() .'</option>';                                    				
                                                        }
                                                        else
                                                        {
                                                            echo '<option value="'. $type->getSid() . '">'.$type->getType() .'</option>';
                                                        }
                                                    }
                                                    
                                                ?>
        
                                            </select>
                                            
                            
                                      </td>
                                    </tr>  
                                    <tr>
                                        <td>資源小圖標</td>
                                        <td>
                                            <input name="imageUrl" type="text" value="<?php echo $resource->getImageUrl(); ?>" style="width:300px"/>
                                        </td>
                                    </tr>                                                                    
                                    <tr>
                                        <td>備註</td>
                                        <td>
                                            <input name="remarks" type="text" value="<?php echo $resource->getRemarks(); ?>" style="width:300px"/>
                                        </td>
                                    </tr>                          
                                    <tr>
                                        <td>上次更新時間</td>
                                        <td>
                                            <input name="lastUpdate" type="text" value="<?php echo $resource->getLastUpdate(); ?>" style="width:300px" readonly="readonly"/>
                                        </td>
                                    </tr>   
                                    <tr>
                                        <td colspan="2">
                                            <input name="submit" type="submit" value="提交" />
                                            <input name="goBack" type="button" value="返回上一頁" onclick="history.go(-1);return true;" />
                                        </td>
                                    </tr>
                                                      
                                </tbody>
                            </table>
                            <!-- param field to determine the command class method -->
                            <input name="param" type="hidden" value="<?php echo (is_null($resource->getSid()) ? Param::$INSERT : Param::$UPDATE) ?>" >
                            
                        </form>
                    
                    </div>

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