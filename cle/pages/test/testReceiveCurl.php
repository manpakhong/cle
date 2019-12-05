<html>
	<body>
		<?php
         if(isset($_POST['Name']))     $Name   = $_POST['Name'];
         if(isset($_POST['Email']))   $Email   = $_POST['Email'];
         if(isset($_POST['Message']))   $Message= htmlentities($_POST['Message']);
         
         echo $Name . '<br/>';
         echo $Email . '<br/>';
         echo $Message . '<br/>';
        ?>
	</body>
</html>