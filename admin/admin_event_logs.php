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
          $sql = mysqli_query($conn, "SELECT * FROM senior_tbl");
          $online = mysqli_query($conn, "SELECT * FROM senior_tbl WHERE status='Active'");

          $sql_rows = mysqli_num_rows($online);
        ?>

        <!-- Event Logs Starts Here -->
        <div class="col-lg-8 bg-white table-responsive rounded overflow-auto">
          <ul class="nav nav-tabs nav-justified">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Admin</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="user-tab" data-bs-toggle="tab" data-bs-target="#user-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">User</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="senior-tab" data-bs-toggle="tab" data-bs-target="#senior-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Senior</button>
            </li>
          </ul>
          <!-- Event Logs Ends Here -->
        <div class="tab-content pt-3" id="">
          <!-- Admin Tab Pane Start -->
          <div class="tab-pane fade show active" id="admin-tab-pane" role="tabpanel" aria-labelledby="admin-tab" tabindex="0">
            <table class="table table-striped table-bordered align-middle thead-dark" id="myTable">
            <thead>
              <tr>
                <th>By</th>
                <th>Action</th>
                <th>Action Date</th>
                <th>Action Time</th>
              </tr>
            </thead>

            <tbody>
            <?php
              $admin_sql = mysqli_query($conn, "SELECT * FROM event_log E RIGHT JOIN action_tbl A ON E.action_id=A.action_id WHERE act_admin_id IS NOT NULL");
              while($admin_row = mysqli_fetch_assoc($admin_sql)){
            ?>
              <tr>
                <td>Admin</td>
                <td><?= $admin_row['action_done'] ?></td>
                <td><?= $admin_row['act_date'] ?></td>
                <td><?= $admin_row['act_time'] ?></td>
              </tr>
            <?php
              }
            ?>
            </tbody>
            </table>
          </div>
          <!-- Admin Tab Pane End -->

          
          <!-- User Tab Start -->
          <div class="tab-pane fade" id="user-tab-pane" role="tabpanel" aria-labelledby="user-tab" tabindex="0">
          <table class="table table-striped table-bordered align-middle thead-dark" id="myTable">
            <thead>
              <tr>
                <th>By</th>
                <th>Action</th>
                <th>Action Date</th>
                <th>Action Time</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $emp_sql = mysqli_query($conn, "SELECT * FROM event_log E RIGHT JOIN action_tbl A ON E.action_id=A.action_id RIGHT JOIN emp_tbl Em ON E.act_emp_id=Em.emp_id WHERE act_emp_id IS NOT NULL");
              while($emp_row = mysqli_fetch_assoc($emp_sql)){
            ?>
              <tr>
                <td><?= $emp_row['full_name'] ?></td>
                <td><?= $emp_row['action_done'] ?></td>
                <td><?= $emp_row['act_date'] ?></td>
                <td><?= $emp_row['act_time'] ?></td>
              </tr>
            <?php
              }
            ?>
            </tbody>
            </table>
          </div>
          <!-- User Tab End -->

          <!-- Senior Tab Start -->
          <div class="tab-pane fade" id="senior-tab-pane" role="tabpanel" aria-labelledby="user-tab" tabindex="0">
          <table class="table table-striped table-bordered align-middle thead-dark" id="myTable">
            <thead>
              <tr>
                <th>By</th>
                <th>Action</th>
                <th>Action Date</th>
                <th>Action Time</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $senior_sql = mysqli_query($conn, "SELECT * FROM event_log E RIGHT JOIN action_tbl A ON E.action_id=A.action_id RIGHT JOIN senior_tbl S ON E.act_senior_id=S.senior_id WHERE act_senior_id IS NOT NULL");
              while($senior_row = mysqli_fetch_assoc($senior_sql)){
            ?>
              <tr>
                <td><?= $senior_row['full_name'] ?></td>
                <td><?= $senior_row['action_done'] ?></td>
                <td><?= $senior_row['act_date'] ?></td>
                <td><?= $senior_row['act_time'] ?></td>
              </tr>
            <?php
              }
            ?>
            </tbody>
            </table>
          </div>
          <!-- Senior Tab End --> 
        </div>

        </div>
      </div>
    </div>
  </body>
  <script>
    $(document).ready(function(){
      $("#deleteBtn").on("click", function(){
        let senior_id = $(this).closest("tr").find(".senior_id").text();
        console.log(senior_id);
        // if(confirm("Do you want to delete this account?" . senior_id) == true){
        //   window.location.href = "admin_delete_senior.php?id=" . senior_id; 
        // }
      });
      // this uses the datatables
      $('table').DataTable( {
        dom: '<"d-flex flex-between"<"col"B><"col"f>>t<"d-flex flex-between"<"col"l><"col"p>><"clear">',
        buttons: [
          // This is for the Excel button
          {
            text: '<i class="fa-solid fa-file-excel"></i>Download Excel',
            extend: 'excel', 
            className: 'btn text-white btn-block rounded'
          },
        {
          extend: "spacer"
        },
        {
          extend: "spacer"
        },
          // This is for the csv button
          {
            text: '<i class="fa-solid fa-file-csv"></i>Download CSV',
            extend: 'csv', 
            className: 'btn text-white btn-block rounded'
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