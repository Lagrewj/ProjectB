<?php
ini_set('display_errors', 'On');
session_start();

require "./db_connect.php";
require "./profile_page_functions.php";
if (!(isset($_SESSION['logged_in_status']))){
  header('Location: ./signin.php');
  exit;
}
$usr = $_SESSION['email_address'];
	
	$first_name = isset($_POST["first_name"])?trim($_POST["first_name"]):"";
	$last_name = isset($_POST["last_name"])?trim($_POST["last_name"]):"";

	//PREPARE THE STATEMENT TO ENTER INFO INTO TABLE
	if (!($stmt = $mysqli->prepare("UPDATE usr_db SET first_name = ?, last_name = ? WHERE email_address = ?"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	//BIND VARIABLES TO BE INSERTED INTO TABLE
	if (!$stmt->bind_param("sss", $first_name, $last_name, $usr)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	//EXECUTE
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	else {
		//echo "success"
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>attempting update...</title>
</head>
<body>
<script>
	//sleep(10);
	window.location.replace("http://web.engr.oregonstate.edu/~lagrewj/CS361/ProjectB/Webpages/update_profile.php");
</script>	
</body>
</html>
