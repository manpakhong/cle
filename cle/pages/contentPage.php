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
    <link href="css/contentPage.css" rel="stylesheet" type="text/css" />
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
				<table border="1" cellpadding="0" cellspacing="0" id="tbCHIKLA">
                	<thead>                        
                        <th style="width:18%; text-align:center;"><h2><a href="Basic/index.html">語文學習基礎知識</a></h2></th>
                        <th style="width:14%; text-align:center;"><h2><a href="Read/index.html">閱讀</a> <span class="sss_RLt_RCount"></span></h2></th>
                        <th style="width:15%; text-align:center;"><h2><a href="Write/index.html">寫作</a> <span class="sss_RLt_RCount"></span></h2></th>
                        <th style="width:13%; text-align:center;"><h2><a href="Listen/index.html">聆聽</a> <span class="sss_RLt_RCount"></span></h2></th>
                        <th style="width:13%; text-align:center;"><h2><a href="Speak/index.html">說話</a> <span class="sss_RLt_RCount"></span></h2></th>
                        <th style="width:13%; text-align:center;"><h2><a href="Lit/index.html">文學</a> <span class="sss_RLt_RCount"></span></h2></th>
                        <th style="width:14%; text-align:center;"><h2><a href="Cult/index.html">中華文化</a> <span class="sss_RLt_RCount"></span></h2></th>
                  	</thead>
                  <tr>
                    <td style="text-align:left; vertical-align:top" class="col0 sss_td1_top_noborder"><ul>
                        <li><a href="Basic/BA1/index.html">	漢字形音義</a> <span class="sss_RLt_RCount"></span>          <ul>
                            <li><a href="Basic/BA1/BA1A/index.html">漢字的演變</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Basic/BA1/BA1B/index.html">字形的正體、俗體、異體</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA1/BA1C/index.html">簡化字、繁體字</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA1/BA1D/index.html">漢字的筆順</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA1/BA1E/index.html">普通話聲韻調</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Basic/BA1/BA1G/index.html">粵語聲韻調</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA1/BA1F/index.html">六書</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA1/BA1H/index.html">糾正錯別字</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA1/BA1I/index.html">一字多音</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Basic/BA1/BA1J/index.html">一字多義</a> <span class="sss_RLt_RCount"></span></li>
                          </ul>
                        </li>
                        <li><a href="Basic/BA2/index.html">詞匯</a> <span class="sss_RLt_RCount"></span>          <ul>
                            <li><a href="Basic/BA2/BA2A/index.html">實詞</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Basic/BA2/BA2B/index.html">虛詞</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA2/BA2C/index.html">單純詞、合成詞</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA2/BA2D/index.html" class="sss_noresource">詞的本義、引申義</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA2/BA2E/index.html">同義詞、近義詞</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Basic/BA2/BA2G/index.html" class="sss_noresource">詞的感情色彩</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA2/BA2F/index.html">口語、書面語、外來語</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA2/BA2H/index.html" class="sss_noresource">著色詞、擬聲詞、疊詞</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA2/BA2I/index.html">成語</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Basic/BA2/BA2J/index.html">歇後語、慣用語、諺語</a> <span class="sss_RLt_RCount"></span></li>
                          </ul>
                        </li>
                        <li><a href="Basic/BA3/index.html">句子</a> <span class="sss_RLt_RCount"></span>          <ul>
                            <li><a href="Basic/BA3/BA3A/index.html" class="sss_noresource">短語</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Basic/BA3/BA3B/index.html">句子的成分</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA3/BA3C/index.html" class="sss_noresource">單句</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA3/BA3D/index.html" class="sss_noresource">複句</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA3/BA3E/index.html">修改病句</a> <span class="sss_RLt_RCount"></span></li>
                
                          </ul>
                        </li>
                        <li><a href="Basic/BA4/index.html">標點符號</a> <span class="sss_RLt_RCount"></span></li>
                        <li><a href="Basic/BA5/index.html">修辭</a> <span class="sss_RLt_RCount"></span></li>
                        <li><a href="Basic/BA6/index.html">文言知識</a> <span class="sss_RLt_RCount"></span>          <ul>
                
                            <li><a href="Basic/BA6/BA6A/index.html" class="sss_noresource">多音字、破音字</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA6/BA6B/index.html" class="sss_noresource">通假字</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA6/BA6C/index.html" class="sss_noresource">古今異義</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA6/BA6D/index.html">一詞多義</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Basic/BA6/BA6E/index.html">詞類活用</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA6/BA6G/index.html">文言實詞</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA6/BA6F/index.html">文言虛詞</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA6/BA6H/index.html">文言句式</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Basic/BA6/BA6I/index.html">文言語譯</a> <span class="sss_RLt_RCount"></span></li>
                          </ul>
                        </li>
                        <li><a href="Basic/BA7/index.html">常用工具書</a> <span class="sss_RLt_RCount"></span>          <ul>
                            <li><a href="Basic/BA7/BA7A/index.html">工具書簡介</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Basic/BA7/BA7B/index.html">常用檢字法</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Basic/BA7/BA7C/index.html">中文輸入法</a> <span class="sss_RLt_RCount"></span></li>
                          </ul>
                        </li>
                      </ul></td>
                    <td style="text-align:left; vertical-align:top" class="col1 sss_td1_top_noborder"><ul>
                
                        <li><a href="Read/RE1/index.html">參考篇章(初中)</a> <span class="sss_RLt_RCount"></span>          <ul>
                            <li style="list-style-type:square"><a href="javascript:void(0)" class="btnCHIKLA sss_color1_text" style="font-weight:bold">參考篇章(初中)列表</a></li>
                          </ul>
                        </li>
                        <li><a href="Read/RE2/index.html">閱讀材料</a> <span class="sss_RLt_RCount"></span>          <ul>
                
                            <li><a href="Read/RE2/RE2Q/index.html">文言</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2A/index.html">敘述</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2B/index.html">描寫</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2C/index.html">抒情</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Read/RE2/RE2D/index.html">說明</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2E/index.html" class="sss_noresource">議論</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2G/index.html">寓言/童話</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2F/index.html">詩歌</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Read/RE2/RE2H/index.html">小說</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2I/index.html">戲劇</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2J/index.html">翻譯作品</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2K/index.html">科普作品</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Read/RE2/RE2L/index.html">實用文字</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2M/index.html">報紙/雜誌</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2N/index.html">視聽資訊</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Read/RE2/RE2O/index.html">作家網誌</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Read/RE2/RE2P/index.html">其他</a> <span class="sss_RLt_RCount"></span></li>
                          </ul>
                        </li>
                        <li><a href="Read/RE3/index.html">閱讀策略</a> <span class="sss_RLt_RCount"></span></li>                
                        <li><a href="Read/RE5/index.html">中文廣泛閱讀計劃</a> <span class="sss_RLt_RCount"></span></li>
                        <li><a href="Read/RE8/index.html" class="sss_noresource">閱讀評估</a> <span class="sss_RLt_RCount"></span></li>
                      </ul></td>
                
                    <td style="text-align:left; vertical-align:top" class="col2 sss_td1_top_noborder"><ul>
                        <li><a href="Write/WR1/index.html">寫作性質</a> <span class="sss_RLt_RCount"></span>          <ul>
                            <li><a href="Write/WR1/WR1A/index.html">敘述</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR1/WR1B/index.html">描寫</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Write/WR1/WR1C/index.html">抒情</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR1/WR1D/index.html">說明</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR1/WR1E/index.html">議論</a> <span class="sss_RLt_RCount"></span></li>
                          </ul>
                
                        </li>
                        <li><a href="Write/WR2/index.html">實用文</a> <span class="sss_RLt_RCount"></span>          <ul>
                            <li><a href="Write/WR2/WR2A/index.html">日記、周記、網誌</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2B/index.html">便條、書信</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Write/WR2/WR2C/index.html">啟事</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2D/index.html">通知</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2E/index.html">通告</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2G/index.html">公函</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Write/WR2/WR2F/index.html">演講辭</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2H/index.html">章則</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2I/index.html">說明書</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2J/index.html">專題介紹</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Write/WR2/WR2K/index.html">會議紀錄</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2M/index.html">新聞稿</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2N/index.html">報告</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2R/index.html">建議書</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Write/WR2/WR2S/index.html">評論</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2T/index.html">宣傳文字</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2U/index.html" class="sss_noresource">電子簡報</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR2/WR2L/index.html" class="sss_noresource">其他</a> <span class="sss_RLt_RCount"></span></li>
                
                          </ul>
                        </li>
                        <li><a href="Write/WR3/index.html">其他類型寫作</a> <span class="sss_RLt_RCount"></span>          <ul>
                            <li><a href="Write/WR3/WR3F/index.html">詩歌</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR3/WR3G/index.html" class="sss_noresource">小說</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Write/WR3/WR3H/index.html" class="sss_noresource">戲劇</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR3/WR3A/index.html">造句、寫片段</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR3/WR3B/index.html" class="sss_noresource">看圖作文</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR3/WR3C/index.html" class="sss_noresource">改寫/續寫</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Write/WR3/WR3D/index.html" class="sss_noresource">撮寫/鋪寫</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Write/WR3/WR3E/index.html" class="sss_noresource">其他</a> <span class="sss_RLt_RCount"></span></li>
                          </ul>
                        </li>
                        <li><a href="Write/WR4/index.html">寫作策略</a> <span class="sss_RLt_RCount"></span></li>
                
                        <li><a href="Write/WR7/index.html">寫作評估</a> <span class="sss_RLt_RCount"></span></li>
                      </ul></td>
                
                    <td style="text-align:left; vertical-align:top" class="col3 sss_td1_top_noborder"><ul>
                        <li><a href="Listen/LI1/index.html">聆聽材料</a> <span class="sss_RLt_RCount"></span>          <ul>
                            <li><a href="Listen/LI1/LI1A/index.html" class="sss_noresource">敘述性質</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Listen/LI1/LI1B/index.html" class="sss_noresource">描寫性質</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Listen/LI1/LI1C/index.html" class="sss_noresource">抒情性質</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Listen/LI1/LI1D/index.html" class="sss_noresource">說明性質</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Listen/LI1/LI1E/index.html" class="sss_noresource">議論性質</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Listen/LI1/LI1F/index.html" class="sss_noresource">視聽資訊</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Listen/LI1/LI1G/index.html" class="sss_noresource">對話/報告</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Listen/LI1/LI1H/index.html" class="sss_noresource">演講/訪問</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Listen/LI1/LI1I/index.html" class="sss_noresource">討論/辯論</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Listen/LI1/LI1J/index.html">其他</a> <span class="sss_RLt_RCount"></span></li>
                
                          </ul>
                        </li>
                        <li><a href="Listen/LI2/index.html">聆聽策略</a> <span class="sss_RLt_RCount"></span></li>
                
                        <li><a href="Listen/LI5/index.html" class="sss_noresource">聆聽評估</a> <span class="sss_RLt_RCount"></span></li>
                      </ul></td>
                    <td style="text-align:left; vertical-align:top" class="col4 sss_td1_top_noborder"><ul>
                        <li><a href="Speak/SP1/index.html">說話類型</a> <span class="sss_RLt_RCount"></span>          <ul>
                            <li><a href="Speak/SP1/SP1A/index.html" class="sss_noresource">講故事</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Speak/SP1/SP1B/index.html" class="sss_noresource">報告</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Speak/SP1/SP1C/index.html">演講</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Speak/SP1/SP1D/index.html" class="sss_noresource">對話</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Speak/SP1/SP1E/index.html" class="sss_noresource">訪問</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Speak/SP1/SP1F/index.html" class="sss_noresource">討論</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Speak/SP1/SP1G/index.html" class="sss_noresource">辯論</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Speak/SP1/SP1H/index.html">游說</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Speak/SP1/SP1I/index.html">其他</a> <span class="sss_RLt_RCount"></span></li>
                
                          </ul>
                        </li>
                        <li><a href="Speak/SP2/index.html">說話策略</a> <span class="sss_RLt_RCount"></span></li>
                
                        <li><a href="Speak/SP5/index.html" class="sss_noresource">說話評估</a> <span class="sss_RLt_RCount"></span></li>
                      </ul></td>
                    <td style="text-align:left; vertical-align:top" class="col5 sss_td1_top_noborder"><ul>
                        <li><a href="Lit/LT1/index.html">文學常識</a> <span class="sss_RLt_RCount"></span><ul>
                            <li><a href="Lit/LT1/LT1A/index.html" class="sss_noresource">散文</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Lit/LT1/LT1B/index.html">詩歌</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Lit/LT1/LT1C/index.html" class="sss_noresource">小說</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Lit/LT1/LT1D/index.html" class="sss_noresource">戲劇</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Lit/LT1/LT1E/index.html" class="sss_noresource">其他</a> <span class="sss_RLt_RCount"></span></li>
                
                          </ul></li>
                        <li><a href="Lit/LT2/index.html">文學名著及鑒賞</a> <span class="sss_RLt_RCount"></span><ul>
                            <li><a href="Lit/LT2/LT2A/index.html" class="sss_noresource">散文</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Lit/LT2/LT2B/index.html">詩歌</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Lit/LT2/LT2C/index.html">小說</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Lit/LT2/LT2D/index.html">戲劇</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Lit/LT2/LT2E/index.html" class="sss_noresource">其他</a> <span class="sss_RLt_RCount"></span></li>
                          </ul></li>
                
                        <li><a href="Lit/LT3/index.html">著名作家</a> <span class="sss_RLt_RCount"></span><ul>
                            <li><a href="Lit/LT3/LT3A/index.html">周/春秋/戰國/秦/漢</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Lit/LT3/LT3B/index.html">三國/魏晉南北朝</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Lit/LT3/LT3C/index.html">隋唐五代</a> <span class="sss_RLt_RCount"></span></li>
                
                            <li><a href="Lit/LT3/LT3D/index.html" class="sss_noresource">宋元明清</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Lit/LT3/LT3E/index.html" class="sss_noresource">現代當代</a> <span class="sss_RLt_RCount"></span></li>
                            <li><a href="Lit/LT3/LT3F/index.html" class="sss_noresource">香港作家</a> <span class="sss_RLt_RCount"></span></li>
                          </ul></li>
                
                      </ul></td>
                    <td style="text-align:left; vertical-align:top" class="col6 sss_td1_top_noborder"><ul>
                        <li><a href="Cult/CU1/index.html">文化素材</a> <span class="sss_RLt_RCount"></span></li>
                
                      </ul></td>
                  </tr>
                </table>

				
				
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