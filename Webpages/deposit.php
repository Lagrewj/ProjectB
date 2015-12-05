<?php
	ini_set('display_errors', 'On');
	session_start();

	if(!(isset($_SESSION['logged_in_status']))) {
		header('Location: ./signin.php');
		exit;
	}

	require "./db_connect.php";
	require "./navigation.php";

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Deposit Money</title>

		<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="stylesheets/bootstrap/css/docs.min.css">

		<script src="stylesheets/bootstrap/js/jquery-1.11.0.min.js"></script>
		<script src="stylesheets/bootstrap/js/bootstrap.min.js"></script>	
		<script type="text/javascript" src="donate_script.js"></script>
	</head>
	<body>
	<div class="container">
		<?php
			echo $navbar; ?>

			<h1 class="pageHeader"><?php echo $_SESSION['first_name']; ?>'s Deposit Page</br></br></h1>
			<h3> Current Balance: $<?php echo $_SESSION['credits']; ?><br></br></h3>

			<form method="post" action="save_bank_account.php">
				<fieldset>
					<legend>Add Bank Account:</legend>
					<input type="text" placeholder="Bank Name" name="bank_name" />
					<select name="account_type">
						<option value="Checking">Checking</option>
						<option value="Savings">Savings</option>
					</select><br><br>
					<input type="number" name="routing_number" min="100000000" max="999999999" placeholder="Routing Number" />
					<input type="number" name="account_number" min="10000000" placeholder="Account Number" /><br><br>
					<?php
						// Get user id using the email address
						if(!($stmt = $mysqli->prepare("SELECT user_id FROM usr_db WHERE email_address = ?"))) {
							echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
						}

						$stmt->bind_param("s", $_SESSION['email_address']);

						if(!$stmt->execute()) {
							echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if(!$stmt->bind_result($id)) {
							echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						while($stmt->fetch()) {}
						
						echo '<input type="hidden" name="user_id" value="' . $id . '"/>';
					?>
					<input type="submit" value="Add Account" /><br>

				</fieldset>
			</form>

>>>>>>> 1062f60262437796c07813b36658eb5b31f7f10e
			<form method="post" action="deposit_transaction.php">
				<fieldset>
					<legend>Deposit Amount:</legend>
					$<input type="number" placeholder="0.00" name="deposit" />
					
					Choose Account: <select name="account_info">
					<?php

					if(!($stmt = $mysqli->prepare("SELECT bank_name FROM bank_account WHERE user_id = ?"))) {
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}

					$stmt->bind_param("i", $id);

					if(!$stmt->execute()) {
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($bank_name)) {
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					while($stmt->fetch()) {
						echo '<option value=" ' . $bank_name . ' ">' . $bank_name . '</option>\n';
					}


					?>
					</select>
					<br><br>
					<input type="submit" value="Deposit" />
				</fieldset>
			</form>
	</body>
</html>