<html>
<head>
  <title>Login Page</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="format.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>
<body>

<?php
	require('header.php');
?>

   <h1>Home</h1>
   <h1>Need to Log in? <a href="index.php">Click here</a>.</h1>

   <div id="pop_tags">
	<h1>Popular Tags</h1>
	<?php
		$query = "select * from tags order by abs(amount) desc";
		$result = $db->query($query);
		if($result) {
			echo '<p>';
			for($i=0; $i<3 && $i<$result->num_rows; $i++) {
				$row = $result->fetch_assoc();
				if($row['amount'] > 0)
					echo '<a href="search_results.php?eventname=&eventtag='.$row['name'].'">'.$row['name'].'</a><br>';
				else {
					$query = 'delete from tags where tagid='.$row['tagid'].';';
					$db->query($query);
				}
			}
			echo '</p>';
		}
		else {
			echo '<p>No tags found</p>';
		}
	?>
   </div>
<?php
	require('footer.php');
?>

</body>
</html>