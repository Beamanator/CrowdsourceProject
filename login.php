<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>

<h1>Login Details</h1>

<p> Login Successful</p>
<p> View your user page <a href="userpage.php">here</a>, or edit it <a href="edit_userinfo.php">here</a>.</p>

<p><a href="index.php">Return to login</a></p>

<?php
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$query = "select userid,username,password,email from users;";
	$result = $db->query($query);
	for($i = 0; $i < $result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		if($username == stripslashes($row['username']) && $password == stripslashes($row['password'])) {
			$_SESSION['login_active'] = 1;
			$_SESSION['username'] = $username;
			$_SESSION['userid'] = $row['userid'];
			$_SESSION['email'] = $row['email'];
			echo "<br><br><p>Login successful. Welcome, ".$username."</p>";
			require('footer.php');
			exit;
		}
	}
	echo "<p>Error: invalid username/password combination.</p>";
?>

<?php
	require('footer.php');
?>

</body>
</html>