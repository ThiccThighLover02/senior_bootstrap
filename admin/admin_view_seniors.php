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
            if(isset($_GET['filwan'])){

              #we'll use switch case to get the get, so that we can filter out and display the respective tables hahah
              switch($_GET['filwan']){

                case "barangay":
                  include 'tables/senior_barangay_tbl.php';
                  break;

                case "sex":
                  include 'tables/senior_sex_tbl.php';
                  break;

                  case "age":
                    include 'tables/senior_age_tbl.php';
                    break;

                case "citizenship":
                  include 'tables/senior_citizenship_tbl.php';
                  break;

                case "education":
                  include 'tables/senior_education_tbl.php';
                  break;

                case "religion":
                  include 'tables/senior_religion_tbl.php';
                  break;

                case "civil_status":
                  include 'tables/senior_civil_tbl.php';
                  break;

                default:
                  include 'tables/senior_default_tbl.php';
                  break;
              }

            }
            else{
              include "tables/senior_default_tbl.php";
            }

          ?>
        </div>
        <!-- Table ends here -->

        <div class="col-lg-3">
          <form action="admin_view_seniors.php" method="GET">
            <div class="form-group d-grid">
              <select name="filwan" id="filter1" class="form-select form-select-lg">
                <option value="" hidden>Filter by</option>
                <option value="barangay">Barangay</option>
                <option value="sex">Sex</option>
                <option value="age">Age</option>
                <option value="education">Educational Attainment</option>
                <option value="religion">Religion</option>
                <option value="civil_status">Civil Status</option>
              </select>

              <select name="filtu" id="filter2" class="form-select form-select-lg mt-3">
                
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
      $("#filter1").on("change", function(){
        var filterValue = $(this).val();
        console.log(filterValue);

        $("#filter2").empty();

        if(filterValue === 'barangay'){
          addOption("#filter2", "all", "All");
          <?php
            $barangay_sql  = mysqli_query($conn, "SELECT * FROM barangay_tbl");
            while($row = mysqli_fetch_assoc($barangay_sql)){
          ?>
          addOption("#filter2", '<?= $row['barangay_id'] ?>', '<?= $row['barangay_name'] ?>');
          <?php
            }
          ?>
        }
        else if(filterValue === 'sex'){
          addOption("#filter2", "all", "All");
          addOption("#filter2", 'male', 'Male');
          addOption("#filter2", 'female', 'Female');
        }

        else if(filterValue === 'age'){
          addOption("#filter2", "all", "All");
        }

        else if(filterValue === 'education'){
          addOption("#filter2", "all", "All");
        <?php
          $education_sql = mysqli_query($conn, "SELECT * FROM education_tbl");
          while($row = mysqli_fetch_assoc($education_sql)){
        ?>
          addOption("#filter2", "<?= $row['education_id'] ?>", "<?= $row['education_attainment'] ?>");
        <?php
          }
        ?>
        }
        
        else if(filterValue === 'religion'){
          addOption("#filter2", "all", "All");
        <?php
          $religion_sql = mysqli_query($conn, "SELECT * FROM religion_tbl");
          while($row = mysqli_fetch_assoc($religion_sql)){
        ?>
          addOption("#filter2", "<?= $row['religion_id'] ?>", "<?= $row['religion_name'] ?>");
        <?php
          }
        ?>
        }

        else if(filterValue === 'civil_status'){
          addOption("#filter2", "all", "All");
        <?php
          $civil_sql = mysqli_query($conn, "SELECT * FROM civil_tbl");
          while($row = mysqli_fetch_assoc($civil_sql)){
        ?>
          addOption("#filter2", "<?= $row['civil_id'] ?>", "<?= $row['civil_status'] ?>");
        <?php
          }
        ?>
        }

        filter2Select.attr('placeholder', 'Select an option for ' + selectedValue);

      });

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
      });  
    });

    function addOption(selectElement, value, text){
      var option = new Option(text, value, false, false);
      $(selectElement).append(option);
    }
    
  </script>
</html>

<?php
    }
    // If there are no sessions you will be redirected back to the landing page
    else {
        header("Location: index.php");
    }
?>