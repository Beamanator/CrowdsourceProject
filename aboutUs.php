<!DOCTYPE HTML>
<html>

<head>
  <title>About Us</title>
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
    <h1>About Us</h1>
    <p>This website was designed with the goal to allow people within a community</br>
      to plan events and organize ways to host events.</p>
    <p>---</p>
    <p>This site provides a unique way to get to know your neighbors by joining them in fun events they're planning.</p>
    <p>---</p>
    <p><u>Site Engineers:</u></p>
    <p>Alex Beaman</br>
      Chris Lee</br>
      Kyle Tucker</p>
    <p>---</p>
    <p>Created for a project in the class CSCI-445, Web Development, taught by Cyndi Rader.</p>
    <p>---</p>
    <p>Questions / Comments about the site can be emailed to any of the creators.</br>
      (Email addresses can be found on <a href="inside.mines.edu">inside.mines.edu</a>)</p>

<?php
   require('footer.php');
?>

  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
      $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
    });
  </script>
</body>
</html>
