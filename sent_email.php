<?php
 $error=NULL;
?>

<html>
	<head>
		<link href="registration.css" rel="stylesheet" type="text/css"/>
	</head>
	
	<body>
	
		<ul>
			<li><a href="registration.php">Register here</a></li>
			<li><a href="login.php">Login here</a></li>
		</ul>
		
		<h1>
			An email was sent to your address for confirmation! Thank you!
		</h1>
		
		<h2>
			<?php 
			echo $error;
			?>
		</h2>
	
	</body>