<?php
  include '../db_connect.php';
  $pulo_id = 6;
  
  $pulo_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_barangay=?");
  $pulo_sql->bind_param("ii", $event_id, $pulo_id);
  $pulo_sql->execute();
  $pulo_result = $pulo_sql->get_result();
  $pulo_rows = mysqli_num_rows($pulo_result);
  

  $barangay_array = array("0", "0", "0", "0", "0", $pulo_rows, "0", "0", "0");


  $js_array = json_encode($barangay_array);
?>