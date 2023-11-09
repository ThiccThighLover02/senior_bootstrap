<?php
    session_start();
    include "../db_connect.php";
    // If there is a admin status session
    if(isset($_SESSION['emp_status']) && $_SESSION['emp_status'] == "Active"){

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
  <body class="bg-light">
    <?php
      include 'emp_navbar.php';
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
                    <!-- Event Description -->
                    <h4>Event Description:</h4>
                    <div class="col-12 mb-3">
                      <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
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
          $active = "actActivities";
          include "emp_left_sidebar.php";
          $sql = mysqli_query($conn, "SELECT * FROM senior_tbl");
          $online = mysqli_query($conn, "SELECT * FROM senior_tbl WHERE status='Active'");

          $sql_rows = mysqli_num_rows($online);
        ?>
        <div class="col-lg-6 rounded mb-2 bg-white" style="height: 85vh">
            <div class="row">
                <div class="col">
                    <a href="admin_activities.php"><i class="fa-solid fa-left-arrow fa-lg"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12" id="reader">
                <input type="file" class="form-control form-control-lg" id="qr-input-file" accept="image/*">
                </div>
            </div>
            
        </div>
      </div>
    </div>
  </body>
  <script>
    $(document).ready(function(){
        function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        window.location.href = "admin_seinor_attend.php?qr_content=" + decodedText;
        }

function onScanFailure(error) {
  // handle scan failure, usually better to ignore and keep scanning.
  // for example:
  console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} });
html5QrcodeScanner.render(onScanSuccess, onScanFailure);
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