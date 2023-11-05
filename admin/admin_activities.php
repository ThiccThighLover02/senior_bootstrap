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
  <body class="bg-light overflow-hidden">
    <?php
      include 'admin_navbar.php';
    ?>
    <div class="container-fluid">
      <div class="row gx-5 pt-3" id="navbarSupportedContent">
        <?php
          // this active variable shows the active tab in the side bar
          $active = "actActivities";
          include "admin_left_sidebar.php";  
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
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          contentHeight: "auto",
          fixedWeekCount: false,
          themeSystem: 'bootstrap5',
          events: [
            {
                title: "Practice Event bootstrap",
                start: "2023-11-04",
                end: "2023-11-10"
            }
          ]
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