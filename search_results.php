<html>
<head>
	<title>Search Results</title>
	<link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>
<h1>Search Results</h1>

<?php
	$name = trim($_GET['eventname']);
	$tag = trim($_GET['eventtag']);
	
	// Create events table if it doesn't exist
	$query = "create table if not exists events
			( eventid int unsigned not null auto_increment primary key,
			name char(25) not null,
			date char(25) not null,
			time char(25) not null,
			location char(100) not null,
			tag char(25) not null);";
	$db->query($query);
	
	// Create past events table if it doesn't exist
	$query = "create table if not exists past_events
			( eventid int unsigned not null auto_increment primary key,
			name char(25) not null,
			date char(25) not null,
			time char(25) not null,
			location char(100) not null,
			tag char(25) not null);";
	$db->query($query);

	// UserID - EventID table
	$query = "create table if not exists user_events
			( reg_id int unsigned not null auto_increment primary key,
			  userid int unsigned not null,
			  eventid int unsigned not null);";
	$db->query($query);
	
	// Search query (include past_events if checked in search form)
	if(isset($_GET['pastSearch']))
		$query = "select * from events UNION select * from past_events;";
	else
		$query = "select * from events order by date;";
	$result = $db->query($query);
	echo "<table><tr>";
	echo "<th>Event Name</th>";
	echo "<th>Date</th>";
	echo "<th>Time</th>";
	echo "<th>Location</th>";
	echo "<th>Tag</th>";
	echo "<th>Submitter</th>";
	if(isset($_SESSION['login_active']))
		echo "<th></th>";
	echo "</tr>";
	
	$result_count = 0;
	
	$case = 0;
	if(!$name && $tag)	$case = 1;
	if($name && $tag)	$case = 2;
	
	// Iterating through event table
	for($i = 0; $i < $result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		$flag = 0;
		
		// Match search field(s)
		switch ($case) {
			case 0:
				if(stripos($row['name'], $name) !== false)	$flag = 1;
				break;
			case 1:
				if(strcasecmp($row['tag'],$tag) == 0)	$flag = 1;
				break;
			case 2:
				if(stripos($row['name'], $name) !== false && strcasecmp($row['tag'],$tag) == 0)	$flag = 1;
				break;
		}
		
		// If event is past, move to past_events and do not display
		$today = date("Y-m-d");
		$now = date("H:i:s");
		if(!isset($_GET['pastSearch']) && ($row['date'] < $today || ($row['date'] == $today && $row['time'] < $now))) {
			// Insert into past_events
			$query = "insert into past_events (name, date, time, location, tag, submitter_id) values (?, ?, ?, ?, ?, ?)";
			$stmt = $db->prepare($query);
			$stmt->bind_param("ssssss", $row['name'], $row['date'], $row['time'], $row['location'], $row['tag'], $row['submitter_id']);
			$stmt->execute();
			
			// Delete from events
			$query = 'delete from events where eventid='.$row['eventid'].';';
			$db->query($query);
			
			// Delete from user_events
			$query = 'delete from user_events where eventid='.$row['eventid'].';';
			$db->query($query);
			
			// Decrement tags entry by 1
			$query = 'select * from tags where name="'.$row['tag'].'";';
			$tag_result = $db->query($query);
			$tag_row = $tag_result->fetch_assoc();
			$query = "update tags set amount=".($tag_row['amount']-1)." where name='".$row['tag']."';";
			$db->query($query);
			
			// Do not display in search results
			$flag = 0;
		}
		
		// Get submitter username
		$query = 'select username from users where userid='.$row['submitter_id'].';';
		$submitter_result = $db->query($query);
		$submitter_row = $submitter_result->fetch_assoc();
		
		// Display search results
		if($flag) {
			echo "<tr>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['date']."</td>";
			echo "<td>".$row['time']."</td>";
			echo "<td>".$row['location']."</td>";
			echo "<td>".$row['tag']."</td>";
			echo '<td><a href="userpage.php?userid='.$row['submitter_id'].'">'.$submitter_row['username'].'</a></td>';
			if(isset($_SESSION['login_active'])) {
				echo "<td>";
				echo '<form action="register_event.php" method="post">';
				
				$query = 'select userid,eventid from user_events where userid='.$userid.' and eventid='.$row['eventid'].';';
				$reg_result = $db->query($query);
				if($reg_result->num_rows) {
					echo "Registered";
				}
				else if(!($row['date'] < $today || ($row['date'] == $today && $row['time'] < $now))) {
					echo '<input type="hidden" name="event_id" value="'.$row['eventid'].'"/>';
					echo '<input type="submit" value="Register">';
				}
				echo '</form>';
				echo "</td>";
			}
			echo "</tr>";
			$result_count++;
		}
	}
	echo "</table><br>";
	echo "<br><p>".$result_count." results</p>";
?>

<?php
	require('footer.php');
?>

</body>
</html>