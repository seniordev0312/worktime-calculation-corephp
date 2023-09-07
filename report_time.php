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

$sql = "SELECT * from cm_ho_working_plans WHERE STAFF_ID = '{$_GET["id"]}'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row['HOURS_TOTAL'] != "0.00" || $row['HOURS_TOTAL'] != null){
      echo json_encode($row);
    }
    
  }
} else {
  echo "0 results";
}

?>