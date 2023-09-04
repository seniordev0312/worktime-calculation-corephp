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
    if($row['HOURS_WORK'] ) {
      echo round(abs($row['HOURS_WORK'])) . " hours ". round(60*($row['HOURS_WORK'] - round(abs($row['HOURS_WORK'])))). " minutes timetracked";
    } 
    else {
      $hrs = round(abs(strtotime($date_time) - strtotime($row['TIME_START'])) / 3600);
      $minutes = round(abs(strtotime($date_time) - strtotime($row['TIME_START'])) / 60) - 60*$hrs;
      if($hrs >= 9) {
        echo "You have overworked " . round(abx($hrs - 9)) . "hours. Please Submit the request";
      } else {
        if($hrs < 1) {
          echo "". $minutes . " minutes timetracked";
        } else if($minutes == 0) {
          echo $hrs . " hours timetracked";
        } else {
          if($hrs > 8) {
            echo round(abx($hrs)) . "hours timetracked";
          } else {
            echo $hrs . "hours ". $minutes . "minutes timetracked";
          }
        }
      }
      
    }
    
  }
} else {
  echo "0 results";
}

?>