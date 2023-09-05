<?php

include('db.php');

if($_POST['id']) {
  // Connection
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
  $sql_check = "SELECT * FROM cm_ho_working_plans WHERE STAFF_ID = '{$_POST["id"]}' AND WORK_DATE = '{$date_day}'";
  $result_check = $conn->query($sql_check);
  if($result_check->num_rows > 0) {
    $end_time="00:00:00";
    $id = (int) $_POST["id"];
    // $updateQuery = "UPDATE cm_ho_working_plans SET TIME_START = '{$date_day}', TIME_END = '{$end_time}' WHERE STAFF_ID = '{$id}' AND WORK_DATE = '{$date_day}'";
    // $conn->query($updateQuery);

      // Prepare the SQL statement
    $sql = "UPDATE cm_ho_working_plans SET TIME_START = ?, TIME_END = ? WHERE STAFF_ID = ? AND WORK_DATE = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters and execute the statement
    $stmt->bind_param("ssss", $date_day, $end_time, $id, $date_day);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
      echo "Update successful";
    } else {
      echo "Update failed";
    }

    // Close the statement and database connection
    $stmt->close();

    echo "1";
  } else {
    $sql = "INSERT INTO cm_ho_working_plans (STAFF_ID, WORK_DATE, TIME_START) VALUES ('{$_POST["id"]}', '{$date_day}', '{$date_time}')";
    $result = $conn->query($sql);
    echo "0";
  }

  $conn->close();
}

?>