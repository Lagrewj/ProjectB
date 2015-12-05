<?php
ini_set('display_errors', 'On');
$mypassword = "l0BejOWA5vkS30Mz";
    $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "lagrewj-db", $mypassword, "lagrewj-db");
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

//testing if cause name is correct
function cause_name_is_correct($mysqli){
  $test_name='cause_name_is_correct_test';
  $expected_outcome= "American Heart Association";
  //we know that American Heart Association is the first cause in the table

  //define test
  $test = !(get_cause_name(1, $mysqli));
  if ($test) {
    $actual = "true";
  }
  else {
    $actual = "false";
  }
  echo "<b>".$test_name."</b>: expectation  '".$expected_outcome."' is <b><i>".$actual."</i></b>";
}

//testing function 
function get_cause_name($test_name, $mysqli){

  $dbquery= "SELECT cause_name FROM causes WHERE id='".$test_name."'";
  //prepare
  if (!($stmt = $mysqli->prepare($dbquery))) { echo "Failed to prepare query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
  //execute
  if (!$stmt->execute()) {echo "Failed to execute query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
  //bind
  $db_usr = NULL;
  if (!($stmt->bind_result($cause))) {echo "Failed to bind parameters (".$mysqli->connect_errno.") </p>".$mysqli->connect_error;}
  //evaluate
  $result=0;
  $db_temp = NULL;
  while ($stmt->fetch()) {
    $result += 1;
    $db_temp = $cause;
  }
  $stmt->close();
  if ($db_temp) {
    return 0;
  }
  else 
    return 1;
}

//running test
cause_name_is_correct($mysqli);