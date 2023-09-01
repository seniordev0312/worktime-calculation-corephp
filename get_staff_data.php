<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $databasename = "time";
   
  // Connection
  $conn = new mysqli($servername,$username, $password, $databasename);
   
  // For checking if connection is
  // successful or not
  if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
  }
  $sql = "SELECT * FROM cm_ho_staff";

  $result = $conn->query($sql);
  $final_result = [];

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo json_encode($row);
    }
    // echo json_encode($result);
    // echo json_encode($result);
    // $final_result.push($result);
  } else {
    echo "0 results";
  }
  $conn->close();
  // echo $final_result;
?>