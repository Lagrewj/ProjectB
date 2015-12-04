<?php
ini_set('display_errors', 'On');
session_start();
require "db_connect.php";

if (array_key_exists("fname", $_POST)
	&& array_key_exists("lname", $_POST)
	&& array_key_exists("email_address", $_POST)
	&& array_key_exists("password", $_POST)
	) 
{
	$first_name = mysqli_real_escape_string( $mysqli, $_POST['fname']);
	$last_name = mysqli_real_escape_string( $mysqli, $_POST['lname']);
	$email_address = mysqli_real_escape_string( $mysqli, $_POST['email_address']);
	$password = mysqli_real_escape_string( $mysqli, $_POST['password']);

	//validate input
	if (strlen($email_address) < 4)
		echo "<pre>email_address too short</pre>";
	else if (strlen($password) < 4)
		echo "<pre>password too short</pre>";
	/*
	else if (!(email_address_available($email_address, $mysqli)))
		echo "<pre>email_address already taken</pre>";
	*/
	else {
		//attempt to add to database
		//prepare
		$create_query = "
		INSERT INTO usr_db(
			email_address, 
			password, 
			first_name, 
			last_name)
		VALUES (?, ?, ?, ?)
		";
		if (!($stmt = $mysqli->prepare($create_query))) { echo "Falied to prepare query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
		if (!($stmt->bind_param('ssss', $email_address, $password, $first_name, $last_name))) {echo "<script>alert('failed to bind parameters')</script>";}
		if (!$stmt->execute()) {echo "Falied to execute query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}

		//set session email_address and logged in status
		$_SESSION['email_address'] = $email_address;
		$_SESSION['first_name'] = $first_name;
		$_SESSION['last_name'] = $last_name;
		$_SESSION['logged_in_status'] = 1;
		//go to landing page
		echo "1";

	}
}
else 
	echo "<pre>didn't work</pre>";

function email_address_available($test_name, $mysqli){
	/*
	$results = mysqli_query($mysqli,"SELECT email_address FROM usr_db WHERE email_address='".$test_name."'");
	$email_address_exist = mysqli_num_rows($results); //number of rows returned from the query
	if (!$email_address_exist)
		return 1;
	else
		return 0;
	*/
	//if ($mysqli->connect_errno){ echo "<script>alert('Failed to connect to MySQL (".$mysqli->connect_errno.") ".$mysqli->connect_error."')</script>";}
	$dbquery= "SELECT email_address FROM usr_db WHERE email_address='".$test_name."'";
	//db query: prepare->execute->bind->evaluate
	//prepare
	if (!($stmt = $mysqli->prepare($dbquery))) { echo "Falied to prepare query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
	//execute
	if (!$stmt->execute()) {echo "Falied to execute query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
	//bind
	$db_usr = NULL;
	if (!($stmt->bind_result($db_usr))) {echo "Falied to bind parameters (".$mysqli->connect_errno.") </p>".$mysqli->connect_error;}
	//evaluate
	$result=0;
	$db_temp = NULL;
	while ($stmt->fetch()) {
		$result += 1;
		$db_temp = $db_usr;
	}
	$stmt->close();
	if ($db_temp) {
		return 0;
	}
	else 
		return 1;
}

?>