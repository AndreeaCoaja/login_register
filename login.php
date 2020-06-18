<?php
 
$error = NULL;

if(isset($_POST['submit'])) {
	//connect to db 
		
	$servername = "localhost";
	$user = "root";
	$pass = "";
	$dbname ="user_registration";
		
	$mysqli = new MySQLi($servername, $user, $pass, $dbname);
	
	//Get form data
	$username=$_POST['username'];
	$password=$_POST['password'];
	$password=md5($password);
	
	//select query
	$resultQuery = $mysqli->query("SELECT * FROM registered WHERE username='$username' AND password='$password' LIMIT 1");
	
	if($resultQuery->num_rows!=0) {
		//Login successfully
		$row=$resultQuery->fetch_assoc();
		$verify=$row['verify'];
		
		if($verify == 1) {
			//continue
			header('location:successfullyIN.php');
		} else {
			$error = "This account was not validated";
		}
	}else {
		//invalid login
		$error = "Invalid username or password";
	}	
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
		
		<form method="POST" action="">
			<table border="0" align="center" cellpadding="5">
				<tr>
					<td align="right">Username:</td>
					<td> <input type="TEXT" name="username" required/> </td>
				</tr>
				<tr>
					<td align="right">Password:</td>
					<td> <input type="PASSWORD" name="password" required/> </td>
				</tr>
				<tr>
					<td colspan="2" align="center"> <input type="SUBMIT" name="submit" value="Register" required/> </td>
				</tr>
			</table>
		</form>
		
		
		<h1>
			<?php 
			echo $error;
			?>
		</h1>
	
	</body>