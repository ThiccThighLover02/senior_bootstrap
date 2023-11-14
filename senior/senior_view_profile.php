<?php
    session_start();
    include "../db_connect.php";
    // If there is a admin status session
    if(isset($_SESSION['senior_status']) && $_SESSION['senior_status'] == "Active"){
      $senior_id = $_GET['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include "senior_links.php";
        include "nav_style.php";
    ?>
    <title>Senior System</title>
</head>
  <body class="bg-light" style="overflow-x: hidden; background-size: cover;">
    <?php
      include 'senior_navbar.php';
    ?>
    <div class="container-fluid">
      <!-- First Row Starts Here   -->
      <div class="row gy-3 pt-3 order-sm-1" id="navbarSupportedContent" style="">
        <?php
          // this active variable shows the active tab in the side bar
          $active = "actProfile";
          include "senior_left_sidebar.php";  
          $sql = $conn->prepare("SELECT * FROM senior_tbl S RIGHT JOIN purok_tbl P ON S.senior_purok_id=P.purok_id RIGHT JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id RIGHT JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id RIGHT JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id WHERE senior_id=?");
          $sql->bind_param("i", $senior_id);
          $sql->execute();
          $result = $sql->get_result();

          $row = mysqli_fetch_assoc($result);
          $birth_date = new DateTime($row['date_birth']);
        ?>

        <div class="col-lg-6 order-2 order-xl-1 order-lg-1 order-sm-2 shadow pt-4 bg-white rounded overflow-y-scroll" style="height: 85vh">
          <div class="row d-flex justify-content-center">
            <div class="col-5 border border-dark">
              <div class="ratio ratio-1x1">
                <img class="img-fluid" src="senior_pics/id_pics/<?= $row['id_pic'] ?>" alt="">
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
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Account Info</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact Info</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Health Info</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <!-- birthdate and age -->
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                <h2 class="text-primary">Birthdate:</h3>
                    <p class="fs-5"><?= $birth_date->format("M d, Y") ?></p>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Age:</h3>
                    <p class="fs-5"><?= $row['age'] ?></p>
                </div>
              </div>
              <!-- address and contact no   -->
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Address:</h3>
                    <p class="fs-5"><?= $row['purok_no'] . ", " . $row['barangay_name'] . ", " . $row['municipality_name'] . ", " . $row['province_name'] ?></p>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Contact No:</h3>
                    <p class="fs-5"><?= str_pad($row['cell_no'], 13, "+63", STR_PAD_LEFT) ?></p>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Gender:</h3>
                    <p class="fs-5"><?= $row['sex'] ?></p>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Civil Status:</h3>
                    <p class="fs-5"><?= $row['civil_status'] ?></p>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
          </div>
          
        </div>
        <div class="col-lg-3 col-sm-12 order-1 order-xl-2 order-sm-1 d-flex flex-column gap-3">
            <buttons class="btn btn-block btn-info" onclick="printExternal('../id_layout.php?id=<?= $senior_id ?>')">Print ID <i class="fa-solid fa-print"></i></buttons>
            <buttons class="btn btn-block btn-info" onclick="printExternal('../senior_document.php?id=<?= $senior_id ?>')">Print Information Document <i class="fa-solid fa-print"></i></buttons>        </div>
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
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=1600, height=900, toolbar=800, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
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