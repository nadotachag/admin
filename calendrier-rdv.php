<?php
include 'Calendar.php';
// require_once 'includes/navbar.php';

$calendar = new Calendar('2021-02-02');
$calendar->add_event('Birthday', '2021-02-03', 1, 'green');
$calendar->add_event('Doctors', '2021-02-04', 1, 'red');
$calendar->add_event('Holiday', '2021-02-16', 1);
$calendar->add_event('match', '2021-02-10', $days=1,'blue');

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Event Calendar</title>
		<link href="css/calendrier-style.css" rel="stylesheet" type="text/css">
		<link href="css/calendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	    <nav class="navtop">
	    	<div>
	    		<h1>Event Calendar</h1>
	    	</div>
	    </nav>
		<div class="content home">
			<?=$calendar?>
		</div>
	</body>
</html>

<?php
  require_once 'includes/footer.php';
  ?>