<html>
<head>
	<title>Search Results</title>
	<link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>

<h1>Search Results</h1>

<?php
	$name = trim($_GET['eventname']);
	if(!$name) {
		echo "<p>Please enter a search term.</p>";
		exit;
	}
	
	$query = "select userid, username from users";
	$result = $db->query($query);
	$result_count = 0;
	echo "<table><tr><th>Username</th></tr>";
	
	for($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		if(stripos($row['username'], $name) !== false) {
			echo "<tr><td>";
			echo '<a href="userpage.php?userid='.$row['userid'].'">'.$row['username'].'</a></td></tr>';
			$result_count++;
		}
	}
	
	echo "</table><br>";
	echo "<p>".$result_count." results</p><br>";
	
?>

<?php
	require('footer.php');
?>

</body>
</html>