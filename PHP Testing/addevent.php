<html>
<head>
	<title>Event Added</title>
</head>
<body>

<?php
	@ $db = new mysqli('localhost', 'root', '', 'test');
	if (mysqli_connect_errno()) {
		echo 'Error: Database connection. Try again later.';
		exit;
	}
?>

<h1>Submission Details</h1>

<?php
	$name = $_POST['eventname'];
	$date = $_POST['eventdate'];
	$time = $_POST['eventtime'];
	$loc = $_POST['eventloc'];
	
	// Create events table if it doesn't exist
	$query = "create table if not exists events
			( eventid int unsigned not null auto_increment primary key,
			name char(25) not null,
			date char(25) not null,
			time float unsigned not null,
			location char(100) not null);";
	$db->query($query);
	
	// Insert event
	/*$query = "insert into events (name, date, time, location) values (?, ?, ?, ?)";
	$stmt = $db->prepare($query);
	$stmt->bind_param("ssss", $name, $date, $time, $loc);
	$stmt->execute();*/
	
	echo "<p>Name: ".$name."<br>";
	echo "Date: ".$date."<br>";
	echo "Time: ".$time."<br>";
	echo "Location: ".$loc."<br></p>";
?>

</body>
</html>