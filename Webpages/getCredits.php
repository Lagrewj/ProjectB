<?php
// Turn on error reporting
ini_set('display_errors', 'On');

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lagrewj-db", "l0BejOWA5vkS30Mz", "lagrewj-db");

// Connect to database
if ($mysqli->connect_errno) {
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("SELECT credits FROM usr_db WHERE id = ?"))) {
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->bind_param("i", $_POST['id'])) {
	echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->execute()) {
	echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->bind_result($credits)) {
	echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->fetch()) {
	echo "Fetch failed: " . $stmt->errno . " " . $stmt->error;
}

echo $credits;

$stmt->close();