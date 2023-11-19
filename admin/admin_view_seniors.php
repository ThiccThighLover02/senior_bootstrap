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
        <div class="col-lg-8 p-3 bg-white table-responsive rounded">
          <?php

            list($address_hidden, $hidden_blood, $hidden_civil, $hidden_education, $hidden_religion, $sex_hidden) = array_fill(0, 6, "hidden");

            if(isset($_GET['filwan']) && isset($_GET['filtu'])){
              
              switch($_GET['filwan']){
                case 'barangay':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE barangay_id=?");
                    $sql->bind_param("i", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $address_hidden = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $address_hidden = "";
                  }
                break;

                case 'sex':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE sex=?");
                    $sql->bind_param("s", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $sex_hidden = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $sex_hidden = "";
                  }
                break;

                case 'education':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE S.education_id=?");
                    $sql->bind_param("i", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $hidden_education = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $hidden_education = "";
                  }
                break;

                case 'religion':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE S.religion_id=?");
                    $sql->bind_param("s", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $hidden_religion = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $hidden_religion = "";
                  }
                break;

                case 'civil_status':
                  if(isset($_GET['filtu']) && $_GET['filtu'] != 'all'){
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id WHERE S.civil_id=?");
                    $sql->bind_param("s", $_GET['filtu']);
                    $sql->execute();
                    $result = $sql->get_result();
                    $hidden_civil = "";
    
                  }
                  else{
                    $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                    $sql->execute();
                    $result = $sql->get_result();
                    $hidden_civil = "";
                  }
                break;


                default:
                  $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                  $sql->execute();
                  $result = $sql->get_result();
                break;

              }

            }
            else{
              $sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN civil_tbl Cl ON S.civil_id=Cl.civil_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id");
                  $sql->execute();
                  $result = $sql->get_result();
            }

          ?>
          <table class="table table-striped table-bordered align-middle thead-dark" id="myTable">
            <thead>
              <tr>
                <th>Senior No</th>
                <th>Status</th>
                <th>Name</th>
                <th <?= $address_hidden ?>>Address</th>
                <th hidden>Birthdate</th>
                <th hidden>Birthplace</th>
                <th <?= $sex_hidden ?>>Sex</th>
                <th hidden>Citizenship</th>
                <th <?= $hidden_blood ?>>Blood Type</th>
                <th <?= $hidden_education ?>>Education Attainment</th>
                <th hidden>Contact No.</th>
                <th hidden>Emergency No.</th>
                <th <?= $hidden_religion ?>>Religion</th>
                <th <?= $hidden_civil ?>>Civil Status</th>
                <th hidden>Email</th>
                <th hidden>Date Joined</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
              // this loop will iterate the rows and display the data
              while($row = mysqli_fetch_array($result)){
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
                <td class="align-middle" <?= $address_hidden ?>><?= $row['purok_no'] . ", " .  $row['barangay_name'] . ", " . $row['municipality_name'] . ", " . $row['province_name'] ?></td>
                <td class="align-middle" hidden><?= $row['date_birth'] ?></td>
                <td class="align-middle" hidden><?= $row['birth_place'] ?></td>
                <td class="align-middle" <?= $sex_hidden ?>><?= $row['sex'] ?></td>
                <td class="align-middle" hidden><?= $row['citizenship'] ?></td>
                <td class="align-middle" <?= $hidden_blood ?>><?= $row['blood_type'] ?></td>
                <td class="align-middle" <?= $hidden_education ?>><?= $row['education_attainment'] ?></td>
                <td class="align-middle" hidden><?= $row['cell_no'] ?></td>
                <td class="align-middle" hidden><?= $row['emergency_no'] ?></td>
                <td class="align-middle" <?= $hidden_religion ?>><?= $row['religion_name'] ?></td>
                <td class="align-middle" <?= $hidden_civil ?>><?= $row['civil_status'] ?></td>
                <td class="align-middle" hidden><?= $row['senior_email'] ?></td>
                <td class="align-middle" hidden><?= $row['account_date'] . " " . $row['account_time'] ?></td>
                <td class="align-middle d-grid">
                  <a href="admin_senior_acc.php?id=<?= $row['senior_id'] ?>" class="btn btn-sm btn-primary btn-block text-white">View Senior</a>
                </td>
              </tr>
            <?php
              }
            ?>

            </tbody>
          </table>
        </div>
        <!-- Table ends here -->

        <div class="col-lg-2">
          <form action="admin_view_seniors.php" method="GET">
            <div class="form-group d-grid">
              <select name="filwan" id="filter1" class="form-select form-select-lg">
                <option value="" hidden>Filter by</option>
                <option value="all">All</option>
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

      // Filter javascript starts here
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

        else if(filterValue === 'all'){
          addOption("#filter2", "all", "All");
        }

        filter2Select.attr('placeholder', 'Select an option for ' + selectedValue);

      });
      // Filter javascript ends here

      $("#deleteBtn").on("click", function(){
        let senior_id = $(this).closest("tr").find(".senior_id").text();
        console.log(senior_id);
        // if(confirm("Do you want to delete this account?" . senior_id) == true){
        //   window.location.href = "admin_delete_senior.php?id=" . senior_id; 
        // }
      });
      // this uses the datatables
      $('#myTable').DataTable( {
        dom: '<"d-flex flex-between"<"col"B><"col"f>>t<"d-flex flex-between"<"col"l><"col"i><"col"p>><"clear">',
        buttons: [
          // This is for the Excel button
          {
            text: '<i class="fa-solid fa-file-excel"></i>Excel',
            extend: 'excel',
            exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15], // Specify the columns to include in the Excel export (exclude column 1)
                },
            className: 'btn btn-info text-white btn-block rounded'
          },
          {
          extend: "spacer"
        },
        {
          extend: "spacer"
        },
          {
            text: '<i class="fa-solid fa-file-pdf"></i>PDF',
            extend: 'pdf',
            customize: function (doc) {
                    // Adjust the styles to make the table fit in the PDF
                    doc.styles.tableHeader.fontSize = 5;
                    doc.styles.tableBodyEven.fontSize = 5;
                    doc.styles.tableBodyOdd.fontSize = 5;
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length).fill('auto');

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