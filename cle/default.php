<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=MS950">
	<title>Sample CKEditor Site</title>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <?php 
		include_once 'default_code.php'; 
	?>
</head>
<body onLoad="<?php $webRefPage->onPageLoad(event) ?>">
	<img src="pages/img/ckeditor.png"/>
	<form method="post" action="php/command/WebRefCmd.php">
		<div>
			Web Site:
			<textarea id="txtWebSite" name="webSite"></textarea> <br />
			Type:
			<textarea id="txtType" name="type"></textarea> <br />			
			Remarks:
			<textarea id="txtRemarks" name="remarks"></textarea> <br />
			Web Highlight:<br />
			<textarea id="txtaLearningHighLight" name="learningHighLight">
				<?php
					$webRefFilter = new WebRefFilter();
					
					$arrayList = new ArrayList();
				 	$arrayList = WebRefCmd::selectWebRefCmd($webRefFilter);
					
					if ($arrayList->hasNext())
					{
						$webRef = new WebRef();
						$webRef = $arrayList->next();
						echo $webRef->getLearningHighlight();
					}
				?>
			</textarea> <br />
            <input name="Param" type="hidden" value="<?php echo Param::$INSERT ?>" >
			<script type="text/javascript">
				CKEDITOR.replace( 'txtaLearningHighLight',
					    {
        					customConfig : '../pages/javascript/ckeditor_config.js'
					    });
			</script>
			
		</div>
		<div>
			<input type="submit" value="Submit"/>
		</div>

	</form>

</body>
</html>