<?php

include('db.php');

if($_POST['id']) {
  $conn = new mysqli($servername,$username, $password, $databasename);
  date_default_timezone_set('Europe/London');

  // For checking if connection is
  // successful or not
  if ($conn->connect_error) {
    echo "connection failed";
    die("Connection failed: "
        . $conn->connect_error);
  };

  $getQuery = "SELECT * FROM cm_ho_working_report_plans WHERE STAFF_ID = '{$_POST['id']}' AND STATUS = 'pending'";

  $result = $conn->query($getQuery);

  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo json_encode($row);
    }
  }
}

?>