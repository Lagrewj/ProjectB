<?php
//CONNECT
$mypassword = "l0BejOWA5vkS30Mz";
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lagrewj-db", $mypassword, "lagrewj-db");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		/*
		else {
			echo "connected";
		}
*/
?>
