<html>
<head>
	<title>Event Added</title>
	<link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>
   <h1>Submission Details</h1>

   <?php
	$name = $_POST['eventname'];
	$date = $_POST['eventdate'];
	$time = $_POST['eventtime'];
	$loc = $_POST['eventloc'];
	$tag = $_POST['eventtag'];
	$submitter_id = $_POST['user_id'];
	
	// Create events table if it doesn't exist
	$query = "create table if not exists events
			( eventid int unsigned not null auto_increment primary key,
			name char(25) not null,
			date char(25) not null,
			time char(25) not null,
			location char(100) not null,
			submitter_id int unsigned not null,
			tag char(25) not null);";
	$db->query($query);
	
	// Create tags table if it doesn't exist
	$query = "create table if not exists tags
			( tagid int unsigned not null auto_increment primary key,
			name char(25) not null,
			amount int unsigned not null);";
	$db->query($query);
	
	// Ensure event date/time is after submission date/time
	$today = date("Y-m-d");
	$now = date("H:i:s");
	$err_msg = "<p>Error: event date/time has already passed</p>";
	if($date < $today || ($date == $today && $time < $now)) {
		echo $err_msg;
		exit;
	}
	
	// Insert event
	$query = "insert into events (name, date, time, location, tag, submitter_id) values (?, ?, ?, ?, ?, ?)";
	$stmt = $db->prepare($query);
	$stmt->bind_param("sssssd", $name, $date, $time, $loc, $tag, $submitter_id);
	$stmt->execute();
	
	echo "<p>Name: ".$name."<br>";
	echo "Date: ".$date."<br>";
	echo "Time: ".$time."<br>";
	echo "Location: ".$loc."<br>";
	echo "Tag: ".$tag."<br></p>";
	
	// Update tags table
	$query = "select * from tags";
	$result = $db->query($query);
	$updated = 0;
	for($i = 0; $i < $result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		if(strcasecmp($tag, $row['name']) == 0) {
			$query = "update tags set amount=".($row['amount']+1)." where name='".$row['name']."';";
			$db->query($query);
			$updated = 1;
			break;
		}
	}
	if(!$updated) {
		$query = "insert into tags values (NULL,'".$tag."',1);";
		$db->query($query);
	}
   ?>
<?php
	require('footer.php');
?>

</body>
</html>