<html>
<head>
  <title>User Home Page</title>
  <link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>

<h1>Increase Reputation</h1>

<?php
	$inc_userid = $_POST['user_id'];
	
	// Create user - reputation table (so each user can only increase each other user's reputation only once)
	$query = "create table if not exists rep_users
			(pairid int unsigned not null auto_increment primary key,
			 userid int unsigned not null,
			 targetid int unsigned not null);";
	$db->query($query);
	
	// Check if current user has already increased this user's reputation
	$query = "select * from rep_users where userid=".$userid." and targetid=".$inc_userid.";";
	$result = $db->query($query);
	
	if(!$result->num_rows) {
		// Add this user-target entry to rep_users
		$query = "insert into rep_users (userid, targetid) values (?, ?);";
		$stmt = $db->prepare($query);
		$stmt->bind_param("dd", $userid, $inc_userid);
		$stmt->execute();
		
		// Increase target user's reputation by 1
		$query = "select * from users where userid=".$inc_userid.";";
		$result = $db->query($query);
		$row = $result->fetch_assoc();
		$query = "update users set reputation=".($row['reputation']+1)." where userid=".$row['userid'].";";
		$db->query($query);
		echo "<p>Reputation successfully increased!</p>";
	}
	else {
		echo "<p>You have already increased this user's reputation</p>";
	}
	
	echo '<p><a href="userpage.php?userid='.$inc_userid.'">Go back to userpage</a></p>';
?>

<?php
	require('footer.php');
?>
</body>
</html>