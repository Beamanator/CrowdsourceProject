<html>
<head>
  <title>Add Event</title>
  <link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');

	if(!isset($_SESSION['login_active'])) {
		echo "<h2>Please <a href=\"index.php\">login</a> to add events</h2>";
		require('footer.php');
		exit;
	}
?>
	<div id="eventform">
		<form action="addevent_results.php" method="post">
		<h1>Add Event</h1>
		<table id="addevent">
			<tr>
				<td>Event name</td>
				<td align="center"><input type="text" name="eventname" size="30"
				 maxlength="30" autocomplete="off" /></td>
			</tr>
				<td>Date</td>
				<td><input type="date" name="eventdate" id="eventdate"></td>
			</tr>
				<td>Time</td>
				<td><input type="time" name="eventtime" id="eventtime"></td>
			<tr>
				<td>Location</td>
				<td align="center"><input type="text" name="eventloc" size="30"
				 maxlength="100" autocomplete="off" /></td>		
			</tr>
			<tr>
				<td>Tag</td>
				<td align="center"><input type="text" name="eventtag" size="10"
				 maxlength="100" autocomplete="off" /></td>		
			</tr>
		</table>
		<input type="hidden" name="user_id" value="<?php echo $userid;?>">
		<br>
		<td align="center"><input type="submit" value="Add Event" /></td>
		</form>
	</div>
	<br><br>
	
<?php
	require('footer.php');
?>
</body>
</html>