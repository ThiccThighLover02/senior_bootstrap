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
          $sql = $conn->prepare("SELECT * FROM senior_tbl S RIGHT JOIN purok_tbl P ON S.senior_purok_id=P.purok_id RIGHT JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id RIGHT JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id RIGHT JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id WHERE senior_id=?");
          $sql->bind_param("i", $senior_id);
          $sql->execute();
          $result = $sql->get_result();

          $row = mysqli_fetch_assoc($result);
          $birth_date = new DateTime($row['date_birth']);
        ?>

        <div class="col-lg-6 order-2 order-xl-1 order-lg-1 order-sm-2 shadow pt-4 bg-white rounded overflow-y-scroll" style="height: 85vh">
          <a href="admin_view_seniors.php"><i class="fa-solid fa-arrow-left fa-2xl float-start text-primary"></i></a>  
          <div class="row d-flex justify-content-center">
            <div class="col-5 border border-dark">
              <div class="ratio ratio-1x1">
                <img class="img-fluid" src="../senior/senior_pics/id_pics/<?= $row['id_pic'] ?>" alt="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center"><?= $row['full_name'] ?></h1>
            </div>
          </div>
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
        <div class="col-lg-3 col-sm-12 order-1 order-xl-2 order-sm-1 d-flex flex-column gap-3">
            <buttons class="btn btn-block btn-info" onclick="printExternal('../id_layout.php?id=2')">Print ID <i class="fa-solid fa-print"></i></buttons>
            <buttons type="button" class="btn btn-danger text-white" id="deleteBtn">Delete Senior <i class="fa-solid fa-trash"></i></buttons>
        </div>
      </div>
      <!-- first row ends here -->
    </div>
  </body>
  <script>
    $(document).ready(function(){
      //this is for the delete senior button
      $("#deleteBtn").on("click", function(){
        if(confirm("Do you want to delete this account?") == true){
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