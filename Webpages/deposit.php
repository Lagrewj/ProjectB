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
			<form method="post" action="deposit_transaction.php">
				<fieldset>
					<legend>Deposit Amount:</legend>
					$<input type="number" placeholder="0.00" name="deposit" /><br><br><br>
					<input type="submit" value="Deposit" />
				</fieldset>
			</form>
	</body>
</html>