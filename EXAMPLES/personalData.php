<html>
	<body>
<?php

	$link = mysql_connect('localhost', 'ehalpern', 'Bison') or die('Could not connect: '.mysql_error());
	
	echo "Successfully connected!\n";
	
	mysql_select_db('ehalpern');
	
	$query = 'SELECT * from personalData';
	
	$result = mysql_query($query) or die('Query failed: '.mysql_error());

	echo '<table border = 1>';

	while($row = mysql_fetch_assoc($result))
	{
		echo '<tr>';
		foreach($row as $col)
		{
			echo '<td>'.$col.'</td>';
		}
		echo '</tr>';
	}
	echo '</table>';
?>
	</body>
</html>