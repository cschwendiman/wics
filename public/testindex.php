<html>
	<head>
		<title>Women in Computer Sciences | The University of Texas at Austin</title>
<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="public/css/reset.css" />
		<link rel="stylesheet" href="public/css/text.css" />
		<link rel="stylesheet" href="public/css/960.css" />
		<style type="text/css">
			
		</style>
	</head>
	<body>
		<div id="header-background"></div>
		<div id="header-container" class="container_12">
			<div id="header" class="grid_3">
				<img src="/public/images/layout/logo2.png">
			</div>
			<div id="nav" class="grid_6">
				<ul>
					<li class="selected">News</li>
					<li>Events</li>
					<li>About</li>
					<li>Photos</li>
					<li>Contact</li>
				</ul>
			</div>
			<div id="email-signup" class="grid_3">
				derp
			</div>
		</div>
		<div id="content-container" class="container_12">
			<div id="content" class="grid_8">
				<div id="about-box">Women in Computer Sciences at the University of Texas at Austin is a non-profit organization dedicated to building a network community of women in Computer Science.&nbsp;&nbsp;WiCS's mission is to encourage and support women in computing through outreach, professional development, academic initiatives, and social events.</div>
				<div class="post">
				<h2>Lorem ipsum dolor sit amet</h2>
				<h4>August 11th, 2011</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus placerat nibh eu diam ultrices lobortis a consectetur turpis. Mauris eleifend arcu suscipit urna adipiscing nec dapibus enim rutrum. Integer velit felis, pulvinar cursus gravida quis, lacinia vel nulla. Nunc ut dolor sapien. Nam lacinia vulputate lorem ut aliquet. Maecenas vehicula rhoncus sem ac rhoncus. Proin nec purus at nisi malesuada vehicula. Vivamus ultricies blandit nibh, sit amet faucibus urna tempus sit amet. Curabitur semper ornare nisl sed mattis. In orci nisi, adipiscing nec ultrices ut, malesuada nec risus. Mauris nunc nisi, semper sit amet viverra ac, consequat sit amet neque. Praesent aliquam lacus vitae mauris adipiscing eget accumsan sapien placerat. Cras eu urna neque, vitae tempus metus. Cras luctus feugiat tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed eu turpis sit amet ante porttitor suscipit. Mauris aliquam, elit pellentesque gravida pellentesque, sapien mi ornare diam, ac consectetur eros turpis id nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
				</div>
				<div class="post">
				<h2>Sed a est ac velit pulvinar</h2>
				<h4>August 2nd, 2011</h4>
				<p>Sed a est ac velit pulvinar bibendum. Donec ornare commodo felis, ac dictum lorem suscipit sit amet. Curabitur iaculis, metus ac aliquam sodales, ante felis tempor mi, vel hendrerit lacus ante quis felis. Etiam in nisl libero. Nulla facilisi. Nullam mauris est, pharetra gravida mattis ac, pretium ut nisl. Nunc condimentum elit scelerisque massa auctor fermentum. Vestibulum erat lacus, venenatis at vulputate ut, sodales nec purus. Nulla facilisi. Ut non tincidunt dui. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
				</div>
				<div class="post">
				<h2>Nulla facilisi. Quisque vestibulum</h2>
				<h4>August 1st, 2011</h4>
				<p>Nulla facilisi. Quisque vestibulum pretium elit et convallis. Etiam mattis porta felis, quis feugiat orci malesuada vel. Donec vel sem vitae lectus euismod egestas. Ut auctor scelerisque metus ut auctor. Fusce felis nunc, gravida et vehicula non, convallis sit amet lacus. Aenean id orci sed velit ultrices laoreet. Phasellus eu tortor sem. Sed vel orci id ligula faucibus sollicitudin. Aliquam erat volutpat. Aliquam condimentum interdum eros non imperdiet. Pellentesque eleifend enim eu nunc mattis viverra.</p> 
				</div>
			</div>
			<div id="events" class="grid_4">
				<?php
				$days = date("t");
				$month = date("m");
				$year = date("y");
				
				echo "<div class=\"calmonth\">";
				
				for($i = 1; $i <= $days; $i++){
					$timestamp = mktime(0,0,0,$month,$i,$year);
					$day_of_week = date("D", $timestamp);
					$head = $i == 1 ? ' first' : '';
					$tail = $i == $days ? ' last' : '';
					echo "<div class=\"calday $day_of_week$head$tail\">$i</div>";
					
				}
				echo "</div>"
				?>
				<h2>Upcoming Events</h2>
				<h3>Some news update here</h3>
				<h4>August 11th, 2011</h4>
				<p>Short description here...</p>
				<h3>Some news update here</h3>
				<h4>August 11th, 2011</h4>
				<p>Short description here...</p>
				<h3>Some news update here</h3>
				<h4>August 11th, 2011</h4>
				<p>Short description here...</p>
				<h3>Some news update here</h3>
				<h4>August 11th, 2011</h4>
				<p>Short description here...</p>
			</div>
			
		</div>
		<div id="footer-container" class="container_12">
			<div id="footer-info" class="grid_6">
				Derp info here
			</div>
			<div id="footer-sponsors" class="grid_6">
				Thank you to our sponsors:
				<br>
				<img src="/public/images/sponsors/universitycoop_logo.jpg"><img src="/public/images/sponsors/google_logo.png"><img src="/public/images/sponsors/qualcomm_logo.jpg">
				<img src="/public/images/sponsors/lockheedmartin_logo.gif"><img src="/public/images/sponsors/yahoo_logo.jpg">
				<br>
				Interested in sponsoring an event?
			</div>
		</div>
		<div id="footer-background"></div>
	</body>
</html>
