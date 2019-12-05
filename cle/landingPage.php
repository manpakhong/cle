<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>

    <script type="text/javascript" src="pages/javascript/jquery-1.5.1.js"></script>
    <script type="text/javascript" src="superfish-1.4.8/js/hoverIntent.js"></script>
	<script type="text/javascript" src="superfish-1.4.8/js/superfish.js"></script>
    <script type="text/javascript" src="pages/javascript/common.js"></script>
    <script type="text/javascript" src="pages/javascript/jqueryUI/js/jquery-ui-1.8.11.custom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="pages/css/template.css" />
	<link rel="stylesheet" type="text/css" href="pages/css/superfish.css" media="screen" />         

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
		require_once($currentDir.'php/command/ResourceCmd.php');
		require_once($currentDir.'php/common/TreeBranch.php');		
	?>    
	<script type="text/javascript" src="pages/javascript/landingPage.js"></script>
	<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
	<link href="pages/css/landingPage.css" rel="stylesheet" type="text/css" />
	<link href="pages/css/table.css" rel="stylesheet" type="text/css" />
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
                    <div class="EditSubDiv">
                        <div style="height: 5px"></div>
                    	<div id="topIndicatorDiv" class="topIndicatorDiv"> 
                        	頁首
                        </div>
                    	<div id="sideDiv" class="sideMenuDiv">
                            <div id="sideUpperLogoDiv" class="sideUpperLogoDiv">
                              <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="246" height="205" id="FlashID" title="讀,寫,聽,說">
                                <param name="movie" value="pages/flash/chiReadWriteListenSpeak.swf" />
                                <param name="quality" value="high" />
                                <param name="wmode" value="opaque" />
                                <param name="swfversion" value="6.0.65.0" />
                                <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
                                <param name="expressinstall" value="Scripts/expressInstall.swf" />
                                <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
                                <!--[if !IE]>-->
                                <object type="application/x-shockwave-flash" data="pages/flash/chiReadWriteListenSpeak.swf" width="246" height="205">
                                  <!--<![endif]-->
                                  <param name="quality" value="high" />
                                  <param name="wmode" value="opaque" />
                                  <param name="swfversion" value="6.0.65.0" />
                                  <param name="expressinstall" value="Scripts/expressInstall.swf" />
                                  <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                                  <div>
                                    <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                                    <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
                                  </div>
                                  <!--[if !IE]>-->
                                </object>
                                <!--<![endif]-->
                              </object>
                            </div>
                            <div id="floatingMenu" class="floatingMenuDiv">
								<div id="floatingMenuUpperDiv" class="floatingMenuUpperDiv">
                                	<p style="color:white; padding-top:8px">關於本站</p>
                                    本網站由教育局資訊科技組負責管理，旨在：<br /><br/>
                                    <ul>
                                    <li>
                                    培養同學獲取知識、建構知識、運用知識、自我監控的能力。
                                    </li>
                                    <li>
                                    提高同學語文自學的興趣，養成良好的語文自學態度和習慣。
                                    </li>
                                    <li>
                                    以課程為本，提供本局及網上免費的學習資源的超連結，幫助同學有系統地學習中國語文有關知識。</li>
                                    </ul>            
                                    網站主要根據教育局中國語文教育課程內容作架構參考。學習資源以「閱讀」、「寫作」、「聆聽」、「說話」、「文學」、「中華文化」及「語文學習基礎知識」分類。<br />
                                    <hr />
                                    <span style="font-size:10px">
                                    <p style="color: #656565">聯絡我們</p>
                                    如有任何查詢，歡迎電郵至 <a href="mailto:sssitec@edb.gov.hk">sssitec@edb.gov.hk</a> 與本組聯絡。
                                    </span> 
                                </div>
								<div id="floatingMenuLowerDiv" class="floatingMenuLowerDiv">
                                </div>
                            </div> <!-- floatingMenu -->
                        </div> <!-- sideDiv -->              

                        <div id="rightTableDiv" class="rightTableDiv">
                        	<div id="topHighLightDiv" class="topHighLightDiv">
                                <div id="topHighLightUpperDiv" class="topHighLightUpperDiv">
                                	<table id="contentTable" width="100%" class="FreezeHeaderTableContent">
                                    	<thead>
                                          <tr>
                                            <td align="center">語文學習基礎知識</td>
                                            <td align="center">閱讀</td>
                                            <td align="center">寫作</td>
                                          </tr>                                             
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td valign="top">
												<?php
                                                    $treeBranch1 = new TreeBranch();
                                                    $treeBranch1->getBranchNodesByRootName('語文學習基礎知識');
                                                ?>                                            
                                            </td>
                                            <td valign="top"> 
												<?php
                                                    $treeBranch2 = new TreeBranch();
                                                    $treeBranch2->getBranchNodesByRootName('閱讀');
                                                ?>                                              
                                            </td>
                                            <td valign="top">
												<?php
                                                    $treeBranch3 = new TreeBranch();
                                                    $treeBranch3->getBranchNodesByRootName('寫作');
                                                ?>  
                                            </td>
                                          </tr>                                        
                                        </tbody>
                                    	<thead>
                                          <tr>
                                            <td align="center">聆聽</td>
                                            <td align="center">說話</td>
                                            <td align="center">文學</td>
                                          </tr>                                             
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td valign="top">
												<?php
                                                    $treeBranch4 = new TreeBranch();
                                                    $treeBranch4->getBranchNodesByRootName('聆聽');
                                                ?>                                            
                                            </td>
                                            <td valign="top"> 
												<?php
                                                    $treeBranch5 = new TreeBranch();
                                                    $treeBranch5->getBranchNodesByRootName('說話');
                                                ?>                                              
                                            </td>
                                            <td valign="top">
												<?php
                                                    $treeBranch6 = new TreeBranch();
                                                    $treeBranch6->getBranchNodesByRootName('文學');
                                                ?>  
                                            </td>
                                          </tr>                                        
                                        </tbody>                                      
                                        <thead>
                                        	<tr>
                                            	<td align="center">中華文化</td>
                                                <td align="center">其他網站連結</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<tr>
                                            	<td>
													<?php
                                                        $treeBranch7 = new TreeBranch();
                                                        $treeBranch7->getBranchNodesByRootName('中華文化');
                                                    ?>                                                  </td>
                                                <td>
												<?php
                                                    $treeBranch8 = new TreeBranch();
                                                    $treeBranch8->getBranchNodesByRootName('其他網站連結');
                                                ?>                                                  
                                                </td>
                                                <td>
                                                </td>
                                            </tr>                                        
                                        </tbody>                                      

                                    </table>


                                </div>
                                <div id="topHighLightLowerDiv" class="topHighLightLowerDiv">
                                </div>                                
                            </div> <!-- topHighLightUpperDiv -->
                        	<div id="rightBottomDiv" class="rightBottomDiv">
                                <div id="recommendResDiv" class="recommendResDiv">
                                	推介資源
                                </div>
                            	<table style="width:100%">
                                	<tr>
                                    	<td style="width:50%">
                                        	<div class="lrightBottomTableCell">
                                            	
                                            </div>

                                            <div class="rightBottomTableCellUpDiv">
                                            資源一</div>
                                            <div class="rightBottomTableCellDownDiv">
                                            資源內容, 資源內容, 資源內容,資源內容,資源內容.
                                            </div>

  
                                        </td>
                                        <td style="width:50%">
                                        	<div class="lrightBottomTableCell">
                                            	
                                            </div>                                        
                                        	<div class="rightBottomTableCellUpDiv">資源二</div>
                                        	<div class="rightBottomTableCellDownDiv">
                                            資源內容, 資源內容, 資源內容,資源內容,資源內
                                        	</div>                                         
                                        </td>
                                    </tr>
                                	<tr>
                                    	<td>
                                        	<div class="lrightBottomTableCell">
                                            	
                                            </div>  
                                        	<div class="rightBottomTableCellUpDiv">資源三</div>
                                        	<div class="rightBottomTableCellDownDiv">
                                            資源內容, 資源內容, 資源內容,資源內容,資源內
                                        	</div>                                         
                                        </td>
                                        <td>
                                        	<div class="lrightBottomTableCell">
                                            	
                                            </div>  
                                        	<div class="rightBottomTableCellUpDiv">資源四</div>
                                        	<div class="rightBottomTableCellDownDiv">
                                            資源內容, 資源內容, 資源內容,資源內容,資源內
                                        	</div>                                         
                                        </td>
                                    </tr>
                                	<tr>
                                    	<td>
                                        	<div class="lrightBottomTableCell">
                                            	
                                            </div>  
                                        	<div class="rightBottomTableCellUpDiv">資源五</div>
                                        	<div class="rightBottomTableCellDownDiv">
                                            資源內容, 資源內容, 資源內容,資源內容,資源內
                                        	</div>                                         
                                        </td>
                                        <td>
                                        	<div class="lrightBottomTableCell">
                                            	
                                            </div>  
                                        	<div class="rightBottomTableCellUpDiv">資源六</div>
                                        	<div class="rightBottomTableCellDownDiv">
                                            資源內容, 資源內容, 資源內容,資源內容,資源內
                                        	</div>                                         
                                        </td>
                                    </tr>                                                                        
                                </table>
                            </div>                         		
                        </div> <!-- rightTableDiv --> 
        
                  </div> <!-- EditSubDiv -->

				  <script type="text/javascript">
swfobject.registerObject("FlashID");
                  </script>
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