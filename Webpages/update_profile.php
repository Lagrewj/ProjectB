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
	
	$experience = isset($_POST["experience"])?trim($_POST["experience"]):"";
	$bio = isset($_POST["bio"])?trim($_POST["bio"]):"";

	//PREPARE THE STATEMENT TO ENTER INFO INTO TABLE
	if (!($stmt = $mysqli->prepare("UPDATE usr_db SET experience = ?, bio = ? WHERE email_address = ?"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	//BIND VARIABLES TO BE INSERTED INTO TABLE
	if (!$stmt->bind_param("sss", $experience, $bio, $usr)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	//EXECUTE
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	else {
		//echo "success"
		//echo "<html><head><title>Success!</title></head><body> <p> Success!</p> </body> </html>";
		//header('Location: http://web.engr.oregonstate.edu/~osterbit/cs361/cs361_project_b/pages/profile_page.php');
    	//exit;	
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
	window.location.replace("http://web.engr.oregonstate.edu/~lagrewj/CS361/ProjectB/pages/update_profile.php");
</script>	
</body>
</html>
