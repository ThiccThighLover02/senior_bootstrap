<?php
    include '../db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include "senior_links.php";
    ?>
    <title>Senior Request</title>
</head>
<!-- Toast for age start -->
<div class="toast bg-danger position-absolute text-white text-right top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body">
    <i class="fa-solid fa-circle-exclamation fa-2xl"></i>
    <h4>Ages 60 and below are not qualified to register as senior citizens</h4>
    </div>
</div>
    <!-- Toast for age end -->
<body class="overflow-hidden" style="background-image: url('../munisipyobckgrnd.jpg'); background-size: cover;">

    <!-- container for header and form -->
    <div class="container-sm bg-white mt-4 p-5 rounded-3 overflow-auto" style="">

        <div class="row">
            <div class="col">
                <a href="senior_login.php"><i class="fa-solid fa-arrow-left fa-2xl"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <img src="../munisipyo.png" alt="" class="image-responsive" style="width: 10vw;">
            </div>
        </div>
        <div class="row text-center">
            <div class="col-12 mb-3">
                <h1>Senior Citizen Registration</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form action="senior_request.php" method="post" id="submit" class="d-flex flex-column gap-2 needs-validation" style="height: 43vh;" enctype="multipart/form-data" novalidate>
                  <div class="form-group d-flex flex-column">
                    <!-- Full Name -->
                    <h4>Full Name:</h4>
                    <div class="col-12 mb-3">
                        <!-- First Name -->
                        <input type="text" class="form-control form-control-lg" id="" name="first_name" placeholder="First Name" required>
                        <div class="valid-feedback mb-3">
                          Looks good!
                        </div>
                        <div class="invalid-feedback mb-1">
                          Require
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <!-- Middle Name -->
                        <input type="text" class="form-control form-control-lg" id="" name="middle_name" placeholder="Middle Name">
                    </div>

                    <div class="col-12 mb-3">
                        <!-- Last Name -->
                        <input type="text" class="form-control form-control-lg" id="" name="last_name" placeholder="Last Name" required>
                        <div class="invalid-feedback mb-1">
                          Require
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <!-- Extension -->
                        <input type="text" class="form-control form-control-lg" id="" name="extension" placeholder="Extension">
                    </div>
                  </div>

                  <div class="form-group d-flex flex-column">
                    <!-- Address -->
                    <h4>Permanent Address:</h4>
                    <div class="col-12 mb-3">
                        <!-- Purok -->
                        <select name="purok" id="" name="purok" class="form-select form-select-lg" required>
                            <option value="" hidden>Purok</option>
                        <?php
                            $purok = mysqli_query($conn, "SELECT * FROM purok_tbl");
                            while($row = mysqli_fetch_assoc($purok)){
                        ?>
                            <option value="<?= $row['purok_id'] ?>"> <?= $row['purok_no'] ?></option>
                        <?php
                            }
                        ?>
                        </select>
                        <div class="invalid-feedback mb-1">
                          Require
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Barangay -->
                        <select id="" name="barangay" class="form-select form-select-lg" required>
                            <option value="" hidden>Barangay</option>
                        <?php
                            $barangay = mysqli_query($conn, "SELECT * FROM barangay_tbl");
                            while($row = mysqli_fetch_assoc($barangay)){
                        ?>
                            <option value="<?= $row['barangay_id'] ?>"><?= $row['barangay_name'] ?></option>
                        <?php
                            }
                        ?>
                        </select>
                        <div class="invalid-feedback mb-1">
                          Require
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Municipality -->
                        <select name="municipality" id="" name="municipality" class="form-select form-select-lg">
                            <option value="1" hidden>San Isidro</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Province -->
                        <select name="province" id="" name="province" class="form-select form-select-lg">
                            <option value="1" hidden>Nueva Ecija</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group d-flex flex-column">
                    <!-- Birth Information -->
                    <h4>Birth Information:</h4>
                    <div class="col-12 mb-3">
                        <!-- BithDate -->
                        <input type="date" name="birth_date" class="form-control form-control-lg birth_date" id="birth_date" placeholder="" required>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- BirthPlace -->
                        <input type="text" name="birth_place" class="form-control form-control-lg" id="" placeholder="Birthplace" required>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Citizenship -->
                        <input type="text" name="citizenship" class="form-control form-control-lg" id="" placeholder="Citizenship" required>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Gender -->
                        <select name="sex" id="" class="form-select form-select-lg" required>
                            <option value=""hidden>Sex(Kasarian)</option>
                            <option value="Male">Male(Lalaki)</option>
                            <option value="Female">Female(Babae)</option>
                        </select>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                  </div>

                  <div class="form-group d-flex flex-column">
                    <!-- Health related information -->
                    <h4>Health Related Information:</h4>
                    <div class="col-12 mb-3">
                        <!-- BloodType -->
                        <select name="blood_type" id="" class="form-select form-select-lg" required>
                            <option value="" hidden>Blood Type</option>
                        <?php
                            $blood_sql = mysqli_query($conn, "SELECT * FROM blood_tbl");
                            while($row = mysqli_fetch_assoc($blood_sql)){
                        ?>
                            <option value="<?= $row['blood_type'] ?>"><?= $row['blood_type'] ?></option>
                        <?php
                            }
                        ?>
                        </select>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Health Conditions -->
                        <input type="text" class="form-control form-control-lg" name="physical_disability" placeholder="Physical Disability" required>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    <div class="col-12 mb-3">
                      <div class="form-check">
                          <h5>Please check if you have the following:</h5>
                          <input type="checkbox" class="form-check-input mb-3" value="Hypertension" name="health[]">
                          <label for="">Hypertension</label>
                      </div>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input mb-3" value="Arthritis/Gout" name="health[]">
                          <label for="">Arthritis/Gout</label>
                      </div>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input mb-3" value="Coronary heart disease" name="health[]">
                          <label for="">Coronary heart diesease</label>
                      </div>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input mb-3" value="Diabetes" name="health[]">
                          <label for="">Diabetes</label>
                      </div>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input mb-3" value="Chronic kidney disease" name="health[]">
                          <label for="">Chronic kidney diesease</label>
                      </div>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input mb-3" value="Alzheimer's/Dementia" name="health[]">
                          <label for="">Alzheimer's/Dementia</label>
                      </div>
                      <div class="form-check">
                          <input type="checkbox" class="form-check-input mb-3" value="Chronic Obstructive Pulmonary diesease" name="health[]">
                          <label for="">Chronic Obstructuve Pulmonary disease</label>
                      </div>
                      <input type="text" class="form-control form-control-lg mb-3" name="other_health" placeholder="Others(please specify)">
                    </div>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    
                    

                  <div class="form-group d-flex flex-column">
                    <!-- Highest Educational Attainment -->
                    <h4>Highest Educational Attainment</h4>
                    <div class="col-12 mb-3">
                        <select name="education" id="" class="form-select form-select-lg" required>
                            <option value="" hidden>Educational Attainment</option>
                            <option value="No Education">No Education</option>
                            <option value="Elementary">Elementary</option>
                            <option value="Highschool">Highschool</option>
                            <option value="College">College</option>
                            <option value="Vocational">Vocational</option>
                            <option value="Master's Degree">Master's Degree</option>
                            <option value="Doctoral">Doctoral</option>
                        </select>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                  </div>


                  <div class="form-group d-flex flex-column">
                    <!-- Contact Information -->
                    <h4>Contact Information:</h4>
                    <div class="col-12 mb-3">
                        <!-- Email Address -->
                        <input type="email" class="form-control form-control-lg" name="email" id="" placeholder="Email Address" required>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Contact Number -->
                        <input type="text" class="form-control form-control-lg" name="cell_no" id="" placeholder="Contact Number" required>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Emergency Contact -->
                        <input type="text" class="form-control form-control-lg" name="emergency_no" id="" placeholder="Emergency Contact" required>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    
                  </div>

                  <div class="form-group d-flex flex-column">
                    <!-- Other information -->
                    <h4>Other Information:</h4>
                    <!-- Religion -->
                    <input type="text" class="form-control form-control-lg mb-3" id="" name="religion" placeholder="Religion">
                    <!-- Civil Status -->
                    <input type="text" class="form-control form-control-lg mb-3" id="" name="civil_status" placeholder="Civil Status"> 
                  </div>

                  <div class="form-group d-flex flex-column">
                    <h4>ID and Certificates</h4>

                    <div class="col-12 mb-3">
                        <!-- 2x2 Picture -->
                        <div class="">
                            <label for="" class="form-label">2x2 Picture</label>
                            <input type="file" name="id_pic" id="twobytwo" class="form-control" required>
                        </div>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Birth Certificate -->
                        <div class="">
                            <label for="" class="form-label">Birth Certificate</label>
                            <input type="file" id="birth-certificate" class="form-control" name="birth_certificate" required>
                        </div>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                    <div class="col-12 mb-3">
                        <!-- Barangay Certificate -->
                        <div class="">
                            <label for="" class="form-label">Barangay Certificate</label>
                            <input type="file" id="barangay-certificate" class="form-control" name="bar_certificate" required>
                        </div>
                        <label for="" class="invalid-feedback mb-1">Require</label>
                    </div>
                  </div>

                  <input type="submit" class="btn btn-primary btn-block" value="Submit Request">

                </form>
                

            </div>
        </div>
    </div>
</body>
<script>

    const twoBytwo = document.getElementbyId("twobytwo");
    const birth_certificate = document.getElementById("birth_certificate");
    const barangay_certificate = document.getElementById("barangay_certificate");
    const twoBytwo_extension = twoBytwo.files[0].name.split(".").pop();
    
    $(document).ready(function(){

    //     $('#submit').bootstrapValidator({
    //     feedbackIcons: {
    //         valid: 'glyphicon glyphicon-ok',
    //         invalid: 'glyphicon glyphicon-remove',
    //         validating: 'glyphicon glyphicon-refresh'
    //     },
    //     fields: {
    //         first_name: {
    //             validators: {
    //                 stringLength: {
    //                     min: 2,
    //                 },
    //                 notEmpty: {
    //                     message: "Please supply your first name"
    //                 }
    //             }
    //         }
    //     }
    // });


        $("#submit").on("submit", function(e){
            $("#submit").removeClass("needs-validation").addClass("was-validated");
            e.preventDefault();
        });
        
        $("#twobytwo").on("input", function(e){
            if(twoBytwo.files.length){
                console.log(twoBytwo_extension);
            }
        });

        $(".birth_date").on("input", function(e){
            //first we have to get the date input to calculate the age
            const birth_input = document.getElementById("birth_date").value;
            const birth_val = new Date(birth_input);

            //well have to calculate the month difference first
            const month_diff = Date.now() - birth_val;

            // convert the calculated difference in date format
            const age_dt = new Date(month_diff);

            //extract year from date then calculate the age of the user
            const year = age_dt.getUTCFullYear();
            const age = Math.abs(year - 1970);
            console.log(age);
            if(age < 60){
                $(".toast").toast("show");
            }
        });
    });

    
</script>
</html>