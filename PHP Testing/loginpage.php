<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="format.css">
  <img id="Banner"  src="banner.jpg">
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

<h1>Login</h1>

<div class="loginform">
	<form action="login.php" method="post">
	<table class="login">
		<tr>
			<td>Username</td>
			<td align="center"><input type="text" name="username" size="20"
			 maxlength="20" autocomplete="off" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td align="center"><input type="password" name="password" size="20"
			 maxlength="20" autocomplete="off" /></td>
		</tr>
	</table>
	<br>
	<td align="center"><input type="submit" value="Log in" /></td>
	</form>
</div>
<br><br>
<h1>Register</h1>
<div class="loginform">
	<form action="register.php" method="post">
	<table class="login">
		<tr>
			<td>Username</td>
			<td align="center"><input type="text" name="username" size="20"
			 maxlength="20" autocomplete="off" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td align="center"><input type="password" name="password" size="20"
			 maxlength="20" autocomplete="off" /></td>
		</tr>
	</table>
	<br>
	<td align="center"><input type="submit" value="Register" /></td>
	</form>
</div>

  <table border="0">
    <tr>Contact Us</tr>
    <tr>F.A.Q.</tr>
    <tr>About Us</tr>
  </table>
</body>
</html>