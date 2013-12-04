<html>
<head>
  <title>User Home Page</title>
  <link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>

<h1>Edit Results</h1>

<?php

	$realname = trim($_POST['realname']);
	$age = trim($_POST['age']);
	$gender = '';
	if(isset($_POST['gender']))
		$gender = $_POST['gender'];
	$phone = trim($_POST['phone']);
	$email = trim($_POST['email']);
	
		
	// Check magic quotes
	if (!get_magic_quotes_gpc()) {
		$realname = addslashes($realname);
		$age = addslashes($age);
		$gender = addslashes($gender);
		$phone = addslashes($phone);
		$email = addslashes($email);
	}
	
	$query = "update users set realname=?, age=?, gender=?, phone=?, email=? where userid=?;";
	$stmt = $db->prepare($query);
	$stmt->bind_param("sdsssd", $realname, $age, $gender, $phone, $email, $_SESSION['userid']);
	$stmt->execute();
	
	echo "<p>";
	if($realname) echo "Name: ".$realname."<br>";
	if($age) echo "Age: ".$age."<br>";
	if($gender) echo "Gender: ".$gender."<br>";
	if($phone) echo "Phone: ".$phone."<br>";
	if($email) { 
		echo "Email: ".$email."<br>";
		$_SESSION['email'] = $email;
	}
	echo "</p>";
?>

<?php
	require('footer.php');
?>

</body>
</html>