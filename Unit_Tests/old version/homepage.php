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
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/docs.min.css">
<body>
<div class="container">
	<?php echo $navbar; ?>
	<h1 class="pageHeader"><?php echo $_SESSION['first_name']; ?>'s Donation Page</br></br></h1>
</div>
</body>
</html>
