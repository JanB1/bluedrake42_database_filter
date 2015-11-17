<?php
// Script "Database 'xf_user_input_value' for particular user groups and "field_id"s
// Copyright (C) 2015  J. Baumann
// GNU License v3
//
// Customer: Bluedrake42, bluedrake42@gmail.com
// Author: J4nB1, janbumer1@gmail.com
// Reviewer: AlabasterSlim, marc.sutherland@gmail.com
// Date: 03.11.2015
//
// Version history:
// v0.1, 03.11.2015 22:04 GMT+1: First version of the script
// v0.2, 03.11.2015 23:11 GMT+1: Added option to choose if data should get serialized or not, changed output data to PR_names
// v0.3, 03.11.2015 23:43 GMT+1: Added filters for output data, updated header of script
// v0.4, 03.11.2015 23:59 GMT+1: Updated header of script
// v0.5, 04.11.2015 15:32 GMT+1: Updated variable names (standardization), altered some comments
// v0.6, 04.11.2015 16:16 GMT+1: Added function "sqlQuery", preparing for implementation of function
// v0.7, 05.11.2015 23:04 GMT+1: Implemented function "sqlQuery"
// v0.8, 06.11.2015 00:07 GMT+1: Changed output so that each name gets written to a new line, changed output method from "file_put_contents" to "fopen"/"fwrite"
// v1.0, 06.11.2015 00:29 GMT+1: Changed outcome to prefix 'reservedSlots.addNick "' and suffix '" . "\n"', Changed default filename to "reservedslots.con"
//
// Description: Filters data from the bluedrake42.com database (tables "xf_user" and "xf_user_field_value").

// Config Variables
// IP of the Server
$serverName = "localhost";

// Login name
$userName = "******";

// Login password
$password = "******";

// Database name
$dbName = "drake";

// Groups ids to filter for (default "3,7,8,11,12")
$groupIds = array(3, 7, 8, 11, 12);

// Field id to filter for (default "projectreality")
$fieldId = 'projectreality';

// Name of the file where the data should get put to (default "reservedslots.con")
$fileName = 'reservedslots.con';

// Define if you want the output serialized or not (default "FALSE")
$serialized = false;

/*============================================================*/

// System Variables (do not change)
$userIds1 = array();
$userIds2 = array();
$prNames = array();
$data;

/*============================================================*/
// Functions

// Query function
function sqlQuery ($connection, $query, $arrayKey, &$resultArray) {
  // Config variables
  $result;
  $i = 0;
  $row;

  // Execute query
  $result = mysqli_query($connection, $query);

  // Restructure results of query (associative array) to numeric array
  while ($row = mysqli_fetch_assoc($result)) {
    $resultArray[$i] = $row[$arrayKey];
    $i++;
  }
}

/*============================================================*/
// Procedure

// Establish connection to database
$conn = mysqli_connect($serverName, $userName, $password, $dbName);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Join given group ids
$groupIdsJoined = join(',', $groupIds);

// SQL-Query to filter for users in "xf_user" with given group id
$sql1 = "SELECT user_id FROM xf_user WHERE secondary_group_ids IN ($groupIdsJoined)";

// SQL-query function call 1
sqlQuery ($conn, $sql1, 'user_id', $userIds1);

// Join user id's fetched from previous query
$userIdsJoined = join(',', $userIds1);

// SQL-Query to filter for users in "xf_user_field_value" for user ids fetched from previous query and given field id
$sql2 = "SELECT user_id, field_value FROM xf_user_field_value WHERE user_id IN ($userIdsJoined) AND field_id = '$fieldId'";

// SQL-query function call 2
sqlQuery ($conn, $sql2, 'field_value', $prNames);

// Close SQL-Database connection
$conn->close();

if ($serialized) {
  // If $serialized is set TRUE, serialize data
  $data = serialize($prNames);
} else {
  // If not, just print it
  //$data = print_r(join(', ', array_filter($prNames)), true);
  $data = array_filter($prNames);
}

// Output data to file with given filename and ending
$fp = fopen($fileName, 'w');
foreach ($data as $key => $val) {
  fwrite($fp, 'reservedSlots.addNick "' . $val . '"' . "\n");
}
fclose($fp);
?>
