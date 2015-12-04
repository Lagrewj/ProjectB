<?php
	session_start();
	//Turn on error reporting
	ini_set('display_errors', 'On');
	
	if(!isset($_SESSION['email_address']) && !isset($_SESSION['logged_in_status'])) {
		header("Location: signin.php");
		exit();
	}
	
	//Connects to the database
	require "./db_connect.php";
	require "./navigation.php";
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}	
if(!($stmt = $mysqli->prepare("UPDATE causes, usr_db SET causes.credits = causes.credits + ?, usr_db.credits = usr_db.credits - ? WHERE causes.id = ? AND usr_db.email_address = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("iiis",$_POST['donation'],$_POST['donation'],$_POST['id'],$_SESSION['email_address']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Successful Donation! Thank you.";	
}
?>
