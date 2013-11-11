<html>
<head>
  <title>User Home Page</title>
  <link rel="stylesheet" type="text/css" href="format.css">
  <img id="Banner"  src="banner.jpg">
  <script>
	//Dynamic Banner
	function setContPos() {
		//get client screen resolution
		var docWidth = document.body.clientWidth;
		//document.write(docWidth + ": Doc Width");
		var docHeight = document.body.clientHeight;
		//document.write(docHeight + ": Doc Height");
		//set image size to suit your needs
		//percentage based
		var elWidth = docWidth*.99 ;
		var elHeight = 200;
		//set position of the image
		var leftPos = (docWidth-elWidth)/2;
		var topPos = (docHeight-elHeight)/2;
		//setting up everything in your workspace
		document.getElementById('Banner').style.left=leftPos;
		document.getElementById('Banner').style.top=topPos;
		document.getElementById('Banner').style.width=elWidth;
		document.getElementById('Banner').style.height=elHeight;
	}
	setContPos();
</script>
	<?php
		@ $db = new mysqli('localhost', 'root', 'csica23', 'test');
		if (mysqli_connect_errno()) {
			echo 'Error: Database connection. Try again later.';
			exit;
		}
	?>
</head>
<body>
<h1>Me</h1>

	<table class="user_events">
		<tr>
			<th>Name</th>
			<th>Date</th>
			<th>Time</th>
			<th>Location</th>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>

	<br>
	
	<div id="eventform">
		<form action="addevent.php" method="post">
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
			
		</table>
		<br>
		<td align="center"><input type="submit" value="Add Event" /></td>
		</form>
	</div>
	
	<br><br>
	
	
  <table class = "footer_table">
    <tr>
		<th>Contact Us</th>
		<th>F.A.Q.</th>
		<th>About Us</th>
	</tr>
  </table>
</body>
</html>