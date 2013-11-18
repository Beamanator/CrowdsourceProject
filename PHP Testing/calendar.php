<html>
<head>
  <title>Calendar</title>
  <link rel="stylesheet" type="text/css" href="format.css">
</head>
<body>

	<?php
		@ $db = new mysqli('localhost', 'root', '', 'test');
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
    var title1 = document.getElementById("this-week-table-title");
    var title2 = document.getElementById("next-week-table-title");

    function setColStyle(column, color) {
      column[0].style.background = color;
      column[1].style.background = color;
    }

    function updateTableTitles() {
      var dayOfMonth = today.getDate();

      var firstCalDay1 = new Date(today.getFullYear(), today.getMonth(), dayOfMonth-dayIndex);
      var firstCalDay2 = new Date(today.getFullYear(), today.getMonth(), dayOfMonth+6-dayIndex);

      var secondCalDay1 = new Date(today.getFullYear(), today.getMonth(), dayOfMonth+7-dayIndex);
      var secondCalDay2 = new Date(today.getFullYear(), today.getMonth(), dayOfMonth+13-dayIndex);

      title1.innerHTML += getMessage(firstCalDay1, firstCalDay2);
      title2.innerHTML += getMessage(secondCalDay1, secondCalDay2);
    }

    function getMessage(date1, date2) {
      var m1 = date1.getMonth()+1;
      var d1 = date1.getDate();
      var m2 = date2.getMonth()+1;
      var d2 = date2.getDate();

      return (" ("+m1+"/"+d1+" - "+m2+"/"+d2+")");
    }

    function getFirstDay(dayNumber) {
      var firstRem = dayNumber - dayIndex;
      if (firstRem <= 0) {

      }
    }

    function testAddData() {
      table1 = document.getElementsByClassName("calendar")[0];
      cell = document.getElementsByClassName("3")[1];
      cell.innerHTML+='<div class="testEvent">'+
        '<a href="#" onclick="createAlert(cell)">Event 1</br>Time</br>#People</a>'+
      '</div>';
      cell.innerHTML+='<div class="testEvent">'+
        '<a href="#" onclick="createAlert(cell)"">Event 2</br>Time2</br>#Peoples</a>'+
      '</div>';
      cell.innerHTML+='<div class="testEvent">'+
        '<a href="#" onclick="createAlert(cell)"">Event 2</br>Time2</br>#Peoples</a>'+
      '</div>';
      cell.innerHTML+='<div class="testEvent">'+
        '<a href="#" onclick="createAlert(cell)"">Event 2</br>Time2</br>#Peoples</a>'+
      '</div>';
      cell.innerHTML+='<div class="testEvent">'+
        '<a href="#" onclick="createAlert(cell)"">Event 2</br>Time2</br>#Peoples</a>'+
      '</div>';
      events = document.getElementsByClassName("testEvent");
      formatTestEvent(events);
    }

    function createAlert(cell) {
      alert( 
        'This is an alert with basic formatting\n\n'
        + 'Calendar stuff may go here or somewhere else?\n\n'
        + "\t- list item 1\n"
        + '\t- list item 2\n'
        + '\t- list item 3\n\n'
        + '====================\n\n'
        + 'Simple table\n\n'
        + 'Char\t| Result\n'
        + '\\n\t| line break\n'
        + '\\t\t| tab space'
      );
    }

    function formatTestEvent(items) {
      for (var i = 0; i < items.length; i++) {
        var o = items[i].style;
        o.fontSize = 14;
        o.borderStyle = "solid";
        o.borderWidth = 2;
        o.borderRadius = "5px";
        o.background = "#FA5882";
        o.textAlign = "center";
        o.marginBottom = 1;
      }
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