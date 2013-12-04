<html>
<head>
	<title>Event Registration</title>
	<link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>

<h1>Event Registration</h1>

<?php
	$event_id = $_POST['event_id'];
	$query = 'select name, eventid from events where eventid='.$event_id.';';
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	$event_name = $row['name'];
	
	// UserID - EventID table
	$query = "create table if not exists user_events
			( reg_id int unsigned not null auto_increment primary key,
			  userid int unsigned not null,
			  eventid int unsigned not null);";
	$db->query($query);
	
	// Check if user is already registered
	$query = 'select * from user_events where userid=\''.$_SESSION['userid'].'\' and eventid='.$event_id.';';
	$result = $db->query($query);
	if($result->num_rows != 0) {
		echo '<p>You are already registered for this event.</p>';
		require('footer.php');
		exit;
	}
	
	// Add userid - eventid entry to user_events table
	$query = 'insert into user_events (userid, eventid) values (?, ?)';
	$stmt = $db->prepare($query);
	$stmt->bind_param("ii", $_SESSION['userid'], $event_id);
	$stmt->execute();
	
	echo "<p>Successfully registered for event</p>";
	echo "<p>Username: ".$_SESSION['username']."<br>";
	echo "Event: ".$event_name."</p>";

	require('footer.php');
?>

</body>
</html>