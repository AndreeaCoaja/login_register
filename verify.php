<?php
 
 $mess = NULL;
 
if(isset($_GET['id'])) {
	//verification
	$id=$_GET['id'];
	
	//connect to db 
		
	$servername = "localhost";
	$user = "root";
	$pass = "";
	$dbname ="user_registration";
		
	$mysqli = new MySQLi($servername, $user, $pass, $dbname);
		
	$responseSet= $mysqli->query("SELECT verify, id FROM registered where verify=0 and id = '$id' LIMIT 1");
	
	if($responseSet->num_rows == 1) {
		//validate
		$update = $mysqli->query("UPDATE registered SET verify = 1 WHERE id='$id' LIMIT 1");
		
		if($update) {
			$mess = "Your account has been registered. You can now log in";
		} else {
			$mess= $mysqli->error;
		}
	} else {
		$mess = "This account is invalid";
	}
} else {
	$mess = "Something went wrong";
	
}
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
			<?php 
			echo $mess;
			?>
		</h1>
		
	</body>