<html>
	<body>
<?php

	$link = mysql_connect('localhost', 'ehalpern', 'Bison') or die('Could not connect: '.mysql_error());
	
	mysql_select_db('ehalpern');
	
	$first = $_POST['FIRST'];
	$second = $_POST['SECOND'];
	$address = $_POST['ADDRESS'];
	$format =  "INSERT INTO personalData VALUES('%s', '%s', '%s')";
	$query = sprintf($format, $first, $second, $address);
	$result = mysql_query($query) or die('Data insertion failed: '.mysql_error());


?>
	<h1>SUCCESS!</h1>
	</body>
</html>