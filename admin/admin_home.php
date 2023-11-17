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
        include "nav_style.php";
    ?>
    <title>Senior System</title>
</head>
  <body class="bg-light">
    <?php
      include 'admin_navbar.php';
    ?>
    <div class="container-fluid">
    <!-- Modal starts here -->
      <div class="modal fade" id="post-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Create Post</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="admin_add_post.php" method="post" enctype="multipart/form-data">
              <div class="form-group d-flex flex-column">
                    <h4>Post Title</h4>
                    <div class="col-12 mb-3">
                        <!-- Date of Event -->
                        <input type="text" class="form-control form-control-lg" id="" name="post_title" placeholder="Post Title" required>
                    </div>
                    <!-- Post Type -->
                    <h4>Post Type</h4>
                    <div class="col-12 mb-3">
                      <select class="form-select form-select-lg" name="post_type" id="">
                        <option value="" hidden>Post type</option>
                        <option value="announcement">Announcement</option>
                        <option value="event">Event</option>
                      </select>
                    </div>

                    <!-- Event Description -->
                    <h4>Event Description:</h4>
                    <div class="col-12 mb-3">
                      <textarea class="form-control" name="description" id="" cols="30" rows="10" placeholder="Enter the type description here, please include the requirements for the said event"></textarea>
                    </div>
                    <h4>Date of Event:</h4>
                    <div class="col-12 mb-3">
                        <!-- Date of Event -->
                        <input type="date" class="form-control form-control-lg" id="" name="act_date" required>
                    </div>

                    <h4>Time Start:</h4>
                    <div class="col-12 mb-3">
                        <!-- time Start -->
                        <input type="time" class="form-control form-control-lg" id="" name="time_start" required>
                    </div>

                    <h4>Time End:</h4>
                    <div class="col-12 mb-3">
                        <!-- Time End -->
                        <input type="time" class="form-control form-control-lg" id="" name="time_end" required>
                    </div>

                    <h4>Location:</h4>
                    <div class="col-12 mb-3">
                        <!-- Location -->
                        <input type="text" class="form-control form-control-lg" id="" name="event_location" placeholder="Location" required>
                        <div class="invalid-feedback mb-1">
                          Require
                        </div>
                    </div>

                    <h4>Event Type:</h4>
                    <div class="col-12 mb-3">
                        <!-- Event Type -->
                        <select name="event_type" class="form-select form-select-lg" id="" name="event_type">
                          <option value="" hidden>Event Type</option>
                        <?php
                          $type_sql = mysqli_query($conn, "SELECT * FROM type_tbl");
                          while($row = mysqli_fetch_assoc($type_sql)){
                        ?>
                          <option value="<?= $row['type_id'] ?>"><?= $row['type_name'] ?></option>
                        <?php
                          }
                        ?>
                        </select>
                    </div>
                    <h4>Image:</h4>
                    <div class="col-12 mb-3">
                      <input type="file" name="post-pic" class="form-control form-control-lg">
                    </div>
                    <div class="col-12 mb-3 d-grid">
                      <button type="submit" class="btn btn-primary">Create Post</button>
                    </div>
                  </div>
              </form>
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
        <div class="col-lg-7 rounded overflow-y-scroll" style="height: 80vh">
          <div class="container-fluid">
            <!-- Create post starts here -->
            <div class="row mb-4">
              <div class="col-lg-12 shadow bg-white rounded d-flex gap-3 p-2">
                <img class="img-fluid rounded-circle" src="admin_pic/admin_pic.jpg" alt="" style="width: 4.5vw">
                <input type="text" class="form-control form-control-lg create-post" value="Create Post" data-bs-toggle="modal" data-bs-target="#post-modal" readonly>
              </div>
            </div>
            <!-- Create post ends here -->
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
                            <h4>Title: <?= $row['post_title'] ?></h4>
                          </div>
                          <div class="col-12">
                            <p class="fs-5 text-muted"><i class="fa-solid fa-user fa-xs"></i> Admin . <i class="fa-regular fa-calendar"></i> <?= $date_create->format("M d, Y") . " . " .$time_create->format("H:iA") ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <i class="fa-solid fa-ellipsis-h fa-2xl float-end p-4 lazy-modal" data-toggle="modal" data-target="#myModal<?= $row['post_id'] ?>" style="cursor: pointer;"></i>

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
        <div class="col-lg-3" style="height: 50vh;">
          <div class="row">
            <h3 class="text-center bg-primary">Upcoming Events</h3>
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
            action: function(){
              window.location.href="../excel.php";
            }
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

      $("#post-id").click(function(e){
        let post_id = $(this).closest("row").find(".post-id").text();
        console.log(post_id);
            // this is ajax and it will run our php code without refreshing our page
            // $.ajax({
            //     method: "POST",
            //     url: "edit_product.php",
            //     data: {
            //         "click_edit_btn": true,
            //         "product_id": prod_id
            //     },
            //     success: function(response){
            //         $(".edit-modal").html(response);
            //         $("#view-edit-modal").modal('show');
            //         console.log(response);
            //     }

            // })
        });

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