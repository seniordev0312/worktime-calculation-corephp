<?php

include('db.php');
date_default_timezone_set('Europe/London');

  // Connection
  $conn = new mysqli($servername,$username, $password, $databasename);
   
  // For checking if connection is
  // successful or not
  if ($conn->connect_error) {
    echo "connection failed";
    die("Connection failed: "
        . $conn->connect_error);
  }
for($i = 0; $i < count($_GET['sid']); $i ++) {

  $id = $_GET['sid'][$i];
  $sql = "SELECT * FROM cm_ho_working_plans WHERE STAFF_ID = '{$id}'";
  $result = $conn->query($sql);
  $status = "0";
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if($row['WORK_DATE'] == date("Y-m-d")) {
        if($row['TIME_END'] !== null & $row['TIME_END'] !== '00:00:00') {
          $status = "1";
          break;
        }
      } 
    }
  }
  echo $status . ',';
}
?>