<?php
    session_start();
    include "../db_connect.php";
    date_default_timezone_set("Asia/Manila");
    // If there is a admin status session
    if(isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == "Active"){
        $event_id = $_GET['id'];
        $date = date("Y-m-d");
        $attend_senior = $conn->prepare("SELECT * FROM attend_tbl A INNER JOIN senior_tbl S ON A.senior_attend=S.senior_id WHERE activity_id=?");
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
    <style>
        #container {
            display: none;
        }
    </style>
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
          $active = "actActivities";
          include "admin_left_sidebar.php";  
        ?>

        <!-- Table Starts here -->
        <div class="col-lg-7 p-3">
            <div id="container">
                <table class="table table-striped table-bordered align-middle thead-dark" id="example" >
                    <thead>
                        <tr>
                            <th>Senior No.</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Extension</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($attend_result)){
                    ?>
                        <tr>
                            <td><?= $row['senior_id'] ?></td>
                            <td><?= $row['first_name'] ?></td>
                            <td><?= $row['mid_name'] ?></td>
                            <td><?= $row['last_name'] ?></td>
                            <td><?= $row['extension'] ?></td>
                            <td><?= $row['senior_purok_id'] ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="" id="graph-contain">
                <div class="row d-flex gap-2" id="graph" style="display: none">
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
            
        </div>

        <div class="col-lg-3 p-3">
            <div class="row">
                <div class="col-lg-12 d-grid">
                    <button id="showTable" class="btn btn-info mb-3">Show Table</button>
                    <button id="showGraph" class="btn btn-info mb-3">Show Graph</button>
                    <button id="exportButton" class="btn btn-info mb-3">Download Attendance</button>
                    <a href="admin_activities.php"  class="btn btn-success text-white">Return to Calendar</a>
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

      $("#showTable").on("click", function(){
        console.log("you want to show the table?");
        $("#container").css({
            "display": "block"
        })
        $("#graph-contain").css({
            "display": "none"
        });
      });
      // this uses the datatables

    var table = $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ],
        initComplete: function () {
            // Trigger Excel export programmatically
            $('#exportButton').click(function() {
                table.buttons(0).trigger();
            });
        },
    });
    $(".buttons-excel").css("display", "none");
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