<?php
ini_set('display_errors', 'On');
$mypassword = "l0BejOWA5vkS30Mz";
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lagrewj-db", $mypassword, "lagrewj-db");
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

//testing if email exists 
function test_acct_already_exists($mysqli){
  $test_name="test_add_acct";
  $expected_outcome= "'jonlagrew@gmail.com' is unavailable";
  //we know that email jonlagrew@gmail.com is already taken

  //define test
  $test = !(email_available("jonlagrew@gmail.com", $mysqli));
  if ($test) {
    $actual = "true";
  }
  else {
    $actual = "false";
  }
  echo "<b>".$test_name."</b>: expectation  '".$expected_outcome."' is <b><i>".$actual."</i></b>";
}

//testing function 
function email_available($test_name, $mysqli){

  $dbquery= "SELECT email_address FROM usr_db WHERE email_address='".$test_name."'";
  //prepare
  if (!($stmt = $mysqli->prepare($dbquery))) { echo "Falied to prepare query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
  //execute
  if (!$stmt->execute()) {echo "Falied to execute query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
  //bind
  $db_usr = NULL;
  if (!($stmt->bind_result($db_usr))) {echo "Falied to bind parameters (".$mysqli->connect_errno.") </p>".$mysqli->connect_error;}
  //evaluate
  $result=0;
  $db_temp = NULL;
  while ($stmt->fetch()) {
    $result += 1;
    $db_temp = $db_usr;
  }
  $stmt->close();
  if ($db_temp) {
    return 0;
  }
  else 
    return 1;
}
//running test
test_acct_already_exists($mysqli);

//will add donation unit test (will check if balance in causes has changed by donation amount)
?>
