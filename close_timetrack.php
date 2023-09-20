<?php

include('db.php');

if($_POST['id']) {
  // Connection
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

  $sql_select = "SELECT * FROM cm_ho_working_plans WHERE STAFF_ID = '{$_POST['id']}' AND WORK_DATE = '$date_day'";
  $result_select = $conn->query($sql_select);
  if ($result_select->num_rows > 0) {
    while ($row = $result_select->fetch_assoc()) {
      // Access the data from the row
      $work_hours = 0;
      $total_hour = $row['HOURS_TOTAL'];
      $hrs = round(abs(strtotime($date_time) - strtotime($row['TIME_START'])) / 3600, 2);
      if($total_hour == 0.00 || null) {
        if($hrs <= 8.00) $work_hours = $hrs;
        else $work_hours = 8.00;
      } else {
        if($hrs <= 8.00) $work_hours = $hrs;
        else if($hrs > 8.00 && $hrs < 9.00) $work_hours = 8.00;
        else $work_hours = $hrs - 1;
      }
      $worked_hours = $work_hours + $row['HOURS_WORK'];
      
      // Update the row in the database
      $updateQuery = "UPDATE cm_ho_working_plans SET HOURS_WORK='$worked_hours', TIME_END='$date_time' WHERE STAFF_ID ='{$_POST['id']}' AND WORK_DATE = '$date_day'";
      $updateResult = $conn->query($updateQuery);
      
      if (!$updateResult) {
          echo "0";
      } else {
        echo "1";
      }
      echo $row['TIME_START'];
    }
  } else {
      echo "No records found.";
  }

  $conn->close();

}

?>