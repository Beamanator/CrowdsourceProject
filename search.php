<html>
<head>
  <title>Search For Event</title>
  <link rel="stylesheet" type="text/css" href="format.css">
</head>

<body>
<?php
	require('header.php');
?>

<h1>Event Search</h1>

<div class="generic_form">
	<form action="search_results.php" method="get">
	<table class="login">
		<tr>
			<td>Event Name</td>
			<td align="center"><input type="text" name="eventname" size="20"
			 maxlength="20" autocomplete="off" /></td>
		</tr>
		<tr>
			<td>Event Tag</td>
			<td align="center"><input type="text" name="eventtag" size="10"
			 maxlength="100" autocomplete="off" /></td>		
		</tr>
	</table>
	<label for="pastSearch">Search past events</label>
	<input type="checkbox" name="pastSearch" value="yes">
	<br>
	<br>
	<td align="center"><input type="submit" value="Search" /></td>
	</form>
	<br><br>
</div>

<h1>Upcoming Events</h1>
<table class="login">
	<tr>
	<th>Event Name</th>
	<th>Date</th>
	<th>Time</th>
	<th>Location</th>
	<th>Tag</th>
	<th>Submitter</th>
	<?php
		if(isset($_SESSION['login_active']))
		echo "<th></th>";
	?>
	</tr>
<?php
	$query = 'select * from events order by date;';
	$result = $db->query($query);
	$today = date("Y-m-d");
	$now = date("H:i:s");
	for($i=0; $i<$result->num_rows && $i<10; $i++) {
		$row = $result->fetch_assoc();
		echo "<tr>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['date']."</td>";
		echo "<td>".$row['time']."</td>";
		echo "<td>".$row['location']."</td>";
		echo "<td>".$row['tag']."</td>";

		$query = 'select username from users where userid='.$row['submitter_id'].';';
		$submitter_result = $db->query($query);
		$submitter_row = $submitter_result->fetch_assoc();

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
	}
?>
</table><br><br>
<?php
	require('footer.php');
?>
</body>
</html>