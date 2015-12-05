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
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Using Lottery to Cure Poverty</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="jQuery-SlotMachine/dist/jquery.slotmachine.js"></script>
		<script type="text/javascript" src="donate_script.js"></script>
        <script type="text/javascript">
            var $_SESSION = <?php echo json_encode($_SESSION); ?>;
            var emailID = $_SESSION['email_address']
            
            // console.log(emailID);  
        </script>
</head>
<body>
<div class="container">
	<?php echo $navbar; ?>
	<h1 class="pageHeader">Money Tracker Page<br></br></h1>

<?php
if(!($stmt = $mysqli->prepare("SELECT id, cause_name, credits, goal FROM causes"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $cname, $credits, $goal)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

echo "<table class='table'>
		<tr>
			<th>Charity</th>
				<th>Total Received</th>
				<th>Goal Amount</th>
				<th>Percentage of Goal Achieved</th>
			</tr>";
while($stmt->fetch()){
	$percent = $credits/$goal;
	$percent = number_format((float)$percent, 2, '.', '');
	echo "<tr>
			<td>$cname</td>
			<td>$credits</td>
			<td>$goal</td>
			<td>$percent%</td>
		</tr>";
}
echo "</table>";
$stmt->close();
?>
	
</div>
</body>
</html>