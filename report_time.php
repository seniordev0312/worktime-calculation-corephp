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
$date_day = date("Y-m-d");

$sql = "SELECT TIME_START, WORK_DATE, HOURS_WORK, HOURS_TOTAL from cm_ho_working_plans WHERE STAFF_ID = '{$_GET["id"]}' AND WORK_DATE='$date_day'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    
      $hrs = round(abs(strtotime($date_time) - strtotime($row['TIME_START']) + $row['HOURS_WORK'] * 3600) / 3600);
      $minutes = round(abs(strtotime($date_time) - strtotime($row['TIME_START']) + $row['HOURS_WORK'] * 3600) / 60) - 60*$hrs;
      if($hrs >= 9) {
        echo ($hrs - 9) . " hours overworked. Please submit the request!";
      } else {
        echo "No overtime yet!";
      }
    
  }
} else {
  echo "0 results";
}

?>