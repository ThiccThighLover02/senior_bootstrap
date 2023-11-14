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
          $active = "actSenior";
          include "admin_left_sidebar.php";  
        ?>

        <!-- Table Starts here -->
        <div class="col-lg-7 p-3 bg-white table-responsive rounded">
          <?php
            if(isset($_GET['filter']) && $_GET['filter'] == "default"){
              include "tables/senior_default_tbl.php";
            }
            elseif(isset($_GET['filter']) && $_GET['filter'] == "barangay"){
              include "tables/senior_barangay_tbl.php";
            }
            elseif(isset($_GET['filter']) && $_GET['filter'] == "sex"){
              include "tables/senior_sex_tbl.php";
            }
            elseif(isset($_GET['filter']) && $_GET['filter'] == "citizenship"){
              include "tables/senior_citizenship_tbl.php";
            }
            elseif(isset($_GET['filter']) && $_GET['filter'] == ""){
              include "tables/senior_sex_tbl.php";
            }
            elseif(isset($_GET['filter']) && $_GET['filter'] == "age"){
              include "tables/senior_age_tbl.php";
            }
            elseif(isset($_GET['filter']) && $_GET['filter'] == "education"){
              include "tables/senior_education_tbl.php";
            }
            elseif(isset($_GET['filter']) && $_GET['filter'] == "religion"){
              include "tables/senior_religion_tbl.php";
            }
            elseif(isset($_GET['filter']) && $_GET['filter'] == "civil"){
              include "tables/senior_civil_tbl.php";
            }
            else {
              include "tables/senior_default_tbl.php";
            }
          ?>
        </div>
        <!-- Table ends here -->

        <div class="col-lg-3">
          <form action="admin_view_seniors.php" method="GET">
            <div class="form-group d-grid">
              <select name="filter" id="" class="form-select form-select-lg">
                <option value="" hidden>Filter by</option>
                <option value="barangay">Barangay</option>
                <option value="sex">Sex</option>
                <option value="citizenship">Citizenship</option>
                <option value="age">Age</option>
                <option value="education">Educational Attainment</option>
                <option value="religion">Religion</option>
                <option value="civil status">Civil Status</option>
              </select>
              <button class="btn btn-primary text-white fs-5 mt-2">Filter</button>
            </div>
          </form>
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