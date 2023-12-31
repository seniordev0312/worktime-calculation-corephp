<?php

include('db.php');

$conn = new mysqli($servername,$username, $password, $databasename);
date_default_timezone_set('Europe/London');

// For checking if connection is
// successful or not
if ($conn->connect_error) {
  echo "connection failed";
  die("Connection failed: "
      . $conn->connect_error);
}
$date_time = date("H:i:s");
$date_day = date("Y-m-d");

$sql = "SELECT TIME_START, TIME_END, WORK_DATE, HOURS_WORK, HOURS_TOTAL from cm_ho_working_plan_data WHERE STAFF_ID = '{$_GET["id"]}' AND WORK_DATE='$date_day'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $hours_work;
    $request_hour;
    if($row['HOURS_TOTAL'] == null) $request_hour = 0;
    else $request_hour = $row['HOURS_TOTAL'];
    if($row['HOURS_WORK'] == null) $hours_work = 0;
    else $hours_work = $row['HOURS_WORK'];
    $current_hours = (abs(strtotime($date_time) - strtotime($row['TIME_START'])) / 3600) + $hours_work;
    if($current_hours > 9 + $request_hour) {
      $current_hours = 8 + $request_hour;
    }
    if($row['TIME_END'] !== null && strtotime($row['TIME_END']) - strtotime($row['TIME_START']) > 0) {
      $current_hours = $hours_work;
    }
    $current_hour = floor($current_hours);
    $current_mintues = floor(($current_hours - $current_hour) * 60);
    if($current_mintues == 0) {
      echo $current_hour . " hours timetracked!";
    } else if($current_hour == 0) {
      echo $current_mintues. " minutes timetracked!";

    } else {
      echo $current_hour . " hours " .$current_mintues. " minutes timetracked!";

    }
  }
} else {
  echo "0 results";
}

?>