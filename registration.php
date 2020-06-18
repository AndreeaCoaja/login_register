<?php
 $error=NULL;
 //It checks that there is a field with name 'Submit' in the form submitted to this php page. 
//In addition all fields that have name attribute of the form are represented in the $_POST array.
 if(isset($_POST['submit'])) {
	//Get form data
	$username=$_POST['username'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	$email=$_POST['email'];
	
	if($password2 != $password) {
		$error = "<h2>Your passwords do not match</h2>";
	} else {
		//form is valid
		//connect to db 
		
		$servername = "localhost";
		$user = "root";
		$pass = "";
		$dbname ="user_registration";
		
		$mysqli = new MySQLi($servername, $user, $pass, $dbname);

		
		// Escape special characters, if any = escapes special characters in a string for use in an SQL query (e.g. ' name: D'Ore)
		$username = $mysqli -> real_escape_string($username);
		$password = $mysqli -> real_escape_string($password);
		$password2 = $mysqli -> real_escape_string($password2);
		$email = $mysqli -> real_escape_string($email);
		
		
		
		//Insert account into db
		$password=md5($password);
		$insert = $mysqli->query("INSERT INTO registered(username, password, email)
		VALUES('$username', '$password', '$email') ");
		
		//select query
		$resultQuery = $mysqli->query("SELECT * FROM registered WHERE username='$username' AND password='$password' LIMIT 1");
		if($resultQuery->num_rows!=0) {
			
			$row=$resultQuery->fetch_assoc(); //Returns an associative array of strings representing the fetched row
			$id=$row['id'];
		}
		
		if($insert) {
			echo "Succes";
			$to = $email;
			$subject = "Email Validation";
			$message = "<a href='http://localhost/User_Registration_Project/verify.php?id=$id'>Register account </a>"; //id is sent to verify page with get method
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			mail($to, $subject, $message, $headers);
			
			header('location:sent_email.php');
		}else {
			echo $mysqli->error;
		}	
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
					<td align="right">Repeat Password:</td>
					<td> <input type="PASSWORD" name="password2" required/> </td>
				</tr>
				<tr>
					<td align="right">Email Address:</td>
					<td> <input type="EMAIL" name="email" required/> </td>
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