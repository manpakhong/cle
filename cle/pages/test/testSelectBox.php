<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
    <script type="text/javascript" src="../javascript/jquery-1.5.1.js"></script>
</head>

<body>
	<script type="text/javascript">
	
		obj12 = new Object;
		obj12.id = 32;
		obj12.msg = "hello!";
	
		function displayObj(_obj)
		{
			$("#divText").text("id: " + _obj.id + ",msg: " + _obj.msg);			
		}
		
		$(document).ready(function() { 
			$("select").change(
			function() {
				
				displayObj(eval('obj12'));
   			}
		);
/*
          $("select option:selected").each(function () {
                str += $(this).text() + " ";
              });
*/

	 		$("#abutton").click(function() {
				//alert('click');
				alert($("#ok option:selected").attr("value"));
   			});
		}); 	
	</script>
	<select id="ok">
    	<option value="158">select 1</option>
        <option value="163">select 2 </option>
    </select>
    <input id="abutton" name="" type="button" value="select" />
    <div id="divText">blah</div>
</body>
</html>