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
          $active = "actRequest";
          include "admin_left_sidebar.php";  
          $sql = mysqli_query($conn, "SELECT * FROM request_tbl");
          $req_rows = mysqli_num_rows($sql);
          if($req_rows > 0){
        ?>

        <!-- Table Starts here -->
        <div class="col-lg-8 p-3 bg-white table-responsive rounded overflow-auto">
        
          <table class="table table-striped table-bordered align-middle thead-dark" id="myTable">
            <thead>
              <tr>
                <th>Request No.</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
              // this loop will iterate the rows and display the data
              while($row = mysqli_fetch_array($sql)){
              
            ?>
              <tr>
                <!-- display all the data in the row -->
                <td class="text-center fs-5"><?= $row['request_id'] ?></td>
                <td class="text-center fs-5"><?= $row['full_name'] ?> has sent a request</td>
                <td class="d-flex justify-content-center"><a href="admin_view_request.php?id=<?= $row['request_id'] ?>" class="btn btn-primary text-white">View Request</a></td>
              </tr>
            <?php
              }
            ?>

            </tbody>
          </table>
        </div>
        <!-- Table ends here -->
        <?php
        }
        elseif($req_rows == 0){
        ?>
          <div class="col-lg-8 p-3 bg-white d-flex align-items-center justify-content-center rounded overflow-auto">
            <h1>No new requests</h1>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </body>
  <script>
    $(document).ready(function(){
      // this uses the datatables
      $('#myTable').DataTable( {
        dom: '<"d-flex flex-between"<"col"B><"col"f>>t<"d-flex flex-between"<"col"l><"col"p>><"clear">',
        buttons: [
          // This is for the Excel button
          {
            text: '<i class="fa-solid fa-file-excel"></i>Download Excel',
            extend: 'excel', 
            className: 'btn btn-info text-white btn-block rounded'
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
            className: 'btn btn-info text-white btn-block rounded'
          },
        

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