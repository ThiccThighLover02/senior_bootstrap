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
    <title>Document</title>
</head>
  <body class="bg-light">
    <?php
      include 'admin_navbar.php';
    ?>
    <div class="container-fluid">
    <!-- Modal starts here -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row gx-3 pt-3" id="navbarSupportedContent">
        <?php
          // This active variable is used to view which tab is active in the side bar
          $active = "actHome";
          include "admin_left_sidebar.php";
          $sql = mysqli_query($conn, "SELECT * FROM senior_tbl");
          $online = mysqli_query($conn, "SELECT * FROM senior_tbl WHERE status='Active'");

          $sql_rows = mysqli_num_rows($online);
        ?>
        <div class="col-lg-6 table-responsive rounded mb-2">
          <div class="container-fluid">
            <!-- Create post starts here -->
            <div class="row mb-4">
              <div class="col-lg-12 shadow bg-white rounded d-flex gap-3 p-2">
                <img class="img-fluid rounded-circle" src="admin_pic/admin_pic.jpg" alt="" style="width: 4.5vw">
                <input type="text" class="form-control form-control-lg create-post" value="Create Post" data-bs-toggle="modal" data-bs-target="exampleModal" readonly>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="exampleModal">modal shites</button>
              </div>
            </div>
            <!-- Create post ends here -->
            <div class="row mb-5">
              <div class="col-lg-12 shadow bg-white rounded">
                <!-- Post header -->
                <div class="row">
                  <div class="col-6 p-2">
                    <div class="row d-flex">
                      <div class="col-3">
                        <img class="img-fluid rounded-circle" src="admin_pic/admin_pic.jpg" alt="" style="width: 7vw">
                      </div>
                      <div class="col-9">
                        <div class="row">
                          <div class="col-12">
                            <h4>Carlson Magtalas</h4>
                          </div>
                          <div class="col-12">
                            <p class="fs-5">Nov 04, 2023 . 10:00PM</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <i class="fa-solid fa-ellipsis-h fa-2xl float-end p-4"></i>
                  </div>
                </div>
                <!-- Post header ends here -->
                <!-- Post Description -->
                <div class="row">
                  <div class="col-12">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut eu ipsum eu est cursus tempus id sollicitudin tortor. Phasellus interdum id massa vel feugiat. Aenean id tortor dui. Ut nec sapien egestas, aliquet neque quis, porta tortor. Fusce vulputate rhoncus turpis vel pellentesque. Nulla aliquet accumsan accumsan. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras ornare libero purus, in viverra ipsum pellentesque in. Vestibulum sit amet placerat ante, in aliquet tellus.
 </p>
                  </div>
                </div>
                <!-- Post image -->
                <div class="row">
                  <img class="img-fluid mb-3" src="../posts/Spraymond_The_Catbirth_cert.jpg" alt="">
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </body>
  <script>
    $(document).ready(function(){
      $('#myTable').DataTable( {
        dom: '<"d-flex flex-between"<"col"B><"col"f>>t<"d-flex flex-between"<"col"l><"col"p>><"clear">',
        buttons: [
          // This is for the Excel button
          {
            text: '<i class="fa-solid fa-download"></i>Download Excel',
            extend: 'excel', 
            className: 'btn btn-info text-white btn-block'
          },
          // This is for the csv button
          {
            text: '<i class="fa-solid fa-download"></i>Download CSV',
            extend: 'csv', 
            className: 'btn btn-info text-white btn-block'
          },
          //This is for the add senior
          {
            text: '<i class="fa-solid fa-home"></i>Add Senior',
            action: function(){
              window.location.href = "admin_add_senior.php";
            },
            className: "btn btn-info text-white btn-block"
          }

        ],
        fixedHeader: true,

      });
      
      $(".create-post").on("click" function(e){
        $("#exampleModal").modal("show");
      })
    });
    
  </script>
</html>

<?php
    }
    // If there are no sessions you will be redirected back to the landing page
    else {
        header("Location: index.php");
    }
?>