<?php
ini_set('display_errors', 'On');
session_start();
if (!(isset($_SESSION['logged_in_status']))){
header('Location: ./signin.php');
exit;
}
$usr = $_SESSION['email_address'];
require "./db_connect.php";
require "./profile_page_functions.php";
require "./navigation.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Profile</title>

	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/docs.min.css">
	

</head>
<body>
<div class="container-fluid">
    <?php
        echo $navbar; ?>
	<h2 class="pageHeader">Profile</h2>
	<legend>Name</legend>
		<?php
      
        $html_str = load_profile ($mysqli, $usr);
        echo $html_str;
        ?>
</div>

<script src="stylesheets/bootstrap/js/jquery-1.11.0.min.js"></script>
<script src="stylesheets/bootstrap/js/bootstrap.min.js"></script>	
</body>
</html>
