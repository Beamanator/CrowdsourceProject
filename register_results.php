<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>

<h1>Registration Details</h1>

<p><a href="index.php">Return to login</a></p>

<?php
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$realname = trim($_POST['realname']);
	$age = trim($_POST['age']);
	$gender = '';
	if(isset($_POST['gender']))
		$gender = $_POST['gender'];
	$phone = trim($_POST['phone']);
	$email = trim($_POST['email']);
	$reputation = 0;
		
	// Check magic quotes
	if (!get_magic_quotes_gpc()) {
		$username = addslashes($username);
		$password = addslashes($password);
		$realname = addslashes($realname);
		$age = addslashes($age);
		$gender = addslashes($gender);
		$phone = addslashes($phone);
		$email = addslashes($email);
	}
		
	// Ensure user/password are valid
	if(!$username) {
		echo "<p>Error: No username entered</p>";
		require('footer.php');
		exit;
	}
	if(!$password) {
		echo "<p>Error: No password entered</p>";
		require('footer.php');
		exit;
	}
	else if(strlen($password) < 6) {
		echo "<p>Error: password must be at least 6 characters long</p>";
		require('footer.php');
		exit;
	}
	
	// If entered, make sure other fields are valid
	// These fields should be valid due to form restrictions, but this is just in case
	if($age && !is_numeric($age)) {
		echo "<p>Error: age must be numeric</p>";
		require('footer.php');
		exit;
	}
	if(isset($_POST['gender']) && $gender != 'M' && $gender != 'F') {
		echo "<p>Error: gender must be M or F</p>";
		require('footer.php');
		exit;
	}
	if($phone && (!is_numeric($phone) || strlen((string)$phone) != 10)) {
		echo "<p>Error: phone number must be numeric and exactly 10 digits long</p>";
		require('footer.php');
		exit;
	}
	if($email && !strstr($email, "@")) {
		echo "<p>Error: email must be valid</p>";
		require('footer.php');
		exit;
	}
	

	
	// Make table if it doesn't exist (first user)
	$query = "create table if not exists users
			(userid int unsigned not null auto_increment primary key,
			username char(20) not null,
			password char(20) not null,
			realname char(30),
			age int unsigned,
			gender char(1),
			phone char(10),
			email char(30),
			reputation int unsigned not null);";
	$db->query($query);
	
	// Check if username is already taken
	$query = "select username from users;";
	$result = $db->query($query);
	for($i = 0; $i < $result->num_rows; $i++) {
		$element = $result->fetch_assoc();
		if(stripslashes($element['username']) == $username) {
			echo "<p>Error: username already taken.</p>";
			require('footer.php');
			exit;
		}
	}
	
	// Insert user
	$query = "insert into users (username, password, realname, age, gender, phone, email, reputation) values (?,?,?,?,?,?,?,?)";
	$stmt = $db->prepare($query);
	$stmt->bind_param("sssdsssd", $username, $password, $realname, $age, $gender, $phone, $email, $reputation);
	$stmt->execute();
	
	echo "<p>Registration successful for user ".$username."</p>";
	
	// Login user
	$query = 'select userid from users where username=\''.$username.'\';';
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	$_SESSION['login_active'] = 1;
	$_SESSION['username'] = $username;
	$_SESSION['userid'] = $row['userid'];
?>

<?php
	require('footer.php');
?>

</body>
</html>