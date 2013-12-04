<script type="text/javascript" src="js/modernizr-1.5.min.js"></script>

<?php
	@ $db = new mysqli('localhost', 'team02', 'apple', 'test');
	if (mysqli_connect_errno()) {
		echo 'Error: Database connection. Try again later.';
		exit;
	}
	
	$asdf = 5;
	session_start();
?>

<div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">Viva L<span class="logo_colour">a' Venture</span></a></h1>
          <h2>Plan. Organize. Have fun.</h2>
        </div>
      </div>
      <nav>
        <div id="menu_container">
          <ul class="sf-menu" id="nav">
            <li><a href="index2.php">Home</a></li>
			<li><a href="#">Userpage</a>
              <ul>
                <li><a href="userpage.php">View</a></li>
                <li><a href="edit_userinfo.php">Edit</a>
				<li><a href="user_search.php">Search</a>
              </ul>
            </li>
            <li><a href="my_calendar.php">My Calendar</a></li>
		<li><a href="addevent.php">Add Event</a></li>
            <li><a href="search.php">Event Search</a></li>
            <li><a href="aboutUs.php">About Us</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </div>
      </nav>
    </header>
    <div id="site_content">
      <div id="sidebar_container">
        <div class="sidebar">
          <h3>Latest News</h3>
          <h4>New Website Launched</h4>
          <h5>December 3rd, 2013</h5>
          <h4>Upcoming Site Changes</h4>
          <h5>January 1st, 2014</h5>
        </div>
        <div class="sidebar">
          <h3>Useful Links</h3>
          <ul>
            <li><a href="http://www.ymca.net/find-your-y/?address=80401&y=20#">Nearest YMCA &copy clubs</a></li>
            <li><a href="https://www.erideshare.com/carpool.php?dstate=CO&search=80401">Carpools by Eride.com &copy</a></li>
            <li><a href="http://www.yelp.com/c/golden-co-us/restaurants">Restaurants by Yelp &copy</a></li>
	     <li><a href="http://xkcd.com/#">XKCD &copy</a></li>

            <li><a href="http://www.match.com/cpx/en-us/landing/search/74993/?mobi=0&trackingid=523521&bannerid=881943&gclid=CPno0aG5kLsCFSISMwodhHkAMw">S.S.I.Y.A.</a></li>

          </ul>
        </div>
      </div>
   <div class="content">
<?php
	$username = "";
	$userid = 0;
	if(isset($_SESSION['login_active'])) {
		$username = $_SESSION['username'];
		$userid = $_SESSION['userid'];
              $user_email = $_SESSION['email'];
		echo '<div class="userinfo">';
		echo '<p style="text-align:left">Welcome, '.$username."\t";
		echo '<a href="logout.php">Logout</a></p>';
		echo '</div>';
	}
?>