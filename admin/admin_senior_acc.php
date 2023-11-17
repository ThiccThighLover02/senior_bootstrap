<?php
    session_start();
    include "../db_connect.php";
    // If there is a admin status session
    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
      $senior_id = $_GET['id'];

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
  <body class="bg-light" style="overflow-x: hidden; background-size: cover;">
    <?php
      include 'admin_navbar.php';
    ?>
    <div class="container-fluid">
      <!-- First Row Starts Here   -->
      <div class="row gy-3 pt-3 order-sm-1" id="navbarSupportedContent" style="">
        <?php
          // this active variable shows the active tab in the side bar
          $active = "actSenior";
          include "admin_left_sidebar.php";  
          $sql = $conn->prepare("SELECT * FROM senior_tbl S RIGHT JOIN purok_tbl P ON S.senior_purok_id=P.purok_id RIGHT JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id RIGHT JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id RIGHT JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id INNER JOIN civil_tbl C ON S.civil_id=C.civil_id WHERE senior_id=?");
          $sql->bind_param("i", $senior_id);
          $sql->execute();
          $result = $sql->get_result();

          $row = mysqli_fetch_assoc($result);
          $birth_date = new DateTime($row['date_birth']);
          $acc_created = new DateTime($row['account_date'] . $row['account_time']);
          
        ?>

        <div class="col-lg-8 order-2 order-xl-1 order-lg-1 order-sm-2 shadow pt-4 bg-white rounded overflow-y-scroll" style="height: 83vh">
          <div class="row d-flex justify-content-center">
            <div style="height: 30vh; width: 30vh;">
              <div class="ratio ratio-1x1">
                <img class="img-fluid border border-black" src="../senior/senior_pics/id_pics/<?= $row['id_pic'] ?>" alt="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center"><?= $row['full_name'] ?></h1>
            </div>
          </div>

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">General Info</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Account Info</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact Info</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="health-tab" data-bs-toggle="tab" data-bs-target="#health" type="button" role="tab" aria-controls="contact" aria-selected="false">Health Info</button>
            </li>
            
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <!-- address and birthdate   -->
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Address:</h3>
                    <p class="fs-5"><?= $row['purok_no'] . ", " . $row['barangay_name'] . ", " . $row['municipality_name'] . ", " . $row['province_name'] ?></p>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                <h2 class="text-primary">Birthdate:</h3>
                    <p class="fs-5"><?= $birth_date->format("M d, Y") ?></p>
                </div>
              </div>
              <!-- birthplace and ses -->
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                  <h2 class="text-primary">Birth Place:</h3>
                  <p class="fs-5"><?= $row['birth_place'] ?></p>
                </div>
                
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Gender:</h3>
                    <p class="fs-5"><?= $row['sex'] ?></p>
                </div>
              </div>

              <!-- Citizenship and age -->
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Citizenship:</h3>
                    <p class="fs-5"><?= $row['citizenship'] ?></p>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Age:</h3>
                    <p class="fs-5"><?= $row['age'] ?></p>
                </div>
              </div>

              <!-- Education and religion -->
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Education:</h3>
                    <p class="fs-5"><?= $row['education_attainment'] ?></p>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Religion:</h3>
                    <p class="fs-5"><?= $row['religion_name'] ?></p>
                </div>
              </div>

              <!-- Education and religion -->
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Civil Status:</h3>
                    <p class="fs-5"><?= $row['civil_status'] ?></p>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <!-- address and birthdate   -->
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Password:</h3>
                    <input type="password" class="form-control" placholder="" value="<?= $row['senior_password'] ?>">
                </div>
                <div class="col-lg-6 d-flex flex-column">
                <h2 class="text-primary">Account Created:</h3>
                    <p class="fs-5"><?= $acc_created->format("M d, Y H:ia") ?></p>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              <!-- address and birthdate   -->
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Contact Number:</h3>
                    <p class="fs-5"><?= str_pad($row['cell_no'], 13, "+63", STR_PAD_LEFT) ?></p>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Guardian's Number:</h3>
                    <p class="fs-5"><?= str_pad($row['emergency_no'], 13, "+63", STR_PAD_LEFT) ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Email Address:</h3>
                    <p class="fs-5"><?= $row['senior_email'] ?></p>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="health" role="tabpanel" aria-labelledby="health-tab">
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Blood Type:</h3>
                    <p class="fs-5"><?= $row['blood_type'] ?></p>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Physical Disability:</h3>
                    <?php
                      if(is_null($row['physical_disability'])){
                        $physical = "No physical disability";
                      }
                      elseif(!is_null($row['physical_disability'])){
                        $physical = $row['physical_disability'];
                      }
                    ?>
                    <p class="fs-5"><?= $physical ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Health Conditions:</h3>
                    <?php
                      if(is_null($row['health'])){
                    ?>
                      <p class="fs-5">No health conditions</p>
                    <?php 
                      }
                      else{
                        $health = unserialize($row['health'])
                    ?> 
                      <ul>
                    <?php
                    $allFalse = array_reduce($health, function($carry, $value) {
                      return $carry && !$value;
                    }, true);
                    if($allFalse){
                    ?>
                        <li class="fs-5">No health conditions</li>
                    <?php
                    }
                    else{
                      foreach($health as $condition => $value){
                        if($value == true){
                    ?>
                        <li class="fs-5"><?= $condition ?></li>
                    <?php
                        }
                      }
                    ?>
                      </ul>
                    <?php
                      }
                    }
                    ?>
                    <ul>
                    </ul>
                </div>
              </div>
            </div>

          </div>
          
        </div>
        <div class="col-lg-2 col-sm-12 order-1 order-xl-2 order-sm-1 d-flex flex-column gap-3">
            <buttons class="btn btn-block btn-info" onclick="printExternal('../id_layout.php?id=<?= $senior_id ?>')"><i class="fa-solid fa-print"></i> Print ID</buttons>
            <buttons class="btn btn-block btn-info" onclick="printExternal('../senior_document.php?id=<?= $senior_id ?>')"><i class="fa-solid fa-print"></i> Senior Information</buttons>
            <a href="admin_view_seniors.php" class="btn btn-primary text-white"><i class="fa-solid fa-arrow-left"></i> Return to seniors</a>
            <buttons type="button" class="btn btn-danger text-white" id="deleteBtn"><i class="fa-solid fa-trash"></i> Remove Senior</buttons>
        </div>
      </div>
      <!-- first row ends here -->
    </div>
  </body>
  <script>
    $(document).ready(function(){
      //this is for the delete senior button
      $("#deleteBtn").on("click", function(){
        if(confirm("Do you want to remove this account?") == true){
          window.location.href = "admin_delete_senior.php?id=<?= $senior_id ?>";
        }
      });
      
    });
    // This is for the printing ID function
    function printExternal(url) {
    var printWindow = window.open(url, 'Print', 'left=200, top=200, width=1600, height=900, toolbar=800, resizable=0');

    if (printWindow) {
        printWindow.addEventListener('load', function () {
            setTimeout(function () {
                printWindow.print();
                printWindow.close();
            }, 500); // Adjust the delay as needed
        });
    } else {
        console.error('Failed to open the print window.');
    }
}

    
  </script>
</html>

<?php
    }
    // If there are no sessions you will be redirected back to the landing page
    else {
        header("Location: index.php");
    }
?>