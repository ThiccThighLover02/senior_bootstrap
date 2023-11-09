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
  <body class="bg-light" style="overflow-x: hidden;">
    <?php
      include 'emp_navbar.php';
    ?>
    <div class="container-fluid">
      <div class="row gx-5 pt-3" id="navbarSupportedContent">
        <?php
          // this active variable shows the active tab in the side bar
          $active = "actEvent";
          include "emp_left_sidebar.php";  
        ?>

        <!-- Event Logs Starts Here -->
        <div class="col-lg-8 bg-white table-responsive rounded overflow-auto pt-3">
          
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