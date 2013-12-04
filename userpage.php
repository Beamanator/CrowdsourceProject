<html>
<head>
  <title>User Home Page</title>
  <link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>

<?php

	$realname = "Anonymous";
	$age = "Anonymous";
	$gender = "Anonymous";
	$phone = "Anonymous";
	$email = "Anonymous";
	
	if(isset($_GET['userid']))
		$query = 'select userid,username,realname,age,gender,phone,email,reputation from users where userid=\''.$_GET['userid'].'\';';
	else if(isset($_SESSION['login_active']))
		$query = 'select userid,username,realname,age,gender,phone,email,reputation from users where userid=\''.$_SESSION['userid'].'\';';
	else {
		echo "<h2>Please <a href=\"index.php\">login</a> to view userpage<br>";
		echo "Or <a href =\"user_search.php\">search</a> for a user</h2>";
		require('footer.php');
		exit;
	}
	
		$result = $db->query($query);
		$row = $result->fetch_assoc();
		if($row['realname'])	$realname = $row['realname'];
		if($row['age'] > 0	)	$age = $row['age'];
		if($row['gender'])		$gender = $row['gender'];
		if($row['phone'])		$phone = $row['phone'];
		if($row['email'])		$email = $row['email'];
		$reputation = $row['reputation'];
		$userpage_id = $row['userid'];
		echo "<h1>".$row['username']."'s Userpage</h1>";

?>

	<table class="userinfo">
		<tr>
			<td>Name</td>
			<td id="field"><?php echo $realname ?></td>
		</tr>
		<tr>
			<td>Age</td>
			<td id="field"><?php echo $age ?></td>
		</tr>
		<tr>
			<td>Gender</td>
			<td id="field"><?php echo $gender ?></td>
		</tr>
		<tr>
			<td>Phone</td>
			<td id="field"><?php echo $phone ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td id="field"><?php echo $email ?></td>
		</tr>
		<tr>
			<td>Reputation</td>
			<td id="field"><?php echo $reputation ?></td>
		</tr>
	</table>
	<br>
	<?php
		$query = "select * from rep_users where userid=".$userid." and targetid=".$userpage_id.";";
		$result = $db->query($query);
		if(isset($_SESSION['login_active']) && !$result->num_rows && $userpage_id != $userid) {
			echo '<div class="generic_form">';
			echo '<form action="inc_reputation.php" method="post">';
			echo '<input type="hidden" name="user_id" value="'.$userpage_id.'"/>';
			echo '<input type="submit" value="Increase Reputation!">';
			echo '</form>';
			echo '</div>';
		}
	?>

	<br>
	
	<br><br>
	
	<h1>Upcoming events</h1>
	
	<?php
		if(isset($_GET['userid'])) {
			$query = 'select events.name,events.date,events.time,events.location,events.tag from events, user_events 
				  where user_events.userid='.$_GET['userid'].' 
				  and events.eventid = user_events.eventid;';		
		}
		else {
			$query = 'select events.name,events.date,events.time,events.location,events.tag from events, user_events 
				  where user_events.userid='.$userid.' 
				  and events.eventid = user_events.eventid;';
		}
		$result = $db->query($query);
		
		if($result) {
			echo "<table>";
			echo "<th>Name</th><th>Date</th><th>Time</th><th>Location</th>";
			for($i=0; $i<$result->num_rows && $i < 5; $i++) {
				$row = $result->fetch_assoc();
				echo "<tr>";
				echo "<td>".$row['name']."</td><td>".$row['date']."</td><td>".$row['time']."</td><td>".$row['location']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	?>
	<br><br>
<?php
	require('footer.php');
?>
</body>
</html>