   </div> <!-- Close out "content" div -->
</div> <!-- Close out "site_content" div -->
<div id="scroll">
      <a title="Scroll to the top" class="top" href="#"><img src="images/top.png" alt="top" /></a>
</div>

<footer>
      <p><img src="images/twitter.png" alt="twitter" />&nbsp;<img src="images/facebook.png" alt="facebook" />&nbsp;<img src="images/rss.png" alt="rss" /></p>
      <p><a href="index.php">Home</a> | <a href="userpage.php">Userpage</a> | <a href="my_calendar.php">My Calendar</a> | <a href="aboutUs.php">About Us</a> | <a href="contact.php">Contact Us</a></p>
      <p>Copyright &copy; CSS3_trees | <a href="http://www.css3templates.co.uk">design from css3templates.co.uk</a></p>
</footer>
</div> <!-- close out "main" div -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
<script type="text/javascript" src="js/jquery.sooperfish.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('ul.sf-menu').sooperfish();
		$('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
	});
</script>