<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script type="text/javascript">
// controls character input/counter
$('textarea#body').keyup(function() {
var charLength = $(this).val().length;
// Displays count
$('span#charCount').html(charLength + ' of 10 characters used');
// Alerts when 250 characters is reached
if($(this).val().length > 10)
$('span#charCount').html('<strong>You may only have up to 10 characters.</strong>');
});
</script>

<body>
	<form>
    	<textarea name="textarea"></textarea>
    </form>
</body>
</html>