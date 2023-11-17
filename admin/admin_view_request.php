<?php
    session_start();
    include "../db_connect.php";
    // If there is a admin status session
    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
      $request_id = $_GET['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include "admin_links.php";

        //   Get the data from the request_tbl
        $sql = $conn->prepare("SELECT * FROM request_tbl R  RIGHT JOIN purok_tbl P ON R.purok_id=P.purok_id RIGHT JOIN barangay_tbl B ON R.barangay_id=B.barangay_id RIGHT JOIN municipality_tbl M ON R.municipality_id=M.municipality_id RIGHT JOIN province_tbl Pr ON R.province_id=Pr.province_id INNER JOIN education_tbl E ON R.request_education_id=E.education_id INNER JOIN civil_tbl Cl ON R.request_civil_id=Cl.civil_id INNER JOIN religion_tbl Rl ON R.request_religion_id=Rl.religion_id WHERE request_id=?");
        $sql->bind_param("i", $request_id);
        $sql->execute();
        $sql_result = $sql->get_result();
        $row = mysqli_fetch_assoc($sql_result);
        $birth_date = new DateTime($row['birth_date']);
        $health_array = $row['health'];
        $health = unserialize($health_array);
    ?>
    <title>Senior System</title>
</head>
  <body class="bg-light" style="overflow-x: hidden; background-size: cover;">
  <!-- Modal -->
<div class="modal fade" id="attach-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Attachments</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
              <img src="../user/requests/birth_certificates/<?= $row['birth_certificate'] ?>" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Birth Certificate</h5>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="../user/requests/barangay_certificates/<?= $row['barangay_certificate'] ?>" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Barangay Certificate</h5>
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
        
        <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Understood</button>
      </div>
    </div>
  </div>
</div>
    <?php
      include 'admin_navbar.php';
    ?>
    <div class="container-fluid">
      <!-- First Row Starts Here   -->
      <div class="row gy-3 pt-3 order-sm-1" id="navbarSupportedContent" style="">
        <?php
          // this active variable shows the active tab in the side bar
          $active = "actRequest";
          include "admin_left_sidebar.php";  

        
        ?>
        <div class="col-lg-7 order-2 order-xl-1 order-lg-1 order-sm-2 shadow pt-4 bg-white rounded overflow-y-scroll" style="height: 83vh">
          <div class="row d-flex justify-content-center">
            <div style="height: 30vh; width: 30vh;">
              <div class="ratio ratio-1x1">
                <img class="img-fluid border border-black" src="../user/requests/id_pics/<?= $row['id_pic'] ?>" alt="">
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
                  <p class="fs-5"><?= $row['place_birth'] ?></p>
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
                    <p class="fs-5"><?= str_pad($row['cell_no'], 13, "+63", STR_PAD_LEFT) ?></p>
                </div>
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Physical Disability:</h3>
                  <?php
                    if(is_null($row['physical_disability'])){
                      $disability = "No physical disability";
                    }
                    else{
                      $disability = $row['physical_disability'];
                    }
                  ?>
                    <p class="fs-5"><?= $disability ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 d-flex flex-column">
                    <h2 class="text-primary">Health Conditions:</h3>
                    <?php
                      foreach($health as $condition => $value){
                        if($value == true){
                    ?>
                        <p class="fs-5"><?= $condition ?></p>
                    <?php
                        }
                      }
                    ?>
                </div>
              </div>
            </div>

          </div>
          
        </div>
        
        <div class="col-lg-3 col-sm-12 order-1 order-xl-2 order-sm-1">
            <div class="row gy-3">
                <div class="col-12 d-grid">
                    <buttons class="btn btn-block btn-info" data-bs-toggle="modal" data-bs-target="#attach-modal">View Attachments <i class="fa-solid fa-paperclip"></i></buttons>
                </div>
                <div class="col-6 d-grid">
                <a href="admin_add_senior.php?request_id=<?= $row['request_id'] ?>" class="btn btn-success text-white" id="deleteBtn">Accept Request <i class="fa-solid fa-check"></i></a>
                </div>

                <div class="col-6 d-grid">
                <a href="admin_reject_request.php?request_id=<?= $row['request_id'] ?>" class="btn btn-danger text-white" id="deleteBtn">Reject Request <i class="fa-solid fa-trash"></i></a>
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