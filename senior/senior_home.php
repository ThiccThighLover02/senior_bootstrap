<?php
    session_start();
    include "../db_connect.php";
    // If there is a admin status session
    if(isset($_SESSION['senior_status']) && $_SESSION['senior_status'] == "Active"){

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
  <body class="bg-light">
    <?php
      include 'senior_navbar.php';
    ?>
    <div class="container-fluid">
    
      <div class="row gx-3 pt-3" id="navbarSupportedContent">
        <?php
          // This active variable is used to view which tab is active in the side bar
          $active = "actHome";
          include "senior_left_sidebar.php";
          $sql = mysqli_query($conn, "SELECT * FROM senior_tbl");
          $online = mysqli_query($conn, "SELECT * FROM senior_tbl WHERE status='Active'");

          $sql_rows = mysqli_num_rows($online);
        ?>
        <div class="col-lg-6 rounded mb-2 overflow-y-scroll me-2" style="height: 85vh">
          <div class="container-fluid">
            <?php
              $post_sql = mysqli_query($conn, "SELECT * FROM activity_tbl A LEFT JOIN admin_tbl Ad ON A.post_admin_id=Ad.admin_id LEFT JOIN emp_tbl E ON A.post_emp_id=E.emp_id ORDER BY date_created DESC, time_created DESC");
              
              while($row = mysqli_fetch_assoc($post_sql)){
                $date_create = new DateTime($row['date_created']);
                $time_create = new DateTime($row['time_created']);
                $post_date = new DateTime($row['post_date']);
                $post_time_start = new DateTime($row['time_start']);
                $post_time_end = new DateTime($row['time_end']);
                $post_pic = "";
            ?>
           <div class="row mb-5">
              <div class="col-lg-12 shadow bg-white rounded">
                <!-- Post header -->
                <div class="row post-id" value="<?= $row['post_id'] ?>">
                  <div class="col-8 p-2">
                    <div class="row d-flex">
                    <?php
                      if(!is_null($row['post_admin_id'])){
                        $post_pic = "admin_pic/admin_pic.jpg";
                        $post_name = "Admin";
                      }
                      elseif(!is_null($row['post_emp_id'])){
                        $post_pic = "../user/user_pics/" . $row['id_pic'];
                        $post_name = $row['full_name'];
                      }
                    ?>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-12">
                            <h2>Title: <?= $row['post_title'] ?></h2>
                          </div>
                          <div class="col-12">
                            <p class="fs-5 text-muted"><i class="fa-solid fa-user fa-xs"></i> Admin . <i class="fa-regular fa-calendar"></i> <?= $date_create->format("M d, Y") . " . " .$time_create->format("H:iA") ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Post header ends here -->
                <!-- Post Description -->
                <div class="row">
                  <div class="col-12 d-flex flex-column">
                    <p class="fs-5"><b>When:</b> <?= $post_date->format("M d, Y") ?> <?= $post_time_start->format("H:i a") . "-" .$post_time_end->format("H:i a") ?></p>
                    <p class="fs-5"><b>Where:</b> <?= $row['post_loc'] ?></p>
                    <p class="fs-5"><?= $row['post_description'] ?></p>
                  </div>
                </div>
                <!-- Post image -->
                <div class="row">
                  <img class="img-fluid mb-3" src="../user/post_pics/<?= $row['post_pic'] ?>" alt="">
                </div>
              </div>
            </div>
            <?php
            }
            ?>

          </div>
        </div>
        <?php

        ?>
        <div class="col-lg-2 bg-white" style="height: 50vh;">
          <div class="row bg-primary">
            <h3 class="text-center">Upcoming Events</h3>
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
        header("Location: ../index.php");
    }
?>