<?php

include('db.php');

if($_POST['passcode']) {

    // Connection
  $conn = new mysqli($servername,$username, $password, $databasename);

  // For checking if connection is
  // successful or not
  if ($conn->connect_error) {
    echo "connection failed";
    die("Connection failed: "
        . $conn->connect_error);
  }

  $sql = "SELECT * FROM cm_ho_staff WHERE SID='{$_POST['id']}'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if(strval($row['PERSONAL_PIN']) == strval($_POST['passcode'])) {
        echo "1";
      } else {
        echo "0";
      }
    }
  } else {
    echo "0 results";
  }
  $conn->close();
}

?>