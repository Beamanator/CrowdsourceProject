<html>
<head>
  <title>Calendar</title>
  <link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

	<?php
		@ $db = new mysqli('localhost', 'root', 'csica23', 'test');
		if (mysqli_connect_errno()) {
			echo 'Error: Database connection. Try again later.';
			exit;
		}
	?>
	
  <h1>My Calendar</h1>

  <!-- Banner 
  here
  somewhere -->

  <div class="button-div">
    <button type="button" id="button-prev">Show Previous 2 Weeks</button>
    <button type="button" id="button-next">Show Next 2 Weeks</button>
  </div>

  <div class="container">
    <h3 id="this-week-table-title">Events This Week</h3>
    <table class="calendar" border="1">
      <tr class="days">
        <th class="0">Sunday</td>
        <th class="1">Monday</td>
        <th class="2">Tuesday</td>
        <th class="3">Wednesday</td>
        <th class="4">Thursday</td>
        <th class="5">Friday</td>
        <th class="6">Saturday</td>
      </tr>
      <tr id="events-this-week">
		<?php
			$query = "select * from events";	
			$date = getdate();
			$sunday = $date['mday'] - $date['wday'];
			for($i = 0; $i < 7; $i++) {
				echo '<td class="'.$i.'">';
				
				$result = $db->query($query);
				$num_results = $result->num_rows;
				if($num_results > 0) {
					for($j = 0; $j < $num_results; $j++) {
						$row = $result->fetch_assoc();
						$eventdate = explode('-', $row['date']);
						if($eventdate[1] == ($i + $sunday)) {
							echo floor($row['time']);
							if(floor($row['time']) < $row['time']) {
								echo ":30<br>";
							}
							else {
								echo ":00<br>";
							}
							echo $row['name']."<br><br>";
						}
					}
				}
				
				echo "</td>";
			}
		?>
      </tr>
    </table>
  </div>

  <div class="container">
    <h3 id="next-week-table-title">Next Week's Events</h3>
    <table class="calendar" border="1">
      <tr class="days">
        <th class="7">Sunday</td>
        <th class="8">Monday</td>
        <th class="9">Tuesday</td>
        <th class="10">Wednesday</td>
        <th class="11">Thursday</td>
        <th class="12">Friday</td>
        <th class="13">Saturday</td>
      </tr>
      <tr id="events-next-week">
	  <?php
			$query = "select * from events";	
			$date = getdate();
			$sunday = 7 + $date['mday'] - $date['wday'];
			for($i = 0; $i < 7; $i++) {
				echo '<td class="'.$i.'">';
				
				$result = $db->query($query);
				$num_results = $result->num_rows;
				if($num_results > 0) {
					for($j = 0; $j < $num_results; $j++) {
						$row = $result->fetch_assoc();
						$eventdate = explode('-', $row['date']);
						if($eventdate[1] == ($i + $sunday)) {
							echo floor($row['time']);
							if(floor($row['time']) < $row['time']) {
								echo ":30<br>";
							}
							else {
								echo ":00<br>";
							}
							echo $row['name']."<br><br>";
						}
					}
				}
				
				echo "</td>";
			}
		?>
      </tr>
    </table>
  </div>

  <script>
    var today = new Date();
    var dayIndex = today.getDay().toString();
    var column = document.getElementsByClassName(dayIndex);
    var month = today.getMonth()+1;
    var title1 = document.getElementById("this-week-table-title");
    var title2 = document.getElementById("next-week-table-title");
	
    function setColStyle(column, color) {
      column[0].style.background = color;
      column[1].style.background = color;
    }

    function updateTableTitles() {
      // This logic doesn't account for changing months!!!!!!!!!!!!!!!!
      var dayOfWeek = today.getDate();
      var firstDay = dayOfWeek - dayIndex;
      var lastDay = firstDay + 6;
      var message1 = " ("+month+"/"+firstDay+" - "+month+"/"+lastDay+")";
      title1.innerHTML += message1;
      var message2 = " ("+month+"/"+(firstDay+7)+" - "+month+"/"+(lastDay+7)+")";
      title2.innerHTML += message2;
    }

    function testAddData(){
      table1 = document.getElementsByClassName("calendar")[0];
      debugger;
    }

    setColStyle(column,"#74DF00");
    updateTableTitles();
    testAddData();
  </script>

  <footer>
    <p><a href="">Contact Us</a>&emsp;-&emsp;<a href="">F.A.Q.</a>&emsp;-&emsp;<a href="">About Us</a></p>
  </footer>
</body>
</html>