<html>
<head>
  <title>User Home Page</title>
  <link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>

<h1>Edit User Info</h1>

<?php	
	if(!isset($_SESSION['login_active'])) {
		echo "<h2>Please <a href=\"index.php\">login</a> to edit user information</h2>";
		require('footer.php');
		exit;
	}
	
	// Get initial values for form fields
	$query = 'select realname,age,gender,phone,email from users where userid=\''.$_SESSION['userid'].'\';';
	$result = $db->query($query);
	$row = $result->fetch_assoc();
	
	if($row['realname'])	$realname = $row['realname'];
	if($row['age'] > 0	)	$age = $row['age'];
	if($row['gender'])		$gender = $row['gender'];
	if($row['phone'])		$phone = $row['phone'];
	if($row['email'])		$email = $row['email'];
?>

<div class="generic_form">
	<form action="edit_userinfo_results.php" method="post">
	<table class="login">
		<tr>
			<td>Name</td>
			<td align="center"><input type="text" name="realname" size="30"
			 maxlength="30" autocomplete="off" 
			 <?php if(isset($realname)) echo 'value="'.$realname.'" '; ?>
			 /></td>
		</tr>
		<tr>
			<td>Age</td>
			<td align="center"><input type="number" name="age" id="age" min="0" 
			<?php if(isset($age)) echo 'value="'.$age.'" '; ?>
			/></td>
		</tr>
		<tr>
			<td>Gender</td>
			<?php
				echo '<td><input type="radio" name="gender" id="male" value="M" ';
				if(isset($gender) && $gender == 'M') echo 'checked="checked"';
				echo '>M<span>&nbsp;</span>';
				echo '<input type="radio" name="gender" id="female" value="F" '; 
				if(isset($gender) && $gender == 'F') echo 'checked="checked"';
				echo '>F</td>';
			?>
		</tr>
		<tr>
			<td>Phone (no dashes):</td>
			<td><input type="text" name="phone" id="phone" size="12" pattern="[0-9]{10}" autocomplete="off" 
			<?php if(isset($phone)) echo 'value="'.$phone.'" '; ?>
			/></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" id="email" size="30" autocomplete="off" 
			<?php if(isset($email)) echo 'value="'.$email.'" '; ?>
			/></td>
		<tr>
	</table>
	<p>Leave field blank to delete</p>
	<br>
	<td align="center"><input type="submit" value="Submit" /></td>
	<br><br><br>
	</form>
</div>

<?php
	require('footer.php');
?>

</body>
</html>