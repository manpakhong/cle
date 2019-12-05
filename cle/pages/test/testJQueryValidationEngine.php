<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../javascript/jquery-1.5.1.js"></script>

<script type="text/javascript" src="../../jQueryValidator/js/languages/jquery.validationEngine-en.js" /></script>
<script type="text/javascript" src="../../jQueryValidator/js/jquery.validationEngine.js"></script>
<link href="../../jQueryValidator/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
<link href="../../jQueryValidator/css/template.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">    
		$(document).ready(function() {
			$("#formID").validationEngine();
		})
    </script>   
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Testing of Vaidation Engine</title>
</head>

<body>

    <form id="formID" class="formular" method="post" action=""> 
        <input value="someone@nowhere.com" class="validate[required,custom[email]]" type="text" name="email" id="email" />
        <input value="2010-12-01" class="validate[required,custom[date]]" type="text" name="date" id="date" />
        <input value="too many spaces obviously" class="validate[required,custom[onlyLetterNumber]]" type="text" name="special" id="special" />
                                	<input id="resourceName" name="resourceName" type="text" value="" style="width:300px" class="validate[required]" />        
    </form>
</body>
</html>