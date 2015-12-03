<?php 
		session_start();
		ini_set('display_errors', 'On');//errors on
		include 'db_connect.php';//db password
		
		$email_address = isset($_POST["email_address"])?$_POST["email_address"]:"";
		$password = isset($_POST["password"])?$_POST["password"]:"";
		$fname = isset($_POST["fname"])?$_POST["fname"]:"";
		$lname = isset($_POST["lname"])?$_POST["lname"]:"";
		
		//CONNECT
		/*
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lagrewj-db", $mypassword, "lagrewj-db");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}*/
		
		//ADDED BELOW
		//check email_address in the database to see if it exists
	  $results = mysqli_query($mysqli,"SELECT email_address FROM usr_db WHERE email_address='$email_address'");
	  $email_address_exist = mysqli_num_rows($results); //number of rows returned from the query
	  
	  //if returned value is more than 0, email_address is not available
	  if($email_address_exist) {
		  echo "The email_address ".$email_address." already exists.";
	  }
	  else {
				//PREPARE THE STATEMENT TO ENTER INFO INTO TABLE
		if (!($stmt = $mysqli->prepare("INSERT INTO usr_db(email_address, pass, first_name, last_name) VALUES (?, ?, ?, ?)"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		//BIND VARIABLES TO BE INSERTED INTO TABLE
		if (!$stmt->bind_param("ssss", $email_address, $password, $fname, $lname)) {
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		//EXECUTE
		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$_SESSION['email_address'] = $email_address;
		//$_SESSION['password'] = $password;
		?>
			Account successfully created! <input type="button" onclick="profileGo();" value="Go to Profile">
			<script>
			function profileGo() {
				window.location.href = "profile_page.php";
			}
			</script>
			
		<?php
	  }
	?>