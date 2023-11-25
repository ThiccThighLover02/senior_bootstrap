<?php
    session_start();
    include "../db_connect.php";
    // If there is a admin status session
    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include "admin_links.php";
    ?>
    <title>Senior System</title>
</head>
  <body class="bg-light" style="overflow-x: hidden;">
    <?php
      include 'admin_navbar.php';
    ?>
    <div class="container-fluid">
      <div class="row gx-5 pt-3" id="navbarSupportedContent">
        <?php
          // this active variable shows the active tab in the side bar
          $active = "actSenior";
          include "admin_left_sidebar.php";  
        ?>

        <!-- Table Starts here -->
        <div class="col-lg-8 p-3 bg-white table-responsive rounded overflow-auto">
          <?php

            list($address_hidden, $hidden_blood, $hidden_civil, $hidden_education, $hidden_religion, $sex_hidden, $birth_hidden) = array_fill(0, 7, "hidden");
            $type = "";

            if(isset($_GET['filwan']) && isset($_GET['filtu'])){
              
              switch($_GET['filwan']){
                case 'barangay':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE barangay_id=?");
                    $sql->bind_param("i", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $address_hidden = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $address_hidden = "";
                    //this is to get the labels of the barangay
                    $label_sql = mysqli_query($conn, "SELECT * FROM barangay_tbl");
                    $labels = array();

                    //This is to get the count of each barangay
                    $barangay_count = $conn->prepare("SELECT senior_barangay_id, COUNT(*) as count FROM senior_tbl GROUP BY senior_barangay_id");
                    $barangay_count->execute();
                    $barangay_result = $barangay_count->get_result();
                    $data = array(
                      "1" => 0,
                      "2" => 0,
                      "3" => 0,
                      "4" => 0,
                      "5" => 0,
                      "6" => 0,
                      "7" => 0,
                      "8" => 0,
                      "9" => 0
                    );

                    while($label_row = mysqli_fetch_assoc($label_sql)){
                      $labels[] = $label_row['barangay_name'];
                    }

                    foreach ($barangay_result as $barangay_row) {
                      $value = $barangay_row['senior_barangay_id'];
                      $count = $barangay_row['count'];
                      
                      $data[$value] = $count;
                    }
                    $color = array(
                        'rgba(255, 99, 132, 0.7)',   // Red
                        'rgba(54, 162, 235, 0.7)',   // Blue
                        'rgba(255, 206, 86, 0.7)',   // Yellow
                        'rgba(75, 192, 192, 0.7)',   // Teal
                        'rgba(153, 102, 255, 0.7)',  // Purple
                        'rgba(255, 159, 64, 0.7)',   // Orange
                        'rgba(46, 204, 113, 0.7)',   // Green
                        'rgba(231, 76, 60, 0.7)',    // Alizarin Red
                        'rgba(52, 152, 219, 0.7)'    // Peter River Blue
                    );
                    $data_array = json_encode($data);
                    $labels_array = json_encode($labels);
                    $color_array = json_encode($color);
                    $type = "bar";

                  }
                break;

                case 'sex':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE sex=?");
                    $sql->bind_param("s", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $sex_hidden = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $sex_count = $conn->prepare("SELECT sex, COUNT(*) as count FROM senior_tbl GROUP BY sex");
                    $sex_count->execute();
                    $sex_result = $sex_count->get_result();
                    $labels = array(
                      "Male",
                      "Female"
                    );

                    $data = array(

                      "Male" => 0,
                      "Female" => 0
                    );

                    $color = array(
                      'rgba(54, 162, 235, 0.7)',   // Blue
                      'rgba(255, 99, 132, 0.7)'  // Red
                    );

                    foreach ($sex_result as $sex_row) {
                      $value = $sex_row['sex'];
                      $count = $sex_row['count'];
                      
                      $data[$value] = $count;
                    }
                    $data_array = json_encode($data);
                    $labels_array = json_encode($labels);
                    $color_array = json_encode($color);
                    $type = "bar";
                    $sex_hidden = "";
                  }
                break;

                case 'birth':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE MONTH(date_birth)=?");
                    $sql->bind_param("i", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $birth_hidden = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $date_count = $conn->prepare("SELECT DATE_FORMAT(date_birth, '%M') AS month, COUNT(*) as count FROM senior_tbl GROUP BY month");
                    $date_count->execute();
                    $date_result = $date_count->get_result();
                    $labels = array(
                      "January",
                      "February",
                      "March",
                      "April",
                      "May",
                      "June",
                      "July",
                      "August",
                      "September",
                      "Octbober",
                      "November",
                      "December",
                    );

                    $data = array(
                      "January" => 0,
                      "February" => 0,
                      "March" => 0,
                      "April" => 0,
                      "May" => 0,
                      "June" => 0,
                      "July" => 0,
                      "August" => 0,
                      "September" => 0,
                      "October" => 0,
                      "November" => 0,
                      "December" => 0
                    );

                    $color = array(
                      "rgba(255, 99, 132, 0.8)",    // Red
                      "rgba(54, 162, 235, 0.8)",   // Blue
                      "rgba(255, 206, 86, 0.8)",   // Yellow
                      "rgba(75, 192, 192, 0.8)",   // Green
                      "rgba(153, 102, 255, 0.8)",  // Purple
                      "rgba(255, 159, 64, 0.8)",   // Orange
                      "rgba(255, 0, 0, 0.8)",      // Bright Red
                      "rgba(0, 255, 0, 0.8)",      // Bright Green
                      "rgba(0, 0, 255, 0.8)",      // Bright Blue
                      "rgba(128, 128, 128, 0.8)",  // Gray
                      "rgba(255, 140, 0, 0.8)",    // Dark Orange
                      "rgba(0, 128, 0, 0.8)"       // Dark Green
                  );

                    foreach ($date_result as $date_row) {
                      $value = $date_row['month'];
                      $count = $date_row['count'];
                      
                      $data[$value] = $count;
                    }
                    $data_array = json_encode($data);
                    $labels_array = json_encode($labels);
                    $color_array = json_encode($color);
                    $type = "bar";
                    $birth_hidden = "";
                  }
                break;

                case 'education':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE S.education_id=?");
                    $sql->bind_param("i", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $hidden_education = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $education_check = mysqli_query($conn, "SELECT * FROM education_tbl");
                    $education_count = $conn->prepare("SELECT education_id, COUNT(*) as count FROM senior_tbl GROUP BY education_id");
                    $education_count->execute();
                    $education_result = $education_count->get_result();
                    $labels = array();
                    $data = array();

                    foreach($education_check as $education_data){
                      $data[$education_data['education_id']] = 0;
                      $labels[] = $education_data['education_attainment'];
                    }

                    foreach ($education_result as $educ_row) {
                      $value = $educ_row['education_id'];
                      $count = $educ_row['count'];
                      
                      $data[$value] = $count;
                    }

                    

                    $color = array(
                      "rgba(255, 99, 132, 0.8)",    // Red
                      "rgba(54, 162, 235, 0.8)",   // Blue
                      "rgba(255, 206, 86, 0.8)",   // Yellow
                      "rgba(75, 192, 192, 0.8)",   // Green
                      "rgba(153, 102, 255, 0.8)",  // Purple
                      "rgba(255, 159, 64, 0.8)",   // Orange
                      "rgba(255, 0, 0, 0.8)",      // Bright Red
                    );
                    $data_array = json_encode($data);
                    $labels_array = json_encode($labels);
                    $color_array = json_encode($color);
                    $type = "bar";
                    $hidden_education = "";
                  }
                break;

                case 'religion':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE S.religion_id=?");
                    $sql->bind_param("s", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $hidden_religion = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $religion_check = mysqli_query($conn, "SELECT * FROM religion_tbl");
                    $religion_count = $conn->prepare("SELECT religion_id, COUNT(*) as count FROM senior_tbl GROUP BY religion_id");
                    $religion_count->execute();
                    $religion_result = $religion_count->get_result();
                    $labels = array();
                    $data = array();

                    foreach($religion_check as $religion_data){
                      $data[$religion_data['religion_id']] = 0;
                      $labels[] = $religion_data['religion_name'];
                    }

                    foreach ($religion_result as $religion_row) {
                      $value = $religion_row['religion_id'];
                      $count = $religion_row['count'];
                      
                      $data[$value] = $count;
                    }

                    

                    $color = array(
                      "rgba(255, 99, 132, 0.8)",    // Red
                      "rgba(54, 162, 235, 0.8)",   // Blue
                      "rgba(255, 206, 86, 0.8)",   // Yellow
                      "rgba(75, 192, 192, 0.8)",   // Green
                      "rgba(153, 102, 255, 0.8)",  // Purple
                      "rgba(255, 159, 64, 0.8)",   // Orange
                      "rgba(255, 0, 0, 0.8)",      // Bright Red
                    );
                    $data_array = json_encode($data);
                    $labels_array = json_encode($labels);
                    $color_array = json_encode($color);
                    $type = "bar";
                    $hidden_religion = "";
                  }
                break;

                case 'civil_status':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE S.civil_id=?");
                    $sql->bind_param("s", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $hidden_civil = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $civil_check = mysqli_query($conn, "SELECT * FROM civil_tbl");
                    $civil_count = $conn->prepare("SELECT civil_id, COUNT(*) as count FROM senior_tbl GROUP BY civil_id");
                    $civil_count->execute();
                    $civil_result = $civil_count->get_result();
                    $labels = array();
                    $data = array();

                    foreach($civil_check as $civil_data){
                      $data[$civil_data['civil_id']] = 0;
                      $labels[] = $civil_data['civil_status'];
                    }

                    foreach ($civil_result as $civil_row) {
                      $value = $civil_row['civil_id'];
                      $count = $civil_row['count'];
                      
                      $data[$value] = $count;
                    }

                    

                    $color = array(
                      "rgba(255, 99, 132, 0.8)",    // Red
                      "rgba(54, 162, 235, 0.8)",   // Blue
                      "rgba(255, 206, 86, 0.8)",   // Yellow
                      "rgba(75, 192, 192, 0.8)",   // Green
                      "rgba(153, 102, 255, 0.8)",  // Purple
                      "rgba(255, 159, 64, 0.8)",   // Orange
                      "rgba(255, 0, 0, 0.8)",      // Bright Red
                    );
                    $data_array = json_encode($data);
                    $labels_array = json_encode($labels);
                    $color_array = json_encode($color);
                    $type = "bar";
                    $hidden_civil = "";
                  }
                break;


                default:
                  $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                  $sql->execute();
                  $result = $sql->get_result();
                break;

              }

            }
            else{
              $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                  $sql->execute();
                  $result = $sql->get_result();
            }

          ?>
          <table class="table table-striped table-bordered align-middle thead-dark" id="myTable">
            <thead>
              <tr>
                <th>Senior No</th>
                <th>Status</th>
                <th>Name</th>
                <th <?= $address_hidden ?>>Address</th>
                <th <?= $birth_hidden ?>>Birthdate</th>
                <th hidden>Birthplace</th>
                <th <?= $sex_hidden ?>>Sex</th>
                <th hidden>Citizenship</th>
                <th <?= $hidden_blood ?>>Blood Type</th>
                <th <?= $hidden_education ?>>Education Attainment</th>
                <th hidden>Contact No.</th>
                <th hidden>Emergency No.</th>
                <th <?= $hidden_religion ?>>Religion</th>
                <th <?= $hidden_civil ?>>Civil Status</th>
                <th hidden>Email</th>
                <th hidden>Date Joined</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
              // this loop will iterate the rows and display the data
              while($row = mysqli_fetch_array($result)){
              $senior_stat = "";
              // if status is active the icon will be color green
              if($row['status'] == "Active"){
                $senior_stat = "text-success";
              }
              // if not the icon will be color red
              else{
                $senior_stat = "text-danger";
              }
            ?>
              <tr>
                <!-- display all the data in the row -->
                <td class="align-middle senior_id"><?= str_pad($row['senior_id'], 6, 0, STR_PAD_LEFT) ?></td>
                <td class="align-middle"><i class="fa-solid fa-circle fa-2xs <?= $senior_stat ?>"></i> <?= $row['status'] ?></td>
                <td class="align-middle"><?= $row['full_name'] ?></td>
                <td class="align-middle" <?= $address_hidden ?>><?= $row['purok_no'] . ", " .  $row['barangay_name'] . ", " . $row['municipality_name'] . ", " . $row['province_name'] ?></td>
                <td class="align-middle" <?= $birth_hidden ?>><?= $row['date_birth'] ?></td>
                <td class="align-middle" hidden><?= $row['birth_place'] ?></td>
                <td class="align-middle" <?= $sex_hidden ?>><?= $row['sex'] ?></td>
                <td class="align-middle" hidden><?= $row['citizenship'] ?></td>
                <td class="align-middle" <?= $hidden_blood ?>><?= $row['blood_type'] ?></td>
                <td class="align-middle" <?= $hidden_education ?>><?= $row['education_attainment'] ?></td>
                <td class="align-middle" hidden><?= $row['cell_no'] ?></td>
                <td class="align-middle" hidden><?= $row['emergency_no'] ?></td>
                <td class="align-middle" <?= $hidden_religion ?>><?= $row['religion_name'] ?></td>
                <td class="align-middle" <?= $hidden_civil ?>><?= $row['civil_status'] ?></td>
                <td class="align-middle" hidden><?= $row['senior_email'] ?></td>
                <td class="align-middle" hidden><?= $row['account_date'] . " " . $row['account_time'] ?></td>
                <td class="align-middle d-grid">
                  <a href="admin_senior_acc.php?id=<?= $row['senior_id'] ?>" class="btn btn-sm btn-primary btn-block text-white">View Senior</a>
                </td>
              </tr>
            <?php
              }
            ?>

            </tbody>
          </table>
          <canvas id="myChart"></canvas>
        </div>
        <!-- Table ends here -->

        <div class="col-lg-2">
          <form action="admin_view_seniors.php" method="GET">
            <div class="form-group d-grid">
              <select name="filwan" id="filter1" class="form-select form-select-lg">
                <option value="" hidden>Filter by</option>
                <option value="all">All</option>
                <option value="barangay">Barangay</option>
                <option value="sex">Sex</option>
                <option value="birth">Birth Month</option>
                <option value="education">Educational Attainment</option>
                <option value="religion">Religion</option>
                <option value="civil_status">Civil Status</option>
              </select>

              <select name="filtu" id="filter2" class="form-select form-select-lg mt-3">
                
              </select>
              <button class="btn btn-primary text-white fs-5 mt-2">Filter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    $(document).ready(function(){

      // Filter javascript starts here
      $("#filter1").on("change", function(){
        var filterValue = $(this).val();
        console.log(filterValue);

        $("#filter2").empty();

        if(filterValue === 'barangay'){
          addOption("#filter2", "all", "All");
          <?php
            $barangay_sql  = mysqli_query($conn, "SELECT * FROM barangay_tbl");
            while($row = mysqli_fetch_assoc($barangay_sql)){
          ?>
          addOption("#filter2", '<?= $row['barangay_id'] ?>', '<?= $row['barangay_name'] ?>');
          <?php
            }
          ?>
        }
        else if(filterValue === 'sex'){
          addOption("#filter2", "all", "All");
          addOption("#filter2", 'male', 'Male');
          addOption("#filter2", 'female', 'Female');
        }

        else if(filterValue === 'birth'){
          addOption("#filter2", "all", "All");
          addOption("#filter2", '1', 'January');
          addOption("#filter2", '2', 'February');
          addOption("#filter2", '3', 'March');
          addOption("#filter2", '4', 'April');
          addOption("#filter2", '5', 'May');
          addOption("#filter2", '6', 'June');
          addOption("#filter2", '7', 'July');
          addOption("#filter2", '8', 'August');
          addOption("#filter2", '9', 'September');
          addOption("#filter2", '10', 'October');
          addOption("#filter2", '11', 'November');
          addOption("#filter2", '12', 'December');
        }

        else if(filterValue === 'education'){
          addOption("#filter2", "all", "All");
        <?php
          $education_sql = mysqli_query($conn, "SELECT * FROM education_tbl");
          while($row = mysqli_fetch_assoc($education_sql)){
        ?>
          addOption("#filter2", "<?= $row['education_id'] ?>", "<?= $row['education_attainment'] ?>");
        <?php
          }
        ?>
        }
        
        else if(filterValue === 'religion'){
          addOption("#filter2", "all", "All");
        <?php
          $religion_sql = mysqli_query($conn, "SELECT * FROM religion_tbl");
          while($row = mysqli_fetch_assoc($religion_sql)){
        ?>
          addOption("#filter2", "<?= $row['religion_id'] ?>", "<?= $row['religion_name'] ?>");
        <?php
          }
        ?>
        }

        else if(filterValue === 'civil_status'){
          addOption("#filter2", "all", "All");
        <?php
          $civil_sql = mysqli_query($conn, "SELECT * FROM civil_tbl");
          while($row = mysqli_fetch_assoc($civil_sql)){
        ?>
          addOption("#filter2", "<?= $row['civil_id'] ?>", "<?= $row['civil_status'] ?>");
        <?php
          }
        ?>
        }

        else if(filterValue === 'all'){
          addOption("#filter2", "all", "All");
        }

        filter2Select.attr('placeholder', 'Select an option for ' + selectedValue);

      });
      // Filter javascript ends here

      // this uses the datatables
      $('#myTable').DataTable( {
        dom: '<"d-flex flex-between"<"col"B><"col"f>>t<"d-flex flex-between"<"col"l><"col"i><"col"p>><"clear">',
        buttons: [
          // This is for the Excel button
          {
            text: '<i class="fa-solid fa-file-excel"></i>Excel',
            extend: 'excel',
            exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15], // Specify the columns to include in the Excel export (exclude column 1)
                },
            className: 'btn btn-info text-white btn-block rounded'
          },
          {
          extend: "spacer"
        },
        {
          extend: "spacer"
        },
          {
            text: '<i class="fa-solid fa-file-pdf"></i>PDF',
            extend: 'pdf',
            exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15], // Specify the columns to include in the Excel export (exclude column 1)
                },
            customize: function (doc) {
                    // Adjust the styles to make the table fit in the PDF
                    doc.styles.tableHeader.fontSize = 5;
                    doc.styles.tableBodyEven.fontSize = 5;
                    doc.styles.tableBodyOdd.fontSize = 5;
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length).fill('auto');

            },
            className: 'btn btn-info text-white btn-block rounded'
          },
        {
          extend: "spacer"
        },
        {
          extend: "spacer"
        },
          //This is for the add senior
          {
            text: '<i class="fa-solid fa-user-plus"></i>Add Senior',
            action: function(){
              window.location.href = "admin_create_senior.php";
            },
            className: "btn btn-info text-white btn-block rounded"
          }

        ]
      });  
    });
    <?php
    if(isset($_GET['filwan']) && ($_GET['filwan'] != "all" && $_GET['filtu'] == "all")){
    ?>
    var arrayData = <?= $data_array ?>;
    var arrayLabel = <?= $labels_array ?>;
    var arrayColor = <?= $color_array ?>;
    console.log(arrayData);
    console.log("bruh");
    console.log(arrayLabel);
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
    type: '<?= $type ?>',
    data: {
        labels: Object.values(arrayLabel),
        datasets: [{
        label: 'No. of Seniors',
        data: Object.values(arrayData),
        backgroundColor: Object.values(arrayColor),
        borderWidth: 1
        }]
    },
    options: {
        scales: {
        y: {
            beginAtZero: true
        }
        }
    }
    });
    <?php
    }
    ?>

    function addOption(selectElement, value, text){
      var option = new Option(text, value, false, false);
      $(selectElement).append(option);
    }
    
  </script>
</html>

<?php
    }
    // If there are no sessions you will be redirected back to the landing page
    else {
        header("Location: ../index.php");
    }
?>