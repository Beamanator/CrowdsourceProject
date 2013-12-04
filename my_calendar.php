<!DOCTYPE HTML>
<html>

<head>
  <title>My Calendar</title>
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
	
	if(isset($_SESSION['login_active']))
		$userid = $_SESSION['userid'];
?>
<script>
	<?php
		$date = getdate();
		// Create userID - EventID table in case it doesn't exist
		$query = "create table if not exists user_events( reg_id int unsigned not null auto_increment primary key,userid int unsigned not null,eventid int unsigned not null);";
		$db->query($query);
		if(!$userid)
			$query = 'select * from events';
		else {
			$query = 'select events.name,events.date,events.time,events.location,events.tag from events, user_events 
					  where user_events.userid='.$userid.' 
					  and events.eventid = user_events.eventid;';
		}
		$result = $db->query($query);
		$event_array = array();
		if($result) {
			$num_results = $result->num_rows;
			for($i=0; $i<$num_results; $i++) {
				array_push($event_array, $result->fetch_assoc());
			}
		}
	?>
    var weekIndex = 0;
	var events = <?php echo json_encode($event_array); ?>;
	
    function addEvent() {
	var ms_offset = (2*weekIndex*7*24*3600*1000);
	var corrected_time = (<?php echo json_encode($date[0]); ?>*1000) + ms_offset;
	var date = new Date(corrected_time);
	
	for(var i = 0; i < 14; i++) {
		var offset = (i - date.getDay())*24*3600*1000;
		var today = new Date(corrected_time+offset);
		var today_month = today.getMonth()+1;
		var today_day = today.getDate();
		if(today.getDate() < 10)
			today_day = '0'+today.getDate();
		if(today.getMonth() < 10)
			today_month = '0'+(today.getMonth()+1);
		var today_str = today.getFullYear()+'-'+today_month+'-'+today_day;
		
		cells = document.getElementsByClassName(today.getDay() + 7*(i>6));
		cell = cells[cells.length-1];
		for(var j = 0; j < events.length; j++) {
			if(today_str == events[j].date) {
				var params = '\''+events[j].date.toString()+'\',\''+events[j].name.toString()+'\',\''+events[j].time.toString()+'\'';
				cell.innerHTML+='<div class="testEvent">'+
				'<a href="#" onclick="createAlert('+params+')">' + events[j].name + '</br>' + events[j].time + '</a></div>';
			}
		}
	}
    }
	
	function clearEvents() {
		for(var i = 0; i < 14; i++) {
			cells = document.getElementsByClassName(i);
			cell = cells[cells.length-1];
			cell.innerHTML = '';
		}
	}

</script>
        <h1>My Calendar</h1>
        <div class="button-div">
          <button type="button" id="button-prev" onclick="showPreviousWeeks()">Show Previous 2 Weeks</button>
          <button type="button" id="button-next" onclick="showNextWeeks()">Show Next 2 Weeks</button>
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
			for($i = 0; $i < 7; $i++) {
				echo '<td class ="'.$i.'"></td>';
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
			for($i = 0; $i < 7; $i++) {
				echo '<td class ="'.($i+7).'"></td>';
			}
		?>
            </tr>
          </table>
		  <script>addEvent()</script>
        </div>
<?php
   require('footer.php');
?>

  <!-- Javascript for calendar info -->
  <script>
    var today = new Date();
    var dayIndex = today.getDay().toString();
    var column = document.getElementsByClassName(dayIndex);
    var title1 = document.getElementById("this-week-table-title");
    var title2 = document.getElementById("next-week-table-title");

    // So that you can't look back in time on the calendar... Only in "past events" page

    function setColStyle() {
      var color1, color2;
      if (!weekIndex) {
        color1 = "#74DF00";
        color2 = "#74DF00";
      } else {
        color2 = "#DDD";
        color1 = "#555";
      }
      column[0].style.background = color1;
      column[1].style.background = color2;
    }

    function getMessage(date1, date2) {
      var m1 = date1.getMonth()+1;
      var d1 = date1.getDate();
      var m2 = date2.getMonth()+1;
      var d2 = date2.getDate();

      return (" ("+m1+"/"+d1+" - "+m2+"/"+d2+")");
    }

    function createAlert(date, eventName, time) {
      alert(
         '==========================\n'
       + '   Event: '+ eventName
       + '\n   Time:  ' + time
       + '\n   Date: ' + date
       + '\n==========================\n'
       + 'To Register for this event:\n'
       + '1) Find it on the Event Search page.\n'
       + '2) Click \'Register\'.'
      );
    }

    function formatTestEvent(items) {
      for (var i = 0; i < items.length; i++) {
        var o = items[i].style;
        o.fontSize = 14;
        o.borderStyle = "solid";
        // o.borderWidth = "3px";
        o.borderRadius = "5px";
        o.background = "#FA5882";
        o.textAlign = "center";
        o.paddingTop = "2px";
        o.paddingBottom = "2px";
        if (i != items.length-1) o.marginBottom = "2px";
      }
    }


    function setCalText() {
      var Y = today.getFullYear();
      var M = today.getMonth();
      var D = today.getDate();

      var m1 = title1.innerHTML.split('(')[0]; //--> "Events This Week "
      var m2 = title2.innerHTML.split('(')[0]; //--> "Events Next Week "

      var firstWeek1 = new Date(Y, M, D-dayIndex+(weekIndex*14));
      var firstWeek2 = new Date(Y, M, D-dayIndex+6+(weekIndex*14));

      var secondWeek1 = new Date(Y, M, D-dayIndex+7+(weekIndex*14));
      var secondWeek2 = new Date(Y, M, D-dayIndex+13+(weekIndex*14));

      title1.innerHTML = (m1 + getMessage(firstWeek1, firstWeek2));
      title2.innerHTML = (m2 + getMessage(secondWeek1, secondWeek2));
    }

    function showPreviousWeeks() {
      if (weekIndex) { // weekIndex != 0 true
        --weekIndex;
        setCalText();

        // if weekIndex == 0, !weekIndex is true
        if (!weekIndex) {
          disablePrevWeekButton();
        }
		clearEvents();
		addEvent();
		formatTestEvent(document.getElementsByClassName("testEvent"))

      } else console.log('cannot look back in time on this page');
      setColStyle();
    }

    function disablePrevWeekButton() {
      button = document.getElementById('button-prev');
      button.disabled = true;
    }

    function checkEnablePrevWeekButton() {
      button = document.getElementById('button-prev');
      if (button.disabled) button.disabled = false;
    }
	
    function showNextWeeks() {
      //location.reload();
      checkEnablePrevWeekButton();
      ++weekIndex;
	  clearEvents();
	  addEvent();
	  formatTestEvent(document.getElementsByClassName("testEvent"));
      setColStyle();
      setCalText();
    }
    
    setColStyle();

    setCalText();
    //testAddData();
    disablePrevWeekButton();
    formatTestEvent(document.getElementsByClassName("testEvent"));
  </script>
</body>
</html>