<?php
$servername = "localhost";
$username = "root";
// $username = "remote";
$password = "";
// $password = "Password123";
$databasename = "time";
 
// Connection
$conn = new mysqli($servername,$username, $password, $databasename);
 
// For checking if connection is
// successful or not
if ($conn->connect_error) {
  echo "connection failed";
  die("Connection failed: "
      . $conn->connect_error);
}
?>