<?php
// Turn on error reporting
ini_set('display_errors', 'On');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lagrewj-db", "l0BejOWA5vkS30Mz", "lagrewj-db");

// Connect to database
if ($mysqli->connect_errno) {
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("UPDATE usr_db SET credits = ? WHERE email_address = ?"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->bind_param("is", $_POST['credits'], $_POST['emailID']))) {
	echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

if (!($stmt->execute())) {
	echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
}

$stmt->close();