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

  if($_POST['id']) {
    $updateQuery = "UPDATE cm_ho_working_report_plans SET STATUS='done' WHERE id ='{$_POST['id']}'";
    // try {
    $updateResult = $conn->query($updateQuery);
    //   echo "success";
    // } catch(error) {
    //   echo error;
    // }
    $id = (int)$_POST['id'];
    $getQuery = "SELECT * FROM cm_ho_working_report_plans WHERE id ={$id}";
    $getResult = $conn->query($getQuery);

    if($getResult->num_rows > 0) { 
      while($row = $getResult->fetch_assoc()) {
        if($row) {
          echo json_encode($row);
        }
      }
    }

  }
?>