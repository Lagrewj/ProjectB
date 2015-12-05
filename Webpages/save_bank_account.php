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

 	if(!($stmt = $mysqli->prepare("INSERT INTO bank_account(user_id, bank_name, account_type, bank_routing_number, bank_account_number) VALUES (?, ?, ?, ?, ?)"))) {
 		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
 	}

 	if(!($stmt->bind_param("issii", $_POST['user_id'], $_POST['bank_name'], $_POST['account_type'], $_POST['routing_number'], $_POST['account_number']))) {
 		echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
 	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
		echo '<input type="hidden" name="withdrawalSuccess" value="no">';
	} else {
		echo '<input type="hidden" name="accountSuccess" value="yes">';
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
?>
