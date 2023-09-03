<?php
  include('db.php');
   
  // Connection
  $conn = new mysqli($servername,$username, $password, $databasename);

  $sql = "SELECT * FROM cm_ho_staff";

  $result = $conn->query($sql);
  $final_result = [];

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($row['LEFT'] == '0000-00-00' || !$row['LEFT']) {
        
        echo json_encode($row);
      }
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