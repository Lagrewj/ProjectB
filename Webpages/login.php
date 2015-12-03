<?php
ini_set('display_errors', 'On');
session_start();
require "./db_connect.php";

if (array_key_exists("email_address", $_POST) &&
    array_key_exists("password", $_POST)) 
{
  if (isset($_POST['email_address']) && isset($_POST['password'])) {
    echo processLogin($_POST['email_address'], $_POST['password'], $mysqli);
  }

} else 
{
  echo "didnt work<br>";
}

function processLogin($input_email, $input_pwd, $mysqli) {
	$retval = NULL;
	$result = 0;

	$email_address_clean = mysqli_real_escape_string ( $mysqli, $input_email);
	$password_clean = mysqli_real_escape_string ( $mysqli, $input_pwd);

	$dbquery = "
		SELECT id, email_address, first_name, last_name, credits
		FROM usr_db
		WHERE email_address='".$email_address_clean."' 
  		AND password='".$password_clean."'";
		//prepare
		if (!($stmt = $mysqli->prepare($dbquery))) {echo "Falied to prepare query (".$mysqli->connect_errno.") ".$mysqli->connect_error; }
		//execute
		if (!$stmt->execute()) { echo "Falied to execute query (".$mysqli->connect_errno.") ".$mysqli->connect_error; }
		//bind
		if (!($stmt->bind_result($db_id, $db_email, $db_fname, $db_lname, $db_credits))) { echo "Falied to bind parameters (".$mysqli->connect_errno.") </p>".$mysqli->connect_error;
		}
		//evaluate
		$result = 0;
		while($stmt->fetch()) {
			$result += 1;
		}
		if ($result == 1)
		{
			$retval = 1;
			$_SESSION['id'] = $db_id;
			$_SESSION['email_address'] = $db_email;
			$_SESSION['first_name'] = $db_fname;
			$_SESSION['last_name'] = $db_lname;
			$_SESSION['credits'] = $db_credits;
			$_SESSION['logged_in_status'] = 1;
		}
		else $retval = NULL;
		$stmt->close();

	echo $retval;
}

?>