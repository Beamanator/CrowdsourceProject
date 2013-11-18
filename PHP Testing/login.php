<html>
<head>
	<title>Login</title>
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

</body>
</html>