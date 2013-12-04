<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>

<h1>Register</h1>

<p class="required_field">* denotes a required field</p>

<div class="generic_form">
	<form action="register_results.php" method="post">
	<table class="login">
		<tr>
			<td><span class="required_field">* </span>Username</td>
			<td align="center"><input type="text" name="username" size="20"
			 maxlength="20" autocomplete="off" /></td>
		</tr>
		<tr>
			<td><span class="required_field">* </span>Password</td>
			<td align="center"><input type="password" name="password" size="20"
			 maxlength="20" autocomplete="off" /></td>
		</tr>
		<tr>
			<td>Name</td>
			<td align="center"><input type="text" name="realname" size="30"
			 maxlength="30" autocomplete="off" /></td>
		</tr>
		<tr>
			<td>Age</td>
			<td align="center"><input type="number" name="age" id="age" min="0"></td>
		</tr>
		<tr>
			<td>Gender</td>
			<td><input type="radio" name="gender" id="male" value="M">M
			<span>&nbsp;</span>
			<input type="radio" name="gender" id="female" value="F">F</td>
		</tr>
		<tr>
			<td>Phone (no dashes):</td>
			<td><input type="text" name="phone" id="phone" size="12" pattern="[0-9]{10}" autocomplete="off"</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" id="email" size="30" autocomplete="off"</td>
		<tr>
	</table>
	<br>
	<td align="center"><input type="submit" value="Register" /></td>
	<br><br><br>
	</form>
</div>

<?php
	require('footer.php');
?>

</body>
</html>