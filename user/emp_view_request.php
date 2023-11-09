<?php
    session_start();
    include "../db_connect.php";
    // If there is a admin status session
    if(isset($_SESSION['emp_status']) && $_SESSION['emp_status'] == "Active"){
      $request_id = $_GET['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include "user_links.php";
    ?>
    <title>Senior System</title>
</head>
  <body class="bg-light" style="overflow-x: hidden; background-size: cover;">
  <!-- Modal -->
<div class="modal fade" id="attach-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
              <img src="..." class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Birth Certificate</h5>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="..." class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Barangay Certificate</h5>
              </div>
            </div>
            <div class="carousel-item">
              <img src="..." class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
    <?php
      include 'emp_navbar.php';
    ?>
    <div class="container-fluid">
      <!-- First Row Starts Here   -->
      <div class="row gy-3 pt-3 order-sm-1" id="navbarSupportedContent" style="">
        <?php
          // this active variable shows the active tab in the side bar
          $active = "actRequest";
          include "emp_left_sidebar.php";  

        //   Get the data from the request_tbl
          $sql = $conn->prepare("SELECT * FROM request_tbl R  RIGHT JOIN purok_tbl P ON R.purok_id=P.purok_id RIGHT JOIN barangay_tbl B ON R.barangay_id=B.barangay_id RIGHT JOIN municipality_tbl M ON R.municipality_id=M.municipality_id RIGHT JOIN province_tbl Pr ON R.province_id=Pr.province_id WHERE request_id=?");
          $sql->bind_param("i", $request_id);
          $sql->execute();
          $sql_result = $sql->get_result();
          $row = mysqli_fetch_assoc($sql_result);
          $birth_date = new DateTime($row['birth_date']);
        ?>

        <div class="col-lg-6 order-2 order-xl-1 order-lg-1 order-sm-2 shadow pt-4 bg-white rounded overflow-auto">
          <a href="admin_requests.php"><i class="fa-solid fa-arrow-left fa-2xl float-start text-primary"></i></a>  
          <div class="row d-flex justify-content-center">
            <div class="col-5 border border-dark">
              <div class="ratio ratio-1x1">
                <img class="img-fluid" src="../user/requests/id_pics/<?= $row['id_pic'] ?>" alt="">
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
            <div class="col-md-6 d-flex flex-column">
            <h2 class="text-primary">Birthdate:</h3>
                <p class="fs-5"><?= $birth_date->format("M d, Y") ?></p>
            </div>
            <div class="col-md-6 d-flex flex-column">
                <h2 class="text-primary">Age:</h3>
                <p class="fs-5"><?= $row['age'] ?></p>
            </div>
          </div>
          <!-- address and contact no   -->
          <div class="row">
            <div class="col-md-6 d-flex flex-column">
                <h2 class="text-primary">Address:</h3>
                <p class="fs-5"><?= $row['purok_no'] . ", " . $row['barangay_name'] . ", " . $row['municipality_name'] . ", " . $row['province_name'] ?></p>
            </div>
            <div class="col-md-6 d-flex flex-column">
                <h2 class="text-primary">Contact No:</h3>
                <p class="fs-5"><?= str_pad($row['cell_no'], 13, "+63", STR_PAD_LEFT) ?></p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 d-flex flex-column">
                <h2 class="text-primary">Gender:</h3>
                <p class="fs-5"><?= $row['sex'] ?></p>
            </div>
            <div class="col-md-6 d-flex flex-column">
                <h2 class="text-primary">Civil Status:</h3>
                <p class="fs-5"><?= $row['civil_status'] ?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-12 order-1 order-xl-2 order-sm-1">
            <div class="row gy-3">
                <div class="col-12 d-grid">
                    <buttons class="btn btn-block btn-info" data-bs-toggle="modal" data-bs-target="#attach-modal">View Attachments <i class="fa-solid fa-paperclip"></i></buttons>
                </div>
                <div class="col-6 d-grid">
                <a href="emp_add_senior.php?request_id=<?= $row['request_id'] ?>" class="btn btn-success text-white" id="deleteBtn">Accept Request <i class="fa-solid fa-check"></i></a>
                </div>

                <div class="col-6 d-grid">
                <a href="emp_reject_request.php?request_id=<?= $row['request_id'] ?>" class="btn btn-danger text-white" id="deleteBtn">Reject Request <i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
            
        </div>
      </div>
      <!-- first row ends here -->
      <div class="row mt-5 d-flex justify-content-center">
        <div class="col-lg-6 bg-white">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column">
                <h2 class="text-primary">Gender:</h3>
                <p class="fs-5">Male</p>
            </div>
            <div class="col-lg-6 d-flex flex-column">
                <h2 class="text-primary">Civil Status:</h3>
                <p class="fs-5">Single</p>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 d-flex flex-column">
                <h2 class="text-primary">Gender:</h3>
                <p class="fs-5">Male</p>
            </div>
            <div class="col-lg-6 d-flex flex-column">
                <h2 class="text-primary">Civil Status:</h3>
                <p class="fs-5">Single</p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 d-flex flex-column">
                <h2 class="text-primary">Gender:</h3>
                <p class="fs-5">Male</p>
            </div>
            <div class="col-lg-6 d-flex flex-column">
                <h2 class="text-primary">Civil Status:</h3>
                <p class="fs-5">Single</p>
            </div>
          </div>
        </div>
      </div>
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