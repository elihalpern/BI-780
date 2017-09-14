<?php
	$lastname = '';
	$firstname = '';
	
	if ($_GET['lastname']) { $lastname = $_GET['lastname'] ;}
	if ($_GET['firstname']) { $firstname = $_GET['firstname'] ;}
	
	if(! $lastname)
	{
?>
	<html><body><h1>Need last name of player, at least!</h1></body></html>
<?php
	exit() ;
	}
	
	if($firstname)
	{
		$url = $url."/".$firstname;
	}
	
	$url = "http://api.suredbits.com/nfl/v0/players/".$lastname;
	
	$json = file_get_contents($url);
	$data = json_decode($json);
	
	
?>

	<html>
	<body>
		<h1>Found these players for URL = <?php echo $url ?></h1>
		<p><?php echo $json ?></p>
		<p><?php var_dump($data)?></p>
<?php
	foreach($data as $player)
	{
		$full = $player->fullName;
		echo "<h2> Full name: $full </h2>" ;
		
	}
?>
	</body>
	</html>