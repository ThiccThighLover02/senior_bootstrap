<?php
    session_start();
    include "../db_connect.php";
    date_default_timezone_set("Asia/Manila");
    // If there is a admin status session
    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
        $event_id = $_GET['id'];
        $date = date("Y-m-d");
        $attend_senior = $conn->prepare("SELECT * FROM attend_tbl WHERE activity_id=?");
        $attend_senior->bind_param("i", $event_id);
        $attend_senior->execute();
        $attend_result = $attend_senior->get_result();
        $attend_rows = mysqli_num_rows($attend_result);

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
  <body class="bg-light" style="overflow-x: hidden;">
    <?php
      include 'admin_navbar.php';
    ?>
    <div class="container-fluid">
      <div class="row gx-5 pt-3" id="navbarSupportedContent">
        <?php
          // this active variable shows the active tab in the side bar
          $active = "actEvent";
          include "admin_left_sidebar.php";  
        ?>

        <!-- Table Starts here -->
        <div class="col-lg-7 p-3">
         
            <div class="row d-flex gap-2">
                <div class="col-lg-5 bg-white rounded-4 shadow p-3 d-flex flex-column align-items-start" style="height: 20vh" id="senior-attend">
                    <h3 class="text-primary">No. of seniors attended</h3>
                    <p class="fs-2"><?= $attend_rows ?></p>
                </div>
                <?php
                    $all_seniors = $conn->prepare("SELECT * FROM senior_tbl");
                    $all_seniors->execute();
                    $all_result = $all_seniors->get_result();
                    $all_rows = mysqli_num_rows($all_result);
                    $absent_seniors = $all_rows - $attend_rows;
                ?>
                <div class="col-lg-5 bg-white rounded-4 shadow p-3 d-flex flex-column align-items-start" style="height: 20vh">
                    <h3 class="text-primary">Absent</h3>
                    <p class="fs-2"><?= $absent_seniors ?></p>
                </div>
            </div>
            <div class="row">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <div class="col-lg-3 p-3">
            <div class="row">
                <div class="col-lg-12 bg-white">
                    <h1>Event Details</h1>
                </div>
            </div>
        </div>
      </div>
    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('myChart');
    <?php
        include "bar_chart.php";
    ?>
    new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Alua', 'Calaba', 'Malapit', 'Mangga', 'Poblacion', 'Pulo', 'San Roque', 'Santo Cristo', 'Tabon'],
        datasets: [{
        label: '# of Votes',
        data: <?= $js_array ?>,
        borderWidth: 1
        }]
    },
    options: {
        scales: {
        y: {
            beginAtZero: true
        }
        }
    }
    });

    $(document).ready(function(){
      $("#deleteBtn").on("click", function(){
        let senior_id = $(this).closest("tr").find(".senior_id").text();
        console.log(senior_id);
        // if(confirm("Do you want to delete this account?" . senior_id) == true){
        //   window.location.href = "admin_delete_senior.php?id=" . senior_id; 
        // }
      });
      // this uses the datatables
      $('#myTable').DataTable( {
        dom: '<"d-flex flex-between"<"col"B><"col"f>>t<"d-flex flex-between"<"col"l><"col"p>><"clear">',
        buttons: [
          // This is for the Excel button
          {
            text: '<i class="fa-solid fa-download"></i>Download Excel',
            action: function(){
              window.location.href="../excel.php";
            },
            className: 'btn btn-info text-white btn-block rounded'
          },
        {
          extend: "spacer"
        },
        {
          extend: "spacer"
        },
          //This is for the add senior
          {
            text: '<i class="fa-solid fa-user-plus"></i>Add Senior',
            action: function(){
              window.location.href = "admin_create_senior.php";
            },
            className: "btn btn-info text-white btn-block rounded"
          }

        ]
      } );  
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