<?php

	$id = 1;
	$connection = new mysqli("localhost", "root", "edb", "chilangedu");
	$result = $connection->prepare("select * from cle_webref where sid=?");
	$result->bind_param("i", $id);
	$result->execute();
	$result->bind_result($sid, $website, $learninghighlight, $lastupdate, $remarks);
	
	while ($row = $result->fetch()) {
		printf ("%d (%s)\n", $sid, $website);
	}
		
?>