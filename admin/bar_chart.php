<?php
  include '../db_connect.php';
  $alua_id = 1;
  $calaba_id = 2;
  $malapit_id = 3;
  $mangga_id = 4;
  $poblacion_id = 5;
  $pulo_id = 6;
  $sanRoque_id = 7;
  $santoCristo_id = 8;
  $tabon_id = 9;

  $alua_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_barangay=?");
  $alua_sql->bind_param("ii", $event_id, $alua_id);
  $alua_sql->execute();
  $alua_result = $alua_sql->get_result();
  $alua_rows = mysqli_num_rows($alua_result);

  $calaba_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_barangay=?");
  $calaba_sql->bind_param("ii", $event_id, $calaba_id);
  $calaba_sql->execute();
  $calaba_result = $calaba_sql->get_result();
  $calaba_rows = mysqli_num_rows($calaba_result);

  $malapit_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_barangay=?");
  $malapit_sql->bind_param("ii", $event_id, $malapit_id);
  $malapit_sql->execute();
  $malapit_sql = $malapit_sql->get_result();
  $malapit_rows = mysqli_num_rows($malapit_sql);

  $mangga_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_barangay=?");
  $mangga_sql->bind_param("ii", $event_id, $mangga_id);
  $mangga_sql->execute();
  $mangga_result = $mangga_sql->get_result();
  $mangga_rows = mysqli_num_rows($mangga_result);

  $poblacion_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_barangay=?");
  $poblacion_sql->bind_param("ii", $event_id, $poblacion_id);
  $poblacion_sql->execute();
  $poblaction_result = $poblacion_sql->get_result();
  $poblacion_rows = mysqli_num_rows($poblaction_result);

  $pulo_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_barangay=?");
  $pulo_sql->bind_param("ii", $event_id, $pulo_id);
  $pulo_sql->execute();
  $pulo_result = $pulo_sql->get_result();
  $pulo_rows = mysqli_num_rows($pulo_result);

  $roque_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_barangay=?");
  $roque_sql->bind_param("ii", $event_id, $sanRoque_id);
  $roque_sql->execute();
  $roque_result = $roque_sql->get_result();
  $roque_rows = mysqli_num_rows($roque_result);

  $cristo_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_barangay=?");
  $cristo_sql->bind_param("ii", $event_id, $santoCristo_id);
  $cristo_sql->execute();
  $cristo_result = $cristo_sql->get_result();
  $cristo_rows = mysqli_num_rows($cristo_result);
  
  $tabon_sql = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=? AND senior_barangay=?");
  $tabon_sql->bind_param("ii", $event_id, $tabon_id);
  $tabon_sql->execute();
  $tabon_result = $tabon_sql->get_result();
  $tabon_rows = mysqli_num_rows($tabon_result);
  

  $barangay_array = array($alua_rows, $calaba_rows, $malapit_rows, $mangga_rows, $poblacion_rows, $pulo_rows, $roque_rows, $cristo_rows, $tabon_rows);


  $js_array = json_encode($barangay_array);
?>