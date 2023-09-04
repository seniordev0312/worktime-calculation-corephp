<?php

include('db.php');

$conn = new mysqli($servername,$username, $password, $databasename);

// For checking if connection is
// successful or not
if ($conn->connect_error) {
  echo "connection failed";
  die("Connection failed: "
      . $conn->connect_error);
}
$date_time = date("h:i:s");

$sql = "SELECT TIME_START, WORK_DATE from cm_ho_working_plans WHERE STAFF_ID='{$_GET["id"]}'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if(date("Y-m-d") == $row['WORK_DATE']) {
      $hrs = round(abs(strtotime($date_time) - strtotime($row['TIME_START'])) / 3600);
      $minutes = round(abs(strtotime($date_time) - strtotime($row['TIME_START'])) / 60) - 60*$hrs;
      if($hrs == 0) {
        echo "". $minutes . " minutes";
      } 
      if($minutes == 0) {
        echo $hrs . " hours";
      }
    }
    
  }
} else {
  echo "0 results";
}

?>