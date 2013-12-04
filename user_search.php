<html>
<head>
	<title>Search Results</title>
	<link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

<?php
	require('header.php');
?>

<h1>User Search</h1>

<div class="generic_form">
	<form action="user_search_results.php" method="get">
	<table class="login">
		<tr>
			<td>Username</td>
			<td align="center"><input type="text" name="eventname" size="20"
			 maxlength="20" autocomplete="off" /></td>
		</tr>
	</table>
	<br>
	<br>
	<td align="center"><input type="submit" value="Search" /></td>
	</form>
	<br><br>
</div>

<?php
	require('footer.php');
?>

</body>
</html>