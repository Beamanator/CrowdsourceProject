<html>
<head>
	<title>Registration</title>
</head>
<body>

<?php
	@ $db = new mysqli('localhost', 'root', '', 'test');
	if (mysqli_connect_errno()) {
		echo 'Error: Database connection. Try again later.';
		exit;
	}
	
	session_start();
?>

<h1>Registration Details</h1>

<a href="loginpage.php">Return to login</a>

<?php
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
		
	// Check magic quotes
	if (!get_magic_quotes_gpc()) {
		$username = addslashes($username);
		$password = addslashes($password);
	}
		
	// Ensure user/password are valid
	if(!$username) {
		echo "<p>Error: No username entered</p>";
		exit;
	}
	if(!$password) {
		echo "<p>Error: No password entered</p>";
		exit;
	}
	else if(strlen($password) < 6) {
		echo "<p>Error: password must be at least 6 characters long</p>";
		exit;
	}

	
	// Make table if it doesn't exist (first user)
	$query = "create table if not exists users
			(userid int unsigned not null auto_increment primary key,
			username char(20) not null,
			password char(20) not null);";
	$db->query($query);
	
	// Check if username is already taken
	$query = "select username from users;";
	$result = $db->query($query);
	for($i = 0; $i < $result->num_rows; $i++) {
		$element = $result->fetch_assoc();
		if(stripslashes($element['username']) == $username) {
			echo "<p>Error: username already taken.</p>";
			exit;
		}
	}
	
	// Insert user
	$query = "insert into users (username, password) values (?, ?)";
	$stmt = $db->prepare($query);
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
	
	echo "<p>Registration successful for user ".$username."</p>";
?>

</body>
</html>