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
          $active = "actSenior";
          include "emp_left_sidebar.php";  
          $sql = mysqli_query($conn, "SELECT * FROM senior_tbl");
          $online = mysqli_query($conn, "SELECT * FROM senior_tbl WHERE status='Active'");

          $sql_rows = mysqli_num_rows($online);
        ?>

        <!-- Table Starts here -->
        <div class="col-lg-8 p-3 bg-white table-responsive rounded overflow-auto">
          <table class="table table-striped table-bordered align-middle thead-dark" id="myTable">
            <thead>
              <tr>
                <th>Senior No</th>
                <th>Status</th>
                <th>Name</th>
                <th>Online Users: <?= $sql_rows ?></th>
              </tr>
            </thead>
            <tbody>
            <?php
              // this loop will iterate the rows and display the data
              while($row = mysqli_fetch_array($sql)){
              $senior_stat = "";
              // if status is active the icon will be color green
              if($row['status'] == "Active"){
                $senior_stat = "text-success";
              }
              // if not the icon will be color red
              else{
                $senior_stat = "text-danger";
              }
            ?>
              <tr>
                <!-- display all the data in the row -->
                <td class="align-middle senior_id"><?= str_pad($row['senior_id'], 6, 0, STR_PAD_LEFT) ?></td>
                <td class="align-middle"><i class="fa-solid fa-circle fa-2xs <?= $senior_stat ?>"></i> <?= $row['status'] ?></td>
                <td class="align-middle"><?= $row['full_name'] ?></td>
                <td class="align-middle">
                  <a href="admin_senior_acc.php?id=<?= $row['senior_id'] ?>" class="btn btn-sm btn-primary btn-block text-white">View Senior</a><a href="emp_delete_senior.php?id=<?= $row['senior_id'] ?>" class="btn btn-sm btn-danger btn-block text-white" id="deleteBtn">Delete Senior</a>
                </td>
              </tr>
            <?php
              }
            ?>

            </tbody>
          </table>
        </div>
        <!-- Table ends here -->
      </div>
    </div>
  </body>
  <script>
    $(document).ready(function(){
      $("#deleteBtn").on("click", function(e){
        if(confirm("Do you want to delete this account?") == false){
          e.preventDefault();
        }
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
            text: '<i class="fa-solid fa-file-excel"></i>Download Excel',
            extend: 'excel', 
            className: 'btn text-white btn-block rounded',
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
              window.location.href = "emp_create_senior.php";
            },
            className: "btn text-white btn-block rounded"
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