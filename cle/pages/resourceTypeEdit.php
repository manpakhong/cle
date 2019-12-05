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
    <?php
        require_once($currentDir . 'pages/resourceTypeEdit_code.php');	
		
		if (!is_null($resourceTypeEdit->getAccordionSelect()) && !is_null($resourceTypeEdit->getCurrentSelectNode()))
		{
			echo '<script type="text/javascript">var accordionSelect = '. $resourceTypeEdit->getAccordionSelect() . '; var currentSelectNode = ' . $resourceTypeEdit->getCurrentSelectNode(). ';</script>';		
		}
		else
		{
			echo '<script type="text/javascript">var accordionSelect = null; var currentSelectNode = null;</script>';	
		}
    ?>
	<script type="text/javascript" src="javascript/resourceTypeEdit.js"></script>
    <link href="css/collapseDiv.css" rel="stylesheet" type="text/css" />
    <link href="css/accordion.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../expandableTree/mktree.js"></script>
	<link href="../expandableTree/mktree.css" rel="stylesheet" type="text/css" />    
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
                        <div class="expandableDiv">
                          <p class="heading">分類樹</p>
                          <div id="resourceTypeEdit" class="content">	
                            <?php						
                                $expandableTreeResourceType = new ExpandableTreeResourceType();
                                $expandableTreeResourceType->getMenu();
                            ?>
        
                          </div>
                        </div>  
                        <div>現在所在樹幹 
							<?php 
							//$resourceTypeEdit->genResourceTypeDropDownListJScript();
							$resourceTypeEdit->genResourceTypeDropDownList(); ?>
                        </div>                		
                    
                        <div id="accordion" class="accordionDiv">
                            <h3>新增</h3>
                            <div>
                                <form id="insertResourceTypeForm" action= <?php echo  '"../php/command/ResourceTypeCmd.php?'. ResourceTypeEditParam::$ACCORDION_SELECT .'=0"' ?> method="post">
                                    <table width="100%" border="0">
                                      <tr>
                                        <td>Sid</td>
                                        <td><input id="sidInsert" name="sid" type="text" readonly="true"  /></td>
                                      </tr>
                                      <tr>
                                        <td>排序</td>
                                        <td><input id="seqInsert" name="seq" type="text" class="validate[required,custom[integer]]" /></td>
                                      </tr>
                                      <tr>
                                        <td>階層</td>
                                        <td><input id="lvInsert" name="lv" type="text" readonly class="validate[required]" /></td>
                                      </tr>
                                      <tr>
                                        <td>分類名稱</td>
                                        <td><input id="lvTextInsert" name="lvText" type="text" class="validate[required]" /></td>
                                      </tr>
                                      <tr>
                                        <td>上層 Sid</td>
                                        <td><input id="upLvSidInsert" name="upLvSid" type="text" readonly class="validate[required]" /></td>
                                      </tr>
                                      <tr>
                                        <td>顯示</td>
                                        <td>
                                          <label>
                                            <input type="radio" name="isShown" value="true" id="isShownInsert_0" checked="checked" />
                                            是</label>
                                          <label>
                                            <input type="radio" name="isShown" value="false" id="isShownInsert_1" />
                                            否</label>
                                        </td>
                                      </tr>
                                     <tr>
                                        <td>可點擊(非管理用戶)</td>
                                        <td>
                                          <label>
                                            <input type="radio" name="isNetvigated" value="true" id="isNetvigatedInsert_0" checked="checked" />
                                            是</label>
                                          <label>
                                            <input type="radio" name="isNetvigated" value="false" id="isNetvigatedInsert_1" />
                                            否</label>
                                        </td>
                                      </tr>     
                                      <!--                         
                                      <tr style="visibility:hidden;">
                                        <td>Url</td>
                                        <td><input id="urlInsert" name="url" type="text" /></td>
                                      </tr>
                                      -->
                                      <input id="urlInsert" name="url" type="hidden" />
                                      <tr>
                                        <td>備註</td>
                                        <td><input id="remarksInsert" name="remarks" type="text" /></td>
                                      </tr>
                                      <tr>
                                        <td>最後更新日期</td>
                                        <td><input id="lastUpdateInsert" name="lastUpdate" type="text" readonly="true" /></td>
                                      </tr>
                                      <tr>
                                        <td rowspan="2">
                                            <input type="submit" value="提交" />
                                        </td>
                                      </tr>
                                      
                                    </table>
                                    <input name="<?php echo PostParam::$POST_PARAM ?>" value="<?php echo Param::$INSERT ?>" type="hidden" />
                                </form>
                            </div>
                            <h3>更改</h3>
                            <div>
                                <form id="updateResourceTypeForm" action=<?php echo  '"../php/command/ResourceTypeCmd.php?'. ResourceTypeEditParam::$ACCORDION_SELECT .'=1"' ?> method="post">
                                    <table width="100%" border="0">
                                      <tr>
                                        <td>Sid</td>
                                        <td><input id="sidUpdate" name="sid" type="text" readonly="true" class="validate[required,custom[integer]]" /></td>
                                      </tr>
                                      <tr>
                                        <td>排序</td>
                                        <td><input id="seqUpdate" name="seq" type="text" class="validate[required,custom[integer]]" /></td>
                                      </tr>
                                      <tr>
                                        <td>階層</td>
                                        <td><input id="lvUpdate" name="lv" type="text" readonly="readonly" class="validate[required]" /></td>
                                      </tr>
                                      <tr>
                                        <td>分類名稱</td>
                                        <td><input id="lvTextUpdate" name="lvText" type="text" class="validate[required]" /></td>
                                      </tr>
                                      <tr>
                                        <td>上層 Sid</td>
                                        <td><input id="upLvSidUpdate" name="upLvSid" readonly="readonly" type="text" class="validate[required]" /></td>
                                      </tr>
                                      <tr>
                                        <td>顯示</td>
                                        <td>
                                          <label>
                                            <input type="radio" name="isShown" value="true" id="isShownUpdate_0" checked="checked" />
                                            是</label>
                                          <label>
                                            <input type="radio" name="isShown" value="false" id="isShownUpdate_1" />
                                            否</label>
                                        </td>
                                      </tr>
                                     <tr>
                                        <td>可點擊(非管理用戶)</td>
                                        <td>
                                          <label>
                                            <input type="radio" name="isNetvigated" value="true" id="isNetvigatedUpdate_0" checked="checked" />
                                            是</label>
                                          <label>
                                            <input type="radio" name="isNetvigated" value="false" id="isNetvigatedUpdate_1" />
                                            否</label>
                                        </td>
                                      </tr>                                 
                                      <tr>
                                        <td>Url</td>
                                        <td><input id="urlUpdate" name="url" type="text" /></td>
                                      </tr>
                                      <tr>
                                        <td>備註</td>
                                        <td><input id="remarksUpdate" name="remarks" type="text" /></td>
                                      </tr>
                                      <tr>
                                        <td>最後更新日期</td>
                                        <td><input id="lastUpdateUpdate" name="lastUpdate" type="text" readonly="true" /></td>
                                      </tr>
                                      <tr>
                                        <td rowspan="2">
                                            <input type="submit" value="提交" />
                                        </td>
                                      </tr>
                                      
                                    </table>
                                    <input id="deleteResourceTypeForm" name="<?php echo PostParam::$POST_PARAM ?>" value="<?php echo Param::$UPDATE ?>" type="hidden" />							
                                </form>
                            </div>
                            <h3>刪除</h3>
                            <div>
                                <form action="../php/command/ResourceTypeCmd.php" method="post">
                                    <table width="100%" border="0">
                                      <tr>
                                        <td>Sid</td>
                                        <td><input id="sidDelete" name="sid" type="text" readonly="true" /></td>
                                      </tr>
                                      <tr>
                                        <td>排序</td>
                                        <td><input id="seqDelete" name="seq" type="text" readonly="true" /></td>
                                      </tr>
                                      <tr>
                                        <td>階層</td>
                                        <td><input id="lvDelete" name="lv" type="text" readonly="true" /></td>
                                      </tr>
                                      <tr>
                                        <td>分類名稱</td>
                                        <td><input id="lvTextDelete" name="lvText" type="text" readonly="true" /></td>
                                      </tr>
                                      <tr>
                                        <td>上層 Sid</td>
                                        <td><input id="upLvSidDelete" name="upLvSid" type="text" readonly="true" /></td>
                                      </tr>
                                      <tr>
                                        <td>顯示</td>
                                        <td>
                                          <label>
                                            <input type="radio" name="isShown" value="true" id="isShownDelete_0" checked="checked" disabled="disabled" />
                                            是</label>
                                          <label>
                                            <input type="radio" name="isShown" value="false" id="isShownDelete_1" readonly="true" disabled="disabled" />
                                            否</label>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>可點擊(非管理用戶)</td>
                                        <td>
                                          <label>
                                            <input type="radio" name="isNetvigated" value="true" id="isNetvigatedDelete_0" checked="checked" disabled="disabled" />
                                            是</label>
                                          <label>
                                            <input type="radio" name="isNetvigated" value="false" id="isNetvigatedDelete_1" readonly="true" disabled="disabled" />
                                            否</label>
                                        </td>
                                      </tr>                                 
                                      <tr>
                                        <td>Url</td>
                                        <td><input id="urlDelete" name="urlDelete" type="text" readonly="true" /></td>
                                      </tr>
                                      <tr>
                                        <td>備註</td>
                                        <td><input id="remarksDelete" name="remarksDelete" type="text" readonly="true" /></td>
                                      </tr>
                                      <tr>
                                        <td>最後更新日期</td>
                                        <td><input id="lastUpdateDelete" name="lastUpdateDelete" type="text" readonly="true" /></td>
                                      </tr>
                                      <tr>
                                        <td rowspan="2">
                                            <input type="submit" value="提交" />
                                        </td>
                                      </tr>
                                      
                                    </table>
                                    <input name="<?php echo PostParam::$POST_PARAM ?>" value="<?php echo Param::$DELETE ?>" type="hidden" />								
                                </form>
                            </div>
                        </div>
                    
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