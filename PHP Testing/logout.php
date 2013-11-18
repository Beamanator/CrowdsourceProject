<html>
<head>
	<title>Logout</title>
</head>
<body>

<h1>Logout Details</h1>
<a href="loginpage.php">Return to login</a>

<?php
	@ $db = new mysqli('localhost', 'root', '', 'test');
	if (mysqli_connect_errno()) {
		echo 'Error: Database connection. Try again later.';
		exit;
	}
	
	session_start();
	echo "<p>Goodbye, ".$_SESSION['username']."</p>";
	unset($_SESSION['login_active']);
	unset($_SESSION['username']);
?>