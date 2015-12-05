<?php
	session_start();

	ini_set('display_errors', 'On');

  if(!isset($_SESSION['logged_in_status'])) {
	 	header("Location: signin.php");
	 	exit();
	}

 	require "./db_connect.php";
 	require "./navigation.php";
?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<form method="post" action="deposit.php" id="successForm">
			<fieldset border="0">

<?php
if(!$mysqli || $mysqli->connect_errno){
 	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}	

 	if(!($stmt = $mysqli->prepare("UPDATE `usr_db` SET `credits`=`credits` + ? WHERE `email_address` = ?"))) {
 		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
 	}

 	if(!($accstmt = $mysqli->prepare("UPDATE `bank_account` SET `credits`=`credits` - ? WHERE `bank_account_id` = ?"))) {
 		echo "Prepare failed: " . $accstmt->errno . " " . $accstmt->error;
 	}

 	if(!($stmt->bind_param("is", $_POST['deposit'], $_SESSION['email_address']))) {
 		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
 	}

 	if(!($accstmt->bind_param("ii", $_POST['deposit'], $_POST['account_info']))) {
 		echo "Bind failed: " . $accstmt->errno . " " . $accstmt->error;
 	}

if(!$stmt->execute()) {
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	echo '<input type="hidden" name="depositSuccess" value="no">';
} else if(!$accstmt->execute()) {
	echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
	echo '<input type="hidden" name="depositSuccess" value="no">';
} else {
	echo '<input type="hidden" name="depositSuccess" value="yes">';

?>

			</fieldset>
		</form>
	</body>
</html>

<script type="text/javascript">
	document.getElementById('successForm').submit();
</script>

<?php
}

$_SESSION['credits'] = $_SESSION['credits'] + $_POST['deposit'];
?>