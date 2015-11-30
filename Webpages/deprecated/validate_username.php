<?php
	ini_set('display_errors', 'On');//errors on
	include 'db_connect.php';//db password
	
	if(isset($_POST["email_address"]))
	{
		//CONNECT
		
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lagrewj-db", $mypassword, "lagrewj-db");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		
	  
	  //received email_address value from registration page
	  $email_address =  $_POST["email_address"]; 

	  //check email_address in database
	  $results = mysqli_query($mysqli,"SELECT email_address FROM usr_db WHERE email_address='$email_address'");
	  
	  $email_address_exist = mysqli_num_rows($results); //number of rows returned from the query
	  
	  //if returned value is more than 0, email_address is not available
	  if($email_address_exist) {
		  echo "The email_address ".$email_address." already exists.";
	  }/*else{
		
	  }*/
	}
?>