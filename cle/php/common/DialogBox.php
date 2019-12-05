<?php
	class DialogBox
	{
		public function __construct()
		{
			
		}
		public function genAlertBox($_message, $_confirmUrl)
		{
			echo
			'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">' . 	
			'<head>' .
			'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>'.				
			'<script type="text/javascript" src="../../pages/javascript/jqueryUI/js/jquery-1.5.1.min.js"></script>'.
			'<script type="text/javascript" src="../../pages/javascript/jqueryUI/js/jquery-ui-1.8.11.custom.min.js"></script>'.
			'<link href="../../pages/javascript/jqueryUI/css/ui-lightness/jquery-ui-1.8.11.custom.css" rel="stylesheet" type="text/css" />'.
			'</head>' .
			'<body>' .	
			'<script>
				alert("' . $_message . '");window.location="'. $_confirmUrl . '";
			</script>' .
			'</body>'.
			'</html>'
			;			
		}
		public function genDialogBox($_message, $_title, $_confirmUrl)
		{
			echo
			'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">' . 	
			'<head>' .
			'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>'.				
			'<script type="text/javascript" src="../../pages/javascript/jqueryUI/js/jquery-1.5.1.min.js"></script>'.
			'<script type="text/javascript" src="../../pages/javascript/jqueryUI/js/jquery-ui-1.8.11.custom.min.js"></script>'.
			'<link href="../../pages/javascript/jqueryUI/css/ui-lightness/jquery-ui-1.8.11.custom.css" rel="stylesheet" type="text/css" />'.
			'</head>' .
			'<body>' .	
			'<div id="dialog" title="'.$_title.'">
				<p>'. $_message .'</p>
				<a href="'. $_confirmUrl .'" class="customDialog"><input type="button" value="確定"></a>
			</div>'.
			'<script>
				$(function() {
					$( "#dialog" ).dialog();
				});
			</script>' .
			'</body>'.
			'</html>'
			
			
			;

		}
		
	}

?>