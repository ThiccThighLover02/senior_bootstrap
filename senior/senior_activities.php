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
  <body class="bg-light overflow-hidden">
    <!-- Modal -->
    <div class="modal fade" id="view-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body edit-modal">
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <?php
      include 'senior_navbar.php';
    ?>
    <div class="container-fluid">
      <div class="row gx-5 pt-3" id="navbarSupportedContent">
        <?php
          // this active variable shows the active tab in the side bar
          $active = "actActivities";
          include "senior_left_sidebar.php";  
          $sql = mysqli_query($conn, "SELECT * FROM senior_tbl");
          $online = mysqli_query($conn, "SELECT * FROM senior_tbl WHERE status='Active'");

          $sql_rows = mysqli_num_rows($online);
        ?>

        <!-- Table Starts here -->
        <div class="col-lg-8 pt-3 pb-3 bg-white table-responsive rounded overflow-auto">
            <div id="calendar">

            </div>
        </div>
        <!-- Table ends here -->
      </div>
    </div>
  </body>
  <script>
    
    document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function(){
          $("#scanBtn").on("click", function(){
            console.log("You pressed the scan btn");
          })
        });
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          contentHeight: "auto",
          fixedWeekCount: false,
          themeSystem: 'bootstrap5',
          events: 'calendar_events.php',
          eventClick: function(info){
            $.ajax({
                method: "POST",
                url: "modal_event.php",
                data: {
                    "product_id": info.event.id
                },
                success: function(response){
                    $(".edit-modal").html(response);
                    $("#view-edit-modal").modal('show');
                    console.log(response);
                }

            })
          }
        });
        calendar.render();
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