<?php
function load_profile ($mysqli, $email_address)
{
	/**/
	$db_query = "
	SELECT  	
		first_name, 
		last_name 
	FROM usr_db 
	WHERE email_address = '".$email_address."'";

	$result= $mysqli->query($db_query);

	$row = mysqli_fetch_array($result);
	
	$fname = $row['first_name'];
	$lname = $row['last_name'];

	$name_f = "<h1>".$fname." ".$lname."</h1>";
	$outputString = $name_f;
	$outputString = "<div class='well'>".$outputString."</div>";
	
	return $outputString;
}


