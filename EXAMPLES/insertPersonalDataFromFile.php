<html>
	<body>
<?php

	$fH = fopen($_FILES['datafile']['tmp_name'], 'r');
	
	//var_dump($_FILES);
	
	if(!$fH)
	{
		die('No file found!');
	}
	
	$link = mysql_connect('localhost', 'ehalpern', 'Bison') or die('Could not connect: '.mysql_error());
	
	mysql_select_db('ehalpern');
	
	while( $text = trim(fgets($fH)))
	{
		$words = explode(':', $text);
		$format =  "INSERT INTO personalData VALUES('%s', '%s', '%s')";
		$query = sprintf($format, $words[1], $words[0], $words[2]);
		$result = mysql_query($query) or die('Data insertion failed: '.mysql_error());
	}


?>
	<h1>SUCCESS!</h1>
	</body>
</html>