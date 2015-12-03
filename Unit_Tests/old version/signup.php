<?php
require "./db_connect.php";
/*
	ini_set('display_errors', 'On');
	session_start();
	if(isset($_SESSION['loggedinstatus'])) {
		if($_SESSION['loggedinstatus']){
			header('location: ./donate.php')
		}
	}
	
*/
	function add_user($email_address, $password, $fname, $lname, $mysqli) {
		$dbquery = "INSERT INTO usr_db (email_address, pass, first_name, last_name) VALUES (".$email_address.",".$password.",".$fname.",".$lname.")";
		$_SESSION['email_address'] = $email_address;
		
		//prepare
		if(!($stmt = $mysqli->prepare($dbquery))) {
			echo "Failed to prepare query";
		}
		//execute
		if(!$stmt->execute()){
			echo "Failed to execute";
		}
		
	}

	if(isset($_POST['email_address']) && isset($_POST['password']) && isset($_POST['fname']) && isset($_POST['lname'])) {
	//create php variables from post array
		$email_address = $_POST['email_address'];
		$password = $_POST['password'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		//make sure to incorporate validation/sanitation
		
	//prepared statements with email_address to check if there is a match for the email_address, if > 0 proceed
		$dbquery = "SELECT email_address FROM usr_db WHERE email_address = '".$email_address."'";
		//prepare
		if(!($stmt = $mysqli->prepare($dbquery))) {
			echo "Failed to prepare query";
		}
		//execute
		if(!$stmt->execute()){
			echo "Failed to execute";
		}
		
		$result = 0;
		while($stmt->fetch()) {
			$result += 1;
		}
		
		if($result > 0) {
			echo "email_address is already in use";
		}
		else {
			add_user($email_address, $password, $fname, $lname, $mysqli);
		}
	}
	else {
		//do something
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create an account</title>

	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/docs.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="stylesheets/bootstrap/js/bootstrap.min.js"></script>		

</head>
<body>
<div class="container">
	<h1 class="pageHeader">Create a new account</h1>
        <p id="message">Welcome to Cure Poverty with the Lottery Website! Please sign up to use our exciting website.</p>
	<form id ="signup" action="signup.php" method="POST">
			<legend>Enter account information</legend>
			<p>Choose a email_address and password</p>
			<div class="form-group">
				<input 	type="text" 
						class="form-control" 
						placeholder="email_address" 
						id="email_address"
						name="email address">
				<input type="password"
						class="form-control"
						placeholder="password"
						id="password"
						name="password">
			<p><br>Please provide your first and last name</p>
 				<input type="text"
						class="form-control"
						placeholder="first name"
						id="fname"
						name="fname">
	 			<input type="text"
						class="form-control"
						placeholder="last name"
						id="lname"
						name="lname">
			</div>
			<button class="btn btn-primary" id="sendForm">Create</button>

	</form>
	<br>
	<div id="afterButton"></div>

</div>


	<script>
	$(document).ready(function(){
		//submit form
		$("#sendForm").click(function() {
			checkAndSendForm();
			event.preventDefault();
		});
	});

	function checkAndSendForm(){
		var formData = $("#signup").serialize();
		$.ajax({
				type: "POST",
				url: "make_account_ajax.php",
				data: formData,
				success: function( data ) {

					if (data == 1) {
						alert("account created successfully, now signing in");
						window.location.replace("./profile_page.php");
					}
					else {
						$("#afterButton").html(data);
					} 

				},
				dataType: "html"
		});
	}
	
	</script>
</body>
</html>