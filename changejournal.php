<!DOCTYPE html>
<html>
<head>	
	<title></title>
</head>
<body>
	
	<?php
		require 'php/journal.php';
		require  'php/dblocation.php';
		$connect = new dblocation('pcmaster', 'root', '', 'clients', 'localhost');
		echo Journal::get_form('php/tojournal.php','php/showjournal.php');
	?>
		
</body>
</html>