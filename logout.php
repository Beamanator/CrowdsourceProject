<html>
<head>
	<title>Logout</title>
	<link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>
<?php
	require('header.php');
?>
<h1>Logout Details</h1>
<p><a href="index.php">Return to login</a></p>
<?php
	echo "<p>Goodbye, ".$_SESSION['username']."</p>";
	unset($_SESSION['login_active']);
	unset($_SESSION['username']);
	require('footer.php');
?>
</body>
</html>